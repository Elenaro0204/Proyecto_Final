<!-- resources/views/resenas/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10 px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-8 py-6">
                <h2 class="text-2xl font-bold mb-4">Editar reseña</h2>

                <form action="{{ route('resenas.update', $review->id) }}" method="POST" class="space-y-3">
                    @csrf
                    @method('PUT')

                    {{-- Tipo y entidad NO se pueden cambiar al editar --}}
                    <input type="hidden" name="type" value="{{ $review->type }}">
                    <input type="hidden" name="entity_id" value="{{ $review->entity_id }}">

                    <div class="bg-gray-100 p-3 rounded mb-4 flex items-center gap-3">
                        <div>
                            <p class="text-gray-700 mb-1">
                                Editando reseña sobre:
                            </p>
                            <h3 class="font-bold text-lg text-indigo-700">
                                {{ $info['Title'] ?? ($title ?? 'Elemento') }}
                            </h3>
                            <small class="text-gray-500 capitalize">
                                Tipo: {{ $review->type }}
                            </small>
                        </div>
                    </div>

                    {{-- Reseña --}}
                    <label class="block">
                        Reseña:
                        <textarea name="content" rows="3" class="w-full border rounded p-2" required>{{ old('content', $review->content) }}</textarea>
                    </label>

                    {{-- Puntuación --}}
                    <label class="block">
                        Puntuación:
                        <select name="rating" class="border rounded p-2 w-full" required>
                            <option value="1" @if ($review->rating == 1) selected @endif>⭐</option>
                            <option value="2" @if ($review->rating == 2) selected @endif>⭐⭐</option>
                            <option value="3" @if ($review->rating == 3) selected @endif>⭐⭐⭐</option>
                            <option value="4" @if ($review->rating == 4) selected @endif>⭐⭐⭐⭐</option>
                            <option value="5" @if ($review->rating == 5) selected @endif>⭐⭐⭐⭐⭐</option>
                        </select>
                    </label>

                    <div class="flex justify-between mt-4">
                        <a href="{{ url()->previous() }}" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">
                            Cancelar
                        </a>

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
