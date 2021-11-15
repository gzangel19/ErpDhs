@extends('layouts.app')
@section('content')
@php
    $s = '';
@endphp
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
            <div class="col-md-10">
              <h4>Editar Proveedor</h4>
            </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <br/>
                <form method="post" action="{{ route('proveedores.update', $proveedor->id)}}"  enctype="multipart/form-data">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="nombre" name="nombre" value="{{$proveedor->nombre}}">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Razon Social</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="razonSocial" name="razonSocial" value="{{$proveedor->razon_Social}}">
                    </div>
                  </div>
                </div>

                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Dato Bancario</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="datoBancario" name="datoBancario"  value="{{$proveedor->datoBancario}}">
                    </div>
                    </div>    
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Logo</label>
                      <input type="file" class="form-control" placeholder="Enter ..." id="img" name="img">
                    </div>       
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>CUIT / CUIL</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="cuit_cuil" name="cuit_cuil"  value="{{$proveedor->cuit_cuil}}">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Tel&eacute;fonos</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="telefonos" name="telefonos"  value="{{$proveedor->telefonos}}">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>E-mail</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="email" name="email"  value="{{$proveedor->email}}">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Rubro</label>
                      <select class="form-control select2" style="width: 100%;" id="rubro_id" name="rubro_id">
                        <option  value="{{$proveedor->rubro->id}}">{{$proveedor->rubro->nombre}}</option>
                        @foreach($rubros as $rubro)
                        <option value="{{$rubro->id}}">{{$rubro->nombre}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Direcci&oacute;n</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="direccion" name="direccion"  value="{{$proveedor->direccion}}">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>C.P.</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="codigo_postal" name="codigo_postal"  value="{{$proveedor->codigo_postal}}">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Ciudad</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="ciudad" name="ciudad"  value="{{$proveedor->ciudad}}">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Provincia</label>
                      <select class="form-control select2" style="width: 100%;" id="provincia_id" name="provincia_id">
                        <option value="{{$proveedor->provincia->id}}">Seleccione una Provincia</option>
                        @foreach($provincias as $provincia)
                        <option value="{{$provincia->id}}">{{$provincia->nombre}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group d-flex">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label for="">Precione Ctrl + clic para seleccionar varias Unidad de Negocios</label>
                    <select multiple class="custom-select" name="unidadnegocio_id[]" id="unidadnegocio_id">
                      {{-- <option>Unidad de Negocio</option> --}}
                      @foreach ($unidadesnegocio as $u)
                    <option value="{{$u->id}}">{{$u->nombre}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-warning">Actualizar</button>
                      <a href="{{ route('proveedores.index') }}"> <button type="button" class="btn btn-danger">Volver</button> </a> 
                    </div>
                  </div>
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
