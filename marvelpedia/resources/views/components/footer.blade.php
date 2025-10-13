<footer class="bg-dark text-light mt-auto py-4">
    <div class="container">
        <div class="row">

            <!-- 1. Logo + contacto -->
            <div class="col-md-4 mb-4 text-center text-md-start">
                <a href="{{ route('dashboard') }}" class="text-decoration-none text-light d-flex align-items-center justify-content-center justify-content-md-start mb-3">
                    <x-application-logo class="d-inline-block align-text-top me-2" style="height: 30px; width: auto;" />
                    <span class="h5 mb-0">Marvelpedia</span>
                </a>
                <div class="mb-3">
                    <h6 class="text-uppercase mb-2">Contáctame</h6>
                    <form action="https://formspree.io/f/mnnggdaz" method="POST">
                        @csrf
                        <div class="mb-2">
                            <input type="text" name="nombre" class="form-control form-control-sm" placeholder="Tu nombre" required>
                        </div>
                        <div class="mb-2">
                            <input type="email" name="email" class="form-control form-control-sm" placeholder="Tu correo" required>
                        </div>
                        <div class="mb-2">
                            <textarea name="mensaje" class="form-control form-control-sm" placeholder="Tu mensaje" rows="2" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-outline-light btn-sm w-100">Enviar</button>
                    </form>
                </div>
            </div>

            <!-- 2. Menú de la página -->
            <div class="col-md-4 mb-4 text-center text-md-start">
                <h6 class="text-uppercase mb-3">Menú</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('inicio') }}" class="text-light text-decoration-none">Inicio</a></li>
                    <li><a href="{{ route('descubre') }}" class="text-light text-decoration-none">Descubre</a></li>
                    <li><a href="{{ route('personajes') }}" class="text-light text-decoration-none">Personajes</a></li>
                    <li><a href="{{ route('comics') }}" class="text-light text-decoration-none">Cómics</a></li>
                    <li><a href="{{ route('peliculas') }}" class="text-light text-decoration-none">Películas</a></li>
                    <li><a href="{{ route('series') }}" class="text-light text-decoration-none">Series</a></li>
                    <li><a href="{{ route('ayuda') }}" class="text-light text-decoration-none">Ayuda</a></li>
                    <li><a href="{{ route('login') }}" class="text-light text-decoration-none">Iniciar Sesión</a></li>
                    <li><a href="{{ route('register') }}" class="text-light text-decoration-none">Registrar</a></li>
                </ul>
            </div>

            <!-- 3. Galería de imágenes -->
            <div class="col-md-4 mb-4 text-center text-md-start">
    <h6 class="text-uppercase mb-3">Galería</h6>
        <div class="row g-2">
            <div class="col-4">
                <img src="{{ asset('images/fondo-ayuda.jpeg') }}" alt="Imagen 1" class="img-fluid rounded" style="object-fit:cover; width:100%; height:70px;">
            </div>
            <div class="col-4">
                <img src="{{ asset('images/fondo-descubre.jpg') }}" alt="Imagen 2" class="img-fluid rounded" style="object-fit:cover; width:100%; height:70px;">
            </div>
            <div class="col-4">
                <img src="{{ asset('images/fondo-foros.jpg') }}" alt="Imagen 3" class="img-fluid rounded" style="object-fit:cover; width:100%; height:70px;">
            </div>
            <div class="col-4">
                <img src="{{ asset('images/fondo-personajes.jpg') }}" alt="Imagen 4" class="img-fluid rounded" style="object-fit:cover; width:100%; height:70px;">
            </div>
            <div class="col-4">
                <img src="{{ asset('images/fondo-peliculas.jpeg') }}" alt="Imagen 5" class="img-fluid rounded" style="object-fit:cover; width:100%; height:70px;">
            </div>
            <div class="col-4">
                <img src="{{ asset('images/fondo-series.jpg') }}" alt="Imagen 6" class="img-fluid rounded" style="object-fit:cover; width:100%; height:70px;">
            </div>
        </div>
    </div>

        </div>

        <!-- 4. Copyright -->
        <div class="text-center mt-4 pt-3 border-top border-secondary">
            &copy; {{ date('Y') }} Marvelpedia. Todos los derechos reservados.
        </div>
    </div>
</footer>

<style>
    footer {
        background-color: #212529;
        color: #f8f9fa;
    }

    footer a {
        color: #f8f9fa;
    }

    footer a:hover {
        color: #0d6efd;
        text-decoration: underline;
    }

    footer img {
        border-radius: 0.25rem;
        transition: transform 0.3s;
    }

    footer img:hover {
        transform: scale(1.1);
    }
</style>
