<!-- resources/views/components/breadcrumb-drawer.blade.php -->
@props(['items'])

<div x-data="{ open: false }" class="relative z-30">

    <!-- Botón escritorio: vertical a la izquierda -->
    <button @click="open = true"
        class="hidden md:flex fixed top-16 left-0 h-[calc(100%-4rem)] w-fit p-2 bg-indigo-600 text-white z-50 hover:bg-indigo-700 items-center justify-center rounded-l-md shadow-lg
           transition-all duration-300 ease-in-out"
        :class="open ? '-translate-x-4 opacity-0' : 'translate-x-0 opacity-100'"
        style="writing-mode: vertical-rl; transform: rotate(180deg); font-size: 0.75rem;">
        <span class="text-xs sm:text-sm">¿Dónde estás?</span>
        <span class="mt-2 w-2 h-2 border-l-2 border-b-2 border-white rotate-45"></span>
    </button>

    <!-- Botón móvil: esquina inferior derecha -->
    <button @click="open = true"
        class="md:hidden fixed bottom-4 right-4 p-3 bg-indigo-600 text-white rounded-full shadow-lg hover:bg-indigo-700 z-50">
        📍
    </button>

    <!-- Panel lateral -->
    <aside x-show="open" @click.outside="open = false" x-transition:enter="transition-all duration-300 ease-out"
        x-transition:enter-start="-translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transition-all duration-300 ease-in" x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="-translate-x-full opacity-0"
        class="fixed top-16 left-0 w-56 sm:w-64 h-[calc(100%-4rem)] bg-white shadow-xl rounded-r-xl overflow-y-auto z-40 flex flex-col">

        <!-- Encabezado -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <div>
                <h2 class="text-lg font-bold text-gray-800 mb-1 flex items-center gap-1">
                    📍 Estás aquí
                </h2>
                <p class="text-sm text-gray-600">
                    Esta barra te indica la ubicación dentro del sitio y la jerarquía de las secciones.
                </p>
            </div>
            <button @click="open = false" class="text-gray-500 hover:text-gray-800 font-bold text-2xl">&times;</button>
        </div>

        <!-- Contenido -->
        <nav class="px-6 py-4 flex-1 overflow-y-auto">
            <ol class="flex flex-col space-y-2">
                @foreach ($items as $index => $item)
                    <li class="flex items-center">
                        <span class="ml-{{ $item['level'] * 4 }}">
                            @if ($index === count($items) - 1)
                                <span class="font-semibold text-gray-900">
                                    📍 {{ $item['label'] }}
                                </span>
                            @else
                                <a href="{{ $item['url'] }}" class="text-indigo-600 hover:underline">
                                    {{ $item['label'] }}
                                </a>
                            @endif
                        </span>
                    </li>
                @endforeach
            </ol>
        </nav>

        <!-- Pie -->
        <div class="p-4 border-t border-gray-200 text-sm text-gray-500">
            Puedes hacer clic en cualquier enlace para navegar directamente a esa sección.
        </div>
    </aside>

    <!-- Overlay móviles -->
    <div x-show="open" x-transition.opacity class="fixed inset-0 top-16 bg-black bg-opacity-50 md:hidden"
        @click="open = false">
    </div>

</div>
