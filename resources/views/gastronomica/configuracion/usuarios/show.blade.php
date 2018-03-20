@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/configuracion/usuarios/usuario')}}">Usuarios</a></li>
        <li class="breadcrumb-item active">Eliminar Usuario</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <div class="row">
        <div class="offset-lg-3 col-lg-6">
          <br/>
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display"><strong style="color:#f00">Eliminar:</strong></h2>
            </div>
            <div class="card-block">
              <p>¿Desea eliminar la talla de sombrero?.</p>
              {!!Form::open(['action'=>['Usuarios\UsuarioController@destroy',$usuario->id],'method'=>'DELETE'])!!}
              <div class="form-group">
                <strong>{!!form::label('Cargo:',null,['for'=>'cargo'])!!}</strong>
                {!!$cargo->cargo!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Nombre Usuario:')!!}</strong>
                {!!$usuario->name!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Email:')!!}</strong>
                {!!$usuario->email!!}
              </div>
              <!--<div class="form-group">
                <strong>{ !!form::label('Password:')!!}</strong>
                { !!$usuario->password!!}
              </div>-->
              <div class="form-group">
                <a href="{{url('/gastronomica/configuracion/usuarios/usuario')}}" class="btn btn-secondary">Cancelar</a>
                {!!form::submit('Eliminar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Eliminar</span>','class'=>'btn
                  btn-danger'])!!}
              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript">
  $("#li-home").removeClass('active');
  $("#li-somb").attr('class','active');
  </script>
@endsection
