
@extends('layouts.app')
@section('content')

<div class="container">
    
	<div class="row justify-content-center">
	
		<div class="col-md-12">
	    	
			<section class="content-header">
            	
				<div class="container-fluid">
              		
            	
				</div>
        	
			</section>

      <div class="row">
          
          <div class="col-12">
            
              <div class="card card-primary">
              
                <div class="card-header">

                  <h3 class="card-title"> Movimiento de Productos Desde {{$deposito->nombre}}</h3>
                  
                </div>
	

				        <div class="card-body">
					
					              <form method="post" action="{{ route('movimientos.store')}}" name="formulario">
				
                            {{ csrf_field() }}

                            <div class="row">	
                            
                              <input type="hidden" readonly name="depositoOrigen_id" id="depositoOrigen_id" class="form-control" placeholder="" value="{{$deposito->id}}">

                            </div>

                            <div class="row">
                            
                              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                              
                                <div class="input-group">
                              
                                  <input type="text" class="form-control" id="pdescripcion" name = "pdescripcion" readonly>
                                      
                                  <span class="input-group-btn">
                                        
                                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModalCenter">Buscar</button>
                                      
                                  </span>
                                
                                </div>
                                
                              </div>

                              <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                
                                <div class="input-group">
                                  
                                  <input type="text" name="pstock" id="pstock" class="form-control" placeholder="Stock" readonly>
                                
                                </div>
                              
                              </div>

                              <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                
                                <div class="input-group">
                                                
                                  <input type="hidden" name="pid" id="pid" class="form-control" placeholder="Cantidad">
                                  
                                  <input type="text" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
                                
                                </div>
                              
                              </div>

                              

                              <div class="col-lg-2 col-md-2 col-dm-2 col-xs-2">
                                
                                <div class="form-group">
                                  
                                  <button class="btn btn-primary" type="button"  id="bt_agregar" onclick="evaluar()">Agregar</button>
                                
                                </div>
                              
                              </div>

                            </div>
                          
                            <div class="row">
                              
                              <div class="col-lg-12 col-md-12 col-dm-12 col-xs-12">
                                  
                                <div class="table-responsive">
                                  
                                  <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color:#caf5a9">
                                      <th>Opciones</th>
                                      <th>Producto</th>
                                      <th>Cantidad</th>
                                    </thead>
                                    <tfoot>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                    </tfoot>

                                    <tbody>
                                    
                                    </tbody>

                                  </table>
                                
                                </div>
                              
                              </div>
                            
                            </div>

                            <div class="row">

                              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                
                                <div class="form-group" id="select_sh">
                                  
                                  <select class="form-select select2" id="depositoDestino_id"  name="depositoDestino_id" >
                                    
                                    <option value="0">Seleccione Deposito</option>
                                    @foreach($depositos as $deposito)
                                    <option value="{{$deposito->id}}">{{$deposito->nombre}}</option>
                                    @endforeach
                                  
                                  </select>
                                
                                </div>

                              </div>
                            
                            </div>

                            <br>
                        

                            <div class="row">
                              
                              <div class="col-lg-6 col-md-6 col-dm-6 col-xs-12" id="guardar1">
                                
                                <div class="form-group">
                                    
                                  <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
                                  <input type="hidden" name="productosEnPedidos" id="productosEnPedidos" value="[]">
                                  <button id="guardar" class="btn btn-primary"  type="submit">Guardar</button>
                                  <a class="btn btn-danger" href="{{route('pedidos.index')}}" role="button">Volver</a>
                                </div>
                              
                              </div>
                            
                            </div>
                          
                        </form>
			
			                </div>

                    </div>
                  
                  </div>
                
                </div>
              
              </div>


<!-- Modal Productos-->

<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
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
                          <th style="display:none;">Codigo</th>
                          <th>Nombre</th>
                          <th style="display:none;">Stock</th>
						  <th style="display:none;">Deposito</th>
						  <th style="display:none;">Precio</th>
						  <th style="display:none;">idDeposito</th>
						  <th>Opcion</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($productos as $pro)
                  	<tr>
					<td style="display:none;">{{ $pro->id }}</td>
					<td style="display:none;">{{ $pro->codigo }}</td>
                    <td>{{ $pro->nombre }}</td>
                    <td style="display:none;">{{ $pro->stock }}</td>
					<td style="display:none;">{{ $pro->depositos }}</td>  
					@if($pro->moneda == 'Dolares')					
					<td  style="display:none;">{{ $pro->local1}}</td>  
					@else
					<td  style="display:none;">{{ $pro->local1}}</td>  
					@endif
					<td style="display:none;">{{ $pro->iddeposito }}</td>             
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
</div>
</div>
</div>
</div>


<!-- FIN Modal Productos-->	

<!-- Modal Clientes-->


<!-- FIN Modal Clientes-->	

@endsection

@push ('scripts')
  
  <script>
    
    	var total=0;
		cont=0;
		fila=0;
		total=0;
		subtotal=[];
		subtotalRedondeado=0;
		totalRedondeado=0;

		var arrProductos = new Array();
        var state =0;
		

		$(document).ready(function (){
      		$('#pcantidad').keyup(function (){
        	this.value = (this.value + '').replace(/[^0-9]/g, '');
      		});
    	});	
    	function SeleccionarProducto(){

			$("table tbody tr").click(function() {
		 		var filaid= $(this).find("td:eq(0)").text();
	     		var filaNombre = $(this).find("td:eq(2)").text();
				var filaStock = $(this).find("td:eq(3)").text();

				$("#pid").val(filaid);
				$("#pdescripcion").val(filaNombre);
				$("#pstock").val(filaStock);

			});
		}

		
			
		function evaluar(){
		 
		 	var indice = 1;

		 	if(indice<=0)	 
			{
				state =0;
				alert("Debe seleccionar un cliente")
				$("#guardar").hide();
			}
			else
			{	
				state = 0;
				agregar();
			}
		}

		function agregar(){

			idarticulo=$("#pid").val();
			articulo=$("#pdescripcion").val();
			cantidad=$("#pcantidad").val();
        	if (idarticulo!="" && cantidad!="" && cantidad>0)
        	{

				var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td> <td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td> <td class= "idProducto" style="display:none;"><input type="hidden" name="idProducto[]" value="'+idarticulo+'">'+idarticulo+'</td>  <td  class ="cantidad"><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td> </tr>';
				cont++;
		  		$('#detalles').append(fila);
		  		limpiar();
				$("#guardar").show();
				cargar();
			}
			else
			{
				alert("Error al ingresar el detalle del presuuesto, revise los datos del producto");
			}
		}

		function redondear($valor){
			$float_redondeado = Math.round($valor * 100) /100;
			return $float_redondeado;
		}
	
	function limpiar(){
		$("#pid").val("");
		$("#pdescripcion").val("");
		$("#pcantidad").val("");
    $("#pstock").val("");
	}


	function eliminar(index){
		total=total-subtotal[index];
		$('#total').html("$/. "+total);
		$('#total_venta').val(total);
		$('#fila'+index).remove();
		cont--;
		cargar();
		if(cont == 0){
			$('#productosEnPedidos').val("");
		}
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
    		cantidad: e.querySelector('.cantidad').innerText
  		};
  		materiales.push(fila);
		$('#productosEnPedidos').val("");
  		$('#productosEnPedidos').val(JSON.stringify(materiales) );
	});

	}

	function radio(){
		
		var seleccion = document.querySelector('input[name=elegido]:checked').value;
		
		//document.getElementById('select_sh').style.display = "block";
			
		//document.getElementById('select_us').style.display = "block";
	}

	function sendForm(){
		
		var seleccion2 = document.querySelector('input[name=modoPago]:checked').value;

		if(seleccion2 == 'Efectivo' || seleccion2 == 'Transferencia Bancaria' || seleccion2 == 'Cheque'){

			document.getElementById('guardar').removeAttribute("disabled");

		}
		else{
			
			var montoCuenta = document.getElementById("monto").innerHTML;
			
			var total_venta_pesos = document.getElementById("total_venta_pesos").value;

			var cotizacion = document.getElementById("cotizacion").value;
		
			var monto = parseFloat(montoCuenta);
			
			var total = parseFloat(total_venta_pesos);

			var cot = parseFloat(cotizacion);

			var dolares = total / cot;

			if(monto >= dolares ){
								
				document.getElementById('guardar').removeAttribute("disabled");
			}

			else{
				
				window.alert("No se puede hacer la Venta, No Posee Monto Disponible en su Cuenta Corriente");
				
				document.getElementById('guardar').disabled = "true";
			}
		}

	}



</script>
@endpush