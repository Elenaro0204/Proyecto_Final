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
</head>

<body class="font-sans antialiased">

    <main class="bg-gradient-to-b from-blue-700 to-red-700 min-h-screen flex justify-center items-center pt-5">
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
