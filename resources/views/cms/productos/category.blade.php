@extends('cms.layout.main')
@section('title')
    Tienda | Categorias
@endsection

@section('content')
<div class="d-flex justify-content-between">
  <h2>Categoria de productos</h2>
  <div>
    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalCrear">Crear Categoria</a>
  </div>
</div>
<hr>
<section class="container-fluid">
    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    @endif

   

    <h2 class="mt-4 mb-3">Categorias</h2>
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
          	<th>#</th>
          	<th>Titulo</th>
            <th>Categoria padre</th>
            <th>estatus</th>
          	<th>Descripción</th>
          	<th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categorias as $categoria)
          <tr>
            <td>{{$categoria->id}}</td>
            <td>{{$categoria->title}}</td>
            <td>

              @php $padre = $categoria->getFatherName() @endphp 
              {{$padre ? $padre->title : 'No tiene categoria padre'}}

            </td>
            <td>{{$categoria->status}}</td>
            <td>{{$categoria->description}}</td>
            <td>
            	<button type="button" id="{{$categoria->id}}" data-toggle="modal" data-target="#modalEditar" class="btn btn-sm btn-outline-primary editar_category">Editar</button>
            	<button type="button" id="{{$categoria->id}}" data-toggle="modal" data-target="#modalEliminar" class="btn btn-sm btn-outline-danger eliminar_category">Eliminar</button>	
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</section>


<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errors_container" style="display: none;" class="alert alert-danger" role="alert">
                </div>

                <input type="hidden" id="url_access" name=""> 
                <input type="hidden" id="url_access_modal" value="nada" name=""> 
                <form action="{{route('tienda.category.store')}}" id="form_create_category" method="POST" autocomplete="off">
                    @csrf
                    <div class="row">
                        
                        <div class="col-md-12 form-group px-1 mt-3">
                            <h5>Nombre</h5>
                            <input class="form-control" id="create_category_title" type="text" name="title" placeholder="Nombre" autocomplete="off" required>
                            <small id="slug_alert"></small>
                        </div>
                        <div class="col-md-12 form-group px-1">
                            <h5>Categoria padre <small>(opcional)</small></h5>
                            <select class="form-control" name="padre_id">
                              <option value="0">Seleccionar categoria padre</option>
                              <option value="0">Principal</option>
                              @foreach($categorias as $categoria)
                                @if($categoria->padre_id == 0)
                                  <option value="{{$categoria->id}}">{{$categoria->title}}</option>
                                @endif
                              @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 form-group px-1">
                            <h5>Descripción</h5>
                            <textarea class="form-control" id="create_category_description" name="description" placeholder="Descripción"></textarea>
                        </div>
                
                    </div>
                    <div class="form-group px-1 col-md-12" style="visibility: hidden; position: absolute;">
                      <h5>URL</h5>
                      <input class="form-control" id="slug" type="text" name="slug">
                    </div>
                </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="crear_category_submit" class="btn btn-primary">Actualizar Categoria</button>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errors_modal" style="display: none;" class="alert alert-danger" role="alert">
                </div>
                <form action="" id="editar_form" method="POST">
                    @csrf
                    <div class="form-group">
                        <h5>Nombre</h5>
                        <input id="editar_title" class="form-control" type="text" name="title"  autocomplete="off">
                        <small id="slug_alert_edit"></small>
                    </div>

                    <div class="form-group">
                        <h5>Categoria padre <small>(opcional)</small></h5>
                        <select id="cat_padre_editar" class="form-control" name="padre_id">
                          <option value="0">Seleccionar categoria</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <h5>Descripcion</h5>
                        <textarea class="form-control" id="editar_description" name="description"></textarea>
                    </div>
                    <div class="form-group" style="visibility: hidden;">
                      <h5>URL</h5>
                      <input class="form-control" id="slug_edit" type="text" name="slug">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="editar_submit" class="btn btn-primary">Actualizar Categoria</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="eliminar_form" method="POST">
                    @csrf
                </form>
                <p id="message_eliminar"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="eliminar_submit" class="btn btn-danger">Eliminar Categoria</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  let crearCategorySubmit = document.getElementById('crear_category_submit');
  let errors_container = document.getElementById('errors_container');

  crearCategorySubmit.addEventListener('click', (e) => {
    e.preventDefault()

    const title = document.getElementById('create_category_title'),
          description = document.getElementById('create_category_description'),
          form = document.getElementById('form_create_category');

    let verify_access = document.getElementById('url_access');

    let errors = [];
    errors_container.innerHTML = '';
    errors_container.style.display = 'none';


    if(title.value === ''){
      errors.push('Debe agregar un titulo')
    } if(description.value === ''){
      errors.push('Debe agregar una descripción');
    }if(verify_access.value == 0){
      errors.push('Debe agregar un titulo valido');
    }


    if(errors.length > 0) {
      let error_main = document.createElement('ul')

      errors.forEach(error => {
        error_main.innerHTML += `

          <li>${error}</li>
        `
      });

      errors_container.innerHTML += `
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      `

      errors_container.appendChild(error_main)
      errors_container.style.display = 'block';

    } else {
      form.submit();
    }




  });
</script>



<script type="text/javascript">
  let editarButtons = document.querySelectorAll('.editar_category');
  let eliminarButtons = document.querySelectorAll('.eliminar_category');


  let modalEditarSubmit = document.getElementById('editar_submit');
  let modalEliminarSubmit = document.getElementById('eliminar_submit');



  modalEditarSubmit.addEventListener('click', (e) => {

    e.preventDefault()


    let form = document.getElementById('editar_form'),
        title = document.getElementById('editar_title'),
        description = document.getElementById('editar_description'),
        errors_modal = document.getElementById('errors_modal');

    let verify_access_modal = document.getElementById('url_access_modal');


        let errors = []

        errors_modal.innerHTML = '';
        errors_modal.style.display = 'none';


        if(title.value === '')
        {
          errors.push('Debes colocar un titulo')
        } if (description.value === ''){
          errors.push('Debes colocar una description')
        }if(verify_access_modal.value == 0){
          errors.push('Debes colocar un titulo valido');
        }


        if(errors.length > 0){

          let error_main = document.createElement('ul')

          errors.forEach(error => {
            error_main.innerHTML += `

              <li>${error}</li>
            `
          });


          errors_modal.appendChild(error_main)
          errors_modal.style.display = 'block';
        } else {
          form.submit();
        }
  });

  modalEliminarSubmit.addEventListener('click', (e) => {
    let form = document.getElementById('eliminar_form');
    form.submit();
  });



  if(editarButtons)
  {
    editarButtons.forEach(button => {
      button.addEventListener('click', (e) => {
        let title = e.target.parentNode.parentNode.children[1].textContent,
            catPadre = e.target.parentNode.parentNode.children[2].innerText,
            description = e.target.parentNode.parentNode.children[3].textContent,
            id = e.target.id;

            axios.get(`/cms/tienda/get/category/${id}`)
              .then(res => {
                let slug = res.data.slug,
                    categorias = res.data.categorias;

                modalEditar(id,title,description, slug, categorias, catPadre);
              })

            
      });
    });
  }

  if(eliminarButtons)
  {
    eliminarButtons.forEach(button => {
      button.addEventListener('click', (e) => {
            id = e.target.id;
            let message = e.target.parentNode.parentNode.children[1].textContent
            modalEliminar(id, message)
      });
    });
  }


  function modalEditar(id, title, description, slug, categorias, padre){
    let input_title = document.getElementById('editar_title'),
        input_description = document.getElementById('editar_description'),
        edit_slug = document.getElementById('slug_edit'),
        cat_padre = document.getElementById('cat_padre_editar'),
        form = document.getElementById('editar_form');
    

    cat_padre.innerHTML = '<option value="0">Seleccionar categoria padre</option>'

    categorias.forEach(categoria => {
        cat_padre.innerHTML += `
          <option value="${categoria.id}" ${categoria.title == padre ? 'selected' : ''}>${categoria.title}</option>
        `
    })

    form.action = `/cms/tienda/actualizar/categoria/${id}`
    input_title.value = title
    input_description.value = description
    edit_slug.value = slug
  }

  function modalEliminar(id, message){
    let form = document.getElementById('eliminar_form'),
        message_eliminar = document.getElementById('message_eliminar');

    form.action = `/cms/tienda/eliminar/categoria/${id}`;
    message_eliminar.innerHTML = `
      Categoria: <strong>${message}</strong> <br>
      ¿Seguro que desea eliminar esta categoria?
    `
  }

</script>


<script type="text/javascript">
  let slug = document.getElementById('slug'),
      name_category = document.getElementById('create_category_title');


  let title_edit = document.getElementById('editar_title'),
      slug_edit = document.getElementById('slug_edit');



  title_edit.addEventListener('keyup', (e) =>{
    let value = string_to_slug(e.target.value)
    slug_edit.value = value

    if(title_edit.value != ''){
      verifySlug(value, 'editado');
    
    }else {
      let alert_edit = document.getElementById('slug_alert_edit');
    }
  })



  name_category.addEventListener('keyup', (e) => {  

    let value = string_to_slug(e.target.value)
    
    slug.value = value
    
    if(name_category.value != ''){
      verifySlug(value, 'normal');
    
    }else {
      let alert = document.getElementById('slug_alert').textContent = '';
    }
  });

  function verifySlug(value, option){
    axios.post(`/cms/categoria/verify/${value}`)
      .then(res =>{
        if(res.data == 'aceptado'){
          slugAlert('aceptado', option)
        }else if(res.data == 'ocupado'){
          slugAlert('ocupado', option)
        }
      })
  }


  function slugAlert(value, option){
    let alert = document.getElementById('slug_alert');
    let alert_edit = document.getElementById('slug_alert_edit');
    let verify_access = document.getElementById('url_access');
    let verify_access_modal = document.getElementById('url_access_modal');

    if(option == 'normal'){

      if(value == 'aceptado'){
        alert.textContent = 'Titulo permitido para su uso'
        alert.style.color = 'green';
        verify_access.value = 1;
      }

      if(value == 'ocupado')
      {
        alert.textContent = 'Este titulo ya esta siendo utilizado, escoja un titulo diferente'
        alert.style.color = 'red';
        verify_access.value = 0;
      }


    }else {
      if(value == 'aceptado'){
        alert_edit.textContent = 'Titulo permitido para su uso'
        alert_edit.style.color = 'green';
        verify_access_modal.value = 1;
      }

      if(value == 'ocupado')
      {
        alert_edit.textContent = 'Esta titulo ya esta siendo utilizado, escoja un titulo diferente'
        alert_edit.style.color = 'red';
        verify_access_modal.value = 0;
      }
    }
  }

  function string_to_slug (str) {
      str = str.replace(/^\s+|\s+$/g, ''); // trim
      str = str.toLowerCase();
    
      // remove accents, swap ñ for n, etc
      var from = "àáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
      var to   = "aaaaaeeeeiiiioooouuuunc------";

      for (var i=0, l=from.length ; i<l ; i++) {
          str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
      }

      str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
          .replace(/\s+/g, '-') // collapse whitespace and replace by -
          .replace(/-+/g, '-'); // collapse dashes

      return str;
  }
</script>

@endsection
