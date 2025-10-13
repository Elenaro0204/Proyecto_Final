<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AyudaController;
use App\Http\Controllers\BuscarController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\DescubreController;
use App\Http\Controllers\ForoController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\PersonajeController;
use App\Http\Controllers\ResenaController;
use App\Http\Controllers\SerieController;

// Index Route
Route::get('/', function () {
    return view('welcome');
})->name('inicio');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])
     ->middleware('guest')
     ->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/registre', [AuthController::class, 'showRegisterForm'])
     ->middleware('guest')
     ->name('registre');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboar');
})->middleware(['auth'])->name('dashboard');


// Profile Management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/eliminar', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resource Controllers
Route::get('/descubre', [DescubreController::class, 'index'])->name('descubre');

Route::get('/personajes', [PersonajeController::class, 'index'])->name('personajes');
Route::get('/persoanje/{id}', [PersonajeController::class, 'show'])->name('personaje.show');

Route::get('/comics', [ComicController::class, 'index'])->name('comics');
Route::get('/comic/{id}', [ComicController::class, 'show'])->name('comic.show');

Route::get('/peliculas', [PeliculaController::class, 'index'])->name('peliculas');
Route::get('/pelicula/{id}', [PeliculaController::class, 'show'])->name('pelicula.show');

Route::get('/series', [SerieController::class, 'index'])->name('series');
Route::get('/serie/{id}', [SerieController::class, 'show'])->name('serie.show');

Route::get('/resenas', [ResenaController::class, 'index'])->name('resenas');
Route::get('/resenas/{id}', [ResenaController::class, 'show'])->name('resenas.show');

Route::get('/foros', [ForoController::class, 'index'])->name('foros');
Route::get('/foros/{id}', [ForoController::class, 'show'])->name('foros.show');

// Route::get('/buscar', [BuscarController::class, 'index'])->name('buscar');
Route::get('/buscar', [ApiController::class, 'buscarView'])->name('buscar.index'); // página de búsqueda
Route::get('/api/buscar', [ApiController::class, 'buscarAjax'])->name('buscar'); // endpoint AJAX

Route::get('/ayuda', [AyudaController::class, 'index'])->name('ayuda');


require __DIR__.'/auth.php';
