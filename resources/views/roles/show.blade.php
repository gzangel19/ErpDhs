@extends('layouts.app')
@section('content')

<div class="container">
  
  <div class="row justify-content-center">
    
    <div class="col-md-12">

      <section class="content-header">
        
        <div class="container-fluid">
          
          <div class="row mb-2">
            
            <div class="col-sm-6">
              
              <h1>Deposito: {{$deposito->nombre}}</h1>
            
            </div>

          </div>
        
        </div>
      
       </section>
        
      <div class="card card-secondary">
        
        <div class="card-header">

          <h3 class="card-title">Informacion</h3>
        
        </div>

        <div class="card-body">
        
          <div class="row">
            
            <div class="col-md-12">
              
              <p><b>Telefono: </b>{{$deposito->telefonos}}</p>
              <p><b>Direccion: </b>{{$deposito->direccion}}</p>
              <p><b>Ciudad: </b>{{$deposito->ciudad}}</p>
              <p><b>C.P: </b>{{$deposito->codigo_postal}}</p>
              <p><b>Provincia: </b>{{$deposito->provincia->nombre}}</p>

            </div>

          </div>
        
        </div>
      
      </div>


     

    </div>

  </div>

</div>

<!-- Modal Importar Producto-->

<div class="modal fade bd-example-modal-lg" id="ModalImportProduct" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="overflow-y: auto;">

    <div class="modal-dialog modal-lg">
      
      <div class="modal-content">
		      
          <div class="modal-header">
        	  <h5 class="modal-title" id="tituloUpdate">Actualizar Stock</h5>

              @if(Session::has('error'))

                <p class="text-danger">{{Session::get('error')}}</p>

              @endif

              @if(Session::has('message'))

                <p class="text-info">{{Session::get('message')}}</p>
              
              @endif

     	    </div>
          
          <div class="modal-body">

            <div class="card-body table-responsive p-0">
            
            <form method="post" action="{{ route('depositos.stock')}}" role="form">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="row">
                <input type="hidden" class="form-control" placeholder="Enter ..." id="idUpdate" name="idDepositoProducto">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label> Producto </label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="productoUpdate" readonly name="nombre">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Stock Disponible</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="stockDisponibleUpdate" name="stockDisponibleUpdate">
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Stock Critico</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="stockCriticoUpdate" name="stockCriticoUpdate">
                    </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Ubicacion</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="ubicacionUpdate" name="ubicacionUpdate">
                    </div>
                  </div>
                  
                </div>


                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                    <button type="submit" class="btn btn-success">Actualizar <i class="fas fa-pencil-alt" style="color:#E8EE10"></i></button>
                    </div>
                  </div>
                </div>


              </form>  
                  
            

            <div class="modal-footer">
                <div class="form-group">
                <button type="button" class="btn btn-link" data-dismiss="modal"><i class="fas fa-times" style="color:red; font-size: 30px;"></i></button>
                </div>
             </div>

          </div>

      </div>

    </div>
    
</div>

<!-- FIN Modal Importar-->	

<!-- Modal Importar Producto-->

<div class="modal fade bd-example-modal-lg" id="ModalImportProduct" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg">
      
      <div class="modal-content">
		      
          <div class="modal-header">
        	  <h5 class="modal-title" id="tituloUpdate">Carga de Productos</h5>

              @if(Session::has('error'))

                <p class="text-danger">{{Session::get('error')}}</p>

              @endif

              @if(Session::has('message'))

                <p class="text-info">{{Session::get('message')}}</p>
              
              @endif

     	    </div>
          
          <div class="modal-body">

          <p>Presione <a href="{{ route('productos.download') }}">Aqui</a> para descargar la plantilla a completar</p>
          
          <p>Antes de realizar la carga es importante que:</p>	
          <p>1) No deje Columnas Vacias</p>	 
	        <p>2) Borrar la fila de Encabesado</p>	 
            <div class="card-body">
            
              <form action="{{route('productos.importar.excel')}}" method="post" enctype="multipart/form-data">
                    
                    @csrf
                                 
                <div class="row">

                    <div class="col-xs-24 col-sm-24 col-md-12 col-lg-12 col-xl-12">
                      
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="file" class="form-control" name="file">
                      </div>

                    </div>
                  
                </div>

                <div class="row">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                 
                      <button type="submit" class="btn btn-primary"><i class="fas fa-cloud-upload-alt"></i></button>
                      </div>

                    </div>

                </div>

              </form>  
                  
            </div>

            <div class="modal-footer">
                <div class="form-group">
                <button type="submit" class="btn btn-link"><i class="fas fa-cloud-upload-alt" style="font-size: 20px;"></i></button>
                </div>
             </div>

          </div>

      </div>

    </div>
    
</div>

<!-- FIN Modal Importar-->	

@include('deposito.modalAgregarProductoExcel')

@endsection

@push ('scripts')

<script>

function seleccionarProducto(){
  $("table tbody tr").click(function() {
		 		var filaDepositoid= $(this).find("td:eq(8)").text();
	     	var filaProducto = $(this).find("td:eq(2)").text();
				var filaStockDisponible = $(this).find("td:eq(3)").text();
  			var filaUbicacion = $(this).find("td:eq(4)").text();
        var filaStockCritico= $(this).find("td:eq(7)").text();
        $("#idUpdate").val(filaDepositoid);
        $("#productoUpdate").val(filaProducto);
				$("#stockDisponibleUpdate").val(filaStockDisponible);
				$("#stockCriticoUpdate").val(filaStockCritico);
				$("#ubicacionUpdate").val(filaUbicacion);
			});
		}

</script>

@endpush