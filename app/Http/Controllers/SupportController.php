<?php

namespace App\Http\Controllers;

use App\Mail\SoporteMail;
use App\Mail\VerificacionMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SupportController extends Controller
{
    public function enviar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'mensaje' => 'required|string',
        ]);

        Mail::to('soportemarvelpedia@gmail.com')->send(
            new SoporteMail($request->nombre, $request->email, $request->mensaje)
        );

        return back()->with('success', 'Mensaje enviado correctamente');
    }

    public function reenviarVerificacion(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Generar token de verificación manual
        $token = URL::temporarySignedRoute(
            'verification.verify',  // nombre de la ruta de verificación
            Carbon::now()->addMinutes(60), // caduca en 60 min
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        // Envía el correo de verificación
        Mail::to($request->email)->send(
            new VerificacionMail($user, $token)
        );

        return redirect()->route('login')->with('success', 'Usuario registrado. Revisa tu email para verificar tu cuenta.');
    }

    public function verify($token)
    {
        $user = User::where('token_verificacion', $token)->firstOrFail();

        $user->email_verified_at = now();
        $user->token_verificacion = null;
        $user->save();

        return redirect('/profile')->with('verified', true);
    }
}
