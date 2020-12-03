<style>
  .img_container_others_banner{
    display: flex;
        flex-direction:row;
	    justify-content: center;
	    align-items: center;
        max-height: 45vh;
        min-height: 45vh;
        max-width:100%;

        border-radius: 5px 5px 0 0;
        overflow: hidden;
  }
  .img_others_banner{
    max-height: 100%;
    max-width: 100%; 
    min-height: auto;
    min-width: auto;    
  }
</style>
<div class="owl-carousel owl-theme" id="destacados">
@foreach($publicidades as $publicidad)
 <div class="item img_container_others_banner">
    <a href="{{$publicidad->link}}">
        <img class="img_others_banner" src="{{asset('storage/'.$publicidad->image)}}">
    </a>
 </div>
 @endforeach
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
  600: {
    items: 4
  },
  992: {
    items: 5
  }
}
})
</script>