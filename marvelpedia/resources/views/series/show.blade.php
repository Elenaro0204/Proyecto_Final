<!-- resources/views/series/show.blade.php -->

@extends('layouts.app')

@section('title', $serie['titulo'])

@section('content')
    <div class="container mt-5">

        {{-- Cabecera con imagen y título --}}
        <div class="row mb-4">
            <div class="col-md-4 text-center">
                @if ($serie['poster'])
                    <img src="{{ $serie['poster'] }}" alt="{{ $serie['titulo'] }}" class="img-fluid rounded shadow">
                @else
                    <img src="{{ asset('img/no-poster.png') }}" alt="Sin póster" class="img-fluid rounded shadow">
                @endif
            </div>
            <div class="col-md-8">
                <h1 class="fw-bold">{{ $serie['titulo'] }}</h1>
                <p class="text-muted">{{ $serie['anio'] }} | {{ ucfirst($serie['tipo']) }}</p>

                <div class="mb-3">
                    <span class="badge bg-primary">{{ $serie['genero'] }}</span>
                    <span class="badge bg-secondary">⭐ {{ $serie['puntuacion'] }}</span>
                    <span class="badge bg-info">Temporadas: {{ $serie['temporadas'] }}</span>
                </div>

                <p><strong>Director:</strong> {{ $serie['director'] }}</p>
                <p><strong>Actores:</strong> {{ $serie['actores'] }}</p>
                <p><strong>País:</strong> {{ $serie['pais'] }}</p>
                <p><strong>Idioma:</strong> {{ $serie['idioma'] }}</p>

                <hr>

                {{-- Botones de acción --}}
                <div class="d-flex flex-wrap gap-2 mt-8">
                    <button class="btn btn-outline-primary"><i class="bi bi-heart"></i> Añadir a favoritos</button>
                    <button class="btn btn-outline-success"><i class="bi bi-bookmark"></i> Ver más tarde</button>

                    @if (isset($serie['imdbID']))
                        <a href="{{ route('resenas.create.withparams', [
                            'type' => 'serie',
                            'entity_id' => $serie['imdbID'],
                            'title' => $serie['titulo'] ?? 'Serie',
                        ]) }}"
                            class="btn btn-outline-warning">
                            <i class="bi bi-pencil-square"></i>
                            Escribir reseña
                        </a>
                    @endif

                    <div class="dropdown">
                        <button class="btn btn-outline-danger dropdown-toggle" type="button" id="shareDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-share"></i> Compartir
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="shareDropdown">
                            <li><a class="dropdown-item" href="#" id="nativeShare">Compartir directamente</a></li>
                            <li><a class="dropdown-item" href="#" id="copyLink">Copiar enlace</a></li>
                            <li><a class="dropdown-item" href="#" id="shareTwitter" target="_blank">Twitter</a></li>
                            <li><a class="dropdown-item" href="#" id="shareWhatsApp" target="_blank">WhatsApp</a></li>
                            <li><a class="dropdown-item" href="#" id="shareFacebook" target="_blank">Facebook</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sinopsis --}}
        <div class="card mb-5 shadow-sm border-0">
            <div class="card-body">
                <h4 class="mb-3">Sinopsis</h4>
                <p>{{ $serie['sinopsis'] }}</p>
            </div>
        </div>

        {{-- Actores destacados --}}
        @if (!empty($serie['actores']))
            <div class="mt-8 mb-8">
                <h3 class="text-xl font-bold mb-3 text-gray-800">🎭 Actores</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach ($serie['actores_imagenes'] as $actor => $img)
                        <div
                            class="bg-white border rounded-lg shadow hover:shadow-lg transition p-3 flex flex-col items-center text-center">
                            <img src="{{ $img }}" alt="{{ $actor }}"
                                class="w-24 h-24 object-cover rounded-full mb-2 border border-gray-300">

                            <a href="https://es.wikipedia.org/wiki/{{ str_replace(' ', '_', $actor) }}" target="_blank"
                                class="font-semibold text-indigo-600 hover:underline">
                                {{ $actor }}
                            </a>
                            <small class="text-gray-500 mt-1">Ver en Wikipedia</small>
                        </div>
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

        {{-- Enlaces a otras secciones --}}
        <div class="card mb-5 shadow-sm border-0">
            <div class="card-body">
                <h4 class="mb-3">Descubre más</h4>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('peliculas.index') }}" class="btn btn-outline-dark">🎬 Películas</a>
                    <a href="{{ route('series') }}" class="btn btn-outline-dark">📺 Series</a>
                    <a href="{{ route('comics') }}" class="btn btn-outline-dark">📚 Cómics</a>
                    <a href="{{ route('personajes') }}" class="btn btn-outline-dark">🦸 Personajes</a>
                </div>
            </div>
        </div>

        {{-- Reseñas desde la base de datos --}}
        <div class="card mb-5 shadow-sm border-0">
            <div class="card-body">
                <h4 class="mb-3">Reseñas de usuarios</h4>

                @if ($reseñas->isEmpty())
                    <p class="text-muted">Aún no hay reseñas para esta serie. ¡Sé el primero en opinar!</p>
                @else
                    @foreach ($reseñas as $r)
                        <div class="border-bottom pb-3 mb-3">
                            {{-- Avatar --}}
                            <div class="flex items-center gap-2 mb-1">
                                <div class="flex-shrink-0 mr-2">
                                    <img src="{{ $review->user->avatar_url ?? asset('images/default-avatar.jpeg') }}"
                                        alt="Avatar de {{ $review->user->name ?? 'Usuario' }}"
                                        class="w-12 h-12 rounded-full object-cover border-2 border-yellow-400" />
                                </div>
                                <strong class="text-primary">{{ $r->user->name ?? 'Anónimo' }}</strong>
                            </div>

                            {{-- Puntuación --}}
                            <div class="text-yellow-400 mb-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= $r->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                            </div>

                            {{-- Contenido --}}
                            <p class="mb-1 text-gray-700">{{ $r->content }}</p>

                            {{-- Fecha --}}
                            <small class="text-muted">{{ $r->created_at->diffForHumans() }}</small>

                            {{-- Botones Editar / Eliminar solo para el autor --}}
                            @auth
                                @if (Auth::id() === $r->user_id)
                                    <div class="mt-2 flex gap-2">
                                        <a href="{{ route('resenas.edit', $r->id) }}"
                                            class="text-blue-500 hover:underline">Editar</a>
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

                {{-- Botón para escribir nueva reseña --}}
                @if (isset($pelicula['imdbID']))
                    <a href="{{ route('resenas.create.withparams', [
                        'type' => 'pelicula',
                        'entity_id' => $pelicula['imdbID'],
                        'title' => $pelicula['titulo'] ?? 'pelicula',
                    ]) }}"
                        class="px-4 py-2 my-4 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                        Escribir reseña
                    </a>
                @endif
            </div>
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
