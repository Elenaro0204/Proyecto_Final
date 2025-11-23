<!-- resources/views/peliculas/show.blade.php -->

@extends('layouts.app')

@section('title', $pelicula['titulo'])

@section('content')
    <div class="container mt-5">

        {{-- Cabecera con imagen y título --}}
        <div class="row mb-4">
            <div class="col-md-4 text-center">
                @if ($pelicula['poster'])
                    <img src="{{ $pelicula['poster'] }}" alt="{{ $pelicula['titulo'] }}" class="img-fluid rounded shadow">
                @else
                    <img src="{{ asset('img/no-poster.png') }}" alt="Sin póster" class="img-fluid rounded shadow">
                @endif
            </div>
            <div class="col-md-8">
                <h1 class="fw-bold">{{ $pelicula['titulo'] }}</h1>
                <p class="text-muted">{{ $pelicula['anio'] }} | {{ ucfirst($pelicula['tipo']) }}</p>

                <div class="mb-3">
                    <span class="badge bg-primary">{{ $pelicula['genero'] }}</span>
                    <span class="badge bg-secondary">⭐ {{ $pelicula['puntuacion'] }}</span>
                </div>

                <p><strong>Director:</strong> {{ $pelicula['director'] }}</p>
                <p><strong>Actores:</strong> {{ $pelicula['actores'] }}</p>
                <p><strong>País:</strong> {{ $pelicula['pais'] }}</p>
                <p><strong>Idioma:</strong> {{ $pelicula['idioma'] }}</p>

                <hr>

                {{-- Botones de acción --}}
                <div class="d-flex flex-wrap gap-2 mt-8">
                    <button class="btn btn-outline-primary"><i class="bi bi-heart"></i> Añadir a favoritos</button>
                    <button class="btn btn-outline-success"><i class="bi bi-bookmark"></i> Ver más tarde</button>

                    @if (isset($pelicula['imdbID']))
                        <a href="{{ route('resenas.create.withparams', [
                            'type' => 'pelicula',
                            'entity_id' => $pelicula['imdbID'],
                            'title' => $pelicula['titulo'] ?? 'pelicula',
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
                <p>{{ $pelicula['sinopsis'] }}</p>
            </div>
        </div>

        {{-- Actores destacados --}}
        @if (!empty($pelicula['actores']))
            <div class="mt-8 mb-8">
                <h3 class="text-xl font-bold mb-3 text-gray-800">🎭 Actores</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach (explode(',', $pelicula['actores']) as $actor)
                        @php
                            $actor = trim($actor);
                            $wikiUrl = 'https://es.wikipedia.org/wiki/' . str_replace(' ', '_', $actor);
                            $imgDefault =
                                'https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png';
                        @endphp

                        <div
                            class="bg-white border rounded-lg shadow hover:shadow-lg transition p-3 flex flex-col items-center text-center">
                            <img src="{{ $imgDefault }}" alt="{{ $actor }}"
                                class="w-24 h-24 object-cover rounded-full mb-2 border border-gray-300">

                            <a href="{{ $wikiUrl }}" target="_blank"
                                class="font-semibold text-indigo-600 hover:underline">
                                {{ $actor }}
                            </a>
                            <small class="text-gray-500 mt-1">Ver en Wikipedia</small>
                        </div>
                    @endforeach
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
                    <p class="text-muted">Aún no hay reseñas para esta película. ¡Sé el primero en opinar!</p>
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
