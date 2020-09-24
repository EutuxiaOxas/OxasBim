@extends('layouts.app')

@section('title')
	Productos
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class=" col-2">
			<h3 class="my-4">Categorias</h3>
			@foreach($categorias as $categoria)
				<div>
					<a href="{{route('product.category.show', $categoria->slug)}}">{{$categoria->title}}</a>
				</div>
			@endforeach
		</div>
		<div class="col-9">
			@if(isset($product_categorie))
			<h1 class="my-3">Productos en categoria: <small>{{$product_categorie->title}}</small></h1>
			@else
			<h1 class="my-3">Productos</h1>
			@endif
			<div class="d-flex" style="flex-wrap: wrap;">
				@foreach($productos as $producto)
					<div class="card mb-4 mr-1" style="width: 15rem;">
					  <img src="{{asset('storage/'. $producto->image)}}" style="height: 10rem; object-fit: cover;" class="card-img-top" alt="...">
					  <div class="card-body">
					    <h5 class="card-title">{{$producto->title}}</h5>
					    @if(strlen($producto->description) > 0 && strlen($producto->description) < 70)
					    	<p class="card-text">{{substr($producto->description, 0, 70)}} </p>
					    @elseif(strlen($producto->description) > 70)
					    	<p class="card-text">{{substr($producto->description, 0, 70)}} ...</p>
					    @endif
					    <p><small>{{$producto->price}} $</small></p>
					    <a href="{{route('producto.show', $producto->slug)}}" class="btn btn-primary">Ver producto</a>
					  </div>
					</div>
				@endforeach
			</div>
			<div class="mt-5">
				{{ $productos->links() }}
			</div>
		</div>
	</div>
</div>



@endsection