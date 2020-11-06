<div class="owl-carousel owl-theme" id="destacados">
 @foreach($otros_products as $o_product)
  <div class="item">
  	<img src="{{asset('storage/'. $o_product->image)}}"  style="width: 100%; height: 30vh;">
  	<p>{{$o_product->title}}</p>
  	<p>precio: {{$o_product->price}} $</p>
  	<p>referencial: {{$o_product->price_reference}} $</p>
  </div>
  @endforeach

</div>
<script>
  $('#destacados').owlCarousel({
    loop: true,
    margin: 30,
    mouseDrag: true,
    nav: true,
    dots: false,
    navText: ['<img src="{{asset('icons/flecha.svg')}}" style="width: 25px;"/>', '<img src="{{asset('icons/flecha.svg')}}" style="width: 25px; transform: rotate(-180deg);"/>'],
    responsive: {
      0: {
        items: 1
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


