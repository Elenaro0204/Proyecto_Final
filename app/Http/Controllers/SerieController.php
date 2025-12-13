<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ResenaController;
use App\Models\Review;

class SerieController extends Controller
{
    protected $apiKey = '1f00bd0e';
    protected $baseUrl = 'http://www.omdbapi.com/';

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
        $response = Http::get("$this->tmdbUrl/discover/tv", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES',
            'page' => $page,
            'include_adult' => false,
            'with_companies' => implode('|', $marvelCompanies),
            'with_keywords' => implode('|', $marvelKeywords),
            'sort_by' => 'release_date.asc'
        ]);

        $data = $response->json();
        $total = $data['total_results'] ?? 0;

        if (!isset($data['results'])) {
            $series = new LengthAwarePaginator([], 0, $perPage, $page);
            return view('series.index', compact('series'));
        }

        $seriesAdaptadas = [];

        foreach ($data['results'] as $serie) {

            // Obtener detalles SOLO para tener imdb_id
            $details = Http::get("$this->tmdbUrl/tv/{$serie['id']}", [
                'api_key' => $this->tmdbKey,
                'language' => 'es-ES'
            ])->json();

            $seriesAdaptadas[] = [
                'id' => $serie['id'],
                'imdbID' => $details['imdb_id'] ?? null,
                'title' => $serie['name'] ?? 'Sin título',
                'anio' => isset($serie['first_air_date']) && $serie['first_air_date']
                    ? substr($serie['first_air_date'], 0, 4)
                    : 'Desconocido',
                'poster_path' => $serie['poster_path']
                    ? "https://image.tmdb.org/t/p/w300" . $serie['poster_path']
                    : '/images/no-poster.png',
                'sinopsis' => $serie['overview'] ?? 'Sin información disponible',
            ];
        }

        // Paginación
        $series = new LengthAwarePaginator(
            $seriesAdaptadas,
            $data['total_results'] ?? count($seriesAdaptadas),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('series.index', compact('series'));
    }

    public function buscar(Request $request)
    {
        $search = $request->query('q');

        if (!$search) return response()->json([]);

        $response = Http::get($this->baseUrl, [
            'apikey' => $this->apiKey,
            's' => $search,
            'type' => 'series', // corregido
            'page' => 1
        ]);

        $series = $response->json()['Search'] ?? [];

        // IDs Marvel (solo filtramos aquí si quieres)
        $marvelCompanies = [420, 38679, 38607];

        foreach ($series as $serie) {

            $details = Http::get("$this->tmdbUrl/movie/{$serie['id']}", [
                'api_key' => $this->tmdbKey,
                'language' => 'es-ES'
            ])->json();

            $companies = array_column($details['production_companies'] ?? [], 'id');

            if (!array_intersect($companies, $marvelCompanies)) {
                continue;
            }

            $filtered[] = [
                'id' => $serie['id'],
                'imdbID' => $details['imdb_id'] ?? null,
                'title' => $serie['title'],
                'anio' => $serie['release_date'],
                'poster_path' => $serie['poster_path']
                    ? "https://image.tmdb.org/t/p/w300" . $serie['poster_path']
                    : '/images/no-poster.png'
            ];
        }

        return response()->json($filtered);
    }

    public function show($tmdbID)
    {
        // Buscar serie por IMDb ID
        $details = Http::get("$this->tmdbUrl/tv/$tmdbID", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES',
        ])->json();

        if (!$details || isset($details['success']) && $details['success'] === false) {
            abort(404, 'Serie no encontrada');
        }

        // Obtener IMDB ID real
        $externalIDs = Http::get("$this->tmdbUrl/tv/$tmdbID/external_ids", [
            'api_key' => $this->tmdbKey
        ])->json();

        $imdbID = $externalIDs['imdb_id'] ?? null;
        $tmdbID = $tmdbID;

        // Detalles completos
        $details = Http::get("$this->tmdbUrl/tv/$tmdbID", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES'
        ])->json();

        // 🔹 Obtener creadores
        $creadores = array_column($details['created_by'] ?? [], 'name');

        // 🔹 Obtener keywords
        $keywords = Http::get("$this->tmdbUrl/tv/$tmdbID/keywords", [
            'api_key' => $this->tmdbKey
        ])->json()['results'] ?? [];

        // 🔹 Obtener videos (trailers)
        $videos = collect(Http::get("$this->tmdbUrl/tv/$tmdbID/videos", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES'
        ])->json()['results'] ?? []);

        $perPageVideos = 4; // por ejemplo
        $pageVideos = request('videos_page', 1);

        $videosPaginated = new LengthAwarePaginator(
            $videos->forPage($pageVideos, $perPageVideos),
            $videos->count(),
            $perPageVideos,
            $pageVideos,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        // 🔹 Recomendaciones
        // IDs de compañías Marvel en TMDB
        $marvelCompanies = [420, 38679, 38607];

        $rawRecs = Http::get("$this->tmdbUrl/tv/$tmdbID/recommendations", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES'
        ])->json()['results'] ?? [];

        // Filtrar SOLO las series que sean de Marvel
        $recomendaciones = [];

        foreach ($rawRecs as $rec) {

            // Obtener detalles para revisar compañías
            $recDetails = Http::get("$this->tmdbUrl/tv/{$rec['id']}", [
                'api_key' => $this->tmdbKey
            ])->json();

            $companies = array_column($recDetails['production_companies'] ?? [], 'id');

            if (!empty(array_intersect($companies, $marvelCompanies))) {
                $recomendaciones[] = $rec;
            }
        }

        // Recomendaciones paginadas
        $recomendaciones = collect($recomendaciones);

        $perPageRec = 8; // cantidad por página
        $pageRec = request('rec_page', 1);

        $recomendacionesPaginadas = new \Illuminate\Pagination\LengthAwarePaginator(
            $recomendaciones->forPage($pageRec, $perPageRec),
            $recomendaciones->count(),
            $perPageRec,
            $pageRec,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        // 🔹 Imágenes
        $imagenes = Http::get("$this->tmdbUrl/tv/$tmdbID/images", [
            'api_key' => $this->tmdbKey
        ])->json();

        // Adaptar campos al formato OMDb
        $serie = [
            'id'          => $details['id'],
            'titulo'      => $details['name'] ?? 'Sin título',
            'anio'        => $details['first_air_date'] ?? 'Desconocido',
            'genero'      => implode(', ', array_column($details['genres'], 'name')),
            'director'    => implode(', ', $creadores) ?: 'Desconocido',
            'actores'     => '',
            'sinopsis'    => $details['overview'] ?? 'Sin información disponible',
            'poster'      => $details['poster_path']
                ? "https://image.tmdb.org/t/p/w500" . $details['poster_path']
                : '',
            'puntuacion'  => $details['vote_average'] ?? 'N/A',
            'pais'        => implode(', ', $details['origin_country']),
            'idioma'      => $details['original_language'] ?? 'Desconocido',
            'temporadas'  => $details['number_of_seasons'] ?? 0,
            'tipo'        => 'series',
            'imdbID'      => $imdbID,
            'videos'      => $videos,
            'keywords'    => array_column($keywords, 'name'),
            'backdrops'   => $imagenes['backdrops'] ?? [],
            'posters'     => $imagenes['posters'] ?? [],
            'recomendaciones' => $recomendaciones,
        ];

        // Créditos (actores)
        $credits = Http::get("$this->tmdbUrl/tv/$tmdbID/credits", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES'
        ])->json();

        $actors = array_slice($credits['cast'] ?? [], 0, 10);

        $serie['actores'] = implode(', ', array_column($actors, 'name'));

        // Imágenes de actores
        $actorImages = [];
        foreach ($actors as $actor) {
            if (!empty($actor['profile_path'])) {
                $actorImages[$actor['name']] = "https://image.tmdb.org/t/p/w300" . $actor['profile_path'];
            } else {
                $actorImages[$actor['name']] = $this->getActorImageUrl($actor['name']);
            }
        }

        // Reseñas de BD
        $reseñas = Review::with('user')
            ->where('entity_id', $serie['id'])
            ->where('type', 'serie')
            ->latest()
            ->get();

        // Episodios por temporada
        $episodiosPorTemporada = [];
        for ($s = 1; $s <= $serie['temporadas']; $s++) {
            $season = Http::get("$this->tmdbUrl/tv/$tmdbID/season/$s", [
                'api_key' => $this->tmdbKey,
                'language' => 'es-ES'
            ])->json();

            $episodiosPorTemporada[$s] = $season['episodes'] ?? [];

            for ($s = 1; $s <= $serie['temporadas']; $s++) {

                $seasonData = Http::get("$this->tmdbUrl/tv/$tmdbID/season/$s", [
                    'api_key' => $this->tmdbKey,
                    'language' => 'es-ES'
                ])->json();

                // Añadir IMDb ID a cada episodio
                foreach ($seasonData['episodes'] as &$ep) {

                    $external = Http::get("$this->tmdbUrl/tv/$tmdbID/season/$s/episode/{$ep['episode_number']}/external_ids", [
                        'api_key' => $this->tmdbKey
                    ])->json();

                    $ep['imdbID'] = $external['imdb_id'] ?? null;
                }

                $episodiosPorTemporada[$s] = $seasonData['episodes'] ?? [];
            }
        }

        $backdrops = collect($imagenes['backdrops'] ?? []);

        // Número de imágenes por página
        $perPage = 6;

        // Página actual
        $page = request('page', 1);

        // Crear paginación
        $backdropsPaginated = new LengthAwarePaginator(
            $backdrops->forPage($page, $perPage),
            $backdrops->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('series.show', compact(
            'serie',
            'reseñas',
            'episodiosPorTemporada',
            'actorImages',
            'backdropsPaginated',
            'recomendacionesPaginadas',
            'videosPaginated',
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
