<style>
    .other_products_small{
      display: flex;
          flex-direction:row;
          justify-content: center;
          align-items: center;
          max-height: 20vh;
          min-height: 20vh;
          max-width:100%;
  
          border-radius: 5px 5px 0 0;
          overflow: hidden;
    }
    .other_products_small_img{
      max-height: 100%;
      max-width: 100%; 
      min-height: auto;
      min-width: auto;    
    }
  </style>
  <div class="owl-carousel owl-theme" id="small_products">
  @foreach($small_products as $small_product)
   <div class="item other_products_small">
      <a href="{{$small_product->link}}">
          <img class="other_products_small_img" src="{{asset('storage/'.$small_product->image)}}">
      </a>
   </div>
   @endforeach
  </div>
  
  <script>
  $('#small_products').owlCarousel({
  loop: true,
  margin: 10,
  mouseDrag: true,
  nav: true,
  dots: false,
  navText: ['<img src="{{asset('icons/flecha.svg')}}" style="width: 25px;"/>', '<img src="{{asset('icons/flecha.svg')}}" style="width: 25px; transform: rotate(-180deg);"/>'],
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