<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Usuarios', 'url' => route('users.index'), 'level' => 1],
        ['label' => $user->name, 'url' => route('users.show', $user->id), 'level' => 2],
    ]" />

    <div class="container mx-auto py-6">

        <!-- TARJETA PRINCIPAL -->
        <section class="relative rounded-xl overflow-hidden shadow-xl p-6">
            <div class="absolute inset-0 bg-white opacity-50 z-0"></div>

            <div class="relative z-10 flex flex-col items-center text-center w-full">
                <h2 class="text-2xl text-red-700 font-bold mb-3 uppercase">Perfil de Usuario</h2>
            </div>

            <!-- CONTENEDOR PRINCIPAL -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-start">

                <!-- COLUMNA 1: FOTO + NOMBRE -->
                <div class="relative z-10 bg-white p-4 rounded-lg shadow h-full flex flex-col items-center">
                    <img src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : asset('images/default-avatar.jpeg') }}"
                        class="rounded-full w-36 h-36 object-cover border-4 border-red-600 shadow-lg">

                    <h3 class="relative z-10 text-2xl font-bold mt-3 text-center md:text-left">
                        {{ $user->name }}
                    </h3>

                    @if ($user->nickname)
                        <p class="italic text-gray-600 text-lg">"{{ $user->nickname }}"</p>
                    @endif
                </div>

                <!-- COLUMNA 2: INFO BÁSICA -->
                <div class="relative z-10 bg-white p-4 rounded-lg shadow h-full space-y-2">
                    @if ($user->bio)
                        <div class="relative z-10 flex flex-col items-center text-center w-full">
                            <h4 class="text-l text-red-700 font-bold mb-3 uppercase">Biografia</h4>
                        </div>
                        <p class="text-gray-700">{{ $user->bio }}</p>
                        <hr>
                    @endif

                    <div class="relative z-10 flex flex-col items-center text-center w-full mt-3">
                        <h4 class="text-l text-red-700 font-bold mb-3 uppercase">Informacion</h4>
                    </div>
                    <p>📅 Miembro desde: <strong>{{ $user->created_at->format('d/m/Y') }}</strong></p>

                    @if ($user->pais)
                        <p>🌍 País: <strong>{{ $user->pais }}</strong></p>
                    @endif

                    @if ($user->fecha_nacimiento)
                        @php
                            $hoy = \Carbon\Carbon::now();
                            $fecha = \Carbon\Carbon::parse($user->fecha_nacimiento);
                            $esCumple = $hoy->format('d-m') === $fecha->format('d-m');
                        @endphp

                        <p><strong>🎂 Nacimiento::</strong> {{ $fecha->format('d/m/Y') }}
                            @if ($esCumple)
                                🎉 ¡Feliz cumpleaños! 🎂
                            @endif
                        </p>
                    @endif

                </div>

                <!-- COLUMNA 3: REDES SOCIALES -->
                <div
                    class="relative z-10 bg-white p-4 rounded-lg shadow h-full flex flex-col items-center md:items-start space-y-3">
                    <div class="relative z-10 flex flex-col items-center text-center w-full">
                        <h4 class="text-l text-red-700 font-bold mb-3 uppercase">Redes Sociales</h4>
                    </div>

                    @if ($user->twitter && $user->instagram)
                        @if ($user->twitter)
                            <a href="{{ $user->twitter }}" target="_blank"
                                class="px-3 py-2 rounded-lg flex items-center gap-2 text-blue-700 font-semibold bg-blue-100 hover:bg-blue-200">
                                <i class="bi bi-twitter"></i> Twitter
                            </a>
                        @endif

                        @if ($user->instagram)
                            <a href="{{ $user->instagram }}" target="_blank"
                                class="px-3 py-2 rounded-lg flex items-center gap-2 text-pink-700 font-semibold bg-pink-100 hover:bg-pink-200">
                                <i class="bi bi-instagram"></i> Instagram
                            </a>
                        @endif
                    @else
                        <p class="text-gray-500 italic">Este usuario está en ASGARD</p>
                    @endif
                </div>

                <!-- COLUMNA 4: ESTADÍSTICAS Y PREFERENCIAS -->
                <div class="relative z-10 bg-white p-4 rounded-lg shadow h-full space-y-3">

                    @if ($user->favorito_personaje)
                        <div>
                            <div class="relative z-10 flex flex-col items-center text-center w-full">
                                <h4 class="text-l text-red-700 font-bold mb-3 uppercase">Preferencias</h4>
                            </div>
                            <p><strong>Personaje favorito:</strong>
                                <span class="text-red-600 font-semibold">{{ $user->favorito_personaje }}</span>
                            </p>
                        </div>

                        <hr>
                    @endif

                    <div>
                        <div class="relative z-10 flex flex-col items-center text-center w-full">
                            <h4 class="text-l text-red-700 font-bold mb-3 uppercase">Estadisticas</h4>
                        </div>
                        <p>📝 Reseñas: <strong>{{ $reseñas->count() }}</strong></p>
                        <p>📢 Foros creados: <strong>{{ $foros->count() }}</strong></p>
                        <p>💬 Mensajes: <strong>{{ $mensajes->count() }}</strong></p>
                    </div>
                </div>

            </div>
        </section>


        <!-- CONTENIDOS DEL USUARIO -->
        <section class="relative rounded-xl overflow-hidden shadow-xl p-6 mt-10">
            <div class="absolute inset-0 bg-white opacity-50 z-0"></div>

            <div class="relative z-10 flex flex-col items-center text-center w-full">
                <h2 class="text-2xl text-red-700 font-bold mb-3 uppercase">Actividad</h2>
            </div>
            @include('users.partials.user_activity') <!-- si prefieres modularlo -->

        </section>
    </div>
@endsection
