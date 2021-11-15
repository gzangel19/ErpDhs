<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> @yield('title') </title>
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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
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
  
  <script src="{{ url('/static/js/admin.js?v='.time()) }}"></script>


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
        <div class="brand-link">
          <img src="{{ asset('img/logo.png') }}"
              alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3"
              style="opacity: .8"
              >
              <a href="{{ route('home') }}" style="color: white;"><span class="brand-text font-weight-light">Grupo DHS</span></a>
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
                        <a href="{{ route('usuarios.cambiarDeposito') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cambiar Deposito</p>
                      </a>
                    </li>
                  
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i class="far fa-circle nav-icon"></i>
                          Cerrar Sesi&oacute;n
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" style="display: none;">
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


              @if (getValueJS(Auth::user()->permisosERP,'cajas'))

              <li class="nav-item has-treeview">
                
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cash-register"></i>
                    <p>
                        Cajas
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>

                  @if (getValueJS(Auth::user()->permisosERP,'getFlujoCaja'))

                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('cajas.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Flujo de Cajas</p>
                      </a>
                    </li>
                  </ul>

                  @endif
                
                  @if (getValueJS(Auth::user()->permisosERP,'getPagos'))

                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('pagos.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pagos Ventas</p>
                      </a>
                    </li>             
                  </ul>
                  
                  @endif

                  @if (getValueJS(Auth::user()->permisosERP,'getRecibos'))

                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('pagos.recibos') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Recibos </p>
                      </a>
                    </li>             
                  </ul>      
                 
                  @endif

                  @if (getValueJS(Auth::user()->permisosERP,'getCuentaCorriente'))

                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('cuentas.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cuentas Corrientes</p>
                      </a>
                    </li>             
                  </ul>
                  
                  @endif

              </li>

            @endif

             @if (getValueJS(Auth::user()->permisosERP,'getVendedores'))
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-people-carry"></i>
                  <p>
                    Vendedores
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  @if (getValueJS(Auth::user()->permisosERP,'getComisionIndividual'))
                  <li class="nav-item">
                    <a href="{{ route('comisiones.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Comisiones</p>
                    </a>
                  </li>    
                  @endif

                  @if (getValueJS(Auth::user()->permisosERP,'getComisionGlobal'))
                  <li class="nav-item">
                    <a href="{{ route('comisiones.global') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Global</p>
                    </a>
                  </li>    
                  @endif

                </ul>
              </li>

              @endif

              @if (getValueJS(Auth::user()->permisosERP,'ventas'))

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-shopping-cart"></i>
                  <p>
                    Ventas
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  @if (getValueJS(Auth::user()->permisosERP,'getPedidos'))

                                    
                  <li class="nav-item">
                    <a href="{{ url('Pedidos/Index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Pedidos </p>
                    </a>
                  </li>

                  @endif
              
                  @if (getValueJS(Auth::user()->permisosERP,'getPresupuesto'))

                  <li class="nav-item">
                  
                      <a href="{{ route('presupuestos.index') }}" class="nav-link">
                      
                          <i class="far fa-circle nav-icon"></i>
                            
                            <p>Presupuestos</p>
                          
                      </a>
                  
                  </li>

                  @endif


                  @if (getValueJS(Auth::user()->permisosERP,'getEccomerce'))

                  <li class="nav-item">
                    <a href="{{ url('Ordenes/all/all') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Pedidos Eccomerce</p>
                    </a>
                  </li>

                  @endif

                </ul>
              </li>

              @endif

              @if (getValueJS(Auth::user()->permisosERP,'getClientes'))
                    
                <li class="nav-item has-treeview">
                        
                    <a href="{{ route('clientes.index') }}" class="nav-link">
                      
                        <i class="nav-icon  fas fa-male"></i>  <p> Clientes</p>
                      
                    </a>
                    
                </li>


              @endif

              @if (getValueJS(Auth::user()->permisosERP,'getServicioTecnico'))

                <li class="nav-item has-treeview">

                  <a href="{{route('servicios.index')}}" class="nav-link">
                  
                    <i class="nav-icon fas fa-tools"></i>
                  
                    <p> Servicio Tecnico </p>
                  
                  </a>

                </li>

              @endif

              @if (getValueJS(Auth::user()->permisosERP,'getMaquinas'))
                    
                    <li class="nav-item has-treeview">
                            
                        <a href="{{ route('maquinas.index') }}" class="nav-link">
                          
                            <i class="nav-icon  fas fa-male"></i>  <p> Maquinas </p>
                          
                        </a>
                        
                    </li>
    
    
              @endif
          
              @can('compras_list')
              <li style="display:none;" class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-shopping-cart"></i>
                  <p>
                    Compras
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('proveedores.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Proveedores</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('ordenCompra.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Orden de Compra</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('compras.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ingreso</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endcan


              @if (getValueJS(Auth::user()->permisosERP,'getDepositos'))

              <li class="nav-item has-treeview">
              
                <a href="{{url('/depositos')}}" class="nav-link">
                
                  <i class="nav-icon fas fa-warehouse"></i>
                
                  <p>Sucursales</p>
                
                </a>
              
              </li>
              
              @endif

            
              @if (getValueJS(Auth::user()->permisosERP,'productosUnidades'))

              <li class="nav-item has-treeview">
                  
                  <a href="{{ url('/productos/unidades') }}" class="nav-link">
                  
                    <i class="nav-icon fas fa-boxes"></i>
                  
                    <p>Productos</p>
                  
                  </a>
              
              </li>

              @endif

              @if (getValueJS(Auth::user()->permisosERP,'getMovimiento'))

              <li class="nav-item has-treeview">
                <a href="{{route('movimientos.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-truck-moving"></i>
                  <p>Movimientos</p>
                </a>
              </li>

              @endif

              @if (getValueJS(Auth::user()->permisosERP,'getEstadisticas'))
              
              <li class="nav-item has-treeview">
                <a href="{{ route('estadisticas.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-database"></i>
                  <i class=""></i>
                  <p>Estadisticas</p>
                </a>
              </li>

              @endif

              @if (getValueJS(Auth::user()->permisosERP,'getGraficaMunay'))
              
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-luggage-cart"></i>
                  <p>
                    Grafica Munay
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                      <a href="{{ route('materiales.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Materias Primas </p>
                      </a>
                    </li>

                  <li class="nav-item">
                    <a href="{{ route('cotizaciones.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Productos </p>
                    </a>
                  </li>

                </ul>

              </li>

              @endif

              @if (getValueJS(Auth::user()->permisosERP,'getTareas'))

              <li class="nav-item has-treeview">

                <a href="{{route('tareas.global')}}" class="nav-link">

                  <i class="nav-icon fas fa-tasks"></i>

                  <p> Tareas </p>

                </a>

              </li>

              @endif

              <li class="nav-item has-treeview">

                <a href="{{route('tareas.visor')}}" class="nav-link">

                  <i class="nav-icon fas fa-eye"></i>

                  <p> Visor </p>

                </a>

              </li>

              @can('ajustes_list')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>
                    Configuraciones
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('unidades.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Unidades de Negocio</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('usuarios.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Usuarios</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endcan
              
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
