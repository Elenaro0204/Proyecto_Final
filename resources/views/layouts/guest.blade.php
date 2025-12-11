<!-- resources/views/layouts/guest.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Marvelpedia') }}</title>
    <link rel="icon" href="{{ asset('/logos/Icono.PNG') }}" type="image/png">

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

<body class="font-sans antialiased">

    <main class="bg-gradient-to-b from-blue-700 to-red-700 min-h-screen flex justify-center items-center pt-5">

        <!-- LOADER MARVEL -->
        <div id="global-loader">
            <div class="marvel-loader">
                <img src="{{ asset('logos/Icono.PNG') }}" alt="Marvel" class="marvel-logo">
            </div>
        </div>

        <!-- Contenedor central -->
        <div class="flex flex-col justify-center items-center px-4 w-full max-w-md">
            <!-- Logo -->
            <a class="mb-6 flex items-center" href="{{ route('profile') }}">
                <img src="{{ asset('logos/Logo.PNG') }}" alt="Logo" class="me-2"
                    style="height: 100px; width: auto;">
            </a>

            <!-- Contenedor del formulario -->
            <div class="w-full bg-white shadow-lg rounded-xl p-8">
                @yield('content')
            </div>
        </div>
    </main>

    @yield('scripts')
    @stack('scripts')

    @push('scripts')
        <script>
            document.getElementById('navbarContent').addEventListener('shown.bs.collapse', function() {
                this.style.height = 'auto';
            });
        </script>
    @endpush

    @section('styles')
        <style>
            .navbar-collapse {
                overflow: visible;
                /* permite que el contenido se vea durante la animación */
            }
        </style>
    @endsection
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
