@extends('layouts.app')
@section('content')

<div class="container">
  
  <div class="row justify-content-center">
      
      <div class="col-md-12">

        <section class="content-header">
          
          <div class="container-fluid">
            
            <div class="row mb-2">
              
              <div class="col-sm-6">

                <h1> Estadisticas Cajas </h1>

              </div>

            </div>
          
          </div>
        
        </section>
        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                
                  <div class="card-tools">

                      <form method="post" action="{{ route('estadisticas.cajas')}}" role="form">

                          {{ csrf_field() }}
                      
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
