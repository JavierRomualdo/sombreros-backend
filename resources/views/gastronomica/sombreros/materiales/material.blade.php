@extends('layouts.master')
@section('title','Materiales')
@section('content')

  <!--<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">-->
  <link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Materiales /</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2 fadeIn animated text-center ion-clipboard"> Lista Materiales</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/materiales/material/create')}}" class="btn btn-primary btn-sm margenInf fadeIn animated ion-plus-round" title="nuevo material"> Nuevo</a> &nbsp;
      <div class="row">
        <div class="col-lg-12">

          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display ion-paperclip fadeIn animated title col-md-4"> Historial:</h2>
            </div>
            <div class="card-block">
              
              <div class="table-responsive">
                  <table class="table table-striped table-hover table-bordered" id="myTable">

                      <thead class="thead-inverse">
                        <tr>
                          <th class="text-center">#</th>
                          <th>Material</th>
                          <th>Codigo</th>
                          <th>Descripcion</th>
                          <th>Imagen</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($materiales as $index=>$material)
                          <tr class="fadeIn animated">
                            <th scope="row" class="text-center">{{$index+1}}</th>
                            <td>{{$material->material}}</td>
                            <td>{{$material->codigo}}</td>                            
                            <td>{{$material->descripcion}}</td>
                            <td>
                              <a href="{{action('Sombreros\MaterialController@foto',$material->id)}}">
                                <img src="/images/materiales/{{$material->photo}}" class="img-fluid pull-xs-left rounded" width="25" alt="...">
                              </a>
                            </td>
                            <td>
                              <a href="{{action('Sombreros\MaterialController@ver', $material->id)}}" class="btn btn-outline-primary btn-sm ion-eye" title="Ver"></a>
                              <a href="{{action('Sombreros\MaterialController@edit', $material->id)}}" class="btn btn-outline-primary btn-sm ion-edit" title="Editar"></a>
                              <a href="{{action('Sombreros\MaterialController@show', $material->id)}}" class="btn btn-outline-primary btn-sm ion-android-delete" title="Eliminar"></a>
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
            { !!$materiales->links()!!}
          </div>
        </div>-->
      </div>
    </div>
  </section>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script>
    $(document).ready(function(){
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
