@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
            <div class="col-md-10">
              <h4>Editar Servicio</h4>
            </div>
            <div class="col-md-2">
                  <a href="{{ route('servicios.index') }}" class="btn btn-primary btn-block">Volver</a>
            </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <br/>
                <form method="post" action="{{ route('servicios.update', $servicio->idServicios)}}">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="form-group">
                    <label for="lbnombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $servicio->nombre }}">
                    @if ($errors->has('nombre'))
                    <small class="form-text text-danger">
                        {{ $errors->first('nombre') }}
                     </small>
                    @endif
                  </div>
                  <div class="form-group">
                    <label>descripcion</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $servicio->descripcion }}">
                  </div>
                  <div class="form-group">
                    <label>Seleccione una Cede</label>
                      <select class="form-control" name="cedes_idCedes" id="cedes_idCedes">
                        <option value="0">Cedes</option> 
                        @foreach ($cedes as $cede)
                          <option value="{{$cede->idCedes}}" @if ($cede->idCedes == $servicio->cedes_idCedes)
                            {{"selected"}}
                          @endif >{{ $cede->nombre }}</option> 
                        @endforeach                        
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Seleccione una Unidad Negocio</label>
                      <select class="form-control" name="unidad_negocio_idUnidad_negocio" id="unidad_negocio_idUnidad_negocio">
                        <option value="0">Unidad Negocios</option> 
                        @foreach ($unidadNegocios as $unidadNegocio)
                          <option value="{{$unidadNegocio->idUnidad_Negocio}}" @if ($unidadNegocio->idUnidad_Negocio == $servicio->unidad_negocio_idUnidad_negocio)
                            {{"selected"}}
                          @endif >{{ $unidadNegocio->nombre }}</option> 
                        @endforeach                        
                      </select>
                  </div>

                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modelId">
                    Agregar Producto
                  </button>
                  <h5>Productos en este servicio</h5>
                  <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                      <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>N° serie</th>
                        <th>estado</th>
                        <th> </th>
                      </tr>
                    </thead>
                    <tbody id="tableProductos">
                    </tbody>
                  </table>
                  <input type="hidden" name="proEnServicios" id="proEnServicios" value="[]">

                  <button type="submit" class="btn btn-primary">Actualizar</button>

                </form>

                @include('servicios.modal')
                
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </div>
@endsection

@section('script')
<script>
 // var arrProEnServicios = JSON.parse( '<?php echo $productosEnServicios ?>' );
  var arrPro = JSON.parse( '<?php echo $productos ?>' );
  console.log(arrPro);
  var arrProductos = JSON.parse( '<?php echo $productosEnServicios ?>' );

  arrPro.forEach(p => {
    arrProductos.forEach(ps => {
      if(p.idProductos == ps.productos_idProductos){
        ps.nombreProducto = p.nombre;
      }      
    });
  });

  generarTablaEInput(arrProductos);

  var productos_idProductos = 0;
  var nombreProducto = "";
  var estado = 0;

  $(document).on('change', '#producto', function(event) {
    productos_idProductos = $(this).val();
    nombreProducto = $('#producto option:selected').text();
  });
  $(document).on('change', '#estado', function(event) {
    estado = $(this).val();
  });
  $(document).on('click','.modalGuardar',function (e) {
    var j = {
      'idProductos_en_servicios':0,
      'productos_idProductos':productos_idProductos,
      'nombreProducto':nombreProducto,
      'estado':estado,
      'numero_serie':$('#numero_serie').val()
    }
    arrProductos.push(j);
    generarTablaEInput(arrProductos);
    $('#producto option').prop('selected', function() {
        return this.defaultSelected;
    });
    $('#estado option').prop('selected', function() {
        return this.defaultSelected;
    });
    $('#numero_serie').val('');
    $('#modelId').modal("hide");
  });

  $(document).on('click','.eliminar',function(e){
    var id = $(this).prop('id');
    var arr = arrProductos.filter((value,index,arr)=>{
      if (value.numero_serie == id) {
        if (value.idProductos_en_servicios == 0) {
          return false;
        }else{
          value.estado = 2;
          return true;
        }
        
      }
      return true;
    });
    generarTablaEInput(arr);
  });


  $(document).on('click','.agregar',function(e){
    var id = $(this).prop('id');
    arrProductos.forEach((value,index,arr)=>{
        if (value.numero_serie == id) {
            value.estado = 1;
        }        
      });
    generarTablaEInput(arrProductos);
  });


  function generarTablaEInput(arr) {
    var tr = '';
    var a = '';
    var b = '';
    
    arr.forEach((element,index) => {

      if(element.estado == 1 || element.estado == 'alquilado')
      {
        a = 'Alquilado';
        b = '<button type="button" class="btn btn-danger eliminar" id="'+element.numero_serie+'">eliminar</button>'
      }
      else{
        a = 'Libre';
        b = '<button type="button" class="btn btn-success agregar" id="'+element.numero_serie+'">agregar</button>';
      }

      tr +='<tr>\
                  <td scope="row">'+(index+1)+'</td>\
                  <td>'+element.nombreProducto+'</td>\
                  <td>'+element.numero_serie+'</td>\
                  <td>'+a+'</td>\
                  <td>'+b+'</td>\
                </tr>';
    });
    $('#tableProductos').html(tr);
    $('#proEnServicios').val(JSON.stringify(arr) );
    arrProductos = arr;
  }
</script>
@endsection
