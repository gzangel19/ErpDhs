@extends('layouts.app')
@section('content')

<div class="container">
    
    <div class="row justify-content-center">
        
        <div class="col-md-12">

          <br>
          <!-- Comienza la tabla -->

          <div class="row">

              <div class="col-12">
                  
                  <div class="card card-primary">
                      
                      <div class="card-header">
                          
                          <h3 class="card-title">Listado de Productos {{$unidades->nombre}}</h3>

                          @if (getValueJS(Auth::user()->permisosERP,'getProductSearch'))

                          <div class="card-tools">

                              <form class="form-inline" action="{{ url('productos/index/'.$unidades->id) }}" role="form">
                                
                                <div class="input-group input-group-sm" style="width: 300px;">
                 
                                  <input type="text" name="searchText" class="form-control float-right" placeholder="Buscar">
                                                                
                                  <div class="input-group-append">
                                      
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  
                                  </div>

                                </div>

                              </form>

                          </div>

                          @endif
                      
                      </div>

    
                
                  <div class="card-body table-responsive p-0">
                      
                      <table class="table table-hover text-nowrap">
                        
                        <thead>
                            
                            <tr>
                                
                                @if (getValueJS(Auth::user()->permisosERP,'productsAdd'))
                                
                                    <th> <a href="{{ url('productos/create/'.$unidades->id) }}" class="btn btn-link" data-toggle="tooltip" title="Agregar Producto" data-original-title="Agregar Producto"><i class="fas fa-plus"></i></a></th>
                                @else

                                <th> Producto </th>

                                @endif

                                <th>Precio Lista A</th>
                                @if(Auth::user()->tipo != 'vendedor')
                                <th>Precio Lista B</th>
                                @endif

                                @if (getValueJS(Auth::user()->permisosERP,'productoShow'))
                              
                                    <th>Opciones</th>

                                @endif
                               
                            
                            </tr>
                        
                        </thead>

                        <tfoot>

                            <tr>
                                <th>Producto</th>
                                <th>Precio Lista A</th>
                                @if(Auth::user()->tipo != "vendedor")
                                <th>Precio Lista B</th>
                                @endif
                              
                              @if (getValueJS(Auth::user()->permisosERP,'productoShow'))
                              
                                <th>Opciones</th>

                              @endif
                            
                            </tr>

                        </tfoot>

                        <tbody>
                          
                          @foreach ($articulos as $producto)
                            
                            <tr>
                                <td> {{ $producto->nombre}} </td>
                                @if($producto->moneda == 'Dolares')
                                <td> AR$  {{ round( $producto->precioLocal * $dolar->valor,2) }} </td>
                                  @if(Auth::user()->tipo != "vendedor")
                                    <td> AR$  {{ round( $producto->precioLocalB * $dolar->valor,2 ) }} </td>
                                  @endif  
                                @else
                                <td> AR$ {{ round($producto->precioLocal,2)}} </td>
                                  @if(Auth::user()->tipo != "vendedor")
                                    <td> AR$ {{ round($producto->precioLocalB,2)}} </td>
                                  @endif  
                                @endif
                                
                                
                                @if (getValueJS(Auth::user()->permisosERP,'productoShow'))
                                
                                <td>             
                                      
                                        <a href="{{ url('/productos/'.$producto->id) }}" class="btn btn-link" data-toggle="tooltip" title="Ver Detalle Producto" data-original-title="Ver Detalle Cliente"> <button type="button" class="btn btn-success btn-sm">Ver</button>
                                                                
                                </td>
                                
                                @endif


                            </tr>
                          @endforeach

                        </tbody>
                  
                      </table>

                      {{$articulos->render()}}
                  
                  </div>
                
              </div>

          </div>
        
        </div>

    </div>

</div>

@endsection