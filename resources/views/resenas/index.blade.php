<!-- resources/views/resenas/index.blade.php -->

@extends('layouts.app')

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Reseñas', 'url' => route('resenas'), 'level' => 1],
    ]" />

    <x-welcome-section title="Reseñas del Multiverso Marvel"
        subtitle="Descubre lo que la comunidad opina sobre series y personajes. ¡Explora todas las reseñas publicadas!"
        bgImage="{{ asset('images/fondo_imagen_inicio.jpg') }}" />

    <div class="container mx-auto px-4 py-8" x-data="reviewModal()">

        {{-- Botón publicar --}}
        <div class="flex justify-between items-center mb-12">
            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-gray-800">Sumérgete en las reseñas del Multiverso Marvel</h2>
                <p class="text-gray-600 mt-2">
                    Descubre opiniones, comparte tus experiencias sobre series y películas, y conecta con otros fans
                    apasionados.
                </p>
            </div>
            @auth
                @if (Auth::user()->hasVerifiedEmail())
                    <a href="{{ route('resenas.create') }}"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-red-500 to-red-700 text-white font-semibold px-5 py-3 rounded-xl shadow-lg hover:scale-105 transition transform">
                        <i class="fas fa-pen-nib"></i> Publicar nueva reseña
                    </a>
                @else
                    <p class="text-sm text-gray-500 italic">Verifica tu email para poder publicar reseñas.</p>
                @endif
            @endauth
        </div>

        {{-- Secciones de reseñas --}}
        @php
            $sections = [
                'Ultimas reseñas' => $latestReviews,
                'Mejor valoradas' => $topRatedReviews,
                'Reseñas de peliculas' => $movieReviews,
                'Reseñas de series' => $serieReviews,
            ];
        @endphp

        @foreach ($sections as $title => $reviewsSection)
            <section id={{ $title }} class="mb-12">
                <div class="border-4 border-fuchsia-500 rounded-lg w-full mx-auto my-5 text-center px-4 md:px-0">
                    <h2 class="text-2xl font-semibold text-red-700 p-3 uppercase">{{ $title }}
                    </h2>
                </div>
                @if ($reviewsSection->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @include('resenas.partials.cards', ['reviews' => $reviewsSection])
                    </div>
                @else
                    <p class="text-gray-500 text-center italic">No hay reseñas disponibles en esta sección.</p>
                @endif
            </section>
        @endforeach

        {{-- Paginación --}}
        <div class="mt-8 flex justify-center">
            {{ $reviews->links() }}
        </div>

        <!-- Sección: Buscar y Filtrar Reseñas -->
        <section class="mb-12">
            <div class="border-4 border-fuchsia-500 rounded-lg w-full mx-auto my-5 text-center px-4 md:px-0">
                <h2 class="text-2xl font-semibold text-red-700 p-3 uppercase">Buscar reseñas</h2>
            </div>

            <form id="resena-filtros-form" action="{{ route('resenas') }}" method="GET"
                class="flex flex-col md:flex-row gap-4 max-w-4xl mx-auto mb-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Buscar por título..."
                    class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <select name="tipo"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Todas</option>
                    <option value="pelicula" {{ request('tipo') === 'pelicula' ? 'selected' : '' }}>Películas</option>
                    <option value="serie" {{ request('tipo') === 'serie' ? 'selected' : '' }}>Series</option>
                </select>
                <select name="orden"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="recientes" {{ request('orden') === 'recientes' ? 'selected' : '' }}>Más recientes
                    </option>
                    <option value="antiguos" {{ request('orden') === 'antiguos' ? 'selected' : '' }}>Más antiguos
                    </option>
                </select>
            </form>

            <!-- Contenedor donde se mostrarán las reseñas filtradas -->
            <div id="resenas-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @include('resenas.partials.cards', ['reviews' => $reviews])
            </div>

            <!-- Paginación -->
            <div class="mt-6 flex justify-center">
                {{ $reviews->links() }}
            </div>
        </section>

        {{-- Modal Drawer --}}
        @forelse ($reviews as $review)
            <x-modal-drawer :review="$review" />
        @endforeach
    </div>
@endsection

@push('scripts')
    <script>
        // Lógica Alpine.js para el modal de reseñas
        function reviewModal() {
            return {
                open: false,
                data: null,

                async openModal(id) {
                    this.open = true;
                    const res = await fetch(`/resenas/${id}/json`);
                    this.data = await res.json();
                },

                closeModal() {
                    this.open = false;
                    this.data = null;
                }
            }
        }

        // Filtrado dinámico de reseñas
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('#resena-filtros-form');
            const container = document.querySelector('#resenas-container');

            const buscarResenas = () => {
                const formData = new FormData(form);
                const params = new URLSearchParams(formData).toString();

                fetch(`${form.action}?${params}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        container.innerHTML = html;
                    });
            };

            form.querySelectorAll('input, select').forEach(input => {
                input.addEventListener('input', buscarResenas);
                input.addEventListener('change', buscarResenas);
            });
        });
    </script>
@endpush
