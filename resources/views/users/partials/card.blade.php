<!-- resources/views/users/partials/card.blade.php -->
<div class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-xl transition transform hover:-translate-y-1">

    <div class="h-14 bg-gradient-to-b from-blue-600 to-red-600"></div>

    <div class="p-3 flex flex-col items-center flex-grow">

        <img src="{{ $usuario->avatar_url ? asset('storage/' . $usuario->avatar_url) : asset('images/default-avatar.jpeg') }}"
            class="w-24 h-24 rounded-full border-4 border-white -mt-16 object-cover shadow" alt="Avatar">

        <h3 class="text-xl font-semibold mt-4 text-center">{{ $usuario->name }}</h3>

        @if ($usuario->nickname)
            <p class="text-gray-500 text-sm text-center">“{{ $usuario->nickname }}”</p>
        @else
            {{-- Espacio vacío para mantener altura --}}
            <p class="text-sm opacity-0">placeholder</p>
        @endif

        @if ($usuario->pais)
            <p class="text-gray-600 mt-2 text-center">🌍 {{ $usuario->pais }}</p>
        @else
            {{-- Espacio vacío para mantener altura --}}
            <p class="opacity-0">placeholder</p>
        @endif

        <!-- Empuja el botón al fondo -->
        <div class="flex-grow"></div>

        <a href="{{ route('users.show', $usuario->id) }}"
            class="mt-3 px-4 py-2 bg-yellow-400 text-red-900 font-semibold rounded-md shadow hover:bg-yellow-500 transition-colors cursor-pointer">
            Ver perfil
        </a>

    </div>
</div>
