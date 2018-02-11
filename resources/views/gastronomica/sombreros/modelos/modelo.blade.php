@extends('layouts.master')
@section('title','Modelos')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Modelos</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2 fadeIn animated">Lista de Modelos:</h1>
      </header>
      @include('partials.messages')

      <div class="row">
        <div class="col-lg-12">

          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h1 display ion-paperclip fadeIn animated title"> Historial:</h2>
            </div>
            <div class="card-block">
              <a href="{{url('/gastronomica/sombreros/modelos/modelo/create')}}" class="btn btn-outline-primary btn-sm margenInf ion-plus-round"> Nuevo</a> &nbsp;
              <table class="table table-striped table-hover table-bordered">

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Modelo</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($modelos as $index=>$modelo)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$modelo->modelo}}</td>
                      <td>{{$modelo->descripcion}}</td>
                      <td>
                        <a href="{{action('Sombreros\ModeloController@foto',$modelo->id)}}">
                          <img src="/images/modelos/{{$modelo->photo}}" class="img-fluid pull-xs-left rounded" width="25" alt="...">
                        </a>
                      </td>
                      <td>
                        <a href="{{action('Sombreros\ModeloController@ver', $modelo->id)}}" class="ion-eye" title="Ver"></a>
                        <a href="{{action('Sombreros\ModeloController@edit', $modelo->id)}}" class="ion-edit" title="Editar"></a>
                        <a href="{{action('Sombreros\ModeloController@show', $modelo->id)}}" class="ion-android-close" title="Eliminar"></a>
                        <!--<a onclick="Eliminar('{ {$modelos->id}}','{ {$modelos->modelo}}')" class="ion-android-close" title="Eliminar"></a>-->
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="paginacion">
            {!!$modelos->links()!!}
          </div>
        </div>
      </div>
    </div>
  </section>

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
