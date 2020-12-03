
<div class="owl-carousel owl-theme" id="destacados">
@foreach($publicidades as $publicidad)
 <div class="item">
    <a href="{{$publicidad->link}}" target="_blank">
        <img src="{{asset('storage/'.$publicidad->image)}}" style="width: 350px; height: 350px; object-fit: cover;">
    </a>
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
  }
}
})
</script>