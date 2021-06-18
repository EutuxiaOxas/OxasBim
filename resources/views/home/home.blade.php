@extends('layouts.app')

@section('title')
    Suministros Médicos en Venezuela - HeredadMedical.com
    {{-- Contrugangavalencia.com --}}
@endsection

@section('header')
    {{-- precargar imagenes --}}
    <link rel="preload" href="{{asset('logo.png')}}" as="image">

    <meta name="robots" content="index,follow"/>

    <!-- Primary Meta Tags -->
    {{-- <meta name="title" content="Construganga Valencia"> --}}
    <meta name="title" content="Suministros médicos en venezuela - HeredadMedical.com">
    <meta name="description" content="Todo tipo de suministros médicos al alcance de tu mano. Envíos a toda venezuela">
    <meta name="keywords" content="abastos y supermercados en venezuela">

    <!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="https://heredadmedical.com/">
	<meta property="og:title" content="Suministros médicos en venezuela - HeredadMedical.com">
	<meta property="og:description" content="Todo tipo de suministros médicos al alcance de tu mano. Envíos a toda venezuela">
	<meta property="og:image" content="{{ asset( 'home.webp' ) }}">

    {{-- url canonical --}}
	<link rel="canonical" href="https://heredadmedical.com/" />

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


