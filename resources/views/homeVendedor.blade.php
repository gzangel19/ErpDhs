@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1> Octubre 2021</h1>
                </div>

              </div>
            </div><!-- /.container-fluid -->
          </section>

          <!-- Main content -->
              <section class="content">
                <div class="container-fluid">

                <div class="row">

                    <div class="col2">
                      <img class="imagen1" style="width:220px; height:100%" src="{{ asset('img/productos/ofe11.jpg') }}">
                    </div>

                    <div class="col3">
                      <img class="imagen1" style="width:220px; height:100%" src="{{ asset('img/productos/ofe12.jpg') }}">
                    </div>
                   
                    <div class="col4">
                      <img class="imagen1" style="width:220px; height:100%" src="{{ asset('img/productos/ofe14.jpg') }}">
                    </div>

                    <div class="col2">
                      <img class="imagen1" style="width:220px; height:100%" src="{{ asset('img/productos/ofe6.jpg') }}">
                    </div>

                </div>  
                
                <div class="row">
                                   
                    <div class="col3">
                      <img class="imagen1" style="width:220px; height:100%" src="{{ asset('img/productos/ofe7.jpg') }}">
                    </div>

                    <div class="col1">
                        <img class="imagen1" style="width:220px; height:100%" src="{{ asset('img/productos/ofe8.jpg') }}">
                    </div>
                   
                    <div class="col2">
                       <img class="imagen1" style="width:220px; height:100%" src="{{ asset('img/productos/ofe9.jpg') }}">
                    </div>

                    <div class="col3">
                        <img class="imagen1" style="width:220px; height:100%"src="{{ asset('img/productos/ofe4.jpg') }}">
                    </div>

                </div>

            </div><!-- /.container-fluid -->
              </section>
              <!-- /.content -->


        </div>
    </div>
</div>

@endsection
