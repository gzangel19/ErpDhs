<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Presupuestos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>

  <style>
    #div1{
      float:left;
      width:850px;
    }

    #div2{
      float:left;
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

    DHS DIGITAL ©

    </div>
    
    <div id="div2">

      <?php
        echo "Fecha: " . date("d") . "/" . date("m") . "/" . date("Y");
      ?>
    
    </div>
  
  <div id="div3">
  <br>
  <h4> Listado Presupuestos Registrados </h4>
  <br>
    <table class="table table-bordered">
    <thead>
      <tr style="background-color: black; color:white">
        <td>#</td>
        <td>Cliente</td>
        <td>Fecha</td>
        <td>Total</td>
      </tr>
      </thead>
      <tbody>
        @foreach ($presupuestos as $presupuesto)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{ $presupuesto->cliente->nombre_Fantasia }}</td>
            <td>{{ $presupuesto->getFromDateAttribute($presupuesto->fecha) }}</td>
            @if($presupuesto->tipo == 'Pesos')
            <td> AR$ {{ $presupuesto->total }} </td>
            @else
            <td> USD {{ $presupuesto->total }} </td>
            @endif
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </body>
</html>