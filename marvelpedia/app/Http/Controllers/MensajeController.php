<?php

namespace App\Http\Controllers;

use App\Models\Foro;
use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;

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
        $mensaje = Mensaje::findOrFail($id);
        $this->authorize('update', $mensaje);

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
        $mensaje = Mensaje::findOrFail($id);
        $this->authorize('delete', $mensaje);

        $foroId = $mensaje->foro_id;
        $mensaje->delete();

        return redirect()->route('foros.show', $foroId)
            ->with('success', 'Mensaje eliminado correctamente.');
    }
}
