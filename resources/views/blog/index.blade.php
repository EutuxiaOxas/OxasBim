@extends('layouts.app')


@section('content')
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
			<div class="col-2 offset-1 mt-4">
				<h3>Categorias</h3>
				@foreach($categorias as $categoria)
				<div>
					<a href="{{route('blog.category.show', $categoria->name)}}" class="">{{$categoria->name}}</a>
				</div>
				@endforeach
			</div>
		</div>
		
	</div>
@endsection