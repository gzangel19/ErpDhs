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

.mtop16{
	padding-top:16px;
}

.comision{
	font-family: Helvetica, Arial, sans-serif;
  	font-size: 20px;
  	text-transform: capitalize;
  	margin-left: 300px;
}

.text14{
	font-family:Arial !important;
	font-size:12px !important;
}

.cabeceraTabla{
	background-color: #51A8E0;ç
	color: #00000;
}

</style>

<body>

<?php

	$desde = date("d/m/Y", strtotime($searchText));

	$hasta = date("d/m/Y", strtotime($ultimo));

?>

<div id="page_pdf">
	<table id="factura_head">
		<tr>
			
			<td class="info_empresa">
				
				<div>			
				
					<span class="h2">DHS TECNOLOGIA & SERVICIOS</span>
					
					<div class="text14">
						<p>AVENIDA CARLOS PELLEGRINI 1531 (4000) </p>
						<p>TUCUMAN ARGENTINA</p>
						<p>TELEFONO:(0381) 4361146 / 4364239</p>
						<p>dhsay@arnet.com.ar</p>	
					</div>
					
				</div>
			</td>

		</tr>
	</table>

	<br>
	<p class="textcenter" style="font-size:24px"> <strong> Informe de Comisiones </p>
	<p class="textcenter mtop16" style="font-size:24px"> <strong> Desde <?php echo $desde ?> Hasta <?php echo $hasta ?>   </strong> </p>
	<br>
   	 	<table id="factura_detalle">
			<thead class="cabeceraTabla">
				<tr>
					<th class="textcenter" width="150px"> Vendedor </th>
					<th class="textcenter" width="150px"> Nº de Ventas </th>
					<th class="textcenter" width="150px"> Nº de Bonus </th>
					<th class="textcenter" width="150px"> Valor </th>
					<th class="textcenter" width="150px"> Total </th>
				</tr>
			</thead>
			<tbody id="detalle_productos">
				@foreach ($ventas as $venta)
				<tr>
						<td class="textcenter"> {{ $venta->apellido }} , {{ $venta->nombre }}  </td>
						<td class="textcenter"> {{ $venta->suma }}  </td>
						<td class="textcenter"> {{ floor ( ( ( $venta->totalPesos * ($venta->porcentaje/100) )  / $venta->bonus ) ) }}  </td>
						<td class="textcenter"> AR$ {{ number_format( (floor ( ( ( $venta->totalPesos * ($venta->porcentaje/100) )  / $venta->bonus ) )) * $venta->valorBonus, 2 , ',' , '.') }}  </td>
						<td class="textcenter"> AR$ {{ number_format( ( (floor ( ( ( $venta->totalPesos * ($venta->porcentaje/100) )  / $venta->bonus ) )) * $venta->valorBonus ) + ( $venta->totalPesos * ($venta->porcentaje/100) ), 2 , ',' , '.')  }}  </td>
				</tr>
				@endforeach
			</tbody>

	</table>

</div>

</body>
</html>