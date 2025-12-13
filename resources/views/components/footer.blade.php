<!-- resources/views/components/footer.blade.php -->

<footer class="bg-gradient-to-b from-blue-700 to-red-700 text-gray-200 mt-auto py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- 1. Logo + Contacto -->
        <div class="flex justify-center items-center text-center">
            <a href="{{ route('profile') }}" class="flex items-center justify-center mb-4">
                <img src="{{ asset('logos/Logo.PNG') }}" alt="Logo" class="h-8 md:h-24 lg:h-28 w-auto fill-current">
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="space-y-4">
                <h6 class="text-red-500 text-sm uppercase font-semibold mb-2">¡Hablemos!</h6>
                <p class="font-bold tracking-wide text-gray-300 sm:text-base leading-snug">
                    ¿Tienes dudas, ideas o sugerencias? Nos encantaría escucharte.
                </p>
                <p class="font-bold tracking-wide text-gray-300 sm:text-base leading-snug">
                    ¡Envíanos un mensaje y únete a nuestra comunidad de fans!
                </p>
                <form action="{{ route('support.enviar') }}" method="POST" id="supportForm" class="space-y-2">
                    @csrf

                    @if ($errors->any())
                        <div class="bg-red-200 text-red-800 p-4 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <input type="text"
                        class="w-full px-3 py-2 rounded-md text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500"
                        id="nombre" name="nombre" placeholder="Tu nombre" required>
                    <input type="email"
                        class="w-full px-3 py-2 rounded-md text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500"
                        id="email" name="email" placeholder="Tu correo" required>
                    <textarea class="w-full px-3 py-2 rounded-md text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500"
                        id="mensaje" name="mensaje" rows="4" placeholder="Tu mensaje" required></textarea>
                    <button type="submit"
                        class="w-full px-3 py-2 bg-red-500 text-white font-bold rounded-md hover:bg-red-600 transition-colors">Enviar
                        mensaje</button>
                </form>
            </div>


            <!-- 2. Menú de la página -->
            <div class="text-center md:text-left">
                <h6 class="text-yellow-400 uppercase text-sm font-semibold mb-3 md:mb-3 mb-1">Explora</h6>
                <ul class="grid grid-cols-2 gap-x-4 gap-y-2 md:block md:space-y-2">
                    <li><a href="{{ route('inicio') }}" class="hover:text-red-500 transition-colors">Inicio</a></li>
                    <li><a href="{{ route('descubre') }}" class="hover:text-red-500 transition-colors">Descubre</a></li>
                    <li><a href="{{ route('peliculas.index') }}"
                            class="hover:text-red-500 transition-colors">Películas</a>
                    </li>
                    <li><a href="{{ route('series') }}" class="hover:text-red-500 transition-colors">Series</a></li>
                    <li><a href="{{ route('ayuda') }}" class="hover:text-red-500 transition-colors">Ayuda</a></li>

                    @guest
                        {{-- Solo para usuarios no registrados --}}
                        <li><a href="{{ route('login') }}" class="hover:text-red-500 transition-colors">Iniciar Sesión</a>
                        </li>
                        <li><a href="{{ route('register') }}" class="hover:text-red-500 transition-colors">Regístrate</a>
                        </li>
                    @endguest

                    @auth
                        {{-- Opcional: enlaces para usuarios logueados --}}
                        <li><a href="{{ route('profile') }}" class="hover:text-red-500 transition-colors">Mi Perfil</a>
                        </li>

                        @if (Auth::user()->role === 'admin')
                            {{-- Solo para administradores --}}
                            <li><a href="{{ route('admin.dashboard') }}"
                                    class="hover:text-red-500 transition-colors">Gestionar
                                    Usuarios</a></li>
                            <li><a href="{{ route('admin.manage-content') }}"
                                    class="hover:text-red-500 transition-colors">Gestionar
                                    Contenido</a></li>
                        @endif
                    @endauth
                </ul>
            </div>

            <!-- 3. Sobre Marvelpedia -->
            <div class="text-center md:text-left">
                <h6 class="text-red-500 uppercase text-xs sm:text-sm font-semibold mb-2">
                    Sobre Marvelpedia
                </h6>

                <p class="mb-2 text-gray-300 text-sm sm:text-base leading-snug">
                    Marvelpedia es tu enciclopedia definitiva del universo Marvel. Explora héroes, villanos,
                    películas y series, y mantente al día con reseñas y debates de la comunidad.
                </p>

                <p class="mb-2 text-gray-300 text-sm sm:text-base leading-snug">
                    Nuestra misión es crear un espacio para fans donde descubrir, aprender y compartir la pasión por
                    Marvel sea fácil y divertido.
                </p>

                <p class="mb-2 text-gray-300 italic text-sm sm:text-base leading-snug">
                    "Un gran poder conlleva una gran responsabilidad… de conocer todo sobre Marvel."
                </p>
            </div>
        </div>
    </div>

    <!-- 4. Copyright -->
    <div class="text-center mt-8 pt-4 border-t border-yellow-400 text-sm text-gray-300">
        &copy; {{ date('Y') }} Marvelpedia. Todos los derechos reservados. ¡Sigue explorando el universo Marvel
        con nosotros!
    </div>
    </div>
</footer>
