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
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required
                autocomplete="new-password" />

            <!-- Botón ojo -->
            <span onclick="togglePassword('password', 'eyeOpen', 'eyeClosed')"
                class="absolute right-3 top-9 cursor-pointer text-gray-500 hover:text-gray-700">

                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>

                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.543-7a9.97 9.97 0 012.223-3.592M6.228 6.228A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411M15 12a3 3 0 00-4.243-4.243M3 3l18 18" />
                </svg>

            </span>

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
        <div class="mt-4 relative">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10" type="password" name="password_confirmation"
                required autocomplete="new-password" />

            <!-- Botón ojo confirmación -->
            <span onclick="togglePassword('password_confirmation', 'eyeOpen2', 'eyeClosed2')"
                class="absolute right-3 top-9 cursor-pointer text-gray-500 hover:text-gray-700">

                <svg id="eyeOpen2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>

                <svg id="eyeClosed2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.543-7a9.97 9.97 0 012.223-3.592M6.228 6.228A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411M15 12a3 3 0 00-4.243-4.243M3 3l18 18" />
                </svg>

            </span>

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
        function togglePassword(inputId, eyeOpenId, eyeClosedId) {
            const input = document.getElementById(inputId);
            const eyeOpen = document.getElementById(eyeOpenId);
            const eyeClosed = document.getElementById(eyeClosedId);

            if (input.type === "password") {
                input.type = "text";
                eyeOpen.classList.add("hidden");
                eyeClosed.classList.remove("hidden");
            } else {
                input.type = "password";
                eyeOpen.classList.remove("hidden");
                eyeClosed.classList.add("hidden");
            }
        }

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
