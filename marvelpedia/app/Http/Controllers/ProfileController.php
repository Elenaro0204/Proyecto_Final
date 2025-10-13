<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show(Request $request): View
    {
        return view('dashboar', [
            'user' => $request->user(),
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
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar_url' => 'nullable|url|max:255',
            'bio' => 'nullable|string|max:1000',
            'fecha_nacimiento' => 'nullable|date',
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
        $user->avatar_url = $request->avatar_url;
        $user->bio = $request->bio;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->twitter = $request->twitter;
        $user->instagram = $request->instagram;
        $user->pais = $request->pais;
        $user->favorito_personaje = $request->favorito_personaje;
        $user->favorito_comic = $request->favorito_comic;

        // Guardar en la base de datos
        $request->user()->save();

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
