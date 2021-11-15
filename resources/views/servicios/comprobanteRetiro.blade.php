<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nota de Venta</title>
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
.sinBorde{
	font-family: 'BrixSansBlack';
	font-size: 12pt;
	display: block;
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
	color: black;
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
				<p></p>
				<span class="h2">DHS TECNOLOGIA & SERVICIOS</span>
					<p>CARLOS PELLEGRINI 1531 (4000) </p>
					<p>TUCUMAN ARGENTINA</p>
					<p>TELEFONO:(0381) 4361146 / 4364239</p>
					<p>dhsay@arnet.com.ar</p>
					
				</div>
			</td>
			
			<td class="info_factura">
				<br>
				<br>
				<div class="round">
					<span class="h3">
						NOTA DE SERVICIO
					</span>
					<p><strong>{{$servicio->codigo}}</strong></p>
					<p> Fecha: {{$servicio->getFromDateAttribute($servicio->fecha)}}</p>
					<p> Tecnico: {{$servicio->tecnico}}</p>
					<br>
					<p class="textcenter">ORIGINAL</p>
					<br>
					<p class="textcenter" style="font-size: 10px;"><strong>Comprobante no válido como factura<P></strong>
				</div>
			</td>
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<table class="datos_cliente">
						<tr style="font-size: 14px;">
							<td> Cliente: <strong>{{$servicio->cliente->razon_Social}} </strong></td>
							<td> Domicilio: <strong>{{$servicio->cliente->direccion . ' , '.$servicio->cliente->ciudad . ' , '.$servicio->cliente->provincia->nombre}} </strong></td>
						</tr>
						<tr style="font-size: 14px;">
							<td> Telefono: <strong>{{$servicio->cliente->telefonos}} </strong></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>


	
		<table id="factura_detalle">
		
			<thead>
				<tr>
					<th class="textcenter" width="200px"> Detalle </th>
					<th class="textcenter" width="150px">  Costo </th>
					<th class="textcenter" width="50px">  Cantidad </th>
					<th class="textcenter" width="100px"> SubTotal </th>
				</tr>
			</thead>
			<tbody id="detalle_productos">
				<tr>
					<td class="textcenter" style="font-size: 16px;"> Costo Revision </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format($servicio->costoRevision, 2 , ',' , '.')}} </td>
					<td class="textcenter" style="font-size: 16px;"> 1 </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format($servicio->costoRevision, 2 , ',' , '.')}} </td>
				</tr>
				<tr>
					<td class="textcenter" style="font-size: 16px;"> Costo Trabajo </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format($servicio->costoTrabajo, 2 , ',' , '.')}} </td>
					<td class="textcenter" style="font-size: 16px;"> 1 </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format($servicio->costoTrabajo, 2 , ',' , '.')}} </td>
				</tr>
			</tbody>
			<tfoot id="detalle_totales">
				<tr>
					<td class="textcenter" style="font-size: 16px;">  </td>
					<td class="textcenter" style="font-size: 16px;">  </td>
					<td class="textcenter" style="font-size: 16px;"> ------------ </td>
					<td class="textcenter" style="font-size: 16px;"> ------------ </td>
				</tr>
				<tr>
					<td class="textcenter" style="font-size: 16px;"> </td>
					<td class="textcenter" style="font-size: 16px;"> </td>
					<td class="textcenter" style="font-size: 16px;"> Total </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format($servicio->costoTrabajo + $servicio->costoRevision, 2 , ',' , '.')}} </td>
				</tr>
			</tfoot>
			
		</table>


	<table id="factura_head">
		<tr>
			<td class="info_factura">
				<br>
				<div class="round">
					<span class="sinBorde">
					<strong>	Detalle Trabajo </strong>
					</span>
					<p style="padding: left 10px;font-size: 14px;"> {{$servicio->falla}} </p>
				</div>
			</td>
			
		</tr>
	</table>
	
</div>

</body>


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
				<p></p>
				<span class="h2">DHS TECNOLOGIA & SERVICIOS</span>
					<p>CARLOS PELLEGRINI 1531 (4000) </p>
					<p>TUCUMAN ARGENTINA</p>
					<p>TELEFONO:(0381) 4361146 / 4364239</p>
					<p>dhsay@arnet.com.ar</p>
					
				</div>
			</td>
			
			<td class="info_factura">
				<br>
				<br>
				<div class="round">
					<span class="h3">
						NOTA DE SERVICIO
					</span>
					<p><strong>{{$servicio->codigo}}</strong></p>
					<p> Fecha: {{$servicio->getFromDateAttribute($servicio->fecha)}}</p>
					<p> Tecnico: {{$servicio->tecnico}}</p>
					<br>
					<p class="textcenter">ORIGINAL</p>
					<br>
					<p class="textcenter" style="font-size: 10px;"><strong>Comprobante no válido como factura<P></strong>
				</div>
			</td>
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<table class="datos_cliente">
						<tr style="font-size: 14px;">
							<td> Cliente: <strong>{{$servicio->cliente->razon_Social}} </strong></td>
							<td> Domicilio: <strong>{{$servicio->cliente->direccion . ' , '.$servicio->cliente->ciudad . ' , '.$servicio->cliente->provincia->nombre}} </strong></td>
						</tr>
						<tr style="font-size: 14px;">
							<td> Telefono: <strong>{{$servicio->cliente->telefonos}} </strong></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>


	
	<table id="factura_detalle">
		
		<thead>
			<tr>
				<th class="textcenter" width="200px"> Detalle </th>
				<th class="textcenter" width="150px">  Costo </th>
				<th class="textcenter" width="50px">  Cantidad </th>
				<th class="textcenter" width="100px"> SubTotal </th>
			</tr>
		</thead>
		<tbody id="detalle_productos">
			<tr>
				<td class="textcenter" style="font-size: 16px;"> Costo Revision </td>
				<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format($servicio->costoRevision, 2 , ',' , '.')}} </td>
				<td class="textcenter" style="font-size: 16px;"> 1 </td>
				<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format($servicio->costoRevision, 2 , ',' , '.')}} </td>
			</tr>
			<tr>
				<td class="textcenter" style="font-size: 16px;"> Costo Trabajo </td>
				<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format($servicio->costoTrabajo, 2 , ',' , '.')}} </td>
				<td class="textcenter" style="font-size: 16px;"> 1 </td>
				<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format($servicio->costoTrabajo, 2 , ',' , '.')}} </td>
			</tr>
		</tbody>
		<tfoot id="detalle_totales">
			<tr>
				<td class="textcenter" style="font-size: 16px;">  </td>
				<td class="textcenter" style="font-size: 16px;">  </td>
				<td class="textcenter" style="font-size: 16px;"> ------------ </td>
				<td class="textcenter" style="font-size: 16px;"> ------------ </td>
			</tr>
			<tr>
				<td class="textcenter" style="font-size: 16px;"> </td>
				<td class="textcenter" style="font-size: 16px;"> </td>
				<td class="textcenter" style="font-size: 16px;"> Total </td>
				<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format($servicio->costoTrabajo + $servicio->costoRevision, 2 , ',' , '.')}} </td>
			</tr>
		</tfoot>
		
	</table>


	<table id="factura_head">
		<tr>
			<td class="info_factura">
				<br>
				<div class="round">
					<span class="sinBorde">
					<strong>	Detalle Trabajo </strong>
					</span>
					<p style="padding: left 10px;font-size: 14px;"> {{$servicio->falla}} </p>
				</div>
			</td>
			
		</tr>
	</table>

	<div class="title m-b-md">
	
	<br>
	<p>Siguenos en Nuestras Redes Sociales</p>
	<br>
	<img src="data:image/svg+xml;base64,{{ base64_encode($image) }}">
	</div>

</div>

</body>


</html>