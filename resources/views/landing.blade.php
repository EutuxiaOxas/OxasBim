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
    <!--section class="slider_container">
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
    <section-- class="py-5">
        @foreach($categorias->take(4) as $categoria)
            @include('common.other_products', ['otros_products' => $categoria->products])
        @endforeach
    </section-->
    <section class="container mx-5 px-5">

        <!-- Este es el componente para agregar a Modal 
        Se agregara por cada producto añadido al carrito
        -->
        <div class="product_main row mb-3">
            <span class="close_product_modal">
                <svg class="eliminar_producto" id="{producto.id}" width="18px" height="18px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg>
            </span>
            <div class="col-1">
                <div class="row">
                    <div class="container_img_modal_cart">
                        <img class="img_modal_cart" src="{{asset('61.jpg')}}" alt="Imagen Producto en carrito"> 
                    </div>
                </div>
            </div>
            <div class="col-auto ml-3">
                <div class="row align-items-center">
                    <span class="title_modal_cart mr-3">Smart Speaker with Voice Control</span> 
                    <span class="price_modal_cart"> 58,99 $</span>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-auto mr-3 px-0">
                        <span class="cantidad_modal_cart">Cantidad:</span>
                    </div>
                    <div class="col-auto">
                        <select class="form-control cantidad_producto_cart">
                            <option class="cantidad_opcion">1</option>
                            <option class="cantidad_opcion">1</option>
                            <option class="cantidad_opcion">1</option>
                        </select> 
                    </div>
                </div>  
                <input type="hidden" value="${producto.id}">          
            </div>
        </div>
        <!-- Fin de Componente para agregar a Modal -->

        <!-- Repeticion a modo de ejemplo -->
        <div class="product_main row mb-3">
            <span class="close_product_modal">
                <svg class="eliminar_producto" id="${producto.id}" width="18px" height="18px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg>
            </span>
            <div class="col-1">
                <div class="row">
                    <div class="container_img_modal_cart">
                        <img class="img_modal_cart" src="{{asset('61.jpg')}}" alt="Imagen Producto en carrito"> 
                    </div>
                </div>
            </div>
            <div class="col-auto ml-3">
                <div class="row align-items-center">
                    <span class="title_modal_cart mr-3">Smart Speaker with Voice Control</span> 
                    <span class="price_modal_cart"> 58,99 $</span>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-auto mr-3 px-0">
                        <span class="cantidad_modal_cart">Cantidad:</span>
                    </div>
                    <div class="col-auto">
                        <select class="form-control cantidad_producto_cart">
                            <option class="cantidad_opcion">1</option>
                            <option class="cantidad_opcion">1</option>
                            <option class="cantidad_opcion">1</option>
                        </select> 
                    </div>
                </div>  
                <input type="hidden" value="${producto.id}">          
            </div>
        </div>
        <!-- Fin de ejemplo -->
    </section>
    
@endsection


