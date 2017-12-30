@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/usuarios/usuario')}}">Usuarios</a></li>
        <li class="breadcrumb-item active">Nuevo Usuario</li>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    @include('partials.messages')
  </div>
  <section class="forms">
    <div class="container-fluid">
      <div class="row">
        <div class="offset-lg-3 col-lg-5">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Formulario:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos del nuevo usuario del sistema.</p>
              {!!Form::open(['action'=>'Usuarios\UsuarioController@store','method'=>'POST'])!!}
              <div class="form-group">
                <label class="form-control-label" for="idCargo"><strong>Cargo:</strong></label>
                {!!Form::select('idCargo',$cargos, null,['id'=>'idCargo','name'=>'idCargo','class'=>'form-control','autofocus'])!!}
              </div>
              <div class="form-group">
                <label class="form-control-label" for="name"><strong>Nombre Usuario:</strong></label>
                {!!form::text('name', null,['id'=>'name','class'=>'form-control','placeholder'=>'Ingrese Nombre'])!!}
              </div>
              <div class="form-group">
                <label class="form-control-label" for="email"><strong>Email:</strong></label>
                {!!form::text('email', null,['id'=>'email','class'=>'form-control','placeholder'=>'Ingrese Email'])!!}
              </div>
              <div class="form-group">
                <label class="form-control-label" for="password"><strong>Password:</strong></label>
                {!!form::password('password',['id'=>'password','class'=>'form-control','placeholder'=>'Password ...'])!!}
              </div>
              <div class="form-group">
                <label class="form-control-label" for="password"><strong>Password confirmed:</strong></label>
                {!!form::password('password_confirmation',['id'=>'password-confirm','class'=>'form-control','placeholder'=>'Password ...'])!!}
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/usuarios/usuario')}}" class="btn btn-secondary">Cancelar</a>
                {!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                  btn-primary'])!!}
              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
