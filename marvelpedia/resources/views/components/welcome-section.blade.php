@props([
    'title' => 'Bienvenido',
    'subtitle' => '',
    'bgImage' => null
])

<div class="welcome-section relative text-center text-white flex items-center justify-center"
     style="background: url('{{ $bgImage }}') no-repeat center center; background-size: cover; min-height: 100vh;">

    <!-- Overlay oscuro -->
    <div class="absolute inset-0 bg-black bg-opacity-50 z-0"></div>

    <!-- Contenido centrado -->
    <div class="relative z-10 container px-4">
        <h1 class="text-5xl font-bangers mb-4">{{ $title }}</h1>
        <p class="text-xl font-roboto mb-6">{{ $subtitle }}</p>

        @guest
            <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-red-500 text-white rounded-md hover:bg-red-600 font-marvel mr-2">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="inline-block px-6 py-3 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 font-bangers">Registrarse</a>
        @endguest
    </div>
</div>

<style>
    /* Opcional: overlay para que el texto sea más legible */
    .welcome-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(0,0,0,0.5);
        z-index: -1;
    }
    .welcome-section > .container {
        position: relative;
        z-index: 1;
    }
</style>
