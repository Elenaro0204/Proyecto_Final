
@extends('layouts.app')

@section('content')
    <!-- Sección de bienvenida -->
    <x-welcome-section 
    title="¡Bienvenido a Marvelpedia!" 
    subtitle="Tu enciclopedia de personajes Marvel favorita." 
    bgImage="{{ asset('build/assets/images/fondo_imagen_inicio.jpg') }}" />

    <!-- Carrusel de contenido destacado -->
    @php
    $cards = [
        [
            'title' => 'Personajes',
            'text' => 'Conoce a los héroes y villanos más icónicos de Marvel.',
            'image' => asset('build/assets/images/personajes.jpg'),
            'link' => route('personajes')
        ],
        [
            'title' => 'Cómics',
            'text' => 'Explora las historias más épicas de los cómics.',
            'image' => asset('build/assets/images/comics.jpg'),
            'link' => route('comics')
        ],
        [
            'title' => 'Películas',
            'text' => 'Revive las películas más emocionantes del MCU.',
            'image' => asset('build/assets/images/peliculas.jpg'),
            'link' => route('peliculas')
        ],
        [
            'title' => 'Series',
            'text' => 'Disfruta de las series más entretenidas de Marvel.',
            'image' => asset('build/assets/images/series.jpg'),
            'link' => route('series')
        ],
    ];
    @endphp

    <x-carrusel 
        title="Explora nuestro contenido" 
        subtitle="Descubre personajes, cómics, películas y series de Marvel." 
        :cards="$cards" 
        carouselId="carrusel_destacados"
    />

    <!-- Carrusel de reseñas destacadas -->
    @php
        $cards = [
        [
            'title' => 'Spider-Man: No Way Home',
            'text' => 'La mejor película del Spider-Man moderno, con escenas épicas y emociones garantizadas.',
            'image' => asset('build/assets/images/resena_spiderman.jpg'),
            'link' => route('resenas.show', ['id' => 1])
        ],
        [
            'title' => 'Avengers: Endgame',
            'text' => 'Un cierre épico para la saga de los Vengadores que no deja a nadie indiferente.',
            'image' => asset('build/assets/images/resena_endgame.jpg'),
            'link' => route('resenas.show', ['id' => 2])
        ],
        [
            'title' => 'WandaVision',
            'text' => 'Una serie innovadora que mezcla misterio y humor con el mundo Marvel.',
            'image' => asset('build/assets/images/resena_wandavision.jpg'),
            'link' => route('resenas.show', ['id' => 3])
        ],
        [
            'title' => 'Loki',
            'text' => 'Explora el multiverso con el dios del engaño en esta entretenida serie.',
            'image' => asset('build/assets/images/resena_loki.jpg'),
            'link' => route('resenas.show', ['id' => 4])
        ],
    ];
    @endphp

    <x-carrusel 
        title="Reseñas más valoradas" 
        subtitle="Descubre qué es lo que ha encantado a nuestros usuarios." 
        :cards="$cards" 
        carouselId="carrusel_resenas"
    />

    <!-- Carrusel de foros destacados -->
    @php
    $cards = [
        [
            'title' => 'Debate Marvel',
            'text' => 'Participa en conversaciones sobre tus héroes favoritos.',
            'image' => asset('build/assets/images/foro_debate.jpg'),
            'link' => route('foros.show', ['id' => 1])
        ],
        [
            'title' => 'Teorías y Spoilers',
            'text' => 'Comparte y descubre teorías sobre películas y series.',
            'image' => asset('build/assets/images/foro_teorias.jpg'),
            'link' => route('foros.show', ['id' => 2])
        ],
        [
            'title' => 'Fan Art',
            'text' => 'Muestra tus ilustraciones y creaciones de Marvel.',
            'image' => asset('build/assets/images/foro_fanart.jpg'),
            'link' => route('foros.show', ['id' => 3])
        ],
        [
            'title' => 'Noticias y Lanzamientos',
            'text' => 'Entérate de las últimas noticias y estrenos del MCU.',
            'image' => asset('build/assets/images/foro_noticias.jpg'),
            'link' => route('foros.show', ['id' => 4])
        ],
    ];
    @endphp

    <x-carrusel 
        title="Foros Destacados" 
        subtitle="Únete a la conversación y descubre lo que está moviendo a la comunidad." 
        :cards="$cards" 
        carouselId="carrusel_foros"
    />


@endsection
