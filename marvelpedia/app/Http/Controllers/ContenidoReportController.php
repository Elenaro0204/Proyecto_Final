<?php

namespace App\Http\Controllers;

use App\Mail\ContenidoReportadoMail;
use App\Models\Mensaje;
use App\Models\MensajeReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContenidoReportController extends Controller
{
    public function store(Request $request)
    {
        $mensaje = Mensaje::findOrFail($request->mensaje_id);

        // crear registro del reporte
        MensajeReport::create([
            'mensaje_id' => $mensaje->id,
            'reported_by' => Auth::id(),
            'reason' => $request->reason
        ]);

        // obtener al dueño del contenido
        $owner = $mensaje->user;

        // enviar correo
        Mail::to($owner->email)
            ->send(new ContenidoReportadoMail($owner, $mensaje, Auth::user()));

        return back()->with('success', 'El mensaje ha sido reportado.');
    }
}
