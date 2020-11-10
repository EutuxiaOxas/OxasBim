<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/owlcarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/owlcarousel/assets/owl.theme.default.min.css')}}">
    <script src="{{asset('vendor/jquery/jquery.js')}}"></script>
    <script src="{{asset('vendor/owlcarousel/owl.carousel.min.js')}}"></script>
    

    @yield('captcha')

    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .cart_on {
            color: blue;
        }

        .product_main{
            transform: translateX(-.8rem);
            transition: transform .3s; 
        }

        .product_main:hover {
            transform: translateX(10px);
        }

        .meme {
            border: 1px solid red;
        }

        .eliminar_container{
            position: relative;
            transform: translateY(25%);
        }
    </style>
</head>
<body>
    @if(isset(auth()->user()->id))
        <input type="hidden" id="sesion" value="1">
    @else 
        <input type="hidden" id="sesion" value="0">
    @endif
    <div id="app">

        @include('common.navbar')
        
        <main class="">
            @yield('content')
        </main>
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
                        <div class="form-group">
                            <h5>Nombre y apellido</h5>
                            <input class="form-control" type="text" required maxlength="191" name="nombre" placeholder="Ingresa tu nombre y apellido">
                        </div>
                        <div class="form-group">
                            <h5>Telefono</h5>
                            <input class="form-control" type="text" required maxlength="191" name="telefono" placeholder="Ingresa tu número de telefono">
                        </div>

                        <div class="form-group">
                            <h5>Cédula</h5>
                            <input class="form-control" type="text" required maxlength="191" name="documento_identidad" placeholder="Ingresa tu documento de identidad">
                        </div>
                            
                    </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="whatsapp_submit" class="btn btn-primary">Continuar</button>
                </div>
            </div>
        </div>
      </div>
    </div>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</body>
</html>
