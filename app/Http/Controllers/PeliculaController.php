<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use App\Models\Review;

class PeliculaController extends Controller
{
    protected $apiKey = '1f00bd0e';
    protected $baseUrl = 'http://www.omdbapi.com/';

    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $query = $request->query('search', 'Marvel'); // valor por defecto
        $perPage = 20; // queremos 20 resultados por página

        // OMDb devuelve máximo 10 por página
        $pagesNeeded = ceil($perPage / 10);
        $peliculasArray = [];

        // Traer varias páginas de la API si es necesario
        for ($i = 0; $i < $pagesNeeded; $i++) {
            $res = Http::get($this->baseUrl, [
                'apikey' => $this->apiKey,
                's' => $query,
                'type' => 'movie',
                'page' => $page + $i
            ])->json();

            if (isset($res['Search'])) {
                $peliculasArray = array_merge($peliculasArray, $res['Search']);
            }
        }

        $total = $res['totalResults'] ?? count($peliculasArray);

        // Adaptar datos para Blade
        foreach ($peliculasArray as &$p) {
            $p['poster_path'] = $p['Poster'] != 'N/A' ? $p['Poster'] : '';
            $p['anio'] = $p['Year'] ?? 'Desconocido';
            $p['tipo'] = $p['Type'] ?? 'película';
            $p['sinopsis'] = $p['Plot'] ?? 'Sin información disponible.';
            $p['genero'] = 'Desconocido';
        }

        // Crear paginador de Laravel
        $peliculas = new LengthAwarePaginator(
            array_slice($peliculasArray, 0, $perPage),
            $total,
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

        $response = Http::get($this->baseUrl, [
            'apikey' => $this->apiKey,
            's' => $search,
            'type' => 'movie',
            'page' => 1
        ]);

        $peliculas = $response->json()['Search'] ?? [];

        $resultados = array_map(function ($p) {
            return [
                'id' => $p['imdbID'],
                'imdbID' => $p['imdbID'],
                'title' => $p['Title'],
                'anio' => $p['Year'] ?? 'Desconocido',
                'genero' => $p['Genre'] ?? 'Desconocido',
                'sinopsis' => $p['Plot'] ?? 'Sin información disponible.',
                'poster_path' => $p['Poster'] != 'N/A' ? $p['Poster'] : '/images/no-poster.png',
            ];
        }, $peliculas);

        return response()->json($resultados);
    }

    public function show($id)
    {
        // Llamada a la API para obtener los detalles de la pelicula por ID
        $response = Http::get($this->baseUrl, [
            'apikey' => $this->apiKey,
            'i' => $id,      // ID de IMDb (por ejemplo: tt0944947)
            'plot' => 'full' // Devuelve la sinopsis completa
        ]);

        $data = $response->json();

        // Verificamos si la respuesta fue correcta
        if (!$response->ok() || ($data['Response'] ?? 'False') === 'False') {
            abort(404, 'Pelicula no encontrada');
        }

        // Adaptamos los datos para la vista
        $pelicula = [
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
            'temporadas' => $data['totalSeasons'] ?? 'Desconocido',
            'tipo' => $data['Type'] ?? 'peliculas',
            'imdbID' => $data['imdbID'] ?? 'N/A',
        ];

        // Traducir la sinopsis usando LibreTranslate
        try {
            $translateResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
                'User-Agent' => 'Mozilla/5.0'
            ])->withBody(json_encode([
                'q' => $pelicula['sinopsis'],
                'source' => 'en',
                'target' => 'es',
                'format' => 'text',
                'api_key' => ''
            ]), 'application/json')->post('https://libretranslate.com/translate');

            if ($translateResponse->ok()) {
                $pelicula['sinopsis_es'] = $translateResponse->json()['translatedText'] ?? $pelicula['sinopsis'];
            } else {
                $pelicula['sinopsis_es'] = $pelicula['sinopsis'];
            }
        } catch (\Exception $e) {
            $pelicula['sinopsis_es'] = $pelicula['sinopsis'];
        }

        // Obtener reseñas desde la base de datos
        $reseñas = Review::with('user')
            ->where('entity_id', $id)
            ->where('type', 'pelicula')
            ->latest()
            ->get();

        return view('peliculas.show', compact('pelicula', 'reseñas'));
    }
}
