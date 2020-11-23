@extends('cms.layout.main')
@section('title')
    Crear Publicidad
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
	<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Configuración del home del sitio web</h1>
            </div>
            <div class="col-auto ml-auto">
                <a class="btn btn-outline-info btn-sm px-5" href="{{ route('banners.home') }}">Volver</a>
            </div>
            </div>
        </div>
    </section>
	<form action="{{route('publicidad.store')}}" method="POST" enctype="multipart/form-data">
		@csrf
		@include('cms.banner.publicidades.formulario', ['form_name' => 'Crear publicidad'])
	</form>
</section>
@endsection