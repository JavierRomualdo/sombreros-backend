@extends('layouts.master')
@section('title','Materiales')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Materiales</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2 fadeIn animated text-center ion-clipboard"> Materiales</h1>
      </header>
      @include('partials.messages')
      <div class="row">
        <div class="col-lg-12">

          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h1 display ion-paperclip fadeIn animated title"> Historial:</h2>
            </div>
            <div class="card-block">
              <a href="{{url('/gastronomica/sombreros/materiales/material/create')}}" class="btn btn-outline-primary btn-sm margenInf fadeIn animated ion-plus-round"> Nuevo</a> &nbsp;
              <table class="table table-striped table-hover table-bordered">

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Material</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($materiales as $index=>$material)
                    <tr class="fadeIn animated">
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$material->material}}</td>
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
