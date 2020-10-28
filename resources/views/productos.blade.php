@extends('layouts.app')

@section('title')
	Productos
@endsection

@section('content')
	<style type="text/css">
		.acordeon_container{
            max-height: 0;
            overflow: hidden;
            transition: all .1s linear;
        }

        .acordeon_container.active{
        	max-height: 10rem;
        }

        .arrow_class {
        	transition: all .1s ease;
        }

        .arrow_class.active{
        	transform: rotate(-90deg);
        }

        .sub_categorie_item{
        	list-style: none;
        	padding: 0;
        }

	</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-2" id="categories_container">
			<h3 class="my-4">Categorias</h3>
			@foreach($categorias as $categoria)
				@if($categoria->padre_id == 0)
					<div>
						<div class="d-flex justify-content-between" style="width: 70%">
							<a href="{{route('product.category.show', $categoria->slug)}}">{{$categoria->title}}</a>
							<img src="/icons/flecha.svg" class="arrow_class" width="15" style="cursor: pointer;">
						</div>
						<ul class="acordeon_container">
							@foreach($categorias as $cat_hijo)
								@if($cat_hijo->padre_id == $categoria->id)
									<li class="sub_categorie_item">
										<a href="{{route('product.category.show', $cat_hijo->slug)}}">{{$cat_hijo->title}}</a>
									</li>
								@endif
							@endforeach
						</ul>
					</div>
				@endif
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
					    <input type="text" value="{{$producto->slug}}" style="visibility: hidden;">
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

<script type="text/javascript">

	function openCloseSubCategories(container, arrow){
		container.classList.toggle('active')
		arrow.classList.toggle('active')
	}

	const categoryContainer = document.getElementById('categories_container')

	categoryContainer.addEventListener('click', e => {
		if(e.target.classList.contains('arrow_class')){
			let subCategoriesContainer = e.target.parentNode.parentNode.children[1]

			openCloseSubCategories(subCategoriesContainer, e.target)
		}
	})

	
</script>

@endsection