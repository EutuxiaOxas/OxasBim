<section class="container my-5 px-2 px-md-0 mb-4">
    <div class="mb-2">
        <h5 class="text-rubik text-lg font-semibold mb-0">Nuestros últimos productos</h5>
        <p class="text-rubik">Revisa nuestras ofertas de nuevo inventario</p>
    </div>
    <div class="container">
        <div class="owl-carousel owl-theme" id="ultimos_prductos">
          @foreach($last_products as $producto)

           <div class="item">

                @include('home.sections.card_product_home')

           </div>

           @endforeach
         </div>
      </div>
      <script>
        $("#ultimos_prductos").owlCarousel({
          loop: true,
          margin: 30,
          mouseDrag: true,
          nav: false,
          dots: false,
          navText: ['<img src="{{asset('icons/flecha.svg')}}" style="width: 25px;"/>', '<img src="{{asset('icons/flecha.svg')}}" style="width: 25px; transform: rotate(-180deg);"/>'],
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
