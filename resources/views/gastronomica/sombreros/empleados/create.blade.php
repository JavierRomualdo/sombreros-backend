@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/empleados/empleado')}}">Empleado</a></li>
        <li class="breadcrumb-item active"> Nuevo</li>
      </ul>
    </div>
  </div><br/>
  <div class="container-fluid">
    @include('partials.messages')
  </div>
  <section class="forms">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12"><!--offset-lg-3 col-lg-6-->
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Nuevo:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos para el nuevo empleado.</p>
              {!!Form::open(['action'=>'Empleados\EmpleadoController@store','method'=>'POST'])!!}
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="idEncargo"><strong>Encargo (*):</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idEncargo',$encargo, null,['id'=>'idEncargo','name'=>'idEncargo','class'=>'form-control'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Nombres (*):</strong></label>
                <div class="col-sm-4">
                  {!!form::text('nombres', null,['id'=>'nombres','class'=>'form-control','placeholder'=>'Ingrese Nombres'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="apellidos"><strong>Apellidos (*):</strong></label>
                <div class="col-sm-4">
                  {!!form::text('apellidos', null,['id'=>'apellidos','class'=>'form-control','placeholder'=>'Ingrese Apellidos'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="dni"><strong>Dni (*):</strong></label>
                <div class="col-sm-4">
                  {!!form::text('dni', null,['id'=>'dni','class'=>'form-control','placeholder'=>'Ingrese Dni'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="direccion"><strong>Direccion:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('direccion', null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Ingrese Direccion'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="direccion"><strong>Telefono (*):</strong></label>
                <div class="col-sm-4">
                  {!!form::text('telefono', null,['id'=>'telefono','class'=>'form-control','placeholder'=>'Ingrese Telefono'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="email"><strong>Email:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('email', null,['id'=>'email','class'=>'form-control','placeholder'=>'Ingreso Email'])!!}
                </div>
                <div class="col-sm-6">
                  <a href="{{url('/gastronomica/sombreros/empleados/empleado')}}" class="btn btn-outline-primary ion-android-cancel btn-sm"> Cancelar</a>
                  {!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>',
                  'class'=>'btn btn-outline-success ion-ios-checkmark-outline btn-sm'])!!}
                </div>
              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>
      <!---->
    </div>
  </section>
@endsection
