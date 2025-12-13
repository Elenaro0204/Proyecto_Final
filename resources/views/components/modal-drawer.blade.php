<!-- resources/views/components/modal-drawer.blade.php -->

@props(['review', 'model' => 'open'])

<div x-show="{{ $model }}" x-cloak class="fixed top-20 left-0 right-0 bottom-0 flex justify-end z-40">
    <!-- Overlay -->
    <div @click="closeModal" class="absolute inset-0 bg-black bg-opacity-10 z-40" x-show="{{ $model }}"
        x-transition.opacity></div>

    <!-- Panel -->
    <div class="relative bg-white w-full sm:w-96 max-h-screen sm:h-auto p-4 sm:p-6 shadow-2xl sm:rounded-l-2xl overflow-y-auto z-50 transform transition-transform"
        x-show="{{ $model }}" x-transition:enter="transition duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full">

        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl font-bold mb-2 text-red-600 text-center" x-text="data?.entity?.title ?? 'Reseña'"></h2>
            <button @click="closeModal" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
        </div>

        <img x-show="data?.entity?.poster" :src="data.entity.poster" alt=""
            class="w-full h-48 object-cover mb-3 sm:h-64">

        <!-- Información general -->
        <div class="mb-3 text-sm text-gray-600 space-y-1">
            <p class="text-gray-700 mb-2" x-text="data?.entity?.overview"></p>
            <p class="text-sm text-gray-500 mb-1"><strong>Año:</strong> <span x-text="data?.entity?.year"></span></p>
            <p class="text-sm text-gray-500 mb-1"><strong>Género:</strong> <span x-text="data?.entity?.genres"></span>
            </p>
            <p class="text-sm text-gray-500 mb-1" x-show="data?.entity?.director"><strong>Director:</strong> <span
                    x-text="data?.entity?.director"></span></p>
            <p class="text-sm text-gray-500 mb-1" x-show="data?.entity?.actors"><strong>Actores:</strong> <template
                    x-for="actor in data?.entity?.actors" :key="actor.name">
                    <a :href="actor.wiki" target="_blank" class="text-blue-600 underline mr-1" x-text="actor.name">
                    </a>
                </template></p>
        </div>

        <!-- Contenido de la reseña -->
        <div class="mb-3">
            <h3 class="font-semibold mb-2 text-yellow-500">Contenido</h3>
            <p class="text-gray-700 mb-2" x-text="data?.review?.content"></p>
            <p class="text-sm text-gray-500 mb-1">Tipo: <span x-text="data?.review?.type"></span></p>
            <p class="text-sm text-gray-500 mb-1">Publicado: <span
                    x-text="new Date(data?.review?.created_at).toLocaleString()"></span></p>
        </div>

        <!-- Usuario -->
        <div class="mb-3">
            <h3 class="font-semibold mb-2  text-yellow-500">Usuario</h3>
            <div class="flex items-center gap-3">
                <img class="w-12 h-12 rounded-full object-cover border border-gray-300"
                    x-bind:src="data?.review?.user?.avatar_url ?
                        ('/storage/' + data.review.user.avatar_url) :
                        '/images/default-avatar.jpeg'"
                    alt="Foto de perfil del usuario">
                <div>
                    <p class="text-sm text-gray-500 mb-1"><strong>Autor:</strong> <a
                            :href="'/users/' + (data?.review?.user?.id ?? '')" class="text-indigo-600 hover:underline">
                            <span x-text="data?.review?.user?.name ?? 'Anónimo'"></span>
                        </a></p>
                </div>
            </div>
        </div>

        <!-- Calificación -->
        <div class="mb-3">
            <h3 class="font-semibold mb-1 text-yellow-500">Calificación</h3>
            <p class="text-yellow-400 font-bold"
                x-text="data?.review?.rating ? '⭐'.repeat(data.review.rating) + ' (' + data.review.rating + '/5)' : 'Sin calificación'">
            </p>
        </div>

        <button @click="closeModal" class="w-full px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">
            Cerrar
        </button>
    </div>
</div>
