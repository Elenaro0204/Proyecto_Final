<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BuscarController extends Controller
{
    private $marvelKey = '4ce916eb12f534d995b7f03d80470b48';
    private $marvelHash = 'ae21b0b6b32d7da943ba2a57cb21a70b';
    private $marvelTs = '1758626088';
    private $omdbKey = '1f00bd0e';

    // ✅ Página de búsqueda
    public function index()
    {
        // Simplemente cargamos la vista, el JS hará la búsqueda
        return view('buscar');
    }

    // 🔹 Endpoint AJAX de búsqueda
    public function buscar(Request $request)
    {
        $q = $request->query('q', '');
        $limit = (int) $request->query('limit', 8);

        // --- Marvel: personajes
        try {
            $params = [
                'ts' => $this->marvelTs,
                'apikey' => $this->marvelKey,
                'hash' => $this->marvelHash,
                'limit' => $limit,
            ];
            if ($q !== '') $params['nameStartsWith'] = $q;

            $resp = Http::get('https://gateway.marvel.com/v1/public/characters', $params);
            $chars = $resp->json()['data']['results'] ?? [];
        } catch (\Exception $e) {
            $chars = [];
        }

        $personajes = array_map(fn($p) => [
            'id' => $p['id'] ?? null,
            'name' => $p['name'] ?? 'Sin nombre',
            'thumbnail' => isset($p['thumbnail']) ? ($p['thumbnail']['path'] . '.' . $p['thumbnail']['extension']) : null,
            'description' => $p['description'] ?? '',
        ], $chars);

        // --- Marvel: comics
        try {
            $params = [
                'ts' => $this->marvelTs,
                'apikey' => $this->marvelKey,
                'hash' => $this->marvelHash,
                'limit' => $limit,
            ];
            if ($q !== '') $params['titleStartsWith'] = $q;

            $resp = Http::get('https://gateway.marvel.com/v1/public/comics', $params);
            $comicsRaw = $resp->json()['data']['results'] ?? [];
        } catch (\Exception $e) {
            $comicsRaw = [];
        }

        $comics = array_map(fn($c) => [
            'id' => $c['id'] ?? null,
            'title' => $c['title'] ?? 'Sin título',
            'thumbnail' => isset($c['thumbnail']) ? ($c['thumbnail']['path'] . '.' . $c['thumbnail']['extension']) : null,
            'description' => $c['description'] ?? '',
        ], $comicsRaw);

        // --- Marvel: series
        try {
            $params = [
                'ts' => $this->marvelTs,
                'apikey' => $this->marvelKey,
                'hash' => $this->marvelHash,
                'limit' => $limit,
            ];
            if ($q !== '') $params['titleStartsWith'] = $q;

            $resp = Http::get('https://gateway.marvel.com/v1/public/series', $params);
            $seriesRaw = $resp->json()['data']['results'] ?? [];
        } catch (\Exception $e) {
            $seriesRaw = [];
        }

        $series = array_map(fn($s) => [
            'id' => $s['id'] ?? null,
            'title' => $s['title'] ?? 'Sin título',
            'thumbnail' => isset($s['thumbnail']) ? ($s['thumbnail']['path'] . '.' . $s['thumbnail']['extension']) : null,
            'description' => $s['description'] ?? '',
        ], $seriesRaw);

        // --- OMDB: películas
        try {
            $omdbResp = Http::get('http://www.omdbapi.com/', [
                'apikey' => $this->omdbKey,
                's' => $q ?: 'Marvel',
                'type' => 'movie',
            ]);
            $moviesRaw = $omdbResp->json()['Search'] ?? [];
        } catch (\Exception $e) {
            $moviesRaw = [];
        }

        $peliculas = array_map(fn($m) => [
            'imdbID' => $m['imdbID'] ?? null,
            'Title' => $m['Title'] ?? 'Sin título',
            'Year' => $m['Year'] ?? '',
            'Poster' => ($m['Poster'] ?? null) !== 'N/A' ? $m['Poster'] : null,
        ], $moviesRaw);

        // Retornar todo en JSON
        return response()->json([
            'personajes' => $personajes,
            'comics' => $comics,
            'series' => $series,
            'peliculas' => $peliculas,
        ]);
    }
}
