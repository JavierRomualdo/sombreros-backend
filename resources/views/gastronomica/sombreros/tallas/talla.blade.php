@extends('layouts.master')
@section('title','Tejidos')
@section('content')
<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">-->
<!--<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">-->
    <link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Tallas /</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2 fadeIn animated text-center ion-clipboard"> Lista de Tallas:</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/tallas/talla/create')}}" class="btn btn-primary margenInf fadeIn animated ion-plus-round btn-sm" title="nueva talla"> Nuevo</a> &nbsp;

      <div class="row">
          
        <div class="col-lg-12">
          
          <div class="card miBorder fadeIn animated">
            <div class="card-block">
                <div class="table-responsive">
                  <table id="myTable" class="table table-striped table-hover table-bordered fadeIn animated">

                <thead class="thead-inverse">
                  <tr>
                    <th class="text-center">#</th>
                    <th>Talla</th>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($tallas as $index=>$talla)
                    <tr class="fadeIn animated">
                      <th scope="row" class="text-center">{{$index+1}}</th>
                      <td>{{$talla->talla}}</td>
                      <td>{{$talla->codigo}}</td>
                      <td>{{$talla->descripcion}}</td>
                      <td>
                        <a href="{{action('Sombreros\TallaController@edit', $talla->id)}}" class="btn btn-outline-primary btn-sm ion-edit" title="Editar"></a>
                        <a href="{{action('Sombreros\TallaController@show', $talla->id)}}" class="btn btn-outline-primary btn-sm ion-android-close" title="Eliminar"></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
                
              </div>
            </div>

          </div>
        </div>
        <!--<div class="container">
          <div class="paginacion">
            { !!$tallas->links()!!}
          </div>
        </div>-->
      </div>
    </div>
  </section>
  
  <!--<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>-->
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

  
  <script>
    /*$(document).ready(function() {
      $('#myTable').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax": "scripts/server_processing.php"
          "columns": {
            {data: 'talla'},
            {data: 'descripcion'}
          }
      });
    });*/
    $(document).ready(function() {
      $('#myTable').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          responsive: true
        },
        scrollY:        '70vh',
        //scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        fixedColumns:   {
          heightMatch: 'none'
        },
        fixedHeader: {
          header: true
        },
        sScrollX: true,
        sScrollXInner: "100%",
      });
    });
  </script>
@endsection
