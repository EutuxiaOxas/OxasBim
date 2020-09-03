@extends('cms.layout.main')
@section('title')
    Blog | Articulos
@endsection


@section('content')
<section>
	<div class="d-flex justify-content-between">
		<h1>Blog Articulos</h1>
		<div>
			<a href="{{route('blog.article.create')}}"  class="btn btn-outline-success">Crear Articulo</a>
		</div>
	</div>

	@if (session('error'))
	    <div class="alert alert-danger" role="alert">
	        {{ session('error') }}
	    </div>
	@endif
	<div class="table-responsive">
	    <table class="table table-striped table-sm">
	        <thead>
	            <tr>
	                <th>#</th>
	                <th>Imagen</th>
	                <th>Titulo</th>
	                <th>Contenido</th>
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
	                	<td>{{$articulo->content}}</td>
	                	<td>{{$articulo->author->name}}</td>
	                	<td>{{$articulo->category->name}}</td>
	                	<td>{{$articulo->date}}</td>
	                	<td>
	                		<a href="{{route('blog.article.show', $articulo->id)}}" class="btn btn-outline-success">Editar</a>
	                		<button type="button" id="{{$articulo->id}}" class="btn btn-outline-danger eliminar_button" data-toggle="modal" data-target="#modalEliminar">Eliminar</button>
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
                <p>¿Seguro que desea eliminar este articulo?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="eliminar_submit" class="btn btn-danger">Eliminar Articulo</button>
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

				let id = e.target.id

				form.action = `/cms/eliminar/article/${id}`
			});
		});
	}
</script>

@endsection