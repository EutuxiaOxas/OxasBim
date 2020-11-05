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
		opacity: 0.75;
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
</style>

@section('content')
<div class="container mt-5">
	<div id="add_alert" style="display: none;" class="alert alert-success mt-3">Producto Agregado con éxito!</div>

	<div class="row">
		<div class="col-1">
			<div class="row mb-2">
				<div class="container_img_second">
					<img class="img_second_detail" src="{{asset('storage/'.$product->image)}}" alt="Imagen {{$product->title}}">
				</div>					
			</div>
			@foreach($product->images as $image)
				<div class="row mb-2">
					<div class="container_img_second">
						<img class="img_second_detail" src="{{asset('storage/'.$image->image)}}" alt="Imagen Secundaria {{$product->title}}">
					</div>					
				</div>
	    	@endforeach
		</div>
		<div class="col-7">
			<div class="row">
				<div class="container_img_product_principal">
					<img class="img_product_detail" src="{{asset('storage/'.$product->image)}}" alt="{{$product->title}}">
				</div>
			</div>					
		</div>
		<div class="col-4">
			<h5 class="card-title">{{$product->title}}</h5>
			
	    		<p class="card-text"><small class="text-muted">{{$product->price}}$</small></p>
	    		<p>Categoria: <strong>{{$product->category->title}}</strong></p>
	    		<input type="hidden" value="{{$product->slug}}">
	    		<p>Referencial: {{$product->price_reference}} $</p>
	    		<select class="form-control mb-3">
	    			<option value="1">Seleccionar cantidad</option>
	    			<option value="1">1</option>
	    			<option value="2">2</option>
	    			<option value="3">3</option>
	    			<option value="4">4</option>
	    			<option value="5">5</option>
				</select>
				<div class="">
					@if(auth()->user())
						<button id="{{$product->id}}" class="btn btn-outline-success to_server">Agregar al carrito</button>
					@else
						<button id="{{$product->id}}" class="btn btn-outline-success ver_storage">Agregar al carrito</button>
					@endif
				</div>
		</div>
	</div>
	
	<div class="row justify-content-center">
		<div class="col-10">
			<h5>Descripcion</h5>
			<p class="">{{$product->description}}.</p>
		</div>
		
	</div>

</div>
<hr>

@include('common.other_products')



@endsection