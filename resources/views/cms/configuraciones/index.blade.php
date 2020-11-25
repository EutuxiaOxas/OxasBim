@extends('cms.layout.main')
@section('title')
    Configuraciones
@endsection

@section('content')
<div>
	<h1>Configuraciones de la web</h1>
</div>
<section>
	<form method="POST" action="{{route('config.add')}}">
		@csrf
		<div class="row">
			@foreach($configuraciones as $configuracion)
				<div class="col-4 form-group">
					<h5>{{$configuracion->title}}</h5>
					<input class="form-control" type="text" name="{{$configuracion->title}}" value="{{$configuracion->content}}" required>
				</div>
			@endforeach
		</div>
		<input type="submit" class="btn btn-primary" value="Agregar">
	</form>
</section>
@endsection