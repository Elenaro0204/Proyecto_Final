<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeUserMail;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('profile', absolute: false) . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));

            // Enviar email al dueño
            Mail::to($request->user()->email)->send(
                new WelcomeUserMail($request->user())
            );

            // Copia al admin
            Mail::to("soportemarvelpedia@gmail.com")->send(
                new WelcomeUserMail($request->user())
            );
        }

        return redirect()->intended(route('profile', absolute: false) . '?verified=1');
    }
}
