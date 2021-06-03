
<div class="container-fluid px-2 px-md-4">
  <div class="owl-carousel owl-theme" id="destacados">
    @foreach($otros_products as $o_product)
     <div class="item py-1">
		@include('common.card_other_products')
     </div>
     @endforeach
   </div>
</div>
<script>
  $('#destacados').owlCarousel({
    loop: true,
    margin: 10,
    mouseDrag: true,
    nav: false,
    dots: false,
    navText: ['<img src="{{asset('icons/flecha.svg')}}" style="width: 25px;"/>', '<img src="{{asset('icons/flecha.svg')}}" style="width: 25px; transform: rotate(-180deg);"/>'],
    responsive: {
      0: {
        items: 2
      },
      500: {
        items: 3
      },
      767: {
        items: 4
      },
      997: {
        items: 5
      }
    }
  })
</script>


