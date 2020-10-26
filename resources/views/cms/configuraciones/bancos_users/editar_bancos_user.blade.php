@extends('cms.layout.main')
@section('title')
    Agregar Bancos
@endsection

@section('content')
<div class="d-flex justify-content-between mt-4 mb-3">
	<h1 class="">Agregar cuenta de banco</h1>
	<div>
		<a class="btn btn-outline-primary" href="{{route('bank.user.home')}}">Volver</a>
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


<form method="POST" action="{{route('bank.user.update', $cuenta->id)}}">
	@csrf
	<div class="form-group" id="title_container">
		<h5>Titulo del banco (<small>191</small>)</h5>
		<input class="form-control" type="text" value="{{$cuenta->title}}" maxlength="191" required name="title">
	</div>

	<div class="form-group">
		<h5>Número de cuenta</h5>
		<input class="form-control" type="number" value="{{$cuenta->number_account}}" required name="number_account">
	</div>

	<div class="form-group">
		<h5>Titular de la cuenta</h5>
		<input class="form-control" type="text" maxlength="191" value="{{$cuenta->titular}}" required name="titular">
	</div>
	
	<div class="form-group">
		<input type="submit" class="btn btn-primary" value="Actualizar cuenta">
	</div>
</form>

<script src="{{asset('js/string_length.js')}}"></script>

<script type="text/javascript">
	let padre = document.getElementById('title_container'),
		title = padre.children[1],
		contador = padre.children[0].children[0];
	
	document.addEventListener('DOMContentLoaded', () => {
		contador.textContent = changeCount(title.textLength, 191)
	})

	title.addEventListener('keyup', () => {
		let count = 191;

		contador.textContent = changeCount(title.textLength, count)
	});

</script>

@endsection