@extends('cms.layout.main')
@section('title')
    Tienda | Pedidos
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h2>Pedidos</h2>
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
            <th>Nombre</th>
          	<th>Total</th>
          	<th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pedidos as $pedido)
          <tr>
            <td>{{$pedido->id}}</td>
            <td>{{$pedido->name}}</td>
            <td>{{$pedido->total_amount}} $</td>
            <td>
            	<button type="button" id="{{$pedido->id}}" data-toggle="modal" data-target="#modalDetallesPedidos" class="btn btn-sm btn-outline-primary pedidos_detalle">Detalles</button>	
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</section>



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