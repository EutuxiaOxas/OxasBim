@extends('cms.layout.main')
@section('title')
    Ventas
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h2>Ordenes realizadas</h2>
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
          	<th>Usuario</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>Total</th>
          	<th>Estatus</th>
            <th>Fecha</th>
          	<th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $orden)
          <tr>
            <td>{{$orden->id}}</td>
            <td>{{$orden->user->name}}</td>
            <td>{{$orden->user->email}}</td>
            <td>{{$orden->user->phone}}</td>
            <td>{{$orden->total_amount}} $</td>
            <td>{{$orden->status}}</td>
            <td>{{$orden->created_at}}</td>
            <td>
            	<button id="{{$orden->id}}" data-toggle="modal" data-target="#modalDetalle" class="btn btn-sm btn-outline-primary orden-detalle">Ver Detalles</button>
              <button id="{{$orden->id}}" data-toggle="modal" data-target="#modalInfoEnvios" class="btn btn-sm btn-outline-primary orden-envio-info">
                Datos de envio
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="modal fade" id="modalDetalle" tabindex="-1" aria-labelledby="modalDetalle" aria-hidden="true">
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
</section>

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




<script type="text/javascript">
    let ordenDetails = document.querySelectorAll('.orden-detalle'),
        ordenEnvios = document.querySelectorAll('.orden-envio-info');

    if(ordenDetails){
        ordenDetails.forEach(detalle => {
            detalle.addEventListener('click', e => {
                let id = e.target.id
                getOrdenDetail(id)
            });
        });
    }

    if(ordenEnvios){
      ordenEnvios.forEach(button => {
        button.addEventListener('click', e => {
          let id = e.target.id
          getOrdenInfo(id)
        })
      })
    }

    function getOrdenDetail(id){
        axios.get(`/order/Detail/${id}`)
            .then(res => {
                modalInfo(res.data, id);
            })
    }

    function getOrdenInfo(id){
      axios.get(`/get/shiping-info/${id}`)
        .then(res => {
          console.log(res.data)
          modalEnvioInfo(res.data)
        })
    }


    function modalEnvioInfo(info){
      let container = document.getElementById('modal_info_container'),
          ordenId = document.getElementById('detalle_envio_id');

      container.innerHTML = '';

      ordenId.innerHTML = `Información de envio, Orden: #${info.orden_id}`

      container.innerHTML += `
          <div>Identidad: <strong>${info.documento_de_identidad}</strong></div>
          <div>Dirección 1: <strong>${info.direccion_1}</strong> </div>
          <div>Dirección 2: <strong>${info.direccion_2}</strong> </div>
          <div>Telefono: <strong>${info.telefono}</strong> </div>
          <div>Código postal: <strong>${info.codigo_postal}</strong> </div>
      `
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