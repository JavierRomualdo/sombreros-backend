@extends('layouts.master')
@section('title','Materiales')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Comision Empleado</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2 fadeIn animated text-center ion-clipboard"> Comision de los empleados</h1>
      </header>
      @include('partials.messages')
      <div class="row">
        <div class="col-lg-12">

          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h1 display ion-paperclip fadeIn animated title"> Historial:</h2>
            </div>
            <div class="card-block">
              <a href="{{url('/gastronomica/sombreros/comisionempleado/comision/create')}}" class="btn btn-outline-primary btn-sm margenInf fadeIn animated ion-plus-round"> Nuevo</a> &nbsp;
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Empleado</th>
                    <th>Ocupacion</th>
                    <th>Articulo</th>
                    <th>Foto</th>
                    <th>Precio Venta</th>
                    <th>Comision (%)</th>
                    <th>Comision (S/)</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($comisiones as $index=>$comision)
                    <tr class="fadeIn animated">
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$comision->nombres}}</td>
                      <td>{{$comision->nombre}}</td>
                      <td>{{$comision->codigo}}</td>
                      <td>
                        <img src="/images/sombreros/{{$comision->photo}}" class="img-fluid pull-xs-left rounded" alt="..." width="28">
                      </td>
                      <td>{{$comision->precio_venta}}</td>
                      <td>{{$comision->porcentaje}} %</td>
                      <td>S/. {{$comision->porcentaje/100.00 * $comision->precio_venta}}</td>
                      <td>{{$comision->descripcion}}</td>
                      <td>
                        <a href="{{action('Empleados\EmpleadoComisionController@edit', $comision->id)}}" class="btn btn-outline-primary btn-sm ion-edit" title="Editar"></a>
                        <a href="{{action('Empleados\EmpleadoComisionController@show', $comision->id)}}" class="btn btn-outline-primary btn-sm ion-android-delete" title="Eliminar"></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>

          </div>
        </div>
        <div class="container">
          <div class="paginacion">
            {!!$comisiones->links()!!}
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

@endsection
