<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class DescubreController extends Controller
{
    public function index()
    {
        $api = new ApiController();

        $series = $api->getSeriesData();
        $peliculas = $api->getPeliculasData();

        return view('descubre.index', compact('series', 'peliculas'));
    }
}
