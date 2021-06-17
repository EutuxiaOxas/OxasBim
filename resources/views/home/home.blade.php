@extends('layouts.app')

@section('title')
    Contrugangavalencia.com
@endsection

@section('header')
    {{-- precargar imagenes --}}
    <link rel="preload" href="{{asset('logo.png')}}" as="image">

    <!-- Primary Meta Tags -->
    <meta name="title" content="Construganga Valencia">
    <meta name="description" content="">

    <style>
        .img_banner_principal{
            width: 100%;
            height: 45vh;
            object-fit: cover;
        }
        @media only screen and (max-width: 996px) {
            .img_banner_principal{
                height: auto;
            }
        }
    </style>
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


