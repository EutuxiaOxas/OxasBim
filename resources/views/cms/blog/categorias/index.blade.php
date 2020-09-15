@extends('cms.layout.main')
@section('title')
    Blog | Categorias
@endsection


@section('content')
<section>
	<div class="d-flex justify-content-between">
		<h1>Blog Categorias</h1>
		<div>
			<button type="button" data-toggle="modal" data-target="#modalCrear" class="btn btn-outline-success">Crear Categoria</button>
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
	                <th>Titulo</th>
	                <th>Descripción</th>
	                <th>Acciones</th>
	            </tr>
	        </thead>
	        <tbody>
	            @foreach($categorias as $categoria)
	                <tr>
	                	<td>{{$categoria->id}}</td>
	                    <td>{{$categoria->name}}</td>
	                    <td>{{$categoria->description}}</td>
	                    <td>
	                    	<button id="{{$categoria->id}}" type="button" class="btn btn-outline-success editar_button" data-toggle="modal" data-target="#modalEditar">Editar</button>
	                    	<button id="{{$categoria->id}}" type="button" class="btn btn-outline-danger eliminar_button" data-toggle="modal" data-target="#modalEliminar">Eliminar</button>
	                    </td>
	                </tr>
	            @endforeach
	        </tbody>
	    </table>
	</div>
</section>

<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<div id="error_div" style="display: none;" class="alert alert-danger"></div>
                <form action="{{route('blog.categories.create')}}" id="crear_form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    	<h5>Titulo</h5>
                    	<input class="form-control" id="title_crear" required type="text" maxlength="191" name="name">
                    </div>
                    <div class="form-group">
                    	<h5>Descripción</h5>
                    	<textarea required class="form-control" id="description_crear" name="description"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="crear_submit" class="btn btn-primary">Crear Categoria</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<div id="error_editar" style="display: none;" class="alert alert-danger"></div>
                <form action="" id="editar_form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    	<h5>Titulo</h5>
                    	<input class="form-control" id="title_editar" required type="text" maxlength="191" name="name">
                    </div>
                    <div class="form-group">
                    	<h5>Descripción</h5>
                    	<textarea required class="form-control" id="description_editar" name="description"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="editar_submit" class="btn btn-primary">Actualizar Categoria</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="eliminar_form" method="POST">
                    @csrf
                </form>
                <p>Seguro que desea eliminar esta categoria?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="eliminar_submit" class="btn btn-danger">Eliminar Categoria</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
	
// --------------- BOTONES PARA SUBMIT DE FORMS -------------

	const crearButton = document.getElementById('crear_submit'),
		  editarButton = document.getElementById('editar_submit'),
		  eliminarButton = document.getElementById('eliminar_submit');

	crearButton.addEventListener('click', (e) => {
		e.preventDefault();
		let form = document.getElementById('crear_form');

		let verificacion = verificar()

		if(verificacion)
		{
			form.submit();
		}

	});


	editarButton.addEventListener('click', (e) => {
		e.preventDefault();
		let form = document.getElementById('editar_form');

		let verificacion = verificar('editar')

		if(verificacion)
		{
			form.submit();
		}

	});

	eliminarButton.addEventListener('click', () =>{
		let form = document.getElementById('eliminar_form');

		form.submit();
	});


</script>



<script type="text/javascript">
// --------------- BOTONES PARA ARBRIR MODALES -------------
	const editarButtons = document.querySelectorAll('.editar_button'),
		  eliminarButtons = document.querySelectorAll('.eliminar_button');


	


	if(editarButtons)
	{
		editarButtons.forEach(button => {
			button.addEventListener('click', (e) => {
				let form = document.getElementById('editar_form'),
					id = e.target.id,
					title = e.target.parentNode.parentNode.cells[1].textContent,
					description = e.target.parentNode.parentNode.cells[2].textContent;

				modalEditar(form,title,description,id)
			});
		});
	}



	if(eliminarButtons)
	{
		eliminarButtons.forEach(button => {
			button.addEventListener('click', (e) => {
				let id = e.target.id,
					message = e.target.parentNode.parentNode.cells[1].textContent,
					form = document.getElementById('eliminar_form');

				modalEliminar(form, id, message)
			});
		});
	}
</script>


<script type="text/javascript">

// --------------- FUNCION VERIFICAR -------------
	function verificar(text = '')
	{

		let errors = [];
		let title = document.getElementById('title_crear'),
				description = document.getElementById('description_crear'),
				error_container = document.getElementById('error_div');

		
		if(text == 'editar')
		{
			title = document.getElementById('title_editar')
			description = document.getElementById('description_editar')
			error_container = document.getElementById('error_editar')
		}


		error_container.style.display = 'none';
		error_container.innerHTML = ''

		if(title.value === '')
		{
			errors.push('Debes agregar un titulo')
		}if(description.value === '')
		{
			errors.push('Debes agregar una descripcion')
		}
		
		


		if(errors.length > 0)
		{
			let error_main = document.createElement('ul')

			errors.forEach(error => {
				error_main.innerHTML += `

					<li>${error}</li>

				`
			});

			error_container.appendChild(error_main);
			error_container.style.display = 'block';

			return false;
		}else {
			return true;
		}
	}


//------------ FUNCIONES PARA MODALES --------------

	function modalEditar(form,title,description,id){
		let title_editar = document.getElementById('title_editar'),
			description_editar = document.getElementById('description_editar');

		title_editar.value = title
		description_editar.value = description


		form.action = `/cms/editar/categoria/${id}`
	}


	function modalEliminar(form, id,message)
	{
		form.action = `/cms/eliminar/categoria/${id}`
		form.innerHTML += `<div>Categoria: <strong>${message}</strong></div>`
	}
</script>

@endsection