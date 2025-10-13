@props([
    'title' => '',
    'subtitle' => '',
    'cards' => [],
    'carouselId' => 'defaultCarousel'
])


<section class="my-5 text-center">
    @if(!empty($title) || !empty($subtitle))
        <div class="mb-4">
            @if(!empty($title))
                <h2 class="display-5 fw-bold font-bangers">{{ $title }}</h2>
            @endif
            @if(!empty($subtitle))
                <p class="lead text-muted font-marvel">{{ $subtitle }}</p>
            @endif
        </div>
    @endif

    <div id="{{ $carouselId }}" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators position-absolute bottom-0 start-50 translate-middle-x m-2">
            @foreach($cards as $index => $card)
                <button type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}"
                        aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $index + 1 }}">
                </button>
            @endforeach
        </div>

        <div class="carousel-inner py-4">
            @foreach(array_chunk($cards, 3) as $chunkIndex => $chunk)
                <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                    <div class="d-flex justify-content-center flex-wrap gap-4">
                        @foreach($chunk as $card)
                            <div class="card text-white border-2 border-red-700 flex flex-col justify-between"
                                style="width: 18rem; min-height: 400px; background-color: rgba(0,0,0,0.7);">
                                <!-- Imagen arriba -->
                                <img src="{{ $card['image'] }}" class="card-img-top" alt="{{ $card['title'] }}" style="height: 180px; object-fit: cover;">

                                <!-- Contenido centrado -->
                                <div class="card-body flex flex-col justify-center text-center">
                                    <h5 class="card-title font-bangers mb-2">{{ $card['title'] }}</h5>
                                    <p class="card-text font-roboto mb-3">{{ $card['text'] }}</p>
                                </div>

                                <!-- Botón abajo -->
                                <div class="card-footer text-center bg-transparent border-0 mb-2">
                                    <a href="{{ $card['link'] }}" class="btn bg-red-500 text-white rounded-md hover:bg-red-600 font-marvel">
                                        Ver más
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<style>
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: #c8102e;
    border-radius: 50%;
}

.carousel-indicators [data-bs-target] {
    background-color: #c8102e;
}

.carousel-indicators .active {
    background-color: #FFD500;
}

/* Ajustes para placeholder (si se usan) */
.placeholder {
    display: inline-block;
    background-color: #e0e0e0;
    border-radius: 0.25rem;
}

.placeholder-glow .placeholder {
    animation: placeholder-glow 1.5s infinite;
}

@keyframes placeholder-glow {
    0% { opacity: 0.5; }
    50% { opacity: 1; }
    100% { opacity: 0.5; }
}
</style>
