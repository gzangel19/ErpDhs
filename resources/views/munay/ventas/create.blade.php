@extends('layouts.munay')

@section('title','Nueva Venta')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="" class="nav-link"> <i class="fas fa-address-card"></i> Pedidos  </a>
                                    
    </li>

    <li class="breadcrumb-item">
                                        
        <a href="" class="nav-link"> <i class="fas fa-plus"></i> Nueva Venta  </a>
                                                                    
    </li>

@endsection

@section('content')

<div class="panel shadow">
    
	<div class="header">
		
		<h2 class="title"> <a href="{{url('Munay/Clientes/create')}}"> <i class="fas fa-plus"></i> Nueva Venta </a>  </h2> 
	
	</div>

	<div class="inside">

		{!! Form::open(['url'=>'/Munay/Pedidos/store']) !!}
					
			<div class="row">	
					
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		
					<label> Consumidor Final : {{$cliente->razon_Social}} Direccion: {{$cliente->direccion}} {{$cliente->ciudad}} {{$cliente->provincia->nombre}} </label> 
																						
					<input type="hidden" name="cliente_id" id="cliente_id" readonly value= "{{ $cliente->id }}" class="form-control">
								
				</div>

			</div>

			<div class="row">

				{!!Form::hidden('cliente_id',$cliente->id,['class' => 'form-control'])!!} 

				{!!Form::hidden('pid',0,['class' => 'form-control','id' => 'pid'])!!} 


				<div class="col-8">

					<label for="name">Producto:</label>

					<div class="input-group">
									
						<span class="input-group-text" id="basic-addon1"><i class="fas fa-box"></i></span>
								
						{!!Form::text('pdescripcion',null,['class' => 'form-control','id'=> 'pdescripcion', 'readonly'])!!}  
						
						<span class="input-group-btn">
        							
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModalCenter">Buscar</button>
									  
						</span>
								
					</div>
									
				</div>

			</div>
			
			<div class="row mtop16">

				<div class="col-4">

					<label for="name">Precio:</label>

					<div class="input-group">
									
						<span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill"></i></span>
								
						{!!Form::text('pprecio',null,['class' => 'form-control','id'=> 'pprecio', 'readonly'])!!}  
													
					</div>
								
				</div>

				<div class="col-4">

					<label for="name">Cantidad:</label>

					<div class="input-group">
									
						<span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill"></i></span>
								
						{!!Form::number('pcantidad',null,['class' => 'form-control','id'=> 'pcantidad'])!!}  
													
					</div>
			
				</div>

			</div>

			<div class="row mtop16">

				<div class="col-4">
								
					{!!Form::hidden('pdeposito',0,['class' => 'form-control','id'=> 'pdeposito'])!!} 

					{!!Form::hidden('piddeposito',0,['class' => 'form-control','id'=> 'piddeposito'])!!} 

					{!!Form::hidden('pDescuento',0,['class' => 'form-control','id'=> 'pDescuento'])!!} 
					
					<button class="btn btn-primary" type="button"  id="bt_agregar" onclick="evaluar()">Agregar</button>		
				
				</div>

			</div>

				
			<div class="row mtop16">
						
				<div class="col-12">
										
					<table id="detalles" class="table table-hover">
									
						<thead>
							
							<th>Opciones</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Deposito</th>
							<th>Precio</th>
							<th>Descuento</th>
							<th>Subtotal</th>
									
						</thead>

						
						<tbody>
									
						</tbody>

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

					</table>
							
				</div>
					
			</div>

			<div class="row mtop16">

				<div class="col-4">

					<label for="name">Forma de Envio:</label>

					<div class="input-group">
									
						<span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill"></i></span>
								
						{!!Form::select('elegido',['Retira del Local' => 'Retira del Local','Envio por Transporte' => 'Envio por Transporte','Envio a Domicilio' => 'Envio a Domicilio','Envio por Cadete' => 'Envio por Cadete'],0,['class' => 'form-select'])!!} 
													
					</div>
					
				</div>

				<div class="col-4">

					<label for="name">Forma de Pago:</label>

					<div class="input-group">
									
						<span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill"></i></span>
								
						{!!Form::select('modoPago',['Efectivo' => 'Efectivo','Transferencia Bancaria' => 'Transferencia Bancaria','Mercado Pago' => 'Mercado Pago','Tarjeta' => 'Tarjeta','Ahora6' => 'Ahora6','Ahora12' => 'Ahora12','Ahora18' => 'Ahora18'],0,['class' => 'form-select','onclick' => 'sendForm();','id' => 'modoPago'])!!} 
													
					</div>

				</div>

			</div>

			<div class="row mtop16">

					<div class="col-12">
							
						<div class="form-group">
							
						<label for="exampleFormControlTextarea1">Observaciones</label>
							
						<textarea class="form-control" id="observaciones" name="observaciones" rows="4"></textarea>
  						
					</div>

			</div>

			<div class="row">
						
				<div class="col-4" id="guardar1">
							
					<div class="form-group">
									
						<input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
						<input type="hidden" name="productosEnPedidos" id="productosEnPedidos" value="[]">
						<button id="guardar" class="btn btn-primary"  type="submit">Guardar</button>
						<a class="btn btn-danger" href="{{url('/Munay/Pedidos/Home')}}" role="button">Volver</a>

					</div>
					
			</div>
				
		{!! Form::close() !!}
			
	</div>

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
						  <th style="display:none;">Deposito</th>
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
					<td style="display:none;">{{ $pro->depositos }}</td>  
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



<!-- FIN Modal Productos-->	

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
		
		var combo = document.getElementById("modoPago");
		var seleccion2 = combo.options[combo.selectedIndex].text;

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
