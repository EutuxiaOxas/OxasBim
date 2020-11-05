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

    @yield('captcha')

    <style type="text/css">
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
        @if(isset($navbar_null))
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="display: none;">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    @if(isset($logo))
                        <img src="{{asset('storage/'.$logo->image)}}" width="40" height="40" alt="logo">
                    @else
                        LOGO
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="{{route('productos')}}" class="nav-link">Productos</a>
                        </li>
                        <li class="nav-item dropdown" id="cart_main" style="position: relative;">
                            <a id="carritoDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-shopping-cart"></i>
                            </a>

                            <div>
                                <div class="dropdown-menu dropdown-menu-right" id="cart_body" aria-labelledby="carritoDropdown">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @else
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    @if(isset($logo))
                        <img src="{{asset('storage/'.$logo->image)}}" width="40" height="40" alt="logo">
                    @else
                        LOGO
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="navbar-nav mr-auto col-4">
                        <form action="/productos" class="d-flex">
                            <input class="form-control mr-2" type="search" placeholder="Buscar producto" name="search">
                            <input type="submit" class="btn btn-sm btn-primary" value="buscar">
                        </form>
                    </div>
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="{{route('productos')}}" class="nav-link">Productos</a>
                        </li>
                        <li class="nav-item dropdown" id="cart_main">
                            <a id="carritoDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-shopping-cart"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" id="cart_body" style="overflow: hidden;" aria-labelledby="carritoDropdown">
                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <!--ul class="navbar-nav ml-auto"-->
                        <!-- Authentication Links -->
                        @guest
                            <!--li-- class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </!--li-->
                            @if (Route::has('register'))
                                <!--li-- class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </!--li-->
                            @endif
                        @else
                            <!--li-- class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <!--div-- class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </!--div-->
                            <!--/li-->
                        @endguest
                    <!--/ul-->
                </div>
            </div>
        </nav>
        @endif
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
    <script type="text/javascript">
        const botonEnviarWhatsapp = document.getElementById('whatsapp_submit')

        botonEnviarWhatsapp.addEventListener('click', () => {
            const form = document.getElementById('form_modal_whatsapp')
            productos = []
            storage.addStorage(productos)

            form.submit();

        })
    </script>
</body>
</html>
