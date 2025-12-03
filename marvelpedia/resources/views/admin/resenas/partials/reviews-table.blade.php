<!-- resources/views/admin/resenas/partials/reviews-table.blade.php -->

<table class="min-w-full border border-gray-200 rounded-lg table-fixed">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2 border min-w-[120px]">Usuario</th>
            <th class="px-4 py-2 border min-w-[100px]">Tipo</th>
            <th class="px-4 py-2 border min-w-[180px]">Entidad</th>
            <th class="px-4 py-2 border min-w-[80px]">Puntuación</th>
            <th class="px-4 py-2 border min-w-[240px]">Contenido</th>
            <th class="px-4 py-2 border min-w-[160px]">Fecha de Creación</th>
            <th class="px-4 py-2 border min-w-[160px]">Fecha de Actualización</th>
            <th class="px-4 py-2 border min-w-[100px]">Estado</th>
            <th class="px-4 py-2 border min-w-[130px]">Reportada por</th>
            <th class="px-4 py-2 border min-w-[140px]">Cuenta atrás</th>
            <th class="px-4 py-2 border min-w-[120px]">Acciones</th>
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

                <td class="px-4 py-2 border">{{ $userReport ? 'Reportada' : 'Sin Reportar' }}</td>
                <td class="px-4 py-2 border">{{ $userReport ? $userReport->reporter->name : '-' }}</td>
                <td class="px-4 py-2 border min-h-[80px]">
                    @if ($userReport)
                        <span class="countdown block h-full items-center justify-center text-red-700 font-bold"
                            data-end="{{ $userReport->deadline->toIso8601String() }}">
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

                        <form action="{{ route('resenas.destroy', $review) }}" method="POST" class="inline">
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
                <td colspan="11" class="text-center py-4 text-gray-500">
                    No se han encontrado reseñas.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $reviews->links() }}
</div>
