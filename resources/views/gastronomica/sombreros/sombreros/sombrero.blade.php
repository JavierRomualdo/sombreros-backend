@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Sombreros</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2 fadeIn animated text-center ion-clipboard"> Lista Sombreros</h1>
      </header>
      <!--<center class="fadeIn animated"><img src="/images/sombreros/logo_sombreros.png" width="300" alt="..." class="fadeIn animated"></center>-->
      @include('partials.messages')
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display ion-paperclip fadeIn animated title"> Historial:</h2>
            </div>
            <div class="card-block miTabla">
                <a href="{{url('/gastronomica/sombreros/sombreros/sombrero/create')}}" class="btn btn-outline-primary margenInf fadeIn animated btn-sm"> Nuevo</a> &nbsp;
              <div class="table-responsive">
                  <table class="table table-striped table-hover table-bordered"><!--table-responsive-->

                    <thead class="thead-inverse">
                      <tr>
                        <th>#</th>
                        <th>Codigo</th>
                        <th>Modelo</th>
                        <th>Tejido</th>
                        <th>Material</th>
                        <th>Público</th>
                        <th>Talla</th>
                        <th>Precio Venta</th>
                        <th>Stock Actual</th>
                        <th>Pedido Reposicion</th>
                        <th>Imagen</th>
                        <th>Acción</th>
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
                          <td>{{$sombrero->precio_venta}}</td>
                          <td>{{$sombrero->stock_actual}}</td>
                          <td>{{$sombrero->pedido_reposicion}}</td>
                          <td>
                            <a href="{{action('Sombreros\SombreroController@foto',$sombrero->id)}}">
                              <img src="/images/sombreros/{{$sombrero->photo}}" class="img-fluid pull-xs-left rounded" alt="..." width="28">
                            </a>
                          </td>
                          <td>
                            <a href="{{action('Sombreros\SombreroController@ver',$sombrero->id)}}" class="btn btn-outline-primary btn-sm ion-eye" title="Ver"></a>
                            <a href="{{action('Sombreros\SombreroController@edit', $sombrero->id)}}" class="btn btn-outline-primary btn-sm ion-edit" title="Editar"></a>
                            <a href="{{action('Sombreros\SombreroController@show', $sombrero->id)}}" class="btn btn-outline-primary btn-sm ion-android-delete" title="Eliminar"></a>
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
            {!!$sombreros->links()!!}
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script type="text/javascript">
  $("#li-home").removeClass('active');
  $("#li-somb").attr('class','active');
    /*$("#a-somb").click(function(){
      alert("sombrero");
      $("#li-somb").attr('class','active');
      $("#li-home").removeClass('active');
      $("#li-somb").attr('class','active');
    });*/
  </script>
@endsection
