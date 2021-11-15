@extends('layouts.app')

@section('title','Detalle Deposito')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/depositos')}}" class="nav-link"> <i class="fas fa-warehouse"></i> </i> Depositos  </a>
                                    
    </li>

    <li class="breadcrumb-item">
            
        <a href="#" class="nav-link"> <i class="far fa-eye"></i> Detalle  </a>
                                                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">
    
        <div class="header">
            
            <h2 class="title"> <a href="#"> <i class="far fa-eye"></i> Detalle  </a>  </h2> 
        
        </div>

        <div class="inside">

            <div class="row">
                          
                <div class="col-md-6">
                                          
                    <label for="name">Nombre:</label>

                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                        {!!Form::text('nombre',$deposito->nombre,['class' => 'form-control','readonly'=>'true'])!!}    
                                              
                    </div>
                                                  
                </div>

                <div class="col-md-6">
                                          
                    <label for="name">Telefono:</label>
                                  
                    <div class="input-group">
                                                                        
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                                                                    
                        {!!Form::text('telefonos',$deposito->telefonos,['class' => 'form-control','readonly'=>'true'])!!}    
                                                                    
                    </div>
                                                                        
                </div>

            </div>

            <div class="row mtop16">
                            
                <div class="col-md-6">
                                                      
                      <label for="name">Direccion:</label>
                          
                      <div class="input-group">
                                                                
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                            
                          {!!Form::text('direccion',$deposito->direccion,['class' => 'form-control','readonly'=>'true'])!!}    
                                                            
                      </div>
                                                              
                </div>

                <div class="col-md-6">
                                                      
                      <label for="name">Ciudad:</label>
                                              
                      <div class="input-group">
                                                                                    
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-city"></i></span>
                                                                                
                          {!!Form::text('ciudad',$deposito->ciudad,['class' => 'form-control','readonly'=>'true'])!!}    
                                                                                
                      </div>
                                                                                    
                </div>
                        
            </div>

            <div class="row mtop16">
                            
                <div class="col-md-6">
                                                      
                      <label for="name">Codigo Postal:</label>
                          
                      <div class="input-group">
                                                                
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                            
                          {!!Form::text('codigo_postal',$deposito->codigo_postal,['class' => 'form-control','readonly'=>'true'])!!}    
                                                            
                      </div>
                                                              
                </div>

                <div class="col-md-6">
                                                      
                      <label for="name">Provincia:</label>
                                              
                      <div class="input-group">
                                                                                    
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-city"></i></span>

                          {!!Form::text('provincia_id',$deposito->provincia->nombre,['class' => 'form-control','readonly'=>'true'])!!} 
                                                                                                                                                        
                      </div>
                                                                                    
                </div>
                        
            </div>

            <div class="opts mtop16">

                <a class="delete" href="{{ url('/depositos') }}" title="Volver"> <i class="fas fa-arrow-left"></i> Volver </a>
                
                @if (getValueJS(Auth::user()->permisosERP,'depositoEdit'))

                <a class="edit" href="{{ url('depositos/edit/'.$deposito->id) }}" title="Editar Cliente"> <i class="fas fa-edit"></i> Editar </a> 
         
                @endif

            <div>

        </div>
            
    </div>
    
</div>

@if (getValueJS(Auth::user()->permisosERP,'depositoStock'))

<div class="container-fluid mtop16">

    <div class="panel shadow">
    
      <div class="header">
          
          <h2 class="title"> <a href="#">  <i class="fas fa-boxes"></i> Inventario de Productos </a>  </h2> 
      
      </div>

      <div class="inside">

          <div class="opts mtop16">

              @if (getValueJS(Auth::user()->permisosERP,'depositoMovimiento'))

              <a class="primary" href="{{ url('depositos/moverProducto/'.$deposito->id) }}" title="Mover Productos"> <i class="fas fa-truck-moving"></i></a>

              @endif

              @if (getValueJS(Auth::user()->permisosERP,'depositoImprimirStock'))

              <a class="delete" href="{{ url('pdf/inventario/'.$deposito->id) }}" title="Imprimir Stock"> <i class="fas fa-file-pdf"></i></a>
                    
              @endif

          <div>
          
          <table class="table table-hover mtop16">
                        
            <thead>
                              
                <tr>
                  <th>Imagen</th>
                  <th>Nombre</th>
                  <th>Stock</th>
                  <th style="display:none">Deposito</th>

                  @if (getValueJS(Auth::user()->permisosERP,'depositoUpdateStock'))

                  <th> Actualizar Stock </th>  
                
                  @endif

                </tr>
            
            </thead>
                                    
            <tbody>
                            
                @foreach ($deposito->getInventario as $producto)
                            
                  <tr>
                      <td width="64px">
                        <a  data-fancybox="gallery" href="{{ url('img/productos/'. $producto->getProducto($producto->producto_id)->imagen) }}"> 
                          <img src=" {{ url('img/productos/'.$producto->getProducto($producto->producto_id)->imagen) }}" width="64px" > 
                        </a>
                      </td>
                      <td style="text-align:center;">{{ $producto->getProducto($producto->producto_id)->nombre }}</td>
                      <td style="text-align:center;">{{ $producto->stock }}</td>
                      <td style="display:none;">{{ $producto->id }}</td>
                      
                      @if (getValueJS(Auth::user()->permisosERP,'depositoUpdateStock'))
                      
                        <td style="text-align:center;"><a href="#" class="btn btn-link" data-toggle="modal"  data-target="#exampleModal" title="Actualizar Stock" data-original-title="Ver Detalle" onclick="seleccionarProducto()"><i class="nav-icon fas fa-boxes"></i></a>  </td>
                      
                      @endif
                </tr>
                          
              @endforeach
                                    
            </tbody>
            
          </table>

      </div>
    
    </div>
  
</div> 
    
@endif

<!-- Modal Actualizar Stock-->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
      
      <div class="modal-content">
		      
          <div class="modal-header">
        	  
              <h5 class="modal-title" id="tituloUpdate">Actualizar Stock</h5>
     	    
          </div>
          
          <div class="modal-body">

            <div class="card-body table-responsive p-0">
            
                <form method="post" action="{{ route('depositos.stock')}}" role="form">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  
                  <div class="row">
                      
                      <input type="hidden" class="form-control" placeholder="Enter ..." id="idUpdate" name="idUpdate">
                      
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        
                        <div class="form-group">
                        
                          <label> Producto </label>
                        
                          <input type="text" class="form-control" placeholder="Enter ..." id="productoUpdate" readonly name="productoUpdate">
                        
                        </div>
                      
                      </div>
                  
                  </div>
                    
                  <div class="row">
                      
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        
                        <div class="form-group">
                        
                            <label>Stock</label>
                        
                            <input type="text" class="form-control" placeholder="Enter ..." id="stockDisponibleUpdate" name="stockUpdate">
                        
                        </div>
                      
                      </div>

                  </div>

                  <div class="row">
                      
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                      
                          <div class="form-group">
                          
                            <button type="submit" class="btn btn-success">Actualizar </button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      
                          </div>
                      
                      </div>
                  
                  </div>


                </form>  
                
            </div>

          </div>

      </div>
    
    </div>

</div>

<!-- FIN Modal-->	

@endsection

@push ('scripts')

<script>

function seleccionarProducto(){
  $("table tbody tr").click(function() {
        var filaProducto = $(this).find("td:eq(1)").text();
				var filaStockDisponible = $(this).find("td:eq(2)").text();
		 		var filaDepositoid= $(this).find("td:eq(3)").text();
        $("#idUpdate").val(filaDepositoid);
        $("#productoUpdate").val(filaProducto);
				$("#stockDisponibleUpdate").val(filaStockDisponible);
			});
		}

</script>

@endpush

