<!-- resources/views/resenas/index.blade.php -->
@extends('layouts.app')

@section('content')
    <x-welcome-section title="Reseñas del Multiverso Marvel"
        subtitle="Descubre lo que la comunidad opina sobre cómics, películas, series y personajes. ¡Explora todas las reseñas publicadas!"
        bgImage="{{ asset('images/fondo_imagen_inicio.jpeg') }}" />

    <div class="container mx-auto px-4 py-6">

        {{-- Buscador --}}
        <form action="{{ route('resenas') }}" method="GET" class="mb-6 flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}"
                placeholder="Buscar reseña por contenido o tema..."
                class="flex-1 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" />
            <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">Buscar</button>
        </form>

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Reseñas del Multiverso Marvel</h2>

            @auth
                @if (Auth::user()->hasVerifiedEmail())
                    <a href="{{ route('resenas.create') }}"
                        class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg transition transform hover:scale-105 shadow-md">
                        <i class="fas fa-pen-nib"></i> Publicar nueva reseña
                    </a>
                @else
                    <p class="text-sm text-gray-500">Verifica tu email para poder publicar reseñas.</p>
                @endif
            @endauth
        </div>

        {{-- Feed de reseñas --}}
        @if ($reviews->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($reviews as $review)
                    @php
                        $poster = null;
                        $titleInfo = null;

                        if (
                            in_array($review->type, ['pelicula', 'serie']) &&
                            preg_match('/^tt\d+$/', $review->entity_id)
                        ) {
                            try {
                                $response = Http::get('https://www.omdbapi.com/', [
                                    'apikey' => env('OMDB_API_KEY'),
                                    'i' => $review->entity_id,
                                ]);
                                $data = $response->json();
                                if (isset($data['Poster']) && $data['Poster'] != 'N/A') {
                                    $poster = $data['Poster'];
                                }
                                if (isset($data['Title'])) {
                                    $titleInfo = $data['Title'];
                                }
                            } catch (\Exception $e) {
                                $poster = null;
                                $titleInfo = null;
                            }
                        }
                    @endphp

                    <div
                        class="bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-xl transition overflow-hidden flex flex-col">
                        {{-- Imagen de la entidad --}}
                        @if ($poster)
                            <img src="{{ $poster }}" alt="{{ $titleInfo ?? $review->type }}"
                                class="w-full h-48 object-cover">
                        @endif

                        <div class="p-4 flex flex-col flex-1">
                            {{-- Header usuario y rating --}}
                            <div class="flex justify-between items-center mb-2">
                                {{-- Avatar --}}
                                <div class="flex-shrink-0 flex flex-row items-center gap-3">
                                    <img src="{{ $review->user->avatar_url ?? asset('images/default-avatar.jpeg') }}"
                                        alt="Avatar de {{ $review->user->name ?? 'Usuario' }}"
                                        class="w-16 h-16 rounded-full object-cover border-2 border-yellow-400" />
                                    <p class="font-semibold text-lg">{{ $review->user->name ?? 'Anónimo' }}</p>
                                </div>
                                <p class="text-yellow-400 font-bold">{{ str_repeat('⭐', $review->rating) }}</p>
                            </div>

                            {{-- Información de la entidad --}}
                            <div class="mb-2 text-sm text-gray-500">
                                <span class="font-medium capitalize">{{ $review->type }}</span> |
                                Título: {{ $titleInfo ?? 'Desconocido' }}
                                @if (isset($omdbData))
                                    | Año: {{ $omdbData['Year'] ?? 'Desconocido' }}
                                    | Género: {{ $omdbData['Genre'] ?? 'Desconocido' }}
                                    | Director: {{ $omdbData['Director'] ?? 'Desconocido' }}
                                @endif
                            </div>

                            {{-- Contenido --}}
                            <p class="text-gray-700 text-sm flex-1 mb-3 whitespace-pre-line">{{ $review->content }}</p>

                            {{-- Botones --}}
                            @auth
                                <div class="flex gap-2 mt-auto">
                                    {{-- Editar y eliminar del usuario --}}
                                    @if (Auth::id() === $review->user_id)
                                        <a href="{{ route('resenas.edit', $review->id) }}"
                                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-center transition text-sm">
                                            Editar
                                        </a>
                                        @if (!Auth::user()->isAdmin())
                                            <form action="{{ route('resenas.destroy', $review->id) }}" method="POST"
                                                class="flex-1"
                                                onsubmit="return confirm('¿Seguro que quieres eliminar esta reseña?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded transition text-sm">
                                                    Eliminar
                                                </button>
                                            </form>
                                        @endif
                                    @endif

                                    {{-- Opciones admin --}}
                                    @if (Auth::user()->isAdmin())
                                        <a href="{{ route('admin.resenas.addreport', $review->id) }}"
                                            class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-black px-3 py-2 rounded text-center transition text-sm">
                                            Reportar
                                        </a>
                                        <form action="{{ route('resenas.destroy', $review->id) }}" method="POST"
                                            class="flex-1"
                                            onsubmit="return confirm('¿Seguro que quieres eliminar esta reseña como admin?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full bg-red-700 hover:bg-red-800 text-white px-3 py-2 rounded transition text-sm">
                                                Eliminar
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginación --}}
            <div class="mt-6">
                {{ $reviews->links() }}
            </div>
        @else
            <p class="text-gray-500 mt-6 text-center text-lg">Todavía no hay reseñas publicadas. ¡Sé el primero en opinar!
            </p>
        @endif
    </div>
@endsection
