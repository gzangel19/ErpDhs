@extends('layouts.app')
@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

          <section class="content-header">

            <div class="container-fluid">

              <div class="row mb-2">

                <div class="col-sm-6">

                  <h1>Presupuesto</h1>

                </div>

              </div>

            </div>
            
          </section>

          <div class="card card-secondary">

            <div class="card-header">
              
              <h3 class="card-title">Detalle de Presupuesto</h3>
            
            </div>

            <div class="card-body">

              <div class="row">
                
                <div class="col-md-12">
                  <br>
                    <p><b>Vendedor: </b>{{$presupuesto->user->nombre}}</p>
                    <p><b>Numero: </b>{{$presupuesto->num_comprobante}}</p>
                    <p><b>Fecha: </b>{{ $presupuesto->getFromDateAttribute($presupuesto->fecha) }}</p>
                    <p><b>Hora: </b>{{ $presupuesto->formatoHora($presupuesto->fecha) }}</p>
                    <p><b>Total:</b> AR$ {{ $presupuesto->total }} </p>
                    <p><b>Forma de Entrega:</b> AR$ {{ $presupuesto->tipo_entrega }} </p>
                    <p><b>Modo de Pago:</b> AR$ {{ $presupuesto->modo_venta }} </p>
                    <p><b>Mantenimiento de Presupuesto:</b> {{ $presupuesto->mantenimiento }} Dias </p>
                    @if($presupuesto->mantenimiento !=0 )
                    <p><b>Fecha Vencimiento : </b> @php echo date("d-m-Y",strtotime($presupuesto->fecha." + $presupuesto->mantenimiento days")); @endphp </p>
                    @endif
                    <p><b>Nota:</b> {{ $presupuesto->nota }} </p>
                    
                </div>

              </div>

            </div>

          </div>

          <div class="card card-secondary">

            <div class="card-header">

              <h3 class="card-title">Productos</h3>

            </div>

            <div class="card-body">

              <div class="row">

                <table class="table table-hover text-nowrap">
                    
                    <thead>
                      
                      <tr>
                        <th style="text-align:center;">#</th>
                        <th style="text-align:center;">Productos</th>
                        <th style="text-align:center;">Cantidad</th>
                        <th style="text-align:center;">Precio</th>
                        <th style="text-align:center;">Sub Total</th>                                    
                      </tr>

                    </thead>

                    <tbody>
                      @foreach ($detalle as $det)
                      <tr>
                        <td style="text-align:center;">{{$loop->iteration}}</td>
                        <td style="text-align:center;">{{ $det->producto->nombre }}</td>
                        <td style="text-align:center;">{{ $det->cantidad }}</td>
                        <td style="text-align:center;">AR$ {{ $det->precio }}</td>
                        <td style="text-align:center;">AR$ {{ $det->cantidad * $det->precio }}</td>
                      </tr>
                      @endforeach
                    </tbody>

                </table>
                <br>

              </div>
            
            </div>
          
          </div>
        
        </div>

        </div>
        
        <div class="form-group">
        		
            <a class="btn btn-danger" href="{{ route('presupuestos.index')}}" role="button">Volver </a>
        
        </div>
              
  </div>

</div>

@endsection
