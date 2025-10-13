<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class ComicController extends Controller
{
    public function index(Request $request)
    {
        $apikey = '4ce916eb12f534d995b7f03d80470b48';
        $hash = 'ae21b0b6b32d7da943ba2a57cb21a70b';
        $ts = '1758626088';

        $page = $request->query('page', 1);
        $perPage = 12;
        $offset = ($page - 1) * $perPage;

        $params = [
            'ts' => $ts,
            'apikey' => $apikey,
            'hash' => $hash,
            'limit' => $perPage,
            'offset' => $offset,
        ];

        if ($request->filled('search')) {
            $params['titleStartsWith'] = $request->search;
        }

        // Obtener comics
        $response = Http::get('https://gateway.marvel.com/v1/public/comics', $params);
        $data = $response->json()['data'] ?? [];
        $comicsArray = $data['results'] ?? [];
        $total = $data['total'] ?? count($comicsArray);

        // 🔹 Traducir descripciones al español
        foreach ($comicsArray as &$c) {
            if (!empty($c['description'])) {
                try {
                    $translateResponse = Http::withHeaders([
                        'Content-Type' => 'application/json',
                    ])->post('https://libretranslate.com/translate', [
                        'q' => $c['description'],
                        'source' => 'en',
                        'target' => 'es',
                        'format' => 'text',
                    ]);

                    $c['description_es'] = $translateResponse->json()['translatedText'] ?? $c['description'];
                } catch (\Exception $e) {
                    $c['description_es'] = $c['description'];
                }
            } else {
                $c['description_es'] = '';
            }
        }

        // Paginación
        $comics = new LengthAwarePaginator(
            $comicsArray,
            $total,
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('comics.index', compact('comics'));
    }

    public function buscar(Request $request)
    {
        $search = $request->query('q');

        if (!$search) {
            return response()->json([]);
        }

        $apikey = '4ce916eb12f534d995b7f03d80470b48';
        $hash = 'ae21b0b6b32d7da943ba2a57cb21a70b';
        $ts = '1758626088';

        $response = Http::get('https://gateway.marvel.com/v1/public/comics', [
            'ts' => $ts,
            'apikey' => $apikey,
            'hash' => $hash,
            'titleStartsWith' => $search,
            'limit' => 10,
        ]);

        $comicsArray = $response->json()['data']['results'] ?? [];

        $resultados = array_map(function ($c) {
            return [
                'id' => $c['id'],
                'title' => $c['title'],
            ];
        }, $comicsArray);

        return response()->json($resultados);
    }
}
