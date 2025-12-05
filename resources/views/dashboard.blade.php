<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Perfil', 'url' => route('profile'), 'level' => 1],
    ]" />

    <x-profile-header :user="Auth::user()" bgImage="{{ asset('images/fondo_imagen_inicio.jpeg') }}" />

    <div class="container mx-auto py-6">
        <div class="bg-white p-5 rounded shadow space-y-6 mb-6">
            <h2 class="text-2xl font-bold mb-4">👤 Perfil de {{ Auth::user()->name }}</h2>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>

            @if (Auth::user()->nickname)
                <p><strong>Apodo:</strong> {{ Auth::user()->nickname }}</p>
            @endif

            @if (Auth::user()->fecha_nacimiento)
                @php
                    $hoy = \Carbon\Carbon::now();
                    $fecha = \Carbon\Carbon::parse(Auth::user()->fecha_nacimiento);
                    $esCumple = $hoy->format('d-m') === $fecha->format('d-m');
                @endphp

                <p><strong>Fecha de nacimiento:</strong> {{ $fecha->format('d/m/Y') }}
                    @if ($esCumple)
                        🎉 ¡Feliz cumpleaños! 🎂
                    @endif
                </p>
            @endif

            @if (Auth::user()->pais)
                <p><strong>País:</strong> {{ Auth::user()->pais }}</p>
            @endif

            @if (Auth::user()->favorito_personaje)
                <p><strong>Personaje favorito:</strong> {{ Auth::user()->favorito_personaje }}</p>
            @endif

            {{-- @if (Auth::user()->favorito_comic)
                <p><strong>Cómic favorito:</strong> {{ Auth::user()->favorito_comic }}</p>
            @endif --}}

            @if (Auth::user()->twitter && Auth::user()->instagram)
                <div class="d-flex justify-content-center justify-content-md-start gap-2 m-2">

                    @if (Auth::user()->twitter)
                        <a href="{{ Auth::user()->twitter }}" target="_blank"
                            class="px-3 py-1 rounded-pill d-flex align-items-center gap-2"
                            style="background:rgba(29, 155, 240, 0.2); border:1px solid rgba(29, 155, 240, 0.5); text-decoration:none; transition:0.3s;">
                            <i class="bi bi-twitter"></i> <span>Twitter</span>
                        </a>
                    @endif

                    @if (Auth::user()->instagram)
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
        @if (Auth::user()->role === 'admin')
            <div class="bg-blue-50 p-5 rounded shadow space-y-6 mb-6">
                <h3 class="text-xl font-semibold mb-2">⚙️ Panel de Administrador</h3>
                <ul class="list-disc ml-5">
                    <li><a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">Ver todos los
                            usuarios</a></li>
                    <li><a href="{{ route('admin.manage-content') }}" class="text-blue-600 hover:underline">Gestionar
                            contenido</a></li>
                </ul>
            </div>
        @endif

        <!-- Actividad reciente -->
        <div class="bg-gray-100 p-5 rounded shadow space-y-6 mb-6">
            <h3 class="text-xl font-bold mb-4">📌 Actividad Reciente</h3>

            {{-- RESEÑAS --}}
            <div x-data="{ openResenas: {} }" class="bg-white p-4 rounded shadow">
                <h4 class="text-l font-bold mb-4">
                    📝 Tus Reseñas
                </h4>

                <div x-show="openResenas" x-transition class="mt-4 space-y-4">
                    @forelse ($reseñas as $resena)
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <button @click="openResenas[{{ $resena->id }}] = !openResenas[{{ $resena->id }}]"
                                class="w-full flex justify-between items-center font-semibold text-indigo-600 text-lg hover:bg-gray-100 px-3 py-2 rounded">
                                <span>{{ $resena->titulo_pelicula }}</span>
                                <span x-text="openResenas[{{ $resena->id }}] ? '▲' : '▼'"></span>
                            </button>

                            <div x-show="openResenas[{{ $resena->id }}]" x-transition
                                class="mt-2 ml-4
                                text-gray-700 bg-gray-50 p-3 rounded-lg shadow-inner">
                                <p><strong>Calificación:</strong> {{ $resena->rating }}/10</p>
                                <p><strong>Comentario:</strong> {{ $resena->content }}</p>
                                <p class="text-gray-500 text-sm mt-1">({{ $resena->created_at->diffForHumans() }})</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">No hay reseñas recientes.</p>
                    @endforelse

                    <div class="mt-3">
                        {{ $reseñas->appends(['mensajes_page' => request('mensajes_page')])->links() }}
                    </div>
                </div>
            </div>

            {{-- MENSAJES --}}
            <div x-data="{ openForos: {} }" class="bg-white p-4 rounded shadow">
                <h4 class="text-l font-bold mb-4">
                    💬 Tus Mensajes
                </h4>

                @forelse ($mensajes as $foro_id => $mensajesForo)
                    <div class="border rounded-lg p-4 bg-gray-50">
                        {{-- Título del foro --}}
                        <button @click="openForos[{{ $foro_id }}] = !openForos[{{ $foro_id }}]"
                            class="w-full flex justify-between items-center font-semibold text-indigo-600 text-lg hover:bg-gray-100 px-3 py-2 rounded">
                            <span>Mensajes del Foro: {{ $mensajesForo[0]->foro->titulo ?? 'Foro eliminado' }}</span>
                            <span x-text="openForos[{{ $foro_id }}] ? '▲' : '▼'"></span>
                        </button>

                        {{-- Mensajes del foro --}}
                        <div x-show="openForos[{{ $foro_id }}]" x-transition
                            class="mt-2 ml-4
                                text-gray-700 bg-gray-50 p-3 rounded-lg shadow-inner">
                            @foreach ($mensajesForo as $mensaje)
                                <div class="pl-4 mb-2 border-l-2 border-indigo-300">
                                    <p class="text-gray-700">{{ $mensaje->contenido }}</p>
                                    <p class="text-gray-400 text-sm">({{ $mensaje->created_at->diffForHumans() }})</p>

                                    @if ($mensaje->respuestas)
                                        @foreach ($mensaje->respuestas as $respuesta)
                                            <div class="pl-4 mt-1 border-l-2 border-indigo-200">
                                                <p class="text-gray-600">{{ $respuesta->contenido }}</p>
                                                <p class="text-gray-400 text-xs">
                                                    ({{ $respuesta->created_at->diffForHumans() }})
                                                </p>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No hay mensajes recientes.</p>
                @endforelse
            </div>

            {{-- Foros donde participa el usuario --}}
            <div x-data="{ openForos: {} }" class="bg-white p-4 rounded shadow space-y-4">
                <h4 class="text-l font-bold mb-4">🗂️ Tus Foros</h4>

                @forelse ($foros as $foro)
                    <div class="border rounded-lg p-4 bg-gray-50">
                        {{-- Título del foro, clic para desplegar --}}
                        <button @click="openForos[{{ $foro->id }}] = !openForos[{{ $foro->id }}]"
                            class="w-full flex justify-between items-center font-semibold text-indigo-600 text-lg hover:bg-gray-100 px-3 py-2 rounded">
                            <span>{{ $foro->titulo }}</span>
                            <span x-text="openForos[{{ $foro->id }}] ? '▲' : '▼'"></span>
                        </button>

                        {{-- Contenido del foro desplegable --}}
                        <div x-show="openForos[{{ $foro->id }}]" x-transition class="mt-3 space-y-3 text-gray-700">
                            {{-- Botones de edición si eres propietaria --}}
                            @if (auth()->id() === $foro->user_id)
                                <div class="flex space-x-2 mb-2">
                                    <a href="{{ route('foros.edit', $foro) }}"
                                        class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('foros.destroy', $foro) }}" method="POST"
                                        onsubmit="return confirm('¿Seguro que quieres eliminar este foro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </div>
                            @endif

                            {{-- Información del foro --}}
                            <p>{{ $foro->descripcion }}</p>
                            <p class="text-gray-500 text-sm">Creado: {{ $foro->created_at->format('d/m/Y H:i') }}</p>
                            @if ($foro->updated_at != $foro->created_at)
                                <p class="text-gray-400 text-xs">Última actualización:
                                    {{ $foro->updated_at->diffForHumans() }}</p>
                            @endif

                            {{-- Mensajes --}}
                            <div x-data="{ openMensajesForo: {} }" class="mt-2 space-y-2">
                                @foreach ($foro->mensajes as $mensaje)
                                    <div class="pl-2 border-l-2 border-indigo-300 rounded-sm">
                                        {{-- Título del mensaje, clic para desplegar --}}
                                        <button
                                            @click="openMensajesForo[{{ $mensaje->id }}] = !openMensajesForo[{{ $mensaje->id }}]"
                                            class="w-full flex justify-between items-center text-left font-medium px-2 py-1 hover:bg-gray-100 rounded">
                                            <span><strong>{{ $mensaje->user->name }}:</strong>
                                                {{ Str::limit($mensaje->contenido, 50) }}</span>
                                            <span x-text="openMensajesForo[{{ $mensaje->id }}] ? '▲' : '▼'"></span>
                                        </button>

                                        {{-- Contenido completo del mensaje --}}
                                        <div x-show="openMensajesForo[{{ $mensaje->id }}]" x-transition
                                            class="mt-1 ml-4 space-y-1 text-gray-700">
                                            <p>{{ $mensaje->contenido }}</p>
                                            <p class="text-gray-400 text-xs">
                                                ({{ $mensaje->created_at->diffForHumans() }})
                                            </p>

                                            {{-- Respuestas --}}
                                            @if ($mensaje->respuestas)
                                                @foreach ($mensaje->respuestas as $respuesta)
                                                    <div class="pl-4 mt-1 border-l-2 border-indigo-200">
                                                        <p><strong>{{ $respuesta->user->name }}:</strong>
                                                            {{ $respuesta->contenido }}</p>
                                                        <p class="text-gray-400 text-xs">
                                                            ({{ $respuesta->created_at->diffForHumans() }})
                                                        </p>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No has creado ni participado en ningún foro todavía.</p>
                @endforelse
            </div>

        </div>
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
