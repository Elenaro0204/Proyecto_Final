@props([
    'title' => 'Bienvenido',
    'subtitle' => '',
    'bgImage' => null
])

<div class="welcome-section text-center text-white d-flex align-items-center justify-content-center" 
     style="background: url('{{ $bgImage }}') no-repeat center center; background-size: cover; min-height: 100vh;">
    <div class="container">
        <h1 class="display-4">{{ $title }}</h1>
        <p class="lead">{{ $subtitle }}</p>

        @guest
            <a href="{{ route('login') }}" class="btn btn-primary mt-3 me-2">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="btn btn-success mt-3">Registrarse</a>
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
