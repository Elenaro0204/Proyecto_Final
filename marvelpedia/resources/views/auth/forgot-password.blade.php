<!-- marvelpedia/resources/views/auth/forgot-password.blade.php -->

@extends('layouts.guest')

@section('content')
    <div class="mb-4 text-sm text-gray-600">
        {{ __('¿Olvidaste tu contraseña? Introduce tu email y te enviaremos un enlace para restablecerla.') }}
    </div>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email -->
        <div>
            <label for="email">Email</label>
            <input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus>
        </div>

        <div class="flex justify-between mt-4">
            <a href="{{ url()->previous() }}" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">
                Cancelar
            </a>

            <button class="btn btn-primary">
                Enviar enlace
            </button>
        </div>
    </form>
@endsection
