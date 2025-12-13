<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('content')
    {{-- BREADCRUMB Y SECCIÓN DE BIENVENIDA --}}
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Usuarios', 'url' => route('users.index'), 'level' => 1],
    ]" />

    <x-welcome-section title="Comunidad de Usuarios"
        subtitle="Explora los perfiles de la comunidad, descubre gustos en común y conócelos mejor."
        bgImage="{{ asset('images/fondo_imagen_inicio.jpg') }}" />

    <div class="container mx-auto px-4 py-8">

        <!-- ⭐ NUEVOS USUARIOS ------------------------------------------------- -->
        <section>
            <div class="border-4 border-fuchsia-500 rounded-lg w-full mx-auto my-5 text-center px-4 md:px-0">
                <h2 class="text-2xl font-semibold text-red-700 p-3 uppercase"> Nuevos miembros</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($ultimos_usuarios as $usuario)
                    @include('users.partials.card', ['usuario' => $usuario])
                @endforeach
            </div>

            <div class="mt-6">
                {{ $ultimos_usuarios->links() }}
            </div>
        </section>

        <!-- ⭐ PODIO COMPLETO (TOPS) ------------------------------------------- -->
        <section>
            <div class="border-4 border-fuchsia-500 rounded-lg w-full mx-auto my-5 text-center px-4 md:px-0">
                <h2 class="text-2xl font-semibold text-red-700 p-3 uppercase">Ranking de la comunidad</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                {{-- TOP RESEÑAS --}}
                <section class="relative rounded-xl overflow-hidden shadow-xl p-6">
                    <div class="absolute inset-0 bg-white opacity-50 z-0"></div>

                    <div class="relative z-10 flex flex-col items-center text-center w-full">
                        <h3 class="text-xl text-red-700 font-bold mb-3 uppercase">Mas reseñas</h3>
                    </div>
                    <div class="relative z-10">
                        @include('users.partials.podium', [
                            'top' => $topResenas,
                            'campo' => 'reviews_count',
                            'label' => 'reseñas',
                        ])
                    </div>
                </section>

                {{-- TOP FOROS --}}
                <section class="relative rounded-xl overflow-hidden shadow-xl p-6">
                    <div class="absolute inset-0 bg-white opacity-50 z-0"></div>

                    <div class="relative z-10 flex flex-col items-center text-center w-full">
                        <h3 class="text-xl text-red-700 font-bold mb-3 uppercase">Mas foros creados</h3>
                    </div>
                    <div class="relative z-10">
                        @include('users.partials.podium', [
                            'top' => $topForos,
                            'campo' => 'foros_count',
                            'label' => 'foros',
                        ])
                    </div>
                </section>

                {{-- TOP MENSAJES --}}
                <section class="relative rounded-xl overflow-hidden shadow-xl p-6">
                    <div class="absolute inset-0 bg-white opacity-50 z-0"></div>

                    <div class="relative z-10 flex flex-col items-center text-center w-full">
                        <h3 class="text-xl text-red-700 font-bold mb-3 uppercase">Mas mensajes</h3>
                    </div>
                    <div class="relative z-10">
                        @include('users.partials.podium', [
                            'top' => $topMensajes,
                            'campo' => 'mensajes_count',
                            'label' => 'mensajes',
                        ])
                    </div>
                </section>

            </div>
        </section>

        <!-- ⭐ FILTROS + TODOS LOS USUARIOS ---------------------------------- -->
        <section>

            <div class="border-4 border-fuchsia-500 rounded-lg w-full mx-auto my-5 text-center px-4 md:px-0">
                <h2 class="text-2xl font-semibold text-red-700 p-3 uppercase">Todos los usuarios</h2>
            </div>

            <form method="GET" action="{{ route('users.index') }}"
                class="bg-white shadow rounded-xl p-4 mb-10 grid grid-cols-1 md:grid-cols-3 gap-4">

                <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Buscar por nombre..."
                    class="border p-2 rounded w-full">

                <select name="pais" class="border p-2 rounded w-full">
                    <option value="">🌍 Filtrar por país</option>
                    @foreach ($paises as $pais)
                        <option value="{{ $pais }}" {{ request('pais') == $pais ? 'selected' : '' }}>
                            {{ $pais }}
                        </option>
                    @endforeach
                </select>

                <button class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-800 w-full sm:w-auto">
                    Filtrar
                </button>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($users as $usuario)
                    @include('users.partials.card', ['usuario' => $usuario])
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                {{ $users->appends(request()->query())->links() }}
            </div>

        </section>
    </div>
@endsection
