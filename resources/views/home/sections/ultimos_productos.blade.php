<section class="container-fluid my-5 px-2 px-md-4 mb-4">
    <div class="mb-2">
        <h5 class="text-rubik color-primary text-lg font-semibold mb-0">Nuestros últimos productos</h5>
        <p class="text-rubik">Revisa nuestras ofertas de nuevo inventario</p>
    </div>
    <div>
        <div class="owl-carousel owl-theme" id="ultimos_prductos">
          @foreach($last_products as $producto)

           <div class="item py-1">

                @include('home.sections.card_product_home')

           </div>

           @endforeach
         </div>
      </div>
      <script>
        $("#ultimos_prductos").owlCarousel({
          loop: true,
          margin: 5,
          mouseDrag: true,
          nav: false,
          dots: false,
          navText: ['<img src="{{asset('flecha.svg')}}" style="width: 25px;"/>', '<img src="{{asset('flecha.svg')}}" style="width: 25px; transform: rotate(-180deg);"/>'],
          responsive: {
            0: {
              items: 2
            },
            992: {
              items: 4
            },
            1200: {
              items: 5
            }
          }
        })
      </script>

</section>
