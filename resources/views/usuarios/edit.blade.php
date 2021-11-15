@extends('layouts.app')
@section('content')
@php
    $s = '';

@endphp
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
            <div class="col-md-10">
              <h4>Actualizar Usuario</h4>
            </div>
            <div class="col-md-2">
                  <a href="{{ route('usuarios.index') }}" class="btn btn-primary btn-block">Volver</a>
            </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <br/>
                <form method="post" action="{{ route('usuarios.update', $usuario->id)}}">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="form-group d-flex">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label>Nombre y Apellido:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $usuario->nombre }}">
                        @if ($errors->has('name'))
                        <small class="form-text text-danger">
                            {{ $errors->first('name') }}
                         </small>
                        @endif
                    </div>

                  </div>
                  <div class="form-group d-flex">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                      <label>Correo:</label>
                      <input type="text" class="form-control" id="email" name="email" value="{{ $usuario->email }}">
                      @if ($errors->has('email'))
                      <small class="form-text text-danger">
                          {{ $errors->first('email') }}
                       </small>
                      @endif
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                      <label>Contraseña</label>
                      <input type="text" class="form-control" id="password" name="password">
                      @if ($errors->has('password'))
                      <small class="form-text text-danger">
                          {{ $errors->first('password') }}
                       </small>
                      @endif
                    </div>
                  </div>

                  <hr> {{-- fin de usuario --}}

                  <div class="form-group d-flex">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <label>Rol de Usuario:</label>
                      <select name="rol" id="rol" class="form-control">
                        <option value="0">Seleccione un Rol</option>
                        @foreach ($roles as $rol)
                          <option value="{{ $rol->id }}" @if ((isset($role_user)) && $rol->id == $role_user->role_id)
                            {{ "selected" }}
                          @endif>{{ $rol->name }}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('rol'))
                      <small class="form-text text-danger">
                          {{ $errors->first('rol') }}
                       </small>
                      @endif
                    </div>
                  </div>

                  <hr>

                  <div class="form-group d-flex">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <label for="">Precione Ctrl + clic para seleccionar varias Unidad de Negocios</label>
                      <select multiple class="custom-select" name="idUnidad_Negocio[]" id="idUnidad_Negocio">
                        @foreach ($unidadNegocios as $u)
                          @foreach ($userUnidadNegocios as $urs)
                            @if ($u->idUnidad_Negocio == $urs->idUnidad_Negocio)                          
                            @php
                                $s = "selected";
                            @endphp
                            @endif 
                          @endforeach
                          <option value="{{$u->idUnidad_Negocio}}" {{$s}}>{{$u->nombre}}</option>
                          @php
                           $s = "";
                          @endphp
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-2 float-right">
                    <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection