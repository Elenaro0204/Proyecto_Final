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
        $foros = Foro::latest()->take(8)->get()->map(function ($f) {
            return [
                'title' => $f->titulo,
                'text' => Str::limit($f->descripcion ?? '', 100),
                'image' => $f->imagen
                    ? asset('/storage/portadas/' . $f->imagen)
                    : asset('images/fondo-foros.jpg'),
                'link' => route('foros.show', $f->id),
                'bg_color' => $f->color_fondo ?? '#000',
                'title_color' => $f->color_titulo ?? '#fff',
            ];
        });

        // -------- RESEÑAS ----------
        $resenas = Review::latest()->take(8)->get()->map(function ($r) {

            $titulo = 'Desconocido';
            $imagen = asset('images/fondo-resenas.jpeg');

            // Cacheamos por 6h
            $cacheKey = "{$r->type}_{$r->entity_id}";
            $data = Cache::remember($cacheKey, now()->addHours(6), function () use ($r) {
                try {
                    // Cambia estas URLs si tus endpoints son otros
                    if ($r->type === 'pelicula') {
                        return Http::get("https://marvelpedia.ruix.iesruizgijon.es/api/peliculas/{$r->entity_id}")->json();
                    }

                    if ($r->type === 'serie') {
                        return Http::get("https://marvelpedia.ruix.iesruizgijon.es/api/series/{$r->entity_id}")->json();
                    }
                } catch (\Exception $e) {
                    return [];
                }
            });

            // Asignamos los valores
            if (!empty($data)) {
                $titulo = $data['titulo'] ?? $titulo;

                $imagenApi = $data['imagen'] ?? null;

                if ($imagenApi && $imagenApi !== 'N/A') {
                    // Si tu API devuelve nombres de archivo locales
                    if (!Str::startsWith($imagenApi, 'http')) {
                        $imagen = asset('storage/portadas/' . $imagenApi);
                    } else {
                        // Si devuelve URL completa
                        $imagen = $imagenApi;
                    }
                }
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
