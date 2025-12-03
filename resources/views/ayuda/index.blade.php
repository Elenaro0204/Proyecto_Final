<!-- resources/views/ayuda/index.blade.php -->

@extends('layouts.app')

@section('content')
    <x-breadcrumb-drawer :items="[
        ['label' => 'Inicio', 'url' => route('inicio'), 'level' => 0],
        ['label' => 'Ayuda', 'url' => route('ayuda'), 'level' => 1],
    ]" />

    <!-- Sección de bienvenida -->
    <x-welcome-section title="¡Socorro! Necesito Ayuda"
        subtitle="Encuentra respuestas a tus preguntas frecuentes y aprende a navegar por Marvelpedia."
        bgImage="{{ asset('images/fondo_imagen_inicio.jpeg') }}" />

    <div class="container p-5">
        <div class="row">
            <!-- Barra lateral -->
            <div class="col-12 col-md-3 mb-4">
                @include('ayuda.sections.menu_lateral')
            </div>

            <!-- Contenido principal -->
            <div class="col-12 col-md-9">
                @include('ayuda.sections.funciones')
                @include('ayuda.sections.problemas_comunes')
                @include('ayuda.sections.contacto')
                @include('ayuda.sections.guia_paso')
                @include('ayuda.sections.preguntas_frecuentes')
                @include('ayuda.sections.opinion')
            </div>
        </div>
    </div>
@endsection
