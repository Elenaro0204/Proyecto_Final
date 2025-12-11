<?php

namespace App\Http\Controllers;

use App\Mail\ContenidoActualizadoMail;
use App\Mail\ContenidoCreadoMail;
use App\Mail\ContenidoEliminadoMail;
use App\Models\Review;
use App\Models\ReviewReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class ResenaController extends Controller
{
    private $apiKey = "068f9f8748c67a559a92eafb6a8eeda7";

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

        if ($review->type === 'pelicula') {
            $response = Http::get("https://api.themoviedb.org/3/movie/{$review->entity_id}?api_key={$this->apiKey}&language=es-ES");
        } elseif ($review->type === 'serie') {
            $response = Http::get("https://api.themoviedb.org/3/tv/{$review->entity_id}?api_key={$this->apiKey}&language=es-ES");
        }

        $data = $response->json();

        $tmdbType = $review->type === 'pelicula' ? 'movie' : 'tv';

        $credits = Http::get("https://api.themoviedb.org/3/{$tmdbType}/{$review->entity_id}/credits", [
            'api_key'   => $this->apiKey,
            'language'  => 'es-ES'
        ])->json();

        $director = 'Desconocido';
        if (!empty($credits['crew'])) {
            foreach ($credits['crew'] as $member) {
                if ($member['job'] === 'Director') {
                    $director = $member['name'];
                    break;
                }
            }
        }

        $actorsList = [];

        foreach ($credits['cast'] ?? [] as $actor) {
            $name = $actor['name'];

            // Crear URL a Wikipedia en español
            $wikiUrl = "https://es.wikipedia.org/wiki/" . str_replace(' ', '_', $name);

            $actorsList[] = [
                'name' => $name,
                'wiki' => $wikiUrl
            ];
        }

        // Limitar a 10 actores
        $actorsList = array_slice($actorsList, 0, 10);

        $entity = [
            'title'       => $data['title'] ?? $data['name'] ?? null,
            'year'        => substr($data['release_date'] ?? $data['first_air_date'] ?? 'Desconocido', 0, 4),
            'overview'    => $data['overview'] ?? 'Sin descripción disponible.',
            'genres'      => implode(', ', array_column($data['genres'] ?? [], 'name')),
            'director'    => $director,
            'actors'      => $actorsList,
            'score'       => $data['vote_average'] ?? 'N/A',
            'country'     => implode(', ', array_column($data['production_countries'] ?? [], 'name')),
            'language'    => $data['original_language'] ?? 'Desconocido',
            'poster'      => isset($data['poster_path'])
                ? 'https://image.tmdb.org/t/p/w500' . $data['poster_path']
                : null,
        ];

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

    // Mostrar una reseña específica
    public function showResena($id)
    {
        $review = Review::with('user')->findOrFail($id);

        $entity = null;

        if ($review->type === 'pelicula') {
            $response = Http::get("https://api.themoviedb.org/3/movie/{$review->entity_id}?api_key={$this->apiKey}&language=es-ES");
        } elseif ($review->type === 'serie') {
            $response = Http::get("https://api.themoviedb.org/3/tv/{$review->entity_id}?api_key={$this->apiKey}&language=es-ES");
        }

        $data = $response->json();

        $tmdbType = $review->type === 'pelicula' ? 'movie' : 'tv';

        $credits = Http::get("https://api.themoviedb.org/3/{$tmdbType}/{$review->entity_id}/credits", [
            'api_key'   => $this->apiKey,
            'language'  => 'es-ES'
        ])->json();

        $director = 'Desconocido';
        if (!empty($credits['crew'])) {
            foreach ($credits['crew'] as $member) {
                if ($member['job'] === 'Director') {
                    $director = $member['name'];
                    break;
                }
            }
        }

        $actorsList = [];

        foreach ($credits['cast'] ?? [] as $actor) {
            $name = $actor['name'];

            // Crear URL a Wikipedia en español
            $wikiUrl = "https://es.wikipedia.org/wiki/" . str_replace(' ', '_', $name);

            $actorsList[] = [
                'name' => $name,
                'wiki' => $wikiUrl
            ];
        }

        // Limitar a 10 actores
        $actorsList = array_slice($actorsList, 0, 10);

        $entity = [
            'title'       => $data['title'] ?? $data['name'] ?? null,
            'year'        => substr($data['release_date'] ?? $data['first_air_date'] ?? 'Desconocido', 0, 4),
            'overview'    => $data['overview'] ?? 'Sin descripción disponible.',
            'genres'      => implode(', ', array_column($data['genres'] ?? [], 'name')),
            'director'    => $director,
            'actors'      => $actorsList,
            'score'       => $data['vote_average'] ?? 'N/A',
            'country'     => implode(', ', array_column($data['production_countries'] ?? [], 'name')),
            'language'    => $data['original_language'] ?? 'Desconocido',
            'poster'      => isset($data['poster_path'])
                ? 'https://image.tmdb.org/t/p/w500' . $data['poster_path']
                : null,
        ];

        // Si es petición normal → Blade
        return view('resenas.show', compact('review', 'entity'));
    }

    // Mostrar formulario para crear nueva reseña
    public function create(Request $request, $type = null, $entity_id = null)
    {
        $title = $request->query('title');
        $info = null;

        if ($type && $entity_id) {

            $url = $type === 'pelicula'
                ? "https://api.themoviedb.org/3/movie/{$entity_id}"
                : "https://api.themoviedb.org/3/tv/{$entity_id}";

            $response = Http::get($url, [
                'api_key' => $this->apiKey,
                'language' => 'es-ES',
            ]);

            $data = $response->json();

            $info = [
                'title' => $data['title'] ?? $data['name'] ?? 'Título desconocido',
                'poster' => isset($data['poster_path'])
                    ? 'https://image.tmdb.org/t/p/w500' . $data['poster_path']
                    : null,
                'overview' => $data['overview'] ?? null,
            ];
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

        $endpoint = match ($type) {
            'pelicula' => "https://api.themoviedb.org/3/movie/{$entityId}?api_key={$this->apiKey}&language=es-ES",
            'serie'    => "https://api.themoviedb.org/3/tv/{$entityId}?api_key={$this->apiKey}&language=es-ES",
        };

        $response = Http::get($endpoint)->json();

        // TMDB devuelve "title" para películas y "name" para series
        $title = $response['title'] ?? $response['name'] ?? 'Título desconocido';

        // Crear reseña
        $review = Review::create([
            'user_id' => Auth::id(),
            'type' => $type,
            'entity_id' => $entityId,
            'entity_title' => $title,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        $review->load('autor');
        $autor = $review->autor;

        // URL correcta para la vista
        $url = route('resenas.ver', [
            'id'   => $review->id,
        ]);

        // Enviar correo
        Mail::to($autor->email)->send(new ContenidoCreadoMail($autor, $review, 'resena', $url));

        // Enviar copia al administrador
        Mail::to('soportemarvelpedia@gmail.com')->send(new ContenidoCreadoMail($autor, $review, 'resena', $url));

        return redirect()->route('resenas')
            ->with('success', 'Reseña creada correctamente.');
    }

    public function edit(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        // Cargar info TMDB
        $endpoint = $review->type === 'pelicula'
            ? "https://api.themoviedb.org/3/movie/{$review->entity_id}"
            : "https://api.themoviedb.org/3/tv/{$review->entity_id}";

        $data = Http::get($endpoint, [
            'api_key' => $this->apiKey,
            'language' => 'es-ES',
        ])->json();

        $info = [
            'title' => $data['title'] ?? $data['name'] ?? null,
            'poster' => isset($data['poster_path'])
                ? 'https://image.tmdb.org/t/p/w500' . $data['poster_path']
                : null,
            'overview' => $data['overview'] ?? null,
        ];

        $title = $info['title'];

        return view('resenas.edit', compact('review', 'title', 'info'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::with('autor')->findOrFail($id);

        if (Auth::id() !== $review->user_id) {
            abort(403, 'No tienes permiso para actualizar esta reseña.');
        }

        $user = $review->autor;
        $url = route('resenas.ver', $review->id);

        // Enviar email avisando
        Mail::to($user->email)->send(
            new ContenidoActualizadoMail($user, $review, 'resena', $url)
        );

        // Copia al admin
        Mail::to('soportemarvelpedia@gmail.com')->send(
            new ContenidoActualizadoMail($user, $review, 'resena', $url)
        );

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

    public function destroy($id)
    {
        $review = Review::with('autor')->findOrFail($id);

        $user = $review->autor;

        // Enviar email avisando
        Mail::to($user->email)->send(
            new ContenidoEliminadoMail($user, $review, 'resena')
        );

        // Copia al admin
        Mail::to('soportemarvelpedia@gmail.com')->send(
            new ContenidoEliminadoMail($user, $review, 'resena')
        );

        $review->delete();

        return redirect()->back()->with('success', 'Reseña eliminada correctamente.');
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
