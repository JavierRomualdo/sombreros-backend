@extends('layouts.master')
@section('title','Tejidos')
@section('content')

<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

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
        <h1 class="h2 fadeIn animated text-center ion-clipboard"> Usuarios del Sistema</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/configuracion/usuarios/usuario/create')}}" class="btn btn-primary btn-sm margenInf fadeIn animated ion-plus-round"> Nuevo</a> &nbsp;
      <div class="row">

        <div class="col-lg-12">

          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h5 class="h5 display ion-paperclip fadeIn animated title"> Historial:</h5>
            </div>
            <div class="card-block">
              <table class="table table-striped table-hover table-bordered" id="myTable">

                <thead class="thead-inverse">
                  <tr>
                    <th class="text-center">#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Cargo</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($usuario as $index=>$usuarios)
                    <tr class="fadeIn animated">
                      <th scope="row" class="text-center">{{$index+1}}</th>
                      <td>{{$usuarios->name}}</td>
                      <td>{{$usuarios->email}}</td>
                      <td>{{$usuarios->cargo}}</td>
                      <td class="text-center">
                        <a href="{{action('Usuarios\UsuarioController@foto',$usuarios->id)}}" title="editar foto">
                          <img src="/images/usuarios/{{$usuarios->photo}}" class="img-fluid pull-xs-left rounded" alt="..." width="28">
                        </a>
                      </td>
                      <td class="text-center">
                        <a href="{{action('Usuarios\UsuarioController@edit', $usuarios->id)}}" class="btn btn-outline-primary btn-sm ion-edit" title="Editar"></a>
                        <a href="{{action('Usuarios\UsuarioController@show', $usuarios->id)}}" class="btn btn-outline-primary btn-sm ion-android-delete" title="Eliminar"></a>
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
  <script>
    $(document).ready(function(){
      $('#myTable').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          responsive: true
        },
        scrollY:        '70vh',
        //scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        fixedColumns:   {
          heightMatch: 'none'
        },
        fixedHeader: {
          header: true
        },
        sScrollX: true,
        sScrollXInner: "100%",
      });
    });
  </script>
@endsection
