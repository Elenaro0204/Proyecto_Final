<!-- resources/views/welcome.blade.php -->

@extends('layouts.app')

@section('content')
    <!-- Sección de bienvenida -->
    <x-welcome-section title="¡Bienvenido a Marvelpedia!" subtitle="Tu enciclopedia de personajes Marvel favorita."
        bgImage="{{ asset('images/fondo_imagen_inicio.jpeg') }}" />

    <!-- Carrusel de contenido destacado -->
    @php
        $cards = [
            [
                'title' => 'Personajes',
                'text' => 'Conoce a los héroes y villanos más icónicos de Marvel.',
                'image' => asset('images/fondo-personajes.jpg'),
                'link' => route('personajes'),
            ],
            [
                'title' => 'Cómics',
                'text' => 'Explora las historias más épicas de los cómics.',
                'image' => asset('images/fondo-comics.jpeg'),
                'link' => route('comics'),
            ],
            [
                'title' => 'Películas',
                'text' => 'Revive las películas más emocionantes del MCU.',
                'image' => asset('images/fondo-peliculas.jpeg'),
                'link' => route('peliculas.index'),
            ],
            [
                'title' => 'Series',
                'text' => 'Disfruta de las series más entretenidas de Marvel.',
                'image' => asset('images/fondo-series.jpg'),
                'link' => route('series'),
            ],
            [
                'title' => 'Foros',
                'text' => 'Participa en discusiones, comparte opiniones y conecta con otros fans.',
                'image' => asset('images/fondo-foros.jpg'),
                'link' => route('foros.index'),
            ],
            [
                'title' => 'Descubre',
                'text' => 'Explora curiosidades, novedades y contenidos exclusivos de Marvel.',
                'image' => asset('images/fondo-descubre.jpg'),
                'link' => route('descubre'),
            ],
            [
                'title' => 'Reseñas',
                'text' => 'Lee y comparte reseñas de cómics, películas y series.',
                'image' => asset('images/fondo-resenas.jpeg'),
                'link' => route('resenas'),
            ],
            [
                'title' => 'Ayuda',
                'text' => 'Encuentra respuestas a tus dudas y aprende a navegar en Marvelpedia.',
                'image' => asset('images/fondo-ayuda.jpeg'),
                'link' => route('ayuda'),
            ],
        ];
    @endphp

    <x-carrusel title="Explora nuestro contenido" subtitle="Descubre personajes, cómics, películas y series de Marvel."
        :cards="$cards" :carouselId="'carrusel_destacados'" />

    <!-- Carrusel de reseñas destacadas -->
    @php
        $cards = [
            [
                'title' => 'Spider-Man: No Way Home',
                'text' => 'La mejor película del Spider-Man moderno, con escenas épicas y emociones garantizadas.',
                'image' => asset('build/assets/images/resena_spiderman.jpg'),
                'link' => route('resenas.show', ['type' => 'film', 'id' => 1]), // Asegúrate de pasar 'type' aquí
            ],
            [
                'title' => 'Avengers: Endgame',
                'text' => 'Un cierre épico para la saga de los Vengadores que no deja a nadie indiferente.',
                'image' => asset('build/assets/images/resena_endgame.jpg'),
                'link' => route('resenas.show', ['type' => 'film', 'id' => 2]), // Asegúrate de pasar 'type' aquí
            ],
            [
                'title' => 'WandaVision',
                'text' => 'Una serie innovadora que mezcla misterio y humor con el mundo Marvel.',
                'image' => asset('build/assets/images/resena_wandavision.jpg'),
                'link' => route('resenas.show', ['type' => 'series', 'id' => 3]), // Añadido 'type' para 'series'
            ],
            [
                'title' => 'Loki',
                'text' => 'Explora el multiverso con el dios del engaño en esta entretenida serie.',
                'image' => asset('build/assets/images/resena_loki.jpg'),
                'link' => route('resenas.show', ['type' => 'series', 'id' => 4]), // Añadido 'type' para 'series'
            ],
        ];
    @endphp

    <x-carrusel title="Reseñas más comentadas" subtitle="Descubre lo que más comentan los usuarios" :cards="$resenas"
        :carouselId="'carrusel_resenas'" />

    <x-carrusel title="Foros Destacados" subtitle="Únete a la conversación y descubre lo que está moviendo a la comunidad."
        :cards="$foros" :carouselId="'carrusel_foros'" />
@endsection
