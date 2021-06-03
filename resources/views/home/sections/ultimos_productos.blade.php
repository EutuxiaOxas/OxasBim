<section class="container my-5 px-2 px-md-0 mb-4">

    <div class="container">
        <div class="owl-carousel owl-theme" id="ultimos_prductos">
          @foreach($last_products as $producto)

           <div class="item">

                @include('common.card_product')

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
            500: {
              items: 2
            },
            992: {
              items: 3
            },
            1200: {
              items: 4
            }
          }
        })
      </script>

</section>
