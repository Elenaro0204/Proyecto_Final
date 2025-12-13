@props([
    'user' => null,
    'bgImage' => null,
])

<div class="profile-header position-relative text-white py-5"
    style="background: url('{{ $bgImage }}') no-repeat center center; background-size: cover;">

    <div class="overlay" style="position:absolute; inset:0; background:rgba(0,0,0,0.5);"></div>

    <div
        class="container position-relative d-flex flex-column flex-md-row justify-content-center align-items-center text-center py-4 gap-4">

        {{-- FOTO DE PERFIL --}}
        <div class="profile-image flex-shrink-0">
            <img src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : asset('images/default-avatar.jpeg') }}"
                alt="Avatar de {{ $user->nickname ?? $user->name }}" class="rounded-circle border-2 border-white"
                style="width:130px; height:130px; object-fit:cover;">
        </div>

        {{-- DATOS DEL USUARIO --}}
        <div class="text-white text-center text-md-start" style="max-width: 400px;">
            <h2 class="mb-2 text-xl font-semibold">"{{ Auth::user()->nickname ?? Auth::user()->name }}"</h2>

            @if (Auth::user()->bio)
                <p class="mb-1">{{ Auth::user()->bio }}</p>
            @endif

            <div class="d-flex justify-content-center justify-content-md-start gap-2 mt-2">

                @if (Auth::user()->twitter)
                    <a href="{{ Auth::user()->twitter }}" target="_blank"
                        class="px-3 py-1 rounded-pill d-flex align-items-center gap-2"
                        style="background:rgba(29, 155, 240, 0.2); border:1px solid rgba(29, 155, 240, 0.5); text-decoration:none; transition:0.3s;">
                        <i class="bi bi-twitter"></i> <span>Twitter</span>
                    </a>
                @endif

                @if (Auth::user()->instagram)
                    <a href="{{ Auth::user()->instagram }}" target="_blank"
                        class="px-3 py-1 rounded-pill d-flex align-items-center gap-2"
                        style="background:rgba(225, 48, 108, 0.2); border:1px solid rgba(225, 48, 108, 0.5); text-decoration:none; transition:0.3s;">
                        <i class="bi bi-instagram"></i> <span>Instagram</span>
                    </a>
                @endif

            </div>

        </div>

    </div>
</div>


<style>
    a:hover {
        filter: brightness(1.2);
        transform: scale(1.05);
    }
</style>
