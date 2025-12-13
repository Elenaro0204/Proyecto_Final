<!-- resources/views/foros/mensaje-item.blade.php -->

<div class="bg-white shadow-md rounded-lg p-4 relative mb-2 border-l-4
    {{ $mensaje->parent_id ? 'border-red-400 ml-6' : 'border-red-600' }}"
    x-data="{ editing: false, contenido: '{{ addslashes($mensaje->contenido) }}' }">

    <!-- Mensaje normal -->
    <template x-if="!editing">
        <div>
            <p class="text-gray-800 break-words" x-text="contenido"></p>

            <div
                class="mt-2 text-sm text-gray-500 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                <span>Por: <a
                        href="{{ route('users.show', $mensaje->user->id) }}">{{ $mensaje->user->name ?? 'Desconocido' }}</a></span>
                <span>{{ $mensaje->created_at->diffForHumans() }}</span>
            </div>

            {{-- Botones de acción --}}
            @if (auth()->check() && (auth()->id() === $mensaje->user_id || auth()->user()->role === 'admin'))
                @php
                    // Reporte del usuario logueado (admin o creador)
                    $userReport = $mensaje->reports?->firstWhere('reported_by', auth()->id());

                    // Reporte real (el único que existe para la reseña, venga de quien venga)
                    $reporteGeneral = $mensaje->reports?->first();

                    // El creador de la reseña
                    $esCreador = auth()->id() === $mensaje->user_id;

                    // Tiempo restante: si es creador o admin → usa el reporte general
                    $tiempoRestante = $reporteGeneral ? max(0, now()->diffInSeconds($reporteGeneral->deadline)) : 0;
                @endphp

                {{-- Reporte --}}
                @if (($esCreador || $userReport) && $tiempoRestante > 0)
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

                <div class="mt-3 flex flex-wrap gap-2">
                    {{-- Usuario propietario --}}
                    @if (Auth::id() === $mensaje->user_id)
                        <button @click="editing = true; contenido = '{{ addslashes($mensaje->contenido) }}';"
                            class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-sm transition">
                            Editar
                        </button>

                        @if (!Auth::user()->isAdmin())
                            <form action="{{ route('mensajes.destroy', $mensaje->id) }}" method="POST"
                                onsubmit="return confirm('¿Seguro que quieres eliminar este mensaje?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 bg-red-700 hover:bg-red-800 text-white rounded-md text-sm transition">
                                    Eliminar
                                </button>
                            </form>
                        @endif
                    @endif

                    {{-- Admin --}}
                    @if (Auth::user()->isAdmin())
                        @if (!$mensaje->reports?->firstWhere('reported_by', auth()->id()))
                            <a href="{{ route('admin.mensajes.addreport', $mensaje->id) }}"
                                class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-black rounded-md text-sm transition">
                                Reportar
                            </a>
                        @else
                            <form action="{{ route('admin.mensajes.report.cancel', $userReport->id) }}" method="POST"
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
                        <form action="{{ route('mensajes.destroy', $mensaje->id) }}" method="POST"
                            onsubmit="return confirm('¿Seguro que quieres eliminar este mensaje como admin?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-3 py-1 bg-red-700 hover:bg-red-800 text-white rounded-md text-sm transition">
                                Eliminar
                            </button>
                        </form>
                    @endif
                </div>
            @endauth
    </div>
</template>

<!-- Formulario inline de edición -->
<template x-if="editing">
    <form :action="'{{ route('mensajes.update', $mensaje->id) }}'" method="POST" class="mt-2 flex flex-col gap-2">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <textarea name="contenido" x-model="contenido" rows="3" class="w-full border p-2 rounded-md text-gray-800"></textarea>
        <div class="flex flex-col sm:flex-row justify-between mt-4 gap-3">
            <button type="submit"
                class="px-4 py-1 bg-yellow-400 hover:bg-yellow-500 text-red-800 rounded-md transition">
                Guardar
            </button>
            <button type="button" @click="editing = false"
                class="px-4 py-1 bg-gray-300 hover:bg-gray-400 rounded-md transition">
                Cancelar
            </button>
        </div>
    </form>
</template>

<!-- Botón para responder -->
@auth
    <button onclick="openReplyForm({{ $mensaje->id }})"
        class="mt-2 text-indigo-600 hover:underline text-sm">Responder</button>
@endauth

<!-- Formulario de respuesta oculto -->
<div id="replyForm-{{ $mensaje->id }}" class="mt-2 hidden">
    <form action="{{ route('mensajes.store') }}" method="POST" class="flex flex-col gap-2">
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

        <input type="hidden" name="foro_id" value="{{ $foro->id }}">
        <input type="hidden" name="parent_id" value="{{ $mensaje->id }}">
        <textarea name="contenido" rows="2" class="w-full border p-2 rounded-md" placeholder="Escribe tu respuesta..."></textarea>
        <button type="submit"
            class="px-4 py-1 bg-yellow-400 hover:bg-yellow-500 text-red-800 rounded-md transition">
            Enviar
        </button>
    </form>
</div>

<!-- Respuestas recursivas -->
@if ($mensaje->respuestas->isNotEmpty())
    <div class="ml-6 mt-2 space-y-2">
        @foreach ($mensaje->respuestas as $respuesta)
            @include('foros.mensaje-item', ['mensaje' => $respuesta])
        @endforeach
    </div>
@endif
</div>

@section('scripts')
<script>
    function openReplyForm(id) {
        const form = document.getElementById('replyForm-' + id);
        form.classList.toggle('hidden');
    }
</script>
@endsection
