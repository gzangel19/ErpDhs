@extends('layouts.app')
@section('content')

<div class="container">
    
    <div class="row justify-content-center">
        
        <div class="col-md-12">

          <section class="content-header">
            
            <div class="container-fluid">
              
              <div class="row mb-2">
                  
                  <div class="col-sm-6">
                    
                    <h1> Productos Cotizados</h1>
                
                  </div>

              </div>

            </div>

          </section>

          <!-- Comienza la tabla -->

          <div class="row">

              <div class="col-12">
                  
                  <div class="card">
                      
                      <div class="card-header">
                          
                          <h3 class="card-title">Listado de Productos</h3>

                          <div class="card-tools">

                              <form class="form-inline" action="{{ route('cotizaciones.index') }}" role="form">
                                
                                <div class="input-group input-group-sm" style="width: 300px;">
                 
                                  <input type="text" name="searchText" class="form-control float-right" placeholder="Buscar">
                                                                
                                  <div class="input-group-append">
                                      
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  
                                  </div>

                                </div>

                              </form>

                          </div>
                      
                      </div>

    
                
                  <div class="card-body table-responsive p-0">
                      
                      <table class="table table-hover text-nowrap">
                        
                        <thead>
                            
                            <tr>
                                <th> <a href="{{ route('cotizaciones.create') }}" class="btn btn-link" data-toggle="tooltip" title="Agregar Producto" data-original-title="Agregar Producto"><i class="fas fa-plus"></i></a></th>
                                <th>Unidad de Negocio</th>
                                <th>Precio Cotizado</th>
                                <th>Moneda</th>
                                <th>Opciones</th>                            
                            </tr>
                        
                        </thead>

                        <tfoot>

                            <tr>
                                <th>Producto</th>
                                <th>Unidad de Negocio</th>
                                <th>Precio Cotizado</th>
                                <th>Moneda</th>
                                <th>Opciones</th>
                            </tr>

                        </tfoot>

                        <tbody>
                          
                          @foreach ($articulos as $producto)
                            
                            <tr>
                                <td> {{ $producto->nombre}} </td>
                                <td> {{ $producto->unidades_negocios->nombre}} </td>
                                @if($producto->moneda == 'Dolares')
                                <td> AR$  {{ round( $producto->precioLocal * $dolar->valor,2) }} </td>
                                @else
                                <td> AR$ {{ round($producto->precioLocal,2)}} </td>
                                @endif
                                <td> {{ $producto->moneda}} </td>
                                <td>
                                    <a href="{{ route('cotizaciones.show',$producto->id) }}" class="btn btn-link" data-toggle="tooltip" title="Ver Detalle Producto" data-original-title="Ver Detalle Cliente"> <button type="button" class="btn btn-success btn-sm">Ver</button></a>                                </td> 
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

</div>
</div>
</div>
</div>
</div>

@endsection