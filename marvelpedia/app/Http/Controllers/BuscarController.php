<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BuscarController extends Controller
{
    private $omdbKey = '1f00bd0e';

    // Página con resultados por defecto
    public function index()
    {
        $request = new Request(['q' => 'Marvel']);
        $defaultResults = $this->buscar($request)->getData(true);

        return view('buscar', [
            'defaultResults' => $defaultResults
        ]);
    }

    // 🔍 Endpoint AJAX
    public function buscar(Request $request)
    {
        $q = $request->query('q', 'Marvel');

        // --- Películas
        try {
            $moviesResp = Http::get('http://www.omdbapi.com/', [
                'apikey' => $this->omdbKey,
                's' => $q,
                'type' => 'movie',
            ]);

            $moviesRaw = $moviesResp->json()['Search'] ?? [];
        } catch (\Exception $e) {
            $moviesRaw = [];
        }

        $peliculas = array_map(fn($m) => [
            'id' => $m['imdbID'] ?? null,
            'title' => $m['Title'] ?? 'Sin título',
            'year' => $m['Year'] ?? '',
            'poster' => ($m['Poster'] ?? null) !== 'N/A' ? $m['Poster'] : null,
        ], $moviesRaw);

        // --- Filtrar solo Marvel
        $peliculas = array_filter($peliculas, fn($m) => str_contains(strtolower($m['title']), 'marvel'));

        // --- Series
        try {
            $seriesResp = Http::get('http://www.omdbapi.com/', [
                'apikey' => $this->omdbKey,
                's' => $q,
                'type' => 'series',
            ]);

            $seriesRaw = $seriesResp->json()['Search'] ?? [];
        } catch (\Exception $e) {
            $seriesRaw = [];
        }

        $series = array_map(fn($s) => [
            'id' => $s['imdbID'] ?? null,
            'title' => $s['Title'] ?? 'Sin título',
            'year' => $s['Year'] ?? '',
            'poster' => ($s['Poster'] ?? null) !== 'N/A' ? $s['Poster'] : null,
        ], $seriesRaw);

        // --- Filtrar solo Marvel
        $series = array_filter($series, fn($s) => str_contains(strtolower($s['title']), 'marvel'));

        return response()->json([
            'peliculas' => $peliculas,
            'series' => $series,
        ]);
    }
}
