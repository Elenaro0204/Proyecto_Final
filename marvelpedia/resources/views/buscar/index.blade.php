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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('globalSearch');
    const loading = document.getElementById('loading');

    const personajesSection = document.getElementById('personajesSection');
    const comicsSection = document.getElementById('comicsSection');
    const seriesSection = document.getElementById('seriesSection');
    const peliculasSection = document.getElementById('peliculasSection');

    const personajesGrid = document.getElementById('personajesGrid');
    const comicsGrid = document.getElementById('comicsGrid');
    const seriesGrid = document.getElementById('seriesGrid');
    const peliculasGrid = document.getElementById('peliculasGrid');

    let timer = null;

    // función para render cards simples
    function cardHTML({ img, title, subtitle, linkText = 'Ver más', link = '#' }) {
        return `
        <div class="border rounded-lg p-3 bg-white shadow hover:shadow-lg transition flex flex-col h-full">
            <div class="h-44 overflow-hidden rounded-md">
                <img src="${img || '/images/default-avatar.png'}" alt="${title}" class="w-full h-full object-cover">
            </div>
            <div class="mt-3 flex-1">
                <h3 class="font-semibold text-lg">${title}</h3>
                ${subtitle ? `<p class="mt-1 text-sm text-gray-600 line-clamp-3">${subtitle}</p>` : ''}
            </div>
            <div class="mt-3 text-center">
                <a href="${link}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md">${linkText}</a>
            </div>
        </div>`;
    }

    // renderiza sección con array y target grid
    function renderSection(gridEl, items, type) {
        gridEl.innerHTML = '';
        if (!items || items.length === 0) {
            gridEl.innerHTML = `<p class="text-gray-500 italic">No hay resultados.</p>`;
            return;
        }
        items.forEach(item => {
            let img = '';
            let title = '';
            let subtitle = '';
            let link = '#';

            if (type === 'personajes') {
                img = item.thumbnail || '/images/default-avatar.png';
                title = item.name || 'Sin nombre';
                subtitle = item.description || '';
                link = `/personaje/${item.id}`;
            } else if (type === 'comics') {
                img = item.thumbnail || '/images/default-avatar.png';
                title = item.title || 'Sin título';
                subtitle = item.description || '';
                link = `/comic/${item.id}`;
            } else if (type === 'series') {
                img = item.thumbnail || '/images/default-avatar.png';
                title = item.title || 'Sin título';
                subtitle = item.description || '';
                link = `/serie/${item.id}`;
            } else if (type === 'peliculas') {
                img = item.Poster || '/images/default-movie.png';
                title = item.Title || 'Sin título';
                subtitle = item.Year ? `Año: ${item.Year}` : '';
                link = `/pelicula/${item.imdbID || ''}`;
            }

            const wrapper = document.createElement('div');
            wrapper.innerHTML = cardHTML({ img, title, subtitle, link, linkText: 'Ver más' });
            gridEl.appendChild(wrapper.firstElementChild);
        });
    }

    async function doSearch(q) {
        // mostrar loading
        loading.textContent = 'Buscando...';
        loading.classList.remove('hidden');

        try {
            const url = new URL("{{ route('buscar') }}", window.location.origin);
            if (q) url.searchParams.set('q', q);
            url.searchParams.set('limit', 8);

            const res = await fetch(url.toString());
            const json = await res.json();

            // ocultar loading
            loading.classList.add('hidden');

            // render secciones y mostrarlas si tienen items
            if (json.personajes && json.personajes.length) {
                renderSection(personajesGrid, json.personajes, 'personajes');
                personajesSection.classList.remove('hidden');
            } else {
                personajesSection.classList.add('hidden');
            }

            if (json.comics && json.comics.length) {
                renderSection(comicsGrid, json.comics, 'comics');
                comicsSection.classList.remove('hidden');
            } else {
                comicsSection.classList.add('hidden');
            }

            if (json.series && json.series.length) {
                renderSection(seriesGrid, json.series, 'series');
                seriesSection.classList.remove('hidden');
            } else {
                seriesSection.classList.add('hidden');
            }

            if (json.peliculas && json.peliculas.length) {
                renderSection(peliculasGrid, json.peliculas, 'peliculas');
                peliculasSection.classList.remove('hidden');
            } else {
                peliculasSection.classList.add('hidden');
            }

            // si no hay nada en todas las secciones
            if ((json.personajes?.length || 0) + (json.comics?.length || 0) + (json.series?.length || 0) + (json.peliculas?.length || 0) === 0) {
                loading.textContent = 'No se encontraron resultados.';
                loading.classList.remove('hidden');
            }

        } catch (err) {
            console.error(err);
            loading.textContent = 'Error buscando. Revisa la consola.';
        }
    }

    // Ejecutar búsqueda inicial (sin query) para poblar por defecto
    doSearch('');

    // Debounce input
    search.addEventListener('input', function () {
        clearTimeout(timer);
        const q = this.value.trim();
        timer = setTimeout(() => {
            doSearch(q);
        }, 350);
    });
});
</script>
@endsection
