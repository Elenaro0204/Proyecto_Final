{{-- resources/views/resenas/partials/cards.blade.php --}}
@forelse ($reviews as $review)
    <x-review-card :review="$review" />
@empty
    <p class="text-center text-gray-500 italic col-span-full">
        No hay reseñas que coincidan con los filtros.
    </p>
@endforelse
