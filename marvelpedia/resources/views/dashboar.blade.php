<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <x-profile-header
        :user="Auth::user()"
        bgImage="{{ asset('images/fondo_imagen_inicio.jpeg') }}"
    />

    <div class="container mx-auto py-6">
        <div class="bg-white shadow rounded p-6 mb-6">
            <h2 class="text-2xl font-bold mb-4">👤 Perfil de {{ Auth::user()->name }}</h2>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>

            @if(Auth::user()->nickname)
                <p><strong>Apodo:</strong> {{ Auth::user()->nickname }}</p>
            @endif

            @if(Auth::user()->fecha_nacimiento)
                <p><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse(Auth::user()->fecha_nacimiento)->format('d/m/Y') }}</p>
            @endif

            @if(Auth::user()->twitter)
                <p><strong>Twitter:</strong> <a href="{{ Auth::user()->twitter }}" target="_blank">{{ Auth::user()->twitter}}</a></p>
            @endif

            @if(Auth::user()->instagram)
                <p><strong>Instagram:</strong> <a href="{{ Auth::user()->instagram }}" target="_blank">{{ Auth::user()->instagram }}</a></p>
            @endif

            @if(Auth::user()->pais)
                <p><strong>País:</strong> {{ Auth::user()->pais }}</p>
            @endif

            @if(Auth::user()->favorito_personaje)
                <p><strong>Personaje favorito:</strong> {{ Auth::user()->favorito_personaje }}</p>
            @endif

            @if(Auth::user()->favorito_comic)
                <p><strong>Cómic favorito:</strong> {{ Auth::user()->favorito_comic }}</p>
            @endif

            <p><strong>Fecha de registro:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>
        </div>

        {{-- Aquí luego añadimos secciones dinámicas como reseñas, foros, favoritos --}}
        <div class="bg-gray-100 p-4 rounded shadow">
            <h3 class="text-xl font-semibold mb-2">📌 Actividad Reciente</h3>
            <p>Próximamente reseñas y participación en foros...</p>
        </div>
    </div>
@endsection
