@extends('layouts.app')

@section('title','Servicio Tecnico')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/servicios')}}" class="nav-link"> <i class="fas fa-tools"></i> Servicio Tecnico  </a>
                                    
    </li>

    <li class="breadcrumb-item">
            
        <a href="#" class="nav-link"> <i class="fas fa-tools"></i> Detalle Servicio Tecnico </a>
                                                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="page_user">

        <div class="row mtop16">
                
          <div class="col-md-3">

            <div class="panel shadow">

              <div class="inside">

                <div class="header">
                  
                  <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-user"></i> Detalle Del Servicio Tecnico </a> </h2> 
                
                </div>

                <div class="mini_profile">

                  <div class="info">
                    
                    <span class="title"> <i class="fas fa-sort-numeric-up-alt"></i> N° Servicio: </span>
                      
                    <span class="text">  {{  $servicio->codigo }} </span>

                    <span class="title"> <i class="fas fa-user-tie"></i> Cliente: </span>
                      
                    <span class="text">  {{  $servicio->cliente->razon_Social }} </span>

                    <span class="title"> <i class="fas fa-print"></i> Equipo: </span>
                      
                    <span class="text">  {{  $servicio->maquina->modelo }} </span>

                    <span class="title"> <i class="fas fa-clipboard-check"></i> Estado </span>
                    
                    <span class="text capitalize"> {{ $servicio->estado }} </span>

                    <span class="title"> <i class="fas fa-calendar-week"></i> Fecha: </span>
                    
                    <span class="text capitalize"> {{ $servicio->getFromDateAttribute( $servicio->created_at) }} </span>

                    <span class="title"> <i class="fas fa-exclamation-triangle"></i> Posible Falla </span>
                    
                    <span class="text capitalize"> {{ $servicio->falla  }} </span>

                    <span class="title"> <i class="fas fa-money-bill-wave"></i> Costo de Revision </span>
                    
                    <span class="text capitalize"> AR$ {{ $servicio->costoRevision }} </span>
 
                  </div>

                  @if (getValueJS(Auth::user()->permisosERP,'servicioDelete'))

                      @if($servicio->estado != 'Cancelado')

                          <a href="{{ url('/servicio/'. $servicio->id.'/delete')}}" class="btn btn-danger mtop16"> Cancelar Servicio </a>

                      @endif

                  @endif

                  @if (getValueJS(Auth::user()->permisosERP,'comprobanteEntrega'))

                        <a href="{{route('servicios.comprobante', $servicio->id)}}"class="btn btn-primary  btn-sm" data-toggle="tooltip" title="Imprimir Comprobante" data-original-title="Imprimir Comprobante"> Comprobante Recepcion </a>  
                  
                  @endif

                  @if (getValueJS(Auth::user()->permisosERP,'comprobanteRetiro'))

                      @if($servicio->estado == 'Finalizado')
                        
                        <a href="{{route('servicios.comprobanteRetiro', $servicio->id)}}"class="btn btn-success  btn-sm" data-toggle="tooltip" title="Imprimir Comprobante" data-original-title="Imprimir Comprobante"> Comprobante Entrega </a>                      
                      
                      @endif

                  @endif
                  
                </div>

              </div>

            </div>

          </div>

          <div class="col-md-9">

            <div class="panel shadow">

              <div class="inside">

                <div class="header">
                  
                  <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-plus"></i> Finalizar Servicio Tecnico </a> </h2> 
                
                </div>

                {!! Form::open(['url'=>'servicios/update/'.$servicio->id]) !!}

                <div class="row mtop16 shadow">

                    <div class="col-md-4 shadow">
                      
                      <div class="form-group" style="height:350px; overflow: scroll;">
                        
                        <label> Productos </label>

                        <form>
                              
                            <input id="searchTerm" type="text" onkeyup="doSearch()" />
                        
                        </form>

                        <table class="table table-hover" id="datos">
                          
                            <thead>
                                
                                <tr>

                                    <th> Producto </th>

                                </tr>
                            
                            </thead>

                            <tbody>
                              
                              @foreach ($productos as $producto)
                                
                                <tr>

                                  <td>
                                    
                                      <a href="{{url('/servicio/producto/store/'.$producto->id.'/'.$servicio->id)}}" style="color:#000 !important" > {{ $producto->nombre}} </a>
                                      
                                  </td>
                                
                                </tr>
                              
                              @endforeach

                            </tbody>

                        </table>

                      </div>

                    </div>

                    <div class="col-md-8">
                      
                      <div class="form-group">
                        
                        <label> Productos Utilizados </label>
                          
                          <table class="table table-hover" id="datos">
                            
                            <thead>
                                
                                <tr>

                                    <th> Producto </th>

                                     <th> Cantidad </th>

                                </tr>
                            
                            </thead>

                            <tbody>
                              
                              @foreach ($productoServicio as $ps)
                                
                                <tr>

                                  <td> {{ $ps->producto->nombre}} </td>

                                  <td> {{ $ps->cantidad}} </td>
                                
                                </tr>
                              
                              @endforeach

                            </tbody>

                          </table>

                      </div>

                    </div>

                </div>

                  <div class="row mtop16 shadow">
                  
                    <div class="col-md-12">
                          
                      <div class="form-group mtop16">
                      
                        <label> Tecnico </label>
                          
                            <select class="form-select" name="tecnico">

                                <option value="Dario">Dario</option>

                                <option value="Alexis">Alexis</option>

                                <option value="Facundo">Facundo</option>

                            </select>
                                              
                      </div>
                              
                    </div>

                  </div>

                  <div class="row mtop16">

                    <div class="col-md-12">
                      
                      <div class="form-group">
                        
                        <label> Trabajo Realizado</label>
                          
                        <textarea class="form-control" id="tareaRealizada" name="tareaRealizada" rows="6"></textarea>
                        
                      </div>

                    </div>

                  </div>


                               
                  <div class="row mtop16">
                    
                    <div class="col-md-12">
                            
                      {!!Form::submit('Guardar',['class' => 'btn btn-success']) !!}    
                                
                      <a class="btn btn-danger" href="{{route('servicios.index')}}" role="button">Volver</a> 
                    
                    </div>

                  </div>

                {!! Form::close() !!}

              </div>

            </div>

          </div>

		    </div>

	  </div>

</div>

@endsection
