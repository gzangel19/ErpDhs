@extends('layouts.app')
@section('content')

<div class="container">
  
  <div class="row justify-content-center">
    
    <div class="col-md-12">
    
      <section class="content-header">
        
        <div class="container-fluid">
          
          <div class="row mb-2">
            
            <div class="col-sm-6">

              <h1> Maquinarias </h1>

            </div>

          </div>
        
        </div>
      
      </section>

    <div class="card card-secondary">
      
      <div class="card-header">
          
          <h3 class="card-title"> Agregar Maquinaria </h3>
      
      </div>

      <div class="card-body">
              
        <form method="post" action="{{ route('maquinarias.store')}}" role="form">
                  
          {{ csrf_field() }}
          
          <div class="row">
            
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
              
              <div class="form-group">
                
                <label> Cliente </label>
                
                <select class="form-control select2" style="width: 100%;" id="cliente_id" name="cliente_id">
                  
                  <option value="0">Ninguno</option>
                  @foreach($clientes as $cliente)
                  <option value="{{$cliente->id}}">{{$cliente->razon_Social}}</option>
                  @endforeach

                </select>
            
              </div>
            

            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                
                <div class="form-group">
                    
                    <label>Modelo</label>
                    
                    <input type="text" class="form-control" placeholder="Enter ..." id="modelo" name="modelo" required>
                </div>
                
            </div>
          
          </div>

          <div class="row">
            
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                
                <div class="form-group">
                    
                    <label>Nº de Serie</label>
                      
                    <input type="text" class="form-control" placeholder="Enter ..." id="numeroSerie" name="numeroSerie" required>
                </div>
            
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

              <div class="form-group">
                    
                    <label> Ubicacion </label>
                    
                    <input type="text" class="form-control" placeholder="Enter ..." id="ubicacion" name="ubicacion" value="En Deposito" required>
                  
                  </div>
            
              </div>

          </div>

          <div class="row">
            
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                
                <div class="form-group">
                  
                  <label>Estado</label>
                  
                    <select class="form-control select2" style="width: 100%;" id="estado" name="estado">
                  
                        <option value="Libre"> Libre</option>

                        <option value="Alquilado">Alquilado</option>

                        <option value="Vendido"> Vendido </option>

                        <option value="Tercero"> Tercero </option>


                    </select>
                
                </div>
                
            </div>
            
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  
                    <div class="form-group">
                      
                      <label>Tipo </label>
                      
                        <select class="form-control select2" style="width: 100%;" id="tipo" name="tipo">
                      
                            <option value="Color"> Color </option>

                            <option value="Blanco/Negro"> Blanco / Negro</option>

                        </select>
                    
                    </div>
            
            </div>

          </div>
          
          <div class="row">
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              
              <div class="form-group">
                
                <button type="submit" class="btn btn-primary"> Agregar  </button>
                
                <a class="btn btn-danger" href="{{route('maquinarias.index')}}" role="button">Volver</a>
              
              </div>
            
            </div>
          
          </div>

        </form>
            </div>
            <!-- /.card-body -->
          </div>


        </div>
    </div>
</div>
@endsection


@push ('scripts')
  
<script>

$( function() {
    $("#cuentaCorriente").change( function() {
        if ($(this).val() === "No") {
            $("#montoCuenta").prop("disabled", true);
            $("#montoCuentaPesos").prop("disabled", true);
        } else {
            $("#montoCuenta").prop("disabled", false);
            $("#montoCuentaPesos").prop("disabled", false);
        }
    });
})

</script>
@endpush