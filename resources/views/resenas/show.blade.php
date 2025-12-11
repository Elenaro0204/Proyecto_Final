<!-- resources/views/resenas/show.blade.php -->

@extends('layouts.app')

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Reseñas', 'url' => route('resenas'), 'level' => 1],
        ['label' => $entity['title'] ?? 'Reseña', 'url' => route('resenas.ver', ['id' => $review->id]), 'level' => 2],
    ]" />

    <div class="max-w-3xl mx-auto py-8">

        {{-- Cabecera --}}
        <div class="bg-white p-6 rounded-lg shadow-lg space-y-3">
            <h1 class="text-2xl font-bold text-indigo-600">{{ $entity['title'] ?? 'Reseña' }}</h1>
            <p class="text-gray-500 text-sm">Escrita por <strong><a href="{{ route('users.show', $review->user->id) }}">{{ $review->user->name }}</a></strong> -
                {{ $review->created_at->diffForHumans() }}</p>

            <p class="text-lg mt-2"><strong>Calificación:</strong> ⭐ {{ $review->rating }}/5</p>

            @if ($review->type && $review->entity_id)
                <p class="text-gray-600"><strong>Tipo:</strong> {{ ucfirst($review->type) }}</p>
                <p class="text-gray-600"><strong>ID entidad:</strong> {{ $review->entity_id }}</p>
            @endif

            <hr class="my-4">

            {{-- Contenido --}}
            <p class="text-gray-700 whitespace-pre-line">{{ $review->content }}</p>

            {{-- Acciones de la autora --}}
            {{-- @if (Auth::id() === $review->user_id)
                <div class="mt-4 flex gap-2">
                    <a href="{{ route('resenas.edit', $review->entity_id) }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">Editar</a>

                    <form action="{{ route('resenas.destroy', $review->id) }}" method="POST"
                        onsubmit="return confirm('¿Seguro que quieres eliminar esta reseña?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">Eliminar</button>
                    </form>
                </div>
            @endif --}}
        </div>

        @if (!empty($entity))
            <div class="bg-gray-50 p-4 rounded-lg shadow mt-6">

                <h2 class="font-semibold text-lg mb-4">Información de la entidad</h2>

                <!-- Contenedor responsive -->
                <div class="flex flex-col lg:flex-row gap-6">

                    {{-- Poster --}}
                    @if (!empty($entity['poster']))
                        <div class="flex justify-center lg:block lg:w-1/3">
                            <img src="{{ $entity['poster'] }}" alt="Póster de {{ $entity['title'] }}"
                                class="rounded-lg shadow-lg w-40 sm:w-56 lg:w-full max-w-xs object-cover">
                        </div>
                    @endif

                    {{-- Info --}}
                    <div class="lg:w-2/3 space-y-2">
                        <p><strong>Título:</strong> {{ $entity['title'] }}</p>
                        <p><strong>Año:</strong> {{ $entity['year'] }}</p>
                        <p><strong>Género:</strong> {{ $entity['genres'] }}</p>
                        <p><strong>Director:</strong> {{ $entity['director'] }}</p>

                        <p><strong>Actores:</strong><br>
                            @foreach ($entity['actors'] as $actor)
                                <a href="{{ $actor['wiki'] }}" target="_blank" class="text-indigo-600 hover:underline">
                                    {{ $actor['name'] }}
                                </a>
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </p>

                        <p><strong>Sinopsis:</strong> {{ $entity['overview'] }}</p>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
