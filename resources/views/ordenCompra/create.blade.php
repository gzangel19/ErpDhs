@extends('layouts.app')
@section('content')

<div class="container">
    
	<div class="row justify-content-center">
	
	<div class="col-md-12">
	    <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Orden de Compra</h1>
                </div>

              </div>
            </div><!-- /.container-fluid -->
        </section>
		
		

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Nueva Orden de Compra</h3>
            </div>

			<div class="card-body">
            <!-- /.card-header -->

			<form method="post" action="{{ route('ordenCompra.store')}}" name="formulario">
            
			{{ csrf_field() }}

			<div class="row">
                
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                      <label>Moneda</label>
                      <select class="form-control select2" style="width: 100%;" id="tipo" name="tipo">
                        <option value="Pesos">Pesos</option>
                        <option value="Dolares">Dolares</option>
                      </select>
                    </div>
                </div>

				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                      <label>Forma de Pago</label>
                      <select class="form-control select2" style="width: 100%;" id="formaPago" name="formaPago">
                        <option value="Pesos">Efectivo</option>
                        <option value="Dolares">Transferencia</option>
						<option value="Dolares">Cheque</option>
                      </select>
                    </div>
                </div>

            </div>

			<div class="row">
                
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                    <div class="form-group">
                      <label>Detalle:</label>
					  <input type="text" name="cuenta" id="cuenta" class="form-control" placeholder="">
                    </div>
                </div>

            </div>			

			<br>

			<div class="input-group">
                
				<input type="text" readonly name="pnombrePro" id="pnombrePro" class="form-control" placeholder="Seleccione un Proveedor">
				
				<input type="hidden" readonly name="idProveedor" id="idProveedor" class="form-control" placeholder="">
				
				<span class="input-group-btn">
                
					<button type="button" class="btn btn-success" id="btnBuscarProveedor"  data-toggle="modal"  data-target="#ModalProveedor"><i class="fa fa-search"></i>
						Buscar
					</button>

                </span>

        	</div>

			<br>

			<div class="input-group">
                
				<input type="text"  readonly name="pdescripcion" id="pdescripcion" class="form-control" placeholder="Seleccione un Producto">
				
				<input type="hidden" readonly name="pid" id="pid" class="form-control" placeholder="">
				
				<span class="input-group-btn">
                
					<button type="button" class="btn btn-success" id="btnBuscarPducto" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-search"></i>
						Buscar
					</button>

                </span>

        	</div>

			<br>

			

			<div class="row">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
		            <div class="form-group">
		            <label for="cantidad">Cantidad</label>
		            <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
					</div>
                </div>	
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
					 <label>Costo</label>
					 <div class="form-group has-success">
					 <input type="number" name="pcosto" id="pcosto" class="form-control" maxlength="7" placeholder="">
					 </div>
				</div>	
            </div>
			
	<div class="col-lg-12 col-md-12 col-dm-12 col-xs-12">
		<div class="form-group">
		<button class="btn btn-primary" type="button"  id="bt_agregar" onclick="agregar()">Agregar</button>
		</div>
	</div>

	<div class="col-lg-12 col-md-12 col-dm-12 col-xs-12">
		<div class="table-responsive">
		<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
			<thead style="background-color:#caf5a9">
			<th>Opciones</th>
			<th>Producto</th>
			<th>Cantidad</th>
			<th>Costo</th>
			<th>SubTotal</th>
		</thead>
			<tfoot>
				<th >Total</th>
				<th></th>
				<th></th>
				<th></th>
				<th><h4 id="total">$ 00.00</h4> <input type="hidden" name="total_venta" id="total_venta">
			</tfoot>
		<tbody></tbody>
		</table>
	</div>
	<br>
		<div class="col-lg-6 col-md-6 col-dm-6 col-xs-12" id="guardar1">
			<div class="form-group">
				<input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
				<input type="hidden" name="productosEnCompra" id="productosEnCompra" value="[]">
				<button id="guardar" class="btn btn-primary"  type="submit">Guardar</button>
		        <a class="btn btn-danger" href="{{route('compras.index')}}" role="button">Volver</a>
		    </div>
		</div>
	</div>
</div>

</form>

<!-- Modal Productos-->

<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
		<div class="modal-header">
        	<h5 class="modal-title" id="exampleModalLongTitle">Listado de Productos</h5>		
     	 </div>
        <form>
        	Producto a buscar <input id="searchTerm" type="text" onkeyup="doSearch()" />
       	</form>
      <div class="modal-body">
	  <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap" id="datos">
                    <thead>
                      <tr>
					      <th>#</th>
                          <th>Codigo</th>
                          <th>Nombre</th>
						  <th>Opcion</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($productos as $pro)
                  	<tr>
					<td>{{ $pro->id }}</td>
					<td>{{ $pro->codigo }}</td>
                    <td>{{ $pro->nombre }}</td>          
                    <td><button type="button" class="btn btn-success" id="bt_añadir"  data-dismiss="modal" onclick="SeleccionarProducto()">Añadir</button></td>    
                	</tr>
                      @endforeach
                    </tbody>
                  </table>				  
				  
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- FIN Modal Productos-->	

<!-- Modal Proveedores-->

<div class="modal fade bd-example-modal-lg" id="ModalProveedor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	
	<div class="modal-dialog modal-lg">
    	
		<div class="modal-content">
			
			<div class="modal-header">
        		<h4 class="modal-title">Listado de Proveedores</h4>
					
				<form> <input class="btn btn-default" id="searchTerm" type="text" onkeyup="doSearch()" /> 
				<button type="button" class="btn btn-success" id="btnBuscarProveedorModal"><i class="fa fa-search"></i></button>
				</form>
     	 	</div>
        	
      		<div class="modal-body">
	  			
				<div class="table-responsive">
                			
				  	<table class="table table-hover text-nowrap" id="tablecliente">

					  	<thead>
                        	<tr role="row">
								<th class="sorting_asc" tabindex="0" aria-controls="tblSucursales" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Seleccione: activate to sort column descending" style="width: 74px;">Seleccione</th>
								<th style="display:none;" class="sorting" tabindex="0" aria-controls="tblSucursales" rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 8px;">#</th>
								<th class="sorting" tabindex="0" aria-controls="tblSucursales" rowspan="1" colspan="1" aria-label="Razón Social: activate to sort column ascending" style="width: 42px;">Razón Social</th>
								<th class="sorting" tabindex="0" aria-controls="tblSucursales" rowspan="1" colspan="1" aria-label="Dirección: activate to sort column ascending" style="width: 64px;">Logo</th>
							</tr>
						</thead>
             
                    	<tfoot>
                        	<tr>
								<th rowspan="1" colspan="1">Seleccione</th>
								<th style="display:none;" rowspan="1" colspan="1">#</th>
								<th rowspan="1" colspan="1">Razón Social</th>
								<th rowspan="1" colspan="1">Logo</th>
							</tr>
                    	</tfoot>

                   		<tbody>
                    		@foreach ($proveedores as $pro)
                  			<tr>
								<td><button type="button" class="btn btn-success" id="bt_añadir"  data-dismiss="modal"  onclick="SeleccionarProveedor()"><i class="fa fa-check"></i> </button></td>    
								<td style="display:none;">{{ $pro->id }}</td>
								<td>{{ $pro->nombre }}</td> 
								<td>
								@if(($pro->logo != "")) 					              
                     			<img src="{{asset('img/logos/'.$pro->logo)}}" width="100px" height="100px">
                        		@else
                        		<img src="{{asset('img/logos/imagenNoDisponible.jpg')}}" width="100px" height="100px">
                      			@endif 
								</td>                 
                			</tr>
                      		@endforeach
                    	</tbody>
                  	</table> 
					         
                </div>
				<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>Cerrar</button></div>

      		</div>
		</div>
	</div>
      
</div>


<!-- FIN Modal Proveedores-->	

@endsection

@push ('scripts')
  
  <script>
    
   		total = 0;
		var cont=0;
		var subtotal=[];
		var arrProductos = new Array();
        var state =0;

		var pager = new Pager('datos', 2);
		pager.init();
		pager.showPageNav('pager','NavPosicion');
		pager.showPage(1);
		
    	function SeleccionarProducto(){
			
			$("table tbody tr").click(function() {
		 		
				var filaid= $(this).find("td:eq(0)").text();
	     		var filaNombre = $(this).find("td:eq(2)").text();
				$("#pid").val(filaid);
				$("#pdescripcion").val(filaNombre);
			});
		}

		function SeleccionarProveedor(){

			$("#tablecliente tr").click(function() {
				$(this).addClass('selected').siblings().removeClass('selected');
		 		 var filaid= $(this).find("td:eq(1)").text();
	     		 var filaNombre = $(this).find("td:eq(2)").text();
				$("#pnombrePro").val();
				$("#idProveedor").val(filaid);
				$("#pnombrePro").val(filaNombre);
			});

		}
			
		function agregar(){

			idarticulo=$("#pid").val();
			articulo=$("#pdescripcion").val();
			cantidad=$("#pcantidad").val();
			costo = $("#pcosto").val();

        	if (idarticulo!="" && cantidad!="" && cantidad>0 && costo!="")
        	{
				subtotal[cont]= costo * cantidad;
				total=total+subtotal[cont];
				var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td> <td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td> <td class= "idProducto" style="display:none;"><input type="hidden" name="idProducto[]" value="'+idarticulo+'">'+idarticulo+'</td>  <td  class ="cantidad"><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td> <td  class ="precio"><input type="hidden" name="precio[]" value="'+costo+'">'+ costo +'</td> <td  class ="precio"><input type="hidden" name="precio[]" value="'+subtotal+'">'+ subtotal[cont] +'</td> </tr>';
				cont++;
				$('#total').html("$ " + total);
				$('#total_venta').val(total);
		  		$('#detalles').append(fila);
		  		limpiar();
				$("#guardar").show();
				cargar();
			}
			else
			{
				alert("Error al ingresar el detalle del presuesto, revise los datos del producto");
			}
		}
	
	function limpiar(){
		$("#pid").val("");
		$("#pdescripcion").val("");
		$("#pcantidad").val("");
		$("#pcosto").val("");
	}


	function eliminar(index){
		total=total-subtotal[index];
		$('#total').html("$/. " + total);
		$('#total_venta').val(total);
		$('#fila'+index).remove();
		cargar();
	}

		function doSearch(){
            const tableReg = document.getElementById('datos');
            const searchText = document.getElementById('searchTerm').value.toLowerCase();
            let total = 0;
 
            // Recorremos todas las filas con contenido de la tabla
            for (let i = 1; i < tableReg.rows.length; i++) {
                // Si el td tiene la clase "noSearch" no se busca en su cntenido
                if (tableReg.rows[i].classList.contains("noSearch")) {
                    continue;
                }
 
                let found = false;
                const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
                // Recorremos todas las celdas
                for (let j = 0; j < cellsOfRow.length && !found; j++) {
                    const compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                    // Buscamos el texto en el contenido de la celda
                    if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {
                        found = true;
                        total++;
                    }
                }
                if (found) {
                    tableReg.rows[i].style.display = '';
                } else {
                    // si no ha encontrado ninguna coincidencia, esconde la
                    // fila de la tabla
                    tableReg.rows[i].style.display = 'none';
                }
            }
 
            // mostramos las coincidencias
            const lastTR=tableReg.rows[tableReg.rows.length-1];
            const td=lastTR.querySelector("td");
            lastTR.classList.remove("hide", "red");
            if (searchText == "") {
                lastTR.classList.add("hide");
            }
		}
    

	function cargar(){
		let materiales = [];
		document.querySelectorAll('#detalles tbody tr').forEach(function(e){
  		let fila = {
    		idProducto: e.querySelector('.idProducto').innerText,
    		cantidad: e.querySelector('.cantidad').innerText,
    		precio: e.querySelector('.precio').innerText
  		};
  		materiales.push(fila);
		$('#productosEnCompra').val("");
  		$('#productosEnCompra').val(JSON.stringify(materiales) );
	});

	}

</script>
@endpush
