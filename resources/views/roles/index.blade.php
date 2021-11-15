@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
      
      <div class="col-md-12">

        <section class="content-header">
          
          <div class="container-fluid">
            
            <div class="row mb-2">
              
              <div class="col-sm-6">
                
                <h1>Roles</h1>
              
              </div>

            </div>
          
          </div>
        
        </section>
        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                
                <h3 class="card-title">Listado de Roles</h3>

                  <div class="card-tools">
                    
                      <form class="form-inline" action="{{ route('roles.index') }}" role="form">
                                
                            <div class="input-group input-group-sm" style="width: 300px;">
                                                                    
                                  <input type="text" name="searchText" class="form-control float-right" placeholder="Buscar">
                                                                
                                  <div class="input-group-append">
                                      
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  
                                  </div>

                            </div>

                      </form>

                  </div>

              </div>

              <div class="card-body table-responsive p-0">
                
                <table class="table table-hover text-nowrap" id="datos">
                  
                  <thead>
                    
                    <tr>                    
                      <th style="text-align:center;"><a href="{{ route('roles.create') }}" class="btn btn-link" data-toggle="tooltip" title="Generar Presupuesto" data-original-title="Generar Presupuesto"><i class="fas fa-plus"></i></a></th>
                      <th>Numero</th>
                      <th></th>                
                    </tr>
                  
                  </thead>
                  
                  <tbody>
                      @foreach ($roles as $rol)
                      
                    <tr>
                        <td style="text-align:center;">{{$loop->iteration}}</td>
                        <td>{{ $rol->name }}</td>
                        <td>
                          <a href="{{ route('roles.show', $rol->id) }}" class="btn btn-link" data-toggle="tooltip" title="Ver Presupuesto" data-original-title="Ver Presupuesto"><i class="far fa-eye" style="color:green; font-size: 20px;"></i></a>
                          <a href="{{route('roles.edit', $rol->id)}}"class="btn btn-link" data-toggle="tooltip" title="Imprimir Comprobante" data-original-title="Imprimir Comprobante"><i class="fas fa-pencil-alt" style="color:#578DA4; font-size: 20px;"></i></a>
                        </td>
                    </tr>
                      
                      @endforeach
                  </tbody>

                  <tfoot>

                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                  
                  </tfoot>
                
                </table>
                
                {{$roles->render()}}
              
              </div>
            
            </div>

          </div>

          </div>

        </div>

    </div>

</div>
@endsection


