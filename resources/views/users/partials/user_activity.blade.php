{{-- resources/views/users/partials/user_activity.blade.php --}}
<div class="relative z-10 grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Reseñas --}}
    <section class="mb-10">
        <div class="relative z-10 flex flex-col items-center text-center w-full">
            <h3 class="text-xl text-red-700 font-bold mb-3 uppercase">Reseñas</h3>
        </div>

        @forelse ($reseñas as $resena)
            <div class="bg-white p-4 rounded shadow border mb-4">
                <h4 class="font-semibold mb-3">{{ $resena->entity_title }}</h4>
                <p class="text-gray-600 mb-3">{{ Str::limit($resena->content, 150) }}</p>
                <a href="{{ route('resenas.ver', $resena->id) }}"
                    class="mt-3 px-4 py-2 bg-yellow-400 text-red-900 font-semibold rounded-md shadow hover:bg-yellow-500 transition-colors cursor-pointer">
                    Leer más
                </a>
            </div>
        @empty
            <p class="text-gray-500">No tiene reseñas aún.</p>
        @endforelse

        {{-- Paginación --}}
        <div class="mt-3 overflow-x-auto">
            {{ $reseñas->links() }}
        </div>
    </section>

    {{-- Foros --}}
    <section class="mb-10">
        <div class="relative z-10 flex flex-col items-center text-center w-full">
            <h3 class="text-xl text-red-700 font-bold mb-3 uppercase">Foros</h3>
        </div>

        @forelse ($foros as $foro)
            <div class="bg-white p-4 rounded shadow border mb-4">
                <h4 class="font-semibold">{{ $foro->titulo }}</h4>
                <p class="text-gray-600">{{ Str::limit($foro->contenido, 150) }}</p>
                {{-- Visibilidad --}}
                <p
                    class="mt-2 text-sm font-semibold
                {{ $foro->visibilidad === 'publico' ? 'text-green-600' : 'text-red-600' }}">
                    🔒 {{ ucfirst($foro->visibilidad) }}
                </p>

                {{-- Botón solo si es público --}}
                @if ($foro->visibilidad === 'publico')
                    <a href="{{ route('foros.show', $foro->id) }}"
                        class="mt-3 px-4 py-2 bg-yellow-400 text-red-900 font-semibold rounded-md shadow hover:bg-yellow-500 transition-colors cursor-pointer">
                        Ver foro
                    </a>
                @else
                    <span class="text-gray-500 italic">Este foro es privado</span>
                @endif
            </div>
        @empty
            <p class="text-gray-500">No ha creado foros todavía.</p>
        @endforelse

        {{-- Paginación --}}
        <div class="mt-3 overflow-x-auto">
            {{ $foros->links() }}
        </div>
    </section>

    {{-- Mensajes --}}
    <section>
        <div class="relative z-10 flex flex-col items-center text-center w-full">
            <h3 class="text-xl text-red-700 font-bold mb-3 uppercase">Mensajes</h3>
        </div>

        @forelse ($mensajes as $mensaje)
            <div class="bg-white p-4 rounded shadow border mb-4">
                <p class="mb-3">{{ Str::limit($mensaje->contenido, 150) }}</p>
                <a href="{{ route('foros.show', $mensaje->foro_id) }}"
                    class="mt-3 px-4 py-2 bg-yellow-400 text-red-900 font-semibold rounded-md shadow hover:bg-yellow-500 transition-colors cursor-pointer">
                    Ver conversación
                </a>
            </div>
        @empty
            <p class="text-gray-500">No ha enviado mensajes aún.</p>
        @endforelse

        {{-- Paginación --}}
        <div class="mt-3 overflow-x-auto">
            {{ $mensajes->links() }}
        </div>
    </section>
</div>
