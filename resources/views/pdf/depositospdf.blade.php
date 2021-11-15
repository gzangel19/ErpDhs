<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content ="width=device-width,initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content ="ie=edge">
<title>Listado de Depositos</title>

<style>
/*
	Color fondo: #632432;
	Color header: 246355;
	Color borde: 0F362D;
	Color iluminado: 369681;
*/
body{
	font-family: Arial;
}

#main-container{
	margin: 150px auto;
	width: 600px;
}

table{
	background-color: white;
	text-align: left;
	border-collapse: collapse;
	width: 100%;
}

th, td{
	padding: 20px;
  text-align: center;
}

thead{
	background-color: #246355;
	border-bottom: solid 5px #0F362D;
	color: white;
}

tr:nth-child(even){
	background-color: #ddd;
}

tr:hover td{
	background-color: #369681;
	color: white;
}

  </style>

</head>

<body>

    <div>

        <h2> Depositos Registrados Al </span> <?php echo $hoy = date("d/m/20y");?>
        
        </h2>

    </div>

    <div>
    <table>
            <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Tel&eacute;fono</th>
                  <th>Direccion</th>
                  <th>Ciudad</th>
                  <th>Provincia</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($depositos as $deposito)
                  <tr>
                    <td>{{ $deposito->nombre }} </td>
                    <td>{{ $deposito->telefonos }}</td>
                    <td>{{ $deposito->direccion }}</td>
                    <td>{{ $deposito->ciudad }}</td>
                    <td>{{ $deposito->provincia->nombre }}</td>
                  </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</body>

</html>