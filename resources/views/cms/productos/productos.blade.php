@extends('cms.layout.main')
@section('title')
    Tienda | Productos
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h2>Productos tienda virtual</h2>
    <div>
        <a class="btn btn-outline-success" href="{{route('tienda.product.create')}}">Crear Producto</a>
    </div>
</div>
<hr>
<section class="container-fluid">
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
          	<th>#</th>
            <th>Image</th>
          	<th>Titulo</th>
          	<th>Descripción</th>
            <th>Categoria</th>
          	<th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($productos as $producto)
          <tr>
            <td>{{$producto->id}}</td>
            <td>
                <img src="{{asset('storage/'. $producto->image)}}" width="30">
            </td>
            <td>{{$producto->title}}</td>
            <td>{{$producto->description}}</td>
            <td>{{$producto->category->title}}</td>
            <td>
            	<a href="{{route('tienda.product.show', $producto->id)}}" class="btn btn-outline-success">Editar</a>
            	<button type="button" id="{{$producto->id}}" data-toggle="modal" data-target="#modalEliminar" class="btn btn-outline-danger eliminar_product">Eliminar</button>	
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</section>



<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="eliminar_form" method="POST">
                    @csrf
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="eliminar_submit" class="btn btn-danger">Eliminar producto</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let eliminarButtons = document.querySelectorAll('.eliminar_product');
    let eliminarSubmit = document.getElementById('eliminar_submit');


    eliminarSubmit.addEventListener('click', () => {
        let formEliminar = document.getElementById('eliminar_form')

        formEliminar.submit();
    }); 

    if(eliminarButtons)
    {
        eliminarButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                id = e.target.id
                console.log(id)
                modalEliminar(id)
            });
        });
    }


    function modalEliminar(id)
    {
        let formEliminar = document.getElementById('eliminar_form')

        formEliminar.action = `/cms/tienda/eliminar/producto/${id}`;
    }
</script>

@endsection