<div class="bg-white shadow-md rounded-lg p-4 relative mb-2 border-l-4
    {{ $mensaje->parent_id ? 'border-indigo-400 ml-6' : 'border-indigo-600' }}"
    x-data="{ editing: false, contenido: '{{ addslashes($mensaje->contenido) }}' }">

    <!-- Mensaje normal -->
    <template x-if="!editing">
        <div>
            <p class="text-gray-800" x-text="contenido"></p>
            <div class="mt-2 text-sm text-gray-500 flex justify-between items-center">
                <span>Por: {{ $mensaje->user->name ?? 'Desconocido' }}</span>
                <span>{{ $mensaje->created_at->diffForHumans() }}</span>
            </div>

            @if (auth()->check() && (auth()->id() === $mensaje->user_id || auth()->user()->is_admin))
                <div class="absolute top-2 right-2 flex space-x-2">
                    <button @click="editing = true" class="text-indigo-600 hover:underline text-sm">Editar</button>
                    <form action="{{ route('mensajes.destroy', $mensaje->id) }}" method="POST"
                        onsubmit="return confirm('¿Seguro que quieres eliminar este mensaje?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline text-sm">Eliminar</button>
                    </form>
                </div>
            @endif
        </div>
    </template>

    <!-- Formulario inline de edición -->
    <template x-if="editing">
        <form :action="'{{ route('mensajes.update', $mensaje->id) }}'" method="POST" class="mt-2">
            @csrf
            @method('PUT')
            <textarea name="contenido" x-model="contenido" rows="3" class="w-full border p-2 rounded mb-2"></textarea>
            <div class="flex gap-2">
                <button type="submit"
                    class="px-4 py-1 bg-green-600 text-white rounded hover:bg-green-700">Guardar</button>
                <button type="button" @click="editing = false"
                    class="px-4 py-1 bg-gray-300 rounded hover:bg-gray-400">Cancelar</button>
            </div>
        </form>
    </template>

    <!-- Botón para responder -->
    <button onclick="openReplyForm({{ $mensaje->id }})"
        class="text-indigo-600 hover:underline text-sm mt-2">Responder</button>

    <!-- Formulario de respuesta oculto -->
    <div id="replyForm-{{ $mensaje->id }}" class="mt-2 hidden">
        <form action="{{ route('mensajes.store') }}" method="POST">
            @csrf
            <input type="hidden" name="foro_id" value="{{ $foro->id }}">
            <input type="hidden" name="parent_id" value="{{ $mensaje->id }}">
            <textarea name="contenido" rows="2" class="w-full border p-2 rounded mb-2" placeholder="Escribe tu respuesta..."></textarea>
            <button type="submit"
                class="px-4 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">Enviar</button>
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
