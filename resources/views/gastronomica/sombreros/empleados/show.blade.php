@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/empleados/empleado')}}">Empleado</a></li>
        <li class="breadcrumb-item active">Eliminar</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <div class="row">
        <div class="offset-lg-1 col-lg-10">
          <br/>
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display ion-paperclip"><strong style="color:#f00"> Eliminar:</strong></h2>
            </div>
            <div class="card-block">
              <p>¿Desea eliminar el empleado?.</p>
              {!!Form::open(['action'=>['Empleados\EmpleadoController@destroy',$empleado->id],'method'=>'DELETE','enctype'=>'multipart/form-data'])!!}
              <div class="form-group row">
                <label class="col-sm-2 form-control-label"><strong>Encargo:</strong></label>
                <div class="col-sm-2">
                  {!!$encargo->nombre!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Nombres:</strong></label>
                <div class="col-sm-2">
                  {!!$empleado->nombres!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Apellidos:</strong></label>
                <div class="col-sm-2">
                  {!!$empleado->apellidos!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label"><strong>Dni:</strong></label>
                <div class="col-sm-2">
                    {!!$empleado->dni!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Direccion:</strong></label>
                <div class="col-sm-2">
                    {!!$empleado->direccion!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Telefono:</strong></label>
                <div class="col-sm-2">
                  {!!$empleado->telefono!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label"><strong>Email:</strong></label>
                <div class="col-sm-2">
                  {!!$empleado->email!!}
                </div>
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/sombreros/empleados/empleado')}}" class="btn btn-outline-primary ion-android-cancel btn-sm"> Cancelar</a>
                {!!form::submit('Eliminar',['name'=>'grabar','class'=>'btn btn-outline-danger btn-sm','id'=>'grabar','content'=>'<span class="ion-android-delete"> Eliminar</span>'])!!}
              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
