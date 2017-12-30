@extends('layouts.master')
@section('title','Tejidos')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Calidad del Tejido</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2">Lista - Calidad del Tejido:</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/tejidos/tejido/create')}}" class="btn btn-primary margenInf">Nuevo</a> &nbsp;

      <div class="row">

        <div class="col-lg-12">

          <div class="card miBorder">

            <div class="card-block">
              <table class="table table-striped table-hover table-bordered">

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Calidad Tejido</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tejidos as $index=>$tejido)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$tejido->tejido}}</td>
                      <td>{{$tejido->descripcion}}</td>
                      <td>
                        <a href="{{action('Sombreros\TejidoController@foto',$tejido->id)}}">
                          <img src="/images/tejidos/{{$tejido->photo}}" class="img-fluid pull-xs-left rounded" width="25" alt="...">
                        </a>
                      </td>
                      <td>
                        <a href="{{action('Sombreros\TejidoController@ver', $tejido->id)}}" class="ion-eye" title="Ver"></a>
                        <a href="{{action('Sombreros\TejidoController@edit', $tejido->id)}}" class="ion-edit" title="Editar"></a>
                        <a href="{{action('Sombreros\TejidoController@show', $tejido->id)}}" class="ion-android-close" title="Eliminar"></a>
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
            {!!$tejidos->links()!!}
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

@endsection
