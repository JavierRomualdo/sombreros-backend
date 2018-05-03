@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/tejidos/tejido')}}">Calidad tejido</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
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
              <h2 class="h5 display ion-paperclip fadeIn animated"> Nuevo:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos de la nueva calidad del tejido de sombrero.</p>
              {!!Form::open(['action'=>'Sombreros\TejidoController@store','method'=>'POST'])!!}
              <div class="form-group">
                <strong>{!!form::label('Calidad Tejido:',null,['for'=>'tejido'])!!}</strong>
                {!!form::text('tejido', null,['id'=>'tejido','class'=>'form-control','placeholder'=>'Ingrese Tejido', 'autofocus'])!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Codigo:',null,['for'=>'codigo'])!!}</strong>
                {!!form::text('codigo', null,['id'=>'codigo','class'=>'form-control','readonly','placeholder'=>'Elige Codigo','maxlength'=>'3', 'autofocus'])!!}
                <span class="help-block">El código son de 3 caracteres del tejido.</span>
                <div class="i-checks">
                  <input id="checkeditar" type="checkbox" value="" class="form-control-custom">
                  <label for="checkeditar">Editar</label>
                </div>
              </div>
              <div class="form-group">
                <strong>{!!form::label('Descripcion:')!!}</strong>
                {!!form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Digite la Descripcion', 'rows'=>"3", 'cols'=>"8"])!!}
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/sombreros/tejidos/tejido')}}" class="btn btn-outline-primary fadeIn animated btn-sm ion-android-cancel"> Cancelar</a>
                {!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                  btn-outline-success btn-sm'])!!}
              </div>
              {!!Form::close()!!}
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
        $("#codigo").prop("readonly",false);
      } else {
        $("#codigo").prop("readonly",true);
      }
    });
    $("#tejido").keyup(function(e){
      console.log(e);
      var codigo = $("#tejido").val().substring(0,3).toLowerCase();
      
      if(codigo.length>=3){
        $("#codigo").val(codigo);
      } else {
        $("#codigo").val("");
      }
    });
  </script>
@endsection
