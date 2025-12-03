<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('content')
    <x-breadcrumb-drawer :items="[['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0]]" />

    <!-- Sección de bienvenida -->
    <x-welcome-section title="¡Adéntrate en Marvelpedia!"
        subtitle="Descubre héroes, villanos y todo el universo Marvel en tu enciclopedia definitiva."
        bgImage="{{ asset('images/fondo_imagen_inicio.jpeg') }}" :carouselId="'bienvenidoCarrusel'" />

    <!-- Carrusel de contenido destacado -->
    @php
        $cards = [
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
    <x-carrusel title="Explora el Universo Marvel"
        subtitle="Personajes, cómics, películas y series que dan vida al mundo Marvel." :cards="$cards"
        :carouselId="'carrusel_destacados'" />

    <x-carrusel title="Reseñas de Fans"
        subtitle="Lee opiniones, comparte la tuya y descubre qué está marcando tendencia entre los fans." :cards="$resenas"
        :carouselId="'carrusel_resenas'" />

    <x-carrusel title="Foros en Fuego"
        subtitle="Únete a la comunidad, debate, comparte tu pasión y no te pierdas lo que se comenta." :cards="$foros"
        :carouselId="'carrusel_foros'" />
@endsection
