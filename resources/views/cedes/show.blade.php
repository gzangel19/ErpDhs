@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-10">
                <h4>Detalle de la Cede</h4>
              </div>
              <div class="col-md-2">
                <a href="{{ route('cede.index') }}" class="btn btn-primary btn-block">Volver</a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <br>
                <p><b>Nombre: </b>{{$cede->nombre}}</p>
                <p><b>Domicilio: </b>{{$cede->domicilio}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
