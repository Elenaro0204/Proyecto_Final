@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center container py-6 gap-6">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-center">📝 Gestión de Reseñas</h1>

            {{-- Buscador --}}
            <form method="GET" action="{{ route('admin.manage-content') }}" class="mb-4 flex gap-2 items-center">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar reseñas..."
                    class="border rounded p-2 w-3/4">
                <select name="type" class="border rounded p-2 w-1/4">
                    <option value="">Todos los tipos</option>
                    <option value="pelicula" {{ request('type') == 'pelicula' ? 'selected' : '' }}>Películas</option>
                    <option value="serie" {{ request('type') == 'serie' ? 'selected' : '' }}>Series</option>
                    <option value="comic" {{ request('type') == 'comic' ? 'selected' : '' }}>Cómics</option>
                </select>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Buscar</button>
            </form>

            {{-- Tabla de reseñas --}}
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg table-fixed">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border w-32">Usuario</th>
                            <th class="px-4 py-2 border w-24">Tipo</th>
                            <th class="px-4 py-2 border w-64">Entidad</th>
                            <th class="px-4 py-2 border w-20">Puntuación</th>
                            <th class="px-4 py-2 border w-96">Contenido</th>
                            <th class="px-4 py-2 border w-48">Fecha de Creación</th>
                            <th class="px-4 py-2 border w-48">Fecha de Actualización</th>
                            <th class="px-4 py-2 border">Estado</th>
                            <th class="px-4 py-2 border">Reportada por</th>
                            <th class="px-4 py-2 border">Cuenta atrás</th>
                            <th class="px-4 py-2 border w-32">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reviews as $review)
                            <tr class="review-row expired-check hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $review->user->name ?? 'Usuario eliminado' }}</td>
                                <td class="px-4 py-2 border capitalize">{{ $review->type }}</td>
                                <td class="px-4 py-2 border">{{ $review->entity_title ?? $review->entity_id }}</td>
                                <td class="px-4 py-2 border">{{ str_repeat('⭐', $review->rating) }}</td>
                                <td class="px-4 py-2 border">{{ Str::limit($review->content, 60) }}</td>
                                <td class="px-4 py-2 border">
                                    {{ $review->created_at->format('d/m/Y H:i') }}
                                    <div class="text-gray-500 text-sm">{{ $review->created_at->diffForHumans() }}</div>
                                </td>

                                <td class="px-4 py-2 border">
                                    {{ $review->updated_at->format('d/m/Y H:i') }}
                                    <div class="text-gray-500 text-sm">{{ $review->updated_at->diffForHumans() }}</div>
                                </td>

                                @php
                                    $userReport = $review->report()->where('reported_by', Auth::id())->first();
                                @endphp

                                <td class="px-4 py-2 border">
                                    {{ $userReport ? 'Reportada' : 'Sin Reportar' }}
                                </td>
                                <td class="px-4 py-2 border">
                                    {{ $userReport ? $userReport->reporter->name : '-' }}
                                </td>
                                <td class="px-4 py-2 border min-h-[80px]">
                                    @if ($userReport)
                                        <span
                                            class="countdown block h-full items-center justify-center text-red-700 font-bold"
                                            data-end="{{ $userReport->deadline->toIso8601String() }}"
                                            style="color: red; font-weight: bold;">
                                            Cargando...
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="px-4 py-2 border text-center">
                                    <div class="flex flex-col sm:flex-row justify-center gap-2">
                                        @if ($userReport)
                                            <a href="{{ route('admin.resenas.viewreport', $review) }}"
                                                class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600 text-sm">
                                                Ver reporte
                                            </a>
                                        @else
                                            <a href="{{ route('admin.resenas.addreport', $review) }}"
                                                class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-sm">
                                                Reportar
                                            </a>
                                        @endif

                                        <form action="{{ route('resenas.destroy', $review) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-sm"
                                                onclick="return confirm('¿Seguro que quieres eliminar esta reseña?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">
                                    No hay reseñas aún.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $reviews->links() }}
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-center">💬 Gestión de Foros</h1>

            {{-- Buscador --}}
            <form method="GET" action="{{ route('admin.manage-content') }}" class="mb-4 flex gap-2 items-center">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar foros..."
                    class="border rounded p-2 w-3/4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Buscar</button>
            </form>

            {{-- Tabla de foros --}}
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg table-fixed">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border w-32">Usuario</th>
                            <th class="px-4 py-2 border w-64">Título del Foro</th>
                            <th class="px-4 py-2 border w-20">Mensajes</th>
                            <th class="px-4 py-2 border w-48">Fecha de Creación</th>
                            <th class="px-4 py-2 border w-48">Fecha de Actualización</th>
                            <th class="px-4 py-2 border">Estado</th>
                            <th class="px-4 py-2 border">Reportada por</th>
                            <th class="px-4 py-2 border">Cuenta atrás</th>
                            <th class="px-4 py-2 border w-32">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($foros as $foro)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $foro->user->name ?? 'Usuario eliminado' }}</td>
                                <td class="px-4 py-2 border">{{ $foro->titulo }}</td>
                                <td class="px-4 py-2 border text-center">
                                    <span>{{ $foro->mensajes->count() }}</span>
                                    <button type="button" onclick="openModal({{ $foro->id }})"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition-colors">
                                        Ver
                                    </button>
                                </td>
                                <td class="px-4 py-2 border">
                                    {{ $foro->created_at->format('d/m/Y H:i') }}
                                    <div class="text-gray-500 text-sm">{{ $foro->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-4 py-2 border">
                                    {{ $foro->updated_at->format('d/m/Y H:i') }}
                                    <div class="text-gray-500 text-sm">{{ $foro->updated_at->diffForHumans() }}</div>
                                </td>

                                @php
                                    $userReport = $foro->report()->where('reported_by', Auth::id())->first();
                                @endphp

                                <td class="px-4 py-2 border">
                                    {{ $userReport ? 'Reportada' : 'Sin Reportar' }}
                                </td>
                                <td class="px-4 py-2 border">
                                    {{ $userReport ? $userReport->reporter->name : '-' }}
                                </td>
                                <td class="px-4 py-2 border min-h-[80px]">
                                    @if ($userReport)
                                        <span
                                            class="countdown block h-full items-center justify-center text-red-700 font-bold"
                                            data-end="{{ $userReport->deadline->toIso8601String() }}"
                                            style="color: red; font-weight: bold;">
                                            Cargando...
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="px-4 py-2 border text-center">
                                    <div class="flex flex-col sm:flex-row justify-center gap-2">
                                        @if ($userReport)
                                            <a href="{{ route('admin.foros.viewreport', $foro) }}"
                                                class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600 text-sm">
                                                Ver reporte
                                            </a>
                                        @else
                                            <a href="{{ route('admin.foros.addreport', $foro) }}"
                                                class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-sm">
                                                Reportar
                                            </a>
                                        @endif

                                        <form action="{{ route('foros.destroy', $foro) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-sm"
                                                onclick="return confirm('¿Seguro que quieres eliminar este foro?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">
                                    No hay foros aún.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $foros->links() }}
            </div>
        </div>
    </div>

    <div id="modal-mensajes" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-3xl max-h-[80vh] overflow-y-auto shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-center">💬 Mensajes del Foro</h2>
            <div id="mensajes-container" class="space-y-4">
                {{-- Los mensajes se inyectarán aquí desde JS --}}
            </div>
            <div id="mensajes-pagination" class="flex justify-center mt-4"></div>
            <div class="text-center mt-6">
                <button onclick="closeModal()"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded font-semibold transition-colors">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function updateCountdown(el) {
                const endDate = new Date(el.dataset.end);
                const now = new Date();

                if (isNaN(endDate.getTime())) {
                    el.textContent = "Fecha inválida";
                    return;
                }

                let diffMs = endDate - now;

                // 🚨 SI SE HA CUMPLIDO EL PLAZO → MENSAJE DE ELIMINACIÓN
                if (diffMs <= 0) {
                    el.innerHTML = `
                        <span class="bg-red-200 text-red-800 px-2 py-1 rounded block text-center">
                            Se ha cumplido el tiempo
                        </span>
                    `;

                    // ❗ MARCAR LA FILA EN ROJO ❗
                    const row = el.closest(".review-row");
                    if (row) {
                        row.classList.add("bg-red-200", "border-red-500");
                        row.classList.remove("hover:bg-gray-50");
                    }

                    return;
                }

                if (diffMs <= 0) {
                    el.textContent = "Finalizado";
                    return;
                }

                // Calcular cada unidad
                let years = endDate.getFullYear() - now.getFullYear();
                let months = endDate.getMonth() - now.getMonth();
                let days = endDate.getDate() - now.getDate();
                let hours = endDate.getHours() - now.getHours();
                let minutes = endDate.getMinutes() - now.getMinutes();
                let seconds = endDate.getSeconds() - now.getSeconds();

                // Correcciones negativas
                if (seconds < 0) {
                    seconds += 60;
                    minutes--;
                }
                if (minutes < 0) {
                    minutes += 60;
                    hours--;
                }
                if (hours < 0) {
                    hours += 24;
                    days--;
                }
                if (days < 0) {
                    const prevMonthDays = new Date(endDate.getFullYear(), endDate.getMonth(), 0).getDate();
                    days += prevMonthDays;
                    months--;
                }
                if (months < 0) {
                    months += 12;
                    years--;
                }

                // Construir texto dinámico
                let parts = [];
                if (years > 0) parts.push(`${years}año${years>1?'s':''}`);
                if (months > 0) parts.push(`${months}mes${months>1?'es':''}`);
                if (days > 0) parts.push(`${days}día${days>1?'s':''}`);
                if (hours > 0) parts.push(`${hours}h`);
                if (minutes > 0) parts.push(`${minutes}m`);
                if (seconds >= 0) parts.push(`${seconds}s`);

                el.textContent = parts.join(':');
            }

            // Inicializar todos los countdowns
            document.querySelectorAll('.countdown').forEach(el => {
                updateCountdown(el);
                setInterval(() => updateCountdown(el), 1000);
            });
        });

        function openModal(foroId, page = 1, perPage = 5) {
            const container = document.getElementById('mensajes-container');
            container.innerHTML = "Cargando...";

            fetch(`/admin/foros/${foroId}/mensajes?page=${page}&perPage=${perPage}`)
                .then(res => res.json())
                .then(data => {
                    container.innerHTML = '';

                    if (!data.mensajes.length) {
                        container.innerHTML = '<p class="text-gray-500">No hay mensajes.</p>';
                        return;
                    }

                    data.mensajes.forEach(msg => {
                        const msgDiv = document.createElement('div');
                        msgDiv.className = `border p-4 rounded-lg shadow-sm transition mb-3 ${
                    msg.reportado ? 'bg-red-50 hover:bg-red-100' : 'bg-gray-50 hover:bg-gray-100'
                }`;

                        // Contador si está reportado
                        const countdownHtml = (msg.reportado && msg.deadline) ? `
                    <span class="countdown block h-full px-2 py-1 rounded shadow bg-red-100 text-red-600 font-bold"
                        data-end="${msg.deadline}">
                        Cargando...
                    </span>` : '';

                        // Botones según estado
                        const botonesReport = msg.reportado ? `
                    <a href="/admin/mensaje/${msg.id}/report/view"
                        class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600 text-sm">
                        Ver reporte
                    </a>` : `
                    <a href="/admin/mensaje/${msg.id}/report"
                        class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-sm">
                        Reportar
                    </a>`;

                        msgDiv.innerHTML = `
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold text-blue-600">${msg.usuario}</span>
                        <span class="text-gray-500 text-sm">${msg.fecha}</span>
                    </div>
                    <p class="text-gray-700 mb-2">${msg.contenido}</p>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2">
                        ${botonesReport}
                        ${countdownHtml}
                    </div>
                `;

                        container.appendChild(msgDiv);
                    });

                    // Inicializar contadores automáticamente
                    document.querySelectorAll('.countdown').forEach(el => {
                        if (!el.dataset.initialized) {
                            el.dataset.initialized = true;
                            updateCountdown(el);
                            setInterval(() => updateCountdown(el), 1000);
                        }
                    });

                    // Paginación simple
                    const pagination = document.getElementById('mensajes-pagination');
                    pagination.innerHTML = '';
                    for (let i = 1; i <= data.totalPages; i++) {
                        const btn = document.createElement('button');
                        btn.textContent = i;
                        btn.className =
                            `px-3 py-1 rounded ${i === page ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'} mr-1`;
                        btn.onclick = () => openModal(foroId, i, perPage);
                        pagination.appendChild(btn);
                    }
                })
                .catch(() => container.innerHTML = '<p class="text-red-500">Error al cargar los mensajes.</p>');

            document.getElementById('modal-mensajes').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal-mensajes').classList.add('hidden');
        }
    </script>
@endsection

@section('styles')
    <style>
        .countdown {
            display: inline-block;
            transition: opacity 0.3s ease;
        }

        .countdown.fade {
            opacity: 0.1;
        }

        tr.expired-row {
            background-color: #ff9999 !important;
            border: 2px solid #ff0000 !important;
            color: #000 !important;
        }

        tr.expired-row:hover {
            background-color: #ff9999 !important;
        }
    </style>
@endsection
