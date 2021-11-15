@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                </div>

              </div>
            </div><!-- /.container-fluid -->
          </section>



          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Editar Perfil</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <form method="post" action="{{ route('usuarios.updatePerfil')}}" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="nombre" name="nombre" value="{{ $usuario->nombre }}">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Apellido</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="apellido" name="apellido" value="{{ $usuario->apellido }}">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Usuario</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="username" name="username" value="{{ $usuario->username }}">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>E-mail</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="email" name="email" value="{{ $usuario->email }}">
                    </div>
                  </div>
                </div>

                <div class="row">
                  
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Imagen</label>
                      <input type="file" class="form-control" placeholder="Enter ..." id="img" name="img" value="{{ $usuario->imagen_perfil }}">
                    </div>
                  </div>

                  <div class="form-group">
                      @if(($usuario->imagen_perfil != ""))               
                      <img src="{{asset('img/perfil/'.$usuario->imagen_perfil)}}" style=" width: 150px; height: 150px;">
                        @else
                        <img src="{{asset('img/perfil/imagenNoDisponible.jpg')}}" style=" width: 150px; height: 150px;">
                      @endif

                  </div>
                
                </div>
                

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                    <div class="form-group">
                      <button type="submit" class="btn btn-success btn-block">Actualizar</button>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                        <a href="{{route('home')}}" class="btn btn-primary btn-block">Volver</a>
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