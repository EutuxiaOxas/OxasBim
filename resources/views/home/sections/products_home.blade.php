  <div class="container">
    <div class="owl-carousel owl-theme carousel_products_home">
      @foreach($otros_products as $producto)
       <div class="item">

            @include('home.sections.card_product_home')

       </div>
       @endforeach
     </div>
  </div>
  <script>
    $(".carousel_products_home").owlCarousel({
      loop: true,
      margin: 5,
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
          items: 4
        },
        1200: {
          items: 5
        }
      }
    })
  </script>


