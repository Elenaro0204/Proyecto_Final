<!-- resources/views/foros/index.blade.php -->

@extends('layouts.app')

@section('content')
    <x-welcome-section title="Foros del Multiverso Marvel"
        subtitle="Participa en debates sobre películas y series. ¡Únete a la comunidad y comparte tus ideas!"
        bgImage="{{ asset('images/fondo_imagen_inicio.jpg') }}" />

    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Foros', 'url' => route('foros.index'), 'level' => 1],
    ]" />

    <div class="container mx-auto px-4 py-6">

        <div class="flex justify-between items-center mb-8">
            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-gray-800">Bienvenido al universo de debates Marvel</h2>
                <p class="text-gray-600 mt-2">
                    Explora los foros, participa en conversaciones sobre series y películas, y conecta con otros
                    fans.
                </p>
            </div>

            @if (Auth::check() && Auth::user()->hasVerifiedEmail())
                <a href="{{ route('foros.create') }}"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-red-500 to-red-700 text-white font-semibold px-5 py-3 rounded-xl shadow-lg hover:scale-105 transition transform">
                    <i class="fas fa-pen-nib"></i> Crear Nuevo Foro
                </a>
            @endif
        </div>

        <!-- Foros Públicos -->
        <section class="mb-12">
            <div class="border-4 border-fuchsia-500 rounded-lg w-full mx-auto my-5 text-center px-4 md:px-0">
                <h2 class="text-2xl font-semibold text-red-700 p-3 uppercase">Publicos</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($foros->where('visibilidad', 'publico') as $foro)
                    @include('foros.partials.foro-card', ['foro' => $foro])
                @empty
                    <div class="col-span-full text-center text-gray-500 text-lg py-10">
                        No hay foros públicos disponibles.
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Foros Privados (solo creador) -->
        @auth
            <section class="mb-12">
                <div class="border-4 border-fuchsia-500 rounded-lg w-full mx-auto my-5 text-center px-4 md:px-0">
                    <h2 class="text-2xl font-semibold text-red-700 p-3 uppercase">Tus Privados</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($foros->where('visibilidad', 'privado')->where('user_id', auth()->id()) as $foro)
                        @include('foros.partials.foro-card', ['foro' => $foro])
                    @empty
                        <div class="col-span-full text-center text-gray-500 text-lg py-10">
                            No tienes foros privados.
                        </div>
                    @endforelse
                </div>
            </section>
        @endauth

        <!-- Foros más comentados -->
        <section class="mb-12">
            <div class="border-4 border-fuchsia-500 rounded-lg w-full mx-auto my-5 text-center px-4 md:px-0">
                <h2 class="text-2xl font-semibold text-red-700 p-3 uppercase">Mas Comentados</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $forosMasComentados = $foros
                        ->where('visibilidad', 'publico')
                        ->sortByDesc(fn($f) => $f->mensajes_count ?? 0)
                        ->take(6);
                @endphp

                @forelse ($forosMasComentados as $foro)
                    @include('foros.partials.foro-card', ['foro' => $foro])
                @empty
                    <div class="col-span-full text-center text-gray-500 text-lg py-10">
                        No hay foros con comentarios.
                    </div>
                @endforelse

            </div>
        </section>

        <!-- Foros Recientes -->
        <section class="mb-12">
            <div class="border-4 border-fuchsia-500 rounded-lg w-full mx-auto my-5 text-center px-4 md:px-0">
                <h2 class="text-2xl font-semibold text-red-700 p-3 uppercase">Recientes</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $forosRecientes = $foros->where('visibilidad', 'publico')->sortByDesc('created_at')->take(6);
                @endphp

                @forelse ($forosRecientes as $foro)
                    @include('foros.partials.foro-card', ['foro' => $foro])
                @empty
                    <div class="col-span-full text-center text-gray-500 text-lg py-10">
                        No hay foros recientes.
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Sección: Buscar y Filtrar Foros -->
        <section class="mb-12">
            <div class="border-4 border-fuchsia-500 rounded-lg w-full mx-auto my-5 text-center px-4 md:px-0">
                <h2 class="text-2xl font-semibold text-red-700 p-3 uppercase">Buscar</h2>
            </div>

            <form id="foro-filtros-form" action="{{ route('foros.index') }}" method="GET"
                class="flex flex-col md:flex-row gap-4 max-w-4xl mx-auto mb-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Buscar por título..."
                    class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <select name="visibilidad"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Todas</option>
                    <option value="publico" {{ request('visibilidad') === 'publico' ? 'selected' : '' }}>Públicos</option>
                    <option value="privado" {{ request('visibilidad') === 'privado' ? 'selected' : '' }}>Privados</option>
                </select>
                <select name="orden"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="recientes" {{ request('orden') === 'recientes' ? 'selected' : '' }}>Más recientes
                    </option>
                    <option value="antiguos" {{ request('orden') === 'antiguos' ? 'selected' : '' }}>Más antiguos</option>
                    <option value="comentados" {{ request('orden') === 'comentados' ? 'selected' : '' }}>Más comentados
                    </option>
                </select>
            </form>

            <!-- Contenedor donde se mostrarán los foros filtrados -->
            <div id="foros-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($foros as $foro)
                    @include('foros.partials.foro-card', ['foro' => $foro])
                @empty
                    <div class="col-span-full text-center text-gray-500 text-lg py-10">
                        No hay foros que coincidan.
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Paginación -->
        <div class="mt-8">
            {{ $foros->links('pagination::tailwind') }}
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('#foro-filtros-form');
            const container = document.querySelector('#foros-container');

            const buscarForos = () => {
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
                input.addEventListener('input', buscarForos);
                input.addEventListener('change', buscarForos);
            });
        });
    </script>
@endsection
