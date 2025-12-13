<?php

namespace App\Http\Controllers;

use App\Models\Foro;
use App\Models\Mensaje;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Buscar por nombre
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filtrar por país
        if ($request->filled('pais')) {
            $query->where('pais', $request->pais);
        }

        $users = $query->paginate(8);

        // Últimos usuarios (paginación)
        $ultimos_usuarios = User::orderBy('created_at', 'desc')
            ->paginate(8, ['*'], 'ultimos_page');

        // Usuarios con más reseñas
        $topResenas = User::withCount('reviews')
            ->orderBy('reviews_count', 'desc')
            ->take(5)
            ->get();

        // Usuarios con más foros
        $topForos = User::withCount('foros')
            ->orderBy('foros_count', 'desc')
            ->take(5)
            ->get();

        // Usuarios con más mensajes
        $topMensajes = User::withCount('mensajes')
            ->orderBy('mensajes_count', 'desc')
            ->take(5)
            ->get();

        // Lista de países únicos del sistema
        $paises = User::whereNotNull('pais')->distinct()->pluck('pais');

        return view('users.index', compact('users', 'ultimos_usuarios', 'paises', 'topResenas', 'topForos', 'topMensajes'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        // Paginaciones independientes
        $reseñas = Review::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'reseñasPage');

        $foros = Foro::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'forosPage');

        $mensajes = Mensaje::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'mensajesPage');

        return view('users.show', compact('user', 'reseñas', 'foros', 'mensajes'));
    }
}
