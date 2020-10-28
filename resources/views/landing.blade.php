@extends('layouts.app')

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
                            style="width: 100%; height: 70vh; object-fit: cover;" class="d-block w-100" alt="...">
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

    <section class="container ">
        <div class="row banners_content py-5">
            <div class="banner_img col-6 img-fluid">
                <img src="https://picsum.photos/700/400" class="w-100">
            </div>
            <div class="banner_body col-6">
                <h2>Titulo</h2>
                <p>Contenido</p>
            </div>
        </div>
        <div class="row banners_content py-5">
            <div class="banner_body col-6">
                <h2>Titulo</h2>
                <p>Contenido</p>
            </div>
            <div class="banner_img col-6 img-fluid">
                <img src="https://picsum.photos/700/400" class="w-100">
            </div>
        </div>
        <div class="row banners_content py-5">
            <div class="banner_img col-6 img-fluid">
                <img src="https://picsum.photos/700/400" class="w-100">
            </div>
            <div class="banner_body col-6">
                <h2>Titulo</h2>
                <p>Contenido</p>
            </div>
        </div>
    </section>
@endsection
