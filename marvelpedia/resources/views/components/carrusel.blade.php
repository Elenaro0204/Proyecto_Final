<section class="my-5 text-center">
    @if(!empty($title) || !empty($subtitle))
        <div class="mb-4">
            @if(!empty($title))
                <h2 class="display-5 fw-bold">{{ $title }}</h2>
            @endif
            @if(!empty($subtitle))
                <p class="lead text-muted">{{ $subtitle }}</p>
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
            {{-- Placeholder: se mostrará mientras se cargan las cards --}}
            @if(empty($cards))
                <div class="carousel-item active">
                    <div class="d-flex justify-content-center flex-wrap">
                        @for($i=0; $i<3; $i++)
                            <div class="card mx-2" style="width: 18rem;" aria-hidden="true">
                                <div class="placeholder-glow">
                                    <div class="card-img-top placeholder col-12" style="height:180px;"></div>
                                    <div class="card-body">
                                        <h5 class="card-title placeholder-glow">
                                            <span class="placeholder col-6"></span>
                                        </h5>
                                        <p class="card-text placeholder-glow">
                                            <span class="placeholder col-7"></span>
                                            <span class="placeholder col-4"></span>
                                            <span class="placeholder col-4"></span>
                                        </p>
                                        <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true"></a>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            @else
                @foreach(array_chunk($cards, 3) as $chunkIndex => $chunk)
                    <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                        <div class="d-flex justify-content-center flex-wrap">
                            @foreach($chunk as $card)
                                <div class="card mx-2" style="width: 18rem;">
                                    <img src="{{ $card['image'] }}" class="card-img-top" alt="{{ $card['title'] }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $card['title'] }}</h5>
                                        <p class="card-text">{{ $card['text'] }}</p>
                                        <a href="{{ $card['link'] }}" class="btn btn-primary">Ver más</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color:#c8102e;"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color:#c8102e;"></span>
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
        background-color: #6f2d2d;
    }

    /* Ajustes para el placeholder */
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
