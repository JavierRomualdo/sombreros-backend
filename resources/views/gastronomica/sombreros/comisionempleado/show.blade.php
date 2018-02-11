@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/comisionempleado/comision')}}">Comision Empleado</a></li>
        <li class="breadcrumb-item active">Eliminar</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <div class="row">
        <div class="offset-lg-1 col-lg-10">
          <br/>
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display ion-paperclip"><strong style="color:#f00"> Eliminar:</strong></h2>
            </div>
            <div class="card-block">
              <p>¿Desea eliminar la comision del empleado?.</p>
              {!!Form::open(['action'=>['Empleados\EmpleadoComisionController@destroy',$comision->id],'method'=>'DELETE','enctype'=>'multipart/form-data'])!!}
              <div class="form-group row">
                <label class="col-sm-2 form-control-label"><strong>Empleado:</strong></label>
                <div class="col-sm-2">
                  {!!$comision->nombres!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Ocupacion:</strong></label>
                <div class="col-sm-2">
                  {!!$comision->nombre!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Articulo:</strong></label>
                <div class="col-sm-2">
                  {!!$comision->codigo!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label"><strong>Foto:</strong></label>
                <div class="col-sm-2">
                  {!!$comision->photo!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Precio Venta:</strong></label>
                <div class="col-sm-2">
                    {!!$comision->precio_venta!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Comision (%):</strong></label>
                <div class="col-sm-2">
                    {!!$comision->porcentaje!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label"><strong>Comision (S/.):</strong></label>
                <div class="col-sm-2">
                  {!!$comision->precio_venta*($comision->porcentaje/100.00)!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Descripcion:</strong></label>
                <div class="col-sm-2">
                  {!!$comision->descripcion!!}
                </div>
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/sombreros/comisionempleado/comision')}}" class="btn btn-outline-primary ion-android-cancel btn-sm"> Cancelar</a>
                {!!form::submit('Eliminar',['name'=>'grabar','class'=>'btn btn-outline-danger btn-sm','id'=>'grabar','content'=>'<span class="ion-android-delete"> Eliminar</span>'])!!}
              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
