<!-- resources/views/foros/partials/foro-list.blade.php -->

<div id="foros-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($foros as $foro)
        @include('foros.partials.foro-card', ['foro' => $foro])
    @empty
        <div class="col-span-full text-center text-gray-500 text-lg py-10">
            No hay foros con esas características disponibles.
        </div>
    @endforelse
</div>
