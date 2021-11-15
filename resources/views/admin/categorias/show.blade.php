@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Producto</h1>
                </div>

              </div>
            </div><!-- /.container-fluid -->
          </section>



          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Detalle de Producto</h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">

              <div class="row">
                <div class="col-md-12">
                  <br>
                  <p><b>Nombre </b>{{$producto->nombre}}</p>
                  <p><b>Descripcion </b>{{$producto->descripcion}}</p>
                  <p><b>Unidad de Negocio </b>{{$producto->unidades_negocios->nombre}}</p>
                  <p><b>Precio Lista en Pesos </b>{{( $producto->costo_p  +  ($producto->costo_p * $producto->p_flete_p )) *  $producto->p_local_1p }} </p>
                  <p><b>Precio Lista B en Pesos </b>{{( $producto->costo_p  +  ($producto->costo_p * $producto->p_flete_p )) *  $producto->p_local_2p }} </p>
                  <p><b>Precio Mercado Libre </b>{{( $producto->costo_p  +  ($producto->costo_p * $producto->p_flete_p )) *  $producto->p_ml_p }} </p>
                  <p><b>Precio E-Commerce </b>{{( $producto->costo_p  +  ($producto->costo_p * $producto->p_flete_p )) *  $producto->p_ec_p }} </p>
                  <p><b>Precio Lista B en Dolares </b>{{( $producto->costo_d  +  ($producto->costo_d * $producto->p_flete_d )) *  $producto->p_local_1d }} </p>
                  <p><b>Precio Lista en Dolares</b>{{( $producto->costo_d  +  ($producto->costo_d * $producto->p_flete_d )) *  $producto->p_local_2d }} </p>
                  <br>
                  <div class="form-group">
        						<a class="btn btn-primary" href="{{ route('productos.index')}}" role="button">Volver</a>
        					</div>
                </div>
              </div>
            </div>
          </div>


        </div>
    </div>
</div>
@endsection
