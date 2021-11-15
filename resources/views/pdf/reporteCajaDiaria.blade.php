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
				
				<span class="h2">DHS TECNOLOGIA & SERVICIOS</span>
					<p>AVENIDA CARLOS PELLEGRINI 1531 (4000) </p>
					<p>TUCUMAN ARGENTINA</p>
					<p>TELEFONO:(0381) 4361146 / 4364239</p>
					<p>dhsay@arnet.com.ar</p>
					
				</div>
			</td>
			
			<td class="info_factura">
				<br>
				<div class="round">
					<span class="h3">REPORTE CAJA</span>
					<p>Caja: <strong>{{$cajas->nombre}}</strong></p>
                    <br>
					<p>Fecha: <strong>{{$fechaApertura->getDia($fechaApertura->created_at)}}</strong></p>
					<br>
				</div>
			</td>
		</tr>
	</table>

    <table id="factura_detalle">
		
			<thead>
				<tr>
					<th width="150px">Forma</th>
					<th class="textcenter">Ingresos en Pesos</th>
					<th class="textcenter">Egresos en Pesos</th>
					<th class="textcenter">Total en Pesos</th>
					<th class="textright" width="150px">Ingresos en Dolares</th>
				</tr>
			</thead>
			<tbody id="detalle_productos">
				<tr>
					<td class="textcenter">Efectivo</td>
                        @if($efectivo->totalpesos)
                        <td class="textcenter">AR$ {{$efectivo->totalpesos}}</td>
						<td class="textcenter">AR$ {{$efectivo->totalSalida}}</td>
						<td class="textcenter">AR$ {{$efectivo->totalpesos - $efectivo->totalSalida}}</td>
                        @else
                        <td class="textcenter">AR$ 0</td>
						<td class="textcenter">AR$ 0</td>
						<td class="textcenter">AR$ 0</td>
                        @endif
                        
                        @if($efectivo->totaldolares)
					    <td class="textcenter">U$D {{$efectivo->totaldolares}}</td>
                        @else
                        <td class="textcenter">U$D 0</td>
                        @endif
				</tr>
                <tr>
					<td class="textcenter">Cheque</td>
                    
                    @if($cheque->totalpesos)
					<td class="textcenter">AR$ {{$cheque->totalpesos}}</td>
					<td class="textcenter">AR$ {{$cheque->totalSalida}}</td>
					<td class="textcenter">AR$ {{$cheque->totalpesos - $cheque->totalSalida}}</td>
                    @else
                    <td class="textcenter">AR$ 0</td>
					<td class="textcenter">AR$ 0</td>
					<td class="textcenter">AR$ 0</td>
                    @endif
                    
                    @if($cheque->totalDolares)
					<td class="textcenter">U$D {{$cheque->totalDolares}}</td>
                    @else
                    <td class="textcenter">U$D 0</td>
                    @endif
                    
				</tr>
                <tr>
						<td class="textcenter">Transferencia</td>
                        @if($transferencia->totalpesos)
                        <td class="textcenter">AR$ {{$transferencia->totalpesos}}</td>
						<td class="textcenter">AR$ {{$transferencia->totalSalida}}</td>
						<td class="textcenter">AR$ {{$transferencia->totalpesos - $transferencia->totalSalida}}</td>
                        @else
                        <td class="textcenter">AR$ 0</td>
						<td class="textcenter">AR$ 0</td>
						<td class="textcenter">AR$ 0</td>
                        @endif

                        @if($transferencia->totalDolares)
					        <td class="textcenter">U$D {{$transferencia->totalDolares}}</td>
                        @else
                            <td class="textcenter">U$D 0</td>
                        @endif
				</tr>
                <tr>
						<td class="textcenter">Mercado Pago</td>
                        @if($mercado->totalpesos)
                        <td class="textcenter">AR$ {{$mercado->totalpesos}}</td>
						<td class="textcenter">AR$ {{$mercado->totalSalida}}</td>
						<td class="textcenter">AR$ {{$mercado->totalpesos - $mercado->totalSalida}}</td>
                        @else
                        <td class="textcenter">AR$ 0</td>
						<td class="textcenter">AR$ 0</td>
						<td class="textcenter">AR$ 0</td>
                        @endif

                        @if($mercado->totalDolares)
					        <td class="textcenter">U$D {{$mercado->totalDolares}}</td>
                        @else
                            <td class="textcenter">U$D 0</td>
                        @endif
				</tr>

				<tr>
						<td class="textcenter">Tarjeta de Credito</td>
                        @if($tarjeta->totalpesos)
                        <td class="textcenter">AR$ {{$tarjeta->totalpesos}}</td>
						<td class="textcenter">AR$ {{$tarjeta->totalSalida}}</td>
						<td class="textcenter">AR$ {{$tarjeta->totalpesos - $tarjeta->totalSalida}}</td>
                        @else
                        <td class="textcenter">AR$ 0</td>
						<td class="textcenter">AR$ 0</td>
						<td class="textcenter">AR$ 0</td>
                        @endif

                        @if($tarjeta->totalDolares)
					        <td class="textcenter">U$D {{$tarjeta->totalDolares}}</td>
                        @else
                            <td class="textcenter">U$D 0</td>
                        @endif
				</tr>

				<tr>
						<td class="textcenter">Ahora 8</td>
                        @if($ahora8->totalpesos)
                        <td class="textcenter">AR$ {{$ahora8->totalpesos}}</td>
						<td class="textcenter">AR$ {{$ahora8->totalSalida}}</td>
						<td class="textcenter">AR$ {{$ahora8->totalpesos - $ahora8->totalSalida}}</td>
                        @else
                        <td class="textcenter">AR$ 0</td>
						<td class="textcenter">AR$ 0</td>
						<td class="textcenter">AR$ 0</td>
                        @endif

                        @if($ahora8->totalDolares)
					        <td class="textcenter">U$D {{$ahora8->totalDolares}}</td>
                        @else
                            <td class="textcenter">U$D 0</td>
                        @endif
				</tr>

				<tr>
						<td class="textcenter">Ahora 10</td>
                        @if($ahora10->totalpesos)
                        <td class="textcenter">AR$ {{$ahora10->totalpesos}}</td>
						<td class="textcenter">AR$ {{$ahora10->totalSalida}}</td>
						<td class="textcenter">AR$ {{$ahora10->totalpesos - $ahora10->totalSalida}}</td>
                        @else
                        <td class="textcenter">AR$ 0</td>
						<td class="textcenter">AR$ 0</td>
						<td class="textcenter">AR$ 0</td>
                        @endif

                        @if($ahora10->totalDolares)
					        <td class="textcenter">U$D {{$ahora10->totalDolares}}</td>
                        @else
                            <td class="textcenter">U$D 0</td>
                        @endif
				</tr>

				<tr>
						<td class="textcenter">Ahora 12</td>
                        @if($ahora12->totalpesos)
                        <td class="textcenter">AR$ {{$ahora12->totalpesos}}</td>
						<td class="textcenter">AR$ {{$ahora12->totalSalida}}</td>
						<td class="textcenter">AR$ {{$ahora12->totalpesos - $ahora12->totalSalida}}</td>
                        @else
                        <td class="textcenter">AR$ 0</td>
						<td class="textcenter">AR$ 0</td>
						<td class="textcenter">AR$ 0</td>
                        @endif

                        @if($ahora12->totalDolares)
					        <td class="textcenter">U$D {{$ahora12->totalDolares}}</td>
                        @else
                            <td class="textcenter">U$D 0</td>
                        @endif
				</tr>
			</tbody>

	</table>


	<table id="factura_head">
    <span class="sinBorde">DETALLES</span>
	</table>

    <br>

    <table id="factura_detalle">
		
			<thead>
				<tr>
					<th width="10px" class="textcenter"> Tipo</th>
					<th width="100px" class="textleft"> Descripción</th>
					<th class="textleft" width="50px"> Ingreso</th>
					<th class="textleft" width="50px"> Egreso </th>
                    <th class="textleft" width="20px"> Forma </th>
					<th class="textleft" width="50px"> N° Cheque </th>
				</tr>
			</thead>
			<tbody id="detalle_productos">
                @foreach($movimientos as $movimiento)
				<tr>
					<td class="textcenter"> {{$movimiento->forma}} </td>
					<td class="textleft"> {{$movimiento->descripcion}} </td>
					<td class="textleft"> AR$ {{$movimiento->entrada}} </td>
					<td class="textleft"> AR$ {{$movimiento->salida}} </td>
                    <td class="textleft"> {{$movimiento->tipo}} </td>
					<td class="textleft">{{$movimiento->num_cheque}} </td>
				</tr>
				@endforeach
			</tbody>

		</table>

	<div>
		<br>
		<p class="nota">FIRMA: ......................................................</p>
		<br>
		<br>
		<p class="nota">ACLARACION: ......................................................</p>
	</div>

</div>

</body>
</html>