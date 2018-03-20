@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/modelos/modelo')}}">Modelos</a></li>
        <li class="breadcrumb-item active">Editar</li>
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
              <p>Edite los datos del modelo de sombrero.</p>
              {!!Form::model($modelo, ['action'=>['Sombreros\ModeloController@update',$modelo->id],'method'=>'PUT'])!!}
              <div class="form-group">
                <strong>{!!form::label('Modelo:',null,['for'=>'modelo'])!!}</strong>
                {!!form::text('modelo', null,['id'=>'modelo','class'=>'form-control','placeholder'=>'Ingrese Modelo', 'autofocus'])!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Codigo:',null,['for'=>'codigo'])!!}</strong>
                {!!form::text('codigo', null,['id'=>'codigo','class'=>'form-control','readonly','placeholder'=>'Elige Codigo', 'autofocus'])!!}
                <span class="help-block">El código son de 3 caracteres del modelo.</span>
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
                <a href="{{url('/gastronomica/sombreros/modelos/modelo')}}" class="btn btn-outline-primary btn-sm fadeIn animated ion-android-cancel"> Cancelar</a>
                {!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
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
        $("#codigo").prop("readonly",false);
      } else {
        $("#codigo").prop("readonly",true);
      }
    });
    $("#modelo").keyup(function(e){
      console.log(e);
      var codigo = $("#modelo").val().substring(0,3).toLowerCase();
      
      if(codigo.length>=3){
        $("#codigo").val(codigo);
      } else {
        $("#codigo").val("");
      }
    });
  </script>
@endsection
