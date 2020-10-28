@extends('layouts.app')

@section('title')
	{{$product->title}}
@endsection

@section('content')
<div class="container">
	<div id="add_alert" style="display: none;" class="alert alert-success mt-3">Producto Agregado con éxito!</div>
	<div class="card mb-3 mt-2">
	  <img src="{{asset('storage/'.$product->image)}}" class="card-img-top" style="width: 100%; height: 50vh;object-fit: cover;" alt="...">
	  <div class="card-body">
	    <div class="row">
	    	<div class="col-6">
	    		<h5 class="card-title">{{$product->title}}</h5>
	    		<p class="card-text">{{$product->description}}.</p>
	    		<p class="card-text"><small class="text-muted">{{$product->price}}$</small></p>
	    		<p>Categoria: <strong>{{$product->category->title}}</strong></p>
	    		<input type="hidden" value="{{$product->slug}}">
	    	</div>
	    	<div class="col-6">
	    		<h5>Imagenes</h5>
	    		@foreach($product->images as $image)
	    			<img src="{{asset('storage/'.$image->image)}}" style="width: 70px; height: 60px; object-fit: cover;">
	    		@endforeach
	    	</div>
	    </div>
	    <div class="">
	    	@if(auth()->user())
	    		<button id="{{$product->id}}" class="btn btn-outline-success to_server">Agregar al carrito</button>
	    	@else
	    		<button id="{{$product->id}}" class="btn btn-outline-success ver_storage">Agregar al carrito</button>
	    	@endif
	    </div>
	  </div>
	</div>
</div>



@endsection