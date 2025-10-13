<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForoController extends Controller
{
    public function index()
    {
        $foros = [];
        return view('foros.index', compact('foros'));
    }

    public function show($id)
    {
        $foro = null;
        return view('foros.show', compact('foro'));
    }
}
