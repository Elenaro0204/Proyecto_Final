<!-- resources/views/admin/mensajes/viewreport.blade.php -->

@extends('layouts.app')

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Reportes', 'url' => route('admin.manage-content'), 'level' => 1],
        ['label' => 'Detalles del Reporte', 'url' => route('admin.manage-content'), 'level' => 2]
    ]" />

    <div class="container mx-auto py-10 px-4">
        <div class="max-w-3xl mx-auto relative rounded-xl overflow-hidden shadow-xl p-6">
            <div class="absolute inset-0 bg-white opacity-50 z-0"></div>

            <div class="relative z-10 px-8 py-6">
                <div class="relative z-10 flex flex-col items-center text-center w-full">
                    <h1 class="text-3xl text-red-700 font-bold mb-3">Detalle del Reporte</h1>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($report)
                    <div class="bg-white shadow-lg rounded-xl p-6 mb-6 border border-gray-200">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                            {{-- Información del mensaje --}}
                            <div class="flex-1">
                                <h2 class="text-xl font-bold text-gray-800 mb-2">
                                    Mensaje ID: {{ $report->mensaje->id }}
                                </h2>
                                <p class="text-gray-600 capitalize mb-2">
                                    Usuario: <span
                                        class="font-semibold">{{ $report->mensaje->user->name ?? 'Usuario eliminado' }}</span>
                                </p>
                                <p class="text-gray-700 mb-3">
                                    Contenido: <span class="font-semibold">{{ $report->mensaje->contenido }}</span>
                                </p>
                                <p class="text-gray-500 text-sm">
                                    Reportado el: {{ $report->created_at->format('d/m/Y H:i') }}
                                    <span class="ml-2 text-gray-400">({{ $report->created_at->diffForHumans() }})</span>
                                </p>
                            </div>

                            {{-- Tiempo restante y acciones --}}
                            <div class="flex flex-col items-center md:items-end gap-2">
                                @php $expires = $report->deadline; @endphp

                                @if ($expires)
                                    <span class="countdown px-3 py-1 rounded-lg font-mono font-bold shadow"
                                        data-end="{{ $expires->toIso8601String() }}">
                                        Cargando...
                                    </span>
                                @else
                                    <span class="text-gray-400 font-semibold">Expirado</span>
                                @endif

                                {{-- Acciones --}}
                                <div class="flex flex-col sm:flex-row justify-between mt-4 gap-3">
                                    <a href="{{ url()->previous() }}"
                                        class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-center">
                                        Cancelar
                                    </a>
                                    <form action="{{ route('admin.mensajes.report.cancel', $report->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="redirect_to" value="{{ url()->previous() }}">
                                        <button type="submit"
                                            class="inline-block bg-yellow-400 text-red-900 shadow hover:bg-yellow-600 transition px-4 py-2 rounded">
                                            Cancelar Reporte
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 text-center">No hay reportes para este mensaje.</p>
                @endif
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

                if (endDate - now <= 0) {
                    el.textContent = "Expirado";
                    el.classList.add('bg-gray-200', 'text-gray-500', 'font-normal');
                    el.classList.remove('bg-red-100', 'text-red-600', 'font-bold');
                    return;
                }

                let years = endDate.getFullYear() - now.getFullYear();
                let months = endDate.getMonth() - now.getMonth();
                let days = endDate.getDate() - now.getDate();
                let hours = endDate.getHours() - now.getHours();
                let minutes = endDate.getMinutes() - now.getMinutes();
                let seconds = endDate.getSeconds() - now.getSeconds();

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

                const parts = [];
                if (years > 0) parts.push(
                    `<span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-lg">${years}año${years>1?'s':''}</span>`
                );
                if (months > 0) parts.push(
                    `<span class="bg-blue-200 text-blue-800 px-2 py-1 rounded-lg">${months}mes${months>1?'es':''}</span>`
                );
                if (days > 0) parts.push(
                    `<span class="bg-green-200 text-green-800 px-2 py-1 rounded-lg">${days}día${days>1?'s':''}</span>`
                );
                if (hours > 0) parts.push(
                    `<span class="bg-purple-200 text-purple-800 px-2 py-1 rounded-lg">${hours}h</span>`);
                if (minutes > 0) parts.push(
                    `<span class="bg-pink-200 text-pink-800 px-2 py-1 rounded-lg">${minutes}m</span>`);
                if (seconds >= 0) parts.push(
                    `<span class="bg-gray-200 text-gray-800 px-2 py-1 rounded-lg">${seconds}s</span>`);

                el.innerHTML = parts.join(' ');
            }

            document.querySelectorAll('.countdown').forEach(el => {
                el.classList.add('inline-block', 'px-3', 'py-1', 'rounded-lg', 'font-mono', 'font-bold',
                    'shadow', 'bg-red-100', 'text-red-600');
                updateCountdown(el);
                setInterval(() => updateCountdown(el), 1000);
            });
        });

        function goBackAndReload() {
            if (document.referrer) {
                const url = new URL(document.referrer);
                url.searchParams.set('refresh', Date.now());
                window.location.href = url.toString();
            } else {
                window.history.back();
            }
        }
    </script>
@endsection
