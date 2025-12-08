<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use App\Models\Review;

class PeliculaController extends Controller
{
    protected $tmdbKey = '068f9f8748c67a559a92eafb6a8eeda7';
    protected $tmdbUrl = 'https://api.themoviedb.org/3';

    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $query = $request->query('search', '');
        $perPage = 20;

        // ⭐ Keywords y compañías oficiales de Marvel
        $marvelKeywords = ['180547']; // MCU
        $marvelCompanies = [
            420,    // Marvel Studios
            7505,   // Marvel Entertainment
            13252,  // Marvel Animation
            42054,  // Marvel Television
            9993,   // Marvel Knights
            19551,  // ABC Studios
            3475,   // Disney+ Originals
            2,
            3,
            6125 // Disney distribuidoras
        ];

        // ⭐ Buscar SOLO contenido Marvel
        $response = Http::get("$this->tmdbUrl/discover/movie", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES',
            'page' => $page,
            'include_adult' => false,
            'with_companies' => implode('|', $marvelCompanies),
            'with_keywords' => implode('|', $marvelKeywords),
            'sort_by' => 'release_date.asc'
        ]);

        $data = $response->json();

        if (!isset($data['results'])) {
            $peliculas = new LengthAwarePaginator([], 0, $perPage, $page);
            return view('peliculas.index', compact('peliculas'));
        }

        $peliculasAdaptadas = [];

        foreach ($data['results'] as $movie) {

            // Obtener detalles SOLO para tener imdb_id
            $details = Http::get("$this->tmdbUrl/movie/{$movie['id']}", [
                'api_key' => $this->tmdbKey,
                'language' => 'es-ES'
            ])->json();

            $peliculasAdaptadas[] = [
                'id' => $movie['id'],
                'imdbID' => $details['imdb_id'] ?? null,
                'title' => $movie['title'] ?? 'Sin título',
                'anio' => $movie['release_date'] ? substr($movie['release_date'], 0, 4) : 'Desconocido',
                'poster_path' => $movie['poster_path']
                    ? "https://image.tmdb.org/t/p/w300" . $movie['poster_path']
                    : '/images/no-poster.png',
                'sinopsis' => $movie['overview'] ?? 'Sin información disponible',
            ];
        }

        // Paginación
        $peliculas = new LengthAwarePaginator(
            $peliculasAdaptadas,
            $data['total_results'] ?? count($peliculasAdaptadas),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('peliculas.index', compact('peliculas'));
    }

    public function buscar(Request $request)
    {
        $search = $request->query('q');

        if (!$search) return response()->json([]);

        // Buscar en TMDB (rápido sin detalles)
        $response = Http::get("$this->tmdbUrl/search/movie", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES',
            'query' => $search,
            'include_adult' => false
        ]);

        $results = $response->json()['results'] ?? [];

        // IDs Marvel (solo filtramos aquí si quieres)
        $marvelCompanies = [420, 38679, 38607];

        foreach ($results as $movie) {

            $details = Http::get("$this->tmdbUrl/movie/{$movie['id']}", [
                'api_key' => $this->tmdbKey,
                'language' => 'es-ES'
            ])->json();

            $companies = array_column($details['production_companies'] ?? [], 'id');

            if (!array_intersect($companies, $marvelCompanies)) {
                continue;
            }

            $filtered[] = [
                'id' => $movie['id'],
                'imdbID' => $details['imdb_id'] ?? null,
                'title' => $movie['title'],
                'anio' => $movie['release_date'],
                'poster_path' => $movie['poster_path']
                    ? "https://image.tmdb.org/t/p/w300" . $movie['poster_path']
                    : '/images/no-poster.png'
            ];
        }

        return response()->json($filtered);
    }

    public function show($tmdbID)
    {
        // Obtener detalles completos directamente con el ID TMDB
        $details = Http::get("$this->tmdbUrl/movie/$tmdbID", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES'
        ])->json();

        if (!$details || isset($details['success']) && $details['success'] === false) {
            abort(404, 'Película no encontrada');
        }

        // Obtener imdb_id directamente de la respuesta
        $imdbID = $details['imdb_id'] ?? null;

        $tmdbID = $tmdbID;

        // Obtener detalles completos
        $details = Http::get("$this->tmdbUrl/movie/$tmdbID", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES'
        ])->json();

        // Obtener videos
        $videos = collect(
            Http::get("$this->tmdbUrl/movie/$tmdbID/videos", [
                'api_key' => $this->tmdbKey,
                'language' => 'es-ES'
            ])->json()['results'] ?? []
        );

        $perPageVideos = 4; // por ejemplo
        $pageVideos = request('videos_page', 1);

        $videosPaginated = new LengthAwarePaginator(
            $videos->forPage($pageVideos, $perPageVideos),
            $videos->count(),
            $perPageVideos,
            $pageVideos,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        // 🔹 RECOMENDACIONES SOLO MARVEL
        $marvelCompanies = [420, 38679, 38607];

        $rawRecs = Http::get("$this->tmdbUrl/movie/$tmdbID/recommendations", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES'
        ])->json()['results'] ?? [];

        $recomendaciones = [];

        foreach ($rawRecs as $rec) {

            $recDetails = Http::get("$this->tmdbUrl/movie/{$rec['id']}", [
                'api_key' => $this->tmdbKey
            ])->json();

            $companies = array_column($recDetails['production_companies'] ?? [], 'id');

            if (!empty(array_intersect($companies, $marvelCompanies))) {
                $recomendaciones[] = $rec;
            }
        }

        // Paginación recomendaciones
        $recomendaciones = collect($recomendaciones);

        $perPageRec = 8;
        $pageRec = request('rec_page', 1);

        $recomendacionesPaginadas = new \Illuminate\Pagination\LengthAwarePaginator(
            $recomendaciones->forPage($pageRec, $perPageRec),
            $recomendaciones->count(),
            $perPageRec,
            $pageRec,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        // Imágenes (backdrops y posters)
        $imagenes = Http::get("$this->tmdbUrl/movie/$tmdbID/images", [
            'api_key' => $this->tmdbKey
        ])->json();

        $creditsForDirector = Http::get("$this->tmdbUrl/movie/$tmdbID/credits", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES'
        ])->json();

        $director = 'Desconocido';

        if (!empty($creditsForDirector['crew'])) {
            foreach ($creditsForDirector['crew'] as $crewMember) {
                if ($crewMember['job'] === 'Director') {
                    $director = $crewMember['name'];
                    break;
                }
            }
        }

        // Adaptar datos para vista
        $pelicula = [
            'id' => $imdbID,
            'titulo' => $details['title'] ?? 'Sin título',
            'anio' => $details['release_date'] ?? 'Desconocido',
            'genero' => implode(', ', array_column($details['genres'] ?? [], 'name')),
            'director' => $director ?? 'Desconocido',
            'actores' => '',
            'sinopsis' => $details['overview'] ?? 'Sin información disponible',
            'poster' => $details['poster_path']
                ? "https://image.tmdb.org/t/p/w500" . $details['poster_path']
                : '',
            'puntuacion' => $details['vote_average'] ?? 'N/A',
            'pais' => implode(', ', array_column($details['production_countries'] ?? [], 'name')),
            'idioma' => $details['original_language'] ?? 'Desconocido',
            'tipo' => 'pelicula',
            'imdbID' => $imdbID,
            'videos' => $videosPaginated,
            'backdrops' => $imagenes['backdrops'] ?? [],
            'posters' => $imagenes['posters'] ?? [],
            'recomendaciones' => $recomendaciones,
        ];

        // Créditos (actores)
        $credits = Http::get("$this->tmdbUrl/movie/$imdbID/credits", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES'
        ])->json();

        $actors = array_slice($credits['cast'] ?? [], 0, 10);

        $pelicula['actores'] = implode(', ', array_column($actors, 'name'));

        // Imágenes de actores
        $actorImages = [];
        foreach ($actors as $actor) {
            if (!empty($actor['profile_path'])) {
                $actorImages[$actor['name']] = "https://image.tmdb.org/t/p/w300" . $actor['profile_path'];
            } else {
                $actorImages[$actor['name']] = $this->getActorImageUrl($actor['name']);
            }
        }

        // Backdrops paginados
        $backdrops = collect($imagenes['backdrops'] ?? []);
        $perPage = 6;
        $page = request('page', 1);

        $backdropsPaginated = new LengthAwarePaginator(
            $backdrops->forPage($page, $perPage),
            $backdrops->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        // Obtener reseñas desde la base de datos
        $reseñas = Review::with('user')
            ->where('entity_id', $imdbID)
            ->where('type', 'pelicula')
            ->latest()
            ->get();

        return view('peliculas.show', compact(
            'pelicula',
            'reseñas',
            'actorImages',
            'backdropsPaginated',
            'recomendacionesPaginadas'
        ));
    }

    private function getActorImageUrl($actor)
    {
        $apiKey = '068f9f8748c67a559a92eafb6a8eeda7';

        // Buscar actor en TMDB
        $search = Http::get("https://api.themoviedb.org/3/search/person", [
            'api_key' => $apiKey,
            'query' => $actor,
        ]);

        if (!$search->ok() || empty($search['results'])) {
            return null;
        }

        $result = $search['results'][0];

        if (!isset($result['profile_path']) || !$result['profile_path']) {
            return null;
        }

        return "https://image.tmdb.org/t/p/w300" . $result['profile_path'];
    }
}
