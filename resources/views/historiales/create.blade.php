@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Productos</h1>
                </div>

              </div>
            </div><!-- /.container-fluid -->
          </section>



          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Agregar Producto</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="{{ route('productos.store')}}" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="nombre" name="nombre">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Codigo</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="codigo" name="codigo">
                    </div>
                  </div>
                </div>

                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Descripcion</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="descripcion" name="descripcion">
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Imagen</label>
                      <input type="file" class="form-control" placeholder="Enter ..." id="img" name="img">
                    </div>
                  </div>                 
                </div>

                                
                 <div class="card card-secondary">
                  <div class="card-header">
                   <h3 class="card-title">Moneda</h3>
                   </div>
                 </div>

                 <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Seleccione Moneda de Venta:</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="Answer_1" id="Answer_1a" value="Pesos" onclick="obtenerMoneda();">
                      <label class="form-check-label" for="inlineRadio1">Pesos </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="Answer_1" id="Answer_1b" value="Dolares" onclick="obtenerMoneda();">
                      <label class="form-check-label" for="inlineRadio2">Dolares </label>
                    </div>
                  </div>
                </div>

                <br>

                 <div class="card card-secondary">
                  <div class="card-header">
                   <h3 class="card-title">Costos</h3>
                   </div>
                 </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Costo en Pesos</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="costo_p" name="costo_p" value="0">
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label> % costo del Flete en Pesos</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_flete_p" name="p_flete_p" value="0">
                    </div>
                  </div>

                  </div>

                  <div class="row">

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Costo en Dolares</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="costo_d" name="costo_d" value="0">
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>% costo del Flete en Dolares</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_flete_d" name="p_flete_d" value="0">
                    </div>
                  </div>
                </div>



                <div class="card card-secondary">
                  <div class="card-header">
                   <h3 class="card-title">Porcentajes</h3>
                   </div>
                 </div>

                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label> % precio Local Lista en Pesos</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_local_1p" name="p_local_1p" value="0">
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" value="0">
                    <div class="form-group">
                      <label>% precio Local Lista B en Pesos</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_local_2p" name="p_local_2p" value="0">
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>% precio Ecommerce en Pesos</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_ec_p" name="p_ec_p" value="0">
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label> % precio Mercado Libre en Pesos</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_ml_p" name="p_ml_p" value="0">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label> % precio Local Lista en Dolares</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_local_1d" name="p_local_1d" value="0">
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label> % precio Local Lista B en Dolares</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_local_2d" name="p_local_2d" value="0">
                    </div>
                  </div>
                </div>
                <div class="card card-secondary">
                  <div class="card-header">
                   <h3 class="card-title">Unidad de Negocios</h3>
                   </div>
                 </div>
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <select class="form-control select2" style="width: 100%;" id="unidad_negocio_idUnidad_negocio" name="unidad_negocio_idUnidad_negocio">
                        <option value="0">Seleccione una Unidad</option>
                        @foreach($unidadesnegocio as $u)
                        <option value="{{$u->id}}">{{$u->nombre}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Agregar  <i class="fas fa-save" style="color:#E8EE10"></i> </button>
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

  function obtenerMoneda(){

        var Answer_1_data = $('input[name="Answer_1"]:checked').val();
        if(Answer_1_data){
               if(Answer_1_data=="Pesos"){
                document.getElementById('costo_d').style.display = "none";
                document.getElementById('p_flete_d').style.display = "none";
                document.getElementById('p_local_1d').style.display = "none";
                document.getElementById('p_local_2d').style.display = "none";

                document.getElementById('costo_P').style.display = "block";
                document.getElementById('p_flete_P').style.display = "block";
                document.getElementById('p_local_1P').style.display = "block";
                document.getElementById('p_local_2P').style.display = "block";
                document.getElementById('p_ec_P').style.display = "block";
                document.getElementById('p_ml_P').style.display = "block";

               }
               else{
                document.getElementById('costo_d').style.display = "block";
                document.getElementById('p_flete_d').style.display = "block";
                document.getElementById('p_local_1d').style.display = "block";
                document.getElementById('p_local_2d').style.display = "block";

                document.getElementById('costo_P').style.display = "none";
                document.getElementById('p_flete_P').style.display = "none";
                document.getElementById('p_local_1P').style.display = "none";
                document.getElementById('p_local_2P').style.display = "none";
                document.getElementById('p_ec_P').style.display = "none";
                document.getElementById('p_ml_P').style.display = "none";
               }
               
        }


  }
</script>
@endpush
