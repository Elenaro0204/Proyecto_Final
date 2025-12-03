<!-- resources/views/admin/edit-user.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-50">
        <div class="w-full max-w-3xl bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-center">✏️ Editar Usuario</h1>

            <form action="{{ route('admin.update-user', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="avatar_url" class="block text-gray-700 font-medium mb-1">Foto de perfil</label>
                    @if ($user->avatar_url)
                        <div class="mb-2">
                            <img src="{{ $user->avatar_url }}" alt="Avatar" class="w-24 h-24 rounded-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="avatar" id="avatar"
                        class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-1">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                        class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="nickname" class="block text-gray-700 font-medium mb-1">Apodo</label>
                    <input type="text" name="nickname" id="nickname" value="{{ old('nickname', $user->nickname) }}"
                        class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="fecha_nacimiento" class="block text-gray-700 font-medium mb-1">Fecha de nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                        value="{{ old('fecha_nacimiento', $user->fecha_nacimiento) }}" max="{{ date('Y-m-d') }}"
                        class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="pais" class="block text-gray-700 font-medium mb-1">País</label>
                    @include('components.pais')
                </div>

                <div class="mb-4">
                    <label for="twitter" class="block text-gray-700 font-medium mb-1">Twitter</label>
                    <input type="url" name="twitter" id="twitter" value="{{ old('twitter', $user->twitter) }}"
                        class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="instagram" class="block text-gray-700 font-medium mb-1">Instagram</label>
                    <input type="url" name="instagram" id="instagram" value="{{ old('instagram', $user->instagram) }}"
                        class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-gray-700 font-medium mb-1">Rol</label>
                    <select name="role" id="role"
                        class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Usuario</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>

                <div class="flex justify-between mt-4">
                    <a href="{{ url()->previous() }}" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">
                        Cancelar
                    </a>

                    <button type="submit"
                        class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
