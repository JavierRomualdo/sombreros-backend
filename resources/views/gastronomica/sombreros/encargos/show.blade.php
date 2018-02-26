@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/encargos/encargo')}}">Encargo</a></li>
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
              <h2 class="h5 display fadeIn animated"><strong style="color:#f00">Eliminar:</strong></h2>
            </div>
            <div class="card-block">
              <p>¿Desea eliminar el encargo?.</p>
              {!!Form::open(['action'=>['Empleados\EncargoController@destroy',$encargo->id],'method'=>'DELETE'])!!}
              <div class="form-group">
                <strong>{!!form::label('Nombre:',null,['for'=>'nombre'])!!}</strong>
                <label for="">{!!$encargo->nombre!!}</label>
              </div>
              <div class="form-group">
                <strong>{!!form::label('Descripcion:')!!}</strong>
                <label for="">{!!$encargo->descripcion!!}</label>
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/sombreros/encargos/encargo')}}" class="btn btn-outline-primary fadeIn animated btn-sm ion-android-cancel"> Cancelar</a>
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
