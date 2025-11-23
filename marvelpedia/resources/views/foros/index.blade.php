@extends('layouts.app')

@section('content')
    <x-welcome-section title="Foros del Multiverso Marvel"
        subtitle="Participa en debates sobre cómics, películas, series y personajes. ¡Únete a la comunidad y comparte tus ideas!"
        bgImage="{{ asset('images/fondo_imagen_inicio.jpeg') }}" />

    <div class="container mx-auto px-4 py-6">

        <h1 class="text-4xl font-extrabold mb-8 text-gray-900 text-center">Foros del Multiverso Marvel</h1>

        <!-- Botón para crear un nuevo foro -->
        <div class="flex justify-end mb-6">
            <a href="{{ route('foros.create') }}"
                class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-lg hover:bg-indigo-700 transition duration-300">
                Crear Nuevo Foro
            </a>
        </div>

        <!-- Listado de foros -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($foros as $foro)
                <div class="rounded-2xl overflow-hidden shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl"
                    style="background: {{ $foro->color_fondo ?? 'white' }}; color: {{ $foro->color_titulo ?? 'black' }};">

                    @if ($foro->imagen_portada)
                        <div class="relative h-40 md:h-48">
                            <img src="{{ asset('storage/' . $foro->imagen_portada) }}" alt="Portada"
                                class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-20 rounded-2xl pointer-events-none"></div>
                        </div>
                    @endif

                    <div class="p-5 flex flex-col justify-between h-full">
                        <div>
                            <h2 class="text-xl md:text-2xl font-bold mb-2">{{ $foro->titulo }}</h2>
                            <p class="text-gray-800 text-sm md:text-base mb-3 line-clamp-3">{{ $foro->descripcion ?? 'Sin descripción' }}</p>
                        </div>

                        <div class="flex flex-col gap-1">
                            <p class="text-xs md:text-sm opacity-70">Creado por: {{ $foro->user->name ?? 'Usuario desconocido' }}</p>
                            <div class="flex items-center gap-2 text-xs md:text-sm opacity-70">
                                <span>Estado:</span>
                                @if($foro->visibilidad === 'publico')
                                    <span class="px-2 py-1 bg-green-200 text-green-800 rounded-full font-semibold">Público</span>
                                @else
                                    <span class="px-2 py-1 bg-red-200 text-red-800 rounded-full font-semibold">Privado</span>
                                @endif
                            </div>
                        </div>

                        <a href="{{ route('foros.show', $foro->id) }}"
                            class="mt-4 inline-block px-4 py-2 bg-indigo-500 text-white rounded-lg text-sm text-center shadow hover:bg-indigo-600 transition duration-300">
                            Ver Foro
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $foros->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
