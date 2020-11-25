<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>@yield('title')</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/AdminLTE/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}">

  <!--datables CSS básico-->
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/datatables.min.css') }}" />
  <!--datables estilo bootstrap 4 CSS-->
  <link rel="stylesheet" type="text/css"
      href="{{ asset('vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}">

  <!-- Axios -->
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <script src="/AdminLTE/plugins/jquery/jquery.min.js"></script>
  <style>
  .label_img{
    cursor: pointer;
    color: #007bff;
  }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

<!-- IDENTIFICADOR SECCIÓN -->
<input type="hidden" id="seccion_name" value="{{$secName}}">

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-lightblue">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('cms.home')}}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <form action="/logout" id="logout_form" method="POST">
          @csrf
          <a href="#" onclick="document.getElementById('logout_form').submit()" class="nav-link">Cerrar Sesión</a>
        </form>
      </li>
      <!--li-- class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </!--li-->
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('cms.home')}}" class="brand-link">
      <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Usuario: {{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @if(auth()->user()->roles->title == 'administrador')
          <li class="nav-item ">
            <a href="{{ route('cms.users') }}" class="nav-link secciones usuarios ">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          @endif

          @if(auth()->user()->roles->title == 'editor' || auth()->user()->roles->title == 'administrador')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link secciones web">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Página web
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('banners.home')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home</p>
                </a>
              </li>
            </ul>
          </li> 
          @endif
          @if(auth()->user()->roles->title == 'inventario' || auth()->user()->roles->title == 'administrador')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link secciones tienda">
              <i class="nav-icon fas fa-store"></i>
              <p>
                Tienda
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('tienda.category.home')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categorias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('tienda.product.home')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('tienda.pedidos.home')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pedidos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('tienda.compradores')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compradores</p>
                </a>
              </li>
            </ul>
          </li> 
          @endif
          <li class="nav-item ">
            <a href="{{ route('config.home') }}" class="nav-link secciones configuraciones ">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Configuraciones
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <div class="content-wrapper">

    <section class="content">
      <div class="container-fluid">

        @yield('content')
      </div>
    </section>

  </div>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

</div>


<!-- Bootstrap -->
<script src="/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/AdminLTE/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="/AdminLTE/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="/AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="/AdminLTE/plugins/raphael/raphael.min.js"></script>
<script src="/AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="/AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js"></script>


<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        let name = document.getElementById('seccion_name'),
            enlaces =document.querySelectorAll('.secciones');

        changeColor(name.value, enlaces)

    });

    function changeColor(name, enlaces)
    {
        enlaces.forEach(enlace => {
            if(enlace.classList.contains(name))
            {
                enlace.classList.add('active');
            }
        });
    }
</script>

</body>
</html>
