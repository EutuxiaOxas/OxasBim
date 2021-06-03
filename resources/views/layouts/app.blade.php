<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="author" content="Oxas Tech">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('logo.png')}}">

    @yield('header')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/owlcarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/owlcarousel/assets/owl.theme.default.min.css')}}">
    <script src="{{asset('vendor/jquery/jquery.js')}}"></script>
    <script src="{{asset('vendor/owlcarousel/owl.carousel.min.js')}}"></script>


    @yield('captcha')


</head>
<body class="bg-white">
    <input type="hidden" id="sesion" value="0">
    <div id="app">

        @include('common.navbar')

        <main style="min-height:100vh;">
            @yield('content')
        </main>
    </div>

    <div class="modal fade" id="modalCarritoCompras" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Carrito de compras</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="cart_body">

                </div>
                <div class="modal-footer">
                    <button  id="boton_modal" class="btn btn btn-primary px-4" data-toggle="modal" data-dismiss="modal" data-target="#modalIrAWhatsapp">Finalizar en Whatsapp</button>
                    <button type="button" id="vaciar_carrito_cart" class="btn btn btn-outline-danger">Vaciar Carrito</button>
                </div>
            </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalIrAWhatsapp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agrega tus datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="errors_container" style="display: none;" class="alert alert-danger" role="alert">
                    </div>

                    <form action="/ir/whatsapp" id="form_modal_whatsapp" method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" id="productos_modal" name="productos">
                        <input type="hidden" id="total_modal" name="total">
                        <input type="hidden" id="pedido_id" name="pedido_id">
                        <div class="form-group">
                            <h5>Nombre y apellido</h5>
                            <input class="form-control" type="text" id="form_name" required maxlength="191" name="nombre" placeholder="Ingresa tu nombre y apellido">
                        </div>
                       <!--div-- class="form-group">
                            <h5>Telefono</h5>
                            <input class="form-control" type="text" required maxlength="191" name="telefono" placeholder="Ingresa tu número de telefono">
                        </!--div-->

                        <div class="form-group">
                            <h5>Cédula</h5>
                            <input class="form-control" type="text" required maxlength="191" name="documento_identidad" placeholder="Ingresa tu documento de identidad">
                        </div>
                        <div class="">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" value="Continuar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Boton Flotante Carrito Cel -->
    <div class="float_button_cart d-md-none" data-toggle="modal" data-target="#modalCarritoCompras">
        <div class="container_float_cart" id="container_float">
            <i id="cart_icon_id" class="fas fa-shopping-cart"></i>
        </div>
    </div>
    <!-- Producto Agregado al carrito -->
    <div id="message_success">¡Agregado con éxito!</div>

    <!-- FOOTER -->
    @include('common.footer')

    <!-- FOOTER -->
    @include('common.whatsapp')

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        const modalCarrito = document.getElementById('cart_main')

        modalCarrito.addEventListener('click', () => {
            $('#modalCarritoCompras').modal('show')
        })
    </script>
</body>
</html>
