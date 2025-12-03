<!-- resources/views/auth/verify-email.blade.php -->

@extends('layouts.guest')

@section('content')
    <h1 class="text-xl font-semibold text-gray-800 mb-4 text-center">
        ¡Verifica tu correo electrónico!
    </h1>

    <p class="text-sm text-gray-600 mb-6">
        {{ __('¡Gracias por registrarte! Antes de comenzar, por favor verifica tu dirección de correo electrónico haciendo clic en el enlace que te enviamos. Si no recibiste el correo, podemos enviarte otro.') }}
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-3 bg-green-100 text-green-800 rounded-lg text-sm">
            {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row gap-4 justify-between">
        <form method="POST" action="{{ route('verification.send') }}" class="flex-1">
            @csrf
            <x-primary-button class="w-full">
                {{ __('Reenviar correo de verificación') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="flex-1">
            @csrf
            <button type="submit"
                class="w-full underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Cerrar sesión') }}
            </button>
        </form>
    </div>
@endsection
