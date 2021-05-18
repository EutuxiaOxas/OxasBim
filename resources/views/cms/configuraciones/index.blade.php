@extends('cms.layout.main')
@section('title')
    Configuraciones
@endsection

@section('content')

@if (session('message'))
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">{{ session('message') }}</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
        </button>
      </div>
    </div>
  </div>
@endif

@if (session('error'))
  <div class="card card-danger">
    <div class="card-header">
      <h3 class="card-title">{{ session('error') }}</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
        </button>
      </div>
    </div>
  </div>
@endif
<section class="pt-3">
    <div class="row">
        <div class="col-12 col-md-6 px-0">
            <div class="card card-widget">
              <div class="card-header bg-success">
                <div class="user-block">
                  <span class="username ml-0">Número de Whatsapp</span>
                </div>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
              </div>
              <div class="card-body">

                <div class="row align-items-center">

                        <div class="col-8 form-group mb-0">
                            <input type="hidden" value="{{$whatsapp->title}}">
                            <input class="form-control text-success" type="text" disabled value="{{$whatsapp->description}}" id="whatsappNumber" required>
                        </div>
                        <button class="col-4 btn btn-outline-primary b-update" type="button" id="updateWhatsappButton" data-toggle="modal" data-dismiss="modal" data-target="#modalWhatsappUpdate">Actualizar</button>

                </div>

              </div>
              <div class="card-footer text-muted">
                  <small>Este será el numero al cual se redireccionrá al cliente hacer una compra.</small>
              </div>
            </div>
          </div>
    </div>
</section>

{{-- Modal Editar de Whatsapp --}}
<div class="modal fade" id="modalWhatsappUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar número de Whatsapp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errors_container" style="display: none;" class="alert alert-secondary" role="alert">
                </div>

                <form action="{{ route('config.update') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" id="" name="id" value="1">
                    <input type="hidden" id="" name="title" value="whatsapp">
                    <input type="hidden" id="" name="content" value="Whatsapp">


                    <div class="form-group">
                        <h5>Número de Whatsapp</h5>
                        <input class="form-control" type="text" id="whatsappNumberModal" required maxlength="191" name="description" placeholder="Ej: 584244554545">
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary px-3" value="Confirmar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

	const updateWhatsappButton = document.getElementById('updateWhatsappButton');

    updateWhatsappButton.addEventListener('click', e => {
        const whatsappNumber = document.getElementById('whatsappNumber');
        const whatsappNumberModal = document.getElementById('whatsappNumberModal');

        whatsappNumberModal.value = whatsappNumber.value;

    })
</script>

{{-- Metodos de pago --}}
<section>
    <div class="row">
        <div class="col px-0">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title mr-3">Métodos de pago</h3>
                  <button type="button" class="btn btn-sm btn-primary px-5" data-toggle="modal" data-dismiss="modal" data-target="#modalPayCreate">Agregar</button>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                  </div>
                </div>
                <div class="card-body p-0">
                  <table class="table table-striped projects">
                      <thead>
                          <tr>
                            <th style="width: 25%">Tipo</th>
                            <th style="width: 25%">Descripción</th>
                            <th style="width: 30%">Acciones</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($metodos_pago as $metodo_pago)
                        <tr>
                            <td class="content">{{ ucwords($metodo_pago->content) }}</td>
                            <td class="description">{{ $metodo_pago->description }}</td>
                            <td>
                                <button type="button" id="{{ $metodo_pago->id }}" class="btn btn-sm btn-primary editar"
                                    data-toggle="modal" data-target="#modalPayUpdate">Editar</button>
                                <button type="button" id="{{ $metodo_pago->id }}" class="btn btn-sm btn-danger eliminar"
                                    data-toggle="modal" data-target="#modalEliminar">Eliminar</button>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                </div>
                <div class="card-footer text-muted">
                    <small>Estos métodos de pago se mostrarán en los productos, a manera informativa</small>
                </div>
            </div>
        </div>
      </div>
</section>

{{-- Modal Agregar Pagos --}}
<div class="modal fade" id="modalPayCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-semibold" id="exampleModalLabel">Agregar método de pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errors_container" style="display: none;" class="alert alert-secondary" role="alert">
                </div>

                <form action="{{ route('config.add') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="title" value="PAGO">


                    <div class="form-group">
                        <h5>Titulo</h5>
                        <input class="form-control" type="text" required maxlength="191" name="content" placeholder="Ej: Transferencias bancarias">
                    </div>
                    <div class="form-group">
                        <h5>Descripción</h5>
                        <input class="form-control" type="text" required maxlength="191" name="description" placeholder="Ej: Mercantil, Banesco">
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary px-3" value="Confirmar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Editar de Pagos --}}
<div class="modal fade" id="modalPayUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-semibold" id="exampleModalLabel">Editar método de pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errors_container" style="display: none;" class="alert alert-secondary" role="alert">
                </div>

                <form action="{{ route('config.update') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id" id="idPayModal">
                    <input type="hidden" name="title" value="PAGO">


                    <div class="form-group">
                        <h5>Titulo</h5>
                        <input class="form-control" type="text" id="titlePayModal" required maxlength="191" name="content" placeholder="Ej: Transferencias bancarias">
                    </div>
                    <div class="form-group">
                        <h5>Descripción</h5>
                        <input class="form-control" type="text" id="descriptionPayModal" required maxlength="191" name="description" placeholder="Ej: Mercantil, Banesco">
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary px-3" value="Confirmar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    const editar = document.querySelectorAll('.editar');
    editar.forEach(boton => {
        boton.addEventListener('click', e => {
            const idPayModal = document.getElementById('idPayModal');
            const titlePayModal = document.getElementById('titlePayModal');
            const descriptionPayModal = document.getElementById('descriptionPayModal');

            const containerRoot = e.target.parentNode.parentNode;

            const content = containerRoot.querySelector('.content');
            const description = containerRoot.querySelector('.description');

            idPayModal.value = e.target.id;
            titlePayModal.value = content.textContent;
            descriptionPayModal.value = description.textContent;
        });
    });
</script>

{{-- Metodos de Envio --}}
<section>
    <div class="row">
        <div class="col px-0">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title mr-3">Métodos de envío</h3>
                  <button type="button" class="btn btn-sm btn-primary px-5" data-toggle="modal" data-dismiss="modal" data-target="#modalShippingCreate">Agregar</button>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                  </div>
                </div>
                <div class="card-body p-0">
                  <table class="table table-striped projects">
                      <thead>
                          <tr>
                            <th style="width: 25%">Tipo</th>
                            <th style="width: 25%">Descripción</th>
                            <th style="width: 30%">Acciones</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($metodos_envio as $metodo_envio)
                        <tr>
                            <td class="content">{{ ucwords($metodo_envio->content) }}</td>
                            <td class="description">{{ $metodo_envio->description }}</td>
                            <td>
                                <button type="button" id="{{ $metodo_envio->id }}" class="btn btn-sm btn-primary editShipping"
                                    data-toggle="modal" data-target="#modalShippingUpdate">Editar</button>
                                <button type="button" id="{{ $metodo_envio->id }}" class="btn btn-sm btn-danger eliminar"
                                    data-toggle="modal" data-target="#modalEliminar">Eliminar</button>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                </div>
                <div class="card-footer text-muted">
                    <small>Estos métodos de envío se mostrarán en los productos, a manera informativa</small>
                </div>
            </div>
        </div>
      </div>
</section>

{{-- Modal Agregar Envio --}}
<div class="modal fade" id="modalShippingCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-semibold" id="exampleModalLabel">Agregar método de envío</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errors_container" style="display: none;" class="alert alert-secondary" role="alert">
                </div>

                <form action="{{ route('config.add') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="title" value="ENVIO">


                    <div class="form-group">
                        <h5>Titulo</h5>
                        <input class="form-control" type="text" required maxlength="191" name="content" placeholder="Ej: Transferencias bancarias">
                    </div>
                    <div class="form-group">
                        <h5>Descripción</h5>
                        <input class="form-control" type="text" required maxlength="191" name="description" placeholder="Ej: Mercantil, Banesco">
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary px-3" value="Confirmar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Editar Envio --}}
<div class="modal fade" id="modalShippingUpdate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-semibold" id="exampleModalLabel">Editar método de envío</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errors_container" style="display: none;" class="alert alert-secondary" role="alert">
                </div>

                <form action="{{ route('config.update') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id" id="idShippingModal">
                    <input type="hidden" name="title" value="ENVIO">


                    <div class="form-group">
                        <h5>Titulo</h5>
                        <input class="form-control" type="text" id="titleShippingModal" required maxlength="191" name="content" placeholder="Ej: Transferencias bancarias">
                    </div>
                    <div class="form-group">
                        <h5>Descripción</h5>
                        <input class="form-control" type="text" id="descriptionShippingModal" required maxlength="191" name="description" placeholder="Ej: Mercantil, Banesco">
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary px-3" value="Confirmar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const editShipping = document.querySelectorAll('.editShipping');
    editShipping.forEach(boton => {
        boton.addEventListener('click', e => {
            const idShippingModal = document.getElementById('idShippingModal');
            const titleShippingModal = document.getElementById('titleShippingModal');
            const descriptionShippingModal = document.getElementById('descriptionShippingModal');

            const containerRoot = e.target.parentNode.parentNode;

            const content = containerRoot.querySelector('.content');
            const description = containerRoot.querySelector('.description');

            idShippingModal.value = e.target.id;
            titleShippingModal.value = content.textContent;
            descriptionShippingModal.value = description.textContent;
        });
    });
</script>

{{-- Modal eliminar --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/cms/configuraciones/delete" id="eliminar_form" method="POST">
                <div class="modal-body">
                    <div id="eliminar_user">
                        ¿Estas seguro que deseas eliminar este elemento?
                    </div>
                    <input type="hidden" name="id" id="idDeleteModal">
                    @csrf
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Confimar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Eliminar elementos --}}
<script>
    const eliminar = document.querySelectorAll('.eliminar');
    eliminar.forEach(boton => {
        boton.addEventListener('click', e => {
            const idDeleteModal = document.getElementById('idDeleteModal');

            const idElement = e.target.id;
            idDeleteModal.value = idElement;
        });
    });
</script>

@endsection
