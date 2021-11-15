<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Pedidos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>

  <style>
    #div1{
      float:left;
      width:100%;
      background-color:blue;
      margin:0px;
      
    }

    #div1 h1{
      padding:16px;
      color:white !important;
    }

    #div3{
      clear:both;
    }
    
    table{
	    width:100%; 
	    border-collapse:collapse;
    }
    
    td{
	    border:2px solid black;
    }
  </style>
  
  <body>
    
    <div id="div1">

      <h1> GRUPO DHS </h1>

    </div>
  
  <div id="div3">
  <br>
  <h4> Listado Pedidos Pendientes <?php  echo "Fecha: " . date("d") . "/" . date("m") . "/" . date("Y"); ?></h4>
  <br>
    <table class="table table-bordered">
    <thead>
      <tr style="background-color: black; color:white">
        <td>Codigo</td>
        <td>Cliente</td>
        <td>Entrega</td>
        <td>Estado</td>
      </tr>
      </thead>
      <tbody>
        @foreach ($pedidos as $pedido)
        <tr>
            <td>{{ $pedido->num_pedido }}</td>
            <td>{{ $pedido->cliente->nombre_Fantasia }}</td>
            <td>{{ $pedido->estado }}</td>
            <td>{{ $pedido->pago }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </body>
</html>