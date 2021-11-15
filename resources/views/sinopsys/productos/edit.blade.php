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
                    </div>
                  </div>
                  
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Codigo</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="codigo" name="codigo" value="{{$producto->codigo}}">
                    </div>
                  </div>

                </div>

                <div class="row">

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Precio A</label>
                        <input type="text" class="form-control" placeholder="Enter ..." id="p_local_1p" name="p_local_1p" value="{{$producto->precioLocal}}">
                      </div>
                  </div>    
                  
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Precio B</label>
                        <input type="text" class="form-control" placeholder="Enter ..." id="p_local_2p" name="p_local_2p" value="{{$producto->precioLocalB}}">
                      </div>
                    </div>
                
                </div>

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Precio E</label>
                        <input type="text" class="form-control" placeholder="Enter ..." id="p_e" name="p_e" value="{{$producto->precioEccomerce}}">
                      </div>
                    </div>

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Moneda</label>
                        <select class="form-control select2" style="width: 100%;" id="moneda" name="moneda">
                        <option value="{{$producto->moneda}}">{{$producto->moneda}}</option>
                        <option value="Dolares">Dolares</option>
                        <option value="Pesos">Pesos</option>
                        </select>
                      </div>
                  </div>    

                      
                </div>

                <div class="row">

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Categorias</label>
                        <select class="form-control select2" style="width: 100%;" id="categoria_id" name="categoria_id">
                          <option value="{{$producto->categoria->id}}">{{$producto->categoria->nombre}}</option>
                          @foreach($marcas as $u)
                          <option value="{{$u->id}}">{{$u->nombre}}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Unidad de Negocio</label>
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

                  <div class="col-xs-24 col-sm-24 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <label>Imagen</label>
                      <input type="file" class="form-control" name="img">
                    </div>
                  </div>

                </div>

                <div class="row">

                  <div class="col-xs-24 col-sm-24 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <label>Descripcion</label>
                      <textarea class="form-control" rows="3" id="descripcion" name="descripcion">{{$producto->descripcion}}</textarea>
                    </div>
                  </div>

                </div>
                
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-success">Actualizar <i class="fas fa-pencil-alt" style="color:#E8EE10"></i></button>
                      <a class="btn btn-danger" href="{{ route('productos.index',$producto->unidadnegocio_id)}}" role="button">Cancelar <i class="fas fa-arrow-alt-circle-left" style="color:#E8EE10"></i></a>
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
