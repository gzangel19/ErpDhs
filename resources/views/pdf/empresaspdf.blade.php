<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content ="width=device-width,initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content ="ie=edge">
<title>Listado de Empresas Clientes</title>

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

        <h2> Empresas Clientes Registradas </span> </h2>

    </div>

    <div>

        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Tel&eacute;fono</th>
                  <th>Direccion</th>
                  <th>Provincia</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($empresas as $emp)
                  <tr>
                    <td>{{ $emp->nombre }}</td>
                    <td>{{ $emp->telefono }}</td>
                    <td>{{ $emp->domicilio }}</td>
                    <td>{{ $emp->provincia }}</td>
                    </td>
                  </tr>
                @endforeach                       
            </tbody>
        </table>

    </div>

    

</body>

</html>

