@extends('layouts.app')
@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

          <section class="content-header">

          <div class="container-fluid">

            <div class="row mb-2">
              
              <div class="col-sm-6">

                <h1>Cuenta Corriente Cliente: {{$cliente->razon_Social}}</h1>
                <br>
                <p>Credito Asignado <strong> USD: {{$cliente->montoCuenta}}  </strong> Cuenta Asignado <strong> AR$: {{$cliente->montoCuentaPesos}}  </strong></p>

                <p>Telefono <strong> {{$cliente->telefonos}}  </strong> E-Mail <strong>  {{$cliente->email}}  </strong></p>
                
                <p>Venta:  <strong> {{$pago->pedido->num_pedido}} </strong></p>

                @if($pago->estado  == 'Impago')
                <p> Retraso:   <strong> {{ $pago->calcularDias($pago->pedido->fecha) }} Dias </strong> </p>
                @endif
              </div>

            </div>

          </div>
            
          </section>

          <div class="card card-secondary">

            <div class="card-header">

              <h3 class="card-title">Historial de Pagos</h3>

            </div>

            <div class="card-body">

              <div class="row">

                <table class="table table-hover text-nowrap">
                    
                    <thead>
                      
                      <tr>
                        <th style="text-align:center;">Fecha y Hora</th>     
						            <th style="text-align:center;">Monto U$D</th>     
                        <th style="text-align:center;">Monto AR$</th>
                        <th style="text-align:center;">Saldo U$D</th>     
                        <th style="text-align:center;">Saldo AR$</th>    
                        <th style="text-align:center;">Comprobantes</th>                                  
                      </tr>

                    </thead>

                    <tbody>
                      @foreach ($historial as $hist)
                      <tr>
                        <td style="text-align:center;"> {{ $hist->getFromDateAttribute($hist->created_at) }}</td>
						            <td style="text-align:center;"> U$D {{ $hist->monto }}</td>
                        <td style="text-align:center;"> AR$ {{ $hist->montop }}</td>
                        <td style="text-align:center;"> U$D {{ $hist->saldod }}</td>
                        <td style="text-align:center;"> AR$ {{ $hist->saldop }}</td>
                        <td style="text-align:center;"><a href="{{route('pdf.comprobante', $hist->id)}}"class="btn btn-link" data-toggle="tooltip" title="Imprimir Comprobante" data-original-title="Imprimir Comprobante"><i class="fas fa-print" style="color:#578DA4; font-size: 20px;"></i></a></td>
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
            
            <a class="btn btn-success" href="{{ route('pdf.historialPagos', $pago->id)}}" role="button">Imprimir </a>
        		
            <a class="btn btn-danger" href="{{ route('cuentas.historialClienteCorriente', $cliente->id) }}" role="button">Volver </a>
        
        </div>
      
      </div>
        
  </div>

</div>

@endsection

