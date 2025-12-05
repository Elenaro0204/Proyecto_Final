<!-- resources/views/peliculas/show.blade.php -->

@extends('layouts.app')

@section('title', $pelicula['titulo'])

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Películas', 'url' => route('peliculas.index'), 'level' => 1],
        ['label' => $pelicula['titulo'], 'url' => route('pelicula.show', $pelicula['id']), 'level' => 2],
    ]" />

    <div class="container mx-auto px-4 py-8 space-y-12">

        {{-- Cabecera con imagen y título --}}
        <div class="flex flex-col lg:flex-row items-start gap-8">
            {{-- Imagen --}}
            <div class="flex-shrink-0 w-full lg:w-1/3 relative">
                <div class="aspect-w-2 aspect-h-3">
                    <img src="{{ $pelicula['poster'] ?? asset('img/no-poster.png') }}" alt="{{ $pelicula['titulo'] }}"
                        class="w-full rounded-xl shadow-lg object-cover">
                </div>
            </div>

            {{-- Información --}}
            <div class="flex-1 space-y-4">
                <h1 class="text-3xl font-extrabold text-gray-900">{{ $pelicula['titulo'] }}</h1>
                <p class="text-gray-500 text-lg">{{ $pelicula['anio'] }} | {{ ucfirst($pelicula['tipo']) }}</p>

                {{-- Badges --}}
                <div class="flex flex-wrap gap-2">
                    <span class="bg-indigo-600 text-white px-3 py-1 rounded-full text-sm">{{ $pelicula['genero'] }}</span>
                    <span class="bg-yellow-400 text-indigo-900 px-3 py-1 rounded-full text-sm">⭐
                        {{ $pelicula['puntuacion'] }}</span>
                </div>

                {{-- Datos adicionales --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                    <div class="bg-indigo-50 p-4 rounded-xl shadow hover:shadow-lg transition flex items-center gap-3">
                        <i class="bi bi-person-video text-indigo-500 text-2xl"></i>
                        <div>
                            <p class="text-sm text-gray-500">Director</p>
                            <p class="font-semibold text-gray-800">{{ $pelicula['director'] }}</p>
                        </div>
                    </div>

                    <div class="bg-indigo-50 p-4 rounded-xl shadow hover:shadow-lg transition flex items-center gap-3">
                        <i class="bi bi-people text-indigo-500 text-2xl"></i>
                        <div>
                            <p class="text-sm text-gray-500">Actores</p>
                            <p class="font-semibold text-gray-800 line-clamp-2">{{ $pelicula['actores'] }}</p>
                        </div>
                    </div>

                    <div class="bg-indigo-50 p-4 rounded-xl shadow hover:shadow-lg transition flex items-center gap-3">
                        <i class="bi bi-geo-alt text-indigo-500 text-2xl"></i>
                        <div>
                            <p class="text-sm text-gray-500">País</p>
                            <p class="font-semibold text-gray-800">{{ $pelicula['pais'] }}</p>
                        </div>
                    </div>

                    <div class="bg-indigo-50 p-4 rounded-xl shadow hover:shadow-lg transition flex items-center gap-3">
                        <i class="bi bi-translate text-indigo-500 text-2xl"></i>
                        <div>
                            <p class="text-sm text-gray-500">Idioma</p>
                            <p class="font-semibold text-gray-800">{{ $pelicula['idioma'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Botones de acción --}}
                <div class="flex flex-wrap gap-3 mt-4">
                    @if (isset($pelicula['imdbID']))
                        <a href="{{ route('resenas.create.withparams', [
                            'type' => 'pelicula',
                            'entity_id' => $pelicula['imdbID'],
                            'title' => $pelicula['titulo'],
                        ]) }}"
                            class="bg-yellow-400 text-indigo-900 px-4 py-2 rounded-lg shadow hover:bg-yellow-500 transition flex items-center gap-2">
                            <i class="bi bi-pencil-square"></i> Escribir reseña
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
                {{ $pelicula['sinopsis_es'] ?? $pelicula['sinopsis'] }}
            </p>
        </div>

        {{-- Actores destacados --}}
        @if (!empty($pelicula['actores']))
            <div>
                <h3 class="text-2xl font-bold mb-4">🎭 Actores</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                    @foreach (explode(',', $pelicula['actores']) as $actor)
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

        {{-- Reseñas --}}
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-2xl font-bold mb-4">Reseñas de usuarios</h3>
                @if (isset($pelicula['imdbID']))
                    <a href="{{ route('resenas.create.withparams', [
                        'type' => 'pelicula',
                        'entity_id' => $pelicula['imdbID'],
                        'title' => $pelicula['titulo'] ?? 'pelicula',
                    ]) }}"
                        class="inline-block mb-4 px-6 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                        Escribir reseña
                    </a>
                @endif
            </div>

            @if ($reseñas->isEmpty())
                <p class="text-gray-500 italic">Aún no hay reseñas para esta película. ¡Sé el primero en opinar!</p>
            @else
                <div class="space-y-4">
                    @foreach ($reseñas as $r)
                        <div class="border-b pb-3">
                            {{-- Avatar --}}
                            <div class="flex items-center gap-3 mb-1">
                                <img src="{{ $r->user->avatar_url ?? asset('images/default-avatar.jpeg') }}" alt="Avatar"
                                    class="w-12 h-12 rounded-full border-2 border-yellow-400 object-cover">
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
                </div>
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
