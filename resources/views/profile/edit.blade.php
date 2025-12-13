<!-- resources/views/profile/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container p-3">
        <div class="row">

            <!-- Barra lateral -->
            <div class="col-12 col-md-3 mb-4 sticky overflow-y-auto z-40"
                style="top: 120px; max-height: calc(100vh - 140px);">
                @include('profile.partials.menu_lateral')
            </div>

            <!-- Contenido principal -->
            <div class="col-12 col-md-9 space-y-6">

                <!-- Información del perfil -->
                <section id="perfil-info" class="max-w-full mx-auto relative rounded-xl overflow-hidden shadow-xl py-6 sm:py-3">
                    <div class="absolute inset-0 bg-white opacity-50 z-0"></div>
                    <div class="relative z-10 max-w-full">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </section>

                <!-- Cambiar contraseña -->
                <section id="password" class="max-w-full mx-auto relative rounded-xl overflow-hidden shadow-xl p-6 sm:py-3">
                    <div class="absolute inset-0 bg-white opacity-50 z-0"></div>
                    <div class="relative z-10 max-w-full">
                        @include('profile.partials.update-password-form')
                    </div>
                </section>

                <!-- Eliminar cuenta -->
                <section id="delete" class="max-w-full mx-auto relative rounded-xl overflow-hidden shadow-xl p-6 mt-3 sm:py-3">
                    <div class="absolute inset-0 bg-white opacity-50 z-0"></div>
                    <div class="relative z-10 max-w-full">
                        @include('profile.partials.delete-user-form')
                    </div>
                </section>

            </div>
        </div>
    </div>

    <!-- Animaciones adicionales -->
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
@endsection
