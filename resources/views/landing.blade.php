@extends('layouts.app')

@section('title')
	Tienda Virtual Básica - Oxas Tech
@endsection

@section('header')
    {{-- precargar imagenes --}}
    <link rel="preload" href="{{asset('logo.png')}}" as="image">

    <!-- Primary Meta Tags -->
    <meta name="title" content="Oxas - Tienda Virtual Básica">
    <meta name="description" content="Tienda virtual para recolectar pedidos y redirigir las ventas a Whatsapp. Perfecta para activar Instagram Shop.">
@endsection

@section('content')
    <style type="text/css">
        .carousel-inner>.item>img,
        .carousel-inner>.item>a>img {
            width: 100%;
        }

        .carousel-item {
            position: relative;
        }

        .carousel_body {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
    <?php $contador = 1; ?>
    <section class="slider_container">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($sliders as $slider)
                    <div <?php if ($contador==1) { echo 'class="carousel-item active"' ; } else {
                        echo 'class="carousel-item"' ; } ?>>
                        <img src="{{ asset('storage/' . $slider->image) }}"
                            style="width: 100%; height: 60vh; object-fit: cover;" class="d-block w-100" alt="...">
                        <div class="carousel_body">
                            <h2>{{ $slider->title }}</h2>
                            <p>{{ $slider->description }}</p>
                        </div>
                    </div>
                    <?php $contador++; ?>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    
    <!-- CAROUSEL DE PUBLICIDADES -->
    <section class="container my-5 px-2 px-md-0">
        @include('common.publicidades_carousel')
    </section>

    <!-- CAROUSEL DE PRODUCTOS POR CATEGORIA  -->
    <section class="container my-5 px-2 px-md-0 mb-4">
        @php /*print_r($array_other_products);*/   @endphp
        @php $x=0; @endphp
        @foreach ($array_other_products as $otros_products)
            <h2>{{$categorias[$x]->title}}</h2>
            @include('common.products_home')
            @php ++$x; @endphp
        @endforeach
    </section>

    <!-- CAROUSEL DE PRODUCTOS RAMDOM PEQUEÑOS -->
    <section class="container my-5 px-2 px-md-0">
        @include('common.small_products')
    </section>

    
@endsection


