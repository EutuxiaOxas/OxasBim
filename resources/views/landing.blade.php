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
    <section class="py-5">
        @foreach($categorias->take(4) as $categoria)
            @include('common.other_products', ['otros_products' => $categoria->products])
        @endforeach
    </section>


    <div class="eliminar_container d-flex">
        <i class="far fa-times-circle eliminar_producto" id="${producto.id}" style="color:red; cursor: pointer; hegith:30px; width:30px;"></i>
    </div>

    <div class="product_main row my-5">
        <div class="col-2">
			<div class="container_img_modal_cart">
				<img class="img_modal_cart" src="{{asset('61.jpg')}}" alt="Imagen Producto en carrito">
			</div>
		</div>
        <div class="col-7">
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
                    </select> 
                </div>
            </div>  
            <input type="hidden" value="${producto.id}">          
        </div>
    </div>


    <div class="product_main row">
        <div class="col-2">
			<div class="container_img_modal_cart">
				<img class="img_modal_cart" src="${producto.image}" alt="Imagen Producto en carrito">
			</div>
		</div>
        <div class="col-7">
            <div class="row align-items-center">
                <span class="title_modal_cart mr-3">${producto.title} </span> 
                <span class="price_modal_cart"> ${producto.price} $</span>
            </div>
            <div class="row align-items-center mt-2">
                <div class="col-auto mr-3 px-0">
                    <span class="cantidad_modal_cart">Cantidad:</span>
                </div>
                <div class="col-auto">
                    <select class="form-control cantidad_producto_cart">
                        <option class="cantidad_opcion" ${producto.cantidad == 1 ? 'selected' : ''}>1</option>
                        <option class="cantidad_opcion" ${producto.cantidad == 2 ? 'selected' : ''}>2</option>
                        <option class="cantidad_opcion" ${producto.cantidad == 3 ? 'selected' : ''}>3</option>
                        <option class="cantidad_opcion" ${producto.cantidad == 4 ? 'selected' : ''}>4</option>
                        <option class="cantidad_opcion" ${producto.cantidad == 5 ? 'selected' : ''}>5</option>
                        ${producto.cantidad > 5 ? `<option class="cantidad_opcion" value="${producto.cantidad}" selected>${producto.cantidad}</option>` : '' }
                    </select>
                </div>
            </div>  
            <input type="hidden" value="${producto.id}">          
        </div>
    </div>




    <!--div class="d-flex pl-2 mb-2">
        <img src='/storage/${producto.imagen}' class="mr-2" style="width: 25px; height: 25px ;object-fit: cover;">
        <p>	
            ${producto.producto.title} 

            <span>(${producto.cantidad}</span>
        </p>

    </!--div>

    <!--div class="product_main d-flex" style="position:relative;">
        <div class="eliminar_container d-flex">
            <i class="far fa-times-circle eliminar_producto" id="${producto.id}" style="color: red; cursor: pointer;"></i>
        </div>
        <div class="d-flex mb-2 move-on-left justify-content-around align-items-center" style="flex-wrap: wrap; flex:1;">
            <input type="hidden" value="${producto.id}">
            <img src='${producto.image}' class="" style="width: 50px; height: 50px ;object-fit: cover;">
            <div class="d-flex" style="width:40%; text-align: start;">
              <p class= "m-0">  
                  ${producto.title} 
                  <span>(${producto.cantidad} x ${producto.price})</span>
              </p>
          </div>
            <div style="width: 30%">
                <select class="form-control cantidad_producto_cart">
                    <option class="cantidad_opcion" ${producto.cantidad == 1 ? 'selected' : ''}>1</option>
                    <option class="cantidad_opcion" ${producto.cantidad == 2 ? 'selected' : ''}>2</option>
                    <option class="cantidad_opcion" ${producto.cantidad == 3 ? 'selected' : ''}>3</option>
                    <option class="cantidad_opcion" ${producto.cantidad == 4 ? 'selected' : ''}>4</option>
                    <option class="cantidad_opcion" ${producto.cantidad == 5 ? 'selected' : ''}>5</option>
                    ${producto.cantidad > 5 ? `<option class="cantidad_opcion" value="${producto.cantidad}" selected>${producto.cantidad}</option>` : '' }
                </select>
            </div>
        </div>
    </!--div>
@endsection


