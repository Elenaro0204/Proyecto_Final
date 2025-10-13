<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class PersonajeController extends Controller
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
            $params['nameStartsWith'] = $request->search;
        }

        $response = Http::get('https://gateway.marvel.com/v1/public/characters', $params);
        $data = $response->json()['data'] ?? [];
        $personajesArray = $data['results'] ?? [];
        $total = $data['total'] ?? count($personajesArray);

        // 🔹 Traducir descripciones al español de forma segura
        foreach ($personajesArray as &$p) {
            if (!empty($p['description'])) {
                try {
                    $translateResponse = Http::withHeaders([
                        'Content-Type' => 'application/json',
                    ])->post('https://libretranslate.com/translate', [
                        'q' => $p['description'],
                        'source' => 'en',
                        'target' => 'es',
                        'format' => 'text',
                    ]);

                    $p['description_es'] = $translateResponse->json()['translatedText'] ?? $p['description'];
                } catch (\Exception $e) {
                    // Si la API falla, usamos el texto original
                    $p['description_es'] = $p['description'];
                }
            } else {
                $p['description_es'] = '';
            }
        }

        $personajes = new \Illuminate\Pagination\LengthAwarePaginator(
            $personajesArray,
            $total,
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('personajes.index', compact('personajes'));
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

        $response = Http::get('https://gateway.marvel.com/v1/public/characters', [
            'ts' => $ts,
            'apikey' => $apikey,
            'hash' => $hash,
            'nameStartsWith' => $search,
            'limit' => 10, // limitar resultados
        ]);

        $personajes = $response->json()['data']['results'] ?? [];

        // Devolver solo los datos necesarios
        $resultados = array_map(function ($p) {
            return [
                'id' => $p['id'],
                'name' => $p['name'],
            ];
        }, $personajes);

        return response()->json($resultados);
    }

}
