@extends('layouts.app')
@section('content')

<div class="container">
    
	<div class="row justify-content-center">
	
		<div class="col-md-12">
	    	
			<section class="content-header">
            	
				<div class="container-fluid">
              		
            	
				</div>
        	
			</section>
		
          	<div class="card card-secondary">

				<div class="card-body">
					
					<form method="post" action="{{ route('pedidos.store')}}" name="formulario">
				
					{{ csrf_field() }}

					<div class="row">	
					
						<input type="hidden" readonly name="idCliente" id="idCliente" class="form-control" placeholder="">

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

								<h3> Nueva Venta </h3>					
								
								<label> Consumidor Final : {{$cliente->razon_Social}} Direccion: {{$cliente->direccion}} {{$cliente->ciudad}} {{$cliente->provincia->nombre}} </label> 
																
								<br>
				
								@if($cliente->cuentaCorriente == 'Si')
								
								<label> Credito Asignado U$D : {{$cliente->montoCuenta}}</label>
			
								<label> AR$ : {{$cliente->montoCuentaPesos}}</label>

								<label id="monto" style="display:none;"> {{$cliente->montoCuenta}}</label>

								<label id="montoPesos" style="display:none;"> {{$cliente->montoCuentaPesos}}</label>
								
								@endif
							
								<input type="hidden" name="cliente_id" id="cliente_id" readonly value= "{{$cliente->id}}" class="form-control">
								
							</div>

					</div>

					<div class="card card-secondary">
						
						<div class="card-header">
							
							<h3 class="card-title"></h3>
						
						</div>
						
					</div>

					<div class="row">
					
						<input type="hidden" readonly name="pid" id="pid" class="form-control" placeholder="">

						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
						
							<div class="input-group">
						
								<input type="text" class="form-control" id="pdescripcion" name = "pdescripcion" readonly>
      							
								<span class="input-group-btn">
        							
								<button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModalCenter">Buscar</button>
      							
								</span>
    					
							</div>
  						
						</div>

						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">

							<div class="input-group">
																				
								<input type="text"  readonly name="pprecio" id="pprecio" class="form-control"  placeholder="Precio">

							</div>

						</div>

						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2" style="display:none;">
							
							<div class="input-group">
								
								<input type="text" readonly name="pdeposito" id="pdeposito" class="form-control" placeholder="Deposito">
							
								<input type="hidden" readonly name="piddeposito" id="piddeposito" class="form-control" placeholder="">
							
							</div>
						
						</div>

						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
							
							<div class="input-group">
															
								<input type="text" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
							
							</div>
						
						</div>

						@if(Auth::user()->tipo == 'admin')

						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
							
							<div class="input-group">
															
								<input type="number" name="pDescuento" id="pDescuento" class="form-control" placeholder="Descuento" value="0">
							
							</div>
						
						</div>

						@endif


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
										<th>Deposito</th>
										<th>Precio</th>
										<th>Descuento</th>
										<th>Subtotal</th>
									</thead>
									<tfoot>
										<th>Total</th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th><h4 id="total">$/. 0.00</h4> <input type="hidden" name="total_venta_pesos" id="total_venta_pesos">
										<input type="hidden" name="total_venta_dolares" id="total_venta_dolares">
										<input type="hidden" name="cotizacion" id="cotizacion" value="{{$dolar->valor}}">
									</tfoot>

									<tbody>
									
									</tbody>

								</table>
							
							</div>
						
						</div>
					
					</div>
					
					<div class="card card-secondary">
						
						<div class="card-header">
								
						</div>
					
					</div>

					<div class="row">

						<div class="col-lg-3 col-md-3 col-dm-3 col-xs-3">
							
							<div class="custom-control custom-radio custom-control-inline">
							
								<input type="radio" id="customRadioInline1" name="elegido" class="custom-control-input" value="Retira del Local" onclick="radio()" required >
								<label class="custom-control-label" for="customRadioInline1">Retira del Local</label>	
							
							</div>
						
						</div>	

						<div class="col-lg-3 col-md-3 col-dm-3 col-xs-3">
								
							<div class="custom-control custom-radio custom-control-inline">
							
								<input type="radio" id="customRadioInline2" name="elegido" class="custom-control-input" value="Envio por Transporte" onclick="radio()">
								<label class="custom-control-label" for="customRadioInline2">Por Transporte</label>
							
							</div>
						
						</div>

						<div class="col-lg-3 col-md-3 col-dm-3 col-xs-3">

							<div class="custom-control custom-radio custom-control-inline">
								
								<input type="radio" id="customRadioInline3" name="elegido" class="custom-control-input" value="Envio a Domicilio" onclick="radio()">
								<label class="custom-control-label" for="customRadioInline3">A Domicilio</label>
							
							</div>
								
						</div>

						@if (getValueJS(Auth::user()->permisosERP,'getCadete'))

						<div class="col-lg-3 col-md-3 col-dm-3 col-xs-3">

							<div class="custom-control custom-radio custom-control-inline">
								
								<input type="radio" id="customRadioInline4" name="elegido" class="custom-control-input" value="Envio por Cadete" onclick="radio()">
								<label class="custom-control-label" for="customRadioInline4">Envio por Cadete</label>

							</div>
	
						</div>

						@endif
					
					</div>
					
					<br>
					
					<div class="card card-secondary">
						
						<div class="card-header">
							
							<h3 class="card-title"></h3>
						
						</div>
						
					</div>

					<div class="row">

						<div class="col-lg-12 col-md-12 col-dm-12 col-xs-12">
							
							<div class="custom-control custom-radio custom-control-inline">
							
								<input type="radio" id="radioEfectivo1" name="modoPago" class="custom-control-input" value="Efectivo" onclick="sendForm();" required>
								<label class="custom-control-label" for="radioEfectivo1">Efectivo</label>	
							
							</div>

							<div class="custom-control custom-radio custom-control-inline">
							
								<input type="radio" id="radioEfectivo3" name="modoPago" class="custom-control-input" value="Transferencia Bancaria" onclick="sendForm();">
								
								<label class="custom-control-label" for="radioEfectivo3">Transferencia</label>
						
							</div>

							<div class="custom-control custom-radio custom-control-inline">
							
								<input type="radio" id="radioEfectivo4" name="modoPago" class="custom-control-input" value="Cheque" onclick="sendForm();">
							
								<label class="custom-control-label" for="radioEfectivo4">Cheque</label>
					
							</div>

							<div class="custom-control custom-radio custom-control-inline">
							
								<input type="radio" id="radioEfectivo5" name="modoPago" class="custom-control-input" value="Mercado Pago" onclick="sendForm();">
							
								<label class="custom-control-label" for="radioEfectivo5">Mercado Pago</label>
					
							</div>

							<div class="custom-control custom-radio custom-control-inline">
							
								<input type="radio" id="radioEfectivo6" name="modoPago" class="custom-control-input" value="Tarjeta" onclick="sendForm();">
							
								<label class="custom-control-label" for="radioEfectivo6">Tarjeta</label>
					
							</div>

							<div class="custom-control custom-radio custom-control-inline">
								
								<input type="radio" id="radioEfectivo7" name="modoPago" class="custom-control-input" value="Ahora6" onclick="sendForm();">
							
								<label class="custom-control-label" for="radioEfectivo7">Ahora 6</label>
				
							</div>


							<div class="custom-control custom-radio custom-control-inline">
								
								<input type="radio" id="radioEfectivo9" name="modoPago" class="custom-control-input" value="Ahora12" onclick="sendForm();">
							
								<label class="custom-control-label" for="radioEfectivo9">Ahora 12</label>
				
							</div>

							<div class="custom-control custom-radio custom-control-inline">
								
								<input type="radio" id="radioEfectivo8" name="modoPago" class="custom-control-input" value="Ahora18" onclick="sendForm();">
							
								<label class="custom-control-label" for="radioEfectivo8">Ahora 18</label>
				
							</div>
															
						</div>
					
					</div>

					<br>

					<div class="card card-secondary">
						
						<div class="card-header">
						
						</div>
					
					</div>

					<div class="row">

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Observaciones</label>
							
							<textarea class="form-control" id="observaciones" name="observaciones" rows="4"></textarea>
  						
						</div>

						</div>

					</div>

					<div class="row">
						
						<div class="col-lg-6 col-md-6 col-dm-6 col-xs-12" id="guardar1">
							
							<div class="form-group">
									
								<input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
								<input type="hidden" name="productosEnPedidos" id="productosEnPedidos" value="[]">
								<input type="hidden" name="unidad_id" id="unidad_id" value="{{$unidad->id}}">
								<button id="guardar" class="btn btn-primary"  type="submit">Guardar</button>
								<a class="btn btn-danger" href="{{ url('Pedidos/Index') }}" role="button">Volver</a>
							</div>
						
						</div>
					
					</div>
				
				</form>
			
			</div>



<!-- Modal Productos-->

<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
		<div class="modal-header">
        	<h5 class="modal-title" id="exampleModalLongTitle">Listado de Productos</h5>		
     	 </div>
        <div class="col-lg-6 col-md-6 col-dm-6 col-xs-12">
        	Producto a buscar <input id="searchTerm" type="text" onkeyup="doSearch()" />
       	</div>
      	<div class="modal-body">
	  		<div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap" id="datos">
                    <thead>
                      <tr>
                          <th style="display:none;">Codigo</th>
                          <th>Nombre</th>
                          <th style="display:none;">Stock</th>
						  <th> Deposito</th>
						  <th>Precio</th>
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
					<td>{{ $pro->depositos }}</td>  
					@if($pro->moneda == 'Dolares')					
					<td>{{ round($pro->local1 * $dolar->valor,0 ) }}</td>  
					@else
					<td>{{ round($pro->local1 ,0 )}}</td>  
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
		porcentaje=0;

		var arrProductos = new Array();
        var state =0;

		document.getElementById('guardar').disabled = "true";


		$(document).ready(function (){
      		$('#pcantidad').keyup(function (){
        	this.value = (this.value + '').replace(/[^0-9]/g, '');
      		});
    	});	

    	function SeleccionarProducto(){

			$("table tbody tr").click(function() {
		 		var filaid= $(this).find("td:eq(0)").text();
	     		var filaNombre = $(this).find("td:eq(2)").text();
				var filaDeposito = $(this).find("td:eq(4)").text();
  				var filaPrecioLocal1 = $(this).find("td:eq(5)").text();
				var filaIdDeposito = $(this).find("td:eq(6)").text();

				$("#pid").val(filaid);
				$("#pdescripcion").val(filaNombre);
				$("#pdeposito").val(filaDeposito);
				$("#piddeposito").val(filaIdDeposito);				 				
				$('#pprecio').val(filaPrecioLocal1); 

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
			idDeposito=$("#piddeposito").val();
			deposito=$("#pdeposito").val();
			cantidad=$("#pcantidad").val();
			precio =$("#pprecio").val();
			descuento = $("#pDescuento").val();
        	if (idarticulo!="" && cantidad!="" && cantidad>0 && precio!="")
        	{
				subtotal[cont]=(cantidad*precio);
				
				console.log(descuento);

				if (descuento == null) {
					descuento = 0;
				}
				
				porcentaje = descuento/100;

				
				console.log(porcentaje);
				
				subtotal[cont] = subtotal[cont] - subtotal[cont]*porcentaje;
				//}
				
				subtotalRedondeado = redondear(subtotal[cont]);
				
				total=total+subtotal[cont];

				totalRedondeado = redondear(total);

				var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td> <td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td> <td class= "idProducto" style="display:none;"><input type="hidden" name="idProducto[]" value="'+idarticulo+'">'+idarticulo+'</td>  <td  class ="cantidad"><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td> <td class= "idDeposito" style="display:none;"><input type="hidden" name="idDeposito[]" value="'+idDeposito+'">'+idDeposito+'</td> <td  class ="deposito"><input type="hidden" name="deposito[]" value="'+deposito+'">'+deposito+'</td> <td  class ="precio"><input type="hidden" name="precio[]" value="'+precio+'">'+ precio +'</td> <td  class ="descuento"><input type="hidden" name="descuento[]" value="'+descuento+'">'+ descuento +'</td> <td>'+subtotalRedondeado+'</td></tr>';
				cont++;
		    	$('#total').html("$/ " + totalRedondeado);
		    	$('#total_venta_pesos').val(totalRedondeado);
				$('#total_venta_dolares').val(0);
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
		$("#pdeposito").val("");
		$("#pprecio").val("");
		$("#pDescuento").val("0");
	}


	function eliminar(index){
		total=total-subtotal[index];
		$('#total').html("$/. "+total);
		$('#total_venta_pesos').val(total);
		$('#fila'+index).remove();
		$('#total').html("$/ " + Math.round( total,0 ));	
		cont--;
		cargar();
		if(cont == 0){
			$('#productosEnPedidos').val("");
			$('#total').html("$/ " + Math.round( 0,0 ));	
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
			idDeposito: e.querySelector('.idDeposito').innerText,
    		cantidad: e.querySelector('.cantidad').innerText,
    		precio: e.querySelector('.precio').innerText,
			descuento: e.querySelector('.descuento').innerText
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

		if(seleccion2 == 'Efectivo' || seleccion2 == 'Transferencia Bancaria' || seleccion2 == 'Cheque' || seleccion2 == 'Mercado Pago'
		|| seleccion2 == 'Tarjeta' || seleccion2 == 'Ahora6' || seleccion2 == 'Ahora12' || seleccion2 == 'Ahora18'){

			var total_venta_pesos = document.getElementById("total_venta_pesos").value;

			$('#total').html("$/ " + total_venta_pesos);

			if( seleccion2 == 'Ahora6' ){

				var total_venta_pesos = document.getElementById("total_venta_pesos").value;
			
				var total = parseFloat(total_venta_pesos) + (parseFloat(total_venta_pesos) * 0.08);

				$('#total').html("$/ " + Math.round( total,0 ));				
			}


			if( seleccion2 == 'Ahora12' ){

				var total_venta_pesos = document.getElementById("total_venta_pesos").value;

				var total = parseFloat(total_venta_pesos) + (parseFloat(total_venta_pesos) * 0.15);

				$('#total').html("$/ " + Math.round( total,0 ));

			}

			if( seleccion2 == 'Ahora18' ){

				var total_venta_pesos = document.getElementById("total_venta_pesos").value;

				var total = parseFloat(total_venta_pesos) + (parseFloat(total_venta_pesos) * 0.20);

				$('#total').html("$/ " + Math.round( total,0 ));

			}

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
