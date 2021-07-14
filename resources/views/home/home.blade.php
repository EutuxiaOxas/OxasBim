@extends('layouts.app')

@section('title')
    Contrugangavalencia.com
@endsection

@section('header')
    {{-- precargar imagenes --}}
    <link rel="preload" href="{{asset('logo.png')}}" as="image">

    <meta name="robots" content="index,follow"/>
    <!-- Primary Meta Tags -->
    <meta name="title" content="Construganga Valencia">
    <meta name="description" content="Productos de construcción y ferretería en Valencia, Venezuela">

    <!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	{{-- <meta property="og:url" content="https://heredadmedical.com/"> --}}
    <meta property="og:url" content="https://construgangavalencia.com/">
	<meta property="og:title" content="Construganga Valencia">
	<meta property="og:description" content="Productos de construcción y ferretería en Valencia, Venezuela">
	<meta property="og:image" content="{{ asset( 'logo.png' ) }}">

    {{-- url canonical --}}
	<link rel="canonical" href="https://construgangavalencia.com/" />

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



