@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/configuracion/temporadas/temporada')}}">Temporadas</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
      </ul>
    </div>
  </div><br/>
  <div class="container-fluid">
    @include('partials.messages')
  </div>
  <section class="forms">
    <div class="container-fluid">
      <div class="row">
        <div class="offset-lg-3 col-lg-6">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Nuevo:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos de la nueva temporada.</p>
              {!!Form::open(['action'=>'Temporada\TemporadaController@store','method'=>'POST'])!!}
              <div class="form-group">
                <strong>{!!form::label('Temporada (*):',null,['for'=>'temporada'])!!}</strong>
                {!!form::text('temporada', null,['id'=>'temporada','class'=>'form-control','placeholder'=>'Ingrese Temporada', 'autofocus'])!!}
              </div>
              <div class="form-group">
                <label class="form-control-label" for="fecha_inicio"><strong>Fecha Inicio (*):</strong></label>
                {!!Form::date('fecha_inicio', null,['id'=>'fecha_inicio','name'=>'fecha_inicio','class'=>'form-control'])!!}
              </div>
              <div class="form-group">
                <label class="form-control-label" for="fecha_fin"><strong>Fecha Inicio (*):</strong></label>
                {!!Form::date('fecha_fin', null,['id'=>'fecha_fin','name'=>'fecha_fin','class'=>'form-control'])!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Descripcion:')!!}</strong>
                {!!form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Digite la Descripcion', 'rows'=>"3", 'cols'=>"8"])!!}
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/configuracion/temporadas/temporada')}}" class="btn btn-outline-primary btn-sm ion-android-cancel fadeIn animated"> Cancelar</a>
                {!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                  btn-outline-success btn-sm fadeIn animated'])!!}
              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
