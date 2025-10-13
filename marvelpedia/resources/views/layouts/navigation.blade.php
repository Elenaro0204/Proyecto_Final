<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- IZQUIERDA: Logo + Nombre -->
            <div class="flex items-center">
                <a href="{{ route('inicio') }}" class="flex items-center">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    <span class="ml-2 text-3xl text-gray-800 font-bangers">{{ config('app.name', 'Marvelpedia') }}</span>
                </a>
            </div>

            <!-- CENTRO: Navegación -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">
                <x-nav-link :href="route('descubre')" :active="request()->routeIs('descubre')">
                    {{ __('Descubre') }}
                </x-nav-link>

                <!-- Dropdown Media -->
                <x-dropdown align="left">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100">
                            <p>Media</p>
                            <!-- Flecha hacia abajo -->
                            <svg class="ml-1 h-4 w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('comics')">{{ __('Cómics') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('peliculas')">{{ __('Películas') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('series')">{{ __('Series') }}</x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                <!-- Dropdown Comunidad -->
                <x-dropdown align="left">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100">
                            <p>Comunidad</p>
                            <!-- Flecha hacia abajo -->
                            <svg class="ml-1 h-4 w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('resenas')">{{ __('Reseñas') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('foros')">{{ __('Foros') }}</x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                <x-nav-link :href="route('buscar')" :active="request()->routeIs('buscar')">
                    🔍
                </x-nav-link>
                <x-nav-link :href="route('ayuda')" :active="request()->routeIs('ayuda')">
                    ❓
                </x-nav-link>
            </div>


            <!-- DERECHA: Botones de login/registro o dropdown usuario -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 font-marvel">{{ __('Iniciar sesión') }}</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 font-bangers">{{ __('Registrarse') }}</a>
                @else
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-2 py-1 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none transition ease-in-out duration-150">

                                <!-- Imagen del avatar -->
                                <div class="flex-shrink-0 mr-3">
                                    <img src="{{ Auth::user()->avatar_url ?? asset('images/default-avatar.png') }}"
                                        alt="Avatar de {{ Auth::user()->name }}"
                                        class="rounded-full border-2 border-gray-200"
                                        style="width:40px; height:40px; object-fit:cover;">
                                </div>

                                <!-- Nombre del usuario -->
                                <span class="mr-2">{{ Auth::user()->name }}</span>

                                <!-- Icono desplegable -->
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')">
                                {{ __('Perfil') }}
                            </x-dropdown-link>
                             <!-- Enlace a editar perfil -->
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Editar Perfil') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Salir') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>

            <!-- HAMBURGUESA (mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- MENÚ RESPONSIVE (mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="flex flex-col pt-2 pb-3 space-y-1 px-4">
            <x-nav-link :href="route('descubre')" :active="request()->routeIs('descubre')">
                {{ __('Descubre') }}
            </x-nav-link>
            <x-nav-link :href="route('personajes')" :active="request()->routeIs('personajes')">
                {{ __('Personajes') }}
            </x-nav-link>
            <x-nav-link :href="route('comics')" :active="request()->routeIs('comics')">
                {{ __('Cómics') }}
            </x-nav-link>
            <x-nav-link :href="route('peliculas')" :active="request()->routeIs('peliculas')">
                {{ __('Películas') }}
            </x-nav-link>
            <x-nav-link :href="route('series')" :active="request()->routeIs('series')">
                {{ __('Series') }}
            </x-nav-link>
            <x-nav-link :href="route('resenas')" :active="request()->routeIs('resenas')">
                {{ __('Reseñas') }}
            </x-nav-link>
            <x-nav-link :href="route('foros')" :active="request()->routeIs('foros')">
                {{ __('Foros') }}
            </x-nav-link>
            <x-nav-link :href="route('ayuda')" :active="request()->routeIs('ayuda')">
                {{ __('Ayuda') }}
            </x-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 mt-2">
            @guest
                <div class="space-y-1 px-4">
                    <a href="{{ route('login') }}"
                        class="block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">{{ __('Iniciar sesión') }}</a>
                    <a href="{{ route('register') }}"
                        class="block px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">{{ __('Registrarse') }}</a>
                </div>
            @else
                <div class="flex items-center space-x-3">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <img src="{{ Auth::user()->avatar_url ?? asset('images/default-avatar.png') }}"
                            alt="Avatar de {{ Auth::user()->name }}"
                            class="rounded-full border-2 border-gray-200"
                            style="width:40px; height:40px; object-fit:cover;">
                    </div>
                    <!-- Nombre y correo -->
                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>
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
