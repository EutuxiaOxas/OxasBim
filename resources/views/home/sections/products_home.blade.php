  <div class="container">
    <div class="owl-carousel owl-theme carousel_products_home">
      @foreach($otros_products as $o_product)
       <div class="item">

            @include('common.card_other_products')

       </div>
       @endforeach
     </div>
  </div>
  <script>
    $(".carousel_products_home").owlCarousel({
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


