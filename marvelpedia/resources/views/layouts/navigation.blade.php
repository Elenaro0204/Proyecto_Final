<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-light bg-light border-bottom fixed-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <x-application-logo class="d-inline-block align-text-top me-2" style="height: 50px; width: auto;"/>
            <span class="h5 mb-0">Marvelpedia</span>
        </a>

        <!-- Hamburger / Collapse button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links & settings -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
            <ul class="navbar-nav mb-2 mb-lg-0 align-items-lg-center">
                <!-- Navegación principal -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('personajes') ? 'active' : '' }}" href="{{ route('personajes') }}">
                        Personajes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('comics') ? 'active' : '' }}" href="{{ route('comics') }}">
                        Cómics
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('peliculas') ? 'active' : '' }}" href="{{ route('peliculas') }}">
                        Películas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('series') ? 'active' : '' }}" href="{{ route('series') }}">
                        Series
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('ayuda') ? 'active' : '' }}" href="{{ route('ayuda') }}">
                        Ayuda
                    </a>
                </li>

                <!-- Separación opcional -->
                <li class="nav-item ms-lg-3"></li>

                <!-- Autenticación -->
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                @guest
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-primary px-3 me-2" href="{{ route('login') }}">Iniciar sesión</a>
                        <a class="btn btn-success px-3" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<style>
    #mainNavbar {
        transition: top 0.3s;
        z-index: 1030;
    }
</style>

<script>
    let lastScrollTop = 0;
    const navbar = document.getElementById('mainNavbar');

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const delta = scrollTop - lastScrollTop;

        // Si hacemos scroll hacia abajo y superamos 50px, oculta navbar
        if (delta > 0 && scrollTop > 50) {
            navbar.style.top = "-80px";
        }
        // Si hacemos scroll hacia arriba, muestra navbar
        else if (delta < 0) {
            navbar.style.top = "0";
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });
</script>

