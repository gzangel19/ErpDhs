@extends('layouts.app')

@section('title','Servicio Tecnico')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/servicio')}}" class="nav-link"> <i class="fas fa-tools"></i> Servicio Tecnico  </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">

        <div class="inside">

            @if (getValueJS(Auth::user()->permisosERP,'servicioSearch'))
            
              <div class="form_search" id="form_search">

                  {!! Form::open(['url'=>'Servicios/Search','method' => 'POST']) !!}
                                  
                  <div class="row">
                      
                      <div class="col-md-2 sinMargen">

                          <label class="title"> Busqueda: </label>

                          {!! Form::text('searchText',null,['class' => 'form-control','placeholder' => 'Ingrese Su Busqueda']) !!}   

                      </div>

                      <div class="col-md-2">

                          <label class="title"> Filtro: </label>

                          {!! Form::select('searchCondicion',['razon_Social' => 'Cliente', 'codigo' => 'Codigo'],0,['class' => 'form-select']) !!}   

                      </div>

                      <div class="col-md-2">
                      
                          <label class="title"> Tecnico: </label>
                          
                            <select class="form-select" name="tecnico">

                                <option value="Todos">Todos</option>

                                <option value="Dario">Dario</option>

                            </select>

                      </div>

                      <div class="col-md-2">
                      
                          <label class="title"> Estado: </label>

                          {!! Form::select('status',['Todos' => 'Todos','Reparacion' => 'Reparacion','Finalizado' => 'Finalizado','Cancelado' => 'Cancelado'],0,['class' => 'form-select']) !!}  

                      </div>

                      <div class="col-md-2">
                          
                          <label class="title"> Pago: </label>

                          {!! Form::select('statusPago',['Todos' => 'Todos', 'Impago' => 'Impago','Pagado' => 'Pagado'],0,['class' => 'form-select']) !!}  

                      </div>

                      <div class="col-md-2">

                          <label class="title">  </label>

                          {!!Form::submit('Buscar',['class' => 'btn btn-primary']) !!}    

                      </div>

                  </div>

                  {!! Form::close() !!}

              </div>
 
            @endif
                  
            <table class="table table-hover text-nowrap">
                    
                <thead>
                                  
                    <tr>
                            
                        <th style="text-align:center;"> 
                          
                              @if (getValueJS(Auth::user()->permisosERP,'servicioCreate'))
                                
                                <a href="{{ route('servicios.cliente') }}" class="btn btn-link" data-toggle="tooltip" title="Nuevo Servicio" data-original-title="Nuevo Servicio"><i class="fas fa-plus"></i></a>
                              
                              @else

                                Codigo 

                              @endif

                        </th>
                          
                        <th style="text-align:center;"> Cliente </th>
                            
                        <th style="text-align:center;"> Maquina </th>
                               
                        <th style="text-align:center;"> Estado </th>

                        <th style="text-align:center;"> Tecnico </th>
                            
                        <th style="text-align:center;"> Pago </th>
                            
                        <th style="text-align:center;"> Opciones</th>                                     
                      
                    </tr>

                </thead>

                <tbody>
                        
                      @foreach ($servicios as $servicio)
                        
                      <tr>
                            
                            <td style="text-align:center;">{{ $servicio->codigo }}</td>
                                        
                                        <td style="text-align:center;">{{ $servicio->cliente->razon_Social }}</td>
                                          
                                        <td style="text-align:center;">{{ $servicio->maquina->modelo }}</td>
                                          
                                        <td style="text-align:center;">{{ $servicio->estado }}</td>

                                        <td style="text-align:center;">{{ $servicio->tecnico }}</td>

                                        <td style="text-align:center;">{{ $servicio->pago }}</td>
                                          
                                        <td style="text-align:center;">
              
                                          <div class="opts">
                                            
                                            @if (getValueJS(Auth::user()->permisosERP,'servicioShow'))
                                              
                                              <a class="warning" href="{{url('/servicios/detalle/'.$servicio->id)}}" title="Detalle Servicio Tecnico"> <i class="far fa-eye"></i> </a>
              
                                            @endif
              
                                          </div>
                                          
                                        </td>

                      </tr>
    
                      @endforeach
                      
                </tbody>

            </table>

            {{ $servicios->render() }}
                    
        </div>
               
    </div>
             
</div>

@endsection
