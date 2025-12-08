<!-- resources/views/descubre/index.blade.php -->
@extends('layouts.app')

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Descubre', 'url' => route('descubre'), 'level' => 1],
    ]" />

    <x-welcome-section title="Explora el Multiverso Marvel"
        subtitle="Cada recarga te trae nuevos películas y series para descubrir."
        bgImage="{{ asset('images/fondo_imagen_inicio.jpeg') }}" />

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-16">

        <div class="max-w-3xl mx-auto mb-8">
            <input id="globalSearch" type="text" placeholder="Buscar series o películas"
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-yellow-400" autocomplete="off">
        </div>

        <div id="loading" class="text-center text-gray-600 mb-6">
            Cargando contenido por defecto...
        </div>

        <!-- SERIES -->
        <section
            class="bg-gradient-to-r from-red-900 via-red-700 to-red-900 rounded-xl p-6 shadow-xl hover:shadow-2xl transition-shadow duration-500">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-2">
                <div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-yellow-400 drop-shadow-lg">Series</h2>
                    <p class="mt-2 text-gray-200 text-base sm:text-lg md:text-xl">Cada serie cuenta un universo, ¿listo para
                        explorarlo?</p>
                </div>
                <a href="{{ route('series') }}"
                    class="mt-3 md:mt-0 px-4 sm:px-6 lg:px-8 py-2 sm:py-3 bg-yellow-400 text-red-900 font-bold rounded-lg shadow-lg hover:bg-yellow-500 hover:scale-105 transition-transform duration-300">
                    Ver más series
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @php $seriesCollection = collect($series)->shuffle(); @endphp
                @foreach ($seriesCollection->take(8) as $serie)
                    <a href="{{ route('serie.show', $serie['id']) }}">
                        <div
                            class="relative rounded-xl overflow-hidden shadow-lg transform hover:scale-105 hover:shadow-2xl transition duration-500 ease-in-out bg-black/10">
                            <img class="w-full h-52 sm:h-60 md:h-64 lg:h-72 object-cover"
                                src="{{ $serie['poster'] != 'N/A' ? $serie['poster'] : asset('images/default-serie.png') }}"
                                alt="{{ $serie['title'] }}">
                            <div class="absolute bottom-0 w-full bg-gradient-to-t from-black/80 to-transparent p-3">
                                <h2 class="text-white font-bold text-lg md:text-xl break-words whitespace-normal">
                                    {{ $serie['title'] }}</h2>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- PELÍCULAS -->
        <section
            class="bg-gradient-to-r from-indigo-900 via-indigo-700 to-indigo-900 rounded-xl p-6 shadow-xl hover:shadow-2xl transition-shadow duration-500">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-2">
                <div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-yellow-400 drop-shadow-lg">Películas
                    </h2>
                    <p class="mt-2 text-gray-200 text-base sm:text-lg md:text-xl">Cada película, una aventura épica que no
                        te puedes perder.</p>
                </div>
                <a href="{{ route('peliculas.index') }}"
                    class="mt-3 md:mt-0 px-4 sm:px-6 lg:px-8 py-2 sm:py-3 bg-yellow-400 text-red-900 font-bold rounded-lg shadow-lg hover:bg-yellow-500 hover:scale-105 transition-transform duration-300">
                    Ver más películas
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @php $peliculasCollection = collect($peliculas)->shuffle(); @endphp
                @foreach ($peliculasCollection->take(8) as $pelicula)
                    <a href="{{ route('pelicula.show', $pelicula['imdbID']) }}">
                        <div
                            class="relative rounded-xl overflow-hidden shadow-lg transform hover:scale-105 hover:shadow-2xl transition duration-500 ease-in-out bg-black/10">

                            <img class="w-full h-52 sm:h-60 md:h-64 lg:h-72 object-cover"
                                src="{{ $pelicula['poster'] ?? asset('images/default-movie.png') }}"
                                alt="{{ $pelicula['title'] }}">

                            <div class="absolute bottom-0 w-full bg-gradient-to-t from-black/80 to-transparent p-3">
                                <h2 class="text-white font-bold text-lg md:text-xl break-words whitespace-normal">
                                    {{ $pelicula['title'] }}
                                </h2>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('globalSearch');
            const loading = document.getElementById('loading');
            const seriesGrid = document.querySelector('section:nth-of-type(1) .grid');
            const peliculasGrid = document.querySelector('section:nth-of-type(2) .grid');
            const rutaSerie = "{{ url('/serie') }}/";
            const rutaPelicula = "{{ url('/pelicula') }}/";

            // Al cargar la página, ocultamos el mensaje
            loading.style.display = 'none';

            const renderCards = (container, items) => {
                container.innerHTML = '';
                items.forEach(item => {
                    const card = document.createElement('a');
                    card.href = item.type === 'series' ? rutaSerie + item.imdbID : rutaPelicula + item.imdbID;
                    card.innerHTML = `
                <div class="relative rounded-xl overflow-hidden shadow-lg transform hover:scale-105 hover:shadow-2xl transition duration-500 ease-in-out bg-black/10">
                    <img class="w-full h-52 sm:h-60 md:h-64 lg:h-72 object-cover"
                        src="${item.poster || '/images/default-movie.png'}"
                        alt="${item.title}">
                    <div class="absolute bottom-0 w-full bg-gradient-to-t from-black/80 to-transparent p-3">
                        <h2 class="text-white font-bold text-sm sm:text-base md:text-lg lg:text-xl truncate">
                            ${item.title}
                        </h2>
                    </div>
                </div>
            `;
                    container.appendChild(card);
                });
            };

            const loadResults = async (query, initialLoad = false) => {
                try {
                    if (query) {
                        loading.style.display = 'block';
                        loading.textContent = 'Buscando...';
                    } else if (!initialLoad) {
                        loading.style.display = 'none';
                    }

                    const url = query ?
                        `/api/buscar?q=${encodeURIComponent(query)}` :
                        `/api/inicio`;

                    const response = await fetch(url);
                    const data = await response.json();

                    renderCards(seriesGrid, data.series || []);
                    renderCards(peliculasGrid, data.peliculas || []);

                    loading.style.display = 'none';
                } catch (error) {
                    console.error(error);
                    loading.textContent = 'Error al buscar. Intenta de nuevo.';
                }
            };

            // 🔥 CARGA INICIAL DE CONTENIDO POR DEFECTO
            loadResults('', true);

            // 🔥 Actualizar resultados al escribir
            let debounceTimer;
            input.addEventListener('input', () => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    const query = input.value.trim();
                    loadResults(query);
                }, 400);
            });
        });
    </script>
@endpush
