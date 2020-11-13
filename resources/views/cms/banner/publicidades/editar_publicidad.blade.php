@extends('cms.layout.main')
@section('title')
    Editar Publicidad
@endsection


@section('content')
<section>
	<div>
		@if (session('message'))
        <div class="alert alert-success my-4" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
	</div>
	<div class="d-flex justify-content-between">
		<h2>Editar publicidada</h2>
		<div>
			<a href="{{route('banners.home')}}" class="btn btn-outline-primary">Volver</a>
		</div>
	</div>
	<form action="{{route('publicidad.update', $publicidad->id)}}" method="POST" enctype="multipart/form-data">
		@csrf
		@include('cms.banner.publicidades.formulario', ['form_name' => 'Actualizar publicidad'])
	</form>
</section>
@endsection