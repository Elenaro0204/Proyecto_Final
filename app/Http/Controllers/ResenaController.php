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
    // Mostrar reseñas de una entidad (película, serie, personaje...)
    public function index(Request $request)
    {
        // Consulta base
        $query = Review::query()->with(['user', 'report']);

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
            case 'antiguas':
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
        $latest = $query->orderBy('created_at', 'desc')->take(6)->get();
        $topRated = $query->orderBy('rating', 'desc')->take(6)->get();
        $movies = $query->where('type', 'pelicula')->orderBy('created_at', 'desc')->take(6)->get();
        $series = $query->where('type', 'serie')->orderBy('created_at', 'desc')->take(6)->get();

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
                    'apikey' => env('OMDB_API_KEY'),
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
                'apikey' => env('OMDB_API_KEY'),
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
            'type' => 'required|in:pelicula,serie',
            'entity_id' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10',
        ]);

        $entityTitle = null;

        if (in_array($request->type, ['pelicula', 'serie']) && $request->entity_id) {
            // Traer título desde OMDb y cachear
            $data = Cache::remember("omdb_{$request->entity_id}", 86400, function () use ($request) {
                $response = Http::get('https://www.omdbapi.com/', [
                    'apikey' => env('OMDB_API_KEY'),
                    'i' => $request->entity_id,
                ]);
                return $response->json();
            });

            $entityTitle = $data['Title'] ?? null;
        }

        Review::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'entity_id' => $request->entity_id,
            'entity_title' => $entityTitle,
            'rating' => $request->rating,
            'content' => $request->input('content'),
        ]);

        return redirect()->route('resenas')->with('success', 'Reseña guardada correctamente');
    }

    public function edit(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $title = $request->query('title');
        $info = null;

        // Si quieres mostrar info de la entidad relacionada
        if ($review->type && $review->entity_id) {
            $response = Http::get('https://www.omdbapi.com/', [
                'apikey' => env('OMDB_API_KEY'),
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
