@extends('cms.layout.main')
@section('title')
    Blog | Articulos
@endsection


@section('content')
<section>
	<div class="d-flex justify-content-between">
		<h1>Blog Articulos</h1>
		<div>
			<a href="{{route('blog.article.create')}}"  class="btn btn-outline-primary">Crear Articulo</a>
		</div>
	</div>

	@if (session('error'))
	    <div class="alert alert-danger" role="alert">
	        {{ session('error') }}
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	          </button>
	    </div>
	@endif
	<div class="table-responsive">
	    <table class="table table-striped table-sm">
	        <thead>
	            <tr>
	                <th>#</th>
	                <th>Imagen</th>
	                <th>Titulo</th>
	                <th>Keywords</th>
	                <th>Autor</th>
	                <th>Categoria</th>
	                <th>Fecha</th>
	                <th>Acciones</th>
	            </tr>
	        </thead>
	        <tbody>
	            @foreach($articulos as $articulo)
	                <tr>
	                	<td>{{$articulo->id}}</td>
	                	<td>
	                		<img src="{{asset('storage/'.$articulo->picture)}}" width="50">
	                	</td>
	                	<td>{{$articulo->title}}</td>
	                	<td>
	                		@foreach($articulo->keywords as $k)
	                			{{$k->keyword}},
	                		@endforeach
	                	</td>
	                	<td>{{$articulo->author->name}}</td>
	                	<td>{{$articulo->category->name}}</td>
	                	<td>{{$articulo->date}}</td>
	                	<td>
	                		<a href="{{route('blog.article.show', $articulo->id)}}" class="btn btn-sm btn-outline-primary">Editar</a>
	                		<button type="button" id="{{$articulo->id}}" class="btn btn-sm btn-outline-primary comentarios" data-toggle="modal" data-target="#modalComentarios">Comentarios</button>
	                		<button type="button" id="{{$articulo->id}}" class="btn btn-sm btn-outline-danger eliminar_button" data-toggle="modal" data-target="#modalEliminar">Eliminar</button>
	                	</td>
	                </tr>
	            @endforeach
	        </tbody>
	    </table>
	</div>
</section>

<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Articulo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="eliminar_form" method="POST">
                    @csrf
                </form>
                <p id="name_article"></p>
                <p>¿Seguro que desea eliminar este articulo?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="eliminar_submit" class="btn btn-danger">Eliminar Articulo</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalComentarios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comentarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="comments_container">
                	
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
	let eliminarButtons = document.querySelectorAll('.eliminar_button');
	let eliminarSubmit = document.getElementById('eliminar_submit');

	eliminar_submit.addEventListener('click', () => {
		let form = document.getElementById('eliminar_form')

		form.submit();
	});


	if(eliminarButtons)
	{
		eliminarButtons.forEach(button => {
			button.addEventListener('click', (e) => {
				let form = document.getElementById('eliminar_form');

				let id = e.target.id,
					title_eliminar = document.getElementById('name_article');

				title_eliminar.innerHTML = `Articulo: <strong>${e.target.parentNode.parentNode.children[2].textContent}</strong>`;


				form.action = `/cms/eliminar/article/${id}`
			});
		});
	}
</script>


<script type="text/javascript">
	let commentsButtons = document.querySelectorAll('.comentarios');

	if(commentsButtons)
	{
		commentsButtons.forEach(button => {
			button.addEventListener('click', e => {
				let id = e.target.id
				getComment(id)
			});
		});
	}


//funciones axios comentarios
	function getComment(id)
	{
		axios.get(`/get/comments/${id}`)
			.then(response => {
				modalComment(response.data)
			})
	}


	function deleteComment(id, element)
	{
		axios.post(`/delete/comment/${id}`)
			.then(response => {
				if(response.status == 200)
				{
					element.remove();
				}
			});
	}


//funciones modales comentarios

	function modalComment(comments)
	{
		const container = document.getElementById('comments_container')
		container.innerHTML = '';


		comments.forEach( comment => {
			container.innerHTML += `
				<div class="d-flex mb-2 justify-content-between comment_modal">
					<p>${comment.comment}</p>
					<div>
						<a href="#" class="btn btn-outline-danger" id="${comment.id}">Eliminar</a>
					</div>
				</div>
			`
		});


		commentEvents()
	}

	function commentEvents()
	{
		let comment_container = document.querySelectorAll('.comment_modal');

		if(comment_container)
		{
			comment_container.forEach(comment => {
				comment.addEventListener('click', e => {
					if(e.target.textContent == 'Eliminar')
					{
						let id = e.target.id,
							element = e.target.parentNode.parentNode;

						deleteComment(id, element)
					}
				});
			});
		}
 	}
</script>

@endsection