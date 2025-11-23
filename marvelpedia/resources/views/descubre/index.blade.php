<!-- resources/views/descubre.blade.php -->
@extends('layouts.app')

@section('content')
    <x-welcome-section title="Explora el Multiverso Marvel"
        subtitle="Cada recarga te trae nuevos personajes, películas, cómics y series para descubrir."
        bgImage="{{ asset('images/fondo_imagen_inicio.jpeg') }}" />

    <div class="container mx-auto space-y-12 px-4 py-6">
        <h1 class="text-6xl text-center font-bold mb-6 text-gray-800">Multiverso Marvel</h1>

        <!-- PERSONAJES -->
        <section>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-2">
                <!-- Izquierda: título y subtítulo -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Personajes</h2>
                    <p class="mt-1 text-gray-600">Cada héroe tiene una historia… ¿quieres descubrirla?</p>
                </div>

                <!-- Derecha: botón -->
                <a href="{{ route('personajes') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                    Ver más personajes
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @php
                    $personajesCollection = collect($personajes)->shuffle();
                @endphp
                @foreach ($personajesCollection->take(8) as $personaje)
                    <a href="{{ route('personaje.show', $personaje['id']) }}">
                        <div
                            class="relative border rounded-xl overflow-hidden shadow-lg transform hover:scale-105 transition duration-300 bg-white">
                            <img class="w-full h-52 object-cover"
                                src="{{ $personaje['thumbnail']['path'] }}.{{ $personaje['thumbnail']['extension'] }}"
                                alt="{{ $personaje['name'] }}">
                            <div class="absolute bottom-0 w-full bg-gradient-to-t from-black/70 to-transparent p-3">
                                <h2 class="text-white font-semibold text-lg truncate">{{ $personaje['name'] }}</h2>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- SERIES -->
        <section>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-2">
                <!-- Izquierda: título y subtítulo -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Series</h2>
                    <p class="mt-1 text-gray-600">Cada serie cuenta un universo, ¿listo para explorarlo?</p>
                </div>

                <!-- Derecha: botón -->
                <a href="{{ route('series') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                    Ver más series
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @php
                    $seriesCollection = collect($series)->shuffle();
                @endphp
                @foreach ($seriesCollection->take(8) as $series)
                    <a href="{{ route('serie.show', $series['imdbID']) }}">
                        <div
                            class="relative border rounded-xl overflow-hidden shadow-lg transform hover:scale-105 transition duration-300 bg-white">
                            <img class="w-full h-52 object-cover mb-2"
                                src="{{ $series['Poster'] != 'N/A' ? $series['Poster'] : asset('images/default-movie.png') }}"
                                alt="{{ $series['Title'] }}">
                            <div class="absolute bottom-0 w-full bg-gradient-to-t from-black/70 to-transparent p-3">
                                <h2 class="text-white font-semibold text-lg truncate">{{ $series['Title'] }}</h2>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- PELÍCULAS -->
        <section>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-2">
                <!-- Izquierda: título y subtítulo -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Películas</h2>
                    <p class="mt-1 text-gray-600">Cada película, una aventura épica que no te puedes perder.</p>
                </div>

                <!-- Derecha: botón -->
                <a href="{{ route('peliculas.index') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                    Ver más películas
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @php
                    $peliculasCollection = collect($peliculas)->shuffle();
                @endphp
                @foreach ($peliculasCollection->take(8) as $pelicula)
                    <a href="{{ route('pelicula.show', $pelicula['imdbID']) }}">
                        <div
                            class="relative border rounded-xl overflow-hidden shadow-lg transform hover:scale-105 transition duration-300 bg-white">
                            <img class="w-full h-52 object-cover mb-2"
                                src="{{ $pelicula['Poster'] != 'N/A' ? $pelicula['Poster'] : asset('images/default-movie.png') }}"
                                alt="{{ $pelicula['Title'] }}">
                            <div class="absolute bottom-0 w-full bg-gradient-to-t from-black/70 to-transparent p-3">
                                <h2 class="text-white font-semibold text-lg truncate">{{ $pelicula['Title'] }}</h2>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>


        <!-- COMICS -->
        <section>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-2">
                <!-- Izquierda: título y subtítulo -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Cómics</h2>
                    <p class="mt-1 text-gray-600">Sumérgete en los orígenes y secretos del multiverso.</p>
                </div>

                <!-- Derecha: botón -->
                <a href="{{ route('comics') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                    Ver más cómics
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @php
                    $comicsCollection = collect($comics)->shuffle();
                @endphp
                @foreach ($comicsCollection->take(8) as $comic)
                    <a href="{{ route('comic.show', $comic['id']) }}">
                        <div
                            class="relative border rounded-xl overflow-hidden shadow-lg transform hover:scale-105 transition duration-300 bg-white">
                            <img class="w-full h-52 object-cover"
                                src="{{ $comic['thumbnail']['path'] }}.{{ $comic['thumbnail']['extension'] }}"
                                alt="{{ $comic['title'] }}">
                            <div class="absolute bottom-0 w-full bg-gradient-to-t from-black/70 to-transparent p-3">
                                <h2 class="text-white font-semibold text-lg truncate">{{ $comic['title'] }}</h2>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

    </div>
@endsection
