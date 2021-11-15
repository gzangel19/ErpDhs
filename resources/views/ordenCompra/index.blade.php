@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Ordenes de Compra</h1>
                </div>

              </div>
            </div><!-- /.container-fluid -->
          </section>

          <!-- Comienza la tabla -->

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Listado de Ordenes de Compra</h3>

                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar" id="searchTerm"  onkeyup="doSearch()">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap" id="datos">
                    <thead>
                      <tr>
                        <th style="text-align:center;"><a href="{{ route('ordenCompra.create') }}" class="btn btn-link" data-toggle="tooltip" title="Crear Orden de Pago" data-original-title="Ver Detalle"><i class="fas fa-plus"></i></a></th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Total </th>
                        <th>Estado </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($ordenes as $orden)
                        <tr>
                          <td style="text-align:center;">{{$loop->iteration}}</td>
                          <td>{{ $orden->fecha }}</td>
                          <td>{{ $orden->proveedor->nombre }}</td>
                          <td>{{ $orden->total }}</td>
                          <td>{{ $orden->estado }}</td>
                          
                          <td>
                            <a href="{{ route('ordenCompra.show', $orden->id) }}" class="btn btn-link" data-toggle="tooltip" title="Ver Detalle Producto" data-original-title="Ver Orden"><i class="far fa-eye" style="color:green; font-size: 20px;"></i></a>
                            <a href="{{ route('ordenCompra.downloadComprobante', $orden->id) }}" class="btn btn-link" data-toggle="tooltip" title="Imprimir Orden de Compra" data-original-title="Imprimir Orden de Compra"><i class="fas fa-print" style="color:#61195A; font-size: 20px;"></i></a>
                            <a href="{{ route('ordenCompra.downloadComprobantePago', $orden->id) }}" class="btn btn-link" data-toggle="tooltip" title="Imprimir Orden de Pago" data-original-title="Imprimir Orden de Pago"><i class="fas fa-hand-holding-usd" style="color:blue; font-size: 20px;"></i></a>
                          </td>

                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{$ordenes->render()}}
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

        </div>
    </div>
</div>
@endsection


@push ('scripts')
<script>
function doSearch(){
            const tableReg = document.getElementById('datos');
            const searchText = document.getElementById('searchTerm').value.toLowerCase();
            let total = 0;
 
            // Recorremos todas las filas con contenido de la tabla
            for (let i = 1; i < tableReg.rows.length; i++) {
                // Si el td tiene la clase "noSearch" no se busca en su cntenido
                if (tableReg.rows[i].classList.contains("noSearch")) {
                    continue;
                }
 
                let found = false;
                const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
                // Recorremos todas las celdas
                for (let j = 0; j < cellsOfRow.length && !found; j++) {
                    const compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                    // Buscamos el texto en el contenido de la celda
                    if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {
                        found = true;
                        total++;
                    }
                }
                if (found) {
                    tableReg.rows[i].style.display = '';
                } else {
                    // si no ha encontrado ninguna coincidencia, esconde la
                    // fila de la tabla
                    tableReg.rows[i].style.display = 'none';
                }
            }
 
            // mostramos las coincidencias
            const lastTR=tableReg.rows[tableReg.rows.length-1];
            const td=lastTR.querySelector("td");
            lastTR.classList.remove("hide", "red");
            if (searchText == "") {
                lastTR.classList.add("hide");
            }
    }

  </script>
@endpush