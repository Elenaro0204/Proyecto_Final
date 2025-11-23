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
                    {{ __('Descubre') }}
                </x-nav-link>

                <!-- Dropdown Media -->
                <x-dropdown align="left">
                    <x-slot name="trigger">
                        <x-nav-link
                            class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                            {{ __('Media') }}
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
                        <x-dropdown-link :href="route('personajes')">{{ __('Personajes') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('comics')">{{ __('Cómics') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('peliculas.index')">{{ __('Películas') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('series')">{{ __('Series') }}</x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                <!-- Dropdown Comunidad -->
                <x-dropdown align="left">
                    <x-slot name="trigger">
                        <x-nav-link
                            class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                            {{ __('Comunidad') }}
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

                <x-nav-link :href="route('buscar')" :active="request()->routeIs('buscar')"
                    class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                    🔍
                </x-nav-link>
                <x-nav-link :href="route('ayuda')" :active="request()->routeIs('ayuda')"
                    class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                    ❓
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
                                <x-dropdown-link :href="route('admin.reports')"
                                    class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                                    {{ __('Ver reportes') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.settings')"
                                    class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                                    {{ __('Configuración del sitio') }}
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

    <!-- MENÚ RESPONSIVE (mobile) -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-red-900 text-white">
        <div class="flex flex-col pt-2 pb-3 space-y-1 px-4">
            <x-nav-link :href="route('descubre')" :active="request()->routeIs('descubre')"
                class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                {{ __('Descubre') }}
            </x-nav-link>
            <x-nav-link :href="route('personajes')" :active="request()->routeIs('personajes')"
                class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                {{ __('Personajes') }}
            </x-nav-link>
            <x-nav-link :href="route('comics')" :active="request()->routeIs('comics')"
                class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                {{ __('Cómics') }}
            </x-nav-link>
            <x-nav-link :href="route('peliculas.index')" :active="request()->routeIs('peliculas.index')"
                class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                {{ __('Películas') }}
            </x-nav-link>
            <x-nav-link :href="route('series')" :active="request()->routeIs('series')"
                class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                {{ __('Series') }}
            </x-nav-link>
            <x-nav-link :href="route('resenas')" :active="request()->routeIs('resenas')"
                class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                {{ __('Reseñas') }}
            </x-nav-link>
            <x-nav-link :href="route('foros.index')" :active="request()->routeIs('foros.index')"
                class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                {{ __('Foros') }}
            </x-nav-link>
            <x-nav-link :href="route('buscar')" :active="request()->routeIs('buscar')"
                class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                {{ __('Buscar') }}
            </x-nav-link>
            <x-nav-link :href="route('ayuda')" :active="request()->routeIs('ayuda')"
                class="inline-flex items-center px-3 py-2 rounded-md hover:text-yellow-400 transition-colors">
                {{ __('Ayuda') }}
            </x-nav-link>
        </div>

        <div class="p-4 border-t border-gray-200 mt-2">
            @guest
                <div class="space-y-1 px-4">
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-yellow-400 text-black rounded-lg font-bangers hover:bg-yellow-500 transition-colors">{{ __('Iniciar sesión') }}</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg font-bangers hover:bg-red-700 transition-colors">{{ __('Registrarse') }}</a>
                </div>
            @else
                <div class="flex items-center space-x-3">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <img src="{{ Auth::user()->avatar_url ?? asset('images/default-avatar.jpeg') }}"
                            alt="Avatar de {{ Auth::user()->name }}"
                            class="rounded-full border-2 border-yellow-400 w-10 h-10 object-cover">
                    </div>
                    <!-- Nombre y correo -->
                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Enlace al perfil -->
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>

                    <!-- Enlace a editar perfil -->
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Editar Perfil') }}
                    </x-dropdown-link>

                    <!-- Opciones de administrador integradas dentro del menú -->
                    @if (Auth::user()->role === 'admin')
                        <x-dropdown-link :href="route('admin.dashboard')">
                            {{ __('Ver todos los usuarios') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.manage-content')">
                            {{ __('Gestionar contenido') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.reports')">
                            {{ __('Ver reportes') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.settings')">
                            {{ __('Configuración del sitio') }}
                        </x-dropdown-link>
                    @endif

                    <!-- Botón de cerrar sesión -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Salir') }}
                        </x-responsive-nav-link>
                    </form>

                </div>

            @endguest
        </div>
    </div>
</nav>
