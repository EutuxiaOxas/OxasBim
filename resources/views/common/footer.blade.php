@if(isset($navbar_null))

@else
    <footer>
        <div class="container py-2 mt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-5 col-lg-4 footer_nav my-md-4 order-2 order-md-1">
                    <ul class="nav nav-sm nav-white nav-x-sm align-items-center">
                        <li class="nav-item">
                          <a class="nav-link primer_enlace" href="https://www.instagram.com/oxas.tech/">Instagram</a>
                        </li>
                        <li class="nav-item opacity">/</li>
                        <li class="nav-item">
                          <a class="nav-link" href="https://www.facebook.com/OXAS-TECH-108906604277879/">Facebook</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-2 col-lg-4 py-2 text-center order-1 order-md-2">
                    @if(isset($logo))
                        <img src="{{asset('storage/'.$logo->image)}}" style="width: 70px; height: 70px;" alt="LOGO">
                    @else
                        <img src="" style="width: 70px; height: 70px;" alt="LOGO">
                    @endif
                </div>
                <div class="col-12 col-md-5 col-lg-auto ml-auto footer_nav my-md-4 order-3">
                    <ul class="nav nav-sm nav-white nav-x-sm align-items-center">
                        <li class="nav-item">
                          <a class="nav-link primer_enlace" href="/">Home</a>
                        </li>
                        <li class="nav-item opacity">/</li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('productos')}}">Vitrina de productos</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center py-3 copyring-container">
                    <p class="my-3">Construganga VLN CA. Todos los derechos reservados @php echo date('Y'); @endphp </p>
                    <small> © Sitio desarrollado por <a href="https://oxas.tech/" target="_blank">oxas.tech</a></small>
                </div>
            </div>
        </div>
@endif
