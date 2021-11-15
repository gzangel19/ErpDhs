@extends('layouts.app')

@section('title','Registro Servicio Tecnico')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/servicios')}}" class="nav-link"> <i class="fas fa-tools"></i> Servicio Tecnico  </a>
                                    
    </li>

    <li class="breadcrumb-item">
            
        <a href="#" class="nav-link"> <i class="fas fa-tools"></i> Registro Servicio Tecnico  {{ $cliente->razon_Social }}  </a>
                                                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="page_user">

        <div class="row mtop16">
                
			<div class="col-md-3">

				<div class="panel shadow">

					<div class="inside">

						<div class="header">
							
							<h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-user"></i> Cliente </a> </h2> 
						
						</div>

						<div class="mini_profile">

							<div class="info">
								
								<span class="title"> <i class="fas fa-user-tie"></i> Apellido y Nombre </span>
									
								<span class="text">  {{$cliente->razon_Social}} </span>

								<span class="title"> <i class="fas fa-phone"></i> Telefono </span>
								
								<span class="text capitalize"> {{$cliente->telefonos}} </span>

								<span class="title"> <i class="fas fa-mobile-alt"></i> Celular </span>
								
								<span class="text capitalize"> {{$cliente->telefonos}} </span>

								<span class="title"> <i class="fas fa-street-view"></i> Direccion </span>
								
								<span class="text capitalize"> {{$cliente->direccion}} </span>

								<span class="title"> <i class="far fa-building"></i> Localidad </span>
								
								<span class="text capitalize"> {{$cliente->ciudad}} </span>

								<span class="title"> <i class="fas fa-city"></i> Provincia </span>
								
								<span class="text capitalize"> {{$cliente->provincia->nombre}} </span>
								
							</div>
							
						</div>

					</div>

				</div>

			</div>

			<div class="col-md-6">

				<div class="panel shadow">

					<div class="inside">

						<div class="header">
							
							<h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-plus"></i> Registrar Servicio Tecnico </a> </h2> 
						
						</div>

						{!! Form::open(['url'=>'servicios/store']) !!}

							{!!Form::hidden('cliente_id',$cliente->id,['class' => 'form-control'])!!} 
							{!!Form::hidden('equipo_id',$equipo->id,['class' => 'form-control'])!!} 

							<div class="row">
							
								<div class="col-md-12">
											
									<div class="form-group mtop16">
									
										<label> Costo de Revision </label>
											
										<select class="form-select select2" style="width: 100%;" id="costoRevision" name="costoRevision">
							
											@foreach($productos as $producto)

												@if($producto->moneda == 'Dolares')	
											
													<option value="{{ $producto->precioLocal * $dolar->valor }}"> {{$producto->nombre}}, Costo: AR$ {{ number_format($producto->precioLocal * $dolar->valor, 2 , ',' , '.')}} </option>
											
												@else

													<option value="{{ $producto->precioLocal }}"> {{$producto->nombre}}, Costo: AR$ {{ number_format($producto->precioLocal, 2 , ',' , '.')}} </option>

												@endif

											@endforeach

										</select>
								
									</div>
													
								</div>

							</div>

							<div class="row mtop16">

								<div class="col-md-12">
									
									<div class="form-group">
										
										<label> Posible Falla </label>
											
										<textarea class="form-control" id="falla" name="falla" rows="5"></textarea>
										
									</div>

								</div>

							</div>
								
						
							<div class="row mtop16">
								
								<div class="col-md-12">
												
									{!!Form::submit('Guardar',['class' => 'btn btn-success']) !!}    
														
									<a class="btn btn-danger" href="{{route('servicios.index')}}" role="button">Volver</a> 
								
								</div>

							</div>

						{!! Form::close() !!}

					</div>

				</div>

			</div>
				
			<div class="col-md-3">

					<div class="panel shadow">

						<div class="inside">

							<div class="header">
								
								<h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-print"></i> Equipo </a> </h2> 
							
							</div>

							<div class="mini_profile">

								<div class="info">
									
									<span class="title"> <i class="fas fa-print"></i> Modelo </span>
										
									<span class="text"> {{$equipo->modelo}} </span>

									<span class="title"> <i class="fas fa-sort-numeric-up-alt"></i> Numero de Serie </span>
									
									<span class="text capitalize"> {{$equipo->numeroSerie}} </span>

									<span class="title"> <i class="fas fa-palette"></i> Tipo </span>
									
									<span class="text capitalize"> {{$equipo->tipo}} </span>

									<span class="title"> <i class="fas fa-fill-drip"></i> Condicion </span>
									
									<span class="text capitalize"> {{$equipo->condicion}} </span>

									<span class="title"> <i class="far fa-building"></i> Estado </span>
									
									<span class="text capitalize"> {{$equipo->estado}} </span>

								</div>
								
							</div>

						</div>

					</div>

				</div>
			
			</div>

		</div>

	</div>

</div>


<!-- FIN Modal Productos-->	

<!-- Modal Clientes-->


<!-- FIN Modal Clientes-->	

@endsection

