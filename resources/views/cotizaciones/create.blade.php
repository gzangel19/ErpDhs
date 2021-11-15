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
					
					<form method="post" action="{{ route('cotizaciones.store')}}" name="formulario">
				
					{{ csrf_field() }}

                    <div class="caja">

                        <div class="row">	
                        
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                <h3 style="color:black;font-weight: bold"> Cotizacion de Producto </h3>					
                                
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
	
                                <div class="form-group">

                                    <label>Producto</label>
                            
                                    <input type="text" class="form-control" id="nombre" name = "nombre" required>
                                
                                </div>
  						
						    </div>

                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
	
                                <div class="form-group">

                                    <label>Imagen</label>
                            
                                    <input type="file" class="form-control" id="imagen" name = "imagen">
                                
                                </div>
  						
						    </div>

                        </div>

                        <div class="row">

                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                                <div class="form-group">

                                    <label>Unidad de Negocio</label>

                                    <select class="form-control select2" style="width: 100%;" id="unidad_id" name="unidad_id">
                                        <option value="4">Munay</option>
                                        <option value="5">Tu Cartel</option>
                                    </select>
                                
                                </div>

                            </div>

                            <div class="col-xs-24 col-sm-24 col-md-12 col-lg-12 col-xl-12">
                                
                                <div class="form-group">
                                    
                                    <label>Descripcion</label>
                                    
                                    <textarea class="form-control" rows="3" id="descripcion" name="descripcion" required></textarea>
                                
                                </div>

                            </div>

                        </div>

                    </div>

                    <br>

                    <div class="caja">

                        <div class="row">	

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                <h3 style="color:black;font-weight: bold"> Agregar Materia Prima </h3>					
                                
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            
                                <label>Materia Prima</label>

                                <div class="input-group">
                            
                                    <input type="text" class="form-control" id="pproducto" name = "pproducto" readonly>
                                    
                                    <span class="input-group-btn">
                                        
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModalCenter">Buscar</button>
                                    
                                    </span>

                                    <input type="hidden" readonly name="pid" id="pid" class="form-control" placeholder="">
                            
                                </div>
                            
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">

                                <label>Cantidad</label>
	
                                <div class="input-group">

                                    <input type="text" class="form-control" id="pcantidad" name = "pcantidad">
                                
                                </div>

                            </div>

                            
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">

                                <label>Costo Unitario</label>
	
                                <div class="input-group">

                                    <input type="text" class="form-control" id="pcosto" readonly name = "pcosto">
                                                       
                                </div>

                            </div>

                        </div>

                        <br>

                        <div class="row">


                            <div class="col-lg-2 col-md-2 col-dm-2 col-xs-2">
                                
                                <div class="form-group">
                                    
                                    <button class="btn btn-success" type="button"  id="bt_agregar" onclick="evaluar()">Agregar</button>
                                
                                </div>

                            </div>

                        </div>

                        <div class="row">
						
                            <div class="col-lg-12 col-md-12 col-dm-12 col-xs-12">
                                    
                                <div class="table-responsive">
                                    
                                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                        <thead style="background-color:#caf5a9">
                                            <th>Opciones</th>
                                            <th>Materia Prima</th>
                                            <th>Cantidad</th>
                                            <th>Costo Unitario</th>
                                            <th>Subtotal</th>
                                        </thead>
                                        <tfoot>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th><h4 id="total">$/. 0.00</h4> <input type="hidden" name="total_venta_pesos" id="total_venta_pesos">
                                            <input type="hidden" name="cotizacion" id="cotizacion" value="{{$dolar->valor}}">
                                        </tfoot>

                                        <tbody>
                                        
                                        </tbody>

                                    </table>
                                    
                                    <br>

                                    <div class="row">

                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">

                                            <label> Costo </label>

                                            <div class="input-group">
                                                
                                                <input type="text" readonly name="precioCotizado" id="precioCotizado" class="form-control">

                                            </div>

                                        </div>
                                    
                                    </div>
                                    
                                    <br>

                                    <div class="row">

                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">

                                            <label> Utilidad </label>

                                            <div class="input-group">

                                                <input type="number" min="0" max="999" step="0.01" class="form-control" id="beneficio" name = "beneficio" onkeyup="calcularBeneficio()">
                                            
                                            </div>

                                        </div>

                                    </div>

                                    <br>

                                    <div class="row">

                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">

                                            <label> Precio Publico </label>

                                            <div class="input-group">

                                                <input type="text" class="form-control" id="precioFinal" name = "precioFinal">
                                            
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
                                            </div>
						
						                </div>
                                    
                                    </div>
                                
                                </div>
                            
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
        	<h5 class="modal-title" id="exampleModalLongTitle">Listado de Materias Primas</h5>		
     	 </div>
        <div class="col-lg-6 col-md-6 col-dm-6 col-xs-12">
        	Buscar <input id="searchTerm" type="text" onkeyup="doSearch()" />
       	</div>
      	<div class="modal-body">
	  		<div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap" id="datos">
                    <thead>
                      <tr>
                          <th>id</th>
                          <th>Nombre</th>
						  <th>Costo Unitario</th>
                          <th>Moneda</th>
						  <th>Opcion</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($materiaPrimas as $mat)
                  	<tr>
					<td>{{ $mat->id }}</td>
                    <td>{{ $mat->descripcion }}</td> 
                    @if($mat->moneda == "Pesos")
                    <td>{{ $mat->costo }}</td>
                    @else
                    <td>{{ $mat->costo * $dolar->valor }}</td>
                    @endif          
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
</div>
</div>

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
	     		var filaNombre = $(this).find("td:eq(1)").text();
				var filaCosto = $(this).find("td:eq(2)").text();
  				

				$("#pid").val(filaid);
				$("#pproducto").val(filaNombre);
				$("#pcosto").val(filaCosto);
				 				

			});
		}

        function calcularBeneficio(){
            var beneficio = $("#beneficio").val();
            var porcentaje = beneficio/100;
            var precioCotizado = document.getElementById("total_venta_pesos").value;
            var precioBeneficio = precioCotizado * porcentaje;
            var precioFinal = Number(precioCotizado) + Number(precioBeneficio);
            $("#precioFinal").val(precioFinal);
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

			idmateria=$("#pid").val();
			materia=$("#pproducto").val();
			cantidad=$("#pcantidad").val();
			costo =$("#pcosto").val();

        	if (idmateria!="" && cantidad!="" && cantidad>0)
        	{
				subtotal[cont]=(cantidad*costo);
				
				subtotal[cont] = subtotal[cont] - subtotal[cont]*porcentaje;

				subtotalRedondeado = redondear(subtotal[cont]);
				
				total=total+subtotal[cont];

				totalRedondeado = redondear(total);

                var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idmateria[]" value="'+idmateria+'">'+materia+'</td> <td class= "idmateria" style="display:none;"><input type="hidden" name="idmateria[]" value="'+idmateria+'">'+idmateria+'</td> <td  class ="cantidad"><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td> <td  class ="costo"><input type="hidden" name="costo[]" value="'+costo+'">'+ costo +'</td> <td>'+subtotalRedondeado+'</td></tr>';
				cont++;
		    	$('#total').html("$/ " + totalRedondeado);
		    	$('#total_venta_pesos').val(totalRedondeado);
				$('#total_venta_dolares').val(0);
		  		$('#detalles').append(fila);
                $("#precioCotizado").val(totalRedondeado);
		  		limpiar();
				$("#guardar").show();
				cargar();
              
			}
			else
			{
				alert("Error, Seleccione una Materia prima o revise los datos");
			}
		}

		function redondear($valor){
			$float_redondeado = Math.round($valor * 100) /100;
			return $float_redondeado;
		}
	
	function limpiar(){
		$("#pid").val("");
		$("#pproducto").val("");
		$("#pcantidad").val("");
		$("#pcosto").val("");
    }
	
    function eliminar(index){
		total=total-subtotal[index];
		$('#total').html("$/. "+total);
		$('#total_venta').val(total);
		$('#fila'+index).remove();
        $("#precioCotizado").val(total);
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
    		idmateria: e.querySelector('.idmateria').innerText,
    		cantidad: e.querySelector('.cantidad').innerText,
    		costo: e.querySelector('.costo').innerText
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
