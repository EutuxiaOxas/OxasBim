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
    <footer >
        <div class="container py-2">
            <div class="row">
                <div class="col-12 py-3">
                    <img src="{{asset('storage/'.$logo->image)}}" style="width: 60px; height: 60px;">
                </div>
                <div class="col-6 footer_nav my-2">
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
                    <h6> © Desarrollado por oxas.tech</h6>
                    <p class="my-3">When you visit or interact with our sites, services or tools, we or our authorised service providers may use cookies for storing information to help provide you with a better, faster and safer experience and for marketing purposes.</p>
                </div>
            </div>
        </div>
@endif