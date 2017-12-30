@extends('layouts.master')
@section('title','Tejidos')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Tallas</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2">Lista de Tallas:</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/tallas/talla/create')}}" class="btn btn-primary margenInf">Nuevo</a> &nbsp;

      <div class="row">

        <div class="col-lg-12">

          <div class="card miBorder">

            <div class="card-block">
              <table class="table table-striped table-hover table-bordered">

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Talla</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tallas as $index=>$talla)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$talla->talla}}</td>
                      <td>{{$talla->descripcion}}</td>
                      <td>
                        <a href="{{action('Sombreros\TallaController@edit', $talla->id)}}" class="ion-edit" title="Editar"></a>&nbsp;&nbsp;&nbsp;
                        <a href="{{action('Sombreros\TallaController@show', $talla->id)}}" class="ion-android-close" title="Eliminar"></a>
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
            {!!$tallas->links()!!}
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

@endsection
