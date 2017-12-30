@extends('layouts.master')
@section('title','Tejidos')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Usuarios</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2">Lista de Usuarios:</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/usuarios/usuario/create')}}" class="btn btn-primary margenInf">Nuevo</a> &nbsp;
      <div class="row">

        <div class="col-lg-12">

          <div class="card miBorder">

            <div class="card-block">
              <table class="table table-striped table-hover table-bordered">

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($usuario as $usuarios)
                    <tr>
                      <th scope="row">{{$usuarios->id}}</th>
                      <td>{{$usuarios->name}}</td>
                      <td>{{$usuarios->email}}</td>
                      <td>
                        <a href="{{action('Usuarios\UsuarioController@edit', $usuarios->id)}}" class="ion-edit" title="Editar"></a>
                        <a href="{{action('Usuarios\UsuarioController@show', $usuarios->id)}}" class="ion-android-close" title="Eliminar"></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
@endsection
