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
                <p class="text-gray-500 text-lg">{{ \Carbon\Carbon::parse($serie['anio'])->format('d/m/Y') }} •
                    {{ $serie['genero'] }}</p>

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
                            <p class="text-sm text-gray-500">Idioma original</p>
                            <p class="font-semibold text-gray-800">{{ $serie['idioma'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Botones de acción --}}
                <div class="flex flex-wrap gap-3 mt-4">
                    @if (isset($serie['id']))
                        <a href="{{ route('resenas.create.withparams', [
                            'type' => 'serie',
                            'entity_id' => $serie['id'],
                            'title' => $serie['titulo'] ?? 'Serie',
                        ]) }}"
                            class="bg-yellow-400 text-indigo-900 px-4 py-2 rounded-lg shadow hover:bg-yellow-500 transition flex items-center gap-2">
                            <i class="bi bi-pencil-square"></i>
                            Escribir reseña
                        </a>
                    @endif

                    <a href="https://www.imdb.com/title/{{ $serie['imdbID'] }}" target="_blank"
                        class="text-white px-4 py-2 rounded-lg shadow hover:opacity-90 transition flex items-center gap-2"
                        style="background-color: #ff00c8;">
                        📺 Ver en IMDb
                    </a>

                    {{-- Compartir --}}
                    <div class="relative" x-data>
                        <button id="shareButton" aria-haspopup="true" aria-expanded="false"
                            class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition flex items-center gap-2">
                            <i class="bi bi-share"></i> Compartir
                        </button>

                        <ul id="shareMenu"
                            class="absolute top-full mt-2 left-0 bg-white shadow-lg rounded-lg overflow-hidden hidden z-50 w-56">
                            <li><a href="#" id="nativeShare" class="block px-4 py-2 hover:bg-gray-100"><i
                                        class="bi bi-phone"></i> Compartir
                                    directamente</a></li>
                            <li><a href="#" id="copyLink" class="block px-4 py-2 hover:bg-gray-100"><i
                                        class="bi bi-link-45deg"></i> Copiar enlace</a>
                            </li>
                            <li><a href="#" id="shareTwitter" target="_blank" rel="noopener"
                                    class="block px-4 py-2 hover:bg-gray-100"><i class="bi bi-twitter"></i> Twitter</a></li>
                            <li><a href="#" id="shareWhatsApp" target="_blank" rel="noopener"
                                    class="block px-4 py-2 hover:bg-gray-100"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                            </li>
                            <li><a href="#" id="shareFacebook" target="_blank" rel="noopener"
                                    class="block px-4 py-2 hover:bg-gray-100"><i class="bi bi-facebook"></i> Facebook</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sinopsis --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-2xl font-bold mb-3">Sinopsis</h2>
            <p class="text-gray-700">
                {{ $serie['overview'] ?? $serie['sinopsis'] }}
            </p>
        </div>

        {{-- Actores destacados --}}
        @if (!empty($serie['actores']))
            <div>
                <h3 class="text-2xl font-bold mb-4">🎭 Reparto Principal</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                    @foreach (explode(',', $serie['actores']) as $actor)
                        @php
                            $actor = trim($actor);
                            $wikiUrl = 'https://es.wikipedia.org/wiki/' . str_replace(' ', '_', $actor);
                            $imgUrl = $actorImages[$actor] ?? null;
                        @endphp
                        <a href="{{ $wikiUrl }}" target="_blank"
                            class="flex flex-col items-center text-center bg-white rounded-xl shadow hover:shadow-lg p-3 transition">
                            <img src="{{ $imgUrl }}" alt="{{ $actor }}"
                                class="w-24 h-24 rounded-full mb-2 border border-gray-200 object-cover">
                            <span class="font-semibold text-indigo-600 hover:underline">{{ $actor }}</span>
                            <small class="text-gray-400">Ver en Wikipedia</small>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Episodios por temporada --}}
        <div class="bg-white rounded-xl shadow p-6 mt-8 mb-8">
            <h3 class="text-2xl font-bold mb-4">📺 Temporadas</h3>
            <div class="space-y-4">
                @if (!empty($episodiosPorTemporada))

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
                                    <div class="row g-3 mb-1">
                                        @foreach ($episodios as $index => $e)
                                            @php
                                                // Generamos un id único por episodio
                                                $episodioId = 'episodio-' . $temporada . '-' . $index;
                                            @endphp
                                            <div class="col-12 mb-1">
                                                <div x-data="{ open: false }"
                                                    class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden transition-all">

                                                    {{-- Cabecera del episodio --}}
                                                    <button @click="open = !open"
                                                        class="card-header bg-white fw-semibold d-flex justify-content-between align-items-center"
                                                        style="cursor: pointer;">
                                                        <span class="text-start">
                                                            <strong>{{ $e['episode_number'] ?? 'N/A' }}.</strong>
                                                            {{ $e['name'] ?? 'Sin título' }}
                                                        </span>
                                                        <div class="d-flex align-items-center">
                                                            <span class="badge bg-warning text-dark ms-2">
                                                                ⭐ {{ $e['vote_average'] ?? 'N/A' }}
                                                            </span>
                                                            <svg :class="{
                                                                'rotate-180 text-red-400': open,
                                                                'text-yellow-400': !
                                                                    open
                                                            }"
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
                                                                {{ \Carbon\Carbon::parse($e['air_date'])->format('d/m/Y') ?? 'Sin fecha' }}
                                                            </p>
                                                            <p class="mb-1"><strong>⏱ Duración:</strong>
                                                                {{ $e['runtime'] ? $e['runtime'] . ' min' : 'Desconocida' }}
                                                            </p>
                                                            <p class="mb-1"><strong>🎬 Director:</strong>
                                                                {{ $serie['director'] ?? 'Desconocido' }}</p>
                                                            <p class="mb-2"><strong>📝 Sinopsis:</strong>
                                                                {{ $e['overview'] ?? 'Sin información' }}</p>
                                                            <p class="text-muted small"><strong>🔗 IMDb:</strong>
                                                                @if (!empty($e['imdbID']))
                                                                    <a href="https://www.imdb.com/title/{{ $e['imdbID'] }}"
                                                                        target="_blank"
                                                                        class="text-primary fw-bold text-decoration-underline">
                                                                        Ver episodio
                                                                    </a>
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
                @else
                    <p class="text-muted">No se han encontrado episodios para esta serie.</p>
                @endif
            </div>
        </div>

        {{-- Trailer si está disponible --}}
        <div class="bg-white rounded-xl shadow p-6 mt-5">
            <h3 class="text-2xl font-bold mb-4">📺 Trailers</h3>

            <div class="row">
                @forelse ($serie['videos'] as $video)
                    @if ($video['site'] === 'YouTube')
                        <div class="col-md-6 mb-4">
                            <iframe width="100%" height="315"
                                src="https://www.youtube.com/embed/{{ $video['key'] }}" class="rounded shadow"
                                allowfullscreen>
                            </iframe>
                        </div>
                    @endif
                @empty
                    <p>No hay vídeos disponibles.</p>
                @endforelse
            </div>
        </div>

        {{-- Galería --}}
        <div class="bg-white rounded-xl shadow p-6 mt-5">
            <h3 class="text-2xl font-bold mb-4">📺 Galería</h3>

            <div class="row">
                @foreach ($backdropsPaginated as $img)
                    <div class="col-md-4 mb-3">
                        <img src="https://image.tmdb.org/t/p/w780{{ $img['file_path'] }}"
                            class="img-fluid rounded shadow-sm" style="cursor:pointer" data-bs-toggle="modal"
                            data-bs-target="#imgModal"
                            onclick="showImage('https://image.tmdb.org/t/p/original{{ $img['file_path'] }}')">
                    </div>
                @endforeach
            </div>

            {{-- Paginación --}}
            <div class="mt-3 overflow-x-auto">
                {{ $backdropsPaginated->links() }}
            </div>
        </div>

        {{-- Recomendaciones --}}
        <div class="bg-white rounded-xl shadow p-6 mt-5">
            <h3 class="text-2xl font-bold mb-4">⭐ Series Recomendadas</h3>

            <div class="row g-4">
                @if ($recomendacionesPaginadas->count() > 0)
                    @foreach ($recomendacionesPaginadas as $rec)
                        <div class="col-6 col-md-3">
                            <div class="card shadow-sm border-0 h-100 rounded-lg hover:shadow-lg transition">
                                <img src="https://image.tmdb.org/t/p/w300{{ $rec['poster_path'] }}"
                                    class="card-img-top rounded-top" alt="{{ $rec['name'] }}">

                                <div class="card-body text-center">
                                    <h6 class="fw-bold text-dark mb-1">{{ $rec['name'] }}</h6>

                                    <a href="{{ route('serie.show', $rec['id']) }}"
                                        class="btn btn-outline-primary btn-sm mt-2">
                                        Ver detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No hay recomendaciones disponibles.</p>
                @endif
            </div>

            {{-- PAGINACIÓN --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $recomendacionesPaginadas->appends(['rec_page' => $recomendacionesPaginadas->currentPage()])->links() }}
            </div>
        </div>

        {{-- Reseñas desde la base de datos --}}
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-2xl font-bold mb-4">Reseñas de usuarios</h3>
                @if (isset($serie['id']))
                    <a href="{{ route('resenas.create.withparams', [
                        'type' => 'serie',
                        'entity_id' => $serie['id'],
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
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                    @foreach ($reseñas as $r)
                        <div class="border-b pb-3">
                            {{-- Avatar --}}
                            <div class="flex items-center gap-2 mb-1">
                                <div class="flex-shrink-0 mr-2">
                                    <img src="{{ $review->user->avatar_url ?? asset('images/default-avatar.jpeg') }}"
                                        alt="Avatar de {{ $review->user->name ?? 'Usuario' }}"
                                        class="w-12 h-12 rounded-full border-2 border-yellow-400 object-cover" />
                                </div>
                                <strong><a href="{{ route('users.show', $r->user->id) }}">{{ $r->user->name ?? 'Anónimo' }}</a></strong>
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

                            @auth
                                @php
                                    $userReport = $r->report?->firstWhere('reported_by', auth()->id());
                                    $tiempoRestante = $userReport
                                        ? max(0, now()->diffInSeconds($userReport->deadline))
                                        : 0;
                                @endphp

                                {{-- Reporte --}}
                                @if ($userReport && $tiempoRestante > 0)
                                    <div x-data="{
                                        tiempo: {{ $tiempoRestante }},
                                        get formato() {
                                            let segundos = Math.floor(this.tiempo);
                                            const years = Math.floor(segundos / (3600 * 24 * 365));
                                            segundos -= years * 3600 * 24 * 365;
                                            const months = Math.floor(segundos / (3600 * 24 * 30));
                                            segundos -= months * 3600 * 24 * 30;
                                            const days = Math.floor(segundos / (3600 * 24));
                                            segundos -= days * 3600 * 24;
                                            const hours = Math.floor(segundos / 3600);
                                            segundos -= hours * 3600;
                                            const minutes = Math.floor(segundos / 60);
                                            segundos -= minutes * 60;
                                            return [
                                                years > 0 ? `${years}a` : null,
                                                months > 0 ? `${months}m` : null,
                                                days > 0 ? `${days}d` : null,
                                                hours > 0 ? `${hours}h` : null,
                                                minutes > 0 ? `${minutes}m` : null,
                                                segundos >= 0 ? `${segundos}s` : null
                                            ].filter(Boolean).join(' ');
                                        },
                                        disminuir() { if (this.tiempo > 0) this.tiempo--; }
                                    }" x-init="setInterval(() => disminuir(), 1000)"
                                        class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 px-4 py-3 rounded-md shadow-md mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">

                                        <div class="font-semibold text-sm sm:text-base">⚠ Este mensaje ha sido reportado.</div>
                                        <div class="text-sm sm:text-base">
                                            Tiempo restante para modificarlo: <span x-text="formato" class="font-mono"></span>
                                        </div>
                                    </div>
                                @endif
                            @endauth

                            {{-- Botones Editar / Eliminar solo para el autor --}}
                            <div class="mt-3 flex flex-wrap gap-2">
                                {{-- Si el usuario ES EL AUTOR de la reseña --}}
                                @if (Auth::id() === $r->user_id)
                                    <a href="{{ route('resenas.edit', $r->id) }}"
                                        class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-sm transition">
                                        Editar
                                    </a>

                                    @if (!Auth::user()->isAdmin())
                                        <form action="{{ route('resenas.destroy', $r->id) }}" method="POST"
                                            onsubmit="return confirm('¿Seguro que quieres eliminar esta reseña?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md text-sm transition">
                                                Eliminar
                                            </button>
                                        </form>
                                    @endif
                                @endif

                                {{-- ADMIN --}}
                                @if (Auth::check() && Auth::user()->isAdmin())
                                    {{-- Añadir reporte si el admin NO lo ha reportado antes --}}
                                    @if (!$r->report?->firstWhere('reported_by', auth()->id()))
                                        <a href="{{ route('admin.resenas.addreport', $r->id) }}"
                                            class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-black rounded-md text-sm transition">
                                            Reportar
                                        </a>
                                    @else
                                        <form
                                            action="{{ route('admin.resenas.report.cancel', $r->report->firstWhere('reported_by', auth()->id())->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Seguro que quieres cancelar tu reporte?');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-gray-400 text-black hover:bg-gray-500 rounded-md text-sm transition">
                                                Cancelar reporte
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Eliminar como admin --}}
                                    <form action="{{ route('resenas.destroy', $r->id) }}" method="POST"
                                        onsubmit="return confirm('¿Seguro que quieres eliminar esta reseña como administrador?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-700 hover:bg-red-800 text-white rounded-md text-sm transition">
                                            Eliminar
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
            @endif
        </div>
    </div>

    <!-- Modal para ver imagen en grande -->
    <div class="modal fade" id="imgModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-dark">
                <div class="modal-body p-0">
                    <img id="modalImage" class="img-fluid w-100 rounded">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .pagination {
            flex-wrap: nowrap !important;
        }
    </style>
@endsection

@push('scripts')
    <script>
        function showImage(url) {
            document.getElementById('modalImage').src = url;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const shareButton = document.getElementById('shareButton');
            const shareMenu = document.getElementById('shareMenu');
            const nativeShare = document.getElementById('nativeShare');
            const copyLink = document.getElementById('copyLink');
            const shareTwitter = document.getElementById('shareTwitter');
            const shareWhatsApp = document.getElementById('shareWhatsApp');
            const shareFacebook = document.getElementById('shareFacebook');

            if (!shareButton || !shareMenu) return;

            const currentURL = window.location.href;
            const title = document.title || document.querySelector('h1')?.innerText || '';

            // Toggle menú
            function toggleMenu(open) {
                const isOpen = shareMenu.classList.contains('hidden') === false;
                const wantOpen = typeof open === 'boolean' ? open : !isOpen;
                shareMenu.classList.toggle('hidden', !wantOpen);
                shareButton.setAttribute('aria-expanded', wantOpen ? 'true' : 'false');
            }

            shareButton.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleMenu();
            });

            // Cerrar al hacer clic fuera
            document.addEventListener('click', (e) => {
                if (!shareMenu.classList.contains('hidden') && !shareMenu.contains(e.target) && e.target !==
                    shareButton) {
                    toggleMenu(false);
                }
            });

            // Rellenar enlaces de compartir
            if (shareTwitter) {
                shareTwitter.href =
                    `https://twitter.com/intent/tweet?url=${encodeURIComponent(currentURL)}&text=${encodeURIComponent(title)}`;
            }
            if (shareWhatsApp) {
                shareWhatsApp.href =
                    `https://api.whatsapp.com/send?text=${encodeURIComponent(title + ' ' + currentURL)}`;
            }
            if (shareFacebook) {
                shareFacebook.href =
                    `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentURL)}`;
            }

            // Compartir nativo
            if (nativeShare) {
                nativeShare.addEventListener('click', async (e) => {
                    e.preventDefault();
                    toggleMenu(false);
                    if (navigator.share) {
                        try {
                            await navigator.share({
                                title,
                                url: currentURL
                            });
                        } catch (err) {
                            console.error('Error al compartir:', err);
                        }
                    } else {
                        alert('Tu navegador no soporta la API de compartir. Usa "Copiar enlace".');
                    }
                });
            }

            // Copiar enlace
            if (copyLink) {
                copyLink.addEventListener('click', async (e) => {
                    e.preventDefault();
                    try {
                        await navigator.clipboard.writeText(currentURL);
                        toggleMenu(false);
                        // Mensaje de éxito: usa un toast o alert simple
                        alert('¡Enlace copiado al portapapeles!');
                    } catch (err) {
                        console.error('No se pudo copiar:', err);
                        alert('Error al copiar enlace.');
                    }
                });
            }

            // Evitar que los links del menú cierren la página accidentalmente (los externos seguirán)
            const menuLinks = shareMenu.querySelectorAll('a');
            menuLinks.forEach(a => {
                a.addEventListener('click', (e) => {
                    // Los que tienen href="#" deben prevenir la navegación
                    if (a.getAttribute('href') === '#') e.preventDefault();
                    // cerrar menú al clicar
                    toggleMenu(false);
                });
            });

            // Cerrar con ESC
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') toggleMenu(false);
            });
        });
    </script>
@endpush
