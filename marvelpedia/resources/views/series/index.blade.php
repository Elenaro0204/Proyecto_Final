<!-- resources/views/series.blade.php -->
@extends('layouts.app')

@section('content')
<x-welcome-section
    title="Series del Multiverso Marvel"
    subtitle="Explora todas las series disponibles y descubre sus historias."
    bgImage="{{ asset('images/fondo_imagen_inicio.jpeg') }}" />

<div class="container mx-auto px-4 py-6">

    <h1 class="text-4xl font-bold mb-6 text-gray-800 text-center">Series Marvel</h1>

    <!-- Formulario de búsqueda -->
    <form class="relative w-full sm:w-1/2 mx-auto">
        <input type="text" id="searchInput"
               placeholder="Buscar serie..."
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <ul id="searchResults" class="absolute w-full bg-white border mt-1 rounded-lg shadow z-50 hidden"></ul>
    </form>

    <!-- Grid de series -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
        @foreach($series as $serie)
            <div class="border rounded-lg p-4 bg-white shadow hover:shadow-lg transition flex flex-col justify-between h-full">

                <!-- Imagen arriba -->
                <img class="w-full h-48 object-cover mb-2"
                     src="{{ $serie['thumbnail']['path'] }}.{{ $serie['thumbnail']['extension'] }}"
                     alt="{{ $serie['title'] ?? $serie['name'] }}">

                <!-- Contenido central -->
                <div class="flex-1 mt-2">
                    <h2 class="font-bold text-lg mb-1">{{ $serie['title'] ?? $serie['name'] }}</h2>

                    @if(!empty($serie['description_es']))
                        <p class="text-sm text-gray-600 line-clamp-3">{{ $serie['description_es'] }}</p>
                    @else
                        <p class="text-sm text-gray-400 italic">Sin descripción disponible</p>
                    @endif
                </div>

                <!-- Botón abajo -->
                <div class="flex justify-center mt-4">
                    <a href="{{ route('serie.show', $serie['id']) }}"
                       class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition">
                        Ver más
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="mt-6 w-full">
        {{ $series->links('pagination::tailwind') }}
    </div>

</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('searchInput');
    const results = document.getElementById('searchResults');

    input.addEventListener('input', function() {
        const query = this.value.trim();

        if (!query) {
            results.innerHTML = '';
            results.classList.add('hidden');
            return;
        }

        fetch(`{{ route('series') }}?q=${query}`)
            .then(res => res.json())
            .then(data => {
                results.innerHTML = '';
                if (data.length) {
                    data.forEach(s => {
                        const div = document.createElement('div');
                        div.textContent = s.title ?? s.name;
                        div.classList.add('px-4', 'py-2', 'hover:bg-gray-200', 'cursor-pointer');
                        div.addEventListener('click', () => {
                            window.location.href = `/serie/${s.id}`;
                        });
                        results.appendChild(div);
                    });
                    results.classList.remove('hidden');
                } else {
                    results.classList.add('hidden');
                }
            });
    });
});
</script>
