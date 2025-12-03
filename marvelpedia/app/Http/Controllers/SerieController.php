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

    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $query = $request->query('search', 'Marvel'); // valor por defecto
        $perPage = 20;

        // OMDb devuelve máximo 10 por página
        $pagesNeeded = ceil($perPage / 10);
        $seriesArray = [];

        for ($i = 0; $i < $pagesNeeded; $i++) {
            $response = Http::get($this->baseUrl, [
                'apikey' => $this->apiKey,
                's' => $query,
                'type' => 'series',
                'page' => $page + $i
            ])->json();

            if (isset($response['Search'])) {
                $seriesArray = array_merge($seriesArray, $response['Search']);
            }
        }

        $total = $response['totalResults'] ?? count($seriesArray);

        // Adaptar datos para Blade
        foreach ($seriesArray as &$p) {
            $p['poster_path'] = $p['Poster'] != 'N/A' ? $p['Poster'] : '';
            $p['anio'] = $p['Year'] ?? 'Desconocido';
            $p['tipo'] = $p['Type'] ?? 'película';
            $p['description_es'] = $p['description_es'] ?? 'Sin información disponible.';
            $p['genero'] = 'Desconocido';
        }

        $series = new LengthAwarePaginator(
            array_slice($seriesArray, 0, $perPage),
            $total,
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

        $resultados = array_map(function ($s) {
            return [
                'id' => $s['imdbID'],
                'imdbID' => $s['imdbID'],
                'title' => $s['Title'],
                'anio' => $s['Year'] ?? 'Desconocido',
                'poster_path' => $s['Poster'] != 'N/A' ? $s['Poster'] : '/images/no-poster.png',
            ];
        }, $series);

        return response()->json($resultados);
    }

    public function show($id)
    {
        // Llamada a la API para obtener los detalles de la serie por ID
        $response = Http::get($this->baseUrl, [
            'apikey' => $this->apiKey,
            'i' => $id,
            'plot' => 'full'
        ]);

        $data = $response->json();

        if (!$response->ok() || ($data['Response'] ?? 'False') === 'False') {
            abort(404, 'Serie no encontrada');
        }

        // Adaptar datos
        $serie = [
            'id' => $data['imdbID'],
            'titulo' => $data['Title'] ?? 'Sin título',
            'anio' => $data['Year'] ?? 'Desconocido',
            'genero' => $data['Genre'] ?? 'Desconocido',
            'director' => $data['Director'] ?? 'Desconocido',
            'actores' => $data['Actors'] ?? 'Desconocido',
            'sinopsis' => $data['Plot'] ?? 'Sin información disponible.',
            'poster' => ($data['Poster'] ?? '') !== 'N/A' ? $data['Poster'] : '',
            'puntuacion' => $data['imdbRating'] ?? 'N/A',
            'pais' => $data['Country'] ?? 'Desconocido',
            'idioma' => $data['Language'] ?? 'Desconocido',
            'temporadas' => $data['totalSeasons'] ?? 0,
            'tipo' => $data['Type'] ?? 'series',
            'imdbID' => $data['imdbID'] ?? 'N/A',
        ];

        // IMÁGENES DE LOS ACTORES
        $serie['actores_imagenes'] = [];
        if (!empty($data['Actors'])) {
            $apiKeyTMDB = env('TMDB_API_KEY'); // añade tu TMDB API Key en .env
            foreach (explode(',', $data['Actors']) as $actor) {
                $actor = trim($actor);
                $img = 'https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png';

                // Buscar actor en TMDB
                $resp = Http::get('https://api.themoviedb.org/3/search/person', [
                    'api_key' => $apiKeyTMDB,
                    'query' => $actor
                ]);

                if ($resp->ok() && !empty($resp['results'])) {
                    $img = 'https://image.tmdb.org/t/p/w200' . $resp['results'][0]['profile_path'];
                }

                $serie['actores_imagenes'][$actor] = $img;
            }
        }

        // Reseñas de BD
        $reseñas = Review::with('user')
            ->where('entity_id', $id)
            ->where('type', 'serie')
            ->latest()
            ->get();

        // Episodios por temporada
        $episodiosPorTemporada = [];

        for ($s = 1; $s <= (int)$data['totalSeasons']; $s++) {
            $responseSeason = Http::get($this->baseUrl, [
                'apikey' => $this->apiKey,
                'i' => $id,
                'Season' => $s
            ]);

            $dataSeason = $responseSeason->json();
            $episodios = $dataSeason['Episodes'] ?? [];

            // Obtener información completa de cada episodio
            foreach ($episodios as $key => $ep) {
                $epResp = Http::get($this->baseUrl, [
                    'apikey' => $this->apiKey,
                    'i' => $ep['imdbID'],
                    'plot' => 'full'
                ]);
                $episodios[$key] = $epResp->json();
            }

            $episodiosPorTemporada[$s] = $episodios;
        }

        return view('series.show', compact('serie', 'reseñas', 'episodiosPorTemporada'));
    }
}
