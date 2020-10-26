@extends('cms.layout.main')
@section('title')
    Ventas
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h2>Cuentas de Banco</h2>
    <div>
      <a href="{{route('bank.user.create')}}" class="btn btn-outline-primary">Agregar cuenta</a>
    </div>
</div>
<hr>
<section class="container-fluid">
    @if(session('error'))
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
            <th>Titular</th>
          	<th>Banco</th>
            <th>Cuenta</th>
          	<th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($banksUser as $bankUser)
          <tr>
            <td>{{$bankUser->id}}</td>
            <td>{{$bankUser->titular}}</td>
            <td>{{$bankUser->title}}</td>
            <td>{{$bankUser->number_account}}</td>
            <td>
            	<a href="{{route('bank.user.edit', $bankUser->id)}}" class="btn btn-sm btn-outline-primary">Editar</a>
              <a href="#" class="btn btn-sm btn-outline-danger">Eliminar</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</section>


@endsection