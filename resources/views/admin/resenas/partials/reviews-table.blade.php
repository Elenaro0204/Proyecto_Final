<!-- resources/views/admin/resenas/partials/reviews-table.blade.php -->

<table class="min-w-full border border-gray-200 rounded-lg table-fixed">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2 border min-w-[120px] text-center">Usuario</th>
            <th class="px-4 py-2 border min-w-[100px] text-center">Tipo</th>
            <th class="px-4 py-2 border min-w-[180px] text-center">Entidad</th>
            <th class="px-4 py-2 border min-w-[80px] text-center">Puntuación</th>
            <th class="px-4 py-2 border min-w-[240px] text-center">Contenido</th>
            <th class="px-4 py-2 border min-w-[160px] text-center">Fecha de Creación</th>
            <th class="px-4 py-2 border min-w-[160px] text-center">Fecha de Actualización</th>
            <th class="px-4 py-2 border min-w-[130px] text-center">Reportada por</th>
            <th class="px-4 py-2 border min-w-[140px] text-center">Cuenta atrás</th>
            <th class="px-4 py-2 border min-w-[120px] text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($reviews as $review)
            @php
                $userReport = $review->report()->where('reported_by', Auth::id())->first();
                $isActiveCountdown = $userReport && now()->lt($userReport->deadline);
            @endphp
            <tr
                class="review-row hover:bg-gray-50 @if ($isActiveCountdown) bg-yellow-200 border-l-4 border-yellow-500 @endif @if ($userReport) bg-red-200 border-l-4 border-red-500 @endif">
                <td class="px-4 py-2 border text-center"><a href="{{ route('users.show', $review->user->id) }}">{{ $review->user->name ?? 'Usuario eliminado' }}</a></td>
                <td class="px-4 py-2 border capitalize text-center">{{ $review->type }}</td>
                <td class="px-4 py-2 border text-center">{{ $review->entity_title ?? $review->entity_id }}</td>
                <td class="px-4 py-2 border text-center">{{ str_repeat('⭐', $review->rating) }}</td>
                <td class="px-4 py-2 border text-center relative group">

                    <div class="truncate max-w-[150px]">
                        {{ $review->content }}
                    </div>

                    @php
                        $isLastRow = $loop->last;
                    @endphp

                    @if ($isLastRow)
                        {{-- Tooltip hacia arriba --}}
                        <div
                            class="absolute hidden group-hover:block bg-gray-100 text-sm p-3 rounded shadow-lg z-50 w-max max-w-[300px] left-1/2 -translate-x-1/2 bottom-full mb-1 whitespace-normal pointer-events-none">
                            {{ $review->content }}
                        </div>
                    @else
                        {{-- Tooltip hacia abajo --}}
                        <div
                            class="absolute hidden group-hover:block bg-gray-100 text-sm p-3 rounded shadow-lg z-50 w-max max-w-[300px]
                    left-1/2 -translate-x-1/2 top-full mt-1 whitespace-normal pointer-events-none">
                            {{ $review->content }}
                        </div>
                    @endif
                </td>
                <td class="px-4 py-2 border text-center">
                    {{ $review->created_at->format('d/m/Y H:i') }}
                    <div class="text-gray-500 text-sm">{{ $review->created_at->diffForHumans() }}</div>
                </td>
                <td class="px-4 py-2 border text-center">
                    {{ $review->updated_at->format('d/m/Y H:i') }}
                    <div class="text-gray-500 text-sm">{{ $review->updated_at->diffForHumans() }}</div>
                </td>
                <td class="px-4 py-2 border text-center">{{ $userReport ? $userReport->reporter->name : ' ' }}</td>
                <td class="px-4 py-2 border min-h-[80px] text-center">
                    @if ($userReport)
                        <span class="countdown block h-full items-center justify-center text-red-700 font-bold"
                            data-end="{{ $userReport->deadline->toIso8601String() }}">
                            Cargando...
                        </span>
                    @else
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
