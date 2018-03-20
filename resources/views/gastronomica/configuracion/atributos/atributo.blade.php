@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Atributos</li>
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
              <h2 class="h5 display ion-paperclip fadeIn animated"> Editar:</h2>
            </div>
            <div class="card-block">
              <p>Edite los datos para el calculo precio venta de sombreros.</p>
              <div class="i-checks">
                  <input id="checkeditar" type="checkbox" value="" class="form-control-custom">
                  <label for="checkeditar">Editar</label>
                </div>
              {!!Form::model($atributos, ['action'=>['Sombreros\AtributosController@update',$atributos->id],'method'=>'PUT'])!!}
              <div class="form-group">
                <strong>{!!form::label('Igv (%):',null,['for'=>'igv'])!!}</strong>
                {!!form::text('igv', null,['id'=>'igv','class'=>'form-control','placeholder'=>'Ingrese Igv', 'autofocus','readonly'])!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Margen Ganancia (%):',null,['for'=>'margenganancia'])!!}</strong>
                {!!form::text('margenganancia', null,['id'=>'margenganancia','class'=>'form-control','placeholder'=>'Ingrese Margen ganancia', 'autofocus','readonly'])!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Margen Ganancia (%):',null,['for'=>'gastosservicios'])!!}</strong>
                {!!form::text('gastosservicios', null,['id'=>'gastosservicios','class'=>'form-control','placeholder'=>'Ingrese Gastos Servicios', 'autofocus','readonly'])!!}
              </div>
              <div class="form-group">
                <!--<a href="{ {url('/gastronomica/configuracion/atributos/atributo')}}" class="btn btn-outline-primary btn-sm fadeIn animated ion-android-cancel"> Cancelar</a>-->
                {!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','disabled','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                  btn-outline-success btn-sm fadeIn animated'])!!}
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
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script>
    $('#checkeditar').click(function() {
      if ($(this).is(':checked')) {
        $("#igv").prop("readonly",false);
        $("#margenganancia").prop("readonly",false);
        $("#gastosservicios").prop("readonly",false);
        $("#grabar").prop("disabled",false);
      } else {
        $("#igv").prop("readonly",true);
        $("#margenganancia").prop("readonly",true);
        $("#gastosservicios").prop("readonly",true);
        $("#grabar").prop("disabled",true);        
      }
    });
  </script>
@endsection
