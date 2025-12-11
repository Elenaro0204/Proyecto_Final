<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('content')

    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Usuarios', 'url' => route('users.index'), 'level' => 1],
        ['label' => $user->name, 'url' => route('users.show', $user->id), 'level' => 2],
    ]" />

    <div class="container mx-auto py-6">

        <!-- TARJETA PRINCIPAL -->
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-xl border border-red-600/20"
            style="background: linear-gradient(145deg, #ffffff, #f7f7f7);">

            <!-- TÍTULO -->
            <h2 class="text-3xl md:text-4xl font-bold mb-6 flex items-center gap-2" style="font-family:'Marvel', sans-serif;">
                <span class="text-red-600">Perfil de Usuario</span>
            </h2>

            <!-- CONTENEDOR FOTO + INFO -->
            <div class="flex flex-row justify-between md:flex-col items-center gap-10 md:gap-6">
                <div class="flex flex-col md:items-start gap-6 w-fit">
                    <!-- FOTO -->
                    <img src="{{ asset($user->avatar_url ?? 'images/default-avatar.jpeg') }}"
                        class="rounded-full w-32 h-32 md:w-40 md:h-40 object-cover border-4 border-red-600 shadow-lg">

                    <h3 class="text-2xl md:text-3xl font-bold">{{ $user->name }}</h3>

                    @if ($user->nickname)
                        <p class="italic text-gray-600 text-lg">"{{ $user->nickname }}"</p>
                    @endif
                </div>

                <!-- INFO BÁSICA -->
                <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-6 w-full">

                    <!-- COLUMNA IZQUIERDA: Nombre + info -->
                    <div class="flex-1 text-center md:text-left space-y-2">

                        <div class="space-y-1 text-gray-700 text-sm">
                            <p>📅 Miembro desde: <strong>{{ $user->created_at->format('d/m/Y') }}</strong></p>

                            <p>📧 Email: <strong>{{ $user->email }}</strong></p>

                            @if ($user->pais)
                                <p>🌍 País: <strong>{{ $user->pais }}</strong></p>
                            @endif

                            @if ($user->fecha_nacimiento)
                                <p>🎂 Nacimiento:
                                    <strong>{{ \Carbon\Carbon::parse($user->fecha_nacimiento)->format('d/m/Y') }}</strong>
                                </p>
                            @endif

                            @if ($user->role)
                                <p>🛡️ Rol: <strong>{{ ucfirst($user->role) }}</strong></p>
                            @endif
                        </div>

                        <!-- BIO -->
                        @if ($user->bio)
                            <div class="pt-3">
                                <p class="font-semibold">📘 Biografía</p>
                                <p class="text-gray-700">{{ $user->bio }}</p>
                            </div>
                        @endif
                    </div>

                </div>
                <!-- COLUMNA DERECHA: Redes sociales -->
                @if ($user->twitter || $user->instagram)
                    <div class="flex-1 md:text-right space-y-3">

                        <p class="font-semibold text-gray-700 text-sm">🌐 Redes Sociales</p>

                        <div class="flex md:justify-end flex-wrap gap-3">
                            @if ($user->twitter)
                                <a href="{{ $user->twitter }}" target="_blank"
                                    class="px-3 py-2 rounded-lg flex items-center gap-2 text-blue-700 font-semibold bg-blue-100 hover:bg-blue-200">
                                    <i class="bi bi-twitter"></i> Twitter
                                </a>
                            @endif

                            @if ($user->instagram)
                                <a href="{{ $user->instagram }}" target="_blank"
                                    class="px-3 py-2 rounded-lg flex items-center gap-2 text-pink-700 font-semibold bg-pink-100 hover:bg-pink-200">
                                    <i class="bi bi-instagram"></i> Instagram
                                </a>
                            @endif
                        </div>

                    </div>
                @endif

            </div>

            <hr class="my-8">

            <!-- GRID DE INFORMACIÓN -->
            <div class="grid md:grid-cols-2 gap-8 text-lg">

                <!-- PREFERENCIAS -->
                <div class="space-y-3">
                    <h4 class="font-bold text-xl">⭐ Preferencias</h4>

                    @if ($user->favorito_personaje)
                        <p>
                            <strong>Personaje favorito:</strong>
                            <span class="text-red-600 font-semibold">{{ $user->favorito_personaje }}</span>
                        </p>
                    @endif

                    @if ($user->favorito_comic)
                        <p>
                            <strong>Cómic favorito:</strong>
                            <span class="text-red-600 font-semibold">{{ $user->favorito_comic }}</span>
                        </p>
                    @endif
                </div>

                <!-- ESTADÍSTICAS -->
                <div class="space-y-2">
                    <h4 class="font-bold text-xl">📊 Estadísticas</h4>

                    <p>📝 Reseñas: <strong>{{ $reseñas->count() }}</strong></p>
                    <p>📢 Foros creados: <strong>{{ $foros->count() }}</strong></p>
                    <p>💬 Mensajes: <strong>{{ $mensajes->count() }}</strong></p>

                    @if ($user->puntos)
                        <p>🏆 Puntos: <strong>{{ $user->puntos }}</strong></p>
                    @endif

                    @if ($user->nivel)
                        <p>🔥 Nivel Marvel: <strong>{{ $user->nivel }}</strong></p>
                    @endif
                </div>
            </div>
        </div>


        <!-- CONTENIDOS DEL USUARIO -->
        @include('users.partials.user_activity') <!-- si prefieres modularlo -->

    </div>
@endsection
