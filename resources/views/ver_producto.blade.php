@extends('layouts.app')

@section('title')
	{{$product->title}}

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
        max-height: 100%;
        min-width: auto;
        max-width: 100%;
		opacity: 0.6;
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
		box-shadow: 0 0.5rem 1.125rem -0.5rem 	rgba(39, 130, 234,0.7);
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
			<div class="row px-2 mb-4">
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
			<div class="row mb-2">
				<div class="container_img_second">
					<img class="img_second_detail sub_image" src="{{asset('storage/'.$product->image)}}" alt="Imagen {{$product->title}}">
				</div>					
			</div>
			@foreach($product->images as $image)
				<div class="row mb-2">
					<div class="container_img_second">
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
				<div class="col-2 pr-0">
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
				<div class="col-10">
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
				<div class="col-4 px-md-1 px-lg-2">
					<a class="btn btn-outline-success btn-share text-rubik px-2 px-md-1 px-lg-2" href="#" id="facebook">
						<img src="/icons/facebook.svg" style="width:16px;height:16px;">
						Facebook
					</a>
				</div>
				<div class="col-4 px-md-1 px-lg-2">
					<a class="btn btn-outline-success btn-share text-rubik px-2 px-md-1 px-lg-2" href="#" id="whastapp">
						<img src="/icons/whatsapp.svg" style="width:16px;height:16px;">
						Whatsapp
					</a>
				</div>
				<div class="col-4 px-md-1 px-lg-2">
					<a class="btn btn-outline-success btn-share text-rubik px-2 px-md-1 px-lg-2" href="#" id="twitter">
						<img src="/icons/twitter.svg" style="width: 16px;height: 16px;">
						Twitter
					</a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row justify-content-center mt-4">
		<div class="col-10">
			<h5 class="title-description text-rubik">Descripción</h5>
			<p class="mt-4 text-rubik">{{$product->description}}.</p>
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