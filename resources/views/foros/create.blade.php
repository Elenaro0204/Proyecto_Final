<!-- resources/views/foros/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10 px-4">
        <div class="max-w-3xl mx-auto relative rounded-xl overflow-hidden shadow-xl p-6">
            <div class="absolute inset-0 bg-white opacity-50 z-0"></div>

            <div class="relative z-10 px-8 py-6">
                <div class="relative z-10 flex flex-col items-center text-center w-full">
                    <h2 class="text-2xl text-red-700 font-bold mb-3">{{ isset($foro) ? 'Editar Foro' : 'Crear Nuevo Foro' }}
                    </h2>
                </div>

                <form action="{{ isset($foro) ? route('foros.update', $foro->id) : route('foros.store') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if (isset($foro))
                        @method('PUT')
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-200 text-red-800 p-4 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Título -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Título</label>
                        <input type="text" name="titulo" value="{{ old('titulo', $foro->titulo ?? '') }}"
                            class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required>
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Descripción</label>
                        <textarea name="descripcion" rows="4"
                            class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>{{ old('descripcion', $foro->descripcion ?? '') }}</textarea>
                    </div>

                    <!-- Color de fondo -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Color de fondo</label>
                        <div class="flex flex-row items-center gap-4 mb-2">
                            <!-- Previsualización -->
                            <div id="colorPreview" class="w-1/4 h-16 rounded-lg border border-gray-300"></div>
                            <select id="colorFondoSelect" name="color_fondo"
                                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="linear-gradient(to right, #6366f1, #8b5cf6)"
                                    {{ old('color_fondo', $foro->color_fondo ?? '') == 'linear-gradient(to right, #6366f1, #8b5cf6)' ? 'selected' : '' }}>
                                    Azul a morado</option>
                                <option value="linear-gradient(to right, #f59e0b, #f97316)"
                                    {{ old('color_fondo', $foro->color_fondo ?? '') == 'linear-gradient(to right, #f59e0b, #f97316)' ? 'selected' : '' }}>
                                    Naranja cálido</option>
                                <option value="linear-gradient(to right, #3b82f6, #06b6d4)"
                                    {{ old('color_fondo', $foro->color_fondo ?? '') == 'linear-gradient(to right, #3b82f6, #06b6d4)' ? 'selected' : '' }}>
                                    Azul cielo a cian</option>
                                <option value="linear-gradient(to right, #8b5cf6, #ec4899)"
                                    {{ old('color_fondo', $foro->color_fondo ?? '') == 'linear-gradient(to right, #8b5cf6, #ec4899)' ? 'selected' : '' }}>
                                    Morado a rosa</option>
                                <option value="linear-gradient(to right, #facc15, #f43f5e)"
                                    {{ old('color_fondo', $foro->color_fondo ?? '') == 'linear-gradient(to right, #facc15, #f43f5e)' ? 'selected' : '' }}>
                                    Amarillo a rojo</option>

                                <option value="#10b981"
                                    {{ old('color_fondo', $foro->color_fondo ?? '') == '#10b981' ? 'selected' : '' }}>Verde
                                    sólido</option>
                                <option value="#f87171"
                                    {{ old('color_fondo', $foro->color_fondo ?? '') == '#f87171' ? 'selected' : '' }}>Rojo
                                    sólido</option>
                                <option value="#3b82f6"
                                    {{ old('color_fondo', $foro->color_fondo ?? '') == '#3b82f6' ? 'selected' : '' }}>Azul
                                    sólido</option>
                                <option value="#fbbf24"
                                    {{ old('color_fondo', $foro->color_fondo ?? '') == '#fbbf24' ? 'selected' : '' }}>
                                    Amarillo
                                    sólido</option>
                                <option value="#a78bfa"
                                    {{ old('color_fondo', $foro->color_fondo ?? '') == '#a78bfa' ? 'selected' : '' }}>Lila
                                    sólido</option>
                            </select>
                        </div>
                    </div>

                    <!-- Color del título -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Color del título</label>
                        <input type="color" name="color_titulo"
                            value="{{ old('color_titulo', $foro->color_titulo ?? '#000000') }}"
                            class="w-20 h-10 rounded-lg border border-gray-300">
                    </div>

                    <!-- Imagen de portada -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Imagen de portada</label>
                        <input type="file" name="imagen" class="mb-2">

                        @if (isset($foro) && $foro->imagen)
                            <div class="relative mb-4">
                                <img src="{{ asset('storage/' . $foro->imagen) }}" alt="Portada"
                                    class="w-full h-48 object-cover rounded-lg shadow-sm">
                                <label
                                    class="absolute top-2 right-2 inline-flex items-center bg-red-500 text-white px-3 py-1 rounded-full cursor-pointer hover:bg-red-600">
                                    <input type="checkbox" name="eliminar_imagen" class="hidden">
                                    Eliminar
                                </label>
                            </div>
                        @endif
                    </div>

                    <!-- Visibilidad -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Visibilidad</label>
                        <select name="visibilidad"
                            class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="publico"
                                {{ old('visibilidad', $foro->visibilidad ?? '') === 'publico' ? 'selected' : '' }}>Público
                            </option>
                            <option value="privado"
                                {{ old('visibilidad', $foro->visibilidad ?? '') === 'privado' ? 'selected' : '' }}>Privado
                            </option>
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="flex flex-col sm:flex-row justify-between mt-4 gap-3">
                        <a href="{{ url()->previous() }}" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-center">
                            Cancelar
                        </a>

                        <button type="submit"
                            class="px-4 py-2 bg-yellow-400 text-red-800 font-semibold rounded-lg hover:bg-yellow-500 transition">
                            {{ isset($foro) ? 'Guardar Cambios' : 'Crear Foro' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const select = document.getElementById('colorFondoSelect');
        const preview = document.getElementById('colorPreview');

        function updatePreview() {
            preview.style.background = select.value;
        }

        // Inicializa con el valor actual
        updatePreview();

        // Cambia al seleccionar
        select.addEventListener('change', updatePreview);
    </script>
@endpush
