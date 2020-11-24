@extends('cms.layout.main')
@section('title')
    Tienda | Productos
@endsection

@section('content')


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Productos</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('cms.home')}}">Home</a></li>
            <li class="breadcrumb-item active">Tienda</li>
            <li class="breadcrumb-item active">Productos</li>
        </ol>
        </div>
        </div>
    </div>
</section>

<section class="container-fluid">
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    @endif
</section>

<div class="row">
    <div class="col px-0">
        <div class="card">
    <div class="card-header">
        <h3 class="card-title">Productos del sitio</h3>
        <a class="btn btn-primary btn-sm ml-5 px-5" href="{{route('tienda.product.create')}}">Nuevo Producto</a>
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
                <th style="width: 7%">Image</th>
                <th style="width: 40%">Titulo</th>
                <th style="width: 5%">Cantidad</th>
                <th style="width: 15%">Categoria</th>
                <th style="width: 10%">Precio</th>
                <th style="width: 20%">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
              <td><b>{{$producto->id}}</b> </td>
              <td>
                  <img src="{{asset('storage/'. $producto->image)}}" width="30">
              </td>
              <td>{{$producto->title}}</td>
              <td>{{$producto->quantity}}</td>              
              <td>{{$producto->category->title}}</td>
              <td>{{$producto->price}}</td>
              <td>
                  <a href="{{route('tienda.product.show', $producto->id)}}" class="btn btn-sm btn-outline-primary">Editar</a>
                  <button type="button" id="{{$producto->id}}" data-toggle="modal" data-target="#modalEliminar" class="btn btn-sm btn-outline-danger eliminar_product">Eliminar</button>	
              </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>
</div>
</div>
{{$productos->links()}}

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
                <p id="modal_message"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
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
                let id = e.target.id,
                    message = e.target.parentNode.parentNode.children[2].textContent;
                
                modalEliminar(id, message)
            });
        });
    }


    function modalEliminar(id, text)
    {
        let formEliminar = document.getElementById('eliminar_form'),
            message = document.getElementById('modal_message');

        formEliminar.action = `/cms/tienda/eliminar/producto/${id}`;
        message.innerHTML = `
            Producto: <strong>${text}</strong> </br>
            ¿Seguro que desea eliminar este producto?
        `
    }
</script>

@endsection