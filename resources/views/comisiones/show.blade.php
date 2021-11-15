@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
      
      <div class="col-md-12">

        <section class="content-header">
          
          <div class="container-fluid">
            
            <div class="row mb-2">
              
              <div class="col-sm-6">

                <h1>Detalle Comision</h1>

                <p> <h5>Fecha Desde: <b>{{$searchText}} </b> &nbsp; &nbsp;   Fecha Hasta: <b>{{$ultimo}};</b> <h5></p>

                <p> <h5>Vendedor: <b>{{$vendedor->apellido}} {{$vendedor->nombre}} </b> &nbsp; &nbsp;   Mes: <b>{{date("m", $fechaComoEntero)}}/{{date("Y", $fechaComoEntero)}}</b> <h5></p>
                
                @if($totalVendido->totalPesos)
                <p> <h5> Total Vendido: <b>AR$ {{number_format( $totalVendido->totalPesos, 2 , ',' , '.')}} </b> <h5> </p>
                @else
                <p> <h5> Total Vendido: <b>AR$ 0</b> <h5> </p>
                @endif
                <p> <h5> Porcentaje Ventas: <b>AR$ {{number_format( $porcentaje, 2 , ',' , '.')}} </b> <h5> </p>

                <p> <h5> Nº Bonus: <b> {{$numero}} </b> <h5> </p>

                <p> <h5> Bonus: <b> AR$ {{number_format( $totalBonus, 2 , ',' , '.')}}</b>  <h5> </p>

                <p> <h5> Comision: <b> AR$ {{number_format( $totalComision, 2 , ',' , '.')}}</b> <h5> </p>                         
                
                <div>
            
                  <a class="btn btn-success" href="{{ route('comisiones.imprimir', ['vendedor' => $vendedor->id, 'fechaDesde' => $searchText,'fechaHasta' => $ultimo] ) }}" role="button"> Imprimir </a>
      
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalPagar" title="Pagar Comision" data-original-title="Agregar Cliente">Pagar</a></button>
                  
                  <a class="btn btn-danger" href="{{ route('comisiones.index')}}" role="button"> Volver </a>
                </div>

              </div>

            </div>
          
          </div>
        
        </section>
        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                
                  <div class="card-tools">

                    <form class="form-inline" action="{{ route('comisiones.show',$vendedor->id) }}" role="form">
                    
                        <div class="input-group input-group-sm" style="width: 500px;">  
                          
                          <input type="date" name="searchText" class="form-control float-right" placeholder="Buscar" id="searchTerm">

                          <input type="date" name="searchTextHasta" class="form-control float-right" placeholder="Buscar" id="searchTerm">

                          <div class="input-group-append">
                            
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                          
                          </div>

                        </div>

                    </form>


                  </div>
                  

              </div>



              <div class="card-body table-responsive p-0">

                <p> <h5 style="padding: 1px 0px 0px 25px;">Total de Ventas: <b>{{$countventas}} </b> <h5></p>

                <table class="table table-hover text-nowrap" id="datos">
                  
                  <thead>
                    
                    <tr>                    
                        <th style="text-align:center;"> Fecha de Cancelacion </th>
                        <th style="text-align:center;"> Cliente </th>
                        <th style="text-align:center;"> Nº Venta </th>
                        <th style="text-align:center;"> Total </th>
                    </tr>
                  
                  </thead>
                  
                  <tbody>

                      @foreach ($ventas as $venta)
                      
                    <tr>
                        <td style="text-align:center;">{{ $venta->getFromDateAttribute($venta->fechaCancelacion) }}</td>
                        <td style="text-align:center;">{{ $venta->cliente->razon_Social }}</td>
                        <td style="text-align:center;">{{ $venta->num_pedido }}</td>
                        <td style="text-align:center;">AR$ {{number_format( $venta->total, 2 , ',' , '.')}} </td>
                    </tr>
                      
                      @endforeach
                  </tbody>
                  
                  <tfoot>

                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                  
                  </tfoot>
                
                </table>
              
              </div>

            </div>

          </div>

          </div>

        </div>



        

    </div>

</div>


<div class="modal fade bd-example-modal-lg" id="ModalPagar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">
      
      <div class="modal-content">
		      
          <div class="modal-header">
        	  <h5 class="modal-title" id="titulo">Pagar Comision</h5>		
     	    </div>
          
          <div class="modal-body">
	          
            <div class="card-body">
              
              <form method="post" action="{{ route('comisiones.pagar')}}" role="form">
                
                {{ csrf_field() }}
                
                <div class="row">

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        
                        <div class="form-group">
                          
                          <label>Total Ventas</label>
                          <input type="text" class="form-control" placeholder="Enter ..." id="totalVenta" name="totalVenta" value="{{$totalVendido->totalPesos}}">
                          <input type="hidden" class="form-control" placeholder="Enter ..." id="vendedor_id" name="vendedor_id" value="{{$vendedor->id}}">
                          <input type="hidden" class="form-control" placeholder="Enter ..." id="fechaDesde" name="fechaDesde" value="{{$searchText}}">
                          <input type="hidden" class="form-control" placeholder="Enter ..." id="fechaHasta" name="fechaHasta" value="{{$ultimo}}">
                          <input type="hidden" class="form-control" placeholder="Enter ..." id="bonus" name="bonus" value="{{$numero}}">
                        
                        </div>

                    </div>
                
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        
                        <div class="form-group">
                          
                          <label>Porcentaje Ventas</label>
                          <input type="text" class="form-control" placeholder="Enter ..." id="totalPorcentaje" name="totalPorcentaje" value="{{$porcentaje}}">
                        
                        </div>

                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        
                        <div class="form-group">
                          
                          <label>Bonus Ventas</label>
                          <input type="text" class="form-control" placeholder="Enter ..." id="totalBonus" name="totalBonus" value="{{$totalBonus}}">
                        
                        </div>

                    </div>
                  
                </div>

                <div class="row">

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        
                        <div class="form-group">
                          
                          <label>Comision</label>
                          <input type="text" class="form-control" placeholder="Enter ..." id="totalComision" name="totalComision" value="{{$totalComision}}">
                        
                        </div>

                    </div>
                                  
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        
                        <div class="form-group">
                    
                          <label>Tipo</label>
                            
                          <select class="form-control select2" style="width: 100%;" id="modoPago" name="modoPago">
                            <option value="transferencia bancaria">TRANSFERENCIA</option>
                            <option value="efectivo">EFECTIVO</option>
                          </select>
                
                        </div>
                    
                    </div>

                </div>
              
                <div class="row">
                  
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    
                      <div class="form-group">
                          
                          <button type="submit" class="btn btn-primary">Pagar</button>

                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                      </div>
                    
                    </div>

                </div>


              </form>  
                  
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