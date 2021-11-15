@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Usuarios</h1>
                </div>

              </div>
            </div><!-- /.container-fluid -->
          </section>



          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Agregar Usuario</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="{{ route('usuarios.store')}}" role="form">
                {{ csrf_field() }}

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="nombre" name="nombre" required>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Apellido</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="apellido" name="apellido" required>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Usuario</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="username" name="username" required>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Contrase&ntilde;a</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="password" name="password" required>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>E-mail</label>
                      <input type="mail" class="form-control" placeholder="Enter ..." id="email" name="email" required>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Tipo</label>
                        <select name="tipo" id="tipo" class="form-control">
                          <option value="vendedor">Vendedor</option>
                          <option value="usuario">Usuario</option>
                          <option value="admin">Administrador</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Permisos</label>
                      <select name="rol" id="rol" class="form-control" required>
                        <option value="0">Seleccione un Rol</option>
                        @foreach ($roles as $rol)
                          <option value="{{ $rol->id }}" >{{ $rol->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                </div>

                <hr>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <label for="">Precione Ctrl + clic para seleccionar varias Unidad de Negocios</label>
                      <select multiple class="custom-select" name="unidadnegocio_id[]" id="unidadnegocio_id" required>
                        {{-- <option>Unidad de Negocio</option> --}}
                        @foreach ($unidadNegocios as $u)
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
