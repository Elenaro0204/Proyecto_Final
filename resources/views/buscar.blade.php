<!-- resources/views/buscar.blade.php -->
@extends('layouts.app')

@section('content')
    <x-welcome-section title="¡Descubre contenido Marvel!"
        subtitle="Escribe para buscar — los resultados aparecerán en tiempo real."
        bgImage="{{ asset('images/fondo_imagen_inicio.jpg') }}" />

    <div class="container mx-auto px-4 py-6">
        <div class="max-w-3xl mx-auto">
            <input id="globalSearch" type="text" placeholder="🔍 Buscar películas o series"
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500" autocomplete="off">
        </div>

        <div id="resultsWrapper" class="mt-8 space-y-10">
            <!-- Secciones renderizadas desde JS -->
            <div id="loading" class="text-center text-gray-600">Escribe para buscar o espera a que aparezcan resultados
                por defecto...</div>

            <section id="seriesSection" class="hidden">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-2xl font-semibold">Series</h2>
                        <p class="text-sm text-gray-600">Series y sagas del universo Marvel.</p>
                    </div>
                    <a href="{{ route('series') }}"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hidden md:inline-block">Ver todos</a>
                </div>
                <div id="seriesGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
            </section>

            <section id="peliculasSection" class="hidden">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-2xl font-semibold">Películas</h2>
                        <p class="text-sm text-gray-600">Películas relacionadas con Marvel (OMDB).</p>
                    </div>
                    <a href="{{ route('peliculas.index') }}"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hidden md:inline-block">Ver todos</a>
                </div>
                <div id="peliculasGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
            </section>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('globalSearch');
            const loading = document.getElementById('loading');
            const seriesSection = document.getElementById('seriesSection');
            const peliculasSection = document.getElementById('peliculasSection');
            const seriesGrid = document.getElementById('seriesGrid');
            const peliculasGrid = document.getElementById('peliculasGrid');

            // Función para renderizar tarjetas
            const renderCards = (container, items) => {
                container.innerHTML = '';
                items.forEach(item => {
                    const card = document.createElement('div');
                    card.className = 'bg-white p-4 rounded-lg shadow';
                    card.innerHTML = `
                <img src="${item.poster || '/images/no-poster.png'}"
                     alt="${item.title}" class="w-full h-48 object-cover rounded mb-2">
                <h3 class="font-semibold text-lg">${item.title}</h3>
                <p class="text-sm text-gray-500">${item.year}</p>
            `;
                    container.appendChild(card);
                });
            };

            // Función para cargar resultados (AJAX)
            const loadResults = async (query) => {
                try {
                    loading.style.display = 'block';
                    loading.textContent = query ? 'Buscando...' : 'Cargando contenido por defecto...';

                    const url = query ? `/api/buscar?q=${encodeURIComponent(query)}` :
                        `/api/buscar?q=Marvel`;
                    const response = await fetch(url);
                    const data = await response.json();

                    // Renderizar series
                    if (data.series && data.series.length) {
                        renderCards(seriesGrid, data.series || [], 'serie');
                        seriesSection.classList.remove('hidden');
                    } else {
                        seriesSection.classList.add('hidden');
                    }

                    // Renderizar películas
                    if (data.peliculas && data.peliculas.length) {
                        renderCards(peliculasGrid, data.peliculas || [], 'pelicula');
                        peliculasSection.classList.remove('hidden');
                    } else {
                        peliculasSection.classList.add('hidden');
                    }

                    loading.style.display = 'none';
                } catch (error) {
                    console.error(error);
                    loading.textContent = 'Error al buscar. Intenta de nuevo.';
                }
            };

            // Resultados por defecto al cargar la página
            loadResults('');

            // Actualizar al escribir
            input.addEventListener('input', () => {
                const query = input.value.trim();
                loadResults(query);
            });
        });
    </script>
@endsection
