<!-- resources/views/profile/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl text-red-700 leading-tight text-center">
            {{ __('🛡️ Perfil de :name', ['name' => Auth::user()->name]) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <!-- MENÚ LATERAL MARVEL -->
                <aside class="md:col-span-1 bg-gradient-to-br from-red-50 via-yellow-50 to-blue-50 shadow-2xl rounded-3xl p-5 sticky top-24 h-fit overflow-y-auto border-2 border-red-600">
                    <h3 class="text-2xl font-extrabold text-red-600 mb-6 text-center animate-pulse">🦸 Menú de Perfil</h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="#perfil-info"
                               class="flex items-center px-4 py-3 rounded-2xl bg-white shadow-md hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 group">
                                <i class="fas fa-user fa-2x text-red-500 group-hover:text-red-600 me-4 animate-bounce"></i>
                                <span class="font-bold text-gray-800 text-lg">Información del perfil</span>
                            </a>
                        </li>
                        <li>
                            <a href="#password"
                               class="flex items-center px-4 py-3 rounded-2xl bg-white shadow-md hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 group">
                                <i class="fas fa-key fa-2x text-yellow-500 group-hover:text-yellow-600 me-4 animate-bounce"></i>
                                <span class="font-bold text-gray-800 text-lg">Cambiar contraseña</span>
                            </a>
                        </li>
                        <li>
                            <a href="#delete"
                               class="flex items-center px-4 py-3 rounded-2xl bg-white shadow-md hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 group">
                                <i class="fas fa-skull-crossbones fa-2x text-black group-hover:text-red-700 me-4 animate-bounce"></i>
                                <span class="font-bold text-gray-800 text-lg">Eliminar cuenta</span>
                            </a>
                        </li>
                    </ul>
                </aside>

                <!-- CONTENIDO PRINCIPAL MARVEL -->
                <main class="md:col-span-3 space-y-6">

                    <!-- Información del perfil -->
                    <section id="perfil-info"
                             class="p-4 sm:p-8 bg-gradient-to-r from-red-50 via-white to-blue-50 shadow-lg rounded-2xl border-2 border-red-500 animate-fade-in">
                        <div class="max-w-full">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </section>

                    <!-- Cambiar contraseña -->
                    <section id="password"
                             class="p-4 sm:p-8 bg-gradient-to-r from-yellow-50 via-white to-green-50 shadow-lg rounded-2xl border-2 border-yellow-500 animate-fade-in">
                        <div class="max-w-full">
                            @include('profile.partials.update-password-form')
                        </div>
                    </section>

                    <!-- Eliminar cuenta -->
                    <section id="delete"
                             class="p-4 sm:p-8 bg-gradient-to-r from-blue-50 via-yellow-50 to-red-50 shadow-lg rounded-2xl border-2 border-red-800 animate-fade-in">
                        <div class="max-w-full">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </section>

                </main>
            </div>
        </div>
    </div>

    <!-- Animaciones adicionales -->
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.6s ease forwards;
        }
    </style>
@endsection
