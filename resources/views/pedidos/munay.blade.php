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
					
					<form method="post" action="{{ route('munay.store')}}" name="formulario">
				
					{{ csrf_field() }}

					<div class="row">	
					
						<input type="hidden" readonly name="idCliente" id="idCliente" class="form-control" placeholder="">

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

								<h3> Nueva Venta Munay </h3>					
																
							</div>

					</div>

					<div class="row">

						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							
							<div class="form-group">

								<label for="exampleFormControlTextarea1">Cliente</label>
							
								<input type="text" name="cliente_nombre" id="cliente_nombre" class="form-control"  value="{{$cliente->razon_Social}}">

								<input type="hidden" name="cliente_id" id="cliente_id" class="form-control"  value="{{$cliente->id}}">
						
							</div>
				
						</div>

						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

							<div class="form-group">
								
								<label>Productos</label>
								
								<select class="form-control select2" style="width: 100%;" id="producto_id" name="producto_id">
									<option value="otro">A Futuro</option>
								</select>
							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							
						<div class="form-group">

							<label for="exampleFormControlTextarea1">Detalle</label>
							
							<textarea class="form-control" id="observaciones" name="observaciones" rows="4"></textarea>
						
						</div>

						</div>

					</div>

					<div class="row">

						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

							<div class="form-group">

								<label>Precio</label>
																				
								<input type="text" name="precio" id="precio" class="form-control"  placeholder="Precio">

							</div>

						</div>

						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							
							<div class="form-group">

								<label>Cantidad</label>
															
								<input type="text" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad">
							
							</div>
						
						</div>

					</div>

					<div class="row">

						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

							<div class="form-group">
								
								<label>Forma de Entrega</label>
							
								<select class="form-control select2" style="width: 100%;" id="elegido" name="elegido">
									<option value="Retira del Local"> Retira del Local </option>
									<option value="Envio por Transporte"> Envio por Transporte </option>
									<option value="Envio a Domicilio"> Envio a Domicilio </option>
									<option value="Envio por Cadete"> Envio por Cadete </option>
								</select>
							
							</div>

						</div>

						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

							<div class="form-group">
								
								<label> Modo de Pago </label>
								
								<select class="form-control select2" style="width: 100%;" id="modoPago" name="modoPago">
									<option value="Efectivo"> Efectivo </option>
									<option value="Transferencia Bancaria"> Transferencia Bancaria</option>
									<option value="Cuenta Corriente"> Cuenta Corriente</option>
									<option value="Cheque"> Cheque </option>
								</select>
							</div>

						</div>

					</div>
									
					<div class="row">
						
						<div class="col-lg-6 col-md-6 col-dm-6 col-xs-12" id="guardar1">
							
							<div class="form-group">
									
								<input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
								<button id="guardar" class="btn btn-primary"  type="submit">Guardar</button>
								<a class="btn btn-danger" href="{{route('pedidos.index')}}" role="button">Volver</a>
							</div>
						
						</div>
					
					</div>
				
				</form>
			
			</div>	
		</div>
	</div>
</div>

@endsection
