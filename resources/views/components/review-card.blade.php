<!-- resources/views/components/review-card.blade.php -->

@props(['review'])

<div
    class="bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-xl transition overflow-hidden flex flex-col">
    @php
        use Illuminate\Support\Facades\Http;

        $poster = null;
        $titleInfo = null;
        $tmdbData = null;

        $apiKey = '068f9f8748c67a559a92eafb6a8eeda7';

        if (in_array($review->type, ['pelicula', 'serie'])) {
            try {
                if ($review->type === 'pelicula') {
                    $response = Http::get("https://api.themoviedb.org/3/movie/{$review->entity_id}", [
                        'api_key' => $apiKey,
                        'language' => 'es-ES',
                    ]);
                } elseif ($review->type === 'serie') {
                    $response = Http::get("https://api.themoviedb.org/3/tv/{$review->entity_id}", [
                        'api_key' => $apiKey,
                        'language' => 'es-ES',
                    ]);
                }

                $data = $response->json();

                if (isset($data['poster_path'])) {
                    $poster = 'https://image.tmdb.org/t/p/w500' . $data['poster_path'];
                }

                $titleInfo = $data['title'] ?? ($data['name'] ?? 'Desconocido');

                $tmdbData = $data;
            } catch (\Exception $e) {
                $poster = null;
                $titleInfo = null;
                $tmdbData = null;
            }
        }
    @endphp

    {{-- Imagen de la entidad --}}
    @if ($poster)
        <img src="{{ $poster }}" alt="{{ $titleInfo ?? $review->type }}" class="w-full h-48 object-cover">
    @endif

    <div class="p-4 flex flex-col flex-1">
        {{-- Header usuario y rating --}}
        <div class="flex justify-between items-center mb-2">
            {{-- Avatar --}}
            <div class="flex-shrink-0 flex flex-row items-center gap-3">
                <img src="{{ $review->user->avatar_url ? asset('storage/' . $review->user->avatar_url) : asset('images/default-avatar.jpeg') }}"
                    alt="Avatar de {{ $review->user->name ?? 'Usuario' }}"
                    class="w-16 h-16 rounded-full object-cover border-2 border-yellow-400" />
                <p class="font-semibold text-lg"><a
                        href="{{ route('users.show', $review->user->id) }}">{{ $review->user->name ?? 'Anónimo' }}</a>
                </p>
            </div>
            <p class="text-yellow-400 font-bold">{{ str_repeat('⭐', $review->rating) }}</p>
        </div>

        {{-- Información de la entidad --}}
        <div class="mb-2 text-sm text-gray-500">
            <span class="font-medium capitalize">{{ $review->type }}</span> |
            Título: {{ $titleInfo ?? 'Desconocido' }}
            @if ($tmdbData)
                | Año: {{ substr($tmdbData['release_date'] ?? ($tmdbData['first_air_date'] ?? 'Desconocido'), 0, 4) }}
                | Género:
                {{ isset($tmdbData['genres']) ? implode(', ', array_column($tmdbData['genres'], 'name')) : 'Desconocido' }}
            @endif
        </div>

        {{-- Contenido --}}
        <p class="text-gray-700 text-sm flex-1 mb-3 whitespace-pre-line">{{ $review->content }}</p>

        @if (auth()->check() && (auth()->id() === $review->user_id || auth()->user()->role === 'admin'))
            @php
                // Reporte del usuario logueado (admin o creador)
                $userReport = $review->report?->firstWhere('reported_by', auth()->id());

                // Reporte real (el único que existe para la reseña, venga de quien venga)
                $reporteGeneral = $review->report?->first();

                // El creador de la reseña
                $esCreador = auth()->id() === $review->user_id;

                // Tiempo restante: si es creador o admin → usa el reporte general
                $tiempoRestante = $reporteGeneral ? max(0, now()->diffInSeconds($reporteGeneral->deadline)) : 0;
            @endphp

            {{-- Reporte --}}
            @if (($esCreador || $userReport) && $tiempoRestante > 0)
                <div x-data="{
                    tiempo: {{ $tiempoRestante }},
                    get formato() {
                        let tiempoRestante = Math.floor(this.tiempo); // truncar totales
                        let segundos = tiempoRestante;

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
                    class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 px-4 py-3 rounded-md shadow-md mt-4 mb-4 flex flex-col sm:flex-row sm:items-center gap-2">

                    <div class="font-semibold text-sm sm:text-base">⚠ Este foro ha sido reportado.</div>
                    <div class="text-sm sm:text-base">
                        Tiempo restante para modificarlo: <span x-text="formato" class="font-mono"></span>
                    </div>
                </div>
            @endif
        @endif

        <div class="flex flex-col sm:flex-row gap-2 mt-auto items-stretch w-full">

            {{-- Botón para ver detalle --}}
            <button @click="openModal({{ $review->id }})"
                class="w-full sm:flex-1 bg-indigo-600 text-white hover:bg-indigo-700 px-3 py-2 rounded text-center transition text-sm font-semibold">
                Ver
            </button>

            {{-- Botones Editar y eliminar --}}
            @auth
                {{-- Editar y eliminar del usuario --}}
                @if (Auth::id() === $review->user_id)
                    <a href="{{ route('resenas.edit', $review->id) }}"
                        class="w-full sm:flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-center transition text-sm font-semibold">
                        Editar
                    </a>

                    @if (!Auth::user()->isAdmin())
                        <form action="{{ route('resenas.destroy', $review->id) }}" method="POST" class="w-full sm:flex-1"
                            onsubmit="return confirm('¿Seguro que quieres eliminar esta reseña?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded transition text-sm font-semibold">
                                Eliminar
                            </button>
                        </form>
                    @endif
                @endif

                {{-- Opciones admin --}}
                @if (Auth::user()->isAdmin())
                    @if (!$review->report->firstWhere('reported_by', auth()->id()))
                        <a href="{{ route('admin.resenas.addreport', $review->id) }}"
                            class="w-full sm:flex-1 bg-yellow-500 hover:bg-yellow-600 text-black px-3 py-2 rounded text-center transition text-sm font-semibold">
                            Reportar
                        </a>
                    @else
                        <form action="{{ route('admin.resenas.report.cancel', $userReport->id) }}" method="POST"
                            class="w-full sm:flex-1" onsubmit="return confirm('¿Seguro que quieres cancelar tu reporte?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full bg-gray-400 text-black hover:bg-gray-500 px-3 py-2 rounded text-center transition text-sm font-semibold">
                                Cancelar reporte
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('resenas.destroy', $review->id) }}" method="POST" class="w-full sm:flex-1"
                        onsubmit="return confirm('¿Seguro que quieres eliminar esta reseña como admin?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full bg-red-700 hover:bg-red-800 text-white px-3 py-2 rounded transition text-sm font-semibold">
                            Eliminar
                        </button>
                    </form>
                @endif
            @endauth
        </div>

    </div>
</div>
