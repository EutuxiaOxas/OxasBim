@extends('cms.layout.main')
@section('title')
    Configuraciones
@endsection

@section('content')
<div class="d-flex justify-content-between">
	<h1>Configuraciones de la web</h1>
	<div>
		<button type="button" class="btn btn btn-outline-primary" data-toggle="modal" data-dismiss="modal" data-target="#modalConfiguracion">Agregar configuración</button>
	</div>
</div>

@if (session('message'))
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Éxito!</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
        {{ session('message') }}
    </div>
  </div>
@endif

<section>
	<form action="">
		<div class="row">
			@foreach($configuraciones as $configuracion)
				<div class="col-4 form-group">
					<input type="hidden" value="{{$configuracion->title}}">
					<h5>{{$configuracion->content}}</h5>
					<input class="form-control" disabled name="{{$configuracion->content}}" value="{{$configuracion->description}}" required>
					<div class="mt-2">
						<button type="button" id="{{$configuracion->id}}" class="btn btn-sm btn-outline-primary b-update" data-toggle="modal" data-dismiss="modal" data-target="#modalConfiguracionUpdate">Actualizar</button>
					</div>
				</div>
			@endforeach
		</div>
	</form>
</section>
	
<div class="modal fade" id="modalConfiguracion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar configuración</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errors_container" style="display: none;" class="alert alert-danger" role="alert">
                </div>

                <form action="{{route('config.add')}}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-group">
                    	<h5>Tipo de configuración</h5>
                    	<select name="title" class="form-control">
                    		<option value="PAGO">Método de Pago</option>
                    		<option value="ENVIO">Método de Envio</option>
                    	</select>
                    </div>
                    <div class="form-group">
                        <h5>Titulo</h5>
                        <input class="form-control" type="text" id="form_name" required maxlength="191" name="content" placeholder="Ingresar titulo">
                    </div>

                    <div class="form-group">
                        <h5>Descripción</h5>
                        <input class="form-control" type="text" required maxlength="191" name="description" placeholder="Ingresar descripcion">
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Guardar configuración">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalConfiguracionUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar configuración</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errors_container" style="display: none;" class="alert alert-secondary" role="alert">
                </div>

                <form action="{{route('config.update')}}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" id="id_configuracion_update" name="id">
                    <div class="form-group">
                    	<h5>Tipo de configuración</h5>
                    	<select name="title" id="tipo_config_update" class="form-control">
                    		
                    	</select>
                    </div>
                    <div class="form-group">
                        <h5>Titulo</h5>
                        <input class="form-control" id="tipo_config_titulo" type="text" id="form_name" required maxlength="191" name="content" placeholder="Ingresar titulo">
                    </div>

                    <div class="form-group">
                        <h5>Descripción</h5>
                        <input class="form-control" type="text" id="tipo_config_descripcion" required maxlength="191" name="description" placeholder="Ingresar descripcion">
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Actualizar configuración">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

	function agregarAlModal(elemento){
		let tipo = document.getElementById('tipo_config_update'),
			id = document.getElementById('id_configuracion_update'),
			titulo = document.getElementById('tipo_config_titulo'),
			descripcion = document.getElementById('tipo_config_descripcion');

		id.value = elemento.id

		if(elemento.tipo === 'whatsapp'){
			tipo.parentNode.style.display = 'none'
			tipo.innerHTML = ''
            descripcion.type = 'number'
		}else {
			tipo.parentNode.style.display = 'block'
			tipo.innerHTML = `
				<option value="PAGO" ${elemento.tipo === 'PAGO' ? 'selected' : ''}>Método de Pago</option>
				<option value="ENVIO" ${elemento.tipo === 'ENVIO' ? 'selected' : ''}>Método de Envio</option>
			`
            descripcion.type = 'text'
		}

		titulo.value = elemento.titulo
		descripcion.value = elemento.descripcion
	}

	const botonesActualizar = document.querySelectorAll('.b-update');

	if(botonesActualizar){
		botonesActualizar.forEach(boton => {
			boton.addEventListener('click', e => {
				let id = e.target.id,
					padre = e.target.parentNode.parentNode,
					tipo = padre.children[0].value,
					titulo = padre.children[1].textContent,
					descripcion = padre.children[2].value;

				let configuracion = {
					id,
					padre,
					tipo,
					titulo,
					descripcion
				}

				agregarAlModal(configuracion)
			})
		})
	}
</script>

@endsection