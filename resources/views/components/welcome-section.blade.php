@props([
    'title' => 'Bienvenido',
    'subtitle' => '',
    'bgImage' => null,
])

<div class="relative text-center text-white flex items-center justify-center
           min-h-[35vh] sm:min-h-[40vh] md:min-h-[50vh] lg:min-h-[60vh]"
    style="background: url('{{ $bgImage }}') no-repeat center center; background-size: cover; min-height: 35vh;">

    <!-- Overlay oscuro -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Contenido -->
    <div class="relative z-10 container p-4 flex flex-col items-center justify-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bangers mb-4">
            {{ $title }}
        </h1>

        <p class="text-base sm:text-lg md:text-xl lg:text-2xl font-roboto mb-6">
            {{ $subtitle }}
        </p>

        @guest
            <div class="flex flex-col sm:flex-row gap-3 w-full max-w-md mx-auto
            items-center sm:items-start">

                <a href="{{ route('login') }}"
                    class="w-fit sm:w-auto px-5 py-3 text-center bg-red-500 text-white
        rounded-md hover:bg-red-600 font-marvel text-lg sm:text-base">
                    Iniciar sesión
                </a>

                <a href="{{ route('register') }}"
                    class="w-fit sm:w-auto px-5 py-3 text-center bg-yellow-500 text-white
        rounded-md hover:bg-yellow-600 font-bangers text-lg sm:text-base">
                    Registrarse
                </a>

            </div>
        @endguest
    </div>
</div>
