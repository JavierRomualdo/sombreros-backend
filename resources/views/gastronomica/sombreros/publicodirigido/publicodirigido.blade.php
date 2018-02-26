@extends('layouts.master')
@section('title','Publico Dirigido')
@section('content')

<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Público dirigido</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h5 fadeIn animated text-center ion-clipboard"> Lista - Público Dirigido</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/publicodirigido/publicodirigido/create')}}" class="btn btn-outline-primary margenInf fadeIn animated ion-plus-round btn-sm" title="nuevo publico"> Nuevo</a> &nbsp;

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
                    <th>#</th>
                    <th>Publico Dirigido</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($publicosdirigido as $index=>$publicodirigido)
                    <tr class="fadeIn animated">
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$publicodirigido->publico}}</td>
                      <td>{{$publicodirigido->descripcion}}</td>
                      <td>
                        <a href="{{action('Sombreros\PublicoDirigidoController@edit', $publicodirigido->id)}}" class="btn btn-outline-primary btn-sm ion-edit" title="Editar"></a>
                        <a href="{{action('Sombreros\PublicoDirigidoController@show', $publicodirigido->id)}}" class="btn btn-outline-primary btn-sm ion-android-close" title="Eliminar"></a>
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
            { !!$publicosdirigido->links()!!}
          </div>-->
        </div>
      </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script>
      $(document).ready(function(){
        $('#myTable').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            responsive: true
          }
        });
      });
    </script>
@endsection
