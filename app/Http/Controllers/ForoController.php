<?php

namespace App\Http\Controllers;

use App\Mail\ContenidoActualizadoMail;
use App\Mail\ContenidoCreadoMail;
use App\Mail\ContenidoEliminadoMail;
use App\Models\Foro;
use App\Models\ForoReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ForoController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Consulta base aplicando permisos
        $query = Foro::query()
            ->where(function ($q) use ($user) {
                $q->where('visibilidad', 'publico');

                if ($user) {
                    $q->orWhere('user_id', $user->id);

                    if ($user->rol === 'admin') {
                        $q->orWhere('visibilidad', 'privado');
                    }
                }
            });

        // Filtro por título
        if ($request->filled('search')) {
            $query->where('titulo', 'like', '%' . $request->search . '%');
        }

        // Filtro por visibilidad
        if ($request->filled('visibilidad')) {
            if ($request->visibilidad === 'privado') {
                // Solo se muestran privados del usuario actual
                $query->where('visibilidad', 'privado')
                    ->where('user_id', $user->id);
            } else {
                $query->where('visibilidad', $request->visibilidad);
            }
        }

        // Orden
        switch ($request->orden) {
            case 'antiguos':
                $query->orderBy('created_at', 'asc');
                break;
            case 'comentados':
                $query->withCount('mensajes')->orderBy('mensajes_count', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $foros = $query->paginate(12)->withQueryString();

        // Respuesta AJAX
        if ($request->ajax()) {
            // Solo devuelve la lista parcial
            return view('foros.partials.foros-list', ['foros' => $foros])->render();
        }

        return view('foros.index', ['foros' => $foros]);
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
            'color_fondo' => 'nullable|string|max:255',
            'color_titulo' => 'nullable|string|max:7',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'visibilidad' => 'required|in:publico,privado',
        ]);

        $data = [
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'color_fondo' => $request->color_fondo,
            'color_titulo' => $request->color_titulo,
            'visibilidad' => $request->visibilidad,
            'user_id' => Auth::id(),
        ];

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $path = $file->store('portadas', 'public');
            $data['imagen'] =  basename($path);
        }

        $foro = Foro::create($data);

        $foro->load('autor');
        $autor = $foro->autor;
        $url = route('foros.show', $foro->id);

        Mail::to($autor->email)->send(new ContenidoCreadoMail($autor, $foro, 'foro', $url));

        // Enviar copia al administrador
        Mail::to('soportemarvelpedia@gmail.com')->send(new ContenidoCreadoMail($autor, $foro, 'foro', $url));

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
            'imagen' => 'nullable|image|max:2048',
            'visibilidad' => 'required|in:publico,privado',
        ]);

        // Subir nueva imagen si existe
        if ($request->hasFile('imagen')) {
            // Eliminar la antigua si existe
            if ($foro->imagen && file_exists(public_path($foro->imagen))) {
                unlink(public_path($foro->imagen));
            }
            $file = $request->file('imagen');
            $path = $file->store('portadas', 'public');
            $data['imagen'] =  basename($path);
        }

        // Eliminar imagen si se marcó
        if ($request->has('eliminar_imagen')) {
            if ($foro->imagen && file_exists(public_path($foro->imagen))) {
                unlink(public_path($foro->imagen));
            }
            $data['imagen'] = null;
        }

        $user = $foro->autor;
        $url = route('foros.show', $foro->id);

        // Enviar email avisando
        Mail::to($user->email)->send(
            new ContenidoActualizadoMail($user, $foro, 'foro', $url)
        );

        // Copia al admin
        Mail::to('soportemarvelpedia@gmail.com')->send(
            new ContenidoActualizadoMail($user, $foro, 'foro', $url)
        );

        $foro->update($data);

        return redirect()->route('foros.show', $foro->id)
            ->with('success', 'Foro actualizado correctamente.');
    }

    public function destroy($id)
    {
        $foro = Foro::with('autor')->findOrFail($id);

        $user = $foro->autor;

        // Enviar email avisando
        Mail::to($user->email)->send(
            new ContenidoEliminadoMail($user, $foro, 'foro')
        );

        // Copia al admin
        Mail::to('soportemarvelpedia@gmail.com')->send(
            new ContenidoEliminadoMail($user, $foro, 'foro')
        );

        $foro->delete();

        return redirect()->back()->with('success', 'Foro eliminado correctamente');
    }
}
