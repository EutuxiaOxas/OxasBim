@extends('cms.layout.main')
@section('title')
    Blog | Editar Articulo
@endsection


@section('content')
<section>
	<div class="d-flex justify-content-between">
		<h1>Editar Articulo</h1>
		<div>
			<a href="{{route('blog.articles')}}" class="btn btn-outline-primary">Volver</a>
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


	@if (session('message'))
	    <div class="alert alert-success" role="alert">
	        {{ session('message') }}
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	          </button>
	    </div>
	@endif

	<div style="display: none;" id="error_div" class="alert alert-danger"></div>
	<input type="hidden" id="articulo_id" value="{{$articulo->id}}">
	<input type="hidden" id="verify_access">
	<form method="POST" id="form" action="{{route('blog.article.update', $articulo->id)}}" enctype="multipart/form-data">
		@csrf
		<div class="form-group col-12">
			<h5>Titulo</h5>
			<input class="form-control" id="title" maxlength="191" value="{{$articulo->title}}" required type="text" name="title">
			<small style="display: none;" id="url_verify"></small>
		</div>

		<div class="form-group col-12">
			<h5>Keywords <small><strong>(agregar palabras claves separadas por coma)</strong></small></h5>
			<input class="form-control" id="title" maxlength="191" required type="text" name="clave" autocomplete="off" value="{{$keywords}}">
		</div>

		<div class="form-group col-12">
			<h5>Contenido</h5>
			<textarea class="ckeditor" id="content" name="content">{{$articulo->content}}</textarea>
		</div>

		<div class="form-group col-4">
			<h5>Fecha</h5>
			<input type="date" id="date" value="{{$articulo->date}}" name="date">
		</div>

		<div class="form-group col-12">
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
		<div class="form-group col-12" style="visibility: hidden;">
			<input class="form-control" id="url" maxlength="191" type="text" value="{{$articulo->slug}}" autocomplete="off" name="slug">
		</div>
	</form>
</section>

<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
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
			verify_access = document.getElementById('verify_access'),
			imagen = document.getElementById('picture');

		container.innerHTML = ''
		container.style.display = 'none'


		if(title.value == '')
		{
			errors.push('Debes colocar un titulo')
		}if(CKEDITOR.instances.content.getData() == '')
		{
			errors.push('Debes colocar un contenido')
		}if(categoria.selectedIndex == 0)
		{
			errors.push('Debes agregar una categoria')
		}if(fecha.value == "")
		{
			errors.push('Debes agregar una fecha')
		}if(verify_access.value == 0)
		{
			errors.push('Debes agregar un titulo valido')
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


<script type="text/javascript">
	//verificacion URL AMIGABLES 
	let input_title = document.getElementById('title'),
		url = document.getElementById('url');


	input_title.addEventListener('keyup', e => {
		let valor = string_to_slug(input_title.value);
		url.value = valor

		if(input_title.value != '')
		{
			verifySlug(valor)
		}else {
			let container = document.getElementById('url_verify');
			container.style.display = 'none'
		}
	});


	//llamada ajax para verificar
	function verifySlug(url)
	{
		let articulo_id = document.getElementById('articulo_id');
		axios.post(`/cms/blog/verify/${url}`, {
			article_id: articulo_id.value,
		})
		.then(res => {
			if(res.data == 1)
			{
				verifyMessage('aceptado')
			} else {
				verifyMessage('negado')
			}
		})
	}

	//cambio en el mensaje de verificacion
	function verifyMessage(status)
	{
		let container = document.getElementById('url_verify')
		verify_access = document.getElementById('verify_access');

		if(status == 'aceptado')
		{
			container.textContent = 'Titulo Permitido';
			container.style.color = 'green';
			verify_access.value = 1;
		}else if(status == 'negado')
		{
			container.textContent = 'Este titulo ya se encuentra en uso, escoja uno diferente';
			container.style.color = 'red';
			verify_access.value = 0;
		}

		container.style.display = 'block';
	}


	//funcion para transformar el titulo en url amigable
	function string_to_slug (str) {
	    str = str.replace(/^\s+|\s+$/g, ''); // trim
	    str = str.toLowerCase();
	  
	    // remove accents, swap ñ for n, etc
	    var from = "àáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
	    var to   = "aaaaaeeeeiiiioooouuuunc------";

	    for (var i=0, l=from.length ; i<l ; i++) {
	        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
	    }

	    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
	        .replace(/\s+/g, '-') // collapse whitespace and replace by -
	        .replace(/-+/g, '-'); // collapse dashes

	    return str;
	}
</script>


@endsection