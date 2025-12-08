<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class DescubreController extends Controller
{
    public function index()
    {
        // Crear una instancia de ApiController
        $api = new ApiController();

        // Llamar al método index() del ApiController para obtener todos los datos
        $data = $api->index(); // Esto devuelve una vista, así que necesitamos extraer variables

        // Alternativa: replicar la lógica de index del ApiController aquí para solo pasar los datos
        $series = $api->indexSeries()->getData()['series'] ?? [];
        $peliculas = $api->indexPeliculas()->getData()['peliculas'] ?? [];

        // Pasar todas las variables a la vista de descubre
        return view('descubre.index', compact('series', 'peliculas'));
    }
}
