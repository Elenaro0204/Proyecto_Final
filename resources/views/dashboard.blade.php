<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Perfil', 'url' => route('profile'), 'level' => 1],
    ]" />

    <x-profile-header :user="Auth::user()" bgImage="{{ asset('images/fondo_imagen_inicio.jpg') }}" />

    <div class="container mx-auto py-6">
        <section class="relative rounded-xl overflow-hidden shadow-xl p-6 mb-6">
            <div class="absolute inset-0 bg-white opacity-50 z-0"></div>

            <div class="relative z-10 flex flex-col items-center text-center w-full">
                <h2 class="text-2xl text-red-700 font-bold mb-3 uppercase">Perfil de {{ Auth::user()->name }}</h2>
            </div>

            <!-- CONTENEDOR PRINCIPAL -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-start">

                <!-- COLUMNA 1: FOTO + NOMBRE -->
                <div
                    class="relative z-10 bg-white p-4 rounded-lg shadow h-full
                    flex flex-col items-center">
                    <img src="{{ Auth::user()->avatar_url ? asset('storage/' . Auth::user()->avatar_url) : asset('images/default-avatar.jpeg') }}"
                        class="rounded-full w-36 h-36 object-cover border-4 border-red-600 shadow-lg">

                    <h3 class="relative z-10 text-2xl font-bold mt-3 text-center md:text-left">
                        {{ Auth::user()->name }}
                    </h3>

                    @if (Auth::user()->nickname)
                        <p class="italic text-gray-600 text-lg">"{{ Auth::user()->nickname }}"</p>
                    @endif

                    <p class="italic text-gray-600 text-m">{{ Auth::user()->email }}</p>
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
                        <p>🎂 Nacimiento:
                            <strong>{{ \Carbon\Carbon::parse($user->fecha_nacimiento)->format('d/m/Y') }}</strong>
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
        </section>

        <!-- Opciones de administrador -->
        @if (Auth::user()->role === 'admin')
            <section class="relative rounded-2xl overflow-hidden shadow-xl p-6 mb-6 ">
                <div class="absolute inset-0 bg-white opacity-50 z-0"></div>

                <div class="relative z-10 flex flex-col items-center text-center w-full mb-6">
                    <h2 class="text-3xl text-red-700 font-extrabold uppercase tracking-wide">
                        Panel de Administrador
                    </h2>
                    <p class="text-gray-600 mt-2">Acceso rápido a las herramientas de gestión</p>
                </div>

                <ul class="relative z-10 space-y-4">

                    <!-- Gestionar usuarios -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-4 p-4 bg-white rounded-xl shadow hover:shadow-md transition border border-gray-200 hover:bg-gray-50">
                            <i class="fas fa-users-cog text-red-600 text-2xl"></i>
                            <span class="text-blue-700 font-semibold hover:underline text-lg">
                                Gestionar usuarios
                            </span>
                        </a>
                    </li>

                    <!-- Gestionar contenido -->
                    <li>
                        <a href="{{ route('admin.manage-content') }}"
                            class="flex items-center gap-4 p-4 bg-white rounded-xl shadow hover:shadow-md transition border border-gray-200 hover:bg-gray-50">
                            <i class="fas fa-folder-open text-red-600 text-2xl"></i>
                            <span class="text-blue-700 font-semibold hover:underline text-lg">
                                Gestionar contenido
                            </span>
                        </a>
                    </li>

                </ul>

            </section>
        @endif

        <!-- ACTIVIDAD RECIENTE -->
        <section class="relative rounded-2xl overflow-hidden shadow-2xl p-6 mb-6">
            <div class="absolute inset-0 bg-white opacity-50 z-0"></div>

            <!-- Título -->
            <div class="relative z-10 text-center mb-6">
                <h2 class="text-3xl font-extrabold text-red-700 uppercase drop-shadow-sm">
                    Actividad Reciente
                </h2>
                <p class="text-gray-600 text-sm">Resumen de tu actividad en la plataforma</p>
            </div>

            <!-- CONTENEDOR GENERAL -->
            <div class="space-y-6">

                <!-- RESEÑAS -->
                <div x-data="{ openResenas: {} }"
                    class="relative z-10 bg-white p-4 rounded-xl shadow-md border border-gray-200 hover:shadow-lg transition">

                    <div class="relative z-10 flex flex-col items-center text-center w-full">
                        <h3 class="text-xl text-red-700 font-bold mb-3 uppercase">Tus Reseñas</h3>
                    </div>

                    @forelse ($reseñas as $resena)
                        <div class="border border-gray-200 rounded-lg bg-gray-50 mb-3 shadow-sm">

                            <button @click="openResenas[{{ $resena->id }}] = !openResenas[{{ $resena->id }}]"
                                class="w-full flex justify-between items-center px-4 py-3 text-red-700 font-semibold hover:bg-gray-100 transition rounded-lg">

                                <span>{{ $resena->titulo_pelicula }}</span>
                                <i class="fas fa-chevron-down transition-transform"
                                    :class="openResenas[{{ $resena->id }}] ? 'rotate-180' : ''"></i>
                            </button>

                            <div x-show="openResenas[{{ $resena->id }}]" x-collapse
                                class="px-5 py-3 text-gray-700 space-y-1">
                                <p><strong>⭐ Calificación:</strong> {{ $resena->rating }}/5</p>
                                <p><strong>💬 Comentario:</strong> {{ $resena->content }}</p>
                                <p class="text-gray-500 text-xs">{{ $resena->created_at->diffForHumans() }}</p>
                                <div class="flex justify-between mt-4">
                                    <a href="{{ route('resenas.ver', $resena->id) }}"
                                        class="px-4 py-2 bg-yellow-400 text-red-800 font-semibold rounded-lg hover:bg-yellow-500 transition">
                                        Ver
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 italic">No has escrito reseñas aún.</p>
                    @endforelse

                    <div class="mt-4 overflow-x-auto">
                        {{ $reseñas->appends(['mensajes_page' => request('mensajes_page')])->links() }}
                    </div>
                </div>

                <!-- MENSAJES EN FOROS -->
                <div x-data="{ openForos: {} }"
                    class="relative z-10 bg-white p-4 rounded-xl shadow-md border border-gray-200 hover:shadow-lg transition">

                    <div class="relative z-10 flex flex-col items-center text-center w-full">
                        <h3 class="text-xl text-red-700 font-bold mb-3 uppercase">
                            Tus Mensajes
                        </h3>
                    </div>

                    @forelse ($mensajes as $foro_id => $mensajesForo)
                        <div class="border border-gray-200 rounded-lg bg-gray-50 mb-3 shadow-sm">

                            <button @click="openForos[{{ $foro_id }}] = !openForos[{{ $foro_id }}]"
                                class="w-full flex justify-between items-center px-4 py-3 text-red-700 font-semibold hover:bg-gray-100 transition rounded-lg">

                                <span>Foro: {{ $mensajesForo[0]->foro->titulo ?? 'Foro eliminado' }}</span>
                                <i class="fas fa-chevron-down transition-transform"
                                    :class="openForos[{{ $foro_id }}] ? 'rotate-180' : ''"></i>
                            </button>

                            <div x-show="openForos[{{ $foro_id }}]" x-collapse class="px-5 py-3 space-y-4">
                                @foreach ($mensajesForo as $mensaje)
                                    <div class="border-l-4 border-red-300 pl-4">
                                        <p class="text-gray-700">{{ $mensaje->contenido }}</p>
                                        <p class="text-gray-400 text-xs">{{ $mensaje->created_at->diffForHumans() }}</p>

                                        <div class="flex justify-between mt-4">
                                            <a href="{{ route('foros.show', $mensaje->foro_id) }}"
                                                class="px-4 py-2 bg-yellow-400 text-red-800 font-semibold rounded-lg hover:bg-yellow-500 transition">
                                                Ver
                                            </a>
                                        </div>

                                        @foreach ($mensaje->respuestas as $res)
                                            <div class="ml-4 mt-2 border-l-2 border-indigo-200 pl-3 text-gray-600 text-sm">
                                                <p>{{ $res->contenido }}</p>
                                                <span
                                                    class="text-gray-400 text-xs">{{ $res->created_at->diffForHumans() }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 italic">No has enviado mensajes recientemente.</p>
                    @endforelse

                    <div class="mt-3 overflow-x-auto">
                        {{ $mensajes->links() }}
                    </div>
                </div>

                <!-- FOROS DEL USUARIO -->
                <div x-data="{ panelForos: {} }"
                    class="relative z-10 bg-white p-4 rounded-xl shadow-md border border-gray-200 hover:shadow-lg transition">

                    <div class="relative z-10 flex flex-col items-center text-center w-full">
                        <h3 class="text-xl text-red-700 font-bold mb-3 uppercase">Tus Foros
                        </h3>
                    </div>

                    @forelse ($foros as $foro)
                        <div class="border border-gray-200 rounded-lg bg-gray-50 mb-3 shadow-sm">

                            <button @click="panelForos[{{ $foro->id }}] = !panelForos[{{ $foro->id }}]"
                                class="w-full flex justify-between items-center px-4 py-3 text-red-700 font-semibold hover:bg-gray-100 transition rounded-lg">

                                <span>{{ $foro->titulo }}</span>
                                <i class="fas fa-chevron-down transition-transform"
                                    :class="panelForos[{{ $foro->id }}] ? 'rotate-180' : ''"></i>
                            </button>

                            <div x-show="panelForos[{{ $foro->id }}]" x-collapse
                                class="px-4 py-3 text-gray-700 space-y-3">

                                <p>{{ $foro->descripcion }}</p>
                                <p class="text-gray-500 text-xs">Creado: {{ $foro->created_at->format('d/m/Y H:i') }}</p>

                                <div class="flex justify-between mt-4">
                                    <a href="{{ route('foros.show', $foro->id) }}"
                                        class="px-4 py-2 bg-yellow-400 text-red-800 font-semibold rounded-lg hover:bg-yellow-500 transition">
                                        Ver
                                    </a>
                                </div>

                                <!-- Mensajes del foro -->
                                <div class="ml-2 space-y-2 border-l-2 border-red-300 pl-3">
                                    @foreach ($foro->mensajes as $mensaje)
                                        <div class="bg-white p-2 rounded border border-gray-200 shadow-sm">

                                            <p class="font-semibold">
                                                <a href="{{ route('users.show', $mensaje->user->id) }}"
                                                    class="text-red-600">
                                                    {{ $mensaje->user->name }}:
                                                </a>
                                                {{ Str::limit($mensaje->contenido, 50) }}
                                            </p>

                                            @foreach ($mensaje->respuestas as $respuesta)
                                                <p class="ml-4 text-gray-600 text-sm">
                                                    <strong class="text-red-500">
                                                        <a
                                                            href="{{ route('users.show', $respuesta->user->id) }}">{{ $respuesta->user->name }}:</a>
                                                    </strong>
                                                    {{ $respuesta->contenido }}
                                                </p>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 italic">No participas en ningún foro todavía.</p>
                    @endforelse

                    <div class="mt-3 overflow-x-auto">
                        {{ $foros->links() }}
                    </div>
                </div>

            </div>
        </section>

    </div>
@endsection

@section('styles')
    <style>
        a:hover {
            filter: brightness(1.2);
            transform: scale(1.05);
        }
    </style>
@endsection
