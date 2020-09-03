@extends('cms.layout.main')
@section('title')
    Blog | Editar Articulo
@endsection


@section('content')
<section>
	<div class="d-flex justify-content-between">
		<h1>Editar Articulo</h1>
		<div>
			<a href="{{route('blog.articles')}}" class="btn btn-outline-success">Volver</a>
		</div>
	</div>

	@if (session('error'))
	    <div class="alert alert-danger" role="alert">
	        {{ session('error') }}
	    </div>
	@endif


	@if (session('message'))
	    <div class="alert alert-success" role="alert">
	        {{ session('message') }}
	    </div>
	@endif

	<div style="display: none;" id="error_div" class="alert alert-danger"></div>

	<form method="POST" id="form" action="{{route('blog.article.update', $articulo->id)}}" enctype="multipart/form-data">
		@csrf
		<div class="form-group col-4">
			<h5>Titulo</h5>
			<input class="form-control" id="title" maxlength="191" value="{{$articulo->title}}" required type="text" name="title">
		</div>

		<div class="form-group col-12">
			<h5>Contenido</h5>
			<textarea class="form-control" id="content" name="content">{{$articulo->content}}</textarea>
		</div>

		<div class="form-group col-4">
			<h5>Fecha</h5>
			<input type="date" id="date" value="{{$articulo->date}}" name="date">
		</div>

		<div class="form-group col-4">
			<h5>Categoria</h5>
			<select class="form-control" id="categoria" name="category_id">
				<option value="0">Selecciona una categoria</option>
				@foreach($categorias as $categoria)
					<option value="{{$categoria->id}}" <?php if($categoria->id == $articulo->category->id) echo 'selected' ?> >{{$categoria->name}}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group col-12">
			<h5>Image</h5>
			<input type="file" name="picture" id="picture">
		</div>
		<div class="col-12">
			<input type="submit" id="form_submit" class="btn btn-primary" value="Actualizar Articulo">
		</div>
	</form>
</section>


<script type="text/javascript">
	const submitButton = document.getElementById('form_submit')

	submitButton.addEventListener('click', (e) => {
		e.preventDefault();
		let form = document.getElementById('form');

		let verificacion = verificar()

		if(verificacion)
		{
			form.submit();
		}
	});
</script>

<script type="text/javascript">
	function verificar()
	{
		let container = document.getElementById('error_div');
		let errors = [];

		let title = document.getElementById('title'),
			content = document.getElementById('content'),
			categoria = document.getElementById('categoria'),
			fecha = document.getElementById('date'),
			imagen = document.getElementById('picture');

		container.innerHTML = ''
		container.style.display = 'none'


		if(title.value == '')
		{
			errors.push('Debes colocar un titulo')
		}if(content.value == '')
		{
			errors.push('Debes colocar un contenido')
		}if(categoria.selectedIndex == 0)
		{
			errors.push('Debes agregar una categoria')
		}if(fecha.value == "")
		{
			errors.push('Debes agregar una fecha')
		}

		if(errors.length > 0)
		{
			let error_main = document.createElement('ul')

			errors.forEach(error => {
				error_main.innerHTML += `
					<li>${error}</li>
				`
			});

			container.appendChild(error_main)
			container.style.display = 'block';

			return false;
		}else {
			return true;
		}



	}
</script>

@endsection