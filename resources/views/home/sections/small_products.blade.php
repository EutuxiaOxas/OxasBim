
  <div class="owl-carousel owl-theme" id="small_products">
  @foreach($small_products as $small_product)
   <div class="item" itemscope itemtype="https://schema.org/Product">
     <div class="other_products_small">
      <a class="enlace_other" href="{{route('producto.show', $small_product->slug)}}" itemprop="url" aria-label="ir a ver el detalle del producto {{$producto->title}}">
        <img class="other_products_small_img" src="{{asset('storage/'.$small_product->image)}}" itemprop="image" alt="imagen de {{ $small_product->title }}">
      </a>
     </div>
   </div>
   @endforeach
  </div>

  <script>
  $('#small_products').owlCarousel({
  loop: true,
  margin: 10,
  mouseDrag: true,
  nav: false,
  dots: false,
  navText: ['<img src="{{asset('flecha.svg')}}" style="width: 25px;"/>', '<img src="{{asset('flecha.svg')}}" style="width: 25px; transform: rotate(-180deg);"/>'],
  responsive: {
    0: {
      items: 3
    },
    600: {
      items: 5
    },
    992: {
      items: 7
    }
  }
  })
  </script>
