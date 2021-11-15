@extends('layouts.app')

@section('title','Home Admin')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/')}}" class="nav-link"> <i class="fas fa-align-left"></i> Estadisticas  </a>
                                    
    </li>


@endsection


@section('content')

<div class="container-fluid">

    <div class="panel shadow">
        
        <div class="inside">

            <div class="row mtop16">
                
                <div class="col-md-12">

                    <section>

                        <div class="container-fluid">

                            <div class="inside">

                                <div class="header">
                
                                     <h2 class="title"> <a href="#"> <i class="fas fa-book"></i>  Estadisticas Casa Central </a>  </h2> 

                                </div>


                                <div class="row mtop16">

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">
                                            
                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-boxes"></i> Productos Registrados </a> </h2> 
                                        
                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    {{ $productosCasaCentral }}
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">

                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-credit-card"></i> Pedidos Pendientes </a> </h2> 

                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    {{ $pedidosPendientesCasaCentral }}
                                                
                                                </div>

                                            </div>


                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">
                                            
                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-boxes"></i> Pedidos Impagos </a> </h2> 

                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    {{ $pedidosImpagos }}
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                                
                                </div>

                                <div class="row mtop16">

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">
                                            
                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-boxes"></i> Pedidos Pagados </a> </h2> 
                                        
                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    {{ $totalPedidosCasaCentral }}
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">
                                            
                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-boxes"></i> Ingresos Registrados </a> </h2> 
                                        
                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    AR$ {{ number_format( $totalIngresosCasaCentral , 2 , ',' , '.') }}
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">
                                            
                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-boxes"></i> Ticket Promedio </a> </h2> 

                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    AR$ {{ number_format( $promedioTicketCasaCentral , 2 , ',' , '.') }}
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>   

                                </div>
                                     
                                <div class="row shadow mtop16">

                                    <div class="col-md-6">

                                        <div class="card card-dark">
                                            
                                            <div class="card-header">
                                                
                                                <h3 class="card-title"> Ventas Mensuales Casa Central, 2021</h3>
                                                    
                                                <div class="card-tools">
                                                
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                        
                                                </div>

                                            </div>

                                            <div class="card-body">
                                                
                                                <figure class="highcharts-figure">
                                                        
                                                    <div id="containerVentasMensual"></div>
                                                        
                                                    <p class="highcharts-description"></p>
                                                    
                                                </figure>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-6">
                    
                                        <div class="card card-dark">
                                            
                                            <div class="card-header">
                                                
                                                <h3 class="card-title"> Ingresos Mensuales Casa Central, 2021</h3>
                                                    
                                                    <div class="card-tools">
                                                
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                    
                                                    </div>

                                            
                                            </div>

                                            <div class="card-body">
                                                
                                                <figure class="highcharts-figure">
                                                    <div id="containerSumaVenta"></div>
                                                    <p class="highcharts-description"></p>
                                                </figure>

                                            </div>
                                        
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        
                    </section>

                </div>

            </div>

            <div class="row mtop16">

                <div class="col-md-12">

                    <section>

                        <div class="container-fluid">

                            <div class="inside">

                                <div class="header">

                                    <h2 class="title"> <a href="#"> <i class="fas fa-book"></i>  Estadisticas Sucursal Mate de Luna </a>  </h2> 

                                </div>

                                <div class="row mtop16">

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">
                                            
                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-boxes"></i> Productos Registrados </a> </h2> 
                                        
                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    {{ $productosMatedeLuna }}
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">

                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-credit-card"></i> Pedidos Pendientes </a> </h2> 

                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    {{ $pedidosPendientesMatedeLuna }}
                                                
                                                </div>

                                            </div>


                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">
                                            
                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-boxes"></i> Pedidos Impagos </a> </h2> 

                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    {{ $pedidosImpagosMatedeLuna }}
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                                
                                </div>

                                <div class="row mtop16">

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">
                                            
                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-boxes"></i> Pedidos Pagados </a> </h2> 
                                        
                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    {{ $totalPedidosMatedeLuna }}
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">
                                            
                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-boxes"></i> Ingresos Registrados </a> </h2> 
                                        
                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    AR$ {{ number_format( $totalIngresosMatedeLuna , 2 , ',' , '.') }}
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">
                                            
                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-boxes"></i> Ticket Promedio </a> </h2> 

                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    AR$ {{ number_format( $promedioTicketMatedeLuna , 2 , ',' , '.') }}
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>   

                                </div>
                                    
                                <div class="row mtop16">

                                    <div class="col-md-6">
                                        
                                        <div class="card card-dark">
                                            
                                            <div class="card-header">
                                                
                                                    <h3 class="card-title"> Ventas Mensuales Sucursal Mate de Luna, 2021</h3>
                                                    
                                                    <div class="card-tools">
                                                
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                    
                                                    </div>
                                            
                                            </div>

                                            <div class="card-body">
                                                
                                                <figure class="highcharts-figure">
                                                    <div id="containerVentasMensual2"></div>
                                                    <p class="highcharts-description"></p>
                                                </figure>

                                            </div>
                        
                                        </div>

                                    </div>
                                
                                    <div class="col-md-6">
                                        
                                        <div class="card card-dark">
                                            
                                            <div class="card-header">
                                                <h3 class="card-title"> Ingresos Mensuales Sucursal Mate de Luna, 2021</h3>
                                                    <div class="card-tools">
                                                
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        
                                            <div class="card-body">
                                            
                                                <figure class="highcharts-figure">
                                                    <div id="containerSumaVentaSucursal2"></div>
                                                    <p class="highcharts-description"></p>
                                                </figure>

                                            </div>
                   
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        
                    </section>

                </div>

            </div>
         
            <div class="row mtop16">

                <div class="col-md-12">

                    <section>

                        <div class="container-fluid">

                            <div class="inside">

                                <div class="header">

                                    <h2 class="title"> <a href="#"> <i class="fas fa-book"></i>  Estadisticas Sucursal Santiago del Estero </a>  </h2> 

                                </div>

                                <div class="row mtop16">

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">
                                            
                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-boxes"></i> Productos Registrados </a> </h2> 
                                        
                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    {{ $productosSantiago }}
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">

                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-credit-card"></i> Pedidos Pendientes </a> </h2> 

                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    {{ $pedidosPendientesSantiago }}
                                                
                                                </div>

                                            </div>


                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">
                                            
                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-boxes"></i> Pedidos Impagos </a> </h2> 

                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    {{ $pedidosImpagosSantiago }}
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                                
                                </div>

                                <div class="row mtop16">

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">
                                            
                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-boxes"></i> Pedidos Pagados </a> </h2> 
                                        
                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    {{ $totalPedidosSantiago }}
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">
                                            
                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-boxes"></i> Ingresos Registrados </a> </h2> 
                                        
                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    AR$ {{ number_format( $totalIngresosSantiago , 2 , ',' , '.') }}
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="panel shadow">

                                            <div class="header">
                                            
                                                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-boxes"></i> Ticket Promedio </a> </h2> 

                                            </div>

                                            <div class="inside">

                                                <div class="big_count">

                                                    AR$ {{ number_format( $promedioTicketSantiago , 2 , ',' , '.') }}
                                                
                                                </div>

                                            </div>

                                        </div>

                                    </div>   

                                </div>
                                    
                                <div class="row mtop16">

                                    <div class="col-md-6">
                                        
                                        <div class="card card-dark">
                                            
                                            <div class="card-header">
                                                
                                                    <h3 class="card-title"> Ventas Mensuales Sucursal Santiago del Estero, 2021</h3>
                                                    
                                                    <div class="card-tools">
                                                
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                    
                                                    </div>
                                            
                                            </div>

                                            <div class="card-body">
                                                
                                                <figure class="highcharts-figure">
                                                    <div id="containerVentasMensual6"></div>
                                                    <p class="highcharts-description"></p>
                                                </figure>

                                            </div>
                        
                                        </div>

                                    </div>
                                
                                    <div class="col-md-6">
                                        
                                        <div class="card card-dark">
                                            
                                            <div class="card-header">
                                                <h3 class="card-title"> Ingresos Mensuales Sucursal Santiago del Estero, 2021</h3>
                                                    <div class="card-tools">
                                                
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        
                                            <div class="card-body">
                                            
                                                <figure class="highcharts-figure">
                                                    <div id="containerSumaVentaSucursal6"></div>
                                                    <p class="highcharts-description"></p>
                                                </figure>

                                            </div>
                   
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        
                    </section>

                </div>

            </div>

            <div class="row mtop16">

                <div class="col-md-12">

                    <section>

                        <div class="container-fluid">

                            <div class="inside">

                                <div class="header">

                                    <h2 class="title"> <a href="#"> <i class="fas fa-book"></i>  Estadisticas Generales </a>  </h2> 

                                </div>
                                
                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="card card-dark">
                                            
                                            <div class="card-header">
                                            
                                                    <h3 class="card-title"> Ventas Diarias Totales </h3>
                                            
                                                    <div class="card-tools">
                                                
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i> </button>
                                                
                                                    </div>
                                            
                                            </div>

                                        </div>
                                            
                                        <div class="card-body">
                                                
                                            <form class="form-inline" action="{{ route('home') }}" role="form">
                                            
                                                <div class="input-group input-group-sm" style="width: 400px;">

                                                    <select class="form-select" name="ventasmes">
                                                        
                                                        <option value="11">Noviembre</option>                                       
                                                        <option value="1">Enero</option>    
                                                        <option value="2">Febrero</option>    
                                                        <option value="3">Marzo</option>    
                                                        <option value="4">Abril</option>
                                                        <option value="5">Mayo</option>   
                                                        <option value="6">Junio</option>                                           
                                                        <option value="7">Julio</option>  
                                                        <option value="8">Agosto</option> 
                                                        <option value="9">Septiembre</option>                
                                                        <option value="10">Octubre</option>  
                                                        <option value="12">Diciembre</option>       
                                                    
                                                    </select>
                                                
                                                    <div class="input-group-append">
                                                            
                                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                        
                                                    </div>

                                                </div>

                                            </form>

                                            <figure class="highcharts-figure">
                                                    
                                                <div id="containerVentasDia"></div>
                                                    
                                                <p class="highcharts-description"></p>
                                               
                                            </figure>

                                        </div>
               
                                    </div>
                            
                                    <div class="col-md-6">
                                        
                                        <div class="card card-dark">
                                            
                                            <div class="card-header">
                                                
                                                <h3 class="card-title"> Ingresos Diarias Totales </h3>
                                                    
                                                    <div class="card-tools">
                                            
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                     
                                                    </div>
                                                
                                            </div>
                                        
                                            <div class="card-body">

                                            <figure class="highcharts-figure">
                                                <div id="containerIngresoDiario"></div>
                                                <p class="highcharts-description"></p>
                                            </figure>

                                        </div>
                                    </div>

                                </div>
                                
                                <div class="row">
                       
                                    <div class="col-md-6">
                                        
                                        <div class="card card-dark">
                                        
                                            <div class="card-header">
                                            
                                                <h3 class="card-title">  Ventas Diarias de {{ $vendedor->apellido }} , {{ $vendedor->nombre }}</h3>
                                                
                                                <div class="card-tools">
                                                
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="card-body">

                                                <div class="card-tools">
                                            
                                                    <form class="form-inline" action="{{ route('home') }}" role="form">
                                                    
                                                        <div class="input-group input-group-sm" style="width: 400px;">

                                                            <select class="form-select" name="ventasmesVendedor">
                                                                <option value="11">Noviembre</option>                                                                
                                                                <option value="1">Enero</option>    
                                                                <option value="2">Febrero</option>    
                                                                <option value="3">Marzo</option>    
                                                                <option value="4">Abril</option>
                                                                <option value="5">Mayo</option>
                                                                <option value="6">Junio</option>  
                                                                <option value="7">Julio</option>                                                      
                                                                <option value="8">Agosto</option>    
                                                                <option value="9">Septiembre</option>    
                                                                <option value="10">Octubre</option>
                                                                <option value="12">Diciembre</option>       
                                                            </select>
                                                            
                                                            <select class="form-control" name="vendedor_id">
                                                                
                                                                @foreach($vendedores as $usuario)
                                                                
                                                                    <option value="{{$usuario->id}}">{{$usuario->apellido}} , {{$usuario->nombre}}</option>
                                                                
                                                                @endforeach                   
                                                            
                                                            </select>

                                                            <div class="input-group-append">
                                                                
                                                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                            
                                                            </div>

                                                        </div>

                                                    </form>

                                                </div>

                                            
                                                <figure>
                                            
                                                    <div id="containerVendedor"></div>

                                                </figure>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="card card-dark">
                                            
                                            <div class="card-header">

                                                <h3 class="card-title">  Ingreso de Ventas de {{ $vendedor->apellido }} , {{ $vendedor->nombre }}</h3>
                                                
                                                <div class="card-tools">
                                                    
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                
                                                </div>

                                            </div>
                                            
                                            <div class="card-body">

                                                <figure>
                                            
                                                    <div id="containerSumaVendedor"></div>

                                                </figure>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        
                    </section>

                </div>

            </div>


        </div>

    </div>

</div>

@endsection

@push ('scripts')

<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">
    
    var userData = <?php echo json_encode($ventasMeses)?>;
    var mesesSucursal2 = <?php echo json_encode($ventasMesesSucursal2)?>;

    var userData6 = <?php echo json_encode($ventasMesesSucursal6)?>;
    var mesesSucursal6 = <?php echo json_encode($mesesSucursal6)?>;
    
    var mesesData = <?php echo json_encode($meses)?>;
    var mesesData2 = <?php echo json_encode($mesesSucursal2)?>;
    var mesesData6 = <?php echo json_encode($mesesSucursal6)?>;

    var totalData = <?php echo json_encode($totalMeses)?>;
    var totalData2 = <?php echo json_encode($totalMesesSucursal2)?>;
    var totalData6 = <?php echo json_encode($totalMesesSucursal6)?>;

    var diasData = <?php echo json_encode($dias)?>;
    var totalDia = <?php echo json_encode($totalDias)?>;
    var sumDia = <?php echo json_encode($sumDias)?>;
    var totalVendedorDiario = <?php echo json_encode($totalDiasVendedor)?>;
    var ingresoVendedorDiario = <?php echo json_encode($sumaDiaVendedor)?>;
    var diasVendedor = <?php echo json_encode($ventasDiariasVendedor)?>;

    //...............................................................................................//

    
    Highcharts.chart('containerVentasDia', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Cantidad de Ventas Por Dia'
        },
        xAxis: {
            categories: diasData,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Nº Ventas'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px"></span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ventas',
            color:'red',
            data: totalDia

        }]
    });

    //...............................................................................................//

    Highcharts.chart('containerSumaVendedor', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Ingreso Diarias por Vendedor'
        },
        xAxis: {
            categories: totalVendedorDiario,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: '$'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px"></span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ingreso',
            color:'blue',
            data: ingresoVendedorDiario

        }]
    });

    //...............................................................................................//
    
    //...............................................................................................//

    Highcharts.chart('containerVendedor', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Cantidad de Ventas Diarias por Vendedor'
        },
        xAxis: {
            categories: totalVendedorDiario,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Ventas'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px"></span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ventas',
            color:'red',
            data: diasVendedor

        }]
    });

    //...............................................................................................//
    
    Highcharts.chart('containerIngresoDiario', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Ingreso de Ventas Diario'
        },
        xAxis: {
            categories: diasData,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Ingreso de Ventas Diario'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px"></span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: '$',
            color:'blue',
            data: sumDia

        }]
    });

    //...............................................................................................//

    //...............................................................................................//

    Highcharts.chart('containerVentasMensual', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Cantidad de Ventas Por Meses'
        },
        xAxis: {
            categories: mesesData,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Ventas'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px"></span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ventas',
            color:'red',
            data: userData

        }]
    });

    //...............................................................................................//

    Highcharts.chart('containerVentasMensual2', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Cantidad de Ventas Por Meses'
        },
        xAxis: {
            categories: mesesData2,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Ventas'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px"></span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ventas',
            color:'red',
            data: mesesSucursal2

        }]
    });
    


    Highcharts.chart('containerVentasMensual6', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Cantidad de Ventas Por Meses'
        },
        xAxis: {
            categories: mesesData6,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Ventas'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px"></span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ventas',
            color:'red',
            data: userData6

        }]
    });

    Highcharts.chart('containerSumaVentaSucursal6', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Ingreso Mensual por Ventas'
        },
        xAxis: {
            categories: mesesData6,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Ingresos'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>$ {point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ingresos',
            color:'blue',
            data: totalData6

        }]
    });
    

    //...............................................................................................//

    Highcharts.chart('containerSumaVenta', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Ingreso Mensual por Ventas'
        },
        xAxis: {
            categories: mesesData,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Ingresos'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>$ {point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ingresos',
            color:'blue',
            data: totalData

        }]
    });

     //...............................................................................................//

     Highcharts.chart('containerSumaVentaSucursal2', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Ingreso Mensual por Ventas'
        },
        xAxis: {
            categories: mesesData2,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Ingresos'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>$ {point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ingresos',
            color:'blue',
            data: totalData2

        }]
    });
    
    //...............................................................................................//
    
</script>
@endpush