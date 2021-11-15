@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
            <div class="col-md-10">
              <h4>Editar Cede</h4>
            </div>
            <div class="col-md-2">
                  <a href="{{ route('cede.index') }}" class="btn btn-primary btn-block">Volver</a>
            </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <br/>
                <form method="post" action="{{ route('cede.update', $cede->idCedes)}}">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="form-group">
                    <label for="lbnombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $cede->nombre }}">
                    @if ($errors->has('nombre'))
                    <small class="form-text text-danger">
                        {{ $errors->first('nombre') }}
                     </small>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="lbdomicilio">Domicilio</label>
                    <input type="text" class="form-control" id="domicilio" name="domicilio" value="{{ $cede->domicilio }}">
                  </div>
                  <div class="form-group">
                    <label>Seleccione un Cliente</label>
                      <select class="form-control" name="clientes_idClientes" id="clientes_idClientes">
                        <option value="0">Clientes</option> 
                        @foreach ($clientes as $cliente)
                          <option value="{{$cliente->idClientes}}" @if ($cliente->idClientes == $cede->clientes_idClientes)
                            {{"selected"}}
                          @endif>{{ $cliente->apellido }}, {{ $cliente->nombre }}</option> 
                        @endforeach                        
                      </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
