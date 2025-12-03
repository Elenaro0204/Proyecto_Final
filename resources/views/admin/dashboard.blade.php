<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Usuarios registrados</h1>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avatar</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nickname</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de nacimiento</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">País</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Twitter</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instagram</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registro</th>
                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $index => $user)
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        @if($user->avatar_url)
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="h-10 w-10 rounded-full object-cover">
                        @else
                            <span class="text-gray-400">Sin avatar</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $user->name }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $user->email }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $user->nickname ?? '-' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        {{ $user->fecha_nacimiento ? \Carbon\Carbon::parse($user->fecha_nacimiento)->format('d/m/Y') : '-' }}
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $user->pais ?? '-' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        @if($user->twitter)
                            <a href="{{ $user->twitter }}" target="_blank" class="text-blue-600 hover:underline">Twitter</a>
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        @if($user->instagram)
                            <a href="{{ $user->instagram }}" target="_blank" class="text-pink-600 hover:underline">Instagram</a>
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $user->role === 'admin' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-center">
                        <a href="{{ route('admin.edit-user', $user->id) }}"
                           class="text-blue-600 hover:text-blue-900 font-medium mr-2">Editar</a>
                        <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('¿Estás seguro de eliminar este usuario?')"
                                class="text-red-600 hover:text-red-900 font-medium">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
