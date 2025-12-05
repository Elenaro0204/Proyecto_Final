<!-- resources/views/auth/register.blade.php -->

@extends('layouts.guest')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <div id="password-requirements" class="mt-3 p-4 rounded-lg text-sm space-y-2">
                <p class="font-bold mb-2">Tu contraseña debe cumplir con:</p>
                <div class="flex items-center gap-2">
                    <span id="length-icon" class="w-5 h-5 text-red-600">❌</span>
                    <span>Mínimo 8 caracteres</span>
                </div>
                <div class="flex items-center gap-2">
                    <span id="uppercase-icon" class="w-5 h-5 text-red-600">❌</span>
                    <span>Al menos una letra mayúscula</span>
                </div>
                <div class="flex items-center gap-2">
                    <span id="lowercase-icon" class="w-5 h-5 text-red-600">❌</span>
                    <span>Al menos una letra minúscula</span>
                </div>
                <div class="flex items-center gap-2">
                    <span id="number-icon" class="w-5 h-5 text-red-600">❌</span>
                    <span>Al menos un número</span>
                </div>
                <div class="flex items-center gap-2">
                    <span id="symbol-icon" class="w-5 h-5 text-red-600">❌</span>
                    <span>Al menos un símbolo (!@#$ etc.)</span>
                </div>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
                required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('¿Ya estás registrado?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrarme') }}
            </x-primary-button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Seleccionamos el input de contraseña
            const passwordInput = document.getElementById('password');

            passwordInput.addEventListener('input', () => {
                const value = passwordInput.value;

                const updateIcon = (id, condition) => {
                    const el = document.getElementById(id);
                    if (condition) {
                        el.textContent = '✅';
                        el.classList.remove('text-red-600');
                        el.classList.add('text-green-500');
                    } else {
                        el.textContent = '❌';
                        el.classList.remove('text-green-500');
                        el.classList.add('text-red-600');
                    }
                };

                updateIcon('length-icon', value.length >= 8);
                updateIcon('uppercase-icon', /[A-Z]/.test(value));
                updateIcon('lowercase-icon', /[a-z]/.test(value));
                updateIcon('number-icon', /[0-9]/.test(value));
                updateIcon('symbol-icon', /[^A-Za-z0-9]/.test(value)); // Detecta cualquier símbolo
            });

        });
    </script>
@endpush
