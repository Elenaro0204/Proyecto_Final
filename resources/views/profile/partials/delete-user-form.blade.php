<!-- resources/views/profile/partials/delete-user-form.blade.php -->

<section class="space-y-6">

    <!-- Header -->
    <header class="text-center mb-6">
        <h2 class="text-2xl font-extrabold text-red-700 animate-pulse">💥 {{ __('Eliminar Cuenta') }}</h2>
        <p class="mt-2 text-gray-600 text-lg">
            {{ __('Una vez eliminada su cuenta, todos sus recursos y datos se eliminarán permanentemente. Antes de eliminar su cuenta, descargue cualquier dato o información que desee conservar.') }}
        </p>
    </header>

    <!-- Botón eliminar -->
    <div class="flex justify-center">
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="bg-red-600 hover:bg-red-700 transform hover:scale-110 transition-all text-lg px-6 py-3 shadow-lg rounded-2xl"
        >
            🛑 {{ __('Eliminar Cuenta') }}
        </x-danger-button>
    </div>

    <!-- Modal de confirmación -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-gradient-to-br from-red-50 via-white to-black rounded-3xl shadow-2xl border-2 border-red-500 animate-fade-in space-y-4">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-red-700">⚠️ {{ __('¿Estás seguro de que quieres eliminar tu cuenta?') }}</h2>
            <p class="text-gray-700">
                {{ __('Una vez eliminada su cuenta, todos sus recursos y datos se eliminarán permanentemente. Ingrese su contraseña para confirmar que desea eliminar su cuenta permanentemente.') }}
            </p>

            <!-- Contraseña -->
            <div>
                <x-input-label for="password" value="{{ __('Contraseña') }}" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded-xl shadow-inner border-2 border-red-400 p-2 hover:shadow-lg transition-all"
                    placeholder="{{ __('Contraseña') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-4 mt-4">
                <x-secondary-button x-on:click="$dispatch('close')" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-xl shadow-md transition-all transform hover:-translate-y-1">
                    ❌ {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-xl shadow-lg transform hover:scale-105 transition-all">
                    💣 {{ __('Eliminar Cuenta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

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
