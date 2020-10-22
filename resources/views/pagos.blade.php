@extends('layouts.app')

@section('title')
    Pago
@endsection

@section('content')
<style type="text/css">
    .outofspace {
        margin: 0;
        padding: 0;
    }
</style>
<div class="container">
    <div class="justify-content-center row">
        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header">{{ __('Confirmación de pago') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{route('pagos.store')}}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user_id}}">
                        <input type="hidden" name="orden_id" value="{{$orden->id}}">
                            <div class="form-group row">
                                <label for="id_banco_emisor" class="col-md-4 col-form-label text-md-right">{{ __('Banco emisor') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="id_banco_emisor">
                                        <option>Seleccionar un banco</option>
                                        @foreach($banks as $bank)
                                            <option value="{{$bank->id}}">{{$bank->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Banco receptor') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="id_banco_receptor">
                                        <option>Seleccionar un banco</option>
                                        @foreach($banksUsers as $bankUser)
                                            <option value="{{$bankUser->id}}">{{$bankUser->title}}</option>
                                        @endforeach
                                    </select>

                                    @error('direccion_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="total" class="col-md-4 col-form-label text-md-right">{{ __('Total a pagar') }}</label>
                                <div class="col-md-6">
                                    <input id="total" class="form-control" type="text" disabled value="{{$orden->total_amount}} $">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="monto" class="col-md-4 col-form-label text-md-right">{{ __('Monto') }}</label>

                                <div class="col-md-6">
                                    <input id="monto" type="integer" class="form-control @error('email') is-invalid @enderror" name="monto" value="{{ old('monto') }}" required >

                                    @error('direccion_2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fecha" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="date" name="fecha">

                                    @error('fecha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="referencia" class="col-md-4 col-form-label text-md-right">{{ __('Referencia') }}</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="number" name="referencia">
                                    @error('referencia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="titular_cuenta" class="col-md-4 col-form-label text-md-right">{{ __('Titular de la cuenta') }}</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="text" maxlength="191" name="titular_cuenta">
                                    @error('titular_cuenta')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="titular_cuenta" class="col-md-4 col-form-label text-md-right">{{ __('Documento de identidad titular') }}</label>

                                <div class="col-md-6">
                                    <input class="form-control" type="text" maxlength="191" name="documento_identidad_titular">
                                    @error('documento_identidad_titular')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

    

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Finalizar compra') }}
                                </button>
                                <a href="{{route('orden.cancelar', $orden->id)}}" class="btn btn-outline-danger">Cancelar orden</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
