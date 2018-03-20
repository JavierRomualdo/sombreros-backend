@extends('layouts.master')
@section('title','Modelos')
@section('content')

<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Temporadas /</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h5 fadeIn text-center ion-clipboard animated"> Lista Temporadas</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/configuracion/temporadas/temporada/create')}}" class="btn btn-outline-primary btn-sm margenInf ion-plus-round" title="nuevo modelo"> Nuevo</a> &nbsp;
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
                          <th>Temporada</th>
                          <th>Imagen</th>
                          <th>Fecha Inicio</th>
                          <th>Fecha Fin</th>
                          <th>Descripcion</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($temporadas as $index=>$temporada)
                          <tr>
                            <th scope="row">{{$index+1}}</th>
                            <td>{{$temporada->temporada}}</td>
                            <td>
                              <a href="{{action('Temporada\TemporadaController@foto',$temporada->id)}}">
                                <img src="/images/temporadas/{{$temporada->photo}}" class="img-fluid pull-xs-left rounded" width="25" alt="...">
                              </a>
                            </td>
                            <td>{{$temporada->fecha_inicio}}</td>
                            <td>{{$temporada->fecha_fin}}</td>
                            <td>{{$temporada->descripcion}}</td>
                            
                            <td>
                              <a href="{{action('Temporada\TemporadaController@ver', $temporada->id)}}" class="btn btn-outline-primary btn-sm ion-eye" title="Ver"></a>
                              <a href="{{action('Temporada\TemporadaController@edit', $temporada->id)}}" class="btn btn-outline-primary btn-sm ion-edit" title="Editar"></a>
                              <a href="{{action('Sombreros\ModeloController@show', $temporada->id)}}" class="btn btn-outline-primary btn-sm ion-android-delete" title="Eliminar"></a>
                              <!--<a onclick="Eliminar('{ {$modelos->id}}','{ {$modelos->modelo}}')" class="ion-android-close" title="Eliminar"></a>-->
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
            { !!$modelos->links()!!}
          </div>
        </div>-->
      </div>
    </div>
  </section>

  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
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
  <!--<script type="text/javascript">
    var Eliminar = function(id, name){
      //ALERT JQUERY
      $.alertable.confirm("¿Está seguro de eliminar el registro?"+
      "|Modelo|"+name).then(function(){
        var route="{ {url('gastronomica/sombreros/modelos/modelo')}}/"+id+"";
        var token = $("#token").val();
          $.ajax({
            url: route,
            type: 'DELETE',
            dataType: 'json',
            success: function(){
              if (data.success=='true') {
                alert("tre");
                listmark();
                $("#message-delete").fadeIn();
                $('#message-delete').show().delay(3000).fadeOut(1);
              } else{
                alert("error");
              }
            }
          });
        $
      });
    };
  </script>-->
@endsection
