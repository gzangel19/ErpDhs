<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Productos</title>
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
  <h4> Listado de Productos Registrados </h4>
  <br>
    <table class="table table-bordered">
    <thead>
      <tr style="background-color: black; color:white">
        <td>#</td>
        <td>Codigo</td>
        <td>Nombre</td>
        <td>Precio Lista</td>
        <td>Precio Lista B</td>
        <td>Mercado Libre</td>
        <td>Eccomerce</td>
        <td>Precio Lista</td>
        <td>Precio Lista B</td>
      </tr>
      </thead>
      <tbody>
        @foreach ($productos as $producto)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{ $producto->codigo }}</td>
            <td>{{ $producto->nombre }}</td>
            <td>AR$ {{( $producto->costo_p  +  ($producto->costo_p * $producto->p_flete_p )) *  $producto->p_local_1p }} </p>
            <td>AR$ {{( $producto->costo_p  +  ($producto->costo_p * $producto->p_flete_p )) *  $producto->p_local_2p }} </p>
            <td>AR$ {{( $producto->costo_p  +  ($producto->costo_p * $producto->p_flete_p )) *  $producto->p_ml_p }} </p>
            <td>AR$ {{( $producto->costo_p  +  ($producto->costo_p * $producto->p_flete_p )) *  $producto->p_ec_p }} </p>
            <td>U$D {{( $producto->costo_d  +  ($producto->costo_d * $producto->p_flete_d )) *  $producto->p_local_2d }} </p>
            <td>U$D {{( $producto->costo_d  +  ($producto->costo_d * $producto->p_flete_d )) *  $producto->p_local_1d }} </p>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </body>
</html>