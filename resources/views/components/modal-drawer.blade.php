<!-- resources/views/components/modal-drawer.blade.php -->

@props(['review', 'model' => 'open'])

<div x-show="{{ $model }}" x-cloak class="fixed inset-0 top-16 flex justify-end z-40">
    <!-- Overlay -->
    <div @click="closeModal" class="absolute inset-0 bg-black bg-opacity-10 transition-opacity" x-show="{{ $model }}"
        x-transition.opacity></div>

    <!-- Panel -->
    <div class="relative bg-white w-full sm:w-96 h-full sm:h-auto p-4 sm:p-6 shadow-2xl sm:rounded-l-2xl overflow-y-auto transform transition-transform"
        x-show="{{ $model }}" x-transition:enter="transition duration-300" x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transition duration-300"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">

        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl font-bold mb-2" x-text="data?.entity?.title ?? 'Reseña'"></h2>
            <button @click="closeModal" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
        </div>

        <img x-show="data?.entity?.poster" :src="data.entity.poster" alt=""
            class="w-full h-48 object-cover mb-3 sm:h-64">

        <!-- Información general -->
        <div class="mb-3 text-sm text-gray-600 space-y-1">
            <p class="text-gray-700 mb-2" x-text="data?.entity?.plot"></p>
            <p class="text-sm text-gray-500 mb-1"><strong>Año:</strong> <span x-text="data?.entity?.year"></span></p>
            <p class="text-sm text-gray-500 mb-1"><strong>Género:</strong> <span x-text="data?.entity?.genre"></span>
            </p>
            <p class="text-sm text-gray-500 mb-1" x-show="data?.entity?.director"><strong>Director:</strong> <span
                    x-text="data?.entity?.director"></span></p>
            <p class="text-sm text-gray-500 mb-1" x-show="data?.entity?.actors"><strong>Actores:</strong> <span
                    x-text="data?.entity?.actors"></span></p>
        </div>

        <!-- Contenido de la reseña -->
        <div class="mb-3">
            <h3 class="font-semibold mb-2">Contenido</h3>
            <p class="text-gray-700 mb-2" x-text="data?.review?.content"></p>
            <p class="text-sm text-gray-500 mb-1">Tipo: <span x-text="data?.review?.type"></span></p>
            <p class="text-sm text-gray-500 mb-1">Publicado: <span
                    x-text="new Date(data?.review?.created_at).toLocaleString()"></span></p>

            @php
                $userReport = $review->report?->firstWhere('reported_by', auth()->id());
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
                    class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 px-4 py-3 rounded-md shadow-md mb-4 flex flex-col sm:flex-row sm:items-center gap-2">

                    <div class="font-semibold text-sm sm:text-base">⚠ Esta reseña ha sido reportada.</div>
                    <div class="text-sm sm:text-base">
                        Tiempo restante para modificarla: <span x-text="formato" class="font-mono"></span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Usuario -->
        <div class="mb-3">
            <h3 class="font-semibold mb-2">Usuario</h3>
            <div class="flex items-center gap-3">
                <img class="w-12 h-12 rounded-full object-cover border border-gray-300"
                    x-bind:src="data?.review?.user?.avatar_url ?? '/images/default-avatar.jpeg'"
                    alt="Foto de perfil del usuario">
                <div>
                    <p class="text-sm text-gray-500 mb-1"><strong>Autor:</strong> <span
                            x-text="data?.review?.user?.name ?? 'Anónimo'"></span></p>
                    <p class="text-sm text-gray-500 mb-1"><strong>Email:</strong> <span
                            x-text="data?.review?.user?.email ?? 'No disponible'"></span></p>
                </div>
            </div>
        </div>

        <!-- Calificación -->
        <div class="mb-3">
            <h3 class="font-semibold mb-1">Calificación</h3>
            <p class="text-yellow-400 font-bold"
                x-text="data?.review?.rating ? '⭐'.repeat(data.review.rating) + ' (' + data.review.rating + '/10)' : 'Sin calificación'">
            </p>
        </div>

        <button @click="closeModal" class="w-full bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 mt-3">
            Cerrar
        </button>
    </div>
</div>
