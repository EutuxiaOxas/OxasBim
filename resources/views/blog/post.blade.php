@extends('layouts.app')

@section('title')
	{{$post->title}}
@endsection


@section('content')

<section class="container">

	<div class="card mb-3 mt-4">
	  <img src="{{asset('storage/'.$post->picture)}}" style="height: 60vh; object-fit: cover;" class="card-img-top" alt="...">
	  <div class="card-body">
	    <h5 class="card-title">{{$post->title}}</h5>
	    <p class="card-text">{!!$post->content!!}</p>
	    <p class="card-text"><small class="text-muted">{{$post->date}}</small></p>
	  </div>
	</div>

	<div class="mt-2">
		<form action="" method="POST" class="mb-2">
			<input type="hidden" id="post_id" value="{{$post->id}}" name="article_id">
			<div class="row">
				<div class="form-group col-md-3">
					<input class="form-control" id="comment" type="text" name="comment" placeholder="Comentario">
				</div>
				<div class="col-md-3">
					<input type="submit" id="submit_button" class="btn btn-primary" value="Enviar">
				</div>
			</div>
		</form>
		<div>
			<h3>Comentarios</h3>
			<div id="comment_main">
				@foreach($comments as $comment)
					<p>{{$comment->comment}}</p>
				@endforeach
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	let submitButton = document.getElementById('submit_button'),
		post_id = document.getElementById('post_id'),
		comment = document.getElementById('comment');

	submitButton.addEventListener('click', e =>{
		e.preventDefault();

		sendComment(post_id.value, comment.value)
		comment.value = '';
	})





	function sendComment(post, comment)
	{
		axios.post(`/send/comment`, {
			comment: comment,
			article_id: post
		})
		.then(response => {
			if(response.status == 200)
			{
				addComment(comment)
			}
		})
	}



	function addComment(comment)
	{
		const container = document.getElementById('comment_main');

		container.innerHTML += `
			<p>${comment}</p>
		`
	}
</script>

@endsection