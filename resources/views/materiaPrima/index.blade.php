@extends('layouts.app')
@section('content')

<div class="container">
    
    <div class="row justify-content-center">
        
        <div class="col-md-12">

          <section class="content-header">
            
            <div class="container-fluid">
              
              <div class="row mb-2">
                  
                  <div class="col-sm-6">
                    
                    <h1> Materias Primas </h1>
                
                  </div>

              </div>

            </div>

          </section>

          <div class="row">

              <div class="col-12">
                  
                  <div class="card">
                      
                      <div class="card-header">
                          
                          <h3 class="card-title"> <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalIngreso" title="Agregar" data-original-title="Registrar Materia Prima">Agregar</button>  </h3>

                          <div class="card-tools">

                              <form class="form-inline" action="{{ route('materiales.index') }}" role="form">
                                
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
                                <th style="display:none;"> Id </th>
                                <th> Materia Prima </th>
                                <th> Descripcion </th>
                                <th> Detalle </th>
                                <th> Costo </th> 
                                <th style="display:none;"> Costo </th>     
                                <th style="display:none;"> Moneda </th>  
                                <th> </th>                            
                            </tr>
                        
                        </thead>

                        <tfoot>

                            <tr>
                                <th style="display:none;"> Id </th>
                                <th> Descripcion </th>
                                <th> Detalle </th>
                                <th> Costo Unitario </th>  
                                <th style="display:none;"> Costo </th>    
                                <th style="display:none;"> Moneda </th>  
                                <th> </th>  
                            </tr>

                        </tfoot>

                        <tbody>
                          
                          @foreach ($materiales as $material)
                            
                            <tr>
                                <td style="display:none;"> {{ $material->id}} </td>
                                <td> 
                                    @if(($material->imagen != ""))               
                                      <img src="{{asset('img/productos/'.$material->imagen)}}" style="width: 100PX; height: 70px;">
                                    @else
                                      <img src="{{asset('img/productos/imagenNoDisponible.jpg')}}" style="width: 100PX; height: 70px;">
                                    @endif
                                </td>
                                <td> {{ $material->descripcion}} </td>
                                <td> {{ $material->detalle }} </td>
                                @if($material->moneda == 'Pesos')
                                <td> AR$ {{ round($material->costo,2)}} </td>
                                @else
                                <td> U$D {{ round($material->costo,2)}} </td>
                                @endif
                                <td style="display:none;"> {{$material->costo}} </td>
                                <td style="display:none;"> {{$material->moneda}} </td>
                                <td>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalEditar" title="Agregar" data-original-title="Registrar Materia Prima" onclick="SeleccionarMateriaPrima()">Editar</button>
                                </td> 
                            </tr>

                          @endforeach

                        </tbody>
                  
                      </table>

                      {{$materiales->render()}}
                  
                  </div>
                
              </div>

          </div>
        
        </div>

    </div>

</div>

<!-- Modal Agregar Dinero-->

<div class="modal fade bd-example-modal-lg" id="ModalIngreso" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
		        
            <div class="modal-header">
        	      <h5 class="modal-title" id="titulo">Registrar Materia Prima</h5>		
     	      </div>
            
            <div class="modal-body">
	            
              <div class="card-body">

                  <form method="post" action="{{ route('materiales.store')}}" role="form" enctype="multipart/form-data">
                    
                    {{ csrf_field() }}
                    
                    <div class="row">

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          
                          <div class="form-group">
                              
                              <label>Descripcion</label>

                                  <div class="input-group">

                                    <div class="input-group-prepend">
                                      
                                      <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>

                                    </div>
                                      
                                    <input type="text" class="form-control input-lg" placeholder="Enter ..." id="descripcion" name="descripcion" required>

                                  </div>
                     
                          </div>
                    
                      </div>

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          
                          <div class="form-group">
                              
                              <label>Detalle</label>
                              
                              <div class="input-group">

                                <div class="input-group-prepend">
                                  
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>

                                </div>
                                  
                                <input type="text" class="form-control input-lg" placeholder="Enter ..." id="detalle" name="detalle">

                              </div>
                     
                          </div>

                      </div>
                
                    </div>
                    
                    <div class="row">

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          
                          <div class="form-group">
                              
                              <label>Costo Unitario</label>

                                  <div class="input-group">

                                    <div class="input-group-prepend">
                                      
                                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill"></i></span>

                                    </div>
                                      
                                    <input type="number" class="form-control input-lg" placeholder="Enter ..." id="costo" name="costo" min="0" max="999" step="0.01" required>

                                  </div>
                     
                          </div>
                    
                      </div>

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          
                          <div class="form-group">
                              
                              <label>Moneda</label>
                              
                              <div class="input-group">

                                  <select class="form-control select2" style="width: 100%;" id="pmoneda" name="moneda">
                                    
                                    <option value="Pesos">Pesos</option>
                                    <option value="Dolares">Dolares</option>

                                  </select>
                                
                              </div>
                     
                          </div>

                      </div>
                
                    </div>
                                          
                    <div class="row">

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          
                          <div class="form-group">
                              
                              <label>Imagen</label>

                                  <div class="input-group">

                                    <div class="input-group-prepend">
                                      
                                      <span class="input-group-text" id="basic-addon1"><i class="far fa-image"></i></span>

                                    </div>
                                      
                                    <input type="file" class="form-control input-lg" placeholder="Enter ..." id="img" name="img">

                                  </div>

                          </div>

                      </div>

                    </div>
                    
                    <div class="row">

                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    
                        <div class="form-group">
                    
                          <button type="submit" class="btn btn-primary btn-sm">Registrar</button>

                          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
                    
                        </div>
                      
                      </div>
                    
                    </div>


                  </form>  
                  
              </div>

            </div>
          
        </div>

    </div>

</div>


<!-- FIN Modal Agregar Dinero-->	

<!-- Modal Editar Dinero-->

<div class="modal fade bd-example-modal-lg" id="ModalEditar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
		        
            <div class="modal-header">
        	      <h5 class="modal-title" id="titulo">Editar Materia Prima</h5>		
     	      </div>
            
            <div class="modal-body">
	            
              <div class="card-body">

                  <form method="post" action="{{ route('materiales.edit')}}" role="form" enctype="multipart/form-data">
                    
                    {{ csrf_field() }}
                    
                    <div class="row">

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          
                          <div class="form-group">
                              
                              <label>Descripcion</label>

                                  <div class="input-group">

                                    <div class="input-group-prepend">
                                      
                                      <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>

                                    </div>

                                    <input type="hidden" class="form-control input-lg" placeholder="Enter ..." id="pid" name="material_id" required>
                                      
                                    <input type="text" class="form-control input-lg" placeholder="Enter ..." id="pdescripcion" name="descripcion" required>

                                  </div>
                     
                          </div>
                    
                      </div>

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          
                          <div class="form-group">
                              
                              <label>Detalle</label>
                              
                              <div class="input-group">

                                <div class="input-group-prepend">
                                  
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>

                                </div>
                                  
                                <input type="text" class="form-control input-lg" placeholder="Enter ..." id="pdetalle" name="detalle">

                              </div>
                     
                          </div>

                      </div>
                
                    </div>
                    
                    <div class="row">

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          
                          <div class="form-group">
                              
                              <label>Costo Unitario</label>

                                  <div class="input-group">

                                    <div class="input-group-prepend">
                                      
                                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill"></i></span>

                                    </div>
                                      
                                    <input type="text" class="form-control input-lg" placeholder="Enter ..." id="pcosto" name="costo" min="0" max="999" step="0.01" required>

                                  </div>
                     
                          </div>
                    
                      </div>

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          
                          <div class="form-group">
                              
                              <label>Moneda</label>
                              
                              <div class="input-group">

                                  <select class="form-control select2" style="width: 100%;" id="monedas" name="moneda">
                                    <option value="Pesos">Pesos</option>
                                    <option value="Dolares">Dolares</option>

                                  </select>
                                
                              </div>
                     
                          </div>

                      </div>
                
                    </div>
                                          
                    <div class="row">

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          
                          <div class="form-group">
                              
                              <label>Imagen</label>

                                  <div class="input-group">

                                    <div class="input-group-prepend">
                                      
                                      <span class="input-group-text" id="basic-addon1"><i class="far fa-image"></i></span>

                                    </div>
                                      
                                    <input type="file" class="form-control input-lg" placeholder="Enter ..." id="img" name="img">

                                  </div>

                          </div>

                      </div>

                    </div>
                    
                    <div class="row">

                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    
                        <div class="form-group">
                    
                          <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>

                          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
                    
                        </div>
                      
                      </div>
                    
                    </div>


                  </form>  
                  
              </div>

            </div>
          
        </div>

    </div>

</div>


<!-- FIN Modal Editar Dinero-->	

@endsection

@push ('scripts')
  
<script>

function SeleccionarMateriaPrima(){

  $("table tbody tr").click(function() {
      var filaid= $(this).find("td:eq(0)").text();
      var filaDescripcion = $(this).find("td:eq(2)").text();
      var filaDetalle = $(this).find("td:eq(3)").text();
      var filaCosto = $(this).find("td:eq(5)").text();
      var filaMoneda = $(this).find("td:eq(6)").text();


      $("#pid").val(filaid);
      $("#pdescripcion").val(filaDescripcion);
      $("#pdetalle").val(filaDetalle);
      $("#pcosto").val(filaCosto);
      $("#monedas").empty();
      select = document.getElementById("monedas");
      option = document.createElement("option");
      option.value = filaMoneda;
      option.text = filaMoneda;
      $("#monedas").prepend("<option value='"+ filaMoneda + "'>"+ filaMoneda +"</option>");
      $("#monedas").append('<option value="Pesos">Pesos</option>');
      $("#monedas").append('<option value="Dolares">Dolares</option>');
  });

}

</script>
@endpush