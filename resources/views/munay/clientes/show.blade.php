@extends('layouts.munay')

@section('title','Detalle Cliente')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('Munay/Clientes')}}" class="nav-link"> <i class="fas fa-address-card"></i> Clientes  </a>
                                    
    </li>

    <li class="breadcrumb-item">
            
        <a href="{{url('Munay/Clientes/detalle/'.$cliente->id)}}" class="nav-link"> <i class="far fa-eye"></i> Detalle Cliente </a>
                                                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">
    
      <div class="header">
          
          <h2 class="title"> <a href="{{url('Munay/Clientes')}}"> <i class="far fa-eye"></i> Detalle Clientes </a>  </h2> 
      
      </div>

      <div class="inside">

        {!! Form::open(['url'=>'Munay/Clientes/update/'.$cliente->id]) !!}

            <div class="row">
                            
                <div class="col-md-6">
                              
                    <label for="name">Nombre:</label>

                    <div class="input-group">
                                      
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                  
                        {!!Form::text('nombre',$cliente->razon_Social,['class' => 'form-control','readonly'=>'true'])!!}    
                                  
                    </div>
                                      
                </div>
          
                <div class="col-md-3">
                            
                    <label for="genero"> Genero </label>

                    <div class="input-group">
                                    
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                           
                      {!!Form::text('nombre',$cliente->genero,['class' => 'form-control','readonly'=>'true'])!!} 
                                   
                    </div>
                                    
                </div>

                <div class="col-md-3">
                            
                    <label for="genero"> Tipo </label>

                    <div class="input-group">
                                    
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                
                      {!!Form::text('nombre',$cliente->tipo,['class' => 'form-control','readonly'=>'true'])!!} 
                                
                    </div>
                                    
                </div>

            </div>

            <div class="row mtop16">
                            
                <div class="col-md-6">
                                          
                    <label for="name">Telefonos:</label>
            
                        <div class="input-group">
                                                  
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                            {!!Form::text('nombre',$cliente->telefonos,['class' => 'form-control','readonly'=>'true'])!!}     
                                              
                        </div>
                                                  
                </div>

                <div class="col-md-6">
                                          
                    <label for="name">Correo Electronico:</label>
            
                        <div class="input-group">
                                                  
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                            {!!Form::text('email',$cliente->email,['class' => 'form-control','readonly'=>'true'])!!}    
                                              
                        </div>
                                                  
                </div>
                        
            </div>

            <div class="row mtop16">
                            
                <div class="col-md-3">
                                          
                    <label for="name">Direccion:</label>
            
                        <div class="input-group">
                                                  
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>

                            {!!Form::text('email',$cliente->direccion,['class' => 'form-control','readonly'=>'true'])!!}    
                        </div>
                                                  
                </div>

                <div class="col-md-2">
                                          
                    <label for="name">Codigo Postal:</label>
            
                        <div class="input-group">
                                                  
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                 
                            {!!Form::text('email',$cliente->codigo_postal,['class' => 'form-control','readonly'=>'true'])!!}                      
                        
                          </div>
                                                  
                </div>

                <div class="col-md-3">
                                          
                    <label for="name">Localidad</label>
            
                        <div class="input-group">
                                                  
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                            {!!Form::text('ciudad',$cliente->ciudad,['class' => 'form-control','readonly'=>'true'])!!}    
                                              
                        </div>
                                                  
                </div>

                <div class="col-md-4">
                                          
                    <label for="name">Provincia:</label>
            
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                        {!!Form::text('ciudad',$cliente->provincia->nombre,['class' => 'form-control','readonly'=>'true'])!!}
                                              
                    </div>
                                                  
                </div>
                        
            </div>

            @if(Auth::user()->tipo == "admin")

            <div class="row mtop16">
                            
                <div class="col-md-3">
                                
                    <label for="name">Factura?:</label>
              
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                        {!!Form::text('ciudad',$cliente->facturacion,['class' => 'form-control','readonly'=>'true'])!!}      
                    </div>
                
                </div>

                <div class="col-md-3">
                                
                    <label for="name"> Cuenta Corriente?:</label>
              
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                        
                        {!!Form::text('ciudad',$cliente->cuentaCorriente,['class' => 'form-control','readonly'=>'true'])!!}                     
                                  
                    </div>
                
                </div>       
                
                <div class="col-md-3">
                                
                    <label for="name"> Monto Dolares?:</label>
              
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                        
                        {!!Form::text('montoCuenta',$cliente->montoCuenta,['class' => 'form-control','readonly'=>'true'])!!}       
                    
                    </div>
                
                </div>                  
                
                <div class="col-md-3">
                                
                    <label for="name"> Monto Pesos?:</label>
              
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                        
                        {!!Form::text('montoCuentaPesos',$cliente->montoCuentaPesos,['class' => 'form-control','readonly'=>'true'])!!}
          
                    </div>
                
                </div>  
            </div>           

            @endif  

            <div class="opts mtop16">

                <a class="delete" href="{{ url('Munay/Clientes') }}" title="Volver"> <i class="fas fa-arrow-left"></i> </a>
                
                <a class="edit" href="{{ url('Munay/Clientes/edit/'.$cliente->id) }}" title="Editar Cliente"> <i class="fas fa-edit"></i> </a>                           
                          
            <div>

      </div>
            
    </div>
    
</div>

<div class="container-fluid mtop16">

    <div class="panel shadow">
    
      <div class="header">
          
          <h2 class="title"> <a href="">  <i class="fas fa-boxes"></i> Productos Comprados </a>  </h2> 
      
      </div>

      <div class="inside">
          
          <table class="table table-hover">
                        
            <thead>
                              
                <tr>
                  <th>Imagen</th>
                  <th>Productos</th>
                  <th>Cantidad</th>
                      
                </tr>
            
            </thead>
                                    
            <tbody>
                            
                @foreach ($productosComprados as $producto)
                            
                  <tr>
                      <td width="64px">
                        <a  data-fancybox="gallery" href="{{ url('img/productos/'.$producto->imagen) }}"> 
                          <img src=" {{ url('img/productos/'.$producto->imagen) }}" width="64px" > 
                        </a>
                      </td>
                      <td>{{$producto->nombre}}</td>
                      <td>{{$producto->cantidad }}</td>
                </tr>
                          
              @endforeach
                                    
            </tbody>
            
          </table>

      </div>
    
    </div>
  
</div> 
    
@endsection