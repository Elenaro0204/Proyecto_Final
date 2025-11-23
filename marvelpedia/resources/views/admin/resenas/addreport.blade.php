@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 max-w-lg bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Reportar Reseña</h2>

    <form action="{{ route('admin.resenas.report.store', $review) }}" method="POST" class="space-y-4">
        @csrf

        {{-- Campo autogenerado: ID de la reseña --}}
        <div>
            <label class="block font-medium">ID de la reseña</label>
            <input type="text" class="border p-2 w-full bg-gray-100" value="{{ $review->id }}" disabled>
            <input type="hidden" name="review_id" value="{{ $review->id }}">
        </div>

        {{-- Campo autogenerado: Usuario que reporta --}}
        <div>
            <label class="block font-medium">Reportado por (ID usuario)</label>
            <input type="text" class="border p-2 w-full bg-gray-100" value="{{ Auth::id() }}" disabled>
            <input type="hidden" name="reported_by" value="{{ Auth::id() }}">
        </div>

        {{-- Campo autogenerado: Fecha actual --}}
        <div>
            <label class="block font-medium">Fecha de creación</label>
            <input type="text" class="border p-2 w-full bg-gray-100" value="{{ now() }}" disabled>
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

            <input type="date" id="deadline" name="deadline" class="border p-2 w-full" min="{{ date('Y-m-d') }}" required>
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
            Enviar reporte
        </button>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
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
@endsection
