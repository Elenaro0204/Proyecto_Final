@props([
    'user' => null,
    'bgImage' => null
])

<div class="profile-header position-relative text-white py-5"
     style="background: url('{{ $bgImage }}') no-repeat center center; background-size: cover;">

    <div class="overlay" style="position:absolute; inset:0; background:rgba(0,0,0,0.5);"></div>

    <div class="container position-relative d-flex flex-row justify-content-center align-items-center text-center py-4 gap-4">
        {{-- FOTO DE PERFIL --}}
        <div class="profile-image">
            <img src="{{ Auth::user()->avatar_url ?? asset('images/default-avatar.png') }}"
                 alt="Avatar de {{ Auth::user()->name }}"
                 class="rounded-circle border-2 border-white"
                 style="width:130px; height:130px; object-fit:cover;">
        </div>

        {{-- DATOS DEL USUARIO --}}
        <div class="text-white space-y-1">
            <h2 class="mb-2 text-xl font-semibold">{{ Auth::user()->name }}</h2>

            @if(Auth::user()->bio)
                <p class="mb-1">{{ Auth::user()->bio }}</p>
            @endif

            @if(Auth::user()->twitter)
                <p class="mb-1"><strong>Twitter:</strong> <a href="{{ Auth::user()->twitter }}" target="_blank">{{ Auth::user()->twitter}}</a></p>
            @endif

            @if(Auth::user()->instagram)
                <p class="mb-1"><strong>Instagram:</strong> <a href="{{ Auth::user()->instagram }}" target="_blank">{{ Auth::user()->instagram }}</a></p>
            @endif

        </div>
    </div>
</div>
