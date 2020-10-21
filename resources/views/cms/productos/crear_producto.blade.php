@extends('cms.layout.main')
@section('title')
    Tienda | crear producto
@endsection


@section('content')
<div class="d-flex justify-content-between mt-4 mb-3">
	<h1 class="">Crear Producto</h1>
	<div>
		<a class="btn btn-outline-primary" href="{{route('tienda.product.home')}}">Volver</a>
	</div>
</div>
@if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
    </div>
@endif
<div id="errors_container" style="display: none;" class="alert alert-danger">
</div>
<input type="hidden" id="url_access" name="">	
<form action="{{route('tienda.product.store')}}" id="formulario_producto" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="row mt-5">
		<div class="form-group col-6">
			<h5>Titulo</h5>
			<input class="form-control" id="title" type="text" maxlength="191" autocomplete="off" name="title">
			<small id="slug_alert"></small>
		</div>
		<div class="form-group col-6">
			<h5>Precio</h5>
			<input class="form-control" id="price" type="number" name="price">
		</div>
		<div class="form-group col-12">
			<h5>Descripción</h5>
			<textarea class="form-control" id="description" name="description"></textarea>
		</div>
		<div class="form-group col-6">
			<h5>Categoria</h5>
			<select id="categoria" class="form-control" name="category_id">
				<option value="0">Selecciona una categoria</option>
				@foreach($categorias as $categoria)
					<option value="{{$categoria->id}}">{{$categoria->title}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-6">
			<h5>Imagen principal</h5>
			<input id="imagen" type="file" name="image">
		</div>
		<div class="form-group col-12">
			<h5>Imagenes secundarias</h5>
			<div>
				<input type="file" name="second_image[]">
			</div>
			<div>
				<input type="file" name="second_image[]">
			</div>
			<div>
				<input type="file" name="second_image[]">
			</div>
			<div>
				<input type="file" name="second_image[]">
			</div>
			<div>
				<input type="file" name="second_image[]">
			</div>
			<div>
				<input type="file" name="second_image[]">
			</div>
		</div>
		<div class="form-group col-12">
			<input type="submit" id="submitForm" class="btn btn-primary" value="Crear producto">
		</div>
	</div>
	<div class="col-12" style="visibility:  hidden;">
		<input class="form-control" id="slug" type="text" name="slug">
	</div>
</form>


<script type="text/javascript">
	let title = document.getElementById('title'),
		price = document.getElementById('price'),
		imagen = document.getElementById('imagen'),
		description = document.getElementById('description'),
		categoria = document.getElementById('categoria'),
		form = document.getElementById('formulario_producto'),
		errors_container = document.getElementById('errors_container'),
		verify_access = document.getElementById('url_access'),
		submit = document.getElementById('submitForm');

	submit.addEventListener('click', (e) => {
		e.preventDefault();

		let errors = []
		errors_container.innerHTML = '';
		errors_container.style.display = 'none'


		if(title.value === ''){
			errors.push('Debes agregar un titulo')
		}if(price.value == ''){
			errors.push('Debes agregar un precio')
		}if(description.value == ''){
			errors.push('Debes agregar una descripción')
		}if(categoria.selectedIndex === 0){
			errors.push('Debes escoger una categoria')
		}if(imagen.files.length <= 0){
			errors.push('Debes agregar una imagen')
		}if(verify_access.value == 0){
			errors.push('Debes utilizar un titulo permitido')
		}


		if(errors.length > 0){
			let error_main = document.createElement('ul')

			errors.forEach(error => {
				error_main.innerHTML += `
					<li>${error}</li>

				`
			});
			errors_container.innerHTML += `
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
			`
			errors_container.appendChild(error_main)
			errors_container.style.display = 'block';
		} else {
			form.submit();
		}

	});
</script>


<script type="text/javascript">
	let slug = document.getElementById('slug')
	title.addEventListener('keyup', (e) => {	
		let value = string_to_slug(e.target.value)
		slug.value = value
		if(title.value != ''){
			verifySlug(value);
		}else {
			let alert = document.getElementById('slug_alert').textContent = '';
		}
	});

	function verifySlug(value){
		axios.post(`/cms/productos/verify/${value}`)
			.then(res =>{
				if(res.data == 'aceptado'){
					slugAlert('aceptado')
				}else if(res.data == 'ocupado'){
					slugAlert('ocupado')
				}
			})
	}


	function slugAlert(value){
		let alert = document.getElementById('slug_alert');

		if(value == 'aceptado'){
			alert.textContent = 'Titulo permitido para su uso'
			alert.style.color = 'green';
			verify_access.value = 1
		}

		if(value == 'ocupado')
		{
			alert.textContent = 'Este titulo ya esta siendo utilizado, escoja un titulo diferente'
			alert.style.color = 'red';
			verify_access.value = 0
		}
	}

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