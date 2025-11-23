@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">
    <h1 class="text-4xl font-bold mb-6 text-center text-gray-800">⚙️ Configuración del Sitio</h1>
    <p class="text-center text-gray-600 mb-12">Gestiona la información general, apariencia y redes sociales de tu web desde aquí.</p>

    <!-- Tarjeta: Información General -->
    <div class="bg-white shadow-xl rounded-2xl p-8 mb-10 hover:shadow-2xl transition-shadow duration-300">
        <h2 class="text-2xl font-semibold mb-6 text-gray-700 border-b pb-2">Información General</h2>
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block mb-2 font-medium text-gray-600">Nombre del sitio</label>
                <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}"
                       class="w-full border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
            </div>
            <div>
                <label class="block mb-2 font-medium text-gray-600">Descripción</label>
                <textarea name="description" rows="3"
                          class="w-full border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                          placeholder="Describe tu sitio web aquí">{{ old('description', $settings['description'] ?? '') }}</textarea>
            </div>
            <div>
                <label class="block mb-2 font-medium text-gray-600">Logo del sitio</label>
                <input type="file" name="logo" class="w-full border-gray-300 rounded-xl px-4 py-2">
                @if(!empty($settings['logo']))
                    <img src="{{ $settings['logo'] }}" alt="Logo" class="w-32 mt-4 rounded-lg shadow">
                @endif
            </div>
            <button class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 transition-colors duration-200 font-semibold">Guardar Cambios</button>
        </form>
    </div>

    <!-- Tarjeta: Apariencia -->
    <div class="bg-white shadow-xl rounded-2xl p-8 mb-10 hover:shadow-2xl transition-shadow duration-300">
        <h2 class="text-2xl font-semibold mb-6 text-gray-700 border-b pb-2">Apariencia</h2>
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="flex items-center gap-6">
                <div>
                    <label class="block mb-2 font-medium text-gray-600">Color principal</label>
                    <input type="color" name="main_color" value="{{ old('main_color', $settings['main_color'] ?? '#0d6efd') }}"
                           class="w-20 h-12 rounded-lg border-0 cursor-pointer shadow-sm">
                </div>
                <div class="flex-1">
                    <label class="block mb-2 font-medium text-gray-600">Imagen de fondo</label>
                    <input type="file" name="background_image" class="w-full border-gray-300 rounded-xl px-4 py-2">
                    @if(!empty($settings['background_image']))
                        <img src="{{ $settings['background_image'] }}" alt="Fondo" class="w-40 mt-4 rounded-lg shadow">
                    @endif
                </div>
            </div>
            <button class="bg-green-600 text-white px-8 py-3 rounded-xl hover:bg-green-700 transition-colors duration-200 font-semibold">Guardar Cambios</button>
        </form>
    </div>

    <!-- Tarjeta: Usuarios -->
    <div class="bg-white shadow-xl rounded-2xl p-8 mb-10 hover:shadow-2xl transition-shadow duration-300">
        <h2 class="text-2xl font-semibold mb-6 text-gray-700 border-b pb-2">Usuarios</h2>
        <p class="text-gray-600 mb-4">Total de usuarios registrados: <span class="font-semibold text-gray-800">{{ \App\Models\User::count() }}</span></p>
        <a href="{{ route('admin.dashboard') }}" class="inline-block bg-gray-800 text-white px-6 py-3 rounded-xl hover:bg-gray-900 transition-colors duration-200 font-semibold">Gestionar usuarios</a>
    </div>

    <!-- Tarjeta: Redes Sociales -->
    <div class="bg-white shadow-xl rounded-2xl p-8 mb-10 hover:shadow-2xl transition-shadow duration-300">
        <h2 class="text-2xl font-semibold mb-6 text-gray-700 border-b pb-2">Redes Sociales</h2>
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block mb-2 font-medium text-gray-600">Twitter</label>
                <input type="url" name="twitter" value="{{ old('twitter', $settings['twitter'] ?? '') }}"
                       class="w-full border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                       placeholder="https://twitter.com/tuusuario">
            </div>
            <div>
                <label class="block mb-2 font-medium text-gray-600">Instagram</label>
                <input type="url" name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}"
                       class="w-full border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500 shadow-sm"
                       placeholder="https://instagram.com/tuusuario">
            </div>
            <button class="bg-pink-600 text-white px-8 py-3 rounded-xl hover:bg-pink-700 transition-colors duration-200 font-semibold">Guardar Cambios</button>
        </form>
    </div>
</div>
@endsection
