@extends('cms.layout.main')
@section('title')
    Tienda | Compradores
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
        <h1 class="font-light">Compradores</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('cms.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Tienda</li>
            <li class="breadcrumb-item active">Compradores</li>
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
      <h3 class="card-title">Compradores</h3>
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
              <th style="width: 25%">Nombre y Apellido</th>
              <th style="width: 10%">Email</th>
              <th style="width: 30%">Fecha de compra</th>
              <th style="width: 30%">Detalle</th>
          </tr>
      </thead>
      <tbody>
        @foreach($compradores as $comprador)
            <tr>
            <td>{{$comprador->id}}</td>
            <td>{{$comprador->nombre}}</td>
            <td>{{$comprador->email}} </td>
            <td>
                @php
                   $Ndia = $comprador->created_at->format("N");
                   $dia = $dias[$Ndia];
                   $Nmes = $comprador->created_at->format("n");
                   $mes = $meses[$Nmes];
                   $fecha_dia = $comprador->created_at->format("d");

                   $fecha = $dia.' '.$fecha_dia.' de '.$mes;
                @endphp

                {{ $fecha }} -
                {{  $comprador->created_at->format("g:i a") }}

            </td>
            <td>
                <button type="button" id="{{$comprador->id}}" data-toggle="modal" data-target="#modalDetallesPedidos" class="btn btn-sm btn-outline-primary pedidos_detalle">Detalles</button>
            </td>
            </tr>
        @endforeach
      </tbody>
  </table>
</div>
</div>
</div>
</div>
{{$compradores->links()}}

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
                axios.get(`/cms/comprador/detail/${e.target.id}`)
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
