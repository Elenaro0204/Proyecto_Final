<!-- resources/views/profile/partials/menu_lateral.blade.php -->

<!-- Botón flotante global -->
<div x-data="{ open: false }">
    <!-- Botón fijo visible siempre -->
    <button @click="open = true"
        class="md:hidden fixed bottom-20 right-4 p-3 bg-gradient-to-b from-blue-700 to-red-700 text-white rounded-full shadow-lg hover:bg-indigo-700 z-50">
        ❓
    </button>

    <!-- Drawer lateral -->
    <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 -translate-x-full"
        class="fixed top-20 left-0 z-50 w-3/4 max-w-xs h-screen bg-gradient-to-b to-red-300 from-blue-200 shadow-2xl p-4 overflow-y-auto border-r-2 rounded-r-xl border-red-600"
        style="max-height: calc(100vh - 5rem);">

        <!-- Botón cerrar -->
        <div class="flex justify-end mb-4">
            <button @click="open = false" class="text-red-600 hover:text-red-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Contenido del menú -->
        @include('profile.partials.menu_lateral_content')
    </div>

    <!-- Menú para desktop -->
    <aside
        class="hidden sm:block bg-gradient-to-b to-red-300 from-blue-200 shadow-2xl rounded-3xl p-3 sticky top-24 h-fit overflow-y-auto border-2 border-red-600">
        @include('profile.partials.menu_lateral_content')
    </aside>
</div>
