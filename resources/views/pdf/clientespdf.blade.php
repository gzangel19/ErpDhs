<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Clientes</title>
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

      Tienda DHS Tecnologias & Servicios

    </div>
    
    <div id="div2">

      <?php
        echo "Fecha: " . date("d") . "/" . date("m") . "/" . date("Y");
      ?>
    
    </div>
  
  <div id="div3">
  <br>
  <h4> Listado de Clientes Registrados </h4>
  <br>
    <table class="table table-bordered">
    <thead>
      <tr style="background-color: black; color:white">
        <td>#</td>
        <td>Nombre</td>
        <td>Genero</td>
        <td>Cuit-Cuil</td>
        <td>Telefono</td>
        <td>Direccion</td>
      </tr>
      </thead>
      <tbody>
        @foreach ($clientes as $cliente)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{ $cliente->nombre_Fantasia }}</td>
            <td>{{ $cliente->genero }}</td>
            <td>{{ $cliente->cuit_cuil }}</td>
            <td>{{ $cliente->telefonos }} </td>
            <td>{{ $cliente->direccion }} {{ $cliente->ciudad }} {{ $cliente->provincia->nombre }} </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </body>
</html>