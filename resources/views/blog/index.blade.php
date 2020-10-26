@extends('layouts.app')

@section('title')
	Blog | Articulos
@endsection

@section('content')
	<style type="text/css">
		.acordeon_container{
            max-height: 0;
            overflow: hidden;
            transition: all .2s linear;
        }

        .acordeon_container.active{
        	max-height: 10rem;
        }

        .arrow_class {
        	transition: all .3s ease;
        }

        .arrow_class.active{
        	transform: rotate(-90deg);
        }

        .sub_categorie_item{
        	list-style: none;
        	padding: 0;
        }

	</style>
	<div class="container">
		<div class="row">
			<div class="col-9">
				<h1 class="my-4">Posts disponibles</h1>
				@foreach($posts as $post)
					<div class="row mb-5">
						<div class="col-md-8">
							<img src="{{asset('storage/'.$post->picture)}}" style="width: 100%; height: auto; object-fit: cover;">
						</div>
						<div class="col-md-4 pt-4">
							<h2>{{$post->title}}</h2>
							<p>{!!substr($post->content,0, 200)!!} ...</p>
							<a href="{{route('blog.show', $post->slug)}}" class="btn btn-primary">Ver más</a>
						</div>
					</div>
				@endforeach
				{{ $posts->links() }}
			</div>
			<div class="col-2 offset-1 mt-4" id="categories_container">
				<h3>Categorias</h3>
				@foreach($categorias as $categoria)
				<div>
					@if($categoria->padre_id == 0)

						<div class="d-flex justify-content-between">
							<a href="{{route('blog.category.show', $categoria->slug)}}" title="{{$categoria->description}}" class="">{{$categoria->name}}</a>
							<img src="/icons/flecha.svg" class="arrow_class" width="15" style="cursor: pointer;">
						</div>

						<ul class="acordeon_container">
							@foreach($categorias as $cat_hijo)
								@if($cat_hijo->padre_id == $categoria->id)
									<li class="sub_categorie_item">
										<a href="{{route('blog.category.show', $cat_hijo->slug)}}">{{$cat_hijo->name}}</a>
									</li>
								@endif
							@endforeach
						</ul>
					@endif
				</div>
				@endforeach
				<h3 class="my-1">Keywords</h3>
				@foreach($keywords as $k)
				<div>
					<a href="{{route('blog.tag.show', $k->keyword)}}" class="">{{$k->keyword}}</a>
				</div>
				@endforeach
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