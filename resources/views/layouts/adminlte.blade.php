<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sistema de Remuneraciones - Corporacion Altavida</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/dist/css/skins/_all-skins.min.css">
  @yield('css')
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>AV</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Corporación</b>Altavida</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{url('usuarios/fotos')}}/{{Auth::user()->id}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{url('usuarios/fotos')}}/{{Auth::user()->id}}" class="img-circle" alt="User Image">

                <p>
                  {{Auth::user()->name}}
                  <small id="miembroDesde"> </small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('profile') }}" class="btn btn-default btn-flat">Mis datos</a>
                </div>
                <div class="pull-right">
                  
                  <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Salir
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('usuarios/fotos')}}/{{Auth::user()->id}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{str_limit(Auth::user()->name,21)}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li>
          <a href="{{url('/home')}}">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li class="header" style="color:white;">Herramientas Administración</li>
        <!--
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{asset('templates/AdminLTE-master')}}/index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="{{asset('templates/AdminLTE-master')}}/index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li>
        -->
        
        <li>
          <a href="{{url('empleados')}}">
            <i class="fa fa-users"></i> <span>Empleados</span>
            <span class="pull-right-container">
              <!-- <small class="label pull-right bg-green">En desarrollo</small> -->
            </span>
          </a>
        </li>
        @if(Auth::user()->hasRole('admin'))
        <li>
          <a href="{{url('registros_horas')}}">
            <i class="fa fa-clock-o"></i> <span>Registro Horas</span>
            <span class="pull-right-container">
              <!-- <small class="label pull-right bg-green">En desarrollo</small> -->
            </span>
          </a>
        </li>
        <li>
          <a href="{{url('contratos')}}">
            <i class="fa fa-th"></i> <span>Contratos</span>
            <span class="pull-right-container">
              <!-- <small class="label pull-right bg-green">En desarrollo</small> -->
            </span>
          </a>
        </li>
        @endif
        <li>
          <a href="{{url('liquidaciones')}}">
            <i class="fa fa-files-o"></i> <span>Liquidaciones</span>
            <span class="pull-right-container">
              <!-- <small class="label pull-right bg-green">En desarrollo</small> -->
            </span>
          </a>
        </li>
        <li>
          <a href="{{ url('isapres') }}">
            <i class="fa fa-calendar"></i> <span>Isapres</span>
            <span class="pull-right-container">
              <!-- <small class="label pull-right bg-green">En desarrollo</small> -->
            </span>
          </a>
        </li>
        <li>
          <a href="{{ url('afps') }}">
            <i class="fa fa-envelope"></i> <span>AFP's</span>
            <span class="pull-right-container">
              <!-- <small class="label pull-right bg-green">En desarrollo</small> -->
            </span>
          </a>
        </li>
        
        
        <li><a href="#"><i class="fa fa-book"></i> <span class="pull-right-container">
              <small class="label pull-right label-default">Pronto</small>
            </span><span>Documentación</span></a></li>
        @if(Auth::user()->hasRole('admin'))

        <li class="header" style="color:white;">Aplicación</li>
        <li><a href="{{url('usuarios')}}"><i class="fa fa-users"></i> <span>Gestionar Usuarios</span></a></li>
        <li><a href="{{url('indicadores')}}"><i class="fa fa-line-chart"></i> <span>Indicadores Económicos</span></a></li>
        <li><a href="{{url('rentas')}}"><i class="fa fa-cog"></i> <span>Parámetros Imp. Renta</span></a></li>
        @endif
        <!--
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>
    -->
    <!-- Main content -->
    <section class="content">
      <section class="content-header">
        <h1>
          @yield('cabecera')
        </h1>
        <br>
      </section>

      @if(session('exito'))
      <div class="alert alert-success success-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Atencion!</h4>
          {{session('exito')}}
      </div>
      @endif
      @yield('content')
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.2
    </div>
    <strong><a href="http://www.inf.ucv.cl" target="_blank">Escuela Ing. Informatica PUCV</a> - 2018 - <a target="_blank" href="https://adminlte.io">Template</a>
  </footer>

  
  
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('templates/AdminLTE-master')}}/dist/js/adminlte.min.js"></script>
<script src="{{ asset('js/moment.js-2.22.2/moment.min.js') }}"></script>
@yield('js')
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();
    moment.locale('es');
    let texto = moment("{{Auth::user()->created_at}}").fromNow();
    
    $('#miembroDesde').html('Miembro desde '+texto);
  })

</script>

</body>
</html>
