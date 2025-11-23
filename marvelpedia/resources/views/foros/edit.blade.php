@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10 px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-8 py-6">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Personalizar Foro</h2>

                <form action="{{ route('foros.update', $foro->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Título -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Título</label>
                        <input type="text" name="titulo" value="{{ old('titulo', $foro->titulo) }}"
                            class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Descripción</label>
                        <textarea name="descripcion" rows="4"
                            class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('descripcion', $foro->descripcion) }}</textarea>
                    </div>

                    <!-- Color de fondo -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Color de fondo</label>
                        <select name="color_fondo"
                            class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">

                            <!-- Gradientes -->
                            <option value="linear-gradient(to right, #6366f1, #8b5cf6)"
                                {{ old('color_fondo', $foro->color_fondo) == 'linear-gradient(to right, #6366f1, #8b5cf6)' ? 'selected' : '' }}>
                                Azul a morado
                            </option>
                            <option value="linear-gradient(to right, #f59e0b, #f97316)"
                                {{ old('color_fondo', $foro->color_fondo) == 'linear-gradient(to right, #f59e0b, #f97316)' ? 'selected' : '' }}>
                                Naranja cálido
                            </option>
                            <option value="linear-gradient(to right, #3b82f6, #06b6d4)"
                                {{ old('color_fondo', $foro->color_fondo) == 'linear-gradient(to right, #3b82f6, #06b6d4)' ? 'selected' : '' }}>
                                Azul cielo a cian
                            </option>
                            <option value="linear-gradient(to right, #8b5cf6, #ec4899)"
                                {{ old('color_fondo', $foro->color_fondo) == 'linear-gradient(to right, #8b5cf6, #ec4899)' ? 'selected' : '' }}>
                                Morado a rosa
                            </option>
                            <option value="linear-gradient(to right, #facc15, #f43f5e)"
                                {{ old('color_fondo', $foro->color_fondo) == 'linear-gradient(to right, #facc15, #f43f5e)' ? 'selected' : '' }}>
                                Amarillo a rojo
                            </option>

                            <!-- Colores sólidos -->
                            <option value="#10b981"
                                {{ old('color_fondo', $foro->color_fondo) == '#10b981' ? 'selected' : '' }}>Verde sólido
                            </option>
                            <option value="#f87171"
                                {{ old('color_fondo', $foro->color_fondo) == '#f87171' ? 'selected' : '' }}>Rojo sólido
                            </option>
                            <option value="#3b82f6"
                                {{ old('color_fondo', $foro->color_fondo) == '#3b82f6' ? 'selected' : '' }}>Azul sólido
                            </option>
                            <option value="#fbbf24"
                                {{ old('color_fondo', $foro->color_fondo) == '#fbbf24' ? 'selected' : '' }}>Amarillo sólido
                            </option>
                            <option value="#a78bfa"
                                {{ old('color_fondo', $foro->color_fondo) == '#a78bfa' ? 'selected' : '' }}>Lila sólido
                            </option>
                        </select>
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
                        <input type="file" name="imagen_portada" class="mb-2">

                        @if ($foro->imagen_portada)
                            <div class="relative mb-4">
                                <img src="{{ asset('storage/' . $foro->imagen_portada) }}" alt="Portada"
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
                                {{ old('visibilidad', $foro->visibilidad) === 'publico' ? 'selected' : '' }}>Público
                            </option>
                            <option value="privado"
                                {{ old('visibilidad', $foro->visibilidad) === 'privado' ? 'selected' : '' }}>Privado
                            </option>
                        </select>
                    </div>

                    <!-- Botón de Guardar -->
                    <div class="text-center">
                        <button type="submit"
                            class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
