<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class PeliculaController extends Controller
{
    protected $apiKey = '1f00bd0e';
    protected $baseUrl = 'http://www.omdbapi.com/';

    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $query = $request->query('search', 'Marvel'); // valor por defecto

        $response = Http::get($this->baseUrl, [
            'apikey' => $this->apiKey,
            's' => $query,
            'type' => 'movie',
            'page' => $page
        ]);

        $data = $response->json();
        $peliculasArray = $data['Search'] ?? [];
        $total = isset($data['totalResults']) ? (int)$data['totalResults'] : count($peliculasArray);

        // Adaptar datos para Blade
        foreach ($peliculasArray as &$p) {
            $p['poster_path'] = $p['Poster'] != 'N/A' ? $p['Poster'] : '';
            $p['description_es'] = '';
        }

        $peliculas = new LengthAwarePaginator(
            $peliculasArray,
            $total,
            12, // items por página
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
                'title' => $p['Title'],
            ];
        }, $peliculas);

        return response()->json($resultados);
    }
}
