<!-- resources/views/auth/login.blade.php -->
<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email -->
    <div class="mb-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input 
            id="email" 
            class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
            type="email" 
            name="email" 
            :value="old('email')" 
            required 
            autofocus 
            autocomplete="username" 
        />
        <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500 text-sm" />
    </div>

    <!-- Password -->
    <div class="mb-4">
        <x-input-label for="password" :value="__('Contraseña')" />
        <x-text-input 
            id="password" 
            class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
            type="password" 
            name="password" 
            required 
            autocomplete="current-password" 
        />
        <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-sm" />
    </div>

    <!-- Remember Me -->
    <div class="mb-4 flex items-center">
        <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
        <label for="remember_me" class="ml-2 text-sm text-gray-600">{{ __('Recuérdame') }}</label>
    </div>

    <!-- Botón y link -->
    <div class="flex items-center justify-between mt-6">
        @if (Route::has('password.request'))
            <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                {{ __('¿Olvidaste tu contraseña?') }}
            </a>
        @endif

        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
            {{ __('Iniciar Sesión') }}
        </x-primary-button>
    </div>
</form>
