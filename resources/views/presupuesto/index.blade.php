@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
      
      <div class="col-md-12">

        <section class="content-header">
          
          <div class="container-fluid">
            
            <div class="row mb-2">
              
              <div class="col-sm-6">
                
                <h1>Presupuestos</h1>
              
              </div>

            </div>
          
          </div>
        
        </section>
        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                
                <h3 class="card-title">Listado de Presupuestos</h3>

                  <div class="card-tools">
                    
                    <div class="input-group input-group-sm" style="width: 250px;">  
                      
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar" id="searchTerm"  onkeyup="doSearch()">

                      <div class="input-group-append">
                        
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      
                      </div>

                    </div>

                  </div>

              </div>

              <div class="card-body table-responsive p-0">
                
                <table class="table table-hover text-nowrap" id="datos">
                  
                  <thead>
                    
                    <tr>                    
                      <th style="text-align:center;">
                      
                          @if (getValueJS(Auth::user()->permisosERP,'presupuestosAdd'))

                              <a href="{{ route('presupuesto.seleccionar') }}" class="btn btn-link" data-toggle="tooltip" title="Generar Presupuesto" data-original-title="Generar Presupuesto"><i class="fas fa-plus"></i></a>
                          
                          @endif
                      
                      </th>
                      
                      <th>Numero</th>
                      <th>Fecha</th>
                      <th>Total</th>
                      <th>Estado</th>                      
                      <th></th>                
                    </tr>
                  
                  </thead>
                  
                  <tbody>
                      @foreach ($presupuestos as $presupuesto)
                      
                    <tr>
                        <td style="text-align:center;">{{$loop->iteration}}</td>
                        <td>{{ $presupuesto->num_comprobante }}</td>
                        <td>{{ $presupuesto->getFromDateAttribute($presupuesto->fecha) }}</td>
                        <td> AR$ {{ $presupuesto->total }} </td>
                        <td> {{ $presupuesto->estado }} </td>
                        <td>
                        @if (getValueJS(Auth::user()->permisosERP,'presupuestosShow'))
                        <a href="{{ route('presupuestos.show', $presupuesto->id) }}" class="btn btn-link" data-toggle="tooltip" title="Ver Presupuesto" data-original-title="Ver Presupuesto"><i class="far fa-eye" style="color:green; font-size: 20px;"></i></a>
                        @endif
                        @if (getValueJS(Auth::user()->permisosERP,'presupuestoReport'))
                        <a href="{{route('presupuesto.imprimir', $presupuesto->id)}}"class="btn btn-link" data-toggle="tooltip" title="Imprimir Comprobante" data-original-title="Imprimir Comprobante"><i class="fas fa-print" style="color:#578DA4; font-size: 20px;"></i></a>
                        @endif
                      </td>
                    </tr>
                      
                      @endforeach
                  </tbody>

                  <tfoot>

                    <tr>
                        <th</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Registros: {{$total}}</th>
                    </tr>
                  
                  </tfoot>
                
                </table>
                
                {{$presupuestos->render()}}
              
              </div>
            
            </div>

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