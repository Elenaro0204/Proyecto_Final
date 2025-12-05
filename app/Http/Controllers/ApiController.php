<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    private $apikey = '4ce916eb12f534d995b7f03d80470b48';
    private $hash = 'ae21b0b6b32d7da943ba2a57cb21a70b';
    private $ts = '1758626088';

    public function index()
    {
        // Obtener datos de la API para cada sección
        $peliculas = Http::get('http://www.omdbapi.com/', [
            'apikey' => '1f00bd0e',
            's' => 'Marvel',
            'type' => 'movie',
        ])->json()['results'] ?? [];

        $series = Http::get('http://www.omdbapi.com/', [
            'apikey' => '1f00bd0e',
            's' => 'Marvel',
            'type' => 'series',
        ])->json()['results'] ?? [];

        // Pasar todas las variables a la vista Blade
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
        // Llamada a OMDb para la información general de la serie
        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => '1f00bd0e',
            'i' => $id,
            'plot' => 'full'
        ]);

        $data = $response->json();

        if (!$response->ok() || ($data['Response'] ?? 'False') === 'False') {
            abort(404, 'Serie no encontrada');
        }

        // Mapear datos para la vista
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

        dd($serie);
        $serie = $response->json();

        // Inicializamos los episodios por temporada
        $episodiosPorTemporada = [];
        $totalSeasons = isset($serie['temporadas']) && is_numeric($serie['temporadas']) ? (int)$serie['temporadas'] : 0;

        for ($s = 1; $s <= $totalSeasons; $s++) {
            $resp = Http::get('http://www.omdbapi.com/', [
                'apikey' => '1f00bd0e',
                'i' => $serie['id'],
                'Season' => $s
            ]);

            $dataSeason = $resp->json();
            $episodiosPorTemporada[$s] = $dataSeason['Episodes'] ?? [];
        }

        dd($episodiosPorTemporada);
        $episodiosPorTemporada = $response->json();

        // Retornar la vista asegurando que todas las variables existen
        return view('series.show', compact('serie', 'episodiosPorTemporada'));
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
        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => '1f00bd0e',
            'i' => $id, // buscar por ID de IMDb
        ]);

        $pelicula = $response->json();

        return view('peliculas.show', compact('pelicula'));
    }

    // Mostrar la vista de búsqueda
    public function buscarView()
    {
        return view('buscar');
    }

    // Endpoint AJAX
    public function buscarAjax(Request $request)
    {
        $query = $request->input('q', '');

        // Series
        $series = [];
        if ($query !== '') {
            $response = Http::get('http://www.omdbapi.com/', [
                'apikey' => '1f00bd0e',
                's' => $query,
                'type' => 'series',
            ]);
            $series = $response->json()['Search'] ?? [];
        }

        // Películas (OMDB)
        $peliculas = [];
        if ($query !== '') {
            $response = Http::get('http://www.omdbapi.com/', [
                'apikey' => '1f00bd0e',
                's' => $query,
                'type' => 'movie',
            ]);
            $peliculas = $response->json()['Search'] ?? [];
        }

        return response()->json([
            'series' => $series,
            'peliculas' => $peliculas,
        ]);
    }

    // Endpoint AJAX para buscar por tipo y texto
    public function buscarAjaxReseñas(Request $request)
    {
        $query = $request->input('q', '');
        $type = $request->input('type', '');

        if ($query === '' || $type === '') {
            return response()->json(['results' => []]);
        }

        $results = [];

        switch ($type) {
            case 'serie':
            case 'pelicula':
                $response = Http::get('http://www.omdbapi.com/', [
                    'apikey' => '1f00bd0e',
                    's' => $query,
                    'type' => $type === 'serie' ? 'series' : 'movie',
                ]);
                $results = $response->json()['Search'] ?? [];
                break;
        }

        return response()->json(['results' => $results]);
    }

    public function getSeriesData()
    {
        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => '1f00bd0e',
            's' => 'Marvel',
            'type' => 'series',
        ]);

        return $response->json()['Search'] ?? [];
    }

    public function getPeliculasData()
    {
        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => '1f00bd0e',
            's' => 'Marvel',
            'type' => 'movie',
        ]);

        return $response->json()['Search'] ?? [];
    }
}
