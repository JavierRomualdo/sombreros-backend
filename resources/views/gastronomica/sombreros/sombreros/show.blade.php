@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/sombreros/sombrero')}}">Sombreros</a></li>
        <li class="breadcrumb-item active">Eliminar Sombrero</li>
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
              {!!Form::open(['action'=>['Sombreros\SombreroController@destroy',$sombrero->id],'method'=>'DELETE','enctype'=>'multipart/form-data'])!!}
              <div class="form-group">
                <strong>{!!form::label('Codigo:',null,['for'=>'codigo'])!!}</strong>
                {!!$sombrero->codigo!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Modelo:')!!}</strong>
                {!!$modelo->modelo!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Tejido:')!!}</strong>
                {!!$tejido->tejido!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Modelo:')!!}</strong>
                {!!$material->material!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Publico Dirigido:')!!}</strong>
                {!!$publicodirigido->publico!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Talla:')!!}</strong>
                {!!$talla->talla!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Proveedor:')!!}</strong>
                {!!$proveedor->empresa!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Precio Compra:')!!}</strong>
                {!!$sombrero->precio_compra!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Precio Venta:')!!}</strong>
                {!!$sombrero->precio_venta!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Stock Actual:')!!}</strong>
                {!!$sombrero->stock_actual!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Stock Maximo:')!!}</strong>
                {!!$sombrero->stock_maximo!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Stock Minimo:')!!}</strong>
                {!!$sombrero->stock_minimo!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Imagen:')!!}</strong>
                <label name="photo" for="">{!!$sombrero->photo!!}</label>
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/sombreros/sombreros/sombrero')}}" class="btn btn-secondary">Cancelar</a>
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
