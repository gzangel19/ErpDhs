@extends('layouts.app')
@section('content')
@php
    $s = '';
@endphp

<div class="container">
  
  <div class="row justify-content-center">
    
    <div class="col-md-12">
    
      <section class="content-header">
        
        <div class="container-fluid">
          
          <div class="row mb-2">
            
            <div class="col-sm-6">

              <h1>Clientes</h1>

            </div>

          </div>
        
        </div>
      
      </section>

    <div class="card card-secondary">
      
      <div class="card-header">
          
          <h3 class="card-title">Editar Porcentajes</h3>
      
      </div>

      <div class="card-body">
              
        <form method="post" action="{{ route('comisiones.update',$comision->id)}}" role="form">
                
          {{ csrf_field() }}
          
          {{ method_field('PUT') }}

          <div class="row">
            
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
              
                <div class="form-group">
                  
                  <label>Vendedor</label>
                  
                  <input type="text" class="form-control" placeholder="Enter ..." id="nombre" name="nombre" value="{{$vendedor->apellido}}{{$vendedor->nombre}}" disabled>
                  
                </div>

            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                
                <div class="form-group">
                    
                    <label>Porcentaje</label>
                    
                    <input type="text" class="form-control" placeholder="Enter ..." id="porcentaje" name="porcentaje" value="{{$comision->porcentaje}}">
                </div>
                
            </div>
          
          </div>

          <div class="row">
              
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                
                <div class="form-group">
                  
                  <label>Bonus</label>
                  
                  <input type="text" class="form-control" placeholder="Enter ..." id="bonus" name="bonus" value="{{$comision->bonus}}">
                
                </div>

            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                
                <div class="form-group">
                  
                  <label>Valor Bonus</label>
                  
                  <input type="text" class="form-control" placeholder="Enter ..." id="valorBonus" name="valorBonus" value="{{$comision->valorBonus}}">
                
                </div>
            
            </div>
            
          </div>
      
           <div class="row">
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              
              <div class="form-group">
                
                <button type="submit" class="btn btn-success"> Actualizar <i class="fas fa-pencil-alt" style="color:#E8EE10"></i> </button>
                
                <a class="btn btn-danger" href="{{ route('comisiones.index')}}" role="button">Cancelar <i class="fas fa-arrow-alt-circle-left" style="color:#E8EE10"></i></a>
                
              </div>
            
            </div>
          
          </div>

        </form>
            </div>
            <!-- /.card-body -->
          </div>


        </div>
    </div>

</div>

@endsection

