@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
      
      <div class="col-md-12">

        <section class="content-header">
          
          <div class="container-fluid">
            
            <div class="row mb-2">
              
              <div class="col-sm-6">
                
                <h1>Comisiones</h1>
              
              </div>

            </div>
          
          </div>
        
        </section>
        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                
                <h3 class="card-title">Listado de Vendedores</h3>

                  <div class="card-tools">
                    
                    <div class="input-group input-group-sm" style="width: 250px;">  
                      
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar" id="searchTerm"  onkeyup="doSearch()">

                      <div class="input-group-append">
                        
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      
                      </div>

                    </div>

                  </div>

              </div>

              <div class="card-body table-responsive p-0">
                
                <table class="table table-hover text-nowrap" id="datos">
                  
                  <thead>
                    
                    <tr>                    
                        <th style="text-align:center;"> <button type="button" class="btn btn-link" data-toggle="modal" data-target="#crearComision" title="Asignar Porcentajes" data-original-title="Agregar Cliente"><i class="fas fa-plus"></i></a></button> </th>
                        <th style="text-align:center;"> Apellido y Nombre </th>
                        <th style="text-align:center;"> Porcentaje </th>
                        <th style="text-align:center;"> Bonus </th>
                        <th style="text-align:center;"> Valor Bonus </th>
                        <th style="text-align:center;"> Detalle </th> 
                    </tr>
                  
                  </thead>
                  
                  <tbody>

                      @foreach ($vendedores as $vendedor)
                      
                    <tr>
                        <td style="text-align:center;">{{$loop->iteration}}</td>
                        <td style="text-align:center;">{{ $vendedor->apellido}} {{$vendedor->nombre}}</td>
                        <td style="text-align:center;">{{ $vendedor->porcentaje }} %</td>
                        <td style="text-align:center;"> AR$ {{ $vendedor->bonus }} </td>
                        <td style="text-align:center;"> AR$ {{ $vendedor->valorBonus }} </td>
                        <td style="text-align:center;">
                        <a href="{{route('comisiones.show', $vendedor->id)}}"class="btn btn-link" data-toggle="tooltip" title="Pagar Comision" data-original-title="Pagar Comision"><i class="far fa-eye" style="color:green"></i></a>
                        <a href="{{ route('comisiones.edit', $vendedor->id) }}" class="btn btn-link" data-toggle="tooltip" title="Editar Comision" data-original-title="Editar Cliente"><i class="fas fa-pencil-alt" style="color:black; font-size: 20px;"></i></a>
                        </td>
                    </tr>
                      
                      @endforeach
                  </tbody>

                  <tfoot>

                    <tr>
                        <th</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                  
                  </tfoot>
                
                </table>
              
              </div>
            
            </div>

          </div>

          </div>

        </div>

    </div>

</div>




<div class="modal fade bd-example-modal-lg" id="crearComision" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">
      
      <div class="modal-content">
		      
          <div class="modal-header">
        	  <h5 class="modal-title" id="titulo">Asignar Porcentajes</h5>		
     	    </div>
          
          <div class="modal-body">
	          
            <div class="card-body">
              
              <form method="post" action="{{ route('porcentaje.store')}}" role="form">
                
                {{ csrf_field() }}
                
                <div class="row">

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                          
                          <label>Vendedor</label>
                          
                          <select class="form-control select2" style="width: 100%;" id="vendedor_id" name="vendedor_id" required>

                            @foreach($usuarios as $usuario)
                            <option value="{{$usuario->id}}">{{$usuario->apellido}} {{$usuario->nombre}}</option>
                            @endforeach

                          </select>
                        
                        </div>

                    </div>
                
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                          
                          <label>Porcentaje</label>
                          <input type="text" class="form-control" placeholder="Enter ..." id="porcentaje" name="porcentaje" value="7">
                        
                        </div>

                    </div>

                    
                </div>

                <div class="row">

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                          
                          <label>Bonus Ventas</label>
                          <input type="text" class="form-control" placeholder="Enter ..." id="bonus" name="bonus" value="1500">
                        
                        </div>

                    </div>
                  

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                          
                          <label>Valor Bonus</label>
                          <input type="text" class="form-control" placeholder="Enter ..." id="valorBonus" name="valorBonus" value="500">
                        
                        </div>

                    </div>
                                

                </div>
              
                <div class="row">
                  
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    
                      <div class="form-group">
                          
                          <button type="submit" class="btn btn-primary">Asignar</button>

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

@endsection
