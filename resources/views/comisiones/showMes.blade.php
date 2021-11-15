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

                <p> <h5>Vendedor: <b>{{$vendedor->apellido}} {{$vendedor->nombre}} </b> &nbsp; &nbsp; <h5></p>
              

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

            </div>

          </div>

          </div>

        </div>

    </div>

</div>
@endsection
