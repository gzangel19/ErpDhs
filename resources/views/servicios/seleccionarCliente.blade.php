@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
      
      <div class="col-md-12">

        <section class="content-header">
          
          <div class="container-fluid">
            
            <div class="row mb-2">
              
              <div class="col-sm-6">
                
                <h1> Servicio Tecnico </h1>
              
              </div>

            </div>
          
          </div>
        
        </section>
        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                
                <h3 class="card-title"> Seleccione Cliente </h3>

                  <div class="card-tools">
                           
                          <form class="form-inline" action="{{ route('servicios.cliente') }}" role="form">
                                
                                <div class="input-group input-group-sm" style="width: 350px;">
                                  
                                  <select class="form-control" name="searchCondicion">                                
                                    <option value="razon_Social">Nombre</option>    
                                    <option value="cuit_cuil">Cuil / Cuit</option>  
                                    <option value="num_cliente">Numero Cliente</option>               
                                  </select>
                                  
                                  <input type="text" name="searchText" class="form-control float-right" placeholder="Buscar">
                                                                
                                  <div class="input-group-append">
                                      
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  
                                  </div>

                                </div>

                          </form>

                  </div>

              </div>

              <div class="card-body table-responsive p-0">
                
              <table class="table table-hover text-nowrap" id="datos">
                    <thead>
                      <tr>
                          <th style="text-align:center;">
                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#ModalCliente" title="Agregar Cliente" data-original-title="Agregar Cliente"><i class="fas fa-plus"></i></a></button>
                          </th>
                          <th style="text-align:center">Numero</th>
                          <th style="text-align:center">Cliente</th>
                          <th style="text-align:center">Seleccione</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($clientes as $cliente)
                  <tr>
                    <td style="text-align:center">{{$loop->iteration}}</td>
                    <td style="text-align:center">{{ $cliente->num_cliente}}</td>  
                    <td style="text-align:center">{{ $cliente->razon_Social}}</td>  
                    <td style="text-align:center">
                     <a href="{{ route('servicios.equipos', $cliente->id) }}"  class="btn btn-success" data-toggle="tooltip" title="Seleccionar" data-original-title="Seleccionar"><i class="fas fa-check"></i></a>
                    </td>

                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                
                {{$clientes->render()}}
              
              </div>
            
            </div>

          </div>

          </div>

        </div>

    </div>

</div>


<!-- Modal Agregar Cede-->

<div class="modal fade bd-example-modal-lg" id="ModalCliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">
      
      <div class="modal-content">
		      
          <div class="modal-header">
        	  <h5 class="modal-title" id="titulo">Agregar Cliente Servicio</h5>		
     	    </div>
          
          <div class="modal-body">
	          
            <div class="card-body">
              
              <form method="post" action="{{ route('servicios.storeCliente')}}" role="form">
                {{ csrf_field() }}
                
                <div class="row">
                
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                          
                          <label>Nombre</label>
                          <input type="text" class="form-control" placeholder="Enter ..." id="nombre" name="nombre" required>
                        
                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                        
                            <label>Género</label>
                              
                            <select class="form-control select2" style="width: 100%;" id="genero" name="genero">
                              <option value="otro">Otro</option>
                              <option value="femenino">Femenino</option>
                              <option value="masculino">Masculino</option>
                            </select>
                    
                        </div>
  
                    </div>
                  
                </div>

                <div class="row">
                                  
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                    
                          <label>Tipo</label>
                            
                          <select class="form-control select2" style="width: 100%;" id="tipo" name="tipo">
                            <option value="persona">Fisica</option>
                            <option value="empresa">Empresa</option>
                          </select>
                
                        </div>
                    
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                          
                          <label>CUIT/CUIL</label>
                          
                          <input type="text" class="form-control" placeholder="Enter ..." id="cuil_cuit" name="cuil_cuit" required>
                        
                        </div>

                    </div>

                </div>

                <div class="row">
                                
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    
                        <div class="form-group">
                    
                          <label>Telefono</label>
                    
                          <input type="text" class="form-control" placeholder="Enter ..." id="telefonos" name="telefonos" required>
                    
                        </div>
                    
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                          
                          <label>Direccion</label>
                          <input type="text" class="form-control" placeholder="Enter ..." id="direccion" name="direccion" required>
                        
                        </div>

                    </div>
                  
                </div>

                <div class="row">

                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                      
                      <div class="form-group">
                      
                        <label>Provincia</label>
                      
                        <select class="form-control select2" style="width: 100%;" id="provincia_id" name="provincia_id" required>
                          
                          <option value="">Seleccione una Provincia</option>
                            
                          @foreach($provincias as $provincia)
                          <option value="{{$provincia->id}}">{{$provincia->nombre}}</option>
                          @endforeach

                        </select>
                  
                      </div>

                  </div>
              
                </div>


                <div class="row">
                  
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    
                      <div class="form-group">
                          
                          <button type="submit" class="btn btn-primary">Agregar</button>

                          <button type="submit" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

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

@push ('scripts')
  
<script>

$( function() {
    $("#cuentaCorriente").change( function() {
        if ($(this).val() === "No") {
            $("#montoCuenta").prop("disabled", true);
            $("#montoCuentaPesos").prop("disabled", true);
            $("#montoCuenta").prop("value", '0');
            $("#montoCuentaPesos").prop("value", '0');
        } else {
            $("#montoCuenta").prop("disabled", false);
            $("#montoCuentaPesos").prop("disabled", false);
            $("#montoCuenta").prop("value", '0');
            $("#montoCuentaPesos").prop("value", '0');
        }
    });
})

</script>
@endpush