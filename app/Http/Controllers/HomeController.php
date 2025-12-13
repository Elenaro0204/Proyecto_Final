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
        // -------- FOROS ----------
        $foros = Foro::latest()->take(9)->get()->map(function ($f) {
            return [
                'title' => $f->titulo,
                'text' => Str::limit($f->descripcion ?? '', 100),
                'image' => $f->imagen
                    ? asset('/storage/portadas/' . $f->imagen)
                    : asset('images/fondo-foros2.jpg'),
                'link' => route('foros.show', $f->id),
                'bg_color' => $f->color_fondo ?? '#000',
                'title_color' => $f->color_titulo ?? '#fff',
            ];
        });

        // -------- RESEÑAS ----------
        $resenas = Review::latest()->take(9)->get()->map(function ($r) {

            $titulo = 'Desconocido';
            $imagen = asset('images/fondo-resenas.jpg');

            $apiKey = "068f9f8748c67a559a92eafb6a8eeda7";
            $cacheKey = "marvelpedia-cache-{$r->type}_{$r->entity_id}";

            // Cacheamos SOLO el array, no el response
            $data = Cache::remember($cacheKey, now()->addHours(6), function () use ($r, $apiKey) {

                try {
                    if ($r->type === 'pelicula') {
                        $response = Http::get("https://api.themoviedb.org/3/movie/{$r->entity_id}", [
                            'api_key' => $apiKey,
                            'language' => 'es-ES'
                        ]);
                    } elseif ($r->type === 'serie') {
                        $response = Http::get("https://api.themoviedb.org/3/tv/{$r->entity_id}", [
                            'api_key' => $apiKey,
                            'language' => 'es-ES'
                        ]);
                    } else {
                        return null;
                    }

                    if ($response->failed()) {
                        return null;
                    }

                    return $response->json(); // <-- GUARDA SOLO EL ARRAY LIMPIO
                } catch (\Exception $e) {
                    return null;
                }
            });

            // Si hay datos válidos
            if (!empty($data)) {

                // Título diferente en películas y series
                $titulo = $data['title']
                    ?? $data['name']
                    ?? $titulo;

                // Poster si existe
                if (!empty($data['poster_path'])) {
                    $imagen = "https://image.tmdb.org/t/p/w500" . $data['poster_path'];
                }
            }

            return [
                'title' => $titulo,
                'text' => Str::limit($r->content, 100),
                'image' => $imagen,
                'link' => route('resenas.ver', $r->id),
            ];
        });


        return view('welcome', compact('foros', 'resenas'));
    }
}
