@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Proveedores</h1>
                </div>

              </div>
            </div><!-- /.container-fluid -->
          </section>



          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Detalle de Proveedor</h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">

              <div class="row">
                <div class="col-md-12">
                  <br>
                  <p><b>Nombre </b>{{$proveedor->nombre}}</p>
                  <p><b>Razon Social </b>{{$proveedor->razon_Social}}</p>
                  <p><b>CUIT / CUIL: </b>{{$proveedor->cuit_cuil}}</p>
                  <p><b>Tel&eacute;fonos: </b>{{$proveedor->telefonos}}</p>
                  <p><b>E-mail: </b>{{$proveedor->email}}</p>
                  <p><b>Rubro: </b>{{$proveedor->rubro->nombre}}</p>
                  <p><b>Direcci&oacute;n: </b>{{$proveedor->direccion}}</p>
                  <p><b>Ciudad: </b>{{$proveedor->ciudad}}</p>
                  <p><b>C.P.: </b>{{$proveedor->codigo_postal}}</p>
                  <p><b>Provincia: </b>{{$proveedor->provincia->nombre}}</p>

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Unidades de Negocio</h3>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>Nombre</th>
                </tr>
              </thead>
              <tbody>
              @foreach($unidadesnegocio_proveedor as $upro)
              <td>{{$upro->nombre}} </td>
                           
              </tbody>
              @endforeach 
            </table>
          </div>


          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Contactos</h3>
            </div>
            <table class="table table-hover text-nowrap" id="tablecliente">
              <thead>
                <tr>
                  <th style="text-align:center;">                  
                  <button type="button" class="btn btn-link" data-toggle="modal" data-target="#ModalCliente">
                  <i class="fas fa-plus"></i></a>
                  </button>
                  </th>
                  <th>Nombre</th>
                  <th>Telefonos</th>
                  <th>E-Mail</th>
                  <th>Sector</th>
                  <th>

                  </th>
                </tr>
              </thead>
              <tbody>
              @foreach($contactos as $con)
              <tr>
              <td style="text-align:center;">{{$con->id}} </td>
              <td>{{$con->nombre}} </td>
              <td>{{$con->telefonos}} </td>
              <td>{{$con->email}} </td>
              <td>{{$con->sector}} </td>
              <td style="width: 5%">
                <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#ModalClienteUpdate" onclick="seleccionarContacto()"><i class="fas fa-pencil-alt" style="color:white"></i></a>
              </td>
              <td style="width:5%">
                <form class="" action="{{ route('ContactosProveedores.destroy', $con->id)}}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <input type="hidden" class="form-control" placeholder="Enter ..." id="proveedor_id" name="proveedor_id" value="{{$proveedor->id}}">
                  <button type="submit" onclick="return confirm('Esta acción no podrá deshacerse. ¿Continuar?')" class="btn btn-danger btn-block"><i class="fas fa-trash-alt" style="color:white"></i></button>
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

<!-- Modal Agregar Contacto-->

<div class="modal fade bd-example-modal-lg" id="ModalCliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
		<div class="modal-header">
        	<h5 class="modal-title" id="titulo">Agregar Contacto</h5>		
     	    </div>
          <div class="modal-body">
	            <div class="card-body">

              <form method="post" action="{{ route('ContactosProveedores.store')}}" role="form">
                {{ csrf_field() }}
                <div class="row">
                <input type="hidden" class="form-control" placeholder="Enter ..." id="id" name="id" value="{{$proveedor->id}}">

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="nombre" name="nombre">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Tel&eacute;fonos</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="telefonos" name="telefonos">
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>E-mail</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="email" name="email">
                    </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Sector</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="sector" name="sector">
                    </div>
                  </div>
                  
                </div>


                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                  </div>
                </div>


              </form>  
                  
              </div>
            </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-link" data-dismiss="modal"><i class="fas fa-times" style="color:red; font-size: 30px;"></i></button>
      </div>
    </div>
  </div>
</div>


<!-- FIN Modal Agregar Contacto-->	


<!-- Modal Actualizar Contacto-->

<div class="modal fade bd-example-modal-lg" id="ModalClienteUpdate" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
		<div class="modal-header">
        	<h5 class="modal-title" id="tituloUpdate">Actualizar Contacto</h5>		
     	    </div>
          <div class="modal-body">
	            <div class="card-body table-responsive p-0">

              <form method="post" action="{{ route('ContactosProveedores.update')}}" role="form">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="row">
                <input type="hidden" class="form-control" placeholder="Enter ..." id="id" name="id" value="{{$proveedor->id}}">
                <input type="hidden" class="form-control" placeholder="Enter ..." id="idUpdate" name="idContacto">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="nombreUpdate" name="nombre">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Tel&eacute;fonos</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="telefonosUpdate" name="telefonos">
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>E-mail</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="emailUpdate" name="email">
                    </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Sector</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="sectorUpdate" name="sector">
                    </div>
                  </div>
                  
                </div>


                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                  </div>
                </div>


              </form>  
                  
              </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- FIN Modal Actualizar Contacto-->	
@endsection

@push ('scripts')

<script>

function seleccionarContacto(){
  $("table tbody tr").click(function() {
		 		var filaid= $(this).find("td:eq(0)").text();
	     	var filaNombre = $(this).find("td:eq(1)").text();
				var filaTelefono = $(this).find("td:eq(2)").text();
  			var filaEmail = $(this).find("td:eq(3)").text();
        var filaSector= $(this).find("td:eq(4)").text();
        $("#idUpdate").val(filaid);
        $("#nombreUpdate").val(filaNombre);
				$("#sectorUpdate").val(filaSector);
				$("#telefonosUpdate").val(filaTelefono);
				$("#emailUpdate").val(filaEmail);
			});
		}

    </script>
    
@endpush