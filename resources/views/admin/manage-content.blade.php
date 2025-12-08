<!-- resources/views/admin/manage-content.blade.php -->

@extends('layouts.app')

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Gestion de Contenido', 'url' => route('admin.manage-content'), 'level' => 1],
    ]" />

    <div class="flex flex-col justify-center container py-6 gap-6">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-center">📝 Gestión de Reseñas</h1>

            {{-- Buscador --}}
            <form id="reviews-filter-form" method="GET" action="{{ route('admin.manage-content') }}"
                class="mb-4 flex flex-col sm:flex-row gap-2 items-stretch sm:items-center">

                <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar reseñas..."
                    class="border rounded p-2 w-full sm:w-1/2">

                <select name="type" class="border rounded p-2 w-full sm:w-1/4">
                    <option value="">Todos los tipos</option>
                    <option value="pelicula" {{ request('type') == 'pelicula' ? 'selected' : '' }}>Películas</option>
                    <option value="serie" {{ request('type') == 'serie' ? 'selected' : '' }}>Series</option>
                </select>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full sm:w-auto">
                    Buscar
                </button>
            </form>

            {{-- Tabla de reseñas --}}
            <div id="reviews-container" class="overflow-x-auto rounded-lg shadow">
                @include('admin.resenas.partials.reviews-table', ['reviews' => $reviews])
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-center">💬 Gestión de Foros</h1>

            {{-- Buscador --}}
            <form method="GET" action="{{ route('admin.manage-content') }}"
                class="mb-4 flex flex-col sm:flex-row gap-2 items-stretch sm:items-center" id="form-buscar-foros">
                <input type="text" name="q_foros" id="q_foros" value="{{ request('q_foros') }}"
                    placeholder="Buscar foros..." class="border rounded p-2 w-full">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full sm:w-auto">Buscar</button>
            </form>

            {{-- Tabla de foros --}}
            <div id="foros-table-container" class="overflow-x-auto rounded-lg shadow">
                @include('admin.foros.partials.foros-table', ['foros' => $foros])
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

    @push('scripts')
        <script>
            // Función para actualizar los contadores regresivos
            function updateCountdown(el) {
                const endDate = new Date(el.dataset.end);
                const now = new Date();

                if (isNaN(endDate.getTime())) {
                    el.textContent = "Fecha inválida";
                    return;
                }

                let diffMs = endDate - now;

                // Elimina el hover
                const row = el.closest(".review-row");
                if (row) {
                    row.classList.remove("hover:bg-gray-50");
                }

                // 🚨 SI SE HA CUMPLIDO EL PLAZO → MENSAJE DE ELIMINACIÓN
                if (diffMs <= 0) {
                    el.innerHTML = `
                        <span class="bg-red-200 text-red-800 px-2 py-1 rounded block text-center">
                            Agotado
                        </span>
                    `;

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

            document.addEventListener("DOMContentLoaded", function() {
                // Inicializar todos los countdowns
                document.querySelectorAll('.countdown').forEach(el => {
                    updateCountdown(el);
                    setInterval(() => updateCountdown(el), 1000);
                });
            });

            // Filtrado dinámico de reseñas
            document.addEventListener('DOMContentLoaded', () => {
                const form = document.querySelector('#reviews-filter-form');
                const container = document.querySelector('#reviews-container');
                const filterText = document.querySelector('#reviews-filter-text');

                const fetchReviews = () => {
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
                            if (formData.get('q')) text += `Buscando por: ${formData.get('q')}`;
                            if (formData.get('type')) text +=
                                `${text ? ' | ' : ''}Tipo: ${formData.get('type')}`;
                            filterText.innerHTML = text || '';
                        });
                };

                form.querySelectorAll('input, select').forEach(input => {
                    input.addEventListener('input', fetchReviews);
                    input.addEventListener('change', fetchReviews);
                });
            });

            // Filtrado dinámico de foros
            document.addEventListener('DOMContentLoaded', function() {
                const searchForosInput = document.querySelector('input[name="q_foros"]');
                searchForosInput.addEventListener('keyup', function(e) {
                    const query = e.target.value;
                    fetch(`{{ route('admin.manage-content') }}?q_foros=${query}&type_ajax=foros`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            document.querySelector('#foros-table-container').innerHTML = html;
                        });
                });
            });

            // Funciones para abrir y cerrar el modal de mensajes
            function openModal(foroId, page = 1, perPage = 5) {
                const container = document.getElementById('mensajes-container');
                container.innerHTML = "Cargando...";
                window.currentForoId = foroId;
                window.currentPage = page;
                window.currentPerPage = perPage;

                fetch(`/admin/foros/${foroId}/mensajes?page=${page}&perPage=${perPage}`)
                    .then(res => res.json())
                    .then(data => {
                        container.innerHTML = '';

                        if (!data.mensajes.length) {
                            container.innerHTML = '<p class="text-gray-500">No hay mensajes.</p>';
                            return;
                        }

                        data.mensajes.forEach(msg => {
                            let fechaDeadline = msg.deadline ? msg.deadline.toString().replace(' ', 'T') : null;
                            const ahora = new Date();

                            let estaReportado = msg.reportado;
                            let deadlineDate = fechaDeadline ? new Date(fechaDeadline) : null;
                            let cuentaActiva = estaReportado && deadlineDate && ahora < deadlineDate;
                            let cuentaFinalizada = estaReportado && deadlineDate && ahora >= deadlineDate;

                            let clasesColor = "bg-gray-50 hover:bg-gray-100"; // Normal

                            if (cuentaActiva) {
                                clasesColor = "bg-yellow-200 border-l-4 border-yellow-500";
                            } else if (estaReportado) {
                                clasesColor = "bg-red-200 border-l-4 border-red-500";
                            }

                            const msgDiv = document.createElement('div');
                            msgDiv.className = `border p-4 rounded-lg shadow-sm transition mb-3 ${clasesColor}`;

                            // Contador si está reportado
                            const countdownHtml = (msg.reportado) ? `
                    <span class="countdown block h-full items-center justify-center text-red-700 font-bold"
                        data-end="${fechaDeadline}">
                        Cargando...
                    </span>` : '';

                            let advertencia = "";

                            if (msg.respuestas_count > 0) {
                                advertencia = `
                                    <div class="bg-yellow-300 text-yellow-900 p-2 rounded mb-2">
                                        ⚠️ Este mensaje tiene ${msg.respuestas_count} respuesta(s).
                                        Si lo eliminas, también se eliminarán.
                                    </div>
                                `;
                            }

                            // Boton de Eliminar
                            const botonEliminar = `
                    <button type='button' onclick="eliminarMensaje(${msg.id}, ${msg.respuestas_count})"
                        class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-sm">
                        Eliminar
                    </button>`;

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
                            ${advertencia}
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold text-blue-600">${msg.usuario}</span>
                        <span class="text-gray-500 text-sm">${msg.fecha}</span>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-gray-700 mb-2">${msg.contenido}</p>
                        ${countdownHtml}
                    </div>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2">
                        ${botonesReport}
                        ${botonEliminar}
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

            function eliminarMensaje(id, respuestas_count = 0) {
                let mensaje = "¿Seguro que quieres eliminar este mensaje?";

                if (respuestas_count > 0) {
                    mensaje =
                        `⚠️ Este mensaje tiene ${respuestas_count} respuesta(s). Si lo eliminas, también se eliminarán sus respuestas.`;
                }

                if (!confirm(mensaje)) return;

                fetch(`/mensajes/${id}/eliminar`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                            "Accept": "application/json"
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw new Error();
                        alert("Mensaje eliminado correctamente");
                        location.reload();
                    })
                    .catch(() => alert("Error al eliminar el mensaje"));
            }
        </script>
    @endpush

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
