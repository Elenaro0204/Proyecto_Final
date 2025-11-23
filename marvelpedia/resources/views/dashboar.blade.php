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


            @if(Auth::user()->pais)
                <p><strong>País:</strong> {{ Auth::user()->pais }}</p>
            @endif

            @if(Auth::user()->favorito_personaje)
                <p><strong>Personaje favorito:</strong> {{ Auth::user()->favorito_personaje }}</p>
            @endif

            @if(Auth::user()->favorito_comic)
                <p><strong>Cómic favorito:</strong> {{ Auth::user()->favorito_comic }}</p>
            @endif

            @if(Auth::user()->twitter && Auth::user()->instagram)
                <div class="d-flex justify-content-center justify-content-md-start gap-2 m-2">

                    @if(Auth::user()->twitter)
                        <a href="{{ Auth::user()->twitter }}" target="_blank"
                        class="px-3 py-1 rounded-pill d-flex align-items-center gap-2"
                        style="background:rgba(29, 155, 240, 0.2); border:1px solid rgba(29, 155, 240, 0.5); text-decoration:none; transition:0.3s;">
                            <i class="bi bi-twitter"></i> <span>Twitter</span>
                        </a>
                    @endif

                    @if(Auth::user()->instagram)
                        <a href="{{ Auth::user()->instagram }}" target="_blank"
                        class="px-3 py-1 rounded-pill d-flex align-items-center gap-2"
                        style="background:rgba(225, 48, 108, 0.2); border:1px solid rgba(225, 48, 108, 0.5); text-decoration:none; transition:0.3s;">
                            <i class="bi bi-instagram"></i> <span>Instagram</span>
                        </a>
                    @endif

                </div>
            @endif

            <p><strong>Fecha de registro:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>

        </div>

        <!-- Opciones de administrador -->
        @if(Auth::user()->role === 'admin')
            <div class="mt-6 bg-blue-50 p-4 rounded shadow mb-6">
                <h3 class="text-xl font-semibold mb-2">⚙️ Panel de Administrador</h3>
                <ul class="list-disc ml-5">
                    <li><a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">Ver todos los usuarios</a></li>
                    <li><a href="{{ route('admin.manage-content') }}" class="text-blue-600 hover:underline">Gestionar contenido</a></li>
                    <li><a href="{{ route('admin.reports') }}" class="text-blue-600 hover:underline">Ver reportes</a></li>
                    <li><a href="{{ route('admin.settings') }}" class="text-blue-600 hover:underline">Configuración del sitio</a></li>
                </ul>
            </div>
        @endif

        {{-- Aquí luego añadimos secciones dinámicas como reseñas, foros, favoritos --}}
        <div class="bg-gray-100 p-4 rounded shadow">
            <h3 class="text-xl font-semibold mb-2">📌 Actividad Reciente</h3>
            <p>Próximamente reseñas y participación en foros...</p>
        </div>
    </div>
@endsection


<style>
    a:hover {
        filter: brightness(1.2);
        transform: scale(1.05);
    }

</style>
