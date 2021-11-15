@extends('layouts.Sinopsys')

@section('title','Home Synopsys')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/')}}" class="nav-link"> <i class="fas fa-book"></i> Synopsys  </a>
                                    
    </li>


@endsection


@section('content')
<div class="container-fluid">

    <div class="panel shadow">
            
        <div class="header">
            <h2 class="title"> <a href="{{url('/')}}"> <i class="fas fa-home"></i> Home </a>  </h2> 
        </div>

        <div class="inside">

            <div class="btns">        

            </div>

            <div class="row justify-content-center mtop16">
                
                <div class="col-md-12">

          <!-- Main content -->
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                  
                    <!-- <img src="{{ asset('img/logos/munay-logo.png') }}"> -->
                  
                  </div>
                  <!-- /.row -->
                </div><!-- /.container-fluid -->
              </section>
              <!-- /.content -->


        </div>
    </div>
</div>
</div>

</div>

</div>

</div>


@endsection