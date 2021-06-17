@extends('cms.layout.main')
@section('title')
    Banners
@endsection


@section('content')
    <section class="content-header">
        <div class="container-fluid pl-0">
            <div class="row mb-2 pl-0">
                <div class="col-sm-6 pl-0">
                    <h1 class="font-light">Configuración del home del sitio web</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('cms.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Página Web</li>
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
        <div class="alert alert-danger" style="display: none;" id="error_container">
        </div>
        @if (session('error'))
            <div class="alert alert-danger my-4" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success my-4" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
        @endif

        {{-- Logo  --}}
        <div class="row">
            <div class="col-12 col-md-6 px-0">
                <div class="card card-widget">
                    <div class="card-header">
                    <div class="user-block">
                        <span class="username ml-0">Logo del menu superior</span>
                    </div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                        <div class="col-4">
                            @if (isset($logo))
                            <img id="logo_image" src="{{ asset('storage/' . $logo->image) }}"
                                style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                            <img id="logo_image" src=""
                                style="width: 100%; height: 100%; object-fit: cover;">
                            @endif
                            </div>
                            <div class="col-8 text-center">
                            <form action="{{ route('banners.logo') }}" method="POST" id="form_logo" enctype="multipart/form-data">
                                @csrf
                                <label class="label_img" for="file_image">Seleccionar Imagen</label>
                                <input type="file" name="image" class="image_file" id="file_image" hidden>
                            </form>
                            <button type="button" id="guardar_submit" class="btn btn-primary btn-sm px-5 mt-3">Guardar</button>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                    </div>
                </div>
                </div>
        </div>
        {{-- Banner principal --}}
        <div class="row">
            <div class="col px-0">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Imagenes del banner principal</h3>
                        <a class="btn btn-primary btn-sm px-4 ml-5" href="{{ route('banners.create') }}">Nuevo Banner</a>
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 10%">Imagen</th>
                                <th style="width: 25%">Titulo</th>
                                <th style="width: 30%">Descripción</th>
                                <th style="width: 30%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $banner)
                                    <tr>
                                        <td>{{ $banner->id }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $banner->image) }}" width="50">
                                        </td>
                                        <td>{{ $banner->title }}</td>
                                        <td>{{ $banner->description }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('banners.show', $banner->id) }}"
                                                class="btn btn-outline-success btn-sm mr-1">Editar</a>
                                            @if ($banner->status == 1)
                                                <a href="{{ route('banners.desactive', $banner->id) }}"
                                                    class="btn btn-outline-success btn-sm mr-1">Ocultar</a>
                                            @elseif($banner->status == 0)
                                                <a href="{{ route('banners.active', $banner->id) }}"
                                                    class="btn btn-outline-info btn-sm mr-1">Mostrar</a>
                                            @endif
                                            <button type="button" id="{{ $banner->id }}" class="btn btn-outline-danger btn-sm eliminar"
                                                data-toggle="modal" data-target="#modalEliminar">Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Banners promocioanesl --}}
        <div class="row">
            <div class="col px-0">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Imagenes de publicidades</h3>
                    <a class="btn btn-primary btn-sm px-4 ml-5" href="{{ route('publicidad.create') }}">Nueva publicidad</a>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    </div>
                    </div>
                    <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 10%">Imagen</th>
                                <th style="width: 55%">Enlace</th>
                                <th style="width: 35%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($publicidades as $publicidad)
                                <tr>
                                    <td>{{ $publicidad->id }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $publicidad->image) }}" width="50">
                                    </td>
                                    <td>{{ $publicidad->link }}</td>
                                    <td class="d-flex">
                                        <a href="{{route('publicidad.show', $publicidad->id)}}" class="btn btn-outline-success btn-sm mr-1">Editar</a>
                                        <button type="button" id="{{ $publicidad->id }}" class="btn btn-outline-danger btn-sm eliminarPublicidad"
                                            data-toggle="modal" data-target="#modalEliminarPublicidad">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        {{$banners->links()}}

        <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Banner</h5>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="eliminar_submit" class="btn btn-danger">Eliminar Banner</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEliminarPublicidad" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Publicidad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="eliminar_publicidad" method="POST">
                            @csrf
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="eliminar_submit_publicidad" class="btn btn-danger">Eliminar publicidad</button>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            let eliminarButtons = document.querySelectorAll('.eliminar');
            let eliminarPublicidad = document.querySelectorAll('.eliminarPublicidad');
            let deleteSubmit = document.getElementById('eliminar_submit');
            let eliminar_submit_publicidad = document.getElementById('eliminar_submit_publicidad');
            let inputFile = document.querySelectorAll('.image_file');
            let image = document.getElementById('logo_image');

            let guardarSubmit = document.getElementById('guardar_submit'),
                errors = document.getElementById('error_container'),
                logoFile = document.getElementById('file_image'),
                formImage = document.getElementById('form_logo');


            guardarSubmit.addEventListener('click', () => {

                let alerts = [];

                errors.innerHTML = ''
                errors.style.display = 'none'


                if (logoFile.files.length <= 0) {
                    alerts.push('Debes cargar un logo');
                }

                if (alerts.length > 0) {
                    let alertsMain = document.createElement('ul')

                    alerts.forEach(alert => {
                        alertsMain.innerHTML += `
                      <li>${alert}</li>

                     `
                    });


                    errors.appendChild(alertsMain);
                    errors.style.display = 'block';

                } else {
                    formImage.submit();
                }


            });

            //borrar banner
            deleteSubmit.addEventListener('click', (e) => {
                let form = document.getElementById('eliminar_form');

                form.submit();
            });

            //borrar publicidad
            eliminar_submit_publicidad.addEventListener('click', (e) => {
                let form = document.getElementById('eliminar_publicidad');

                form.submit();
            });

            //cargar logo
            inputFile.forEach(input => {
                input.onchange = function(e) {

                    let reader = new FileReader();
                    reader.readAsDataURL(e.target.files[0]);

                    reader.onload = function() {
                        image.src = reader.result;
                    }

                }
            });

            //modal eliminar
            if (eliminarButtons) {
                eliminarButtons.forEach(buttons => {
                    buttons.addEventListener('click', (e) => {
                        let id = e.target.id
                        modalEliminar(id)
                    });
                });
            }

            //modal eliminar
            if (eliminarPublicidad) {
                eliminarPublicidad.forEach(buttons => {
                    buttons.addEventListener('click', (e) => {
                        let id = e.target.id
                        modalEliminarPublicidad(id)
                    });
                });
            }

            function modalEliminar(id) {
                let formEliminar = document.getElementById('eliminar_form');
                formEliminar.action = `/cms/eliminar/banner/${id}`;
            }

            function modalEliminarPublicidad(id) {
                let formEliminarPublicidad = document.getElementById('eliminar_publicidad');
                formEliminarPublicidad.action = `/cms/eliminar/publicidad/${id}`;
            }

        </script>
    @endsection
