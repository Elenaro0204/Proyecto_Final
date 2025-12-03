<nav x-data="{ open: false }"
    class="bg-gradient-to-r from-red-700 via-blue-700 to-red-800 shadow-lg sticky top-0 z-50 border-b border-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- IZQUIERDA: Logo + Nombre -->
            <div class="flex items-center">
                <a href="{{ route('inicio') }}"
                    class="flex items-center transform hover:scale-105 transition-all duration-300">
                    <x-application-logo class="block h-10 w-auto fill-current text-white" />
                    <span
                        class="ml-2 text-3xl text-yellow-400 font-bangers animate-pulse">{{ config('app.name', 'Marvelpedia') }}</span>
                </a>
            </div>

            <!-- CENTRO: Navegación -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4 text-white font-bold">
                <x-nav-link :href="route('descubre')" :active="request()->routeIs('descubre')"
                    class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                    {{ __('🔍 Descubre') }}
                </x-nav-link>

                <!-- Dropdown Media -->
                <x-dropdown align="left">
                    <x-slot name="trigger">
                        <x-nav-link
                            class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors cursor-pointer">
                            {{ __('🎬 Media') }}
                            <!-- Flecha hacia abajo -->
                            <svg class="ml-1 h-4 w-4 fill-current text-yellow-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </x-nav-link>
                    </x-slot>
                    <x-slot name="content" class="bg-red-800 text-white rounded-lg shadow-lg border border-yellow-400">
                        <x-dropdown-link :href="route('peliculas.index')">{{ __('Películas') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('series')">{{ __('Series') }}</x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                <!-- Dropdown Comunidad -->
                <x-dropdown align="left">
                    <x-slot name="trigger">
                        <x-nav-link
                            class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors cursor-pointer">
                            {{ __('🗨️ Comunidad') }}
                            <!-- Flecha hacia abajo -->
                            <svg class="ml-1 h-4 w-4 fill-current text-yellow-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </x-nav-link>
                    </x-slot>
                    <x-slot name="content" class="bg-red-800 text-white rounded-lg shadow-lg border border-yellow-400">
                        <x-dropdown-link :href="route('resenas')">{{ __('Reseñas') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('foros.index')">{{ __('Foros') }}</x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                <x-nav-link :href="route('ayuda')" :active="request()->routeIs('ayuda')"
                    class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                    ❓Ayuda
                </x-nav-link>
            </div>

            <!-- DERECHA: Botones de login/registro o dropdown usuario -->
            <div class="hidden sm:flex sm:items-center sm:space-x-3">
                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-yellow-400 text-black rounded-lg font-bangers hover:bg-yellow-500 transition-colors">{{ __('Iniciar sesión') }}</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg font-bangers hover:bg-red-700 transition-colors">{{ __('Registrarse') }}</a>
                @else
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 rounded-md bg-red-900 text-white hover:bg-red-800 transition-colors">
                                <!-- Imagen del avatar -->
                                <div class="flex-shrink-0 mr-2">
                                    <img src="{{ Auth::user()->avatar_url ?? asset('images/default-avatar.jpeg') }}"
                                        alt="Avatar de {{ Auth::user()->name }}"
                                        class="rounded-full border-2 border-yellow-400 w-10 h-10 object-cover">
                                </div>

                                <!-- Nombre del usuario -->
                                <span class="mr-2">{{ Auth::user()->name }}</span>

                                <!-- Icono desplegable -->
                                <svg class="ml-1 h-4 w-4 fill-current text-yellow-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                        </x-slot>

                        <x-slot name="content" class="text-white rounded-lg shadow-lg border border-yellow-400">
                            <x-dropdown-link :href="route('profile')"
                                class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            <!-- Enlace a editar perfil -->
                            <x-dropdown-link :href="route('profile.edit')"
                                class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                                {{ __('Editar Perfil') }}
                            </x-dropdown-link>

                            <!-- Opciones de administrador integradas dentro del menú -->
                            @if (Auth::user()->role === 'admin')
                                <x-dropdown-link :href="route('admin.dashboard')"
                                    class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                                    {{ __('Ver todos los usuarios') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.manage-content')"
                                    class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                                    {{ __('Gestionar contenido') }}
                                </x-dropdown-link>
                            @endif

                            <div class="flex justify-center mt-2">
                                <form method="POST" action="{{ route('logout') }}"
                                    class="inline-flex items-center m-auto px-2 py-2 rounded-md bg-blue-800 hover:bg-yellow-500 transition-colors">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>

            <!-- HAMBURGUESA (mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'translate-x-0': open, '-translate-x-full': !open }"
        class="border-t fixed top-16 left-0 h-full w-64 bg-gradient-to-r from-red-700 to-blue-700 text-white transform -translate-x-full transition-transform duration-300 z-50 shadow-xl">

        <!-- Media -->
        <div x-data="{ openMedia: false }" class="border-b pb-2">
            <button @click="openMedia = !openMedia"
                class="w-full flex justify-between items-center px-3 py-2 text-left text-yellow-400 font-semibold rounded-md hover:text-yellow-300 transition-colors">
                🎬 Media
                <svg :class="{ 'rotate-180': openMedia }" class="h-4 w-4 transform transition-transform duration-300"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="openMedia" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-40"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-40"
                x-transition:leave-end="opacity-0 max-h-0" class="mt-2 pl-4 overflow-hidden flex flex-col space-y-1">
                <x-nav-link :href="route('peliculas.index')" :active="request()->routeIs('peliculas.index')"
                    class="block px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                    Películas
                </x-nav-link>
                <x-nav-link :href="route('series')" :active="request()->routeIs('series')"
                    class="block px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                    Series
                </x-nav-link>
            </div>
        </div>

        <!-- Comunidad -->
        <div x-data="{ openComunidad: false }" class="border-b pb-2">
            <button @click="openComunidad = !openComunidad"
                class="w-full flex justify-between items-center px-3 py-2 text-left text-yellow-400 font-semibold rounded-md hover:text-yellow-300 transition-colors">
                🗨️ Comunidad
                <svg :class="{ 'rotate-180': openComunidad }"
                    class="h-4 w-4 transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="openComunidad"x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-40"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-40"
                x-transition:leave-end="opacity-0 max-h-0" class="mt-2 pl-4 overflow-hidden flex flex-col space-y-1">
                <x-nav-link :href="route('resenas')" :active="request()->routeIs('resenas')"
                    class="block px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                    Reseñas
                </x-nav-link>
                <x-nav-link :href="route('foros.index')" :active="request()->routeIs('foros.index')"
                    class="block px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                    Foros
                </x-nav-link>
            </div>
        </div>

        <!-- Otros enlaces simples -->
        <div class="flex flex-col space-y-1">
            <x-nav-link :href="route('descubre')" :active="request()->routeIs('descubre')"
                class="block px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                🔍 Descubre
            </x-nav-link>
            <x-nav-link :href="route('ayuda')" :active="request()->routeIs('ayuda')"
                class="block px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                ❓Ayuda
            </x-nav-link>
        </div>

        <!-- Sección de usuario -->
        <div class="border-t pt-2">
            @guest
                <a href="{{ route('login') }}"
                    class="block w-full text-center px-4 py-2 bg-yellow-400 text-black rounded-lg font-bangers hover:bg-yellow-500 transition-colors">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}"
                    class="block w-full text-center mt-2 px-4 py-2 bg-red-600 text-white rounded-lg font-bangers hover:bg-red-700 transition-colors">
                    Registrarse
                </a>
            @else
                <!-- Usuario -->
                <div x-data="{ openUsuario: false }" class="border-b pb-2">
                    <button @click="openUsuario = !openUsuario"
                        class="w-full flex justify-between items-center px-3 py-2 text-left text-yellow-400 font-semibold rounded-md hover:text-yellow-300 transition-colors">
                        <!-- Imagen del avatar y nombre -->
                        <div class="flex items-center space-x-3">
                            <img src="{{ Auth::user()->avatar_url ?? asset('images/default-avatar.jpeg') }}"
                                alt="Avatar de {{ Auth::user()->name }}"
                                class="rounded-full border-2 border-yellow-400 w-10 h-10 object-cover">
                            <div class="font-medium text-base text-yellow-400">{{ Auth::user()->name }}</div>
                        </div>

                        <!-- Icono desplegable -->
                        <svg :class="{ 'rotate-180': openUsuario }"
                            class="h-4 w-4 transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="openUsuario" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-40"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 max-h-40" x-transition:leave-end="opacity-0 max-h-0"
                        class="mt-2 pl-4 overflow-hidden flex flex-col space-y-1">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                            class="block px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                            Perfil
                        </x-nav-link>
                        @if (Auth::user()->role === 'admin')
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                                class="block px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                                Gestión Usuarios
                            </x-nav-link>
                            <x-nav-link :href="route('admin.manage-content')" :active="request()->routeIs('admin.manage-content')"
                                class="block px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                                Gestión Contenido
                            </x-nav-link>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Salir
                            </x-nav-link>
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</nav>
