<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContenidoReportadoMail;
use App\Models\Foro;
use App\Models\ForoReport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ForoReportController extends Controller
{
    /**
     * Reportar un foro desde el usuario (botón "Reportar")
     */
    public function report(Request $request, Foro $foro)
    {
        // Evitar reportes duplicados mientras el caso siga abierto
        if (ForoReport::where('foro_id', $foro->id)->where('resolved', false)->exists()) {
            return back()->with('error', 'Este foro ya ha sido reportado.');
        }

        $deadline = Carbon::now()->addHours(24); // Tiempo para que el autor modifique

        ForoReport::create([
            'foro_id' => $foro->id,
            'reported_by' => Auth::id(),
            'deadline' => $deadline,
        ]);

        // Notificar al autor del foro
        // $foro->user->notify(new \App\Notifications\ForoReported($foro, $deadline));

        $autor = $foro->autor;
        $url = route('foros.show', $foro->id);

        Mail::to($autor->email)->send(new ContenidoReportadoMail($autor, $foro, 'foro', $url));

        // Enviar copia al administrador
        Mail::to('soportemarvelpedia@gmail.com')->send(new ContenidoReportadoMail($autor, $foro, 'foro', $url));

        return back()->with('success', 'Foro reportado. El autor tiene 24 horas para revisarlo.');
    }

    /**
     * Crear reporte desde la vista admin/addreport
     */
    public function store(Request $request, Foro $foro)
    {
        $request->validate([
            'resolved' => 'required|boolean',
            'deadline' => 'nullable|date|after_or_equal:today',
        ]);

        // Evitar que el mismo usuario reporte el mismo foro dos veces
        if (ForoReport::where('foro_id', $foro->id)
            ->where('reported_by', Auth::id())
            ->exists()
        ) {
            return back()->with('error', 'Ya has reportado este foro.');
        }

        ForoReport::create([
            'foro_id' => $foro->id,
            'reported_by' => Auth::id(),
            'resolved' => $request->resolved,
            'deadline' => $request->deadline
                ? Carbon::parse($request->deadline)
                : Carbon::now()->addHours(24),
        ]);

        // Enviar email al autor del foro
        Mail::raw(
            "Tu foro ha sido reportado. Tienes 24 horas para revisarlo o modificarlo.",
            function ($message) use ($foro) {
                $message->to($foro->user->email)
                    ->subject('⚠️ Tu foro ha sido reportado');
            }
        );

        return redirect()->back()->with('success', 'Reporte del foro enviado correctamente.');
    }
}
