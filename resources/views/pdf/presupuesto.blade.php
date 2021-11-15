<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Presupuesto</title>
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
					<img src="img/logo.png" class='imgRedonda' >				
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
					<span class="h3">
						NOTA DE PRESUPUESTO
							X
					</span>
					<p><strong>{{$presupuesto->num_comprobante}}</strong></p>
					<p>Fecha: {{$presupuesto->getFromDateAttribute($presupuesto->fecha)}}</p>
					<p>Hora: {{$presupuesto->getFromhora($presupuesto->fecha)}}</p>
					<p>Vendedor: {{$presupuesto->user->apellido . ' ' . $presupuesto->user->nombre}}</p>
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
					<span class="h3">&nbsp; </span>
					<table class="datos_cliente">
						<tr>
							<td>Cliente: <strong>{{$presupuesto->cliente->razon_Social}} </strong></td>
							<td>Domicilio: <strong>{{$presupuesto->cliente->direccion . ' , '.$presupuesto->cliente->ciudad . ' , '.$presupuesto->cliente->provincia->nombre}} Argentina </strong></td>
						</tr>
						<tr>
							<td> Condicion de Venta: <strong>{{$presupuesto->modo_venta}} </strong></td>
							<td> C.U.I.T: <strong>{{$presupuesto->cliente->cuit_cuil}} </strong></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>


	
		<table id="factura_detalle">
		
			<thead>
				<tr>
					<th width="50px" >Cantidad</th>
					<th class="textcenter">Descripción</th>
					<th class="textright" width="150px">Precio Unitario</th>
					<th class="textright" width="150px"> Precio Total </th>
				</tr>
			</thead>
			<tbody id="detalle_productos">
				@foreach ($detalle as $d)
				<tr>
					<td class="textcenter" style="border: black 1px solid;">{{$d->cantidad}}</td>
					<td class="textcenter">{{$d->producto->nombre}}</td>
					<td class="textright">AR$ {{$d->precio}}</td>
					<td class="textright">AR$ {{$d->precio * $d->cantidad }}</td>
				</tr>
				@endforeach
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
			<tfoot id="detalle_totales">
				<tr>
					<td colspan="3" class="textright"><span>-</span></td>
					<td class="textright">-</td>
				</tr>
				<tr>
					<td colspan="3" class="textright"  style="background-color: lightblue;"><span>TOTAL</span></td>
					<td class="textright" style="background-color: lightblue;">*AR$ {{$presupuesto->total }}</td>
				</tr>
			</tfoot>
			
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
						El tipo de cambio a efectos impositivos es de Dolar 1 = Pesos AR$ {{$presupuesto->cotizacion}}
					</p>
					<br>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						<br>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</div>
			</td>
			<td class="info_factura">
				<br>
				<div class="round">
					<span class="h3">
						Datos de Entrega
					</span>
					@if($presupuesto->tipo_entrega == 'Retira del Local')
					<p>RETIRA EN DEPOSITO DHS</p>
					<br>
					<p>
						AVENIDA CARLOS PELLEGRINI 1531 (4000) SAN MIGUEL DE TUCUMAN
					<br>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					</p>
					@else
						<p>Forma de Entrega <strong> {{$presupuesto->tipo_entrega}} </strong></p>
						<br>
						<p>
						Direccion: <strong>{{$presupuesto->cliente->direccion . ' , '.$presupuesto->cliente->ciudad . ' , '.$presupuesto->cliente->provincia->nombre}} Argentina </strong>
						<br>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					@endif
				</div>
			</td>
			
		</tr>
	</table>

	
	<div>
		<br>
		<p class="nota">FIRMA: ...................................................... ACLARACION: ......................................................</p>
		<p class="nota"></p>

	</div>

</div>

</body>

<body>

<div id="page_pdf">
	<table id="factura_head">
		<tr>
			<td class="info_factura">
				<div>
					<img src="img/logo.png" class='imgRedonda' >				
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
					<span class="h3">
						NOTA DE PRESUPUESTO
							X
					</span>
					<p><strong>{{$presupuesto->num_comprobante}}</strong></p>
					<p>Fecha: {{$presupuesto->getFromDateAttribute($presupuesto->fecha)}}</p>
					<p>Hora: {{$presupuesto->getFromhora($presupuesto->fecha)}}</p>
					<p>Vendedor: {{$presupuesto->user->apellido . ' ' . $presupuesto->user->nombre}}</p>
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
					<span class="h3">&nbsp; </span>
					<table class="datos_cliente">
						<tr>
							<td>Cliente: <strong>{{$presupuesto->cliente->razon_Social}} </strong></td>
							<td>Domicilio: <strong>{{$presupuesto->cliente->direccion . ' , '.$presupuesto->cliente->ciudad . ' , '.$presupuesto->cliente->provincia->nombre}} Argentina </strong></td>
						</tr>
						<tr>
							<td> Condicion de Venta: <strong>{{$presupuesto->modo_venta}} </strong></td>
							<td> C.U.I.T: <strong>{{$presupuesto->cliente->cuit_cuil}} </strong></td>
						</tr>
            <tr>
							<td> Fecha Vencimiento <strong> @php echo date("d-m-Y",strtotime($presupuesto->fecha." + $presupuesto->mantenimiento days")); @endphp </strong></td>
							<td> Mantenimiento Presupuesto <strong>{{$presupuesto->mantenimiento}} Dias</strong></td>
						</tr> 
					</table>
				</div>
			</td>

		</tr>
	</table>


	
		<table id="factura_detalle">
		
			<thead>
				<tr>
					<th width="50px" >Cantidad</th>
					<th class="textcenter">Descripción</th>
					<th class="textright" width="150px">Precio Unitario</th>
					<th class="textright" width="150px"> Precio Total </th>
				</tr>
			</thead>
			<tbody id="detalle_productos">
				@foreach ($detalle as $d)
				<tr>
					<td class="textcenter" style="border: black 1px solid;">{{$d->cantidad}}</td>
					<td class="textcenter">{{$d->producto->nombre}}</td>
					<td class="textright">AR$ {{$d->precio}}</td>
					<td class="textright">AR$ {{$d->precio * $d->cantidad }}</td>
				</tr>
				@endforeach
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
			<tfoot id="detalle_totales">
				<tr>
					<td colspan="3" class="textright"><span>-</span></td>
					<td class="textright">-</td>
				</tr>
				<tr>
					<td colspan="3" class="textright"  style="background-color: lightblue;"><span>TOTAL</span></td>
					<td class="textright" style="background-color: lightblue;">*AR$ {{$presupuesto->total }}</td>
				</tr>
			</tfoot>
			
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
						El tipo de cambio a efectos impositivos es de Dolar 1 = Pesos AR$ {{$presupuesto->cotizacion}}
					</p>
					<br>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						<br>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				</div>
			</td>
			<td class="info_factura">
				<br>
				<div class="round">
					<span class="h3">
						Datos de Entrega
					</span>
					@if($presupuesto->tipo_entrega == 'Retira del Local')
					<p>RETIRA EN DEPOSITO DHS</p>
					<br>
					<p>
						AVENIDA CARLOS PELLEGRINI 1531 (4000) SAN MIGUEL DE TUCUMAN
					<br>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					</p>
					@else
						<p>Forma de Entrega <strong> {{$presupuesto->tipo_entrega}} </strong></p>
						<br>
						<p>
						Direccion: <strong>{{$presupuesto->cliente->direccion . ' , '.$presupuesto->cliente->ciudad . ' , '.$presupuesto->cliente->provincia->nombre}} Argentina </strong>
						<br>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					@endif
				</div>
			</td>
			
		</tr>
	</table>

	
	<div>
		<br>
		<p class="nota">FIRMA: ......................................................ACLARACION: ......................................................</p>
	</div>

</div>

</body>


</html>