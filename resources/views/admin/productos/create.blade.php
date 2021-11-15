@extends('layouts.app')
@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        
        <div class="col-md-12">

          <section class="content-header">
            
            <div class="container-fluid">
              
              <div class="row mb-2">
                
                <div class="col-sm-6">
                
                  <h1> <i class="fas fa-boxes"> </i> Productos</h1> 
                
                </div>

              </div>
            
            </div>
          
          </section>



        <div class="card card-secondary">
            
            <div class="card-header">
            
              <h3 class="card-title">Agregar Producto</h3>
            
            </div>

            <div class="card-body">
              
              {!! Form::open(['url' => '/admin/productos/create']) !!}

              <div class="row">
                  
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  
                      <label for="nombre">Nombre</label>
                      
                      <div class="input-group">

                        <div class="input-group-prepend">
                          
                          <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                        
                        </div>
                          
                      {!! Form::text('nombre',null,['class'=>'form-control']) !!}

                      </div>

                    </div>  

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  
                      <label for="nombre"> Categoría </label>
                      
                      <div class="input-group">

                        <div class="input-group-prepend">
                          
                          <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                        
                        </div>
                          
                      {!! Form::text('nombre',null,['class'=>'form-control']) !!}

                      </div>

                    </div> 

                    

              </div>
              

              <div class="row" style="margin-top: 16px;">

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  
                      <label for="img"> Imagen </label>
                      
                      <div class="custom-file">

                        {!! Form::file('img',['class'=>'custom-file-input','id' => 'customFile']) !!}
                        
                        <label class="custom-file-label" for="customFile"></label>
                      
                      </div>
                    
                    </div>  
                  
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  
                      <label for="precio">Precio</label>
                      
                      <div class="input-group">

                        <div class="input-group-prepend">
                          
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill"></i></span>
                        
                        </div>
                          
                      {!! Form::number('precio',null,['class'=>'form-control','min'=>'0.00','step' => 'any']) !!}

                      </div>

                    </div> 

              </div>

              <div class="row" style="margin-top: 16px;">
                  
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  
                      <label for="nombre">¿ En Oferta ?</label>
                      
                      <div class="input-group">

                        <div class="input-group-prepend">
                          
                          <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                        
                        </div>
                          
                      {!! Form::select('oferta',['0'=>'No', '1' => 'Si'],0,['class'=>'form-control']) !!}

                      </div>

                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  
                      <label for="descuento">Descuento</label>
                      
                      <div class="input-group">

                        <div class="input-group-prepend">
                          
                          <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                        
                        </div>
                          
                      {!! Form::number('descuento',0.00,['class'=>'form-control']) !!}

                      </div>

                    </div>    

              </div>

              <div class="row" style="margin-top: 16px;">
                  
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  
                      <label for="nombre">Descripción</label>
                      
                      <div class="input-group">

                        <div class="input-group-prepend">
                          
                          <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                        
                        </div>
                          
                      {!! Form::textarea('nombre',null,['class'=>'form-control','id' => 'editor' ]) !!}

                      </div>

                    </div>  

              </div>

              <div class="row" style="margin-top: 16px;">
                  
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              
                        
                      {!! Form::submit('Guardar',['class'=>'btn btn-success']) !!}

                    </div>  

              </div>
                
              {!! Form::close() !!}
              
            </div>
            <!-- /.card-body -->
          </div>


        </div>
    </div>
</div>
@endsection
