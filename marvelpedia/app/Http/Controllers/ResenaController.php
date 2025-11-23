<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ResenaController extends Controller
{
    // Mostrar reseñas de una entidad (película, serie, personaje...)
    public function index(Request $request)
    {
        $query = Review::with('user')->latest();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where('content', 'like', "%{$search}%")
                ->orWhere('type', 'like', "%{$search}%");
        }

        // Usamos paginate para que funcione links()
        $reviews = $query->paginate(10);

        return view('resenas.index', compact('reviews'));
    }

    // Reseñas de una entidad específica
    public function showByEntity($type, $id)
    {
        $reviews = Review::with('user')
            ->where('type', $type)
            ->where('entity_id', $id)
            ->latest()
            ->get();

        return view('resenas.index', compact('reviews'));
    }

    // Mostrar formulario para crear nueva reseña
    public function create(Request $request, $type = null, $entity_id = null)
    {
        $title = $request->query('title');
        $info = null;

        if ($type && $entity_id) {
            $response = Http::get('https://www.omdbapi.com/', [
                'apikey' => env('OMDB_API_KEY'),
                'i' => $entity_id,
            ]);
            $info = $response->json();
        }

        return view('resenas.create', compact('type', 'entity_id', 'title', 'info'));
    }


    // Guardar reseña
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:pelicula,serie,comic',
            'entity_id' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'entity_id' => $request->entity_id,
            'rating' => $request->rating,
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Reseña guardada correctamente');
    }

    public function edit(Review $review)
    {
        if (Auth::id() !== $review->user_id) {
            abort(403, 'No tienes permiso para editar esta reseña.');
        }

        return view('resenas.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        if (Auth::id() !== $review->user_id) {
            abort(403, 'No tienes permiso para actualizar esta reseña.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10',
        ]);

        $review->update([
            'rating' => $request->rating,
            'content' => $request->input('content'),
        ]);

        return redirect()->route('resenas.index')->with('success', 'Reseña actualizada correctamente.');
    }

    public function destroy(Review $review)
    {
        if (Auth::id() !== $review->user_id) {
            abort(403, 'No tienes permiso para eliminar esta reseña.');
        }

        $review->delete();

        return redirect()->route('resenas.index')->with('success', 'Reseña eliminada correctamente.');
    }

    public function report(Review $review)
    {
        // Evitar que el mismo usuario reporte varias veces la misma reseña
        if (!ReviewReport::where('review_id', $review->id)->where('reporter_id', Auth::id())->exists()) {
            ReviewReport::create([
                'review_id' => $review->id,
                'reporter_id' => Auth::id(),
                'expires_at' => now()->addHours(24), // ejemplo de cuenta atrás de 24h
            ]);
        }

        return back()->with('success', 'Reseña reportada correctamente.');
    }
}
