<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Gestion de Usuarios', 'url' => route('admin.dashboard'), 'level' => 1],
    ]" />
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col justify-center container py-6 gap-6">

        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-center">👥 Gestión de Usuarios</h1>

            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full border border-gray-200 rounded-lg table-fixed">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border min-w-[50px] text-center">#</th>
                            <th class="px-4 py-2 border min-w-[100px] text-center">Avatar</th>
                            <th class="px-4 py-2 border min-w-[120px] text-center">Nombre</th>
                            <th class="px-4 py-2 border min-w-[120px] text-center">Email</th>
                            <th class="px-4 py-2 border min-w-[120px] text-center">Verificado</th>
                            <th class="px-4 py-2 border min-w-[120px] text-center">Nickname</th>
                            <th class="px-4 py-2 border min-w-[120px] text-center">Fecha de nacimiento</th>
                            <th class="px-4 py-2 border min-w-[120px] text-center">País</th>
                            <th class="px-4 py-2 border min-w-[120px] text-center">Favorito</th>
                            <th class="px-4 py-2 border min-w-[100px] text-center">Twitter</th>
                            <th class="px-4 py-2 border min-w-[100px] text-center">Instagram</th>
                            <th class="px-4 py-2 border min-w-[50px] text-center">Rol</th>
                            <th class="px-4 py-2 border min-w-[120px] text-center">Registro</th>
                            <th class="px-4 py-2 border min-w-[120px] text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr class="review-row hover:bg-gray-50">
                                <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                                <td class="px-4 py-2 border text-center">
                                    @if ($user->avatar_url)
                                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                                            class="h-10 w-10 rounded-full object-cover text-center">
                                    @endif
                                </td>
                                <td class="px-4 py-2 border capitalize text-center"><a href="{{ route('users.show', $user->id) }}"><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></a></td>
                                <td class="px-4 py-2 border text-center">
                                    <a href="mailto:{{ $user->email }}" class="text-indigo-600 hover:underline">
                                        {{ $user->email }}
                                    </a>
                                </td>
                                <td class="px-4 py-2 border text-center">
                                    @if ($user->email_verified_at)
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                            ✔
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                            ✖
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border capitalize text-center">{{ $user->nickname }}</td>
                                <td class="px-4 py-2 border text-center">
                                    {{ $user->fecha_nacimiento ? \Carbon\Carbon::parse($user->fecha_nacimiento)->format('d/m/Y') : ' ' }}
                                </td>
                                <td class="px-4 py-2 border text-center">{{ $user->pais }}</td>
                                <td class="px-4 py-2 border text-center">{{ $user->favorito_personaje }}</td>
                                <td class="px-4 py-2 border text-center">
                                    @if ($user->twitter)
                                        <a href="{{ $user->twitter }}" target="_blank"
                                            class="text-blue-600 hover:underline text-center">Ver Perfil</a>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border">
                                    @if ($user->instagram)
                                        <a href="{{ $user->instagram }}" target="_blank"
                                            class="text-pink-600 hover:underline text-center">Ver Perfil</a>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-center
                            {{ $user->role === 'admin' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 border text-center">{{ $user->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-2 border text-center">
                                    <div class="flex flex-col sm:flex-row justify-center gap-2">
                                        <a href="{{ route('admin.edit-user', $user->id) }}"
                                            class="bg-blue-600 text-white hover:bg-blue-900 text-sm px-2 py-1 rounded">Editar</a>
                                        <form action="{{ route('admin.delete-user', $user->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estás seguro de eliminar este usuario?')"
                                                class="bg-red-600 text-white hover:bg-red-900 text-sm px-2 py-1 rounded">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
