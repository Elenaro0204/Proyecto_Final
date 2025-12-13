<!-- resources/views/foros/partials/foro-list.blade.php -->

@forelse ($foros as $foro)
    @include('foros.partials.foro-card', ['foro' => $foro])
@empty
    <div class="col-span-full text-center text-gray-500 text-lg py-10">
        No hay foros con esas características disponibles.
    </div>
@endforelse
