<!-- resources/views/admin/edit-user.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10 px-4">
        <div class="max-w-3xl mx-auto relative rounded-xl overflow-hidden shadow-xl p-6">
            <div class="absolute inset-0 bg-white opacity-50 z-0"></div>

            <div class="relative z-10 px-8 py-6">
                <div class="relative z-10 flex flex-col items-center text-center w-full">
                    <h2 class="text-2xl text-red-700 font-bold mb-3">Editar Usuario</h1>
                </div>

                <form action="{{ route('admin.update-user', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="bg-red-200 text-red-800 p-4 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="avatar_url" class="block text-gray-700 font-medium mb-1">Foto de perfil</label>
                        @if ($user->avatar_url)
                            <div class="mb-2">
                                <img src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : asset('images/default-avatar.jpeg') }}"
                                    alt="Avatar" class="w-24 h-24 rounded-full object-cover">
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
                        <label for="fecha_nacimiento" class="block text-gray-700 font-medium mb-1">Fecha de
                            nacimiento</label>
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
                        <input type="url" name="instagram" id="instagram"
                            value="{{ old('instagram', $user->instagram) }}"
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

                    <div class="flex flex-col sm:flex-row justify-between mt-4 gap-3">
                        <a href="{{ url()->previous() }}" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-center">
                            Cancelar
                        </a>

                        <button type="submit"
                            class="inline-block bg-yellow-400 text-red-900 shadow hover:bg-yellow-600 transition px-4 py-2 rounded">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
