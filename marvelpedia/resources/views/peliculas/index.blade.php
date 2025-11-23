<!-- resources/views/peliculas.blade.php -->
@extends('layouts.app')

@section('content')
    <x-welcome-section title="Películas del Multiverso Marvel"
        subtitle="Explora todas las películas disponibles y descubre sus historias."
        bgImage="{{ asset('images/fondo_imagen_inicio.jpeg') }}" />

    <div class="container mx-auto px-4 py-6">

        <h1 class="text-4xl font-bold mb-6 text-gray-800 text-center">Películas Marvel</h1>

        <!-- Formulario de búsqueda -->
        <form class="relative w-full sm:w-1/2 mx-auto">
            <input type="text" id="searchInput" placeholder="Buscar película..."
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <ul id="searchResults" class="absolute w-full bg-white border mt-1 rounded-lg shadow z-50 hidden"></ul>
        </form>

        <!-- Grid de películas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
            @foreach ($peliculas as $pelicula)
                <div
                    class="border rounded-lg p-4 bg-white shadow hover:shadow-lg transition flex flex-col justify-between h-full">

                    <!-- Imagen arriba -->
                    <img class="w-full h-48 object-cover mb-2"
                        src="{{ $pelicula['poster_path'] ?: asset('images/no-poster.png') }}"
                        alt="{{ $pelicula['Title'] }}">

                    <!-- Contenido central -->
                    <div class="flex-1 mt-2">
                        <h2 class="font-bold text-lg mb-1">{{ $pelicula['Title'] }}</h2>
                        <p class="text-sm text-gray-600 line-clamp-3">{{ $pelicula['anio'] }} |
                            {{ $pelicula['genero'] }}</p>
                        <p class="text-sm text-gray-600 line-clamp-3">
                            {{ $pelicula['sinopsis'] }}
                        </p>
                    </div>

                    <!-- Botón abajo -->
                    <div class="flex justify-center mt-4">
                        <a href="{{ route('pelicula.show', $pelicula['imdbID']) }}"
                            class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition">
                            Ver más
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div id="pagination" class="mt-6 w-full">
            {{ $peliculas->links('pagination::tailwind') }}
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('searchInput');
            const results = document.getElementById('searchResults');
            const peliculasGrid = document.querySelector('.grid');
            const pagination = document.getElementById('pagination');

            function renderGrid(peliculas) {
                peliculasGrid.innerHTML = '';
                if (!peliculas.length) {
                    peliculasGrid.innerHTML =
                        `<p class="text-gray-500 italic col-span-full">No se encontraron resultados.</p>`;
                    return;
                }

                peliculas.forEach(p => {
                    const div = document.createElement('div');
                    div.className =
                        'border rounded-lg p-4 bg-white shadow hover:shadow-lg transition flex flex-col justify-between h-full';
                    div.innerHTML = `
                        <img class="w-full h-48 object-cover mb-2" src="${p.poster_path || '/images/no-poster.png'}" alt="${p.title}">
                        <div class="flex-1 mt-2">
                            <h2 class="font-bold text-lg mb-1">${p.title}</h2>
                            <p class="text-sm text-gray-600 line-clamp-3">
                                ${p.anio || 'Desconocido'} | ${p.tipo ? p.tipo.charAt(0).toUpperCase() + p.tipo.slice(1) : 'Película'}
                            </p>
                            <p class="text-sm ${p.sinopsis ? 'text-gray-600' : 'text-gray-400 italic'} line-clamp-3">
                                ${p.sinopsis || 'Sin descripción disponible'}
                            </p>
                        </div>
                        <div class="flex justify-center mt-4">
                            <a href="/pelicula/${p.imdbID}" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition">
                                Ver más
                            </a>
                        </div>
                    `;
                    peliculasGrid.appendChild(div);
                });
            }

            input.addEventListener('input', function() {
                const query = this.value.trim();

                if (!query) {
                    results.innerHTML = '';
                    results.classList.add('hidden');
                    pagination.style.display = 'block'; // mostrar paginación cuando no hay búsqueda
                    return;
                }

                fetch(`{{ route('peliculas.buscar') }}?q=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(data => {
                        // ocultar paginación al buscar
                        pagination.style.display = 'none';

                        // Mostrar sugerencias
                        results.innerHTML = '';
                        if (data.length) {
                            data.forEach(p => {
                                const li = document.createElement('li');
                                li.textContent = p.title;
                                li.classList.add('px-4', 'py-2', 'hover:bg-gray-200',
                                    'cursor-pointer');
                                li.addEventListener('click', () => {
                                    input.value = p.title;
                                    results.classList.add('hidden');

                                    // Renderizar todos los resultados en el grid
                                    renderGrid(data);
                                });
                                results.appendChild(li);
                            });
                            results.classList.remove('hidden');
                        } else {
                            results.classList.add('hidden');
                            renderGrid([]); // mostrar mensaje de "no se encontraron resultados"
                        }
                    });
            });
        });
    </script>
@endsection
