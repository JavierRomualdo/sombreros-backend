@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/tejidos/tejido')}}">Calidad tejido</a></li>
        <li class="breadcrumb-item active">Eliminar</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <div class="row">
        <div class="offset-lg-3 col-lg-6">
          <br/>
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip fadeIn animated"><strong style="color:#f00"> Eliminar:</strong></h2>
            </div>
            <div class="card-block">
              <p>¿Desea eliminar la calidad del tejido de sombrero?.</p>
              {!!Form::open(['action'=>['Sombreros\TejidoController@destroy',$tejido->id],'method'=>'DELETE'])!!}
              <div class="form-group">
                <strong>{!!form::label('Calidad Tejido:',null,['for'=>'tejido'])!!}</strong>
                <label for="">{!!$tejido->tejido!!}</label>
              </div>
              <div class="form-group">
                <strong>{!!form::label('Descripcion:')!!}</strong>
                <label for="">{!!$tejido->descripcion!!}</label>
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/sombreros/tejidos/tejido')}}" class="btn btn-outline-primary btn-sm ion-android-cancel fadeIn animated"> Cancelar</a>
                {!!form::submit('Eliminar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Eliminar</span>','class'=>'btn
                  btn-outline-danger btn-sm'])!!}
              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
