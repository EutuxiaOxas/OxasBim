<style>
  .text-rubik{
      font-family: 'Rubik', sans-serif;
      font-weight: 300;
  }
  .card:hover{
      box-shadow: 0 0.3rem 1.525rem -0.375rem rgba(0,0,0,0.1);
  }
  .card_product{
      display: flex;
      flex-direction:row;
    justify-content: center;
    align-items: center;
      max-height: 40vh;
      min-height: 40vh;
      max-width:100%;

      border-radius: 5px 5px 0 0;
      overflow: hidden;
  }
  .img_product{
      min-height: auto;
      max-height: 100%;
      min-width: auto;
      max-width: 100%;        
  }
  .text_categorie_card{
      font-size: 0.8rem;
      font-family: 'Rubik', sans-serif;
      font-weight: 400;
      margin-bottom: 0.2rem;
      color:#7d879c;
  }
  .text_categorie_card:hover{
      text-decoration: none;
      color: #4b566b;
      transition: color 0.5s;
  }
  .text_title_card_product{
      font-size: 1rem;
      font-family: 'Rubik', sans-serif;
      font-weight: 500;
      color: #373f50;
      text-decoration: none;
  }
  .text_title_card_product:hover{
      text-decoration: none;
      color: #0068cb;
      transition: color 0.5s;
  }
  .price_card_product{
      margin:0.25rem 0;
      font-size: 1.2rem;
      font-family: 'Rubik', sans-serif;
      font-weight: 400;
      color: #4e54c8 ;
  }
  .referencial_price_card_product{
      color:#7d879c;
      font-size: 1rem;
      font-family: 'Rubik', sans-serif;
      font-weight: 400;
      text-decoration: line-through;
  }
</style>
<div class="container">
  <div class="owl-carousel owl-theme" id="destacados">
    @foreach($otros_products as $o_product)
     <div class="item">
       {{-- Product Card --}}
				@include('common.card_other_products')
     </div>
     @endforeach
   </div>
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


