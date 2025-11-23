<section class="space-y-6">

    <!-- Header -->
    <header class="text-center mb-6">
        <h2 class="text-2xl font-extrabold text-red-700 animate-pulse">🛡️ {{ __('Actualizar Contraseña') }}</h2>
        <p class="mt-2 text-gray-600 text-lg">{{ __('Asegúrese de que su cuenta utilice una contraseña larga y aleatoria para mantener su seguridad.') }}</p>
    </header>

    <!-- Formulario -->
    <form method="post" action="{{ route('password.update') }}" class="space-y-6 bg-white p-6 rounded-3xl shadow-2xl animate-fade-in">
        @csrf
        @method('put')

        <!-- Contraseña Actual -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Contraseña Actual')" />
            <x-text-input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="mt-1 block w-full rounded-xl shadow-inner border-2 border-red-400 p-2 hover:shadow-lg transition-all"
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- Nueva Contraseña -->
        <div>
            <x-input-label for="update_password_password" :value="__('Nueva Contraseña')" />
            <x-text-input
                id="update_password_password"
                name="password"
                type="password"
                class="mt-1 block w-full rounded-xl shadow-inner border-2 border-yellow-400 p-2 hover:shadow-lg transition-all"
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Contraseña -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1 block w-full rounded-xl shadow-inner border-2 border-blue-400 p-2 hover:shadow-lg transition-all"
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botón Guardar -->
        <div class="flex items-center justify-end gap-4">
            <x-primary-button class="bg-red-600 hover:bg-red-700 transform hover:scale-105 transition-all">🔒 {{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-bold animate-pulse"
                >✅ Contraseña actualizada</p>
            @endif
        </div>
    </form>

    <!-- Animación Fade -->
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
