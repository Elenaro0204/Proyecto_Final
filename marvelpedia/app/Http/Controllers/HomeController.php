<?php

namespace App\Http\Controllers;

use App\Models\Foro;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {

        $foros = Foro::latest()->take(8)->get()->map(function ($f) {
            return [
                'title' => $f->titulo,
                'text' => Str::limit($f->descripcion ?? '', 100),
                'image' => $f->imagen_portada ?? asset('build/assets/images/foro_placeholder.jpg'),
                'link' => route('foros.show', $f->id),
                'bg_color' => $f->color_fondo ?? '#000',
                'title_color' => $f->color_titulo ?? '#fff',
            ];
        });

        // Formatea los datos para el carrusel
        $resenas = Review::latest()->take(8)->get()->map(function ($r) {
            $titulo = 'Desconocido';
            $imagen = asset('build/assets/images/resena_placeholder.jpg');

            // Cacheamos por entity_id y type para no saturar la API
            $cacheKey = "{$r->type}_{$r->entity_id}";
            $data = Cache::remember($cacheKey, now()->addHours(6), function () use ($r) {
                try {
                    switch ($r->type) {
                        case 'pelicula':
                            $response = Http::get('http://www.omdbapi.com/', [
                                'apikey' => '1f00bd0e',
                                'i' => $r->entity_id
                            ]);
                            return $response->json();
                        case 'serie':
                            $response = Http::get('http://www.omdbapi.com/', [
                                'apikey' => '1f00bd0e',
                                'i' => $r->entity_id,
                                'plot' => 'full'
                            ]);
                            return $response->json();
                        case 'comic':
                            $response = Http::get("https://gateway.marvel.com/v1/public/comics/{$r->entity_id}", [
                                'ts' => '1758626088',
                                'apikey' => '4ce916eb12f534d995b7f03d80470b48',
                                'hash' => 'ae21b0b6b32d7da943ba2a57cb21a70b'
                            ]);
                            return $response->json()['data']['results'][0] ?? [];
                        case 'personaje':
                            $response = Http::get("https://gateway.marvel.com/v1/public/characters/{$r->entity_id}", [
                                'ts' => '1758626088',
                                'apikey' => '4ce916eb12f534d995b7f03d80470b48',
                                'hash' => 'ae21b0b6b32d7da943ba2a57cb21a70b'
                            ]);
                            return $response->json()['data']['results'][0] ?? [];
                    }
                } catch (\Exception $e) {
                    return [];
                }
            });

            // Asignamos los valores según el tipo
            switch ($r->type) {
                case 'pelicula':
                case 'serie':
                    $titulo = $data['Title'] ?? $titulo;
                    $imagen = ($data['Poster'] ?? '') !== 'N/A' ? $data['Poster'] : $imagen;
                    break;
                case 'comic':
                case 'personaje':
                    $titulo = $data['title'] ?? $data['name'] ?? $titulo;
                    $imagen = $data['thumbnail']['path'] ?? ''
                        ? $data['thumbnail']['path'] . '.' . $data['thumbnail']['extension']
                        : $imagen;
                    break;
            }

            return [
                'title' => $titulo,
                'text' => Str::limit($r->content, 100),
                'image' => $imagen,
                'link' => route('resenas.show', ['type' => $r->type, 'id' => $r->entity_id]),
            ];
        });

        return view('welcome', compact('foros', 'resenas'));
    }
}
