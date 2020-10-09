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
        <div class="col-md-8">
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ordenes realizadas</div>
                <div class="card-body ">
                     @foreach($ordenes as $orden)
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <strong>Orden: #{{$orden->id}} | Estatus: {{$orden->status}} | Total: {{$orden->total_amount}} $ | Hace: {{$orden->created_at->diffForHumans()}}</strong>
                            </div>
                            <button id="{{$orden->id}}" data-toggle="modal" data-target="#modalDetalle" class="btn btn-sm btn-primary orden-detalle">Detalles</button>
                        </div>
                     @endforeach
                </div>
                {{ $ordenes->links() }}
            </div>
        </div>
    </div>
</div>

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
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let ordenDetails = document.querySelectorAll('.orden-detalle');

    if(ordenDetails){
        ordenDetails.forEach(detalle => {
            detalle.addEventListener('click', e => {
                let id = e.target.id
                getOrdenDetail(id)
            });
        });
    }

    function getOrdenDetail(id){
        axios.get(`/order/Detail/${id}`)
            .then(res => {
                modalInfo(res.data, id);
            })
    }


    function modalInfo(detalles, orden){
        let orderId = document.getElementById('detalle_id'),
            container = document.getElementById('modal_container');

        container.innerHTML = ''
        orderId.textContent = `Orden: #${orden}`;

        detalles.forEach(detalle => {
            container.innerHTML += `
                <tr>
                  <td>
                      <img src="/storage/${detalle.img}" width="40">
                  </td>
                  <td>${detalle.title}</td>
                  <td>${detalle.cantidad}</td>
                  <td>${detalle.price}</td>
                </tr>
            `
        });
    }
</script>

@endsection
