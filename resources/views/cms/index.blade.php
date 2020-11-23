@extends('cms.layout.main')

@section('title')
    Dashboard
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('cms.home')}}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <div class="callout callout-info">
        <h5><i class="fas fa-info"></i> Administrador:</h5>
        Esta sección corresponde a la seccion administrativa del sitio web. Podrás editar los diferentes componentes del sitio web.
      </div>
@endsection
