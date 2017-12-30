@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/materiales/material')}}">Materiales</a></li>
        <li class="breadcrumb-item active">Nuevo Material</li>
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
          <br/>
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Formulario:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos del nuevo material de sombrero.</p>
              {!!Form::open(['action'=>'Sombreros\MaterialController@store','method'=>'POST'])!!}
              <div class="form-group">
                <strong>{!!form::label('Material:',null,['for'=>'material'])!!}</strong>
                {!!form::text('material', null,['id'=>'material','class'=>'form-control','placeholder'=>'Ingrese Modelo', 'autofocus'])!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Descripcion:')!!}</strong>
                {!!form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Digite la Descripcion', 'rows'=>"3", 'cols'=>"8"])!!}
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/sombreros/materiales/material')}}" class="btn btn-secondary">Cancelar</a>
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
