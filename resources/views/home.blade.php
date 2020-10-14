@extends('layouts.app')

@section('title')
    Perfil | {{$user->name}}
@endsection

@section('content')
<div class="container mt-5">
    @if(session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card mb-5">
                <div class="card-header">{{ __('Perfil') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Has iniciado sesión') }}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Ordenes realizadas</div>
                <div class="card-body ">
                     @foreach($ordenes as $orden)
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <strong>Orden: #{{$orden->id}} | Estatus: {{$orden->status}} | Total: {{$orden->total_amount}} $ | Hace: {{$orden->created_at->diffForHumans()}}</strong>
                            </div>
                            <div>
                                <button id="{{$orden->id}}" data-toggle="modal" data-target="#modalDetalle" class="btn btn-sm btn-primary orden-detalle">Detalles</button>
                                <button id="{{$orden->id}}" data-toggle="modal" data-target="#modalInfoEnvios" class="btn btn-sm btn-outline-primary orden-envio-info">
                                  Datos de envio
                                </button>
                                <button id="{{$orden->id}}" data-toggle="modal" data-target="#modalPagos" class="btn btn-sm btn-outline-primary orden-pago-info">
                                  Información de pagos
                                </button>
                                @if($orden->pagos->count() <= 0)
                                <a href="{{route('orden.cancelar', $orden->id)}}" class="btn btn-sm btn-outline-danger">Cancelar orden</a>
                                @endif
                            </div>
                        </div>
                     @endforeach
                </div>
                {{ $ordenes->links() }}
            </div>
        </div>
    </div>

    <div>
        <div class="modal fade" id="modalDetalle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalles de orden</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 id="detalle_id" class="mb-3"></h3>
                        <div class="table-responsive">
                          <table class="table table-striped table-sm">
                            <thead>
                              <tr>
                                <th>Imagen</th>
                                <th>Titulo</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                              </tr>
                            </thead>
                            <tbody id="modal_container">
                            </tbody>
                          </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Dato de envio-->

    <div>
        <div class="modal fade" id="modalInfoEnvios" tabindex="-1" aria-labelledby="modalInfoEnvios" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalInfoEnvios">Detalles de envio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 id="detalle_envio_id" class="mb-3"></h3>
                        <div id="modal_info_container">
                          
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pagos-->
    <div>
        <div class="modal fade" id="modalPagos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información de pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="modal_pago_container">
                <div>
                    
                </div>
                <hr>
                <div class="d-flex mb-2" style="flex-wrap: wrap;">
                    
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
    </div>

</div>







<script src="{{asset('js/user_dashboard.js')}}"></script>


@endsection
