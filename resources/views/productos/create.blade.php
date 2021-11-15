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
              <form method="post" action="{{ url('productos/store') }}" role="form" enctype="multipart/form-data">
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
                      <input type="text" class="form-control" placeholder="Enter ..." id="codigo" name="codigo" readonly>
                    </div>
                  </div>

                </div>

                <div class="row">

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Precio Local</label>
                        <input type="text" class="form-control" placeholder="Enter ..." id="p_local_1p" name="p_local_1p">
                      </div>
                  </div>    
                      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Precio Local B</label>
                        <input type="text" class="form-control" placeholder="Enter ..." id="p_local_2p" name="p_local_2p">
                      </div>
                    </div>
                
                </div>

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Precio Eccomerce</label>
                        <input type="text" class="form-control" placeholder="Enter ..." id="p_e" name="p_e">
                      </div>
                    </div>

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Moneda</label>
                        <select class="form-control select2" style="width: 100%;" id="moneda" name="moneda">
                          <option value="Dolares">Dolares</option>
                          <option value="Pesos">Pesos</option>
                        </select>
                      </div>
                  </div>    
                      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Categorias</label>
                        <select class="form-control select2" style="width: 100%;" id="categoria_id" name="categoria_id">
                          @foreach($categorias as $u)
                          <option value="{{$u->id}}">{{$u->nombre}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                          <label>Unidad de Negocio</label>
                          <input type="text" class="form-control" placeholder="Enter ..." id="unidad" name="unidad"  value="{{$unidades->nombre}}" readonly>
                          <input type="hidden" class="form-control" placeholder="Enter ..." id="unidad_negocio_idUnidad_negocio" name="unidad_negocio_idUnidad_negocio" value="{{$unidades->id}}">
                        </div>
                    </div>
                      
                </div>

                <div class="row">

                  <div class="col-xs-24 col-sm-24 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <label>Descripcion</label>
                      <textarea class="form-control" rows="3" id="descripcion" name="descripcion" required></textarea>
                    </div>
                  </div>

                </div>
                
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-success">Agregar </button>
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
