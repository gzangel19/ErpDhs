@extends('layouts.app')
@section('content')
@php
    $s = '';
@endphp
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
              <h3 class="card-title">Editar Producto</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="{{ route('productos.update',$producto->id)}}" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="nombre" name="nombre" value="{{$producto->nombre}}">
                       @if ($errors->has('nombre'))
                       <small class="form-text text-danger">
                        {{ $errors->first('nombre') }}
                     </small>
                    @endif
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Codigo</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="codigo" name="codigo" value="{{$producto->codigo}}">
                        @if ($errors->has('codigo'))
                         <small class="form-text text-danger">
                        {{ $errors->first('codigo') }}
                        </small>
                         @endif
                    </div>
                  </div>
                </div>

                <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Descripcion</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="descripcion" name="descripcion" value="{{$producto->descripcion}}">
                        @if ($errors->has('descripcion'))
                         <small class="form-text text-danger">
                        {{ $errors->first('descripcion') }}
                        </small>
                         @endif
                    </div>

                    <div class="form-group">
                      <label>Imagen</label>
                      <input type="file" class="form-control" placeholder="Enter ..." id="img" name="img" value="{{$producto->imagen}}">
                    </div>

                    
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                    <div class="form-group">
                      @if(($producto->imagen != ""))               
                      <img src="{{asset('img/productos/'.$producto->imagen)}}" style=" width: 150px; height: 150px;">
                        @else
                        <img src="{{asset('img/productos/imagenNoDisponible.jpg')}}" style=" width: 150px; height: 150px;">
                      @endif

                    </div>
                  </div>   
                                 
                </div>

                 <div class="card card-secondary">
                  <div class="card-header">
                   <h3 class="card-title">Costos</h3>
                   </div>
                 </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Costo en Pesos</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="costo_p" name="costo_p" value="{{$producto->costo_p}}">
                      @if ($errors->has('costo_p'))
                         <small class="form-text text-danger">
                        {{ $errors->first('costo_p') }}
                        </small>
                         @endif
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Costo en Dolares</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_flete_p" name="costo_d" value="{{$producto->costo_d}}">
                      @if ($errors->has('costo_d'))
                         <small class="form-text text-danger">
                        {{ $errors->first('costo_d') }}
                        </small>
                         @endif
                    </div>
                  </div>
                </div>

                <div class="card card-secondary">
                  <div class="card-header">
                   <h3 class="card-title">Porcentajes</h3>
                   </div>
                 </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label> % costo del Flete en Pesos</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_flete_p" name="p_flete_p" value="{{$producto->p_flete_p}}">
                      @if ($errors->has('p_flete_p'))
                         <small class="form-text text-danger">
                        {{ $errors->first('costo_p') }}
                        </small>
                         @endif
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>% costo del Flete en Dolares</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_flete_d" name="p_flete_d" value="{{$producto->p_flete_d}}">
                        @if ($errors->has('p_flete_d'))
                         <small class="form-text text-danger">
                        {{ $errors->first('p_flete_d') }}
                        </small>
                         @endif
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label> % precio Local Mayorista en Pesos</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_local_1p" name="p_local_1p" value="{{$producto->p_local_1p}}" >
                      @if ($errors->has('p_local_1p'))
                         <small class="form-text text-danger">
                        {{ $errors->first('p_local_1p') }}
                        </small>
                         @endif
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>% precio Local Minorista en Pesos</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_local_2p" name="p_local_2p" value="{{$producto->p_local_2p}}">
                        @if ($errors->has('p_local_2p'))
                         <small class="form-text text-danger">
                        {{ $errors->first('p_local_2p') }}
                        </small>
                         @endif
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>% precio Ecommerce en Pesos</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_ml_p" name="p_ec_p" value="{{$producto->p_ec_p}}">
                      @if ($errors->has('p_ml_p'))
                         <small class="form-text text-danger">
                        {{ $errors->first('p_ml_p') }}
                        </small>
                         @endif
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label> % precio Mercado Libre en Pesos</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_ml_p" name="p_ml_p" value="{{$producto->p_ml_p}}">
                        @if ($errors->has('p_ml_p'))
                         <small class="form-text text-danger">
                        {{ $errors->first('p_ml_p') }}
                        </small>
                         @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label> % precio Local Mayorista en Dolares</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_local_1d" name="p_local_1d" value="{{$producto->p_local_1d}}">
                        @if ($errors->has('p_local_1d'))
                         <small class="form-text text-danger">
                        {{ $errors->first('p_local_1d') }}
                        </small>
                         @endif
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label> % precio Local Minorista en Dolares</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="p_local_2d" name="p_local_2d" value="{{$producto->p_local_2d}}">
                      @if ($errors->has('p_local_2d'))
                         <small class="form-text text-danger">
                        {{ $errors->first('p_local_2d') }}
                        </small>
                         @endif
                    </div>
                  </div>
                </div>
                <div class="card card-secondary">
                  <div class="card-header">
                   <h3 class="card-title">Unidad de Negocio</h3>
                   </div>
                 </div>
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <select class="form-control select2" style="width: 100%;" id="unidad_negocio_idUnidad_negocio" name="unidad_negocio_idUnidad_negocio">
                        <option value="{{$producto->unidades_negocios->id}}">{{$producto->unidades_negocios->nombre}}</option>
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
                      <button type="submit" class="btn btn-primary">Agregar</button>
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
