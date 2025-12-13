<!-- resources/admin/foros/addreport.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10 px-4">
        <div class="max-w-3xl mx-auto relative rounded-xl overflow-hidden shadow-xl p-6">
            <div class="absolute inset-0 bg-white opacity-50 z-0"></div>

            <div class="relative z-10 px-8 py-6">
                <div class="relative z-10 flex flex-col items-center text-center w-full">
                    <h2 class="text-2xl text-red-700 font-bold mb-3 uppercase">Reportar Foro</h2>

                    <form action="{{ route('admin.foros.report.store', $foro) }}" method="POST" class="space-y-3">
                        @csrf

                        @if ($errors->any())
                            <div class="bg-red-200 text-red-800 p-4 rounded">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>- {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <input type="hidden" name="redirect_to" value="{{ url()->previous() }}">

                        {{-- Campo autogenerado: ID del foro --}}
                        <div>
                            <label class="block font-medium">ID del foro</label>
                            <input type="text" class="border p-2 w-full bg-gray-100" value="{{ $foro->id }}"
                                disabled>
                            <input type="hidden" name="foro_id" value="{{ $foro->id }}">
                        </div>

                        {{-- Campo autogenerado: Usuario que reporta --}}
                        <div>
                            <label class="block font-medium">Reportado por (ID usuario)</label>
                            <input type="text" class="border p-2 w-full bg-gray-100" value="{{ Auth::id() }}"
                                disabled>
                            <input type="hidden" name="reported_by" value="{{ Auth::id() }}">
                        </div>

                        {{-- Campo autogenerado: Fecha actual --}}
                        <div>
                            <label class="block font-medium">Fecha de creación</label>
                            <input type="text" class="border p-2 w-full bg-gray-100" value="{{ now() }}"
                                disabled>
                        </div>

                        <div>
                            <label class="block font-medium">¿Está resuelto?</label>
                            <select name="resolved" class="border p-2 w-full">
                                <option value="0">No</option>
                                <option value="1">Sí</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium">Fecha límite</label>

                            <select id="preset-deadline" class="border p-2 w-full mb-2">
                                <option value="">Seleccione una opción rápida</option>
                                <option value="1">Mañana (+1 día)</option>
                                <option value="3">En 3 días</option>
                                <option value="7">En 1 semana</option>
                                <option value="30">En 1 mes</option>
                                <option value="365">En 1 año</option>
                            </select>

                            <input type="date" id="deadline" name="deadline" class="border p-2 w-full"
                                min="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-between mt-4 gap-3">
                            <a href="{{ url()->previous() }}"
                                class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-center">
                                Cancelar
                            </a>

                            <button type="submit"
                                class="px-4 py-2 bg-yellow-400 text-red-800 font-semibold rounded-lg hover:bg-yellow-500 transition">
                                Enviar reporte
                            </button>
                        </div>
                    </form>
                </div>
            @endsection

            @section('scripts')
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const preset = document.getElementById('preset-deadline');
                        const deadline = document.getElementById('deadline');

                        preset.addEventListener('change', function() {
                            const days = parseInt(this.value);

                            if (!days) {
                                deadline.value = "";
                                return;
                            }

                            let today = new Date();
                            today.setDate(today.getDate() + days);

                            const formatted = today.toISOString().split('T')[0];
                            deadline.value = formatted;
                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
