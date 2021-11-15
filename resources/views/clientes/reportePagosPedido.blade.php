<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title> Informe de Pago y Venta </title>

        <style>
            .clearfix:after {
            content: "";
            display: table;
            clear: both;
            }

            a {
            color: #5D6975;
            text-decoration: underline;
            }

            body {
            position: relative;
            width: 21cm;  
            height: 29.7cm; 
            margin: 0 auto; 
            color: #001028;
            background: #FFFFFF; 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            font-family: Arial;
            }

            header {
            padding: 10px 0;
            margin-bottom: 16px;
            }

            .mtop16{
                margin-top:16px;
            }

            #logo {
            background-color:#004e9d;
            text-align: center;
            margin-bottom: 10px;
            }

            #logo img {
            width: 240px;
            height:100px;
            }

            h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
            }

            #project {
            float: left;
            }

            #project span {
            color: #000000;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.9em;
            font-weight:bold;
            }

            .tg{
                font-size: 1.2em;
            }

            #company {
            float: right;
            text-align: right;
            }

            #project div,
            #company div {
            white-space: nowrap;        
            }

            table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 32px;
            }

            table tr:nth-child(2n-1) td {
            background: #F5F5F5;
            }

            table th,
            table td {
            text-align: center;
            }

            table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;        
            font-weight: normal;
            }

            table .service,
            table .desc {
            text-align: left;
            }

            table td {
            padding: 20px;
            text-align: center;
            }

            table td.service,
            table td.desc {
            vertical-align: top;
            }

            table td.unit,
            table td.qty,
            table td.total {
            font-size: 1.2em;
            }

            table td.grand {
            border-top: 1px solid #5D6975;;
            }

            #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
            }

            footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
            }
                    
        </style>

  </head>
  
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="img/327-DHS Tecnología y Servicios.png">
      </div>
      <h1> {{ $pedido->num_pedido }}</h1>

      <div id="project">

        <div class="mtop16 tg"><span>Cliente: </span> {{ $pedido->cliente->razon_Social }} </div>
        <div class="mtop16 tg"><span>Vendedor: </span> {{ $pedido->user->apellido}} , {{ $pedido->user->nombre}}  </div>
        <div class="mtop16 tg"><span>Estado: </span> {{ $pedido->estado }}  </div>
        <div class="mtop16 tg"><span>Fecha: </span>  {{ $pedido->getFromDateAttribute( $pedido->fecha) }} </div>
      </div>
    </header>
    
    <main>

        <h2> Detalle de la Compra:</h2>

        <table>

            <thead>
                <tr>
                    <th class="service">Nombre</th>
                    <th class="desc">Cantidad</th>
                    <th>Precio</th>
                    <th>Descuento	</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($pedido->detalle_pedido as $det)
                <tr>
                    <td class="unit"> {{$det->producto->nombre }} </td>
                    <td class="unit"> {{$det->cantidad }} [u] </td>
                    <td class="unit"> AR$ {{ round( $det->precio,0 )}} </td>
                    <td class="qty"> {{ $det->descuento }} % </td>
                    <td class="total"> AR$  {{ round( ($det->precio  * $det->cantidad) - ( ($det->precio  * $det->cantidad) * ($det->descuento/100) ),0 ) }} </td>
                </tr>
                @endforeach
                <tr>
                    <td class="unit"> </td>
                    <td class="unit"> </td>
                    <td class="unit"> </td>
                    <td class="qty"> Total </td>
                    <td class="total"> AR$  {{ $pedido->total }} </td>
                </tr>
            </tbody>
            
        </table>

        <div style="page-break-after:always;">  </div>

        <h2> Pagos Registrados:</h2>

        <table>

            <thead>
                <tr>
                    <th class="service">Fecha</th>
                    <th class="desc">Forma de Pago</th>
                    <th> Monto Ingresado </th>
                    <th> Tipo	</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($pagosPedidos as $pago)
                <tr>
                    <td class="unit"> {{$pago->getFromDateAttribute($pago->created_at) }} </td>
                    <td class="unit"> {{$pago->tipo }} @if($pago->tipo == "Cheque") Nº {{ $pago->cuil_cheque }} @endif </td>
                    <td class="unit"> AR$ {{ round( $pago->entrada,0 )}} </td>
                    <td class="qty"> {{ $pago->forma }}  </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>

      <div id="notices">
        <div></div>
        <div class="notice"></div>
      </div>

        <footer>
            
            Informe De estado pago y venta,  válida por DHS.
        
        </footer>

    </main>
  </body>
</html>