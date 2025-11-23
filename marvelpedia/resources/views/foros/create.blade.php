@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 max-w-2xl">

        <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Crear Nuevo Foro</h1>

        <form action="{{ route('foros.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <!-- Título -->
            <div class="mb-4">
                <label for="titulo" class="block text-gray-700 font-semibold mb-2">Título del foro</label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('titulo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700 font-semibold mb-2">Descripción (opcional)</label>
                <textarea id="descripcion" name="descripcion" rows="4"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botón de enviar -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition font-semibold">
                    Crear Foro
                </button>
            </div>
        </form>
    </div>
@endsection
