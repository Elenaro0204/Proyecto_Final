<!-- resources/views/login.blade.php -->

@extends('layouts.guest')

@section('content')
    @if (Route::currentRouteName() === 'login')
        @include('auth.login')
    @elseif (Route::currentRouteName() === 'register')
        @include('auth.register')
    @endif
@endsection
