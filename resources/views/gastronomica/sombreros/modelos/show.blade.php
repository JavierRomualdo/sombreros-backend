@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/modelos/modelo')}}">Modelos</a></li>
        <li class="breadcrumb-item active">Eliminar Modelo</li>
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
              <p>¿Desea eliminar el modelo de sombrero?.</p>
              {!!Form::open(['action'=>['Sombreros\ModeloController@destroy',$modelo->id],'method'=>'DELETE'])!!}
              <div class="form-group">
                <strong>{!!form::label('Modelo:',null,['for'=>'modelo'])!!}</strong>
                {!!$modelo->modelo!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Descripcion:')!!}</strong>
                {!!$modelo->descripcion!!}
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/sombreros/modelos/modelo')}}" class="btn btn-secondary">Cancelar</a>
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
@endsection
