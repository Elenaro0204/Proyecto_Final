<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContenidoReportadoMail;
use App\Models\Review;
use App\Models\ReviewReport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReviewReportController extends Controller
{
    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function report(Request $request, Review $review)
    {
        // Evitar reportar varias veces la misma reseña
        if (ReviewReport::where('review_id', $review->id)->where('resolved', false)->exists()) {
            return back()->with('error', 'Esta reseña ya ha sido reportada.');
        }

        $deadline = Carbon::now()->addHours(24); // por ejemplo, 24 horas para modificar

        $report = ReviewReport::create([
            'review_id' => $review->id,
            'reported_by' => Auth::id(),
            'deadline' => $deadline,
        ]);

        // Aquí podrías enviar notificación al autor
        // $review->user->notify(new \App\Notifications\ReviewReported($review, $deadline));

        $autor = $review->autor;

        // URL correcta para la vista
        $url = route('resenas.ver', [
            'id'   => $review->id,
        ]);

        // Enviar correo
        Mail::to($autor->email)->send(new ContenidoReportadoMail($autor, $review, 'resena', $url));

        // Enviar copia al administrador
        Mail::to('soportemarvelpedia@gmail.com')->send(new ContenidoReportadoMail($autor, $review, 'resena', $url));

        return back()->with('success', 'Reseña reportada. El autor puede modificarla en 24 horas.');
    }

    public function store(Request $request, Review $review)
    {

        $request->validate([
            'resolved' => 'required|boolean',
            'deadline' => 'nullable|date|after_or_equal:today',
        ]);

        // Evitar duplicar reportes del mismo usuario
        if (ReviewReport::where('review_id', $review->id)
            ->where('reported_by', Auth::id())
            ->exists()
        ) {
            return back()->with('error', 'Ya has reportado esta reseña.');
        }

        // Crear reporte con una cuenta atrás (por ejemplo, 24 horas)
        ReviewReport::create([
            'review_id' => $review->id,
            'reported_by' => Auth::id(),
            'resolved' => $request->resolved,
            'deadline' => $request->deadline ? Carbon::parse($request->deadline) : Carbon::now()->addHours(24),
        ]);

        // Enviar correo
        Mail::raw(
            "Tu reseña ha sido reportada. Tienes 24 horas para modificarla antes de ser revisada.",
            function ($message) use ($review) {
                $message->to($review->user->email)
                    ->subject('⚠️ Tu reseña ha sido reportada');
            }
        );

        return redirect()->back()->with('success', 'Reporte enviado correctamente.');
    }
}
