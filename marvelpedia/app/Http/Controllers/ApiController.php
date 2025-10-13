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
        $comics = Http::get('https://gateway.marvel.com/v1/public/comics', [
            'ts' => $this->ts,
            'apikey' => $this->apikey,
            'hash' => $this->hash
        ])->json()['data']['results'] ?? [];

        $peliculas = Http::get('https://gateway.marvel.com/v1/public/events', [
            'ts' => $this->ts,
            'apikey' => $this->apikey,
            'hash' => $this->hash
        ])->json()['data']['results'] ?? [];

        $personajes = Http::get('http://www.omdbapi.com/', [
            'apikey' => '1f00bd0e',
            's' => 'Marvel',
            'type' => 'movie',
        ])->json()['data']['results'] ?? [];

        $series = Http::get('https://gateway.marvel.com/v1/public/series', [
            'ts' => $this->ts,
            'apikey' => $this->apikey,
            'hash' => $this->hash
        ])->json()['data']['results'] ?? [];

        // Pasar todas las variables a la vista Blade
        return view('descubre.index', compact('comics', 'peliculas', 'personajes', 'series'));
    }


    // 🔹 Mostrar todos los comics
    public function indexComics()
    {
        $response = Http::get('https://gateway.marvel.com/v1/public/comics', [
            'title' => 'Avengers',
            'ts' => $this->ts,
            'apikey' => $this->apikey,
            'hash' => $this->hash
        ]);

        $data = $response->json();
        $comics = $data['data']['results'] ?? [];

        return view('comics.index', compact('comics'));
    }

    // 🔹 Mostrar detalle de un comic específico
    public function showComic($id)
    {
        $response = Http::get("https://gateway.marvel.com/v1/public/comics/{$id}", [
            'ts' => $this->ts,
            'apikey' => $this->apikey,
            'hash' => $this->hash
        ]);

        $data = $response->json();
        $comic = $data['data']['results'][0] ?? null;

        return view('comic.show', compact('comic'));
    }

    // 🔹 Mostrar todas las series
    public function indexSeries()
    {
        $response = Http::get('https://gateway.marvel.com/v1/public/series', [
            'title' => 'Avengers',
            'ts' => $this->ts,
            'apikey' => $this->apikey,
            'hash' => $this->hash
        ]);

        $data = $response->json();
        $series = $data['data']['results'] ?? [];

        return view('series.index', compact('series'));
    }

    // 🔹 Mostrar detalle de una serie específica
    public function showSeries($id)
    {
        $response = Http::get("https://gateway.marvel.com/v1/public/series/{$id}", [
            'ts' => $this->ts,
            'apikey' => $this->apikey,
            'hash' => $this->hash
        ]);

        $data = $response->json();
        $serie = $data['data']['results'][0] ?? null;

        return view('series.show', compact('serie'));
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

    // 🔹 Mostrar todos los personajes
    public function indexPersonajes()
    {
        $response = Http::get('https://gateway.marvel.com/v1/public/characters', [
            'ts' => $this->ts,
            'apikey' => $this->apikey,
            'hash' => $this->hash
        ]);

        $data = $response->json();
        $personajes = $data['data']['results'] ?? [];

        return view('personajes.index', compact('personajes'));
    }

    // 🔹 Mostrar detalle de un personaje específico
    public function showPersonaje($id)
    {
        $response = Http::get("https://gateway.marvel.com/v1/public/characters/{$id}", [
            'ts' => $this->ts,
            'apikey' => $this->apikey,
            'hash' => $this->hash
        ]);

        $data = $response->json();
        $personaje = $data['data']['results'][0] ?? null;

        return view('personaje.show', compact('personaje'));
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

        // Personajes
        $personajes = [];
        if ($query !== '') {
            $response = Http::get('https://gateway.marvel.com/v1/public/characters', [
                'ts' => $this->ts,
                'apikey' => $this->apikey,
                'hash' => $this->hash,
                'nameStartsWith' => $query,
            ]);
            $personajes = $response->json()['data']['results'] ?? [];
        }

        // Cómics
        $comics = [];
        if ($query !== '') {
            $response = Http::get('https://gateway.marvel.com/v1/public/comics', [
                'ts' => $this->ts,
                'apikey' => $this->apikey,
                'hash' => $this->hash,
                'titleStartsWith' => $query,
            ]);
            $comics = $response->json()['data']['results'] ?? [];
        }

        // Series
        $series = [];
        if ($query !== '') {
            $response = Http::get('https://gateway.marvel.com/v1/public/series', [
                'ts' => $this->ts,
                'apikey' => $this->apikey,
                'hash' => $this->hash,
                'titleStartsWith' => $query,
            ]);
            $series = $response->json()['data']['results'] ?? [];
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
            'personajes' => $personajes,
            'comics' => $comics,
            'series' => $series,
            'peliculas' => $peliculas,
        ]);
    }

}
