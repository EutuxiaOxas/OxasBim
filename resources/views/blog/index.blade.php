@extends('layouts.app')


@section('content')
	<div class="container">
		<h1 class="my-4">Posts disponibles</h1>
		@foreach($posts as $post)
			<div class="row mb-4">
				<div class="col-md-5">
					<img src="{{asset('storage/'.$post->picture)}}" style="width: 100%; height: auto; object-fit: cover;">
				</div>
				<div class="col-md-4 pt-4">
					<h2>{{$post->title}}</h2>
					<p>{{$post->content}}</p>
					<a href="{{route('blog.show', $post->id)}}" class="btn btn-primary">Ver más</a>
				</div>
			</div>
		@endforeach
	</div>
@endsection