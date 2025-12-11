{{-- resources/views/users/partials/user_activity.blade.php --}}
<div class="mt-10 grid grid-cols-1 lg:grid-cols-3 gap-6 bg-white p-6 rounded-xl shadow-lg border border-red-600/20"
    style="background: linear-gradient(145deg, #ffffff, #f3f3f3);">

    {{-- Reseñas --}}
    <section class="mb-10">
        <h3 class="text-2xl font-bold mb-4">📝 Reseñas de {{ $user->name }}</h3>

        @forelse ($reseñas as $resena)
            <div class="bg-white p-4 rounded shadow border mb-4">
                <h4 class="font-semibold">{{ $resena->titulo_pelicula }}</h4>
                <p class="text-gray-600">{{ Str::limit($resena->content, 150) }}</p>
                <a href="{{ route('resenas.ver', $resena->id) }}" class="text-red-600 font-semibold">
                    Leer más
                </a>
            </div>
        @empty
            <p class="text-gray-500">No tiene reseñas aún.</p>
        @endforelse

        {{ $reseñas->links() }}
    </section>

    {{-- Foros --}}
    <section class="mb-10">
        <h3 class="text-2xl font-bold mb-4">📢 Foros creados por {{ $user->name }}</h3>

        @forelse ($foros as $foro)
            <div class="bg-white p-4 rounded shadow border mb-4">
                <h4 class="font-semibold">{{ $foro->titulo }}</h4>
                <p class="text-gray-600">{{ Str::limit($foro->contenido, 150) }}</p>
                <a href="{{ route('foros.show', $foro->id) }}" class="text-red-600 font-semibold">
                    Ver foro
                </a>
            </div>
        @empty
            <p class="text-gray-500">No ha creado foros todavía.</p>
        @endforelse

        {{ $foros->links() }}
    </section>

    {{-- Mensajes --}}
    <section>
        <h3 class="text-2xl font-bold mb-4">💬 Mensajes de {{ $user->name }}</h3>

        @forelse ($mensajes as $mensaje)
            <div class="bg-white p-4 rounded shadow border mb-4">
                <p>{{ Str::limit($mensaje->contenido, 150) }}</p>
                <a href="{{ route('foros.show', $mensaje->foro_id) }}" class="text-red-600 font-semibold">
                    Ver conversación
                </a>
            </div>
        @empty
            <p class="text-gray-500">No ha enviado mensajes aún.</p>
        @endforelse

        {{ $mensajes->links() }}
    </section>

</div>
