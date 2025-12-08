<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    protected $tmdbKey = '068f9f8748c67a559a92eafb6a8eeda7';
    protected $tmdbUrl = 'https://api.themoviedb.org/3';

    // -------------------------
    //   Página principal
    // -------------------------
    public function index()
    {
        $peliculas = $this->getPeliculasData();
        $series = $this->getSeriesData();

        return view('descubre.index', compact('peliculas', 'series'));
    }

    // 🔹 Mostrar todas las series
    public function indexSeries()
    {
        $search = 'Marvel'; // palabra clave para buscar películas de Marvel
        $page = 1; // primera página de resultados

        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => '1f00bd0e',
            's' => $search,
            'type' => 'series',
            'page' => $page,
        ]);

        $data = $response->json();
        $series = $data['Search'] ?? []; // obtenemos solo los resultados de búsqueda

        return view('series.index', compact('series'));
    }

    // 🔹 Mostrar detalle de una serie específica con episodios por temporada
    public function showSeries($id)
    {
        // 1️⃣ Buscar serie en TMDB por IMDb ID
        $response = Http::get("$this->tmdbUrl/find/$id", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES',
            'external_source' => 'imdb_id'
        ]);

        $results = $response->json();

        if (empty($results['tv_results'])) {
            abort(404, 'Serie no encontrada en TMDB');
        }

        $serieData = $results['tv_results'][0];
        $tmdbID = $serieData['id'];

        // 2️⃣ Obtener detalles completos de la serie
        $details = Http::get("$this->tmdbUrl/tv/$tmdbID", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES'
        ])->json();

        // 3️⃣ Mapear datos
        $serie = [
            'id' => $id,
            'titulo' => $details['name'] ?? 'Sin título',
            'anio' => $details['first_air_date'] ?? 'Desconocido',
            'genero' => implode(', ', array_column($details['genres'] ?? [], 'name')),
            'director' => '',
            'actores' => '',
            'sinopsis' => $details['overview'] ?? 'Sin información disponible',
            'poster' => $details['poster_path']
                ? "https://image.tmdb.org/t/p/w500" . $details['poster_path']
                : '',
            'puntuacion' => $details['vote_average'] ?? 'N/A',
            'pais' => implode(', ', array_column($details['origin_country'] ?? [], '0')),
            'idioma' => $details['original_language'] ?? 'Desconocido',
            'temporadas' => $details['number_of_seasons'] ?? 0,
            'tipo' => 'series',
            'imdbID' => $id,
        ];

        // 4️⃣ ACTORES (from credits)
        $credits = Http::get("$this->tmdbUrl/tv/$tmdbID/credits", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES'
        ])->json();

        $actors = array_slice($credits['cast'] ?? [], 0, 10);
        $serie['actores'] = implode(', ', array_column($actors, 'name'));

        // 5️⃣ Imágenes de actores
        $actorImages = [];
        foreach ($actors as $actor) {
            if (!empty($actor['profile_path'])) {
                $actorImages[$actor['name']] = "https://image.tmdb.org/t/p/w300" . $actor['profile_path'];
            } else {
                $actorImages[$actor['name']] = $this->getActorImageUrl($actor['name']);
            }
        }

        // 6️⃣ Obtener episodios por temporada desde TMDB
        $totalSeasons = $details['number_of_seasons'] ?? 0;
        $episodiosPorTemporada = [];

        for ($s = 1; $s <= $totalSeasons; $s++) {
            $seasonData = Http::get("$this->tmdbUrl/tv/$tmdbID/season/$s", [
                'api_key' => $this->tmdbKey,
                'language' => 'es-ES'
            ])->json();

            $episodiosPorTemporada[$s] = $seasonData['episodes'] ?? [];
        }

        return view('series.show', compact(
            'serie',
            'episodiosPorTemporada',
            'actorImages'
        ));
    }


    // 🔹 Mostrar todas las películas de Marvel
    public function indexPeliculas()
    {
        $search = 'Marvel'; // palabra clave para buscar películas de Marvel
        $page = 1; // primera página de resultados

        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => '1f00bd0e',
            's' => $search,
            'type' => 'movie',
            'page' => $page,
        ]);

        $data = $response->json();
        $peliculas = $data['Search'] ?? []; // obtenemos solo los resultados de búsqueda

        return view('peliculas.index', compact('peliculas'));
    }

    // 🔹 Mostrar detalle de una película específica
    public function showPeliculas($id)
    {
        // Obtener detalles completos de la película
        $details = Http::get("https://api.themoviedb.org/3/movie/$id", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES'
        ])->json();

        if (isset($details['success']) && $details['success'] === false) {
            abort(404, 'Película no encontrada');
        }

        // Obtener videos
        $videos = Http::get("https://api.themoviedb.org/3/movie/$id/videos", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES'
        ])->json()['results'] ?? [];

        // Obtener imágenes
        $imagenes = Http::get("https://api.themoviedb.org/3/movie/$id/images", [
            'api_key' => $this->tmdbKey
        ])->json();

        // Créditos
        $credits = Http::get("https://api.themoviedb.org/3/movie/$id/credits", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES'
        ])->json();

        $actors = array_slice($credits['cast'] ?? [], 0, 10);

        $actorImages = [];
        foreach ($actors as $actor) {
            $actorImages[$actor['name']] = !empty($actor['profile_path'])
                ? "https://image.tmdb.org/t/p/w300" . $actor['profile_path']
                : $this->getActorImageUrl($actor['name']);
        }

        // Adaptar datos para la vista
        $pelicula = [
            'id' => $id,
            'titulo' => $details['title'] ?? 'Sin título',
            'anio' => $details['release_date'] ?? 'Desconocido',
            'genero' => implode(', ', array_column($details['genres'] ?? [], 'name')),
            'director' => '',
            'actores' => implode(', ', array_column($actors, 'name')) ?? '',
            'sinopsis' => $details['overview'] ?? 'Sin información disponible',
            'poster' => isset($details['poster_path'])
                ? "https://image.tmdb.org/t/p/w500" . $details['poster_path']
                : '',
            'puntuacion' => $details['vote_average'] ?? 'N/A',
            'pais' => implode(', ', array_column($details['production_countries'] ?? [], 'name')),
            'idioma' => $details['original_language'] ?? 'Desconocido',
            'tipo' => 'pelicula',
            'videos' => $videos,
            'backdrops' => $imagenes['backdrops'] ?? [],
            'posters' => $imagenes['posters'] ?? [],
        ];

        return view('peliculas.show', compact('pelicula', 'actorImages'));
    }

    // -------------------------
    //   Vista del buscador
    // -------------------------
    public function buscarView()
    {
        return view('buscar');
    }

    // -------------------------
    //   Buscar (AJAX)
    // -------------------------
    public function buscarAjax(Request $request)
    {
        $query = $request->input('q', '');

        // Siempre buscamos usando TMDB
        $marvelCompanies = [420, 38679, 38607];

        // SERIES
        $seriesResponse = Http::get("{$this->tmdbUrl}/search/tv", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES',
            'query' => $query ?: 'a', // búsqueda ancha
        ])->json();

        $series = [];
        foreach ($seriesResponse['results'] ?? [] as $item) {
            $detail = Http::get("{$this->tmdbUrl}/tv/{$item['id']}", [
                'api_key' => $this->tmdbKey,
                'language' => 'es-ES'
            ])->json();

            $companies = array_column($detail['production_companies'] ?? [], 'id');

            if (count(array_intersect($companies, $marvelCompanies)) > 0) {
                $series[] = [
                    'id'    => $detail['id'],
                    'title' => $detail['name'],
                    'poster' => $detail['poster_path']
                        ? "https://image.tmdb.org/t/p/w300{$detail['poster_path']}"
                        : '/images/no-poster.png',
                    'anio'  => substr($detail['first_air_date'] ?? '', 0, 4)
                ];
            }
        }

        // PELÍCULAS
        $moviesResponse = Http::get("{$this->tmdbUrl}/search/movie", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES',
            'query' => $query ?: 'a',
        ])->json();

        $peliculas = [];
        foreach ($moviesResponse['results'] ?? [] as $item) {
            $detail = Http::get("{$this->tmdbUrl}/movie/{$item['id']}", [
                'api_key' => $this->tmdbKey,
                'language' => 'es-ES'
            ])->json();

            $companies = array_column($detail['production_companies'] ?? [], 'id');

            if (count(array_intersect($companies, $marvelCompanies)) > 0) {
                $peliculas[] = [
                    'id'    => $detail['id'],
                    'title' => $detail['title'],
                    'poster' => $detail['poster_path']
                        ? "https://image.tmdb.org/t/p/w300{$detail['poster_path']}"
                        : '/images/no-poster.png',
                    'anio'  => substr($detail['release_date'] ?? '', 0, 4)
                ];
            }
        }

        return response()->json([
            'series' => $series,
            'peliculas' => $peliculas
        ]);
    }

    // -------------------------
    //   Buscar Reseñas (AJAX)
    // -------------------------
    public function buscarAjaxReseñas(Request $request)
    {
        $query = $request->input('q', '');
        $type = $request->input('type', '');

        if ($query === '' || $type === '') {
            return response()->json(['results' => []]);
        }

        $endpoint = $type === 'serie' ? 'search/tv' : 'search/movie';

        $response = Http::get("$this->tmdbUrl/$endpoint", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES',
            'query' => $query
        ])->json();

        $items = $response['results'] ?? [];

        $results = collect($items)->map(function ($item) use ($type) {

            return [
                'id' => $item['id'],
                'title' => $type === 'serie' ? $item['name'] : $item['title'],
                'poster' => $item['poster_path']
                    ? "https://image.tmdb.org/t/p/w300" . $item['poster_path']
                    : '/images/no-poster.png'
            ];
        });

        return response()->json(['results' => $results]);
    }

    // -------------------------
    //   SERIES MARVEL
    // -------------------------
    public function getSeriesData()
    {
        $page = 1;       // página fija (puedes modificar si quieres paginación)
        $perPage = 20;   // número de resultados por página

        // Llamada a TMDB solo para series del MCU usando el mismo keyword
        $response = Http::get("$this->tmdbUrl/discover/tv", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES',
            'page' => $page,
            'with_keywords' => '180547', // Marvel Cinematic Universe
            'include_adult' => false
        ]);

        $data = $response->json();

        if (!isset($data['results'])) {
            return [];
        }

        // Adaptamos los resultados al formato requerido por Blade
        $seriesAdaptadas = [];

        foreach ($data['results'] as $tv) {
            $seriesAdaptadas[] = [
                'id'      => $tv['id'],
                'title'   => $tv['name'] ?? 'Sin título',
                'anio'    => isset($tv['first_air_date']) && $tv['first_air_date']
                    ? substr($tv['first_air_date'], 0, 4)
                    : 'Desconocido',
                'poster'  => $tv['poster_path']
                    ? "https://image.tmdb.org/t/p/w300" . $tv['poster_path']
                    : '/images/no-poster.png',
                'sinopsis' => $tv['overview'] ?? 'Sin información disponible',
            ];
        }

        return $seriesAdaptadas;
    }

    // -------------------------
    //   PELÍCULAS MARVEL
    // -------------------------
    public function getPeliculasData()
    {
        $page = 1;
        $perPage = 20;

        // Películas del MCU usando keyword oficial
        $response = Http::get("$this->tmdbUrl/discover/movie", [
            'api_key' => $this->tmdbKey,
            'language' => 'es-ES',
            'page' => $page,
            'with_keywords' => '180547', // MCU
            'include_adult' => false
        ]);

        $data = $response->json();

        if (!isset($data['results'])) {
            return [];
        }

        $peliculasAdaptadas = [];

        foreach ($data['results'] as $movie) {

            // ---- Obtener IMDb ID ----
            $details = Http::get("$this->tmdbUrl/movie/{$movie['id']}", [
                'api_key' => $this->tmdbKey,
                'language' => 'es-ES'
            ])->json();

            $imdbID = $details['imdb_id'] ?? null;

            $peliculasAdaptadas[] = [
                'id'       => $movie['id'],
                'imdbID'   => $imdbID,   // <<--- YA ESTÁ
                'title'    => $movie['title'] ?? 'Sin título',
                'anio'     => isset($movie['release_date']) && $movie['release_date']
                    ? substr($movie['release_date'], 0, 4)
                    : 'Desconocido',
                'poster' => $movie['poster_path']
                    ? "https://image.tmdb.org/t/p/w300" . $movie['poster_path']
                    : '/images/no-poster.png',
                'sinopsis' => $movie['overview'] ?? 'Sin información disponible',
            ];
        }

        return $peliculasAdaptadas;
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
