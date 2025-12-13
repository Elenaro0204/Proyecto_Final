<!-- resources/views/profile/partials/update-password-form.blade.php -->

<div class="relative z-10 py-6 sm:py-3">
    <header class="relative z-10 flex flex-col items-center text-center w-full mb-6">
        <h1 class="text-3xl text-red-700 font-bold">Actualizar Contraseña</h2>
        <p class="mt-2 text-gray-600 text-lg">
            {{ __('Asegúrese de que su cuenta utilice una contraseña larga y aleatoria para mantener su seguridad.') }}
        </p>
    </header>

    <!-- Formulario -->
    <form method="post" action="{{ route('password.update') }}"
        class="space-y-6 bg-white p-6 rounded-3xl shadow-2xl animate-fade-in">
        @csrf
        @method('put')

        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Contraseña Actual -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Contraseña Actual')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full rounded-xl shadow-inner p-2 hover:shadow-lg transition-all"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- Nueva Contraseña -->
        <div>
            <x-input-label for="update_password_password" :value="__('Nueva Contraseña')" />
            <x-text-input id="update_password_password" name="password" type="password"
                class="mt-1 block w-full rounded-xl shadow-inner p-2 hover:shadow-lg transition-all"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Contraseña -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full rounded-xl shadow-inner p-2 hover:shadow-lg transition-all"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botón Guardar -->
        <div class="flex justify-center mt-4">
            <button type="submit"
                class="px-4 py-2 bg-yellow-400 text-red-800 font-semibold rounded-lg hover:bg-yellow-500 transition">
                Guardar
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-bold animate-pulse">✅ Contraseña actualizada</p>
            @endif
        </div>
    </form>

    <!-- Animación Fade -->
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease forwards;
        }
    </style>

</section>
