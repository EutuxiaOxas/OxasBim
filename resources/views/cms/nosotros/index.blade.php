@extends('cms.layout.main')
@section('title')
	Nosotros
@endsection


@section('content')
	@if(session('error'))
	    <div class="alert alert-danger my-4" role="alert">
	      {{session('error')}}
	      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
	@endif

	@if(session('message'))
	    <div class="alert alert-success my-4" role="alert">
	      {{session('message')}}
	      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
	@endif


	<section class="row mt-5 mb-3">
		<div class="col-12	 d-flex justify-content-between">
			<h1>
				Nosotros
			</h1>
		</div>
	</section>

	

	<hr>

	<div>
		<h3>Banner principal</h3>
		<div class="row">
			<div class="col-4">
				@if(isset($banner))
					<img id="principal_image" src="{{asset('storage/'. $banner->image)}}" style="width: 100%; object-fit: cover;">
				@else
					<img id="principal_image" src="" style="width: 100%; object-fit: cover;">
				@endif
			</div>
			<div class="col-8">
				<form action="{{route('nosotros.store.banner')}}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-12 form-group">
							<h5>Titulo</h5>
							@if(isset($banner))
								<input class="form-control" type="text" value="{{$banner->title}}" name="title">
							@else
								<input class="form-control" type="text" name="title">
							@endif
						</div>
						<div class="col-12 form-group">
							<h5>Descripción</h5>
							@if(isset($banner))
								<textarea class="form-control" name="description">{{$banner->description}}</textarea>
							@else
								<textarea class="form-control" name="description"></textarea>
							@endif
						</div>
						<div class="col-12 form-group">
							<h5>Imagen</h5>
							<input type="file" id="file_principal" name="image">
						</div>

						<div class="col-12 form-group">
							@if(isset($banner))
								<input type="submit" class="btn btn-primary" value="Actualizar Banner">
							@else 
								<input type="submit" class="btn btn-primary" value="Crear Banner">
							@endif
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<section class="row my-4">
		<div class="col-12	 d-flex justify-content-between">
			<h3>
				Secciones nosotros
			</h3>
			<div>
				<a href="{{route('nosotros.create')}}" class="btn btn-outline-success">Crear Sección</a>
			</div>
		</div>
	</section>

	<section>
		<div class="table-responsive">
		  <table class="table table-striped table-sm">
		    <thead>
		      <tr>
		        <th>#</th>
		        <th>Imagen</th>
		        <th>Titulo</th>
		        <th>subtitle</th>
		        <th>Descripción</th>
		        <th>Acciones</th>
		      </tr>
		    </thead>
		    <tbody>
		      @foreach($secciones as $seccion)
		      <tr>
		        <td>{{$seccion->id}}</td>
		        <td>
		        	<img src="{{asset('storage/'. $seccion->image)}}" width="50">
		        </td>
		        <td>{{$seccion->title}}</td>
		        <td>{{$seccion->subtitle}}</td>
		        <td>{{substr($seccion->description, 0, 65)}} ...</td>
		        <td class="d-flex">
		          <a href="{{route('nosotros.show', $seccion->id)}}" class="btn btn-outline-success mr-2">editar</a>
		          <button type="button" id="{{$seccion->id}}" class="btn btn-outline-danger eliminar" data-toggle="modal" data-target="#modalEliminar">Eliminar</button>
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
	        <h5 class="modal-title" id="exampleModalLabel">Eliminar Sección</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="" id="eliminar_form" method="POST">
	        	@csrf
	        	<div id="modal_text"></div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
	        <button type="button" id="eliminar_submit" class="btn btn-danger">Eliminar Seccion</button>
	      </div>
	    </div>
	  </div>
	</div>


	<script type="text/javascript">
		let eliminarButtons = document.querySelectorAll('.eliminar');
		let deleteSubmit = document.getElementById('eliminar_submit');
		let image = document.getElementById('principal_image'),
			file = document.getElementById('file_principal');



		//borrar banner
		deleteSubmit.addEventListener('click', (e) => {
			let form = document.getElementById('eliminar_form');

			form.submit();
		});


		file.onchange = function(e) {

			let reader = new FileReader();
			reader.readAsDataURL(e.target.files[0]);

			reader.onload = function() {
			    image.src = reader.result;
			}
		}

		//modal eliminar
		if(eliminarButtons)
		{
			eliminarButtons.forEach(buttons => {
				buttons.addEventListener('click', (e) => {
					let id = e.target.id,
						text = e.target.parentNode.parentNode.children[2].textContent;
					modalEliminar(id, text)
				});
			});
		}


		function modalEliminar(id, text){
			let formEliminar = document.getElementById('eliminar_form'),
				textEliminar = document.getElementById('modal_text');

			textEliminar.innerHTML = `¿Seguro que desea eliminar la sección con titulo <strong>${text}</strong>?`;
			formEliminar.action = `/cms/nosotros/eliminar/${id}`;
		}
	</script>
@endsection
