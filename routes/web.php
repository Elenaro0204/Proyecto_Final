<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AyudaController;
use App\Http\Controllers\DescubreController;
use App\Http\Controllers\ForoController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\ResenaController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\SupportController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Index Route
Route::get('/', [HomeController::class, 'index'])->name('inicio');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->middleware('guest')
    ->name('register');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile Management
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/eliminar', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::prefix('admin')
    ->middleware(['auth', IsAdmin::class, 'verified']) // se pasa la clase directamente
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/manage-content', [AdminController::class, 'manageContent'])->name('manage-content');

        // Reseñas
        Route::get('review/{review}/report/view', [AdminController::class, 'viewReportResena'])->name('resenas.viewreport');
        Route::get('review/{review}/report', [AdminController::class, 'showReportFormResenas'])->name('resenas.addreport');
        Route::post('review/{review}/report', [AdminController::class, 'storeReportResenas'])->name('resenas.report.store');
        Route::delete('/admin/review/reports/{report}/cancel', [AdminController::class, 'cancelReportResena'])
            ->name('resenas.report.cancel');

        // Foros
        Route::get('foro/{foro}/report/view', [AdminController::class, 'viewReportForo'])->name('foros.viewreport');
        Route::get('foro/{foro}/report', [AdminController::class, 'showReportFormForos'])->name('foros.addreport');
        Route::post('foro/{foro}/report', [AdminController::class, 'storeReportForos'])->name('foros.report.store');
        Route::delete('/admin/foro/reports/{report}/cancel', [AdminController::class, 'cancelReportForo'])
            ->name('foro.report.cancel');
        Route::get('foros/{foro}/mensajes', [AdminController::class, 'mensajesForo'])
            ->name('foros.mensajes');

        // Mensajes
        Route::get('mensaje/{mensaje}/report/view', [AdminController::class, 'viewReportMensaje'])->name('mensajes.viewreport');
        Route::get('mensaje/{mensaje}/report', [AdminController::class, 'showReportFormMensajes'])->name('mensajes.addreport');
        Route::post('mensaje/{mensaje}/report', [AdminController::class, 'storeReportMensajes'])->name('mensajes.report.store');
        Route::delete('/admin/mensaje/report/{report}/cancel', [AdminController::class, 'cancelReportMensaje'])->name('mensajes.report.cancel');

        // Usuarios
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('edit-user'); // Formulario edición
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('update-user');   // Guardar cambios
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('delete-user'); // Eliminar usuario
    });

// Resource Controllers
Route::get('/descubre', [ApiController::class, 'index'])->name('descubre');

Route::get('/peliculas', [PeliculaController::class, 'index'])->name('peliculas.index');
Route::get('/pelicula/{id}', [PeliculaController::class, 'show'])->name('pelicula.show');
Route::get('/peliculas/buscar', [PeliculaController::class, 'buscar'])->name('peliculas.buscar');

Route::get('/series', [SerieController::class, 'index'])->name('series');
Route::get('/serie/{id}', [SerieController::class, 'show'])->name('serie.show');
Route::get('/series/buscar', [SerieController::class, 'buscar'])->name('series.buscar');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/resenas/create', [ResenaController::class, 'create'])->name('resenas.create');
    Route::get('/resenas/create/{type?}/{entity_id?}', [ResenaController::class, 'create'])
        ->name('resenas.create.withparams');
    Route::post('/resenas/{type}/{id}', [ResenaController::class, 'showByEntity'])->name('resenas.showresena');
    Route::post('/resenas', [ResenaController::class, 'store'])->name('resenas.store');

    Route::get('/resenas/{id}/edit', [ResenaController::class, 'edit'])->name('resenas.edit');
    Route::put('/resenas/{id}/update', [ResenaController::class, 'update'])->name('resenas.update');
    Route::delete('/resenas/{id}/eliminar', [ResenaController::class, 'destroy'])->name('resenas.destroy');

    // Foros
    Route::get('/foros/create', [ForoController::class, 'create'])->name('foros.create');
    Route::get('/foro/create/{type?}/{entity_id?}', [ForoController::class, 'create'])
        ->name('foro.create.withparams');
    Route::post('/foro/{type}/{id}', [ForoController::class, 'showByEntity'])->name('foro.show');
    Route::post('/foros', [ForoController::class, 'store'])->name('foros.store');
    Route::get('/foros/{foro}/edit', [ForoController::class, 'edit'])->name('foros.edit');
    Route::put('/foros/{foro}', [ForoController::class, 'update'])->name('foros.update');
    Route::delete('/foros/{id}/eliminar', [ForoController::class, 'destroy'])->name('foros.destroy');

    // Mensajes
    Route::post('/mensajes', [MensajeController::class, 'store'])->name('mensajes.store');
    Route::get('/mensajes/{mensaje}/edit', [MensajeController::class, 'edit'])->name('mensajes.edit');
    Route::put('/mensajes/{mensaje}', [MensajeController::class, 'update'])->name('mensajes.update');
    Route::delete('/mensajes/{mensaje}', [MensajeController::class, 'destroy'])->name('mensajes.destroy');
    Route::delete('/mensajes/{mensaje}/eliminar', [MensajeController::class, 'eliminar'])->name('mensajes.eliminar');
});

Route::get('/resenas', [ResenaController::class, 'index'])->name('resenas');
Route::get('/resenas/{type}/{id}', [ResenaController::class, 'show'])->name('resenas.show');
Route::get('/resenas/{id}', [ResenaController::class, 'showResena'])->name('resenas.ver');

Route::get('/foros', [ForoController::class, 'index'])->name('foros.index');
Route::get('/foros/{foro}', [ForoController::class, 'show'])->name('foros.show');

// Route::get('/buscar', [BuscarController::class, 'index'])->name('buscar');
Route::get('/buscar', [ApiController::class, 'buscarView'])->name('buscar'); // página de búsqueda
Route::get('/api/buscar', [ApiController::class, 'buscarAjax'])->name('buscar.ajax'); // endpoint AJAX
Route::get('/api/buscar/resenas', [ApiController::class, 'buscarAjaxReseñas'])->name('buscar.ajax.resenas'); // endpoint AJAX para reseñas

Route::get('/ayuda', [AyudaController::class, 'index'])->name('ayuda');
Route::get('/ayuda/buscar', [AyudaController::class, 'index'])->name('ayuda.buscar');

//Email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/profile');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Se ha reenviado el enlace de verificación.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{token}', [SupportController::class, 'verify'])
    ->name('email.verify.custom');

// Enviar mensaje de soporte
Route::post('/support/enviar', [SupportController::class, 'enviar'])->name('support.enviar');

require __DIR__ . '/auth.php';
