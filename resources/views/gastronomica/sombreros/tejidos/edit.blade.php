@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/tejidos/tejido')}}">Calidad del Tejido</a></li>
        <li class="breadcrumb-item active">Editar Calidad del Tejido</li>
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
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Formulario:</h2>
            </div>
            <div class="card-block">
              <p>Edite los datos de la calidad del tejido de sombrero.</p>
              {!!Form::model($tejido, ['action'=>['Sombreros\TejidoController@update',$tejido->id],'method'=>'PUT'])!!}
              <div class="form-group">
                <strong>{!!form::label('Calidad Tejido:',null,['for'=>'tejido'])!!}</strong>
                {!!form::text('tejido', null,['id'=>'tejido','class'=>'form-control','placeholder'=>'Ingrese Modelo', 'autofocus'])!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Descripcion:')!!}</strong>
                {!!form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Digite la Descripcion', 'rows'=>"3", 'cols'=>"8"])!!}
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/sombreros/tejidos/tejido')}}" class="btn btn-secondary">Cancelar</a>
                {!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                  btn-primary'])!!}
              </div>
              {!!Form::close()!!}
              <form>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
