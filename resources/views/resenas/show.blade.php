<!-- resources/views/resenas/show.blade.php -->

@extends('layouts.app')

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Reseñas', 'url' => route('resenas'), 'level' => 1],
        ['label' => $review->titulo_pelicula ?? 'Reseña', 'url' => route('resenas.showresena', ['type' => $review->type, 'id' => $review->id]), 'level' => 2],
    ]" />

    <div class="max-w-3xl mx-auto py-8">

        {{-- Cabecera --}}
        <div class="bg-white p-6 rounded-lg shadow-lg space-y-3">
            <h1 class="text-2xl font-bold text-indigo-600">{{ $review->titulo_pelicula ?? 'Reseña' }}</h1>
            <p class="text-gray-500 text-sm">Escrita por <strong>{{ $review->user->name }}</strong> -
                {{ $review->created_at->diffForHumans() }}</p>

            <p class="text-lg mt-2"><strong>Calificación:</strong> ⭐ {{ $review->rating }}/10</p>

            @if ($review->type && $review->entity_id)
                <p class="text-gray-600"><strong>Tipo:</strong> {{ ucfirst($review->type) }}</p>
                <p class="text-gray-600"><strong>ID entidad:</strong> {{ $review->entity_id }}</p>
            @endif

            <hr class="my-4">

            {{-- Contenido --}}
            <p class="text-gray-700 whitespace-pre-line">{{ $review->content }}</p>

            {{-- Acciones de la autora --}}
            @if (Auth::id() === $review->user_id)
                <div class="mt-4 flex gap-2">
                    <a href="{{ route('resena.edit', $review->id) }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">Editar</a>

                    <form action="{{ route('resena.destroy', $review->id) }}" method="POST"
                        onsubmit="return confirm('¿Seguro que quieres eliminar esta reseña?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">Eliminar</button>
                    </form>
                </div>
            @endif
        </div>

        {{-- Info adicional de OMDb (si la hay) --}}
        @if (!empty($info))
            <div class="bg-gray-50 p-4 rounded-lg shadow mt-6 space-y-2">
                <h2 class="font-semibold text-lg">Información de la entidad</h2>
                <p><strong>Título:</strong> {{ $info['Title'] ?? 'N/A' }}</p>
                <p><strong>Año:</strong> {{ $info['Year'] ?? 'N/A' }}</p>
                <p><strong>Género:</strong> {{ $info['Genre'] ?? 'N/A' }}</p>
                <p><strong>Director:</strong> {{ $info['Director'] ?? 'N/A' }}</p>
                <p><strong>Actores:</strong> {{ $info['Actors'] ?? 'N/A' }}</p>
                <p><strong>Sinopsis:</strong> {{ $info['Plot'] ?? 'N/A' }}</p>
            </div>
        @endif

    </div>
@endsection
