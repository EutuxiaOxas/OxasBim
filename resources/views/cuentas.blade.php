@extends('layouts.app')

@section('title')
	Cuentas Bancarias
@endsection

@section('content')
	<div class="container">
		<h1 class="my-3">Cuentas disponibles</h1>

		<div class="row row-cols-1 mb-5 row-cols-md-3">
		  @foreach($cuentas as $cuenta)
		  	<div class="col mb-4">
		  	  <div class="card" style="width: 18rem;">
		  	    <div class="card-body">
		  	      <h5 class="card-title">Cuenta: <strong>{{$cuenta->title}}</strong></h5>
		  	      <h6 class="card-subtitle my-2">Titular: <strong>{{$cuenta->titular}}</strong></h6>
		  	      <p class="card-text">Número de cuenta: <strong>{{$cuenta->number_account}}</strong></p>
		  	    </div>
		  	  </div>
		  	</div>
		  @endforeach
		</div>
		<div class="text-center">
			<a href="/pago?orden={{$orden->id}}" class="btn btn-primary mr-3">Pagar con transferencia bancaria</a>
			<a href="#" class="btn btn-success">Pagar con PayPal</a>
		</div>
	</div>
@endsection