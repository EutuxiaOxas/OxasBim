
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
                <li class="nav-item" id="cart_main" style="position: relative;">
                    <a id="carritoDropdown" class="nav-link" href="#">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
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
                <img src="{{asset('storage/'.$logo->image)}}" width="55" height="55" alt="logo">
            @else
                LOGO
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav ml-5 d-none d-md-block">
                <form action="/productos" class="d-flex">
                    <div class="input-group">
                        <div class="input-group-prepend" >
                          <span class="input-group-text bg-transparent" style="border-right: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="20"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                          </span>
                        </div>
                        <input class="form-control search-navbar" type="search" placeholder="Buscar producto" name="search" autocomplete="off">
                        <div class="input-group-append">
                            <input type="submit" class="btn btn-sm btn-search px-3 text-white" value="Buscar">
                        </div>
                    </div>
                </form>
            </div>
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{route('productos')}}" class="nav-link text-dark">Productos</a>
                </li>
                <li class="nav-item cart_dropdown d-none d-md-block" id="cart_main">
                    <a id="carritoDropdown" class="nav-link openModalCar" href="#" data-toggle="modal" data-target="#modalCarritoCompras">
                        <i id="cart_icon_id" class="fas fa-shopping-cart text-dark" ></i>
                    </a>
                    {{-- <div class="cart_dropdown_menu">
                    </div> --}}
                </li>
            </ul>

        </div>
    </div>
</nav>
@endif
