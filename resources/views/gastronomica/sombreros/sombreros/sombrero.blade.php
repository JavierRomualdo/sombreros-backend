@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">-->
  <link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">
  
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Sombreros /</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h5 fadeIn animated text-center ion-clipboard"> Lista Sombreros</h1>
      </header>
      <!--<center class="fadeIn animated"><img src="/images/sombreros/logo_sombreros.png" width="300" alt="..." class="fadeIn animated"></center>-->
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/sombreros/sombrero/create')}}" class="btn btn-outline-primary margenInf fadeIn animated ion-plus-round btn-sm" title="nuevo sombrero"> Nuevo</a> &nbsp;
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h6 display ion-paperclip fadeIn animated title col-md-4"> Historial:</h2>
            </div>
            <div class="card-block">
              <div class="table-responsive">
                  <table class="table table-striped table-hover table-bordered" id="myTable"><!--table-responsive-->

                    <thead class="thead-inverse">
                      <tr>
                        <th>#</th>
                        <th>Codigo</th>
                        <th>Modelo</th>
                        <th>Tejido</th>
                        <th>Material</th>
                        <th>Público</th>
                        <th>Talla</th>
                        <th>Pr.Venta</th>
                        <th>S.Actual</th>
                        <!--<th>Pedido Reposicion</th>-->
                        <th>Imagen</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sombreros as $index=>$sombrero)
                        <tr class="fadeIn animated">
                          <th scope="row">{{$index+1}}</th>
                          <td>{{$sombrero->codigo}}</td>
                          <td>{{$sombrero->modelo}}</td>
                          <td>{{$sombrero->tejido}}</td>
                          <td>{{$sombrero->material}}</td>
                          <td>{{$sombrero->publico}}</td>
                          <td>{{$sombrero->talla}}</td>
                          <td>S/ {{$sombrero->precio_venta}}</td>
                          <td>{{$sombrero->stock_actual}}</td>
                          <!--<td>{ {$sombrero->pedido_reposicion}}</td>-->
                          <td>
                            <a href="{{action('Sombreros\SombreroController@foto',$sombrero->id)}}">
                              <img src="/images/sombreros/{{$sombrero->photo}}" class="img-fluid pull-xs-left rounded" alt="..." width="28">
                            </a>
                          </td>
                          <td>
                            <a href="{{action('Sombreros\SombreroController@ver', $sombrero->id)}}" class="btn btn-outline-primary btn-xs ion-eye" title="Ver"></a>
                            <a href="{{action('Sombreros\SombreroController@edit', $sombrero->id)}}" class="btn btn-outline-primary btn-xs ion-edit" title="Editar"></a>
                            <a href="{{action('Sombreros\SombreroController@show', $sombrero->id)}}" class="btn btn-outline-primary btn-xs ion-android-delete" title="Eliminar"></a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>

          </div>
        </div>
        <!--<div class="container">
          <div class="paginacion">
            { !!$sombreros->links()!!}
          </div>
        </div>-->
      </div>
    </div>
  </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
  $("#li-home").removeClass('active');
  $("#li-somb").attr('class','active');
    /*$("#a-somb").click(function(){
      alert("sombrero");
      $("#li-somb").attr('class','active');
      $("#li-home").removeClass('active');
      $("#li-somb").attr('class','active');
    });*/

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
