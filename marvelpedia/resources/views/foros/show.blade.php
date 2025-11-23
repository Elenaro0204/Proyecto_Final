@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4" x-data="{ open: false }">

        <!-- Título del foro con personalización -->
        <div class="shadow-xl rounded-2xl p-6 mb-8 relative overflow-hidden"
            style="
                background: {{ $foro->color_fondo ?? 'linear-gradient(to right, #6366f1, #8b5cf6)' }};
                color: {{ $foro->color_titulo ?? '#ffffff' }};
            ">

            @if ($foro->imagen_portada)
                <div class="mb-4 rounded-2xl overflow-hidden relative h-40">
                    <img src="{{ asset('storage/' . $foro->imagen_portada) }}" alt="Portada"
                        class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-25 rounded-2xl pointer-events-none"></div>
                </div>
            @endif

            <h1 class="text-4xl md:text-5xl font-extrabold drop-shadow-lg">{{ $foro->titulo }}</h1>

            @if ($foro->descripcion)
                <p class="mt-3 text-lg md:text-xl drop-shadow-sm">{{ $foro->descripcion }}</p>
            @endif

            <div class="mt-4 flex flex-wrap gap-4 items-center">
                <span class="text-sm opacity-80">Creado por: {{ $foro->user->name ?? 'Desconocido' }}</span>
                <span class="text-sm opacity-80">| {{ $foro->created_at->diffForHumans() }}</span>
                <span
                    class="px-2 py-1 rounded-full text-sm font-semibold
                    {{ $foro->visibilidad === 'publico' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                    {{ ucfirst($foro->visibilidad) }}
                </span>
            </div>

            @if (auth()->check() && auth()->id() === $foro->user_id)
                <a href="{{ route('foros.edit', $foro->id) }}"
                    class="mt-6 inline-block px-5 py-2 bg-yellow-400 text-black rounded-full hover:bg-yellow-500 transition shadow-md">
                    Editar foro
                </a>
            @endif
        </div>

        <!-- Botón para abrir panel lateral -->
        <button @click="open = true"
            class="mb-6 px-5 py-2 bg-indigo-600 text-white rounded-full shadow hover:bg-indigo-700 transition duration-300">
            Nuevo mensaje
        </button>

        <!-- Mensajes -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Mensajes</h2>
            @if ($foro->mensajes->isEmpty())
                <p class="text-gray-500 italic">Todavía no hay mensajes en este foro. ¡Sé el primero en comentar!</p>
            @else
                <div class="space-y-4">
                    @foreach ($foro->mensajes->where('parent_id', null) as $mensaje)
                        @include('foros.mensaje-item', ['mensaje' => $mensaje])
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Panel lateral animado -->
        <div x-cloak x-show="open" class="fixed inset-0 top-16 flex justify-end z-40">
            <!-- Overlay -->
            <div @click="open = false" class="absolute inset-0 bg-black bg-opacity-50 transition-opacity" x-show="open"
                x-transition.opacity></div>

            <!-- Panel -->
            <div class="relative w-96 bg-white h-full p-6 shadow-2xl rounded-l-2xl transform transition-transform"
                x-show="open" x-transition:enter="transition duration-300" x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0" x-transition:leave="transition duration-300"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">

                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Nuevo mensaje</h2>
                <form action="{{ route('mensajes.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="foro_id" value="{{ $foro->id }}">
                    <textarea name="contenido" rows="6"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 mb-4"
                        placeholder="Escribe tu mensaje..."></textarea>
                    <div class="flex justify-end gap-3">
                        <button type="button" @click="open = false"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">Cancelar</button>
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Enviar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
