<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Index Route
Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// Profile Management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resource Controllers
Route::get('/personajes', [PersonajeController::class, 'index'])->name('personajes');
Route::get('/comics', [ComicController::class, 'index'])->name('comics');
Route::get('/peliculas', [PeliculaController::class, 'index'])->name('peliculas');
Route::get('/series', [SerieController::class, 'index'])->name('series');
Route::get('/resenas/{id}', [ResenaController::class, 'show'])->name('resenas.show');
Route::get('/foros/{id}', [ResenaController::class, 'show'])->name('foros.show');
Route::get('/ayuda', [SerieController::class, 'index'])->name('ayuda');


require __DIR__.'/auth.php';
