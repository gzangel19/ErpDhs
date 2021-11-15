@extends('layouts.app')
@section('content')

<div class="container">
    
	<div class="row justify-content-center">
	
		<div class="col-md-12">
	    	
			<section class="content-header">
            	
				<div class="container-fluid">
              		
            	
				</div>
        	
			</section>
		
          	<div class="card card-secondary">

				<div class="card-body">
					
				<form method="post" action="{{ route('servicios.update',$servicio->id)}}" name="formulario">
				
					{{ csrf_field() }}

	  				{{ method_field('PUT') }}

					<div class="row">	
					
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

							<h3> Finalizar Servicio Tecnico </h3>
							
							<h4> Cliente:  {{ $servicio->cliente->razon_Social }} </h4>	

							<h4> Equipo: {{ $servicio->maquina->modelo }} </h4>	

							<br>
														
						</div>

					</div>

					<div class="row">

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							
							<div class="form-group">
								
								<label> Costo de Trabajo </label>

							<input type="text" name="costoTrabajo" id="costoTrabajo" class="form-control">

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							
							<div class="form-group">
								
								<label> Tarea Realizada </label>
									
								<textarea class="form-control" id="tareaRealizada" name="tareaRealizada" rows="4"></textarea>
								
							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							
							<div class="form-group">
								
								<label> Tecnico </label>
									
								<select class="form-control select2" style="width: 100%;" id="tecnico" name="tecnico">
            
									<option value="Alexis">Alexis</option>
									<option value="David">David</option>
									<option value="Facundo">Facundo</option>

				  				</select>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
								
								<div class="form-group">
									
									<label> Contador Color </label>

								<input type="text" name="contadorColor" id="contadorColor" class="form-control">

								</div>

						</div>

						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
								
								<div class="form-group">
									
									<label> Contador Negro </label>

								<input type="text" name="contadorNegro" id="contadorNegro" class="form-control">

								</div>

						</div>

						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
								
								<div class="form-group">
									
									<label> Contador Total </label>

								<input type="text" name="contadorTotal" id="contadorTotal" class="form-control">

								</div>

						</div>
					
					</div>

					<div class="row">
					
						<div class="col-lg-6 col-md-6 col-dm-6 col-xs-12" id="guardar1">
							
							<div class="form-group">
							
								<button id="guardar" class="btn btn-primary"  type="submit"> Finalizar </button>

								<a class="btn btn-danger" href="{{route('servicios.index')}}" role="button"> Volver </a>
							
							</div>
						
						</div>
				
					</div>
			
				</form>
			
			</div>

</div>
</div>
</div>
</div>


<!-- FIN Modal Productos-->	

<!-- Modal Clientes-->


<!-- FIN Modal Clientes-->	

@endsection

