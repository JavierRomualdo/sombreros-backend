@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/materiales/material')}}">Materiales</a></li>
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
              <p>¿Desea eliminar el material de sombrero?.</p>
              {!!Form::open(['action'=>['Sombreros\MaterialController@destroy',$material->id],'method'=>'DELETE'])!!}
              <div class="form-group">
                <label class="form-control-label" for="nombres"><strong>Material:</strong></label>
                <label for="">{!!$material->material!!}</label>
              </div>
              <div class="form-group">
                <label class="form-control-label" for="nombres"><strong>Descripcion:</strong></label>
                <label for="">{!!$material->descripcion!!}</label>
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/sombreros/materiales/material')}}" class="btn btn-outline-primary btn-sm fadeIn animated ion-android-cancel"> Cancelar</a>
                {!!form::submit('Eliminar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Eliminar</span>','class'=>'btn
                  btn-outline-danger btn-sm fadeIn animated'])!!}
              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
