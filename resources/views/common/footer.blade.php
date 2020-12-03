<style type="text/css">
        footer{
            background-color: #21325b;
        }

        .footer_nav a{
            color: rgba(255,255,255, .7);
            font-size: 1rem;
        }

        .copyring-container{
            color: #fff;
            opacity: .4;
        }
        .copyring-container p {
            width: 80%;
            margin: 0 auto;
        }

        .primer_enlace{
            position: relative;
        }
        
        .opacity{
            opacity: .4 ;
            color: #fff;
        }
    </style>

@if(isset($navbar_null))
    

@else
    <footer>
        <div class="container py-2 mt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-4 footer_nav my-md-4">
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
                <div class="col-12 col-md-4 py-2 text-center">
                    @if(isset($logo))
                        <img src="{{asset('storage/'.$logo->image)}}" style="width: 60px; height: 60px;" alt="LOGO">
                    @else
                        <img src="" style="width: 60px; height: 60px;" alt="LOGO">
                    @endif
                </div>
                <div class="col-12 col-md-auto ml-auto footer_nav my-md-4">
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
                <div class="col-12 text-center py-3 copyring-container">
                    <h6> © Sitio desarrollado por <a href="https://oxas.tech/">oxas.tech</a></h6>
                    <p class="my-3">Sitio web desarrollado para finalizar tu compra en Whatsapp.</p>
                </div>
            </div>
        </div>
@endif