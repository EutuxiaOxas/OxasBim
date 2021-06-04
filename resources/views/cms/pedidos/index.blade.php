@extends('cms.layout.main')
@section('title')
    Tienda | Pedidos
@endsection

@php
    $meses = ['','Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    $dias = ['','Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab', 'Dom'];
@endphp

@section('content')
<section class="content-header">
    <div class="container-fluid pl-0">
        <div class="row mb-2 pl-0">
        <div class="col-sm-6 pl-0">
        <h1 class="font-light">Pedidos</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('cms.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Tienda</li>
            <li class="breadcrumb-item active">Pedidos</li>
        </ol>
        </div>
        </div>
    </div>
</section>

@if(session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
</div>
@endif

<div class="row">
  <div class="col px-0">
      <div class="card">
  <div class="card-header">
      <h3 class="card-title">Pedidos Creados</h3>
      <div class="card-tools">
    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
      <i class="fas fa-minus"></i></button>
  </div>
</div>
<div class="card-body p-0">
  <table class="table table-striped projects">
      <thead>
          <tr>
              <th style="width: 3%">#</th>
              <th style="width: 25%">Nombre</th>
              <th style="width: 10%">Total</th>
              <th style="width: 25%">Fecha</th>
              <th style="width: 20%">Acciones</th>
          </tr>
      </thead>
      <tbody>
        @foreach($pedidos as $pedido)
        <tr>
          <td>{{$pedido->id}}</td>
          <td>{{$pedido->name}}</td>
          <td>{{$pedido->total_amount}} $</td>
          <td>
            @php
                $Ndia = $pedido->created_at->format("N");
                $dia = $dias[$Ndia];
                $Nmes = $pedido->created_at->format("n");
                $mes = $meses[$Nmes];
                $fecha_dia = $pedido->created_at->format("d");

                $fecha = $dia.' '.$fecha_dia.' de '.$mes;
            @endphp

            {{ $fecha }} -
            {{  $pedido->created_at->format("g:i a") }}
            </td>
          <td>
            <button type="button" id="{{$pedido->id}}" data-toggle="modal" data-target="#modalDetallesPedidos" class="btn btn-sm btn-outline-primary pedidos_detalle">Detalles</button>
          </td>
        </tr>
        @endforeach
      </tbody>
  </table>
</div>
</div>
</div>
</div>
{{$pedidos->links()}}

<div class="modal fade" id="modalDetallesPedidos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles de Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                  <table class="table table-striped table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                      </tr>
                    </thead>
                    <tbody id="modal_detalle_body">

                    </tbody>
                  </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const detallesPedidos = document.querySelectorAll('.pedidos_detalle')

    if(detallesPedidos){
        detallesPedidos.forEach(detalle => {
            detalle.addEventListener('click', (e) => {
                axios.get(`/cms/pedidos/detalle/${e.target.id}`)
                    .then(res => {
                        llenarModalDetalles(res.data);
                    })
            })
        })
    }


    function llenarModalDetalles(productos){
        const container = document.getElementById('modal_detalle_body')
        container.innerHTML = '';
        if(productos.length > 0) {
            productos.forEach(producto => {
                container.innerHTML += `
                    <tr>
                        <td> ${producto.id} </td>
                        <td> <img src="/storage/${producto.image}" style="width: 40px;"> </td>
                        <td> ${producto.nombre} </td>
                        <td> ${producto.cantidad} </td>
                        <td> ${producto.precio} $</td>
                    </tr>
                `
            })
        }

    }
</script>

@endsection
