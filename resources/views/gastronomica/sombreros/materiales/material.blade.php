@extends('layouts.master')
@section('title','Materiales')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Materiales</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2">Lista de Materiales:</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/materiales/material/create')}}" class="btn btn-primary margenInf">Nuevo</a> &nbsp;

      <div class="row">
        <div class="col-lg-12">

          <div class="card miBorder">

            <div class="card-block">
              <table class="table table-striped table-hover table-bordered">

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Material</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Operaciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($materiales as $index=>$material)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$material->material}}</td>
                      <td>{{$material->descripcion}}</td>
                      <td>
                        <a href="{{action('Sombreros\MaterialController@foto',$material->id)}}">
                          <img src="/images/materiales/{{$material->photo}}" class="img-fluid pull-xs-left rounded" width="25" alt="...">
                        </a>
                      </td>
                      <td>
                        <a href="{{action('Sombreros\MaterialController@ver', $material->id)}}" class="ion-eye" title="Ver"></a>
                        <a href="{{action('Sombreros\MaterialController@edit', $material->id)}}" class="ion-edit" title="Editar"></a>
                        <a href="{{action('Sombreros\MaterialController@show', $material->id)}}" class="ion-android-close" title="Eliminar"></a>
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
            {!!$materiales->links()!!}
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

@endsection
