<!-- resources/views/series/show.blade.php -->

@extends('layouts.app')

@section('title', $serie['titulo'])

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Series', 'url' => route('series'), 'level' => 1],
        ['label' => $serie['titulo'], 'url' => route('serie.show', $serie['id']), 'level' => 2],
    ]" />

    <div class="container mx-auto px-4 py-8 space-y-12">

        {{-- Cabecera con imagen y título --}}
        <div class="flex flex-col lg:flex-row items-start gap-8">
            <div class="flex-shrink-0 w-full lg:w-1/3 relative">
                <div class="aspect-w-2 aspect-h-3">
                    <img src="{{ $serie['poster'] ?? asset('img/no-poster.png') }}" alt="{{ $serie['titulo'] }}"
                        class="w-full rounded-xl shadow-lg object-cover">
                </div>
            </div>

            {{-- Información --}}
            <div class="flex-1 space-y-4">
                <h1 class="text-3xl font-extrabold text-gray-900">{{ $serie['titulo'] }}</h1>
                <p class="text-gray-500 text-lg">{{ $serie['anio'] }} | {{ ucfirst($serie['tipo']) }}</p>

                {{-- Badges --}}
                <div class="flex flex-wrap gap-2">
                    <span class="bg-indigo-600 text-white px-3 py-1 rounded-full text-sm">{{ $serie['genero'] }}</span>
                    <span class="bg-yellow-400 text-indigo-900 px-3 py-1 rounded-full text-sm">⭐
                        {{ $serie['puntuacion'] }}</span>
                    <span class="bg-red-400 text-white px-3 py-1 rounded-full text-sm">Temporadas:
                        {{ $serie['temporadas'] }}</span>
                </div>

                {{-- Datos adicionales --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                    <div class="bg-indigo-50 p-4 rounded-xl shadow hover:shadow-lg transition flex items-center gap-3">
                        <i class="bi bi-person-video text-indigo-500 text-2xl"></i>
                        <div>
                            <p class="text-sm text-gray-500">Director</p>
                            <p class="font-semibold text-gray-800">{{ $serie['director'] }}</p>
                        </div>
                    </div>

                    <div class="bg-indigo-50 p-4 rounded-xl shadow hover:shadow-lg transition flex items-center gap-3">
                        <i class="bi bi-people text-indigo-500 text-2xl"></i>
                        <div>
                            <p class="text-sm text-gray-500">Actores</p>
                            <p class="font-semibold text-gray-800 line-clamp-2">{{ $serie['actores'] }}</p>
                        </div>
                    </div>

                    <div class="bg-indigo-50 p-4 rounded-xl shadow hover:shadow-lg transition flex items-center gap-3">
                        <i class="bi bi-geo-alt text-indigo-500 text-2xl"></i>
                        <div>
                            <p class="text-sm text-gray-500">País</p>
                            <p class="font-semibold text-gray-800">{{ $serie['pais'] }}</p>
                        </div>
                    </div>

                    <div class="bg-indigo-50 p-4 rounded-xl shadow hover:shadow-lg transition flex items-center gap-3">
                        <i class="bi bi-translate text-indigo-500 text-2xl"></i>
                        <div>
                            <p class="text-sm text-gray-500">Idioma</p>
                            <p class="font-semibold text-gray-800">{{ $serie['idioma'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Botones de acción --}}
                <div class="flex flex-wrap gap-3 mt-4">
                    @if (isset($serie['imdbID']))
                        <a href="{{ route('resenas.create.withparams', [
                            'type' => 'serie',
                            'entity_id' => $serie['imdbID'],
                            'title' => $serie['titulo'] ?? 'Serie',
                        ]) }}"
                            class="bg-yellow-400 text-indigo-900 px-4 py-2 rounded-lg shadow hover:bg-yellow-500 transition flex items-center gap-2">
                            <i class="bi bi-pencil-square"></i>
                            Escribir reseña
                        </a>
                    @endif

                    {{-- Compartir --}}
                    <div class="relative">
                        <button
                            class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition flex items-center gap-2">
                            <i class="bi bi-share"></i> Compartir
                        </button>
                        <ul class="absolute top-full mt-2 left-0 bg-white shadow-lg rounded-lg overflow-hidden hidden">
                            <li><a href="#" id="nativeShare" class="block px-4 py-2 hover:bg-gray-100">Compartir
                                    directamente</a></li>
                            <li><a href="#" id="copyLink" class="block px-4 py-2 hover:bg-gray-100">Copiar enlace</a>
                            </li>
                            <li><a href="#" id="shareTwitter" target="_blank"
                                    class="block px-4 py-2 hover:bg-gray-100">Twitter</a></li>
                            <li><a href="#" id="shareWhatsApp" target="_blank"
                                    class="block px-4 py-2 hover:bg-gray-100">WhatsApp</a></li>
                            <li><a href="#" id="shareFacebook" target="_blank"
                                    class="block px-4 py-2 hover:bg-gray-100">Facebook</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sinopsis --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-2xl font-bold mb-3">Sinopsis</h2>
            <p class="text-gray-700">
                {{ $serie['sinopsis_es'] ?? $serie['sinopsis'] }}
            </p>
        </div>

        {{-- Actores destacados --}}
        @if (!empty($serie['actores']))
            <div>
                <h3 class="text-2xl font-bold mb-4">🎭 Actores</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                    @foreach (explode(',', $serie['actores']) as $actor)
                        @php
                            $actor = trim($actor);
                            $wikiUrl = 'https://es.wikipedia.org/wiki/' . str_replace(' ', '_', $actor);
                            $imgDefault =
                                'https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png';
                        @endphp
                        <a href="{{ $wikiUrl }}" target="_blank"
                            class="flex flex-col items-center text-center bg-white rounded-xl shadow hover:shadow-lg p-3 transition">
                            <img src="{{ $imgDefault }}" alt="{{ $actor }}"
                                class="w-24 h-24 rounded-full mb-2 border border-gray-200 object-cover">
                            <span class="font-semibold text-indigo-600 hover:underline">{{ $actor }}</span>
                            <small class="text-gray-400">Ver en Wikipedia</small>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Episodios por temporada --}}
        @if (!empty($episodiosPorTemporada))
            <div class="mt-8 mb-8">
                @foreach ($episodiosPorTemporada as $temporada => $episodios)
                    <div x-data="{ openTemporada: false }" class="card shadow-sm border-0 rounded-3 overflow-hidden">

                        {{-- Botón de temporada --}}
                        <button @click="openTemporada = !openTemporada"
                            class="card-header bg-primary text-white d-flex justify-content-between align-items-center fw-bold"
                            style="cursor: pointer; font-size: 1.1rem;">
                            <span>📺 Temporada {{ $temporada }} ({{ count($episodios) }})</span>
                            <div class="d-flex align-items-center">
                                <svg :class="{
                                    'rotate-180 text-red-400': openTemporada,
                                    'text-yellow-400': !openTemporada
                                }"
                                    class="ml-2 h-5 w-5 transition-all duration-300 transform"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.25 8.27a.75.75 0 01-.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>

                        {{-- Contenido de la temporada --}}
                        <div x-show="openTemporada" x-transition class="card-body bg-light p-3">
                            @if (!empty($episodios))
                                <div class="row g-3">
                                    @foreach ($episodios as $index => $e)
                                        @php
                                            // Generamos un id único por episodio
                                            $episodioId = 'episodio-' . $temporada . '-' . $index;
                                        @endphp
                                        <div class="col-md-6">
                                            <div x-data="{ open: false }"
                                                class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden transition-all">

                                                {{-- Cabecera del episodio --}}
                                                <button @click="open = !open"
                                                    class="card-header bg-white fw-semibold d-flex justify-content-between align-items-center"
                                                    style="cursor: pointer;">
                                                    <span class="text-start">
                                                        <strong>{{ $e['Episode'] }}.</strong> {{ $e['Title'] }}
                                                    </span>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-warning text-dark ms-2">
                                                            ⭐ {{ $e['imdbRating'] ?? 'N/A' }}
                                                        </span>
                                                        <svg :class="{ 'rotate-180 text-red-400': open, 'text-yellow-400': !open }"
                                                            class="ml-2 h-5 w-5 transition-all duration-300 transform"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.25 8.27a.75.75 0 01-.02-1.06z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                </button>

                                                {{-- Fondo desplegable --}}
                                                <div x-show="open" x-transition.opacity class="bg-light"
                                                    style="overflow: hidden; transition: max-height 0.3s ease; max-height: 1000px;">
                                                    <div class="card-body p-3 border-top text-secondary"
                                                        style="font-size: 0.9rem;">
                                                        <p class="mb-1"><strong>📅 Fecha de estreno:</strong>
                                                            {{ $e['Released'] ?? 'Sin fecha' }}</p>
                                                        <p class="mb-1"><strong>⏱ Duración:</strong>
                                                            {{ $e['Runtime'] ?? 'Desconocida' }}</p>
                                                        <p class="mb-1"><strong>🎬 Director:</strong>
                                                            {{ $e['Director'] ?? 'Desconocido' }}</p>
                                                        <p class="mb-1"><strong>✍️ Guionistas:</strong>
                                                            {{ $e['Writer'] ?? 'Desconocido' }}</p>
                                                        <p class="mb-2"><strong>📝 Sinopsis:</strong>
                                                            {{ $e['Plot'] ?? 'Sin información' }}</p>
                                                        <p class="text-muted small"><strong>🔗 IMDb:</strong>
                                                            @if (!empty($e['imdbID']))
                                                                <a href="https://www.imdb.com/title/{{ $e['imdbID'] }}"
                                                                    target="_blank"
                                                                    class="text-warning text-decoration-none">Enlace al
                                                                    episodio en IMDb</a>
                                                            @else
                                                                N/A
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted m-2">No hay episodios disponibles para esta temporada.</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">No se han encontrado episodios para esta serie.</p>
        @endif

        {{-- Trailer si está disponible --}}
        @if (!empty($serie['trailer_url']))
            <div class="card mb-5 mt-5 shadow-sm border-0">
                <div class="card-body">
                    <h4 class="mb-3">🎥 Trailer</h4>
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ $serie['trailer_url'] }}" title="Trailer de {{ $serie['titulo'] }}"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        @endif

        {{-- Reseñas desde la base de datos --}}
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-2xl font-bold mb-4">Reseñas de usuarios</h3>
                @if (isset($serie['imdbID']))
                    <a href="{{ route('resenas.create.withparams', [
                        'type' => 'serie',
                        'entity_id' => $serie['imdbID'],
                        'title' => $serie['titulo'] ?? 'serie',
                    ]) }}"
                        class="inline-block mb-4 px-6 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                        Escribir reseña
                    </a>
                @endif
            </div>

            @if ($reseñas->isEmpty())
                <p class="text-gray-500 italic">Aún no hay reseñas para esta serie. ¡Sé el primero en opinar!</p>
            @else
                <div class="space-y-4">
                    @foreach ($reseñas as $r)
                        <div class="border-b pb-3">
                            {{-- Avatar --}}
                            <div class="flex items-center gap-2 mb-1">
                                <div class="flex-shrink-0 mr-2">
                                    <img src="{{ $review->user->avatar_url ?? asset('images/default-avatar.jpeg') }}"
                                        alt="Avatar de {{ $review->user->name ?? 'Usuario' }}"
                                        class="w-12 h-12 rounded-full border-2 border-yellow-400 object-cover" />
                                </div>
                                <strong>{{ $r->user->name ?? 'Anónimo' }}</strong>
                            </div>

                            {{-- Puntuación --}}
                            <div class="text-yellow-400 mb-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= $r->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                            </div>

                            {{-- Contenido --}}
                            <p class="text-gray-700">{{ $r->content }}</p>

                            {{-- Fecha --}}
                            <small class="text-gray-400">{{ $r->created_at->diffForHumans() }}</small>

                            {{-- Botones Editar / Eliminar solo para el autor --}}
                            @auth
                                @if (Auth::id() === $r->user_id)
                                    <div class="mt-2 flex gap-2">
                                        <a href="{{ route('resenas.edit', $r->id) }}"
                                            class="text-indigo-600 hover:underline">Editar</a>
                                        <form action="{{ route('resenas.destroy', $r->id) }}" method="POST"
                                            onsubmit="return confirm('¿Seguro que quieres eliminar esta reseña?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    @endforeach
            @endif
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        const currentURL = window.location.href;
        const title = document.title;

        // Compartir nativo
        document.getElementById('nativeShare').addEventListener('click', async (e) => {
            e.preventDefault();
            if (navigator.share) {
                try {
                    await navigator.share({
                        title: title,
                        url: currentURL
                    });
                } catch (err) {
                    console.error('Error al compartir:', err);
                }
            } else {
                alert('Tu navegador no soporta compartir directamente, usa las otras opciones.');
            }
        });

        // Copiar enlace
        document.getElementById('copyLink').addEventListener('click', (e) => {
            e.preventDefault();
            navigator.clipboard.writeText(currentURL)
                .then(() => alert('¡Enlace copiado al portapapeles!'))
                .catch(err => alert('Error al copiar enlace: ' + err));
        });

        // Twitter
        document.getElementById('shareTwitter').href =
            `https://twitter.com/intent/tweet?url=${encodeURIComponent(currentURL)}&text=${encodeURIComponent(title)}`;

        // WhatsApp
        document.getElementById('shareWhatsApp').href =
            `https://api.whatsapp.com/send?text=${encodeURIComponent(title + ' ' + currentURL)}`;

        // Facebook
        document.getElementById('shareFacebook').href =
            `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentURL)}`;
    </script>
@endsection
