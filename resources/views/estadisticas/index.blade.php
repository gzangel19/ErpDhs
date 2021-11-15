@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
    
    <div class="col-md-12">

      <section class="content-header">
            
        <div class="container-fluid">
              
          <div class="row mb-2">
              
              <div class="col-sm-6">
                
                <h1> Estadisticas</h1>
              
              </div>

          </div>
        
        </div>
      
      </section>
      
            <div class="row">
                                   
                <div class="col5">
                    <h4 style="text-align:center"> Clientes </h4>
                    
                    <img src="{{ asset('img/productos/cliente.jpg') }}" alt="Estadisticas Clientes" width="100%" height="253" >
                    
                    <form method="post" action="{{ route('estadisticas.clientes')}}" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                
                            <select class="form-control select2" style="width: 100%;" id="cliente_id" name="cliente_id">
                                <option value="0">General</option>
                                @foreach($clientes as $cliente)
                                <option value="{{$cliente->id}}">{{$cliente->razon_Social}}</option>
                                @endforeach

                            </select>
            
                        </div>
                        
                        <div class="form-group" style="text-align:center">
                
                            <button type="submit" class="btn btn-primary"> VER  </button>
              
                        </div>
                    </form>

                </div>
               
                <div class="col5">
                    <h4 style="text-align:center"> Productos </h4>
                    
                    <img src="{{ asset('img/productos/productos.jpg') }}" alt="Estadisticas Productos"  width="100%" height="253" >
                    
                    <form method="post" action="{{ route('estadisticas.productos')}}" role="form">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                
                            <select class="form-control select2" style="width: 100%;" id="producto_id" name="producto_id">
                                <option value="0">General</option>
                                @foreach($productos as $producto)
                                <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                                @endforeach
                            </select>
            
                        </div>
                        
                        <div class="form-group" style="text-align:center">
                
                            <button type="submit" class="btn btn-primary"> VER  </button>
              
                        </div>
                    </form>
                    
                </div>
                                  
                <div class="col5">

                    <h4 style="text-align:center"> Depositos </h4>
                    
                    <img src="{{ asset('img/productos/deposito.jpg') }}" alt="Estadisticas Clientes"  width="100%" height="253" >
                    
                    <form  action="#" role="form">
                        <div class="form-group">
                
                            <select class="form-control select2" style="width: 100%;" id="deposito_id" name="deposito_id">
                                <option value="0">General</option>
                                @foreach($depositos as $deposito)
                                <option value="{{$deposito->id}}">{{$deposito->nombre}}</option>
                                @endforeach

                            </select>
            
                        </div>
                        
                        <div class="form-group" style="text-align:center">
                
                            <button type="submit" class="btn btn-primary"> VER  </button>
              
                        </div>
                    </form>
                    
                </div>
               
                <div class="col5">

                    <h4 style="text-align:center"> Unidades de Negocio </h4>
                    
                    <img src="{{ asset('img/productos/unidadesNegocio.jpg') }}" alt="Estadisticas Clientes" width="100%" height="253" >
                    
                    <form action="#" role="form">
                        <div class="form-group">
                
                            <select class="form-control select2" style="width: 100%;" id="unidades_id" name="unidades_id">
                                <option value="0">General</option>
                                @foreach($unidades as $unidad)
                                <option value="{{$unidad->id}}">{{$unidad->nombre}}</option>
                                @endforeach

                            </select>
            
                        </div>
                        
                        <div class="form-group" style="text-align:center">
                
                            <button type="submit" class="btn btn-primary"> VER  </button>
              
                        </div>
                    </form>
                    
                </div>

                <div class="col5">

                    <h4 style="text-align:center"> Cajas </h4>

                    <img src="{{ asset('img/productos/money.jpg') }}" alt="Estadisticas Cajas" width="100%" height="253" >

                    <form method="post" action="{{ route('estadisticas.cajas')}}" role="form">
                        
                        {{ csrf_field() }}
                        
                        <div class="form-group">

                            <select class="form-control select2" style="width: 100%;" id="cajas_id" name="cajas_id">
                                <option value="0">General</option>
                                @foreach($cajas as $caja)
                                <option value="{{$caja->id}}">{{$caja->nombre}}</option>
                                @endforeach

                            </select>

                        </div>
                        
                        <div class="form-group" style="text-align:center">

                            <button type="submit" class="btn btn-primary"> VER  </button>

                        </div>
                    </form>

                </div>

            
            </div>
    
    </div>

</div>

@endsection


