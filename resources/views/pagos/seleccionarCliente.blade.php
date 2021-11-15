@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
      
      <div class="col-md-12">

        <section class="content-header">
          
          <div class="container-fluid">
            
            <div class="row mb-2">
              
              <div class="col-sm-6">
                
                <h1>Pedido en Pesos</h1>
              
              </div>

            </div>
          
          </div>
        
        </section>
        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                
                <h3 class="card-title">Seleccione Cliente</h3>

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
                          <th style="text-align:center;">
                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#ModalCliente" title="Agregar Cliente" data-original-title="Agregar Cliente"><i class="fas fa-plus"></i></a></button>
                          </th>
                          <th style="text-align:center">Cliente</th>
                          <th style="text-align:center">Seleccione</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($clientes as $cliente)
                  <tr>
                    <td style="text-align:center">{{$loop->iteration}}</td>
                    <td style="text-align:center">{{ $cliente->razon_Social}}</td>  
                    <td style="text-align:center">
                     <a href="{{ route('pedidos.seleccionarNegocio', $cliente->id) }}"  class="btn btn-success" data-toggle="tooltip" title="Seleccionar" data-original-title="Seleccionar"><i class="fas fa-check"></i></a>
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
        	  <h5 class="modal-title" id="titulo">Agregar Cliente</h5>		
     	    </div>
          
          <div class="modal-body">
	          
            <div class="card-body">
              
              <form method="post" action="{{ route('clientes.storeCliente')}}" role="form">
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
                    
                          <input type="text" class="form-control" placeholder="Enter ..." id="telefono" name="telefono" required>
                    
                        </div>
                    
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      
                      <div class="form-group">
                        
                        <label>Facturacion</label>
                        
                        <select class="form-control select2" style="width: 100%;" id="facturacion" name="facturacion">
                          
                          <option value="Si">Si</option>
                            
                          <option value="No">No</option>
        
                        </select>
                      
                      </div>
                    
                    </div>

                </div>

                <div class="row">
                
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                          
                          <label>Direccion</label>
                          <input type="text" class="form-control" placeholder="Enter ..." id="direccion" name="direccion" required>
                        
                        </div>

                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                          
                          <label>Cuenta Corriente</label>
                          
                          <select class="form-control select2" style="width: 100%;" id="cuentaCorriente" name="cuentaCorriente">
                            
                            <option value="No">No</option>
                              
                            <option value="Si">Si</option>
          
                          </select>
        
                        
                        </div>

                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                          
                          <label>Monto Cuenta</label>

                          <input type="text" class="form-control" id="montoCuenta" name="montoCuenta" value="0" disabled="true">
                        
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
            $("#montoCuenta").prop("value", '0');
        } else {
            $("#montoCuenta").prop("disabled", false);
            $("#montoCuenta").prop("value", '0');
        }
    });
})

</script>
@endpush