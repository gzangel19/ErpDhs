@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Ingresos</h1>
                </div>

              </div>
            </div><!-- /.container-fluid -->
          </section>

          <!-- Comienza la tabla -->

          <div class="row">
            <div class="col-12">
              <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Listado de Ingresos</h3>

                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" id="searchTerm"  class="form-control float-right" placeholder="Buscar" onkeyup="doSearch()">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default" type="text" ><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap" id="datos">
                    <thead>
                      <tr>
                          <th>&nbsp;</th>
                          <th>Proveedor</th>
                          <th>Nº Compra</th>
                          <th>Deposito</th>
                          <th>Fecha</th>
                          <th>Total</th>
                        <th>
                          <a href="{{ route('compras.create') }}" class="btn btn-primary" data-toggle="tooltip" title="Nuevo Ingreso" data-original-title="Ver Detalle"><i class="fas fa-plus"></i></a>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($compras as $compra)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $compra->proveedor->nombre}}</td>  
                    <td>{{ $compra->num_compra }}</td>                 
                    <td>{{ $compra->deposito->nombre }}</td>
                    <td>{{ $compra->fecha}}</td>
                    @if($compra->tipo == 'Pesos')
                    <td> AR$ {{ $compra->total }} </td>
                    @else
                    <td> USD {{ $compra->total }} </td>
                    @endif

                    <td>
                     <a href="{{ route('compras.show', $compra->id) }}"  class="btn btn-success" data-toggle="tooltip" title="Ver Detalle" data-original-title="Ver Detalle"><i class="far fa-eye"></i></a>
                     <a href="{{ route('pdf.imprimirRemito', $compra->id) }}" class="btn btn-dark" data-toggle="tooltip" title="Imprimir" data-original-title="Ver Detalle"><i class="fas fa-print"></i></a>
                    </td>

                        </tr>
                      @endforeach
                    </tbody>
                  </table>
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