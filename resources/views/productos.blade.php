@extends('layouts.app')


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class=" col-2">
			<h3 class="my-4">Categorias</h3>
			@foreach($categorias as $categoria)
				<div>
					<a href="#">{{$categoria->title}}</a>
				</div>
			@endforeach
		</div>
		<div class="col-9">
			<h1 class="my-3">Productos</h1>
			<div class="d-flex">
				@foreach($productos as $producto)
					<div class="card mr-5" style="width: 18rem;">
					  <img src="{{asset('storage/'. $producto->image)}}" style="height: 10rem; object-fit: cover;" class="card-img-top" alt="...">
					  <div class="card-body">
					    <h5 class="card-title">{{$producto->title}}</h5>
					    <p class="card-text">{{$producto->description}}</p>
					    <p><small>{{$producto->price}} $</small></p>
					    <a href="#" class="btn btn-primary">Ver producto</a>
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