<section>
    <header class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">{{ __('Información del Perfil') }}</h2>
        <p class="mt-2 text-gray-600">{{ __("Actualiza la información de tu perfil.") }}</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Datos básicos -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', Auth::user()->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="nickname" :value="__('Apodo')" />
                <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full" :value="old('nickname', Auth::user()->nickname)" />
                <x-input-error class="mt-2" :messages="$errors->get('nickname')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', Auth::user()->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div>
                <x-input-label for="fecha_nacimiento" :value="__('Fecha de Nacimiento')" />
                <x-text-input id="fecha_nacimiento" name="fecha_nacimiento" type="date" class="mt-1 block w-full" :value="old('fecha_nacimiento', Auth::user()->fecha_nacimiento)" />
                <x-input-error class="mt-2" :messages="$errors->get('fecha_nacimiento')" />
            </div>
        </div>

        <!-- Avatar y biografía -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="avatar_url" :value="__('Avatar URL')" />
                <x-text-input id="avatar_url" name="avatar_url" type="text" class="mt-1 block w-full" :value="old('avatar_url', Auth::user()->avatar_url)" />
                <x-input-error class="mt-2" :messages="$errors->get('avatar_url')" />
            </div>

            <div>
                <x-input-label for="bio" :value="__('Biografía')" />
                <textarea id="bio" name="bio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('bio', Auth::user()->bio) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('bio')" />
            </div>
        </div>

        <!-- Redes sociales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="twitter" :value="__('Twitter')" />
                <x-text-input id="twitter" name="twitter" type="text" class="mt-1 block w-full" :value="old('twitter', Auth::user()->twitter)" />
                <x-input-error class="mt-2" :messages="$errors->get('twitter')" />
            </div>

            <div>
                <x-input-label for="instagram" :value="__('Instagram')" />
                <x-text-input id="instagram" name="instagram" type="text" class="mt-1 block w-full" :value="old('instagram', Auth::user()->instagram)" />
                <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
            </div>

            <div>
                <x-input-label for="pais" :value="__('País')" />
                @include('components.pais')
                <x-input-error class="mt-2" :messages="$errors->get('pais')" />
            </div>

        </div>

        <!-- Favoritos -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="favorito_personaje" :value="__('Personaje favorito')" />
                <x-text-input id="favorito_personaje" name="favorito_personaje" type="text" class="mt-1 block w-full" :value="old('favorito_personaje', Auth::user()->favorito_personaje)" />
                <x-input-error class="mt-2" :messages="$errors->get('favorito_personaje')" />
            </div>

            <div>
                <x-input-label for="favorito_comic" :value="__('Comic favorito')" />
                <x-text-input id="favorito_comic" name="favorito_comic" type="text" class="mt-1 block w-full" :value="old('favorito_comic', Auth::user()->favorito_comic)" />
                <x-input-error class="mt-2" :messages="$errors->get('favorito_comic')" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="ml-4 text-sm text-green-600"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
