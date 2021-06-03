@extends('layouts.app')

@section('title')
	Construganga - Tienda Virtual
@endsection

@section('header')
    {{-- precargar imagenes --}}
    <link rel="preload" href="{{asset('logo.png')}}" as="image">

    <!-- Primary Meta Tags -->
    <meta name="title" content="Construganga Valencia">
    <meta name="description" content="">
@endsection

@section('content')
    {{-- Carousel Principal --}}
    @include('home.sections.carousel_principal')

    <!-- CAROUSEL DE PUBLICIDADES -->
    @include('home.sections.carousel_publicidades')

    {{-- Ultimos produtcos creados --}}
    @include('home.sections.ultimos_productos')

    <!-- CAROUSEL DE PRODUCTOS POR CATEGORIA  -->
    @include('home.sections.productos')

    @include('home.sections.productos_pequeños')


@endsection


