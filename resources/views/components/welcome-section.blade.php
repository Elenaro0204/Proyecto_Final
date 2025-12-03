<!-- resources/views/components/welcome-section.blade.php -->

@props([
    'title' => 'Bienvenido',
    'subtitle' => '',
    'bgImage' => null,
])

<div class="welcome-section relative text-center text-white flex items-center justify-center"
    style="background: url('{{ $bgImage }}') no-repeat center center; background-size: cover; min-height: 35vh;"
    class="md:min-h-[50vh] lg:min-h-[60vh]">

    <!-- Overlay oscuro -->
    <div class="absolute inset-0 bg-black bg-opacity-50 z-0"></div>

    <!-- Contenido centrado -->
    <div class="relative z-10 container px-4 flex flex-col items-center justify-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bangers mb-4">{{ $title }}</h1>
        <p class="text-base sm:text-lg md:text-xl lg:text-2xl font-roboto mb-6">{{ $subtitle }}</p>

        @guest
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('login') }}"
                    class="w-full sm:w-auto px-6 py-3 bg-red-500 text-white rounded-md hover:bg-red-600 font-marvel text-center">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}"
                    class="w-full sm:w-auto px-6 py-3 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 font-bangers text-center">
                    Registrarse
                </a>
            </div>
        @endguest
    </div>
</div>

<style>
    .welcome-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: -1;
    }

    .welcome-section>.container {
        position: relative;
        z-index: 1;
    }
</style>
