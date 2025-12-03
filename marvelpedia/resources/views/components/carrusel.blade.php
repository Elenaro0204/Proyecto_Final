<!-- resources/views/components/carrusel.blade.php -->

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

<section class="container my-5 text-center px-4 md:px-0">
    @if (!empty($title) || !empty($subtitle))
        <div class="mb-4">
            @if (!empty($title))
                <h2 class="display-5 fw-bold font-bangers text-2xl sm:text-3xl md:text-4xl">{{ $title }}</h2>
            @endif
            @if (!empty($subtitle))
                <p class="lead text-muted font-marvel text-sm sm:text-base md:text-lg">{{ $subtitle }}</p>
            @endif
        </div>
    @endif

    @if (count($cardsArray) > 0)
        <div id="{{ $carouselId }}" class="carousel slide" data-bs-ride="carousel">

            <div id="{{ $carouselId }}-indicators"
                class="carousel-indicators position-absolute bottom-0 start-50 translate-middle-x m-2"></div>

            <div id="{{ $carouselId }}-inner" class="carousel-inner py-4"></div>

            {{-- <div class="carousel-indicators position-absolute bottom-0 start-50 translate-middle-x m-2">
                @foreach ($cardsArray as $index => $card)
                    <button type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $index + 1 }}">
                    </button>
                @endforeach
            </div>

            <div class="carousel-inner py-4">
                @foreach ($cardsArray as $index => $card)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
                                <div class="card text-white border-2 border-red-700 flex flex-col justify-between w-full max-w-xs sm:max-w-sm md:max-w-md"
                                    style="min-height: 400px; background-color: {{ $card['color_fondo'] ?? 'rgba(0,0,0,0.7)' }}">

                                    @if (isset($card['image']))
                                        <img src="{{ $card['image'] }}" class="card-img-top"
                                            alt="{{ $card['title'] }}" style="height: 180px; object-fit: cover;">
                                    @endif

                                    <div class="card-body flex flex-col justify-center text-center">
                                        <h5 class="card-title font-bangers mb-2"
                                            style="color: {{ $card['color_titulo'] ?? '#fff' }}">
                                            {{ $card['title'] }}
                                        </h5>
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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}

            <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}"
                data-bs-slide="prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 16 16" fill="none"
                    stroke="red" stroke-width="2">
                    <path d="M11 1L3 8l8 7" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}"
                data-bs-slide="next">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 16 16" fill="none"
                    stroke="red" stroke-width="2">
                    <path d="M5 1l8 7-8 7" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

        </div>
    @else
        <p class="text-gray-500 italic mt-4">No hay elementos para mostrar en este momento.</p>
    @endif
</section>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function initCarousel(carouselId, cards) {
                if (!cards || cards.length === 0) return;

                const carouselInner = document.getElementById(`${carouselId}-inner`);
                const carouselIndicators = document.getElementById(`${carouselId}-indicators`);
                if (!carouselInner || !carouselIndicators) return;

                console.log("CARDS RECIBIDAS:", cards);

                // Convertimos las rutas de imagen de foros a rutas públicas
                cards = cards.map(card => {
                    if (card.imagen) {
                        // Si card.imagen ya es una URL absoluta → se respeta
                        if (card.imagen.startsWith('http')) {
                            card.image = card.imagen;
                        } else {
                            // Si sólo viene el nombre, asumimos /storage/portadas
                            if (!card.imagen.includes('/')) {
                                card.image = `/storage/portadas/${card.imagen}`;
                            } else {
                                // Si viene algo tipo portadas/archivo.jpg
                                card.image = `/storage/${card.imagen}`;
                            }
                        }
                    }
                    return card;
                });

                function getCardsPerSlide() {
                    if (window.innerWidth < 576) return 1;
                    if (window.innerWidth < 768) return 2;
                    return 3;
                }

                function buildCarousel() {
                    const perSlide = getCardsPerSlide();
                    carouselInner.innerHTML = '';
                    carouselIndicators.innerHTML = '';

                    for (let i = 0, slideIndex = 0; i < cards.length; i += perSlide, slideIndex++) {
                        const chunk = cards.slice(i, i + perSlide);
                        const slide = document.createElement('div');
                        slide.className = `carousel-item ${slideIndex === 0 ? 'active' : ''}`;
                        slide.innerHTML = `<div class="row justify-content-center">
                            ${chunk.map(card => `
                                                                    <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
                                                                        <div class="card text-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col justify-between w-full max-w-xs sm:max-w-sm md:max-w-md"
                                                                            style="min-height: 400px; background: linear-gradient(180deg, ${card.color_fondo || 'rgba(0,0,0,0.8)'} 0%, rgba(0,0,0,0.6) 100%); border: 2px solid #e63946;">

                                                                            ${card.image ? `<img src="${card.image}" class="card-img-top rounded-t-xl" alt="${card.title}" style="height:200px; object-fit: cover; filter: brightness(0.85);">` : ''}

                                                                            <div class="card-body flex flex-col justify-center text-center px-4 py-3">
                                                                                <h5 class="card-title font-bangers text-lg sm:text-xl md:text-2xl mb-2" style="color: ${card.color_titulo || '#fff'}; text-shadow: 1px 1px 4px rgba(0,0,0,0.6);">
                                                                                    ${card.title}
                                                                                </h5>
                                                                                ${card.text ? `<p class="card-text font-roboto text-sm sm:text-base md:text-base mb-3 text-gray-200">${card.text}</p>` : ''}
                                                                            </div>

                                                                            <div class="card-footer text-center bg-transparent border-0 mb-3">
                                                                                <a href="${card.link}" class="btn bg-red-500 text-white rounded-full px-6 py-2 hover:bg-red-600 hover:scale-105 transition-transform duration-300 font-marvel">
                                                                                    Ver más
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                `).join('')}
                        </div>`;
                        carouselInner.appendChild(slide);

                        const button = document.createElement('button');
                        button.type = 'button';
                        button.setAttribute('data-bs-target', `#${carouselId}`);
                        button.setAttribute('data-bs-slide-to', slideIndex);
                        if (slideIndex === 0) {
                            button.classList.add('active');
                            button.setAttribute('aria-current', 'true');
                        }
                        button.setAttribute('aria-label', `Slide ${slideIndex + 1}`);
                        carouselIndicators.appendChild(button);
                    }
                }

                buildCarousel();
                window.addEventListener('resize', buildCarousel);
            }

            initCarousel("{{ $carouselId }}", @json($cardsArray));
        });
    </script>
@endpush
