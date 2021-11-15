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

          <!-- Comienza la tabla -->

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Listado de Productos</h3>

                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                      <th>                     
                        <a href="{{ route('productos.create') }}" class="btn btn-primary" data-toggle="tooltip" title="Agregar Producto" data-original-title="Ver Detalle"><i class="fas fa-plus"></i></a>
                        <a href="#" class="btn btn-primary" data-toggle="modal"  data-target="#ModalImportProduct" title="Importar Archivo Excel" data-original-title="Ver Detalle"><i class="fas fa-cloud-upload-alt"></i></a>                   
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="tblSucursales" rowspan="1" colspan="1" style="width: 42px;">Nombre</th>
                      <th class="sorting" tabindex="0" aria-controls="tblSucursales" rowspan="1" colspan="1" style="width: 42px;">Unidad</th>
                      <th class="sorting" tabindex="0" aria-controls="tblSucursales" rowspan="1" colspan="1" aria-label="Dirección: activate to sort column ascending" style="width: 64px;">Logo</th>
                      <th>
                          <a href="{{route('productos.exportar.excel')}}"  class="btn btn-light" data-toggle="tooltip" title="Reporte Excel" data-original-title="Ver Detalle"><img src="{{ asset('img/excel.png') }}" height="20%"/></a>
                          <a href="{{route('pdf.ListadoClientePdf')}}"  class="btn btn-light" data-toggle="tooltip" title="Reporte PDF" data-original-title="Ver Detalle"><img src="{{ asset('img/pdf2.png') }}" height="20%"/></a>
                      </th>
                      </tr>
                    </thead>

                    <tfoot>
                        <tr>
								        <th rowspan="1" colspan="1">Seleccione</th>
                        <th style="display:none;" rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">Razón Social</th>
                        <th rowspan="1" colspan="1">Logo</th>
							          </tr>
                    	</tfoot>
                    <tbody>
                      @foreach ($productos as $producto)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{ $producto->nombre}}</td>
                          <td>{{ $producto->unidades_negocios->nombre }}</td>
                          <td>
                          @if(($producto->imagen != "")) 					              
                     			<img src="{{asset('img/productos/'.$producto->imagen)}}" width="100px" height="100px">
                        		@else
                        		<img src="{{asset('img/logos/imagenNoDisponible.jpg')}}" width="100px" height="100px">
                      			@endif 
								          </td> 
                          <td>
                            <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-success" data-toggle="tooltip" title="Ver Detalle" data-original-title="Ver Detalle" ><i class="far fa-eye"></i></a>
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning" data-toggle="tooltip" title="Editar Producto" data-original-title="Editar Producto"><i class="fas fa-pencil-alt" style="color:white"></i></a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  
                  </table>

                  {{$productos->render()}}
                  
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

        </div>
    </div>
</div>

<!-- Modal Importar Producto-->

<div class="modal fade bd-example-modal-lg" id="ModalImportProduct" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg">
      
      <div class="modal-content">
		      
          <div class="modal-header">
        	  <h5 class="modal-title" id="tituloUpdate">Carga de Productos</h5>

              @if(Session::has('error'))

                <p class="text-danger">{{Session::get('error')}}</p>

              @endif

              @if(Session::has('message'))

                <p class="text-info">{{Session::get('message')}}</p>
              
              @endif

     	    </div>
          
          <div class="modal-body">

          <p>Presione <a href="{{ route('productos.download') }}">Aqui</a> para descargar la plantilla a completar</p>
          
          <p>Antes de realizar la carga es importante que:</p>	
          <p>1) No deje Columnas Vacias</p>	 
	        <p>2) Borrar la fila de Encabesado</p>	 
            <div class="card-body table-responsive p-0">
            
              <form action="{{route('productos.importar.excel')}}" method="post" enctype="multipart/form-data">
                    
                    @csrf
                                 
                <div class="row">

                    <div class="col-xs-24 col-sm-24 col-md-12 col-lg-12 col-xl-12">
                      
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="file" class="form-control" name="file">
                      </div>

                    </div>
                  
                </div>

                <div class="row">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                 
                      <button type="submit" class="btn btn-primary"><i class="fas fa-cloud-upload-alt"></i></button>
                      </div>

                    </div>

                </div>

              </form>  
                  
            </div>

            <div class="modal-footer">
                <div class="form-group">
                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i></button>
                </div>
             </div>

          </div>

      </div>

    </div>
    
</div>

<!-- FIN Modal Importar-->	

@endsection