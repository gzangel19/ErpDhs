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
					@if($pedido->unidad_id == '4')
						<img src="img/logos/munay-logo.png" style="height:60px; width 60px;">
					@else
						<img src="img/logo.jpg" class='imgRedonda' >
					@endif
									
				</div>
			</td>
			<td class="info_empresa">
				<div>			
				<p></p>
				@if($pedido->unidad_id == '4')
					<span><p class="h2">MUNAY</p> </span> 
					<span class="h2">PRODUCTOS DE DISEÑOS</span>
				@else
					<span class="h2">DHS TECNOLOGIA & SERVICIOS</span>
				@endif
				
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
						NOTA DE VENTA
							X
					</span>
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
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<table class="datos_cliente">
						<tr style="font-size: 14px;">
							<td>Cliente: <strong>{{$pedido->cliente->razon_Social}} </strong></td>
							<td>Domicilio: <strong>{{$pedido->cliente->direccion . ' , '.$pedido->cliente->ciudad . ' , '.$pedido->cliente->provincia->nombre}} </strong></td>
						</tr>
						<tr style="font-size: 14px;">
							<td> Condicion de Venta: <strong>{{$pedido->modo_venta}} </strong></td>
							<td> C.U.I.T: <strong>{{$pedido->cliente->cuit_cuil}} </strong></td>
						</tr>
						<tr style="font-size: 14px;">
							<td> Telefono: <strong>{{$pedido->cliente->telefonos}} </strong></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>


	
		<table id="factura_detalle">
		
			<thead>
				<tr>
					<th class="textcenter" width="200px">Producto</th>
					<th class="textcenter" width="50px"> Cantidad</th>
					<th class="textcenter" width="100px">Precio Unitario</th>
					<th class="textcenter" width="50px">Descuento</th>
					<th class="textcenter" width="100px"> SubTotal </th>
				</tr>
			</thead>
			<tbody id="detalle_productos">
				@foreach ($detalle as $d)
				<tr>
					<td class="textleft" style="font-size: 16px;">{{$d->producto->nombre}}</td>
					<td class="textcenter" style="font-size: 16px;">{{$d->cantidad}}</td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( $d->precio, 2 , ',' , '.')}} </td>
					<td class="textcenter" style="font-size: 16px;"> {{ $d->descuento }} % </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( ($d->precio  * $d->cantidad) - ( ($d->precio  * $d->cantidad) * ($d->descuento/100) ), 2 , ',' , '.')}} </td>
				</tr>
				@endforeach
				@if($pedido->modo_venta == 'Ahora6')
				<tr>
					<td class="textleft" style="font-size: 16px;"> Financiacion Ahora 6 </td>
					<td class="textcenter" style="font-size: 16px;"> 1 </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( round( $suma * 0.08,0 ) , 2 , ',' , '.') }} </td>
					<td class="textcenter" style="font-size: 16px;"> - </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( round( $suma * 0.08,0 ) , 2 , ',' , '.') }} </td>
				</tr>
				@endif
				@if($pedido->modo_venta == 'Ahora12')
				<tr>
					<td class="textleft" style="font-size: 16px;"> Financiacion Ahora 12 </td>
					<td class="textcenter" style="font-size: 16px;"> 1 </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( round( $suma * 0.15,0 ) , 2 , ',' , '.') }} </td>
					<td class="textcenter" style="font-size: 16px;"> - </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( round( $suma * 0.15,0 ) , 2 , ',' , '.') }} </td>
				</tr>
				@endif
				@if($pedido->modo_venta == 'Ahora18')
				<tr>
					<td class="textleft" style="font-size: 16px;"> Financiacion Ahora 18 </td>
					<td class="textcenter" style="font-size: 16px;"> 1 </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( round( $suma * 0.20,0 ) , 2 , ',' , '.') }} </td>
					<td class="textcenter" style="font-size: 16px;"> - </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( round( $suma * 0.20,0 ) , 2 , ',' , '.') }} </td>
				</tr>
				@endif
				<tr>
					<td></td>
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
					<td></td>
				</tr>
			</tbody>
			<tfoot id="detalle_totales">
				<tr>
					<td colspan="4" class="textright"><span></span></td>
					<td class="textcenter">-</td>
				</tr>
				<tr>
					<td colspan="4" class="textright"><span></span></td>
					<td class="textcenter">-</td>
				</tr>
				<tr>
					<td colspan="4" class="textright" >Total</td>
					<td class="textcenter">* AR$ {{ number_format( round( $pedido->total ), 2 , ',' , '.')}}</td>
				</tr>
			</tfoot>
			
		</table>


	<table id="factura_head">
		<tr>
			<td class="info_factura">
				<br>
				<div class="round">
					<span class="sinBorde">
					<strong>	Observaciones </strong>
					</span>
					<p style="font-size: 16px;">{{$pedido->observaciones }} </p>
					<span class="sinBorde">
					<strong>	Datos de Entrega </strong>
					</span>
					
					@if($pedido->tipo_entrega == 'Retira del Local')
					<p>RETIRA EN DEPOSITO DHS : CARLOS PELLEGRINI 1531 (4000) SAN MIGUEL DE TUCUMAN</p>
					<br>
					@else
						<p>Forma de Entrega <strong> {{$pedido->tipo_entrega}} </strong></p>
						<br>
						<p>
						Direccion: <strong>{{$pedido->cliente->direccion . ' , '.$pedido->cliente->ciudad . ' , '.$pedido->cliente->provincia->nombre}} Argentina </strong>
						<br>
					@endif
					<p>* El tipo de cambio a efectos impositivos es de Dolar 1 = Pesos AR$ {{$cotizacion->cotizacion}}</p>
				</div>
			</td>
			
		</tr>
	</table>

	<div class="input-group mb-3">
		<div class="input-group-prepend">
			Realizado Por:
			<br>
			<br>
			<div class="input-group-text">
			<b>Alexis:</b><input type="checkbox" aria-label="Checkbox for following text input">
			<b>David:</b> <input type="checkbox" aria-label="Checkbox for following text input">
			<b>Facundo:</b> <input type="checkbox" aria-label="Checkbox for following text input">
			<b>Fernando:</b> <input type="checkbox" aria-label="Checkbox for following text input">
			<b>Matias:</b> <input type="checkbox" aria-label="Checkbox for following text input">
		</div>
	</div>
	
</div>

</body>
<body>

<div id="page_pdf">
	<table id="factura_head">
		<tr>
			<td class="info_factura">
				<div>
					@if($pedido->unidad_id == '4')
						<img src="img/logos/munay-logo.png" style="height:60px; width 60px;">
					@else
						<img src="img/logo.jpg" class='imgRedonda' >
					@endif			
				</div>
			</td>
			<td class="info_empresa">
				<div>			
				<p></p>
					@if($pedido->unidad_id == '4')
						<span><p class="h2">MUNAY</p> </span> 
						<span class="h2">PRODUCTOS DE DISEÑOS</span>
					@else
						<span class="h2">DHS TECNOLOGIA & SERVICIOS</span>
					@endif
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
						NOTA DE VENTA
							X
					</span>
					<p><strong>{{$pedido->num_pedido}}</strong></p>
					<p>Fecha: {{$pedido->getFromDateAttribute($pedido->fecha)}}</p>
					<p>Hora: {{$pedido->getFromhora($pedido->fecha)}}</p>
					<p>Vendedor: {{$pedido->user->apellido . ' ' . $pedido->user->nombre}}</p>
					<br>
					<p class="textcenter">COPIA PARA EL CLIENTE</p>
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
							<td>Cliente: <strong>{{$pedido->cliente->razon_Social}} </strong></td>
							<td>Domicilio: <strong>{{$pedido->cliente->direccion . ' , '.$pedido->cliente->ciudad . ' , '.$pedido->cliente->provincia->nombre}} </strong></td>
						</tr>
						<tr style="font-size: 14px;">
							<td> Condicion de Venta: <strong>{{$pedido->modo_venta}} </strong></td>
							<td> C.U.I.T: <strong>{{$pedido->cliente->cuit_cuil}} </strong></td>
						</tr>
						<tr style="font-size: 14px;">
							<td> Telefono: <strong>{{$pedido->cliente->telefonos}} </strong></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>


	
		<table id="factura_detalle">
		
			<thead>
				<tr>
					<th class="textcenter" width="200px">Producto</th>
					<th class="textcenter" width="50px"> Cantidad</th>
					<th class="textcenter" width="100px">Precio Unitario</th>
					<th class="textcenter" width="50px">Descuento</th>
					<th class="textcenter" width="100px"> SubTotal </th>
				</tr>
			</thead>
			<tbody id="detalle_productos">
				@foreach ($detalle as $d)
				<tr>
					<td class="textleft" style="font-size: 16px;">{{$d->producto->nombre}}</td>
					<td class="textcenter" style="font-size: 16px;">{{$d->cantidad}}</td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( $d->precio, 2 , ',' , '.')}} </td>
					<td class="textcenter" style="font-size: 16px;"> {{ $d->descuento }} % </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( ($d->precio  * $d->cantidad) - ( ($d->precio  * $d->cantidad) * ($d->descuento/100) ), 2 , ',' , '.')}} </td>
				</tr>
				@endforeach
				@if($pedido->modo_venta == 'Ahora6')
				<tr>
					<td class="textleft" style="font-size: 16px;"> Financiacion Ahora 6 </td>
					<td class="textcenter" style="font-size: 16px;"> 1 </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( round( $suma * 0.08,0 ) , 2 , ',' , '.') }} </td>
					<td class="textcenter" style="font-size: 16px;"> - </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( round( $suma * 0.08,0 ) , 2 , ',' , '.') }} </td>
				</tr>
				@endif
				@if($pedido->modo_venta == 'Ahora12')
				<tr>
					<td class="textleft" style="font-size: 16px;"> Financiacion Ahora 12 </td>
					<td class="textcenter" style="font-size: 16px;"> 1 </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( round( $suma * 0.15,0 ) , 2 , ',' , '.') }} </td>
					<td class="textcenter" style="font-size: 16px;"> - </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( round( $suma * 0.15,0 ) , 2 , ',' , '.') }} </td>
				</tr>
				@endif
				@if($pedido->modo_venta == 'Ahora18')
				<tr>
					<td class="textleft" style="font-size: 16px;"> Financiacion Ahora 18 </td>
					<td class="textcenter" style="font-size: 16px;"> 1 </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( round( $suma * 0.20,0 ) , 2 , ',' , '.') }} </td>
					<td class="textcenter" style="font-size: 16px;"> - </td>
					<td class="textcenter" style="font-size: 16px;"> AR$ {{ number_format( round( $suma * 0.20,0 ) , 2 , ',' , '.') }} </td>
				</tr>
				@endif
				<tr>
					<td></td>
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
					<td></td>
				</tr>
			</tbody>
			<tfoot id="detalle_totales">
				<tr>
					<td colspan="4" class="textright"><span></span></td>
					<td class="textcenter">-</td>
				</tr>
				<tr>
					<td colspan="4" class="textright"><span></span></td>
					<td class="textcenter">-</td>
				</tr>
				<tr>
					<td colspan="4" class="textright" ><span>TOTAL PESOS</span></td>
					<td class="textcenter">* AR$ {{ number_format(  round( $pedido->total), 2 , ',' , '.')}}</td>
				</tr>
			</tfoot>
			
		</table>


		<table id="factura_head">
		<tr>
			<td class="info_factura">
				<br>
				<div class="round">
					<span class="sinBorde">
					<strong>	Observaciones </strong>
					</span>
					<p style="font-size: 16px;">{{$pedido->observaciones }} </p>
					<span class="sinBorde">
					<strong>	Datos de Entrega </strong>
					</span>
					
					@if($pedido->tipo_entrega == 'Retira del Local')
					<p>RETIRA EN DEPOSITO DHS : CARLOS PELLEGRINI 1531 (4000) SAN MIGUEL DE TUCUMAN</p>
					<br>
					@else
						<p>Forma de Entrega <strong> {{$pedido->tipo_entrega}} </strong></p>
						<br>
						<p>
						Direccion: <strong>{{$pedido->cliente->direccion . ' , '.$pedido->cliente->ciudad . ' , '.$pedido->cliente->provincia->nombre}} Argentina </strong>
						<br>
					@endif
					<p>* El tipo de cambio a efectos impositivos es de Dolar 1 = Pesos AR$ {{$cotizacion->cotizacion}}</p>
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