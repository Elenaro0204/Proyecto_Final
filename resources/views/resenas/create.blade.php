<!-- resources/views/resenas/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10 px-4">
        <div class="max-w-3xl mx-auto relative rounded-xl overflow-hidden shadow-xl p-6">
            <div class="absolute inset-0 bg-white opacity-50 z-0"></div>

            <div class="relative z-10 px-8 py-6">
                <div class="relative z-10 flex flex-col items-center text-center w-full">
                    <h2 class="text-2xl text-red-700 font-bold mb-3">Publicar nueva reseña</h2>
                </div>

                <form action="{{ route('resenas.store') }}" method="POST" class="space-y-3">
                    @csrf

                    @if ($errors->any())
                        <div class="bg-red-200 text-red-800 p-4 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Si viene desde una serie, película, cómic o personaje --}}
                    @if (!empty($type) && !empty($entity_id))
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" name="entity_id" value="{{ $entity_id }}">
                        <input type="hidden" name="entity_title" value="{{ $info['Title'] ?? $title }}">

                        <div class="bg-gray-100 p-3 rounded mb-4 flex items-center gap-3">

                            @if ($info && isset($info['Poster']))
                                <img src="{{ $info['Poster'] }}" alt="{{ $title }}"
                                    class="w-16 h-24 object-cover rounded shadow">
                            @endif

                            <div>
                                <p class="text-gray-700 mb-1">
                                    Estás escribiendo una reseña sobre:
                                </p>
                                <h3 class="font-bold text-lg text-red-700">{{ $info['Title'] ?? $title }}</h3>
                                <small class="text-gray-500 capitalize">
                                    Tipo: {{ $type }}
                                </small>
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="entity_title" id="entityTitleHidden">
                        {{-- Si viene desde la página general --}}
                        <label class="block">
                            Tipo de contenido:
                            <select name="type" id="typeSelect" class="border rounded p-2 w-full" required>
                                <option value="">Selecciona un tipo...</option>
                                <option value="pelicula">Película</option>
                                <option value="serie">Serie</option>
                            </select>
                        </label>

                        <label class="block">
                            Buscar entidad:
                            <input type="text" id="searchInput" class="border rounded p-2 w-full"
                                placeholder="🔍 Escribe para buscar..." disabled>
                        </label>

                        <label class="block">
                            Selecciona entidad:
                            <select name="entity_id" id="entitySelect" class="border rounded p-2 w-full" required disabled>
                                <option name="entity_title" value="">Primero selecciona tipo y busca...</option>
                            </select>
                        </label>
                    @endif

                    {{-- Reseña --}}
                    <label class="block">
                        Reseña:
                        <textarea name="content" rows="3" class="w-full border rounded p-2" placeholder="Escribe tu reseña..." required></textarea>
                    </label>

                    {{-- Puntuación --}}
                    <label class="block">
                        Puntuación:
                        <select name="rating" class="border rounded p-2 w-full" required>
                            <option value="1">⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="5">⭐⭐⭐⭐⭐</option>
                        </select>
                    </label>

                    <div class="flex flex-col sm:flex-row justify-between mt-4 gap-3">
                        <a href="{{ url()->previous() }}" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-center">
                            Cancelar
                        </a>

                        <button type="submit"
                            class="inline-block bg-yellow-400 text-red-900 shadow hover:bg-yellow-600 transition px-4 py-2 rounded">
                            Publicar reseña
                        </button>
                    </div>
                </form>
            </div>
    </div>
    </div>

    {{-- JS solo se ejecuta si no viene con tipo y entidad definidos --}}
    @if (empty($type) || empty($entity_id))
        <script>
            const typeSelect = document.getElementById('typeSelect');
            const searchInput = document.getElementById('searchInput');
            const entitySelect = document.getElementById('entitySelect');
            const entityIdHidden = document.getElementById('entityIdHidden');
            const entityTitleHidden = document.getElementById('entityTitleHidden');
            let timeoutId = null;

            typeSelect.addEventListener('change', () => {
                const type = typeSelect.value;
                if (type) {
                    searchInput.disabled = false;
                    entitySelect.disabled = false;
                    entitySelect.innerHTML = '<option value="">🔍 Escribe para buscar...</option>';
                    entityIdHidden.value = '';
                    entityTitleHidden.value = '';
                } else {
                    searchInput.disabled = true;
                    entitySelect.disabled = true;
                    entitySelect.innerHTML = '<option value="">Primero selecciona tipo...</option>';
                    entityIdHidden.value = '';
                    entityTitleHidden.value = '';
                }
            });

            // --- BÚSQUEDA USANDO TMDB ---
            searchInput.addEventListener('input', () => {
                const type = typeSelect.value;
                const query = searchInput.value.trim();

                if (!type || query.length < 1) {
                    entitySelect.innerHTML = '<option value="">🔍 Escribe para buscar...</option>';
                    return;
                }

                clearTimeout(timeoutId);

                timeoutId = setTimeout(() => {
                    fetch(`/api/buscar/resenas?type=${type}&q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            // TMDB devuelve: results: [...]
                            const results = data.results || [];
                            entitySelect.innerHTML = '';

                            if (results.length > 0) {
                                results.forEach(item => {
                                    const name = item.title || item.name || item.Title || item
                                        .original_title || 'Sin título';
                                    const id = item.id || item.imdbID || '';
                                    entitySelect.innerHTML +=
                                        `
                                        <option data-tmdbid="${id}" data-title="${name}" value="${id}">${name}</option>`;
                                });
                            } else {
                                entitySelect.innerHTML =
                                    '<option value="">No se encontraron coincidencias</option>';
                            }
                        })
                        .catch(() => {
                            entitySelect.innerHTML = '<option value="">Error al buscar resultados</option>';
                        });

                }, 400);
            });

            // cuando el usuario selecciona una opción guardamos en los hidden (y en el select si quieres)
            entitySelect.addEventListener('change', () => {
                const option = entitySelect.options[entitySelect.selectedIndex];
                if (!option) {
                    entityIdHidden.value = '';
                    entityTitleHidden.value = '';
                    return;
                }
                const tmdbId = option.dataset.tmdbid ?? option.value ?? '';
                const title = option.dataset.title ?? option.textContent.trim() ?? '';
                entityIdHidden.value = tmdbId;
                entityTitleHidden.value = title;
            });
        </script>
    @endif
@endsection
