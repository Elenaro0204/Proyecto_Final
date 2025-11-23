@props([
    'title' => '',
    'subtitle' => '',
    'cards' => [],
    'carouselId' => 'defaultCarousel',
])

@php
    // Convertimos a array si es Collection
    $cardsArray = $cards instanceof \Illuminate\Support\Collection ? $cards->toArray() : $cards;
@endphp

<section class="my-5 text-center">
    @if (!empty($title) || !empty($subtitle))
        <div class="mb-4">
            @if (!empty($title))
                <h2 class="display-5 fw-bold font-bangers">{{ $title }}</h2>
            @endif
            @if (!empty($subtitle))
                <p class="lead text-muted font-marvel">{{ $subtitle }}</p>
            @endif
        </div>
    @endif

    @if (count($cardsArray) > 0)
        <div id="{{ $carouselId }}" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators position-absolute bottom-0 start-50 translate-middle-x m-2">
                @foreach ($cardsArray as $index => $card)
                    <button type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $index + 1 }}">
                    </button>
                @endforeach
            </div>

            <div class="carousel-inner py-4">
                @foreach (array_chunk($cardsArray, 3) as $chunkIndex => $chunk)
                    <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                        <div class="d-flex justify-content-center flex-wrap gap-4">
                            @foreach ($chunk as $card)
                                <div class="card text-white border-2 border-red-700 flex flex-col justify-between"
                                    style="width: 18rem; min-height: 400px; background-color:  {{ $card['color_fondo'] ?? 'rgba(0,0,0,0.7)' }}">

                                    {{-- Imagen opcional (foros pueden no tener) --}}
                                    @if (isset($card['image']))
                                        <img src="{{ $card['image'] }}" class="card-img-top"
                                            alt="{{ $card['title'] }}" style="height: 180px; object-fit: cover;">
                                    @endif

                                    <div class="card-body flex flex-col justify-center text-center">
                                        <h5
                                            class="card-title font-bangers mb-2 color:{{ $card['color_titulo'] ?? '#fff' }} border-color: {{ $card['color_titulo'] ?? '#ff0000' }}">
                                            {{ $card['title'] }}</h5>
                                        {{-- Texto opcional (foros pueden no tener) --}}
                                        @if (isset($card['text']))
                                            <p class="card-text font-roboto mb-3">{{ $card['text'] }}</p>
                                        @endif
                                    </div>

                                    <div class="card-footer text-center bg-transparent border-0 mb-2">
                                        <a href="{{ $card['link'] }}"
                                            class="btn bg-red-500 text-white rounded-md hover:bg-red-600 font-marvel">
                                            Ver más
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @else
        <p class="text-gray-500 italic mt-4">No hay elementos para mostrar en este momento.</p>
    @endif
</section>
