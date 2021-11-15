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
              <h3 class="card-title">Editar Producto Cotizado</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="{{ route('productoCotizado.modificar',$producto->id)}}" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="row">
                  
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Detalle</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="nombre" name="nombre" value="{{$producto->nombre}}">
                    </div>
                  </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
	
                        <div class="form-group">

                            <label>Imagen</label>

                            <input type="file" class="form-control" id="imagen" name = "imagen">
                        
                        </div>

                    </div>

                  <div class="col-xs-24 col-sm-24 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <label>Descripcion</label>
                      <textarea class="form-control" rows="3" id="descripcion" name="descripcion">{{$producto->descripcion}}</textarea>
                    </div>
                  </div>
                  

                </div>

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Beneficio</label>
                        <input type="text" class="form-control" placeholder="Enter ..." id="beneficio" name="beneficio" value="{{$producto->beneficio}}">
                      </div>
                  </div> 

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Precio Publico</label>
                        <input type="text" class="form-control" placeholder="Enter ..." id="precioFinal" name="precioFinal" value="{{$producto->precioLocal}}">
                      </div>
                  </div>    

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Unidad de Negocio</label>
                        <select class="form-control select2" style="width: 100%;" id="unidad_id" name="unidad_id">
                            <option value="{{$producto->unidades_negocios->id}}">{{$producto->unidades_negocios->nombre}}</option>
                            <option value="4">Munay</option>
                            <option value="5">Tu Cartel</option>
                        </select>
                      </div>
                  </div> 
                
                </div>
                
                <div class="row">

                     

                </div>      

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-success">Actualizar <i class="fas fa-pencil-alt" style="color:#E8EE10"></i></button>
                      <a class="btn btn-danger" href="{{ route('cotizaciones.index')}}" role="button">Cancelar <i class="fas fa-arrow-alt-circle-left" style="color:#E8EE10"></i></a>
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
