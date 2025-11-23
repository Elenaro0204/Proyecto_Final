<section class="space-y-8">

    <header class="mb-6 text-center">
        <h2 class="text-3xl font-extrabold text-red-700 animate-pulse">{{ __('🛡️ Información del Perfil') }}</h2>
        <p class="mt-2 text-gray-600 text-lg">{{ __("Actualiza la información de tu perfil y hazlo más épico.") }}</p>
    </header>

    <!-- Formulario de verificación oculto -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}" enctype="multipart/form-data">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6 bg-white p-6 rounded-3xl shadow-2xl animate-fade-in">
        @csrf
        @method('patch')

        <!-- Avatar -->
        <div class="mb-6">
            <x-input-label for="avatar_url" :value="__('Avatar')" />
            @if($user->avatar_url)
                <div class="mb-2 flex items-center gap-4">
                    <img src="{{ $user->avatar_url }}" alt="Avatar" class="w-24 h-24 rounded-full object-cover border-4 border-red-500 shadow-lg animate-bounce">
                    <button type="submit" name="delete_avatar" value="1"
                        class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all shadow-md hover:shadow-xl">
                        🗑️ Eliminar foto
                    </button>
                </div>
            @endif
            <input type="file" name="avatar" id="avatar"
                class="w-full border-gray-300 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 mt-2 shadow-inner">
        </div>

        <!-- Datos básicos -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-xl shadow-inner border-2 border-red-400" :value="old('name', Auth::user()->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="nickname" :value="__('Apodo')" />
                <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full rounded-xl shadow-inner border-2 border-red-400" :value="old('nickname', Auth::user()->nickname)" />
                <x-input-error class="mt-2" :messages="$errors->get('nickname')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-xl shadow-inner border-2 border-yellow-400" :value="old('email', Auth::user()->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div>
                <x-input-label for="fecha_nacimiento" :value="__('Fecha de Nacimiento')" />
                <x-text-input id="fecha_nacimiento" name="fecha_nacimiento" type="date" max="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-xl shadow-inner border-2 border-yellow-400" :value="old('fecha_nacimiento', Auth::user()->fecha_nacimiento)" />
                <x-input-error class="mt-2" :messages="$errors->get('fecha_nacimiento')" />
            </div>

            <div>
                <x-input-label for="pais" :value="__('País')" />
                @include('components.pais')
                <x-input-error class="mt-2" :messages="$errors->get('pais')" />
            </div>
        </div>

        <!-- Biografía -->
        <div>
            <x-input-label for="bio" :value="__('Biografía')" />
            <textarea id="bio" name="bio" class="mt-1 block w-full rounded-2xl border-2 border-blue-400 p-3 shadow-inner resize-none hover:shadow-lg transition-all">{{ old('bio', Auth::user()->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <!-- Redes sociales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="twitter" :value="__('Twitter')" />
                <x-text-input id="twitter" name="twitter" type="text" class="mt-1 block w-full rounded-xl shadow-inner border-2 border-blue-400" :value="old('twitter', Auth::user()->twitter)" />
                <x-input-error class="mt-2" :messages="$errors->get('twitter')" />
            </div>

            <div>
                <x-input-label for="instagram" :value="__('Instagram')" />
                <x-text-input id="instagram" name="instagram" type="text" class="mt-1 block w-full rounded-xl shadow-inner border-2 border-pink-400" :value="old('instagram', Auth::user()->instagram)" />
                <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
            </div>
        </div>

        <!-- Favoritos -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="favorito_personaje" :value="__('Personaje favorito')" />
                <x-text-input id="favorito_personaje" name="favorito_personaje" type="text" class="mt-1 block w-full rounded-xl shadow-inner border-2 border-red-500" :value="old('favorito_personaje', Auth::user()->favorito_personaje)" />
                <x-input-error class="mt-2" :messages="$errors->get('favorito_personaje')" />
            </div>

            <div>
                <x-input-label for="favorito_comic" :value="__('Comic favorito')" />
                <x-text-input id="favorito_comic" name="favorito_comic" type="text" class="mt-1 block w-full rounded-xl shadow-inner border-2 border-red-500" :value="old('favorito_comic', Auth::user()->favorito_comic)" />
                <x-input-error class="mt-2" :messages="$errors->get('favorito_comic')" />
            </div>
        </div>

        <!-- Botón de guardar -->
        <div class="flex items-center justify-end mt-6 gap-4">
            <x-primary-button class="bg-red-600 hover:bg-red-700 transform hover:scale-105 transition-all">💾 Guardar</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="ml-4 text-sm text-green-600 font-bold animate-pulse"
                >✅ Guardado correctamente</p>
            @endif
        </div>
    </form>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.6s ease forwards;
        }
    </style>
</section>
