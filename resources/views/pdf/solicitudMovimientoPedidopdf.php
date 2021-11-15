<!DOCTYPE HTML>

<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<title>Reporte Presupuesto</title>
    <style>

    *
    {
      margin:0px;
      padding:0px;
    }

    #logo{
      width: 350px;
      height: 200px;
    }

    .h1 {
      margin-top: 10px;
      margin-bottom: 10px;
      text-align:center;
    }

.tg  {border-collapse:collapse;border-color:#ccc;border-spacing:10;}
.tg td{background-color:#fff;border-color:#ccc;border-style:solid;border-width:1px;color:#333;
  font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{background-color:#f0f0f0;border-color:#ccc;border-style:solid;border-width:1px;color:#333;
  font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-mb4h{background-color:#38fff8;border-color:inherit;color:#000000;text-align:center;vertical-align:top}
.tg .tg-5986{background-color:#ffffff;border-color:inherit;text-align:center;vertical-align:top}
.tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
.tg .tg-p1mp{background-color:#f9f9f9;border-color:inherit;font-size:16px;text-align:center;vertical-align:top}
.tg .tg-jiz7{background-color:#38fff8;border-color:inherit;color:#330001;text-align:left;vertical-align:top}
.tg .tg-3xi5{background-color:#ffffff;border-color:inherit;text-align:center;vertical-align:top}
.tg .tg-9r5u{background-color:#38fff8;border-color:inherit;color:#000000;text-align:center;vertical-align:top}
.tg .tg-lfuo{background-color:#38fff8;border-color:inherit;color:#330001;text-align:left;vertical-align:top}
.tg .tg-bufu{background-color:#f9f9f9;border-color:inherit;font-size:14px;text-align:center;vertical-align:top}
.td2 {background-color:#fff;border-color:#ccc;border-style:solid;border-width:1px;color:#333;
  font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal;}
  </style>
</head>

<body>
	
  <div id='general'>

  <table class="tg" style="undefined;table-layout: fixed; width: 100%">
<colgroup>
<col style="width: 125px">
<col style="width: 88px">
<col style="width: 48px">
<col style="width: 49px">
<col style="width: 144px">
<col style="width: 154px">
<col style="width: 70px">
<col style="width: 63px">
<col style="width: 516px">
</colgroup>
<thead>
  <tr>
    <th class="tg-c3ow" colspan="9"><img src="img/logo.png" alt="Image" width="80" height="80"></th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-5986" colspan="9"><h2>Solicitud De Movimiento</h></td>
  </tr>
  <tr>
    <td class="tg-5986">Nº:</td>
    <td class="tg-5986" colspan="9">{{$presupuesto->cliente->direccion }} {{$presupuesto->cliente->ciudad}} </td>
  </tr>
  <tr>
    <td class="tg-5986">Fecha:</td>
    <td class="tg-5986" colspan="9">{{$presupuesto->cliente->direccion }} {{$presupuesto->cliente->ciudad}} </td>
  </tr>
</tbody>
</table>

<h3 class="h1"> PRODUCTOS TRASLADADOS AL DEPOSITO PELLEGRINI </h3>
<table class="tg" style="undefined;table-layout: fixed; width: 100%">
<colgroup>
<col style="width: 25%">
<col>
<col>
<col>
</colgroup>
<thead>
  <tr>
    <th class="td2">Producto</th>
    <th class="td2">Cantidad</th>
    <th class="td2">Deposito Original</th>
  </tr>
</thead>
<tbody>
    @foreach ($detalle as $det)
      <tr>
          <td  class="tg-bufu">{{$det->cantidad }}</td>
          <td  class="tg-bufu">{{$det->producto->nombre }}</td>         
          <td  class="tg-bufu">${{$det->precio }}</td>
      </tr>
    @endforeach
  </tr>

</tbody>
</table>

<h3 class="h1"> OBSERVACIONES </h3>
<table class="tg" style="undefined;table-layout: fixed; width: 100%">
<colgroup>
<col style="width: 25%">
<col>
<col>
<col>
</colgroup>
<thead>
</thead>
<tbody>
  <tr>
    <td class="tg-5986" colspan="9">
    El Cliente ha cancelado el pedido, los productos fueron transladados al deposito pellegrini
    </td>
  </tr>
</tbody>
    
      
	</div>

</body>

</html>