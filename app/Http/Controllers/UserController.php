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
    public function index()
    {
        $users = User::paginate(20);
        return view('users.index', compact('users'));
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
