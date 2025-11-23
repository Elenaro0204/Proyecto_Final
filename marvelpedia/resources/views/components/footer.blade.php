<footer class="bg-gray-900 text-gray-200 mt-auto py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- 1. Logo + Contacto -->
            <div class="text-center md:text-left">
                <a href="{{ route('dashboard') }}" class="flex items-center justify-center md:justify-start mb-4">
                    <x-application-logo class="h-8 w-auto mr-2 fill-current text-white" />
                    <span class="text-2xl font-bangers text-yellow-400">Marvelpedia</span>
                </a>

                <h6 class="text-blue-400 text-sm uppercase font-semibold mb-2">Contáctame</h6>
                <p class="font-bold tracking-wide">
                    ¿Tienes alguna duda o sugerencia?
                </p>
                <p class="font-bold tracking-wide">
                    ¡Envíanos un mensaje!
                </p>
                <form action="https://formspree.io/f/mnnggdaz" method="POST" class="space-y-2">
                    @csrf
                    <input type="text" name="nombre" placeholder="Tu nombre" required
                        class="w-full px-3 py-2 rounded-md text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <input type="email" name="email" placeholder="Tu correo" required
                        class="w-full px-3 py-2 rounded-md text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <textarea name="mensaje" rows="2" placeholder="Tu mensaje" required
                        class="w-full px-3 py-2 rounded-md text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-400"></textarea>
                    <button type="submit"
                        class="w-full px-3 py-2 bg-yellow-400 text-gray-900 font-bold rounded-md hover:bg-yellow-500 transition-colors">
                        Enviar
                    </button>
                </form>
            </div>

            <!-- 2. Menú de la página -->
            <div class="text-center md:text-left">
                <h6 class="text-blue-400 uppercase text-sm font-semibold mb-3">Menú</h6>
                <ul class="space-y-2">
                    <li><a href="{{ route('inicio') }}" class="hover:text-yellow-400 transition-colors">Inicio</a></li>
                    <li><a href="{{ route('descubre') }}" class="hover:text-yellow-400 transition-colors">Descubre</a>
                    </li>
                    <li><a href="{{ route('personajes') }}"
                            class="hover:text-yellow-400 transition-colors">Personajes</a></li>
                    <li><a href="{{ route('comics') }}" class="hover:text-yellow-400 transition-colors">Cómics</a></li>
                    <li><a href="{{ route('peliculas.index') }}" class="hover:text-yellow-400 transition-colors">Películas</a>
                    </li>
                    <li><a href="{{ route('series') }}" class="hover:text-yellow-400 transition-colors">Series</a></li>
                    <li><a href="{{ route('ayuda') }}" class="hover:text-yellow-400 transition-colors">Ayuda</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-yellow-400 transition-colors">Iniciar
                            Sesión</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-yellow-400 transition-colors">Registrar</a>
                    </li>
                </ul>
            </div>

            <!-- 3. Galería de imágenes -->
            <div class="text-center md:text-left">
                <h6 class="text-blue-400 uppercase text-sm font-semibold mb-3">Galería</h6>
                <div class="grid grid-cols-3 gap-2">
                    <img src="{{ asset('images/fondo-ayuda.jpeg') }}" alt="Imagen 1"
                        class="rounded-md object-cover w-full h-20 hover:scale-110 transition-transform">
                    <img src="{{ asset('images/fondo-descubre.jpg') }}" alt="Imagen 2"
                        class="rounded-md object-cover w-full h-20 hover:scale-110 transition-transform">
                    <img src="{{ asset('images/fondo-foros.jpg') }}" alt="Imagen 3"
                        class="rounded-md object-cover w-full h-20 hover:scale-110 transition-transform">
                    <img src="{{ asset('images/fondo-personajes.jpg') }}" alt="Imagen 4"
                        class="rounded-md object-cover w-full h-20 hover:scale-110 transition-transform">
                    <img src="{{ asset('images/fondo-peliculas.jpeg') }}" alt="Imagen 5"
                        class="rounded-md object-cover w-full h-20 hover:scale-110 transition-transform">
                    <img src="{{ asset('images/fondo-series.jpg') }}" alt="Imagen 6"
                        class="rounded-md object-cover w-full h-20 hover:scale-110 transition-transform">
                </div>
            </div>

        </div>

        <!-- 4. Copyright -->
        <div class="text-center mt-8 pt-4 border-t border-yellow-500 text-sm">
            &copy; {{ date('Y') }} Marvelpedia. Todos los derechos reservados.
        </div>
    </div>
</footer>
