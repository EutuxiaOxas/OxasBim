@extends('layouts.app')

@section('title')
	{{$product->title}}
@endsection

@section('header')
	{{-- precargar imagenes --}}
	<link rel="preload" href="{{asset('storage/'.$product->image)}}" as="image">

	<!-- Primary Meta Tags -->
	<meta name="title" content="{{$product->title}}">
	<meta name="description" content="{{$product->title}} - ${{number_format($product->price, 2)}}">
@endsection
<style>
	body{
		background-color: #fff !important;
	}
	.container_img_second{
		display: flex;
		flex-direction:row;
	    justify-content: center;
	    align-items: center;
        max-height: 13vh;
        min-height: 13vh;
        max-width:100%;

		border-radius: 4px;
		border: #ddd solid 1px;
        overflow: hidden;
	}
	.img_second_detail{
		min-height: auto;
        max-height: 13vh;
        min-width: auto;
        max-width: 100%;
		opacity: 0.7;
	}
	.img_second_detail:hover{
		cursor: pointer;
		opacity: 1;
		transition: opacity 1s;
	}
	.container_img_product_principal{
		display: flex;
		flex-direction:row;
	    justify-content:center;
	    align-items: center;
        max-height: 95vh;
        min-height: 95vh;
        max-width:100%;

        overflow: hidden;
	}
	.img_product_detail{
		min-height: auto;
        max-height: 100%;
        min-width: auto;
        max-width: 100%;
	}
	.text-rubik{
        font-family: 'Rubik', sans-serif;
        font-weight: 300;
    }
	.categorie_product_detail{
		font-size: .8rem;
		color: #7d879c;
	}
	.title_product_detail{
		font-size: 2rem;
		font-weight: bold;
		color: #222;
	}
	.price_product_detail{
		font-size: 1.5rem;
		color:#4e54c8;
		font-weight: 400;
	}
	.price_product_detail_reference{
		font-size: 1.25rem;
		color:#7d879c;
		font-weight: 400;
		text-decoration: line-through;
	}
	.text_no_decoration:hover{
		text-decoration: none;
	}
	.select_quantity{
		height: 3rem !important;
		border-radius: 3px;
	}


	.btn-primary-product{
		background-color: #2782ea!important;
		border-radius: 3px;
		width: 100%;
		box-shadow: 0 0.5rem 1.125rem -0.5rem rgba(39, 130, 234,0.7);
		color: #fff!important;
		font-weight: 400!important;
		padding: 0.75rem 0!important;
	}
	.btn-primary-product:hover{
		background-color: #2480e9!important;
	}

	.btn-secondary-product{
		background-color: grey!important;
		border-radius: 3px;
		width: 100%;
		color: #fff!important;
		font-weight: 400!important;
		padding: 0.75rem 0!important;
	}
	.tag-available{
		background-color: #42d697;
		border-radius: 2px;
		color: #fff;
		padding: 0.35rem 1rem;
		font-weight: 400;
		box-shadow: 0 0.25rem 0.5rem -0.5rem rgba(66, 214, 151, 0.7);
	}
	.btn-collapse{
		outline: none!important;
		width: 100%;
		color:#222!important;
	}
	.btn-collapse:hover{
		text-decoration: none!important;
	}
	.btn-share{
		color:#4e54c8;
		width: 100%;
	}
	.btn-share:hover{
		text-decoration: none;
	}
	.title-description{
		font-size: 1.5rem;
	}


</style>

@section('content')
<div class="container mt-md-5">
	<div id="add_alert" style="display: none;" class="alert alert-success mt-3">Producto Agregado con éxito!</div>

	<div class="row">
		<div class="col-12 d-md-none order-2">
			<div class="row px-2 mb-4 justify-content-around">
				<div class="col-2 container_img_second">
					<div>
						<img class="img_second_detail sub_image" src="{{asset('storage/'.$product->image)}}" alt="Imagen {{$product->title}}">
					</div>
				</div>
				@foreach($product->images as $image)
				<div class="col-2 container_img_second">
					<div>
						<img class="img_second_detail sub_image" src="{{asset('storage/'.$image->image)}}" alt="Imagen Secundaria {{$product->title}}">
					</div>					
				</div>
	    		@endforeach
			</div>
		</div>
		<div class="col-1 d-none d-md-block order-1">
			<div class="row mb-2 container_img_second">
				<div class="">
					<img class="img_second_detail sub_image" src="{{asset('storage/'.$product->image)}}" alt="Imagen {{$product->title}}">
				</div>					
			</div>
			@foreach($product->images as $image)
				<div class="row mb-2 container_img_second">
					<div class="">
						<img class="img_second_detail sub_image" src="{{asset('storage/'.$image->image)}}" alt="Imagen Secundaria {{$product->title}}">
					</div>					
				</div>
	    	@endforeach
		</div>
		<div class="col-12 col-md-6 order-1 order-md-2">
			<div class="row container_img_product_principal">
				<div class="">
					<img class="img_product_detail" id="producto_imagen_principal" src="{{asset('storage/'.$product->image)}}" alt="{{$product->title}}">
				</div>
			</div>					
		</div>
		<div class="col-12 col-md-5 order-3">
			<div class="row alings-itmes-center">
				<div class="col-auto">
					<div class="categorie_product_detail text-rubik">Categoria: <a class="text_no_decoration" href="{{route('product.category.show', $product->category->slug)}}"><strong class="text-secondary">{{$product->category->title}}</strong></a></div>
				</div>
				<div class="col-auto ml-auto">
					<span class="tag-available text-rubik">
						<svg class="pb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fff" width="20px" height="20px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm7 10c0 4.52-2.98 8.69-7 9.93-4.02-1.24-7-5.41-7-9.93V6.3l7-3.11 7 3.11V11zm-11.59.59L6 13l4 4 8-8-1.41-1.42L10 14.17z"/></svg>
						Producto disponible
					</span>
				</div>
			</div>
			<h5 class="title_product_detail text-rubik mt-2">{{$product->title}}</h5>
			<div class="text-rubik mt-3 mb-4">
				<span class="price_product_detail">${{number_format($product->price, 2)}}</span>
				<span class="price_product_detail_reference ml-2">${{number_format($product->price_reference, 2)}}</span>
			</div>	
			<input type="hidden" value="{{$product->slug}}">
			<div class="row">
				<div class="col-3 col-lg-2 pr-0">
						@if($product->quantity >= 10)
						    <select class="form-control select_quantity">
						        <option value="1">1</option>
						        <option value="2">2</option>
						        <option value="3">3</option>
						        <option value="4">4</option>
						        <option value="5">5</option>
						        <option value="6">6</option>
						        <option value="7">7</option>
						        <option value="8">8</option>
						        <option value="9">9</option>
						        <option value="10">10</option>
						    </select>
						@else
						    @php $contador = 1 @endphp
						    <select class="form-control select_quantity">
						        @while($contador <= $product->quantity)
						            <option value="{{$contador}}">{{$contador}}</option>
						            @php $contador += 1 @endphp
						        @endwhile
						    </select>
						@endif				
				</div>
				<div class="col-9 col-lg-10">
					@if($product->quantity > 0)
						@if(auth()->user())
						<button id="{{$product->id}}" class="btn btn-primary-product text-rubik to_server">Agregar al carrito</button>
						@else
						<button id="{{$product->id}}" class="btn btn-primary-product text-rubik ver_storage">Agregar al carrito</button>
						@endif
					@else
						<button class="btn btn-secondary-product text-rubik">Producto Agotado</button>
					@endif
				</div>
			</div>			
			<div class="row mt-4">
				<div class="col-12">
					<div class="accordion" id="accordionExample" style="width:100%;">
						<div class="card">
						  <div class="card-header" id="headingOne" style="padding: 0.5rem 1rem;">
							<h2 class="mb-0">
							  <button class="btn btn-link btn-collapse text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								<span class="text-rubik">
									<svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="20" fill="#505a6e"><path d="M0 0h24v24H0z" fill="none"/><path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
									Métodos de pago
								</span>
							  </button>
							</h2>
						  </div>
						  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
							<div class="card-body text-rubik">
							  @foreach($m_pagos as $pago)
							  	@if($loop->iteration > 1)
							  		<hr class="my-1"/>
							  	@endif
							  	  <div class="row">
							  		  <div class="col-8">
							  			<span class="text-rubik">{{$pago->content}}</span>
							  		  </div>
							  		  <div class="col-12">
							  			  <span class="text-muted">{{$pago->description}}</span>
							  		  </div>								
							  	  </div>
							  @endforeach				
							</div>
						   </div>
						</div>
						<div class="card">
						  <div class="card-header" id="headingTwo" style="padding: 0.5rem 1rem;">
							<h2 class="mb-0">
							  <button class="btn btn-link btn-collapse collapsed text-rubik text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								  <span class="text-rubik">
									<svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="20" fill="#505a6e"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19.5 8H17V6c0-1.1-.9-2-2-2H3c-1.1 0-2 .9-2 2v9c0 1.1.9 2 2 2 0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h1c.55 0 1-.45 1-1v-3.33c0-.43-.14-.85-.4-1.2L20.3 8.4c-.19-.25-.49-.4-.8-.4zM6 18c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm13.5-8.5l1.96 2.5H17V9.5h2.5zM18 18c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"/></svg>
									Envíos
								  </span>
							  </button>
							</h2>
						  </div>
						  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
							<div class="card-body">
							  @foreach($m_envios as $envio)
							  	@if($loop->iteration > 1)
							  		<hr class="my-1"/>
							  	@endif
							  	  <div class="row">
							  		  <div class="col-8">
							  			<span class="text-rubik">{{$envio->content}}</span>
							  		  </div>
							  		  <div class="col-12">
							  			  <span class="text-muted">{{$envio->description}}</span>
							  		  </div>								
							  	  </div>
							  @endforeach
							</div>
						  </div>
						</div>
					  </div>
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-12 text-rubik">
					<strong>Compartir:</strong>
				</div>
				<div class="col-4 px-1 px-lg-2">
					<a class="btn btn-outline-success btn-share text-rubik px-2 px-md-1 px-lg-2" href="#" id="facebook">
						<?xml version="1.0" encoding="iso-8859-1"?>
						<svg version="1.1" width="16px" heigth="16px" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							viewBox="0 0 155.139 155.139" style="enable-background:new 0 0 155.139 155.139;" xml:space="preserve">
						<g>
							<path id="f_1_" style="fill:#026ae3;" d="M89.584,155.139V84.378h23.742l3.562-27.585H89.584V39.184
								c0-7.984,2.208-13.425,13.67-13.425l14.595-0.006V1.08C115.325,0.752,106.661,0,96.577,0C75.52,0,61.104,12.853,61.104,36.452
								v20.341H37.29v27.585h23.814v70.761H89.584z"/>
						</g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
						Facebook
					</a>
				</div>
				<div class="col-4 px-1 px-lg-2">
					<a class="btn btn-outline-success btn-share text-rubik px-2 px-md-1 px-lg-2" href="#" id="whastapp">
						<?xml version="1.0" encoding="iso-8859-1"?>
						<svg class="icon-whastapp" width="16px" heigth="16px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
						<g>	<g>
								<path fill="#06d755" d="M440.164,71.836C393.84,25.511,332.249,0,266.737,0S139.633,25.511,93.308,71.836S21.473,179.751,21.473,245.263
									c0,41.499,10.505,82.279,30.445,118.402L0,512l148.333-51.917c36.124,19.938,76.904,30.444,118.403,30.444
									c65.512,0,127.104-25.512,173.427-71.836C486.488,372.367,512,310.776,512,245.263S486.488,118.16,440.164,71.836z
									M266.737,460.495c-38.497,0-76.282-10.296-109.267-29.776l-6.009-3.549L48.952,463.047l35.878-102.508l-3.549-6.009
									c-19.479-32.985-29.775-70.769-29.775-109.266c0-118.679,96.553-215.231,215.231-215.231s215.231,96.553,215.231,215.231
									C481.968,363.943,385.415,460.495,266.737,460.495z"/>
							</g></g><g>	<g>
								<path fill="#06d755" d="M398.601,304.521l-35.392-35.393c-11.709-11.71-30.762-11.71-42.473,0l-13.538,13.538
									c-32.877-17.834-60.031-44.988-77.866-77.865l13.538-13.539c5.673-5.672,8.796-13.214,8.796-21.236
									c0-8.022-3.124-15.564-8.796-21.236l-35.393-35.393c-5.672-5.672-13.214-8.796-21.236-8.796c-8.023,0-15.564,3.124-21.236,8.796
									l-28.314,28.314c-15.98,15.98-16.732,43.563-2.117,77.664c12.768,29.791,36.145,62.543,65.825,92.223
									c29.68,29.68,62.432,53.057,92.223,65.825c16.254,6.965,31.022,10.44,43.763,10.44c13.992,0,25.538-4.193,33.901-12.557
									l28.314-28.314c5.673-5.672,8.796-13.214,8.796-21.236S404.273,310.193,398.601,304.521z M349.052,354.072
									c-6.321,6.32-23.827,4.651-44.599-4.252c-26.362-11.298-55.775-32.414-82.818-59.457c-27.043-27.043-48.158-56.455-59.457-82.818
									c-8.903-20.772-10.571-38.278-4.252-44.599l28.315-28.314l35.393,35.393l-28.719,28.719l4.53,9.563
									c22.022,46.49,59.753,84.221,106.244,106.244l9.563,4.53l28.719-28.719l35.393,35.393L349.052,354.072z"/>
							</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
						Whatsapp
					</a>
				</div>
				<div class="col-4 px-1 px-lg-2">
					<a class="btn btn-outline-success btn-share text-rubik px-2 px-md-1 px-lg-2" href="#" id="twitter">
						<?xml version="1.0" encoding="iso-8859-1"?>
						<svg version="1.1" width="16px" heigth="16px" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
						<path style="fill:#03A9F4;" d="M512,97.248c-19.04,8.352-39.328,13.888-60.48,16.576c21.76-12.992,38.368-33.408,46.176-58.016
							c-20.288,12.096-42.688,20.64-66.56,25.408C411.872,60.704,384.416,48,354.464,48c-58.112,0-104.896,47.168-104.896,104.992
							c0,8.32,0.704,16.32,2.432,23.936c-87.264-4.256-164.48-46.08-216.352-109.792c-9.056,15.712-14.368,33.696-14.368,53.056
							c0,36.352,18.72,68.576,46.624,87.232c-16.864-0.32-33.408-5.216-47.424-12.928c0,0.32,0,0.736,0,1.152
							c0,51.008,36.384,93.376,84.096,103.136c-8.544,2.336-17.856,3.456-27.52,3.456c-6.72,0-13.504-0.384-19.872-1.792
							c13.6,41.568,52.192,72.128,98.08,73.12c-35.712,27.936-81.056,44.768-130.144,44.768c-8.608,0-16.864-0.384-25.12-1.44
							C46.496,446.88,101.6,464,161.024,464c193.152,0,298.752-160,298.752-298.688c0-4.64-0.16-9.12-0.384-13.568
							C480.224,136.96,497.728,118.496,512,97.248z"/>
						<g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>						
						Twitter
					</a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row justify-content-center mt-4">
		<div class="col-10">
			<h5 class="title-description text-rubik">Descripción</h5>
			<p class="mt-4 text-rubik">
				@php echo nl2br($product->description); @endphp.</p>
		</div>
	</div>

</div>
<hr>
<div class="container">
	<div class="row justify-content-center py-3">
		<h3 class="text-rubik">Tambien te podría interesar</h3>
	</div>
</div>

@include('common.other_products')



<script type="text/javascript">
	//-------- COMPARTIR CON REDES SOCIALES ------------
		const facebook = document.getElementById('facebook'),
		whastapp = document.getElementById('whastapp'),
		twitter = document.getElementById('twitter'),
		subImagenes = document.querySelectorAll('.sub_image');
	

		if(subImagenes){
			subImagenes.forEach(imagen => {
				imagen.addEventListener('click', e => {
					const imgPrincipal = document.getElementById('producto_imagen_principal')
					imgPrincipal.src = e.target.src
				})
			})
		}


		let dir = window.location;
		let dir2 = encodeURIComponent(dir);
		let tit = window.document.title;
		let tit2 = encodeURIComponent(tit);
	
		facebook.addEventListener('click', (e) => {
			e.preventDefault()
			url = `http://www.facebook.com/share.php?u=${dir2}&t=${tit2}`
			window.open(url, '','width=600,height=400,left=50,top=50')
		})
	
		twitter.addEventListener('click', (e) => {
			url= `http://twitter.com/?status=${tit2}%20${dir}`
			window.open(url, '', 'width=600,height=400,left=50,top=50')
		})
	
	
		whastapp.addEventListener('click', (e) => {
			e.preventDefault();

			location.href = `https://wa.me/?text=${encodeURIComponent(window.location)}`
		})
	
	
	</script>

@endsection