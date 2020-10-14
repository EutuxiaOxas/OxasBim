@extends('layouts.app')

@section('content')
<style type="text/css">
    .outofspace {
        margin: 0;
        padding: 0;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header">{{ __('Formulario de envio') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('shiping.store')}}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user_id}}">
                        <input type="hidden" name="orden_id" value="{{$orden->id}}">
                        @if(isset($formulario))
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Documento de identidad') }}</label>

                                <div class="col-md-6">
                                    <input id="documento_de_identidad" type="text" class="form-control @error('documento_de_identidad') is-invalid @enderror" name="documento_de_identidad" value="{{ $formulario->documento_de_identidad }}" required autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('dirección 1') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('apellido') is-invalid @enderror" name="direccion_1" value="{{ $formulario->direccion_1 }}" required >

                                    @error('direccion_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="direccion_2" class="col-md-4 col-form-label text-md-right">{{ __('dirección 2') }}</label>

                                <div class="col-md-6">
                                    <input id="direccion_2" type="text" class="form-control @error('email') is-invalid @enderror" name="direccion_2" value="{{ $formulario->direccion_2 }}" required >

                                    @error('direccion_2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                                <div class="col-md-6">
                                    <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ $formulario->telefono }}" required>

                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Código_postal') }}</label>

                                <div class="col-md-6">
                                    <input id="codigo_postal" type="text" class="form-control @error('codigo_postal') is-invalid @enderror" name="codigo_postal" value="{{$formulario->codigo_postal}}" required>
                                    @error('codigo_postal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Documento de identidad') }}</label>

                                <div class="col-md-6">
                                    <input id="documento_de_identidad" type="text" class="form-control @error('documento_de_identidad') is-invalid @enderror" name="documento_de_identidad" value="{{ old('documento_de_identidad') }}" required autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('dirección 1') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('apellido') is-invalid @enderror" name="direccion_1" value="{{ old('direccion_1') }}" required >

                                    @error('direccion_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="direccion_2" class="col-md-4 col-form-label text-md-right">{{ __('dirección 2') }}</label>

                                <div class="col-md-6">
                                    <input id="direccion_2" type="text" class="form-control @error('email') is-invalid @enderror" name="direccion_2" value="{{ old('direccion_2') }}" required >

                                    @error('direccion_2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                                <div class="col-md-6">
                                    <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required>

                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Código_postal') }}</label>

                                <div class="col-md-6">
                                    <input id="codigo_postal" type="text" class="form-control @error('codigo_postal') is-invalid @enderror" name="codigo_postal" required>
                                    @error('codigo_postal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif

    

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Continuar') }}
                                </button>
                                
                                <a href="{{route('orden.cancelar', $orden->id)}}" class="btn btn-outline-danger">Cancelar orden</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <h2>Productos comprados</h2>
            @php
                $total = 0;
            @endphp
            @foreach($ordenProducts as $ordenProduct)
            <div class="d-flex mt-3">
                <img src="{{asset('storage/'.$ordenProduct->product->image)}}" style="width: 70px; height: 70px; object-fit: cover;">
                <div class="ml-4">
                    <h5 class="outofspace">{{$ordenProduct->product->title}}</h5>
                    <p class="outofspace">Cantidad: {{$ordenProduct->quantity}}</p>
                    <p class="outofspace">Precio: {{$ordenProduct->price}} $</p>
                </div>
                <div class="ml-3">
                    <h5>Total: {{$ordenProduct->price * $ordenProduct->quantity}} $</h5>
                </div>
            </div>
            @php
                $productoTotal = $ordenProduct->price * $ordenProduct->quantity; 
                $total = $total + $productoTotal;
            @endphp
            @endforeach
            <div class="mt-3 text-center">
                <h3>Precio final:<strong> {{$total}} $</strong></h3> 
            </div>
        </div>
    </div>
</div>


@endsection
