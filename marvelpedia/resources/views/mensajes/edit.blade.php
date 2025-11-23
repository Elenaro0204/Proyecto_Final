@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Editar mensaje</h1>

            <form action="{{ route('mensajes.update', $mensaje->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="contenido" class="block text-gray-700 font-semibold mb-2">Mensaje</label>
                    <textarea name="contenido" id="contenido" rows="5"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('contenido', $mensaje->contenido) }}</textarea>
                    @error('contenido')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('foros.show', $mensaje->foro_id) }}"
                        class="text-gray-600 hover:underline">Cancelar</a>
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
