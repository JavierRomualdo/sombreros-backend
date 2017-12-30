@extends('layouts.master')
@section('title','Publico Dirigido')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Público Dirigido</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2">Lista - Público Dirigido:</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/publicodirigido/publicodirigido/create')}}" class="btn btn-primary margenInf">Nuevo</a> &nbsp;

      <div class="row">

        <div class="col-lg-12">

          <div class="card miBorder">

            <div class="card-block">

              <table class="table table-striped table-hover table-bordered">

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
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$publicodirigido->publico}}</td>
                      <td>{{$publicodirigido->descripcion}}</td>
                      <td>
                        <a href="{{action('Sombreros\PublicoDirigidoController@edit', $publicodirigido->id)}}" class="ion-edit" title="Editar"></a>&nbsp;&nbsp;&nbsp;
                        <a href="{{action('Sombreros\PublicoDirigidoController@show', $publicodirigido->id)}}" class="ion-android-close" title="Eliminar"></a>
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
            {!!$publicosdirigido->links()!!}
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

@endsection
