@extends('layouts.munay')

@section('title','Editar Producto')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/Munay/Productos')}}" class="nav-link"> <i class="fas fa-edit"></i> Editar   </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">
    
      <div class="header">
          
          <h2 class="title"> <a href="{{url('/Munay/Productos')}}"> <i class="fas fa-edit"></i> Editar Producto </a>  </h2> 
      
      </div>

      <div class="inside">

          <div class="btns mtop16">


          </div>

            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="{{ url('Munay/Producto/Update/'.$producto->id)}}" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="row">
                  
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label>Detalle</label>
                      <input type="text" class="form-control" placeholder="Enter ..." id="nombre" name="nombre" value="{{$producto->nombre}}">
                    </div>
                  </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
	
                        <div class="form-group">

                            <label>Imagen</label>

                            <input type="file" class="form-control" id="imagen" name = "imagen">
                        
                        </div>

                    </div>

                  <div class="col-xs-24 col-sm-24 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <label>Descripcion</label>
                      <textarea class="form-control" rows="3" id="descripcion" name="descripcion">{{$producto->descripcion}}</textarea>
                    </div>
                  </div>
                  

                </div>

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Beneficio</label>
                        <input type="text" class="form-control" placeholder="Enter ..." id="beneficio" name="beneficio" value="{{$producto->beneficio}}">
                      </div>
                  </div> 

                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                        <label>Precio Publico</label>
                        <input type="text" class="form-control" placeholder="Enter ..." id="precioFinal" name="precioFinal" value="{{$producto->precioLocal}}">
                      </div>
                  </div>     
                
                </div>
                
                <div class="row">

                     

                </div>      

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-success">Actualizar <i class="fas fa-pencil-alt" style="color:#E8EE10"></i></button>
                      <a class="btn btn-danger" href="{{ route('cotizaciones.index')}}" role="button">Cancelar <i class="fas fa-arrow-alt-circle-left" style="color:#E8EE10"></i></a>
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
</div>
@endsection
