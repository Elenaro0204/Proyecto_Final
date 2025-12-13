<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Gestion de Usuarios', 'url' => route('admin.dashboard'), 'level' => 1],
    ]" />

    <div class="flex flex-col justify-center container py-6 gap-6">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="relative shadow rounded-lg p-6 overflow-hidden">
            <div class="absolute inset-0 bg-white opacity-50 z-0"></div>

            <div class="relative z-10 flex flex-col items-center text-center w-full">
                <h1 class="text-3xl text-red-700 font-bold mb-3 uppercase">Gestión de Usuarios</h1>
            </div>

            {{-- Buscador --}}
            <form id="users-filter-form" method="GET" action="{{ route('admin.dashboard') }}"
                class="relative z-10 mb-4 flex flex-col sm:flex-row gap-2 items-stretch sm:items-center">

                <input type="text" name="q" value="{{ request('q') }}" placeholder="🔍 Buscar usuario..."
                    class="border rounded p-2 w-full">

                <select name="role" class="border rounded p-2 w-full sm:w-1/4">
                    <option value="">Todos los Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Usuario</option>
                </select>

                <select name="verified" class="border rounded p-2 w-full sm:w-1/4">
                    <option value="">Todos los Verificados</option>
                    <option value="1" {{ request('verified') === '1' ? 'selected' : '' }}>Verificados</option>
                    <option value="0" {{ request('verified') === '0' ? 'selected' : '' }}>No verificados</option>
                </select>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full sm:w-auto">
                    Buscar
                </button>
            </form>

            <div id="users-container" class="relative z-10 overflow-x-auto rounded-lg shadow bg-white">
                @include('admin.users.partials.users-table', ['users' => $users])
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Filtrado dinámico de usuarios
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('#users-filter-form'); // CAMBIA ESTE ID
            const container = document.querySelector('#users-container'); // CAMBIA ESTE ID
            const filterText = document.querySelector('#users-filter-text'); // CAMBIA ESTE ID

            const fetchUsers = () => {
                const formData = new FormData(form);
                const params = new URLSearchParams(formData).toString();

                fetch(`${form.action}?${params}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        container.innerHTML = html;

                        // Actualizar texto de filtros
                        let text = '';
                        if (formData.get('q')) text += `Buscando: ${formData.get('q')}`;
                        if (formData.get('type')) text +=
                            `${text ? ' | ' : ''}Rol: ${formData.get('type')}`;
                        filterText.innerHTML = text || '';
                    });
            };

            form.querySelectorAll('input, select').forEach(input => {
                input.addEventListener('input', fetchUsers);
                input.addEventListener('change', fetchUsers);
            });
        });
    </script>
@endpush
