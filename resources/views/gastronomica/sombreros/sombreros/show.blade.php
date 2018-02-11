@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/sombreros/sombrero')}}">Sombreros</a></li>
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
              <p>¿Desea eliminar la talla de sombrero?.</p>
              {!!Form::open(['action'=>['Sombreros\SombreroController@destroy',$sombrero->id],'method'=>'DELETE','enctype'=>'multipart/form-data'])!!}
              <div class="form-group row">
                <label class="col-sm-2 form-control-label"><strong>Codigo:</strong></label>
                <div class="col-sm-2">
                  {!!$sombrero->codigo!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Modelo:</strong></label>
                <div class="col-sm-2">
                  {!!$modelo->modelo!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Tejido:</strong></label>
                <div class="col-sm-2">
                  {!!$tejido->tejido!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label"><strong>Material:</strong></label>
                <div class="col-sm-2">
                    {!!$material->material!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Publico Dirigido:</strong></label>
                <div class="col-sm-2">
                    {!!$publicodirigido->publico!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Talla:</strong></label>
                <div class="col-sm-2">
                  {!!$talla->talla!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label"><strong>Precio Compra:</strong></label>
                <div class="col-sm-2">
                  {!!$sombrero->precio_compra!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Stock Actual:</strong></label>
                <div class="col-sm-2">
                  {!!$sombrero->stock_actual!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Stock Maximo:</strong></label>
                <div class="col-sm-2">
                  {!!$sombrero->stock_maximo!!}
                </div>
              </div>
              <!--<div class="form-group">
                <strong>{ !!form::label('Proveedor:')!!}</strong>
                { !!$proveedor->empresa!!}
              </div>-->
              <!--<div class="form-group">
                <strong>{ !!form::label('Precio Venta:')!!}</strong>
                { !!$sombrero->precio_venta!!}
              </div>-->
              <div class="form-group row">
                <label class="col-sm-2 form-control-label"><strong>Stock Minimo:</strong></label>
                <div class="col-sm-2">
                  {!!$sombrero->stock_minimo!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Imagen:</strong></label>
                <div class="col-sm-2">
                  <label name="photo" for="">{!!$sombrero->photo!!}</label>
                </div>
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/sombreros/sombreros/sombrero')}}" class="btn btn-outline-primary ion-android-cancel btn-sm"> Cancelar</a>
                {!!form::submit('Eliminar',['name'=>'grabar','class'=>'btn btn-outline-danger btn-sm','id'=>'grabar','content'=>'<span class="ion-android-delete"> Eliminar</span>'])!!}
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
