@extends('layouts.app')
@section('content')
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
            </div><!-- /.container-fluid -->
          </section>

          <!-- Comienza la tabla -->

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Listado de Clientes</h3>

                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>&nbsp;</th>
                        <th>Nombre</th>
                        <th>Tel&eacute;fono</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th style="width: 5%"><a href="{{route('pdf.ListadoClientePdf')}}"><img src="{{ asset('img/pdf2.png') }}" height="70%"/></a></th>
                        <th style="width: 5%">
                          <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-block"><i class="fas fa-plus"></i></a>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($clientes as $cliente)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{ $cliente->nombre }}</td>
                          <td>{{ $cliente->telefonos }}</td>
                          <td style="width: 5%">
                            <a href="{{ route('client.show', $cliente->id) }}" class="btn btn-success btn-block"><i class="far fa-eye"></i></a>
                          </td>
                          <td style="width: 5%">
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-block"><i class="fas fa-pencil-alt" style="color:white"></i></a>
                          </td>
                          <td style="width: 5%">
                            <form class="" action="{{ route('clientes.destroy', $cliente->id)}}" method="post">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                              <button type="submit" onclick="return confirm('Esta acción no podrá deshacerse. ¿Continuar?')" class="btn btn-danger btn-block"><i class="far fa-trash-alt"></i></button>
                            </form>
                          </td>
                          <td style="width: 5%">
                            <a href="{{ route('presupuestos.create',$cliente->id) }}" class="btn btn-success btn-block"><i class="fas fa-pencil-alt" style="color:white"></i></a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{$clientes->render()}}
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

        </div>
    </div>
</div>
@endsection
