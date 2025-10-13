<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResenaController extends Controller
{
    // Método mínimo para que /resenas funcione
    public function index()
    {
        $resenas = []; // vacío de momento
        return view('resenas.index', compact('resenas'));
    }

    // Método mínimo para que /resenas/{id} funcione
    public function show($id)
    {
        $resena = null; // vacío de momento
        return view('resenas.show', compact('resena'));
    }
}
