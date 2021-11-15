<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Sinopsys - @yield('title') </title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="routeName" content="{{ Route::currentRouteName() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico" />

  <!-- Tell the browser to be responsive to screen width -->
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
  <!-- Tempusdominus Bbootstrap 4 -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <link rel="stylesheet" href="{{ url('/static/css/admin.css?v='.time()) }}">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
            

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
    <div class="wrapper">

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
          <div class="brand-link munay">
            <a href="{{url('/')}}">
              SYNOPSYS.jpg
              <!-- <img src="{{ asset('img/logos/munay-logo.png') }}"
                alt="AdminLTE Logo"
                class="logo"
                style="opacity: .8">
            </a> -->
            

          </div>

        <!-- Sidebar -->
        <div class="sidebar">
          
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3">
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">

                   <img src="{{asset('img/perfil/'.Auth::user()->imagen_perfil)}}" class="img-circle elevation-2" style=" width:40px; height:40px;">
                    <p>
                      &nbsp;{{ Auth::user()->apellido }}, {{ Auth::user()->nombre }}
                    </p>
                    <i class="right fas fa-angle-left mt-1"></i>
                  </a>

                  <!-- submenu de usuario -->
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('usuarios.editPerfil') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Editar Perfil</p>
                      </a>
                    </li>
                  
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i class="far fa-circle nav-icon"></i>
                          Cerrar Sesi&oacute;n
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    </li>
                  </ul> <!-- fin de submenu de usuario -->
                </li>
              </ul>
            </nav>
            <!-- <div class="image">
              <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">Alexander Pierce</a>
            </div> -->
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                  with font-awesome or any other icon font library -->
            
              <li class="nav-item has-treeview">
                <a href=" {{ url('/Munay/Pedidos/Home') }}" class="nav-link">
                  <i class="nav-icon fas fa-cart-plus"></i>
                  <p>Pedidos</p>
                </a>
              </li>
     
              <li class="nav-item has-treeview">
                <a href="{{ url('/Sinopsys/Productos') }}" class="nav-link">
                  <i class="nav-icon fas fa-book"></i>
                  <p>Productos</p>
                </a>
              </li>

              <li class="nav-item has-treeview">
                <a href="{{ url('/Sinopsys/Categorias') }}" class="nav-link">
                  <i class="nav-icon fas fa-boxes"></i>
                  <p>Categorias</p>
                </a>
              </li>
             
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <div class="page">

          <div class="container-fluid">
                                
              <nav aria-label="breadcrumb shadow">
                                    
                  <ol class="breadcrumb">

                      <li class="nav-item">
                        
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                      
                      </li>
                                        
                      <li class="breadcrumb-item active">
                                            
                          <a href="{{url('/')}}" class="nav-link"> <i class="fas fa-home"></i> Home {{ Auth::user()->caja->deposito->nombre }} </a>
                                        
                      </li>

                      @section('breadcrumb')
                      @show
                    
                  </ol>

              </nav>

          </div>

          @if(Session::has('message'))
                    
            <div class="container-fluid"> 

                <div class="alert alert-danger mtop16" style="display:block; margin-bottom:16px">

                                        {{ Session::get('message') }}

                                        @if( $errors->any() )

                                            <ul>
                                                @foreach($errors->all() as $error)
                                                <li> {{$error}} </li>
                                                @endforeach
                                            </ul>
                                        
                                        @endif
                                        

                                

                </div>

            </div>
                            
          @endif
          <!-- contenido -->
          @yield('content')

        
        </div>

      </div>
      <!-- /.content-wrapper -->



    </div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

@stack('scripts')

<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('adminlte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('adminlte/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>


<script src="{{ asset('js/highcharts.js') }}"></script>
<script src="{{ asset('js/exporting.js') }}"></script>

<script>
  $('.alert').slideDown();
  setTimeout(function() { $('.alert').slideUp(); },5000);
</script>

</body>
</html>
