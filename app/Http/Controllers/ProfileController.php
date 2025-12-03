<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */

    public function show(Request $request): View
    {
        $user = $request->user();

        // Reseñas paginadas
        $reseñas = $user->reviews()
            ->latest()
            ->paginate(5, ['*'], 'reseñas_page');

        // Mensajes paginados
        $mensajes = $user->mensajes()
            ->with(['foro', 'respuestas']) // 'respuestas' es la relación de respuestas de un mensaje
            ->latest()
            ->get()
            ->groupBy(fn($m) => $m->foro_id); // agrupa por foro

        // Foros donde el usuario ha participado
        $forosParticipa  = $user->forosParticipa()
            ->with(['mensajes' => function ($q) use ($user) {
                $q->where('user_id', $user->id)->latest();
            }])
            ->get();

        // Traer info de OMDb para cada reseña
        foreach ($reseñas as $resena) {
            if ($resena->entity_id) {
                $response = Http::get('https://www.omdbapi.com/', [
                    'apikey' => env('OMDB_API_KEY'),
                    'i' => $resena->entity_id,
                ]);
                $info = $response->json();
                $resena->titulo_pelicula = $info['Title'] ?? 'Título no disponible';
            } else {
                $resena->titulo_pelicula = 'Título no disponible';
            }
        }

        return view('dashboar', [
            'user' => $user,
            'reseñas' => $reseñas,
            'mensajes' => $mensajes,
            'foros' => $forosParticipa,
        ]);
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar_url' => 'nullable|image|max:2048',
            'bio' => 'nullable|string|max:1000',
            'fecha_nacimiento' => 'nullable|date|before_or_equal:today',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'pais' => 'nullable|string|max:255',
            'favorito_personaje' => 'nullable|string|max:255',
            'favorito_comic' => 'nullable|string|max:255',
        ]);

        // Asignar los valores
        $user->name = $request->name;
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->twitter = $request->twitter;
        $user->instagram = $request->instagram;
        $user->pais = $request->pais;
        $user->favorito_personaje = $request->favorito_personaje;
        $user->favorito_comic = $request->favorito_comic;

        // Primero eliminar si se ha solicitado
        if ($request->has('delete_avatar')) {
            if ($user->avatar_url && file_exists(public_path($user->avatar_url))) {
                unlink(public_path($user->avatar_url));
            }
            $user->avatar_url = null;
        }

        // Luego subir nueva foto si se ha enviado
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = $file->store('avatars', 'public'); // guarda en storage/app/public/avatars
            $user->avatar_url = '/storage/' . $path; // ruta pública
        }

        // Guardar en la base de datos
        $user->save();

        return redirect()->route('dashboard')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
