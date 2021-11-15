<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Factura</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>

@import url('fonts/BrixSansRegular.css');
@import url('fonts/BrixSansBlack.css');

*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}
p, label, span, table{
	font-family: 'BrixSansRegular';
	font-size: 9pt;
}
.h2{
	font-family: 'BrixSansBlack';
	font-size: 16pt;
}
.h3{
	font-family: 'BrixSansBlack';
	font-size: 12pt;
	display: block;
	background: #0a4661;
	color: #FFF;
	text-align: center;
	padding: 3px;
	margin-bottom: 5px;
}
.imgRedonda {
    width:150px;
    height:150px;
    border-radius:75px;
	margin-left: 30px;
}
#page_pdf{
	width: 95%;
	margin: 15px auto 10px auto;
}

#factura_head, #factura_cliente, #factura_detalle{
	width: 100%;
	margin-bottom: 10px;
}
.logo_factura{
	width:10px;
	height:50px; 
}
.info_empresa{
	width: 40%;
	text-align: center;
}
.info_factura{
	width: 25%;
}
.info_cliente{
	width: 100%;
}
.datos_cliente{
	width: 100%;
}
.datos_cliente tr td{
	width: 50%;
}
.datos_cliente{
	padding: 10px 10px 0 10px;
}
.datos_cliente label{
	width: 80px;
	display: inline-block;
}
.datos_cliente p{
	display: inline-block;
}

.textright{
	text-align: right;
	font-size: 15px;
}
.textleft{
	text-align: left;
	font-size: 15px;
}
.textcenter{
	text-align: center;
	font-size: 15px;
}
.round{
	border-radius: 10px;
	border: 1px solid #0a4661;
	overflow: hidden;
	padding-bottom: 15px;
}
.round p{
	padding: 0 15px;
}

#factura_detalle{
	border-collapse: collapse;
}
#factura_detalle thead th{
	background: #058167;
	color: #FFF;
	padding: 10px;
}
#detalle_productos tr:nth-child(even) {
    background: #ededed;
	
}
#detalle_totales span{
	font-family: 'BrixSansBlack';
}
.nota{
	font-size: 8pt;
}
.label_gracias{
	font-family: verdana;
	font-weight: bold;
	font-style: italic;
	text-align: center;
	margin-top: 20px;
}
.anulada{
	position: absolute;
	left: 50%;
	top: 50%;
	transform: translateX(-50%) translateY(-50%);
}

</style>

<body>

<div id="page_pdf">
	<table id="factura_head">
		<tr>
			<td class="info_factura">
				<div>
					<img src="img/logo.jpg" class='imgRedonda' >				
				</div>
			</td>
			<td class="info_empresa">
				<div>			
				
				<span class="h2">D&H TECNOLOGIA y SERVICIOS</span>
					<p>AVENIDA CARLOS PELLEGRINI 1531 (4000) </p>
					<p>TUCUMAN ARGENTINA</p>
					<p>TELEFONO:(0381) 4361146 / 4364239</p>
					<p>dhsay@arnet.com.ar</p>
					
				</div>
			</td>
			
			<td class="info_factura">
				<br>
				<br>
				<div class="round">
					<span class="h3">COMPROBANTE PAGO</span>
					<p><strong>{{$pedido->num_pedido}}</strong></p>
					<p>Fecha: {{$pedido->getFromDateAttribute($pedido->fecha)}}</p>
					<p>Hora: {{$pedido->getFromhora($pedido->fecha)}}</p>
					<p>Vendedor: {{$pedido->user->apellido . ' ' . $pedido->user->nombre}}</p>
					<br>
					<p class="textcenter">ORIGINAL</p>
					<br>
					<p class="textcenter" style="font-size: 10px;"><strong>Comprobante no válido como factura<P></strong>
				</div>
			</td>
		</tr>
	</table>

	<table id="factura_head">
		<tr>
			<td class="info_factura">
				<br>
				<div class="round">
					<span class="h3">
					 DETALLE
					</span>
					<p>
						Recibi de&nbsp; {{$historial->cliente->razon_Social}} 
						con domicilio en {{$historial->cliente->direccion}} &nbsp; 
						Cuil / Cuit:&nbsp; {{$historial->cliente->cuit_cuil}}
						&nbsp; La suma de : * AR$ {{$pesos + $dolaresP }} &nbsp;
						En concepto de pago de {{$pedido->num_pedido}}
					</p>
					
				</div>
			</td>
			
		</tr>

	</table>

	<table id="factura_head">
		<tr>
			<td class="info_factura">
				<br>
				<div class="round">
					<span class="h3">
					 Observaciones
					</span>
					<p>
						El tipo de cambio a efectos impositivos es de Dolar 1 = Pesos AR$ {{$cajas->cotizacion}}
					</p>

				</div>
			</td>
			
		</tr>

	</table>

	<div>
		<br>
		<p class="nota">FIRMA: ......................................................</p>
		<br>
		<br>
		<p class="nota">ACLARACION: ......................................................</p>
		<h4 class="label_gracias">¡Gracias por su compra!</h4>
	</div>

</div>

-----------------------------------------------------------------------------------------------------------------------------------------------------------


<div id="page_pdf">
	<table id="factura_head">
		<tr>
			<td class="info_factura">
				<div>
					<img src="img/logo.jpg" class='imgRedonda' >				
				</div>
			</td>
			<td class="info_empresa">
				<div>			
				
				<span class="h2">D&H TECNOLOGIA y SERVICIOS</span>
					<p>AVENIDA CARLOS PELLEGRINI 1531 (4000) </p>
					<p>TUCUMAN ARGENTINA</p>
					<p>TELEFONO:(0381) 4361146 / 4364239</p>
					<p>dhsay@arnet.com.ar</p>
					
				</div>
			</td>
			
			<td class="info_factura">
				<br>
				<br>
				<div class="round">
					<span class="h3">COMPROBANTE PAGO</span>
					<p>N° Factura <strong>{{$pedido->num_pedido}}</strong></p>
					<p>Fecha: {{$pedido->getFromDateAttribute($pedido->fecha)}}</p>
					<p>Hora: {{$pedido->getFromhora($pedido->fecha)}}</p>
					<p>Vendedor: {{$pedido->user->apellido . ' ' . $pedido->user->nombre}}</p>
					<br>
					<p class="textcenter"> COPIA CLIENTE</p>
					<br>
					<p class="textcenter" style="font-size: 10px;"><strong>Comprobante no válido como factura<P></strong>
				</div>
			</td>
		</tr>
	</table>

	<table id="factura_head">
		<tr>
			<td class="info_factura">
				<br>
				<div class="round">
					<span class="h3">
					 DETALLE
					</span>
					<p>
						Recibi de&nbsp; {{$historial->cliente->razon_Social}} 
						con domicilio en {{$historial->cliente->direccion}} &nbsp; 
						Cuil / Cuit:&nbsp; {{$historial->cliente->cuit_cuil}}
						&nbsp; La suma de : * AR$ {{$pesos + $dolaresP }} &nbsp;
						En concepto de pago de {{$pedido->num_pedido}}
					</p>
					
				</div>
			</td>
			
		</tr>

	</table>

	<table id="factura_head">
		<tr>
			<td class="info_factura">
				<br>
				<div class="round">
					<span class="h3">
					 Observaciones
					</span>
					<p>
						El tipo de cambio a efectos impositivos es de Dolar 1 = Pesos AR$ {{$cajas->cotizacion}}
					</p>

				</div>
			</td>
			
		</tr>

	</table>

	<div>
		<br>
		<p class="nota">FIRMA: ......................................................</p>
		<br>
		<br>
		<p class="nota">ACLARACION: ......................................................</p>
		<h4 class="label_gracias">¡Gracias por su compra!</h4>
	</div>

</div>

</body>
</html>