<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cache;

class ResenaController extends Controller
{
    // Mostrar reseñas de una entidad (película, serie...)
    public function index(Request $request)
    {
        // Consulta base
        $baseQuery  = Review::query()->with(['user', 'report']);

        $query = clone $baseQuery;

        // Filtro por contenido, tipo y título de entidad
        if ($request->filled('search')) {
            $term = strtolower($request->search);

            $query->where(function ($q) use ($term) {
                $q->where('content', 'like', "%{$term}%")
                    ->orWhere('type', 'like', "%{$term}%")
                    ->orWhere('entity_title', 'like', "%{$term}%");
            });
        }

        // Filtro por tipo específico si se pasa
        if ($request->filled('tipo')) {
            $query->where('type', $request->tipo);
        }

        // Orden
        switch ($request->orden) {
            case 'antiguos':
                $query->orderBy('created_at', 'asc');
                break;
            case 'valoradas':
                $query->orderBy('rating', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        // Paginar directamente desde la consulta
        $reviews = $query->paginate(12)->withQueryString();

        // AJAX → devuelve solo la lista de tarjetas
        if ($request->ajax()) {
            return view('resenas.partials.cards', ['reviews' => $reviews])->render();
        }

        // Datos secundarios para secciones de la home
        $latest   = (clone $baseQuery)->orderBy('created_at', 'desc')->take(6)->get();
        $topRated = (clone $baseQuery)->orderBy('rating', 'desc')->take(6)->get();
        $movies   = (clone $baseQuery)->where('type', 'pelicula')->orderBy('created_at', 'desc')->take(6)->get();
        $series   = (clone $baseQuery)->where('type', 'serie')->orderBy('created_at', 'desc')->take(6)->get();

        return view('resenas.index', [
            'reviews'        => $reviews,
            'latestReviews'  => $latest,
            'topRatedReviews' => $topRated,
            'movieReviews'   => $movies,
            'serieReviews'   => $series,
        ]);
    }

    // Mostrar detalle de una reseña
    public function show($id)
    {
        $review = Review::with('user')->findOrFail($id);

        $entity = null;

        if ($review->type && $review->entity_id && in_array($review->type, ['pelicula', 'serie'])) {
            try {
                $response = Http::get('https://www.omdbapi.com/', [
                    'apikey' => '1f00bd0e',
                    'i' => $review->entity_id,
                ]);
                $data = $response->json();
                if (isset($data['Response']) && $data['Response'] === 'True') {
                    $entity = [
                        'title' => $data['Title'] ?? null,
                        'year' => $data['Year'] ?? null,
                        'genre' => $data['Genre'] ?? null,
                        'director' => $data['Director'] ?? null,
                        'actors' => $data['Actors'] ?? null,
                        'poster' => $data['Poster'] != 'N/A' ? $data['Poster'] : null,
                        'plot' => $data['Plot'] ?? null,
                    ];
                }
            } catch (\Exception $e) {
                $entity = null;
            }
        }

        return response()->json([
            'review' => $review,
            'entity' => $entity,
        ]);
    }

    // Reseñas de una entidad específica
    public function showByEntity($type, $id)
    {
        $reviews = Review::with('user')
            ->where('type', $type)
            ->where('entity_id', $id)
            ->latest()
            ->get();

        return view('resenas.index', compact('reviews'));
    }

    // Mostrar formulario para crear nueva reseña
    public function create(Request $request, $type = null, $entity_id = null)
    {
        $title = $request->query('title');
        $info = null;

        if ($type && $entity_id) {
            $response = Http::get('https://www.omdbapi.com/', [
                'apikey' => '1f00bd0e',
                'i' => $entity_id,
            ]);
            $info = $response->json();
        }

        return view('resenas.create', compact('type', 'entity_id', 'title', 'info'));
    }

    // Guardar reseña
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'entity_id' => 'required',
            'content' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $type = $request->type;
        $entityId = $request->entity_id;

        // Obtener datos desde OMDb al guardar
        $apiKey = '1f00bd0e';
        $json = file_get_contents("https://www.omdbapi.com/?i={$request->entity_id}&apikey={$apiKey}");
        $info = json_decode($json, true);

        $title = $info['Title'] ?? 'Título desconocido';

        // Crear reseña
        Review::create([
            'user_id' => Auth::id(),
            'type' => $type,
            'entity_id' => $entityId,
            'entity_title' => $title,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        return redirect()->route('resenas')
            ->with('success', 'Reseña creada correctamente.');
    }

    public function edit(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $title = $request->query('title');
        $info = null;

        // Si quieres mostrar info de la entidad relacionada
        if ($review->type && $review->entity_id) {
            $response = Http::get('https://www.omdbapi.com/', [
                'apikey' => '1f00bd0e',
                'i' => $review->entity_id,
            ]);
            $info = $response->json();
        }

        return view('resenas.edit', compact('review', 'title', 'info'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        if (Auth::id() !== $review->user_id) {
            abort(403, 'No tienes permiso para actualizar esta reseña.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10',
        ]);

        $review->update([
            'rating' => $request->rating,
            'content' => $request->input('content'),
        ]);

        return redirect()->route('resenas')->with('success', 'Reseña actualizada correctamente.');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('resenas')->with('success', 'Reseña eliminada correctamente.');
    }

    public function report(Review $review)
    {
        // Evitar que el mismo usuario reporte varias veces la misma reseña
        if (!ReviewReport::where('review_id', $review->id)->where('reporter_id', Auth::id())->exists()) {
            ReviewReport::create([
                'review_id' => $review->id,
                'reporter_id' => Auth::id(),
                'expires_at' => now()->addHours(24), // ejemplo de cuenta atrás de 24h
            ]);
        }

        return redirect()->route('reportes')->with('success', 'Reseña reportada correctamente.');
    }
}
