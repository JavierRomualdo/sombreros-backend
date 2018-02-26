@extends('layouts.master')
@section('title','Materiales')
@section('content')

<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Empleado</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h5 fadeIn animated text-center ion-clipboard fadeIn animated"> Empleados</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/empleados/empleado/create')}}" class="btn btn-outline-primary btn-sm margenInf fadeIn animated ion-plus-round"> Nuevo</a> &nbsp;
      <div class="row">
        <div class="col-lg-12">

          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h6 display ion-paperclip fadeIn animated title"> Historial:</h2>
            </div>
            <div class="card-block">
              
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="myTable">

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Encargo</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Dni</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($empleados as $index=>$empleado)
                    <tr class="fadeIn animated">
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$empleado->encargo}}</td>
                      <td>{{$empleado->nombres}}</td>
                      <td>{{$empleado->apellidos}}</td>
                      <td>{{$empleado->dni}}</td>
                      <td>{{$empleado->direccion}}</td>
                      <td>{{$empleado->telefono}}</td>
                      <td>{{$empleado->email}}</td>
                      <td>
                        <a href="{{action('Empleados\EmpleadoController@edit', $empleado->id)}}" class="btn btn-outline-primary btn-sm ion-edit" title="Editar"></a>
                        <a href="{{action('Empleados\EmpleadoController@show', $empleado->id)}}" class="btn btn-outline-primary btn-sm ion-android-delete" title="Eliminar"></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>

          </div>
        </div>
        <!--<div class="container">
          <div class="paginacion">
            { !!$empleados->links()!!}
          </div>
        </div>-->
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
        }
      });
    });
  </script>
@endsection
