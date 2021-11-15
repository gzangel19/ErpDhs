@extends('layouts.munay')
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
                    <p> <b> Nombre: </b>{{$producto->nombre}} 
                    
                    <p> <b> Descripcion </b>{{$producto->descripcion}}</p>

                    <p><b> Unidad de Negocio: </b> {{$producto->unidades_negocios->nombre}}</p>

                    <p><b> Costo Total:  </b> AR$ {{$producto->cantidad}}</p>

                    <p><b> Utilidad: </b> {{$producto->beneficio}} %</p>

                    <p><b> Precio Cotizado: </b>  AR$ {{$producto->cantidad + ($producto->cantidad * ($producto->beneficio/100))}}</p>

                    <p><b> Precio Publico: </b>  AR$ {{ round($producto->precioLocal,2)}} </p>
                    
                                   
                  </div>

              </div>

              <br>

              <div class="row">
                
                <div class="col-md-12">

                  <div class="card-header" style="background-color:blue;color:white">
                   
                    <h3 class="card-title">Materias Primas</h3>
                  
                  </div>

                  <br>

                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalAñadir" title="Añadir Materia Prima" data-original-title="Registrar Materia Prima"> Añadir </button> 

                  <table class="table table-hover text-nowrap" id ="ejemplos">
                        
                    <thead>
                            
                      <tr>
                          <th  style="text-align:center; display:none"> id </th>
                          <th> Descripcion </th>
                          <th  style="text-align:center; display:none"> Cantidad </th>
                          <th  style="text-align:center"> Cantidad </th> 
                          <th  style="text-align:center"> Costo Unitario </th>  
                          <th  style="text-align:center"> Sub Total </th>
                          <th  style="text-align:center"> Opciones </th>                                     
                      </tr>
                        
                    </thead>

                    <tbody>
                          
                      @foreach ($materiaPrimas as $mp)
                            
                        <tr>
                          <td style="display:none"> {{ $mp->id}} </td>
                          <td> {{ $mp->material->descripcion}} </td>
                          <td style="text-align:center; display:none"> {{ $mp->cantidad}} </td>
                          <td style="text-align:center"> {{ $mp->cantidad}} [u] </td>
                          <td style="text-align:center"> AR$ {{ $mp->material->costo}} </td>
                          <td style="text-align:center"> AR$ {{ $mp->material->costo * $mp->cantidad}} </td> 
                          <td style="text-align:center"> 
                          
                          <form method="POST" action="{{ route('cotizaciones.destroy',$mp->id )}}">
                            
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalIngreso" title="Editar Materia Prima" data-original-title="Registrar Materia Prima" onclick="SeleccionarMateriaPrima()">Editar</button> 
                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar Materia Prima" data-original-title="Registrar Materia Prima" onclick="return confirm('¿Seguro que deseas eliminar esta Materia Prima?')">
                            <span aria-hidden="true" class="glyphicon glyphicon-trash">
                            </span>
                            Eliminar
                            </button> 
                          </form>
                          
                          
                          </td> 
                        </tr>

                      @endforeach

                    </tbody>
                  
                  </table>
            
                </div>
            
              </div>
            
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
        	      <h5 class="modal-title" id="titulo">Editar Materia Prima</h5>		
     	      </div>
            
            <div class="modal-body">
	            
              <div class="card-body">

                  <form method="post" action="{{ route('cotizaciones.editar')}}" role="form" enctype="multipart/form-data">
                    
                    {{ csrf_field() }}
                    
                    <div class="row">

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          
                          <div class="form-group">
                              
                              <label>Descripcion</label>

                                  <div class="input-group">

                                    <div class="input-group-prepend">
                                      
                                      <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>

                                    </div>
                                      
                                    <input type="text" class="form-control input-lg" placeholder="Enter ..." id="pdescripcion" name="descripcion" readonly>

                                    <input type="hidden" class="form-control input-lg" placeholder="Enter ..." id="pid" name="id">

                                  </div>
                     
                          </div>
                    
                      </div>

                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                          
                          <div class="form-group">
                              
                              <label> Cantidad </label>
                              
                              <div class="input-group">

                                <div class="input-group-prepend">
                                  
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>

                                </div>
                                  
                                <input type="text" class="form-control input-lg" placeholder="Enter ..." id="pcantidad" name="cantidad">

                              </div>
                     
                          </div>

                      </div>
                
                    </div>
                            
                    <div class="row">

                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    
                        <div class="form-group">
                    
                          <button type="submit" class="btn btn-primary btn-sm"> Actualizar </button>

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

<!-- Modal Agregar Dinero-->

<div class="modal fade bd-example-modal-lg" id="ModalAñadir" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
		        
            <div class="modal-header">
        	      <h5 class="modal-title" id="titulo">Añadir Materia Prima</h5>		
     	      </div>
            
            <div class="modal-body">
	            
              <div class="card-body">

                  <form method="post" action="{{ route('cotizaciones.añadir')}}" role="form" enctype="multipart/form-data">
                    
                    {{ csrf_field() }}
                    
                    <div class="row">

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          
                          <div class="form-group">
                              
                              <label> Materia Prima </label>

                                  <div class="input-group">

                                      <select class="form-control select2" style="width: 100%;" id="material_id" name="material_id">
                                        @foreach($materias as $u)
                                        <option value="{{$u->id}}">{{$u->descripcion}}</option>
                                        @endforeach
                                      </select>

                                      <input type="hidden" class="form-control input-lg" placeholder="Enter ..." id="producto_id" name="producto_id" value="{{$producto->id}}">

                                  </div>
                     
                          </div>
                    
                      </div>

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          
                          <div class="form-group">
                              
                              <label> Cantidad </label>
                              
                              <div class="input-group">

                                <div class="input-group-prepend">
                                  
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>

                                </div>
                                  
                                <input type="text" class="form-control input-lg" placeholder="Enter ..." id="cantidad" name="cantidad">

                              </div>
                     
                          </div>

                      </div>
                
                    </div>
                        
                    <div class="row">

                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    
                        <div class="form-group">
                    
                          <button type="submit" class="btn btn-primary btn-sm"> Añadir </button>

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

@endsection

@push ('scripts')
  
<script>

function SeleccionarMateriaPrima(){

    $("table tbody tr").click(function() {
        var filaid= $(this).find("td:eq(0)").text();
        var filaDescripcion = $(this).find("td:eq(1)").text();
        var filaCantidad = $(this).find("td:eq(2)").text();

        $("#pid").val(filaid);
        $("#pdescripcion").val(filaDescripcion);
        $("#pcantidad").val(filaCantidad);

    });

}

</script>
@endpush
