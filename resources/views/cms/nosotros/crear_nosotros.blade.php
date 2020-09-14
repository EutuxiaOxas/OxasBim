@extends('cms.layout.main')
@section('title')
	Crear Seccion
@endsection

@section('content')

@if(session('message'))
    <div class="alert alert-success my-4" role="alert">
      {{session('message')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif

<div id="error_container" style="display: none;" class="alert alert-danger"></div>

<div class="d-flex justify-content-between my-3">
	<h1>
		Crear Sección
	</h1>
	<div>
		<a href="{{route('nosotros.home')}}" class="btn btn-outline-success">Volver</a>
	</div>
</div>
<section class="col-12 my-4">
	<form action="{{route('nosotros.store')}}" id="form" method="POST" enctype="multipart/form-data">
		@csrf
		<div  class="form-group">
			<h5>Titulo <small>(191)</small></h5>
			<input class="form-control" id="input_text" type="text" maxlength="191" name="title">
		</div>
		<div  class="form-group">
			<h5>Subtitle <small>(191)</small></h5>
			<input class="form-control" id="input_subtitle" type="text" maxlength="191" name="subtitle">
		</div>
		<div  class="form-group">
			<h5>Descripción</h5>
			<textarea class="form-control" id="description" name="description"></textarea>
		</div>
		<div  class="form-group">
			<h5>Imagen</h5>
			<input type="file" id="image" name="image">
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-success" id="button_submit" value="Crear Sección">
		</div>
	</form>
</section>


<script type="text/javascript">
	let input_text = document.getElementById('input_text'),
		input_subtitle = document.getElementById('input_subtitle'),
		description = document.getElementById('description'),
		imagen = document.getElementById('image'),
		error_container = document.getElementById('error_container'),
		form = document.getElementById('form'),
		submit = document.getElementById('button_submit');


	submit.addEventListener('click', e => {
		e.preventDefault();

		let errors = []
		error_container.innerHTML = '';
		error_container.style.display = 'none'

		if(input_text.value == '')
		{
			errors.push('Debes agregar un titulo')
		}

		if(input_subtitle.value == '')
		{
			errors.push('Debes agregar un subtitulo')
		}

		if(description.value == '')
		{
			errors.push('Debes agregar una descripción')
		}

		if(imagen.files.length <= 0)
		{
			errors.push('Debes agregar una imagen')
		}


		if(errors.length > 0)
		{
			let main_errors = document.createElement('ul');

			errors.forEach(error => {
				main_errors.innerHTML += `
					<li>${error}</li>
				`
			});
			error_container.appendChild(main_errors)
			error_container.style.display = 'block';
		}else {
			form.submit();
		}



	});

	input_text.addEventListener('keydown', (e) => {
		let contador = e.target.parentNode.children[0].children[0];
		
		contador.textContent = `(${191 - input_text.textLength})`
	});

	input_subtitle.addEventListener('keydown', (e) => {
		let contador = e.target.parentNode.children[0].children[0];
		
		contador.textContent = `(${191 - input_subtitle.textLength})`
	});
</script>
@endsection