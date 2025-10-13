<!-- resources/views/buscar.blade.php -->
@extends('layouts.app')

@section('content')
<x-welcome-section
    title="¡Descubre contenido Marvel!"
    subtitle="Escribe para buscar — los resultados aparecerán en tiempo real."
    bgImage="{{ asset('images/fondo_imagen_inicio.jpeg') }}" />

<div class="container mx-auto px-4 py-6">
    <div class="max-w-3xl mx-auto">
        <input id="globalSearch" type="text" placeholder="Buscar personajes, cómics, películas, series..."
               class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500"
               autocomplete="off">
    </div>

    <div id="resultsWrapper" class="mt-8 space-y-10">
        <!-- Secciones renderizadas desde JS -->
        <div id="loading" class="text-center text-gray-600">Escribe para buscar o espera a que aparezcan resultados por defecto...</div>

        <section id="personajesSection" class="hidden">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-2xl font-semibold">Personajes</h2>
                    <p class="text-sm text-gray-600">Descubre héroes y villanos del universo Marvel.</p>
                </div>
                <a href="{{ route('personajes') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hidden md:inline-block">Ver todos</a>
            </div>
            <div id="personajesGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
        </section>

        <section id="comicsSection" class="hidden">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-2xl font-semibold">Cómics</h2>
                    <p class="text-sm text-gray-600">Explora colecciones y portadas icónicas.</p>
                </div>
                <a href="{{ route('comics') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hidden md:inline-block">Ver todos</a>
            </div>
            <div id="comicsGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
        </section>

        <section id="seriesSection" class="hidden">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-2xl font-semibold">Series</h2>
                    <p class="text-sm text-gray-600">Series y sagas del universo Marvel.</p>
                </div>
                <a href="{{ route('series') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hidden md:inline-block">Ver todos</a>
            </div>
            <div id="seriesGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
        </section>

        <section id="peliculasSection" class="hidden">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-2xl font-semibold">Películas</h2>
                    <p class="text-sm text-gray-600">Películas relacionadas con Marvel (OMDB).</p>
                </div>
                <a href="{{ route('peliculas') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hidden md:inline-block">Ver todos</a>
            </div>
            <div id="peliculasGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
        </section>
    </div>
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('globalSearch');
    const loading = document.getElementById('loading');
    const personajesSection = document.getElementById('personajesSection');
    const comicsSection = document.getElementById('comicsSection');
    const seriesSection = document.getElementById('seriesSection');
    const peliculasSection = document.getElementById('peliculasSection');

    input.addEventListener('input', async () => {
        const query = input.value.trim();

        // Mostrar mensaje de carga
        loading.textContent = 'Buscando...';
        loading.style.display = 'block';

        // Ocultar secciones
        personajesSection.classList.add('hidden');
        comicsSection.classList.add('hidden');
        seriesSection.classList.add('hidden');
        peliculasSection.classList.add('hidden');

        if(query.length === 0){
            loading.textContent = 'Escribe para buscar o espera a que aparezcan resultados por defecto...';
            return;
        }

        try {
            const response = await fetch(`/api/buscar?q=${encodeURIComponent(query)}`);
            const data = await response.json();

            // Llenar Personajes
            const personajesGrid = document.getElementById('personajesGrid');
            personajesGrid.innerHTML = '';
            if(data.personajes && data.personajes.length > 0){
                data.personajes.forEach(p => {
                    const card = document.createElement('div');
                    card.className = 'bg-white p-4 rounded-lg shadow';
                    card.innerHTML = `<img src="${p.imagen}" alt="${p.nombre}" class="w-full h-48 object-cover rounded mb-2">
                                      <h3 class="font-semibold text-lg">${p.nombre}</h3>`;
                    personajesGrid.appendChild(card);
                });
                personajesSection.classList.remove('hidden');
            }

            // Aquí lo mismo para comics, series y películas...
            // comicsSection, seriesSection, peliculasSection

            loading.style.display = 'none';
        } catch (error) {
            console.error(error);
            loading.textContent = 'Error al buscar. Intenta de nuevo.';
        }
    });
});

</script>
