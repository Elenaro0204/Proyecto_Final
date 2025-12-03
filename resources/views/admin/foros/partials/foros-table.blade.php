 <!-- resources/views/admin/foros/partials/foros-table.blade.php -->

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
                         <span class="countdown block h-full items-center justify-center text-red-700 font-bold"
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

                         <form action="{{ route('foros.destroy', $foro) }}" method="POST" class="inline">
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
