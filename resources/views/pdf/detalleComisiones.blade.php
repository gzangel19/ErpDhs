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
.sinBorde{
	font-family: 'BrixSansBlack';
	font-size: 14pt;
	display: block;
	text-align: center;
	padding: 3px;
	margin-bottom: 5px;
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
.info_factura2{
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

.detalleComision {
  font-family: Helvetica, Arial, sans-serif;
  font-size: 15px;
  text-transform: capitalize;
  margin-left: 50px;
}

.comision{
	font-family: Helvetica, Arial, sans-serif;
  	font-size: 20px;
  	text-transform: capitalize;
  	margin-left: 300px;
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
				
				<span class="h2">DHS TECNOLOGIA & SERVICIOS</span>
					<p>AVENIDA CARLOS PELLEGRINI 1531 (4000) </p>
					<p>TUCUMAN ARGENTINA</p>
					<p>TELEFONO:(0381) 4361146 / 4364239</p>
					<p>dhsay@arnet.com.ar</p>
					
				</div>
			</td>
			
			<td class="info_factura2">
			</td>
		</tr>
	</table>

	<div>
		<p class="comision"> <strong> DETALLE COMISION  </strong> </p>
		<br>
		<p class="detalleComision"> <strong> Fecha Desde:  </strong> {{$searchText}} <strong> Fecha Hasta:  </strong> {{$ultimo}}  </p>
		<br>
		<p class="detalleComision"> <strong> Vendedor:  </strong> {{$vendedor->apellido}} {{$vendedor->nombre}}  </p>
		<br>
		<p class="detalleComision"> <strong> Comisiones de Ventas:  </strong> AR$ {{number_format( $porcentaje, 2 , ',' , '.')}} </p>
		<br>
		<p class="detalleComision"> <strong> Bonus Por Ventas:  </strong> AR$ {{number_format( $totalBonus, 2 , ',' , '.')}} </p>
		<br>
		<p class="detalleComision"> <strong> Total:  </strong> AR$ {{number_format( $totalComision, 2 , ',' , '.')}} </p>
		<br>
	</div>

	<br>
	<p class="comision"> <strong> DETALLE VENTAS  </strong> </p>
	<br>
    <table id="factura_detalle">
			<thead>
				<tr>
					<th class="textcenter" width="150px"> Fecha </th>
					<th class="textcenter"> Cliente </th>
					<th class="textcenter"> Nº Venta </th>
					<th class="textcenter" width="150px"> Total </th>
				</tr>
			</thead>
			<tbody id="detalle_productos">
				@foreach ($ventas as $pedido)
				<tr>
						<td class="textcenter"> {{ $pedido->getFromDateAttribute($pedido->fechaCancelacion) }} </td>
                        <td class="textcenter"> {{ $pedido->cliente->razon_Social }} </td>
						<td class="textcenter"> {{ $pedido->num_pedido }} </td>
						<td class="textcenter"> AR$ {{number_format( $pedido->total, 2 , ',' , '.')}}</td>
				</tr>
				@endforeach
			</tbody>

	</table>

</div>

</body>
</html>