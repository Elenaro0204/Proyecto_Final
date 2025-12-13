<!-- resources/views/peliculas/index.blade.php -->

@extends('layouts.app')

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Descubre', 'url' => route('descubre'), 'level' => 1],
        ['label' => 'Películas', 'url' => route('peliculas.index'), 'level' => 3],
    ]" />

    <x-welcome-section title="Películas del Multiverso Marvel"
        subtitle="Explora todas las películas disponibles y descubre sus historias."
        bgImage="{{ asset('images/fondo_imagen_inicio.jpg') }}" />

    <div class="container mx-auto px-4 py-8 space-y-12">

        <!-- Formulario de búsqueda -->
        <form class="relative w-full sm:w-2/3 md:w-1/2 mx-auto">
            <input type="text" id="searchInput" placeholder="🔍 Buscar película..."
                class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-md transition">
            <ul id="searchResults"
                class="absolute w-full bg-white border mt-1 rounded-lg shadow-lg z-50 hidden max-h-60 overflow-y-auto"></ul>
        </form>

        <!-- Grid de películas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-6">
            @foreach ($peliculas as $pelicula)
                <a href="{{ route('pelicula.show', $pelicula['id']) }}" class="group">
                    <div
                        class="relative rounded-xl overflow-hidden shadow-lg transform hover:scale-105 hover:shadow-2xl transition duration-500 ease-in-out bg-gradient-to-b from-indigo-900 to-indigo-800">
                        <img class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110"
                            src="{{ $pelicula['poster_path'] ? $pelicula['poster_path'] : asset('images/fondo-peliculas.jpeg') }}"
                            alt="{{ $pelicula['title'] }}">
                        <div
                            class="absolute inset-0 bg-black/50 flex flex-col justify-center items-center text-center px-4 z-10">
                            <h2 class="text-white font-bold text-lg md:text-xl break-words whitespace-normal">
                                {{ $pelicula['title'] }}
                            </h2>

                            <p class="text-gray-200 text-sm md:text-base mt-1 line-clamp-2">{{ $pelicula['anio'] }}</p>
                            <span
                                class="mt-3 px-4 py-2 bg-yellow-400 text-red-900 font-semibold rounded-md shadow hover:bg-yellow-500 transition-colors cursor-pointer">
                                Ver más
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Paginación -->
        <div id="pagination" class="mt-8 flex justify-center">
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
                        `<p class="text-gray-500 italic col-span-full text-center w-full">No se encontraron resultados.</p>`;
                    return;
                }

                peliculas.forEach(p => {
                    const div = document.createElement('a');
                    div.href = `/pelicula/${p.id}`;
                    div.className = 'group';
                    div.innerHTML = `
                <div class="relative rounded-xl overflow-hidden shadow-lg transform hover:scale-105 hover:shadow-2xl transition duration-500 ease-in-out bg-gradient-to-b from-indigo-900 to-indigo-800">
                    <img class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110"
                        src="${p.poster_path || '/images/fondo-peliculas.jpeg'}" alt="${p.title}">
                    <div class="absolute inset-0 bg-black/50 flex flex-col justify-center items-center text-center px-4 z-10">
                        <h2 class="text-white font-bold text-lg md:text-xl break-words whitespace-normal">${p.title}</h2>
                        <p class="text-gray-200 text-sm md:text-base mt-1 line-clamp-2">${p.anio || 'Desconocido'}</p>
                        <span class="mt-3 px-4 py-2 bg-yellow-400 text-indigo-900 font-semibold rounded-md shadow hover:bg-yellow-500 transition-colors cursor-pointer">Ver más</span>
                    </div>
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
                    pagination.style.display = 'flex';
                    return;
                }

                fetch(`{{ route('peliculas.buscar') }}?q=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(data => {
                        pagination.style.display = 'none';
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
                                    renderGrid(data);
                                });
                                results.appendChild(li);
                            });
                            results.classList.remove('hidden');
                        } else {
                            results.classList.add('hidden');
                            renderGrid([]);
                        }
                    });
            });
        });
    </script>
@endsection
