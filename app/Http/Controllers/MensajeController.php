<?php

namespace App\Http\Controllers;

use App\Events\ContenidoCreado;
use App\Events\ContenidoRespondido;
use App\Mail\ContenidoActualizadoMail;
use App\Mail\ContenidoCreadoMail;
use App\Mail\ContenidoEliminadoMail;
use App\Mail\NuevoMensajeForo;
use App\Models\Foro;
use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

class MensajeController extends Controller
{
    use AuthorizesRequests;

    // Guardar un nuevo mensaje en un foro
    public function store(Request $request)
    {
        $foro = Foro::findOrFail($request->foro_id);

        $request->validate([
            'contenido' => 'required|max:2000',
            'foro_id' => 'required|exists:foros,id',
            'parent_id' => 'nullable|exists:mensajes,id',
        ]);

        $mensaje = Mensaje::create([
            'foro_id' => $foro->id,
            'user_id' => Auth::id(),
            'contenido' => $request->contenido,
            'parent_id' => $request->parent_id,
        ]);

        // Cargar relaciones
        $mensaje->load('autor');

        // Obtener usuario autor del mensaje
        $autor = $mensaje->autor; // fallback

        // Preparar URL (ajusta la ruta según tus rutas)
        $url = route('foros.show', $foro->id);

        // Enviar correo al autor que creó el mensaje
        Mail::to($autor->email)->send(new ContenidoCreadoMail($autor, $mensaje, 'mensaje', $url));

        // Si es respuesta (parent_id), notificar al autor del mensaje padre (si existe y distinto)
        if ($mensaje->parent_id) {
            $parent = Mensaje::with('autor')->find($mensaje->parent_id);
            $parentAuthor = $parent->autor ?? $parent->user ?? null;
            if ($parentAuthor && $parentAuthor->id !== $autor->id && !empty($parentAuthor->email)) {
                // Reutiliza el mismo Mailable o crea uno nuevo (p.e. ContenidoRespondidoMail)
                Mail::to($parentAuthor->email)->send(
                    new ContenidoCreadoMail($parentAuthor, $mensaje, 'respuesta', $url)
                );
            }
        }

        // Obtener propietario del foro
        $propietario = $foro->autor;

        // Si el propietario existe y NO es quien ha escrito el mensaje
        if ($propietario && $propietario->id !== $autor->id) {
            Mail::to($foro->autor->email)->send(
                new NuevoMensajeForo($autor, $foro, $mensaje, $url)
            );
        }

        return redirect()->route('foros.show', $foro->id)->with('success', 'Mensaje publicado correctamente');
    }

    // Editar mensaje
    public function edit($id)
    {
        $mensaje = Mensaje::findOrFail($id);

        // Solo el autor puede editar
        $this->authorize('update', $mensaje);

        return view('mensajes.edit', compact('mensaje'));
    }

    public function update(Request $request, $id)
    {
        $mensaje = Mensaje::with('autor')->findOrFail($id);
        $this->authorize('update', $mensaje);

        $user = $mensaje->autor;
        $url = route('foros.show', $mensaje->foro_id);

        // Enviar email avisando
        Mail::to($user->email)->send(
            new ContenidoActualizadoMail($user, $mensaje, 'mensaje', $url)
        );

        // Copia al admin
        Mail::to('soportemarvelpedia@gmail.com')->send(
            new ContenidoActualizadoMail($user, $mensaje, 'mensaje', $url)
        );

        $request->validate([
            'contenido' => 'required|max:2000',
        ]);

        $mensaje->update([
            'contenido' => $request->contenido,
        ]);

        return redirect()->route('foros.show', $mensaje->foro_id)
            ->with('success', 'Mensaje actualizado correctamente.');
    }

    // Borrar mensaje
    public function destroy($id)
    {
        $mensaje = Mensaje::with('autor')->findOrFail($id);
        $this->authorize('delete', $mensaje);

        $user = $mensaje->autor;

        // Enviar email avisando
        Mail::to($user->email)->send(
            new ContenidoEliminadoMail($user, $mensaje, 'mensaje')
        );

        // Copia al admin
        Mail::to('soportemarvelpedia@gmail.com')->send(
            new ContenidoEliminadoMail($user, $mensaje, 'mensaje')
        );

        $foroId = $mensaje->foro_id;
        $mensaje->delete();

        return redirect()->route('foros.show', $foroId)
            ->with('success', 'Mensaje eliminado correctamente.');
    }

    // Borrar mensaje Administrador
    public function eliminar($id, Request $request)
    {
        $mensaje = Mensaje::with('respuestas', 'autor')->findOrFail($id);

        if ($mensaje->respuestas->count() > 0 && !$request->query('force')) {
            return response()->json([
                'warning' => true,
                'message' => 'Este mensaje tiene respuestas. Si lo eliminas, también se eliminarán las respuestas.'
            ]);
        }

        $user = $mensaje->autor;

        // Enviar email avisando
        Mail::to($user->email)->send(
            new ContenidoEliminadoMail($user, $mensaje, 'mensaje')
        );

        // Copia al admin
        Mail::to('soportemarvelpedia@gmail.com')->send(
            new ContenidoEliminadoMail($user, $mensaje, 'mensaje')
        );

        // Eliminación en cascada
        $mensaje->respuestas()->delete();
        $mensaje->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mensaje eliminado correctamente'
        ]);
    }
}
