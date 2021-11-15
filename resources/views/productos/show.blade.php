@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          <div class="card card-secondary">
            <div class="card-header" style="background-color:blue">
              <h3 class="card-title">Detalle de Producto</h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">

              <div class="row">
                
                  <div class="col-md-6">

                    @if(($producto->imagen != ""))               
                      <img src="{{asset('img/productos/'.$producto->imagen)}}" style="width: 55%; height: 100%;">
                    @else
                      <img src="{{asset('img/productos/imagenNoDisponible.jpg')}}" style="width: 55%; height: 100%;">
                    @endif
                  
                  </div>

                  <div class="col-md-6">
                    <p> <b>Nombre: </b>{{$producto->nombre}} 
                    
                    <p> <b> Descripcion </b>{{$producto->descripcion}}</p>

                    <p><b>Unidad de Negocio: </b>{{$producto->unidades_negocios->nombre}}</p>
                    
                    @if(Auth::user()->tipo != "vendedor")
                    <p><b>Moneda: </b>{{$producto->moneda}}</p>
                    @endif
                    
                    @if($producto->moneda == 'Dolares')
                      <p><b>Precio Lista </b> U$D {{ $producto->precioLocal}} 
                      
                      <p><b>Precio Lista B </b> U$D{{ $producto->precioLocalB}} </p>
                      
                      <p><b>Precio Lista  </b> AR$ {{ $producto->precioLocal * $dolar->valor }} </p>
                      
                      @if(Auth::user()->tipo != "vendedor")
                      <b>Precio Lista B  </b> AR${{ $producto->precioLocalB * $dolar->valor}} </p>
                      @endif
                    
                    @else
                      <p><b>Precio Lista </b> AR$ {{ $producto->precioLocal}}  </p>
                      @if(Auth::user()->tipo != "vendedor")
                      <p><b>Precio Lista B </b> AR$ {{ $producto->precioLocalB}} </p>

                      <p><b>Precio Eccomerce </b> AR$ {{ $producto->precioEccomerce}} </p>
                      @endif
                    @endif
                    
                      <a href="{{ url('productos/index/'.$producto->unidadnegocio_id) }}" data-toggle="tooltip" title="Volver" data-original-title="Volver"><button type="button" class="btn btn-danger btn-sm">Volver</button></a>
                      
                      @if (getValueJS(Auth::user()->permisosERP,'productosEdit'))

                      <a href="{{ route('productosEdit', $producto->id) }}" data-toggle="tooltip" title="Editar Producto" data-original-title="Editar Productos"><button type="button" class="btn btn-warning btn-sm">Editar</button></a>

                      @endif
                      
                  </div>

              </div>

              <br>

              @if (getValueJS(Auth::user()->permisosERP,'productoStock'))

                <div class="row mtop16">
                  
                  <div class="col-md-12">

                    <div class="card-header" style="background-color:blue;color:white">
                      <h3 class="card-title">Stock en Depositos</h3>
                    </div>

                    <table class="table table-hover text-nowrap" >
                          
                      <thead>
                              
                        <tr>
                            <th> Deposito </th>
                            <th> Stock </th>                                     
                        </tr>
                          
                      </thead>

                      <tfoot>

                        <tr>
                            <th></th>
                            <th></th>
                        </tr>

                      </tfoot>

                      <tbody>
                            
                        @foreach ($producto->getInventario as $deposito)
                              
                          <tr bor>
                            
                            <td> {{ $deposito->getDeposito($deposito->deposito_id)->nombre }} </td>
                            <td> {{ $deposito->stock }} </td> 
                          </tr>

                        @endforeach

                      </tbody>
                    
                    </table>
              
                  </div>
              
                </div>

              @endif
            
            </div>
            
          </div>
        </div>
        </div>
    </div>
</div>


@endsection
