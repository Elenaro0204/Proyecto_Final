<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Usuarios', 'url' => route('users.index'), 'level' => 1],
    ]" />

    <x-welcome-section title="Comunidad de Usuarios"
        subtitle="Explora los perfiles de la comunidad, descubre gustos en común y conócelos mejor."
        bgImage="{{ asset('images/fondo_imagen_inicio.jpg') }}" />

    <div class="bg-gradient-to-b from-gray-100 to-gray-200 py-10">

        {{-- FILTROS (Opcional) --}}
        <section class="container mx-auto max-w-5xl mb-8 px-4">
            <div class="bg-white shadow rounded-xl p-5 grid grid-cols-1 md:grid-cols-3 gap-4">

                <input type="text" placeholder="🔍 Buscar por nombre..." class="border p-2 rounded w-full">

                <select class="border p-2 rounded w-full">
                    <option value="">🌍 Filtrar por país</option>
                    <option>España</option>
                    <option>México</option>
                    <option>Argentina</option>
                </select>

                <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Aplicar filtros
                </button>

            </div>
        </section>

        {{-- LISTADO DE USUARIOS --}}
        <section class="container mx-auto max-w-6xl px-4">
            <h2 class="text-2xl font-bold mb-6">Usuarios registrados</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

                @foreach ($users as $usuario)
                    <div
                        class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-xl transition transform hover:-translate-y-1">

                        {{-- Banner superior --}}
                        <div class="h-24 bg-gradient-to-r from-red-600 to-indigo-600"></div>

                        <div class="p-6 flex flex-col items-center">

                            {{-- Avatar --}}
                            <img src="{{ $usuario->avatar ?? asset('images/default-avatar.jpeg') }}"
                                class="w-24 h-24 rounded-full border-4 border-white -mt-16 object-cover shadow"
                                alt="Avatar">

                            {{-- Nombre --}}
                            <h3 class="text-xl font-semibold mt-4">{{ $usuario->name }}</h3>

                            {{-- Apodo --}}
                            @if ($usuario->nickname)
                                <p class="text-gray-500 text-sm">“{{ $usuario->nickname }}”</p>
                            @endif

                            {{-- País --}}
                            @if ($usuario->pais)
                                <p class="text-gray-600 mt-2">🌍 {{ $usuario->pais }}</p>
                            @endif

                            {{-- Botón --}}
                            <a href="{{ route('users.show', $usuario->id) }}"
                                class="mt-4 px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition">
                                Ver perfil
                            </a>

                        </div>
                    </div>
                @endforeach

            </div>

            {{-- PAGINACIÓN --}}
            <div class="mt-10 flex justify-center">
                {{ $users->links() }}
            </div>
        </section>

    </div>
@endsection
