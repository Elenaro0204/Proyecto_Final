<?php

namespace App\Http\Controllers;

use App\Models\Foro;
use App\Models\ForoReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ForoController extends Controller
{
    // Listar todos los foros
    public function index()
    {
        $user = Auth::user();

        // Trae los foros junto con el usuario que los creó
        $foros = Foro::query()
            ->when($user, function ($query, $user) {
                // Usuario logueado: puede ver foros públicos, sus propios foros y los privados si es admin
                $query->where('visibilidad', 'publico')
                    ->orWhere('user_id', $user->id)
                    ->orWhere(function ($q) use ($user) {
                        if ($user->rol === 'admin') {
                            $q->where('visibilidad', 'privado');
                        }
                    });
            }, function ($query) {
                // Usuario no logueado: solo foros públicos
                $query->where('visibilidad', 'publico');
            })
            ->latest()
            ->paginate(9);

        return view('foros.index', compact('foros'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('foros.create');
    }

    // Guardar un nuevo foro
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Foro::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('foros.index')->with('success', 'Foro creado correctamente.');
    }

    // Ver un foro con sus mensajes
    public function show($id)
    {
        $foro = Foro::findOrFail($id);

        $user = Auth::user();

        if ($foro->visibilidad === 'privado') {
            if (!$user || ($user->id !== $foro->user_id && $user->rol !== 'admin')) {
                abort(403, 'No tienes permiso para ver este foro.');
            }
        }

        $mensajes = $foro->mensajes()
            ->with('autor')
            ->orderBy('created_at', 'asc')
            ->paginate(15);

        return view('foros.show', compact('foro', 'mensajes'));
    }

    public function report(Foro $foro)
    {
        // Evitar que el mismo usuario reporte varias veces la misma reseña
        if (!ForoReport::where('foro_id', $foro->id)->where('reporter_id', Auth::id())->exists()) {
            ForoReport::create([
                'foro_id' => $foro->id,
                'reporter_id' => Auth::id(),
                'expires_at' => now()->addHours(24), // ejemplo de cuenta atrás de 24h
            ]);
        }

        return back()->with('success', 'Reseña reportada correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Foro $foro)
    {
        // Verifica que el usuario sea el propietario
        if (Auth::id() !== $foro->user_id) {
            abort(403, 'No tienes permiso para editar este foro.');
        }

        return view('foros.edit', compact('foro'));
    }

    // Actualizar el foro
    public function update(Request $request, Foro $foro)
    {
        if (Auth::id() !== $foro->user_id) {
            abort(403);
        }

        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'color_fondo' => 'nullable|string',
            'color_titulo' => 'nullable|string',
            'imagen_portada' => 'nullable|image|max:2048',
            'visibilidad' => 'required|in:publico,privado',
        ]);

        // Subir nueva imagen si existe
        if ($request->hasFile('imagen_portada')) {
            if ($foro->imagen_portada) {
                Storage::delete($foro->imagen_portada);
            }
            $data['imagen_portada'] = $request->file('imagen_portada')->store('portadas');
        }

        // Eliminar imagen si se marcó
        if ($request->has('eliminar_imagen')) {
            if ($foro->imagen_portada) {
                Storage::delete($foro->imagen_portada);
            }
            $data['imagen_portada'] = null;
        }

        $foro->update($data);

        return redirect()->route('foros.show', $foro->id)
            ->with('success', 'Foro actualizado correctamente.');
    }
}
