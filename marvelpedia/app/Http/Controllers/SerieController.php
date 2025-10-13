<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class SerieController extends Controller
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

        // Obtener series
        $response = Http::get('https://gateway.marvel.com/v1/public/series', $params);
        $data = $response->json()['data'] ?? [];
        $seriesArray = $data['results'] ?? [];
        $total = $data['total'] ?? count($seriesArray);

        // 🔹 Traducir descripciones al español
        foreach ($seriesArray as &$s) {
            if (!empty($s['description'])) {
                try {
                    $translateResponse = Http::withHeaders([
                        'Content-Type' => 'application/json',
                    ])->post('https://libretranslate.com/translate', [
                        'q' => $s['description'],
                        'source' => 'en',
                        'target' => 'es',
                        'format' => 'text',
                    ]);

                    $s['description_es'] = $translateResponse->json()['translatedText'] ?? $s['description'];
                } catch (\Exception $e) {
                    $s['description_es'] = $s['description'];
                }
            } else {
                $s['description_es'] = '';
            }
        }

        // Paginación
        $series = new LengthAwarePaginator(
            $seriesArray,
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

        if (!$search) {
            return response()->json([]);
        }

        $apikey = '4ce916eb12f534d995b7f03d80470b48';
        $hash = 'ae21b0b6b32d7da943ba2a57cb21a70b';
        $ts = '1758626088';

        $response = Http::get('https://gateway.marvel.com/v1/public/series', [
            'ts' => $ts,
            'apikey' => $apikey,
            'hash' => $hash,
            'titleStartsWith' => $search,
            'limit' => 10,
        ]);

        $seriesArray = $response->json()['data']['results'] ?? [];

        $resultados = array_map(function ($s) {
            return [
                'id' => $s['id'],
                'title' => $s['title'],
            ];
        }, $seriesArray);

        return response()->json($resultados);
    }
}
