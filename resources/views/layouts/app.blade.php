<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Marvelpedia') }}</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logos/Icono.PNG') }}">
    <link rel="apple-touch-icon" href="{{ asset('logos/Icono.PNG') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    {{-- Fuente Bangers --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">

    {{-- Fuente Roboto --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    {{-- Fuente Marvel --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marvel:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.90);
            /* BLANCO TRANSLÚCIDO */
            pointer-events: none;
            z-index: -1;
        }

        /* Fondo del loader */
        #global-loader {
            position: fixed;
            inset: 0;
            background: radial-gradient(circle, rgba(80, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.95) 80%);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 999999;
        }

        /* Mostrar loader */
        #global-loader.show {
            display: flex;
        }

        /* Contenedor del loader */
        .marvel-loader {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 6px solid rgba(255, 0, 0, 0.8);
            border-top-color: transparent;
            animation: spin 2s linear infinite, glow 2s ease-in-out infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        /* Logo Marvel */
        .marvel-logo {
            width: 85px;
            animation: pulse 1.5s infinite ease-in-out;
        }

        /* Animaciones */
        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes glow {
            0% {
                box-shadow: 0 0 8px rgba(255, 0, 0, 0.4);
            }

            50% {
                box-shadow: 0 0 25px rgba(255, 0, 0, 1);
            }

            100% {
                box-shadow: 0 0 8px rgba(255, 0, 0, 0.4);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.07);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100 bg-center bg-no-repeat"
    style="
        background-image: url('{{ asset('logos/Icono_BN.PNG') }}');
        background-size: 70%;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
    ">

    <!-- LOADER MARVEL -->
    <div id="global-loader">
        <div class="marvel-loader">
            <img src="{{ asset('logos/Icono.PNG') }}" alt="Marvel" class="marvel-logo">
        </div>
    </div>

    <div class="min-h-screen flex flex-col">

        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="flex-1">
            @yield('content')
        </main>

        <x-footer />

    </div>

    @stack('scripts')
    @yield('scripts')

</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const loader = document.getElementById("global-loader");

        // Loader al cargar la página
        loader.classList.add("show");
        setTimeout(() => loader.classList.remove("show"), 400); // pequeña animación al entrar

        // Loader al cambiar de página
        window.addEventListener("beforeunload", () => {
            loader.classList.add("show");
        });
    });

    document.getElementById('navbarContent')?.addEventListener('shown.bs.collapse', function() {
        this.style.height = 'auto';
    });
</script>
