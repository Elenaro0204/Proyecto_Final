<!-- resources/views/resenas/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Publicar nueva reseña</h2>

        <form action="{{ route('resenas.store') }}" method="POST" class="space-y-3">
            @csrf

            {{-- Si viene desde una serie, película, cómic o personaje --}}
            @if (!empty($type) && !empty($entity_id))
                <input type="hidden" name="type" value="{{ $type }}">
                <input type="hidden" name="entity_id" value="{{ $entity_id }}">

                <div class="bg-gray-100 p-3 rounded mb-4 flex items-center gap-3">

                    {{-- @if ($info && isset($info['Poster']))
                        <img src="{{ $info['Poster'] }}" alt="{{ $title }}"
                            class="w-16 h-24 object-cover rounded shadow">
                    @endif --}}

                    <div>
                        <p class="text-gray-700 mb-1">
                            Estás escribiendo una reseña sobre:
                        </p>
                        <h3 class="font-bold text-lg text-indigo-700">{{ $info['Title'] ?? $title }}</h3>
                        <small class="text-gray-500 capitalize">
                            Tipo: {{ $type }}
                        </small>
                    </div>
                </div>
            @else
                {{-- Si viene desde la página general --}}
                <label class="block">
                    Tipo de contenido:
                    <select name="type" id="typeSelect" class="border rounded p-2 w-full" required>
                        <option value="">Selecciona un tipo...</option>
                        <option value="comic">Cómic</option>
                        <option value="pelicula">Película</option>
                        <option value="serie">Serie</option>
                        {{-- <option value="personaje">Personaje</option> --}}
                    </select>
                </label>

                <label class="block">
                    Buscar entidad:
                    <input type="text" id="searchInput" class="border rounded p-2 w-full"
                        placeholder="Escribe para buscar..." disabled>
                </label>

                <label class="block">
                    Selecciona entidad:
                    <select name="entity_id" id="entitySelect" class="border rounded p-2 w-full" required disabled>
                        <option value="">Primero selecciona tipo y busca...</option>
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

            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded mt-2">
                Publicar reseña
            </button>
        </form>
    </div>

    {{-- JS solo se ejecuta si no viene con tipo y entidad definidos --}}
    @if (empty($type) || empty($entity_id))
        <script>
            const typeSelect = document.getElementById('typeSelect');
            const searchInput = document.getElementById('searchInput');
            const entitySelect = document.getElementById('entitySelect');
            let timeoutId = null;

            typeSelect.addEventListener('change', () => {
                const type = typeSelect.value;
                if (type) {
                    searchInput.disabled = false;
                    entitySelect.disabled = false;
                    entitySelect.innerHTML = '<option value="">Escribe para buscar...</option>';
                } else {
                    searchInput.disabled = true;
                    entitySelect.disabled = true;
                    entitySelect.innerHTML = '<option value="">Primero selecciona tipo...</option>';
                }
            });

            searchInput.addEventListener('input', () => {
                const type = typeSelect.value;
                const query = searchInput.value.trim();

                if (!type || query.length < 1) {
                    entitySelect.innerHTML = '<option value="">Escribe para buscar...</option>';
                    return;
                }

                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    fetch(`/api/buscar/resenas?type=${type}&q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            const results = data.results || data[type + 's'] || [];
                            entitySelect.innerHTML = '';

                            if (results.length > 0) {
                                results.forEach(item => {
                                    const name = item.title || item.name || item.Title;
                                    entitySelect.innerHTML +=
                                        `<option value="${item.id || item.imdbID}">${name}</option>`;
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
        </script>
    @endif
@endsection
