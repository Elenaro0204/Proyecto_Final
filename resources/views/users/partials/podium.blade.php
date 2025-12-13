<!-- resources/views/users/partials/podium.blade.php -->

<div class="flex justify-center items-end gap-2 px-6">

    <!-- 2º puesto -->
    @if (isset($top[1]))
        <a href="{{ route('users.show', $top[1]->id) }}" class="flex flex-col items-center w-32 no-underline">
            <div class="w-24 h-24">
                <img src="{{ $top[1]->avatar_url ? asset('storage/' . $top[1]->avatar_url) : asset('images/default-avatar.jpeg') }}"
                    class="rounded-full w-24 h-24 object-cover border-4 border-gray-400 shadow-lg shrink-0">
            </div>
            <div class="bg-gray-300 w-24 h-16 rounded-t-lg flex items-center justify-center text-xl font-bold">
                2°
            </div>
            <p class="mt-2 font-semibold w-24 text-center truncate">{{ $top[1]->name }}</p>
            <p class="text-gray-600 text-sm">{{ $top[1][$campo] }} {{ $label }}</p>
        </a>
    @endif

    <!-- 1º puesto -->
    @if (isset($top[0]))
        <a href="{{ route('users.show', $top[0]->id) }}" class="flex flex-col items-center w-32 no-underline">
            <div class="w-32 h-32">
                <img src="{{ $top[0]->avatar_url ? asset('storage/' . $top[0]->avatar_url) : asset('images/default-avatar.jpeg') }}"
                    class="rounded-full w-32 h-32 object-cover border-4 border-yellow-500 shadow-xl shrink-0">
            </div>
            <div class="bg-yellow-300 w-28 h-24 rounded-t-lg flex items-center justify-center text-2xl font-bold">
                🥇 1°
            </div>
            <p class="mt-2 font-semibold w-24 text-center truncate">{{ $top[0]->name }}</p>
            <p class="text-gray-600 text-sm">{{ $top[0][$campo] }} {{ $label }}</p>
        </a>
    @endif

    <!-- 3º puesto -->
    @if (isset($top[2]))
        <a href="{{ route('users.show', $top[2]->id) }}" class="flex flex-col items-center w-32 no-underline">
            <div class="w-24 h-24">
                <img src="{{ $top[2]->avatar_url ? asset('storage/' . $top[2]->avatar_url) : asset('images/default-avatar.jpeg') }}"
                    class="rounded-full w-24 h-24 object-cover border-4 border-orange-400 shadow-lg shrink-0">
            </div>
            <div class="bg-orange-300 w-24 h-12 rounded-t-lg flex items-center justify-center text-xl font-bold">
                3°
            </div>
            <p class="mt-2 font-semibold w-24 text-center truncate">{{ $top[2]->name }}</p>
            <p class="text-gray-600 text-sm">{{ $top[2][$campo] }} {{ $label }}</p>
        </a>
    @endif

</div>
