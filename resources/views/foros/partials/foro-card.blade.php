<!-- resources/views/foros/partials/foro-card.blade.php -->
<div class="rounded-2xl overflow-hidden shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl"
    style="background: {{ $foro->color_fondo ?? 'white' }}; color: {{ $foro->color_titulo ?? 'black' }};">
    <div class="flex flex-col justify-between h-full">
        @if ($foro->imagen)
            <div class="relative w-full h-40 md:h-48">
                <img src="{{ asset('storage/portadas/' . basename($foro->imagen)) }}" alt="Portada"
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-10 rounded-t-2xl pointer-events-none"></div>
            </div>
        @endif

        <div class="p-4 flex flex-col justify-between flex-grow">
            <div class="flex flex-col gap-1">
                <h2 class="text-xl md:text-2xl font-bold mb-2 color: {{ $foro->color_titulo ?? 'black' }}">
                    {{ $foro->titulo }}</h2>
                <p class="text-sm md:text-base mb-3 line-clamp-3  color: {{ $foro->color_titulo ?? 'black' }}">
                    {{ $foro->descripcion ?? 'Sin descripción' }}</p>
            </div>

            <div class="flex flex-col gap-1">
                <p class="text-xs md:text-sm opacity-70">Creado por: <a href="{{ route('users.show', $foro->user->id) }}">{{ $foro->user->name ?? 'Usuario desconocido' }}</a>
                </p>
                <div class="flex items-center gap-2 text-xs md:text-sm opacity-70">
                    <span>Estado:</span>
                    @if ($foro->visibilidad === 'publico')
                        <span class="px-2 py-1 bg-green-200 text-green-800 rounded-full font-semibold">Público</span>
                    @else
                        <span class="px-2 py-1 bg-red-200 text-red-800 rounded-full font-semibold">Privado</span>
                    @endif
                </div>
            </div>

            @php
                $userReport = $foro->report?->firstWhere('reported_by', auth()->id());
                $tiempoRestante = $userReport ? max(0, now()->diffInSeconds($userReport->deadline)) : 0;
            @endphp

            {{-- Reporte --}}
            @if ($userReport && $tiempoRestante > 0)
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
                    class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 px-4 py-3 rounded-md shadow-md mt-4 flex flex-col sm:flex-row sm:items-center gap-2">

                    <div class="font-semibold text-sm sm:text-base">⚠ Este foro ha sido reportado.</div>
                    <div class="text-sm sm:text-base">
                        Tiempo restante para modificarlo: <span x-text="formato" class="font-mono"></span>
                    </div>
                </div>
            @endif

            <div class="flex gap-2 mt-4 items-stretch">
                {{-- Botón para ver detalle --}}
                <a href="{{ route('foros.show', $foro->id) }}"
                    class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-indigo-500 text-white rounded-lg text-sm shadow hover:bg-indigo-600 transition duration-300">
                    Entrar
                </a>

                {{-- Botones Editar y eliminar --}}
                @auth
                    @if (Auth::id() === $foro->user_id)
                        <a href="{{ route('foros.edit', $foro->id) }}"
                            class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-blue-500 text-white rounded-lg text-sm shadow hover:bg-blue-600 transition duration-300">
                            Editar
                        </a>
                        @if (!Auth::user()->isAdmin())
                            <form action="{{ route('foros.destroy', $foro->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-red-500 text-white rounded-lg text-sm shadow hover:bg-red-600 transition duration-300">
                                    Eliminar
                                </button>
                            </form>
                        @endif
                    @endif

                    {{-- Opciones admin --}}
                    @if (Auth::user()->isAdmin())
                        @if (!$foro->report->firstWhere('reported_by', auth()->id()))
                            <a href="{{ route('admin.foros.addreport', $foro->id) }}"
                                class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-yellow-500 text-black rounded-lg text-sm shadow hover:bg-yellow-600 transition duration-300">
                                Reportar
                            </a>
                        @else
                            <form action="{{ route('admin.foro.report.cancel', $userReport->id) }}" method="POST"
                                onsubmit="return confirm('¿Seguro que quieres cancelar tu reporte?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-gray-400 text-black rounded-lg text-sm shadow hover:bg-gray-500 transition duration-300">
                                    Cancelar reporte
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('foros.destroy', $foro->id) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full inline-flex justify-center items-center px-4 py-2 bg-red-700 text-white rounded-lg text-sm shadow hover:bg-red-800 transition duration-300">
                                Eliminar
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
