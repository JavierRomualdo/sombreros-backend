@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/sombreros/sombrero')}}">Sombreros</a></li>
        <li class="breadcrumb-item active">Nuevo Sombrero</li>
      </ul>
    </div>
  </div><br/>
  <div class="container-fluid">
    @include('partials.messages')
  </div>
  <section class="forms">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12"><!--offset-lg-3 col-lg-6-->
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Formulario:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos del nuevo modelo de sombrero.</p>
              {!!Form::open(['action'=>'Sombreros\SombreroController@store','method'=>'POST'])!!}
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="codigo"><strong>Codigo:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('codigo', null,['id'=>'codigo','class'=>'form-control','placeholder'=>'Codigo de Sombrero', 'autofocus','readonly'=>'','maxlength'=>'13'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="idModelo"><strong>Modelo:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idModelo',$modelo, null,['id'=>'idModelo','name'=>'idModelo','class'=>'form-control'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="idTejido"><strong>Tejido:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idTejido',$tejido, null,['id'=>'idTejido','name'=>'idTejido','class'=>'form-control'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="idMaterial"><strong>Material:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idMaterial',$material, null,['id'=>'idMaterial','name'=>'idMaterial','class'=>'form-control'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="idPublicoDirigido"><strong>Publico Dirigido:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idPublicoDirigido',$publicodirigido, null,['id'=>'idPublicoDirigido','name'=>'idPublicoDirigido','class'=>'form-control'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="idTalla"><strong>Talla:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idTalla',$talla, null,['id'=>'idTalla','name'=>'idTalla','class'=>'form-control'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="stock_minimo"><strong>Stock Minimo:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('stock_minimo', null,['id'=>'stock_minimo','class'=>'form-control','placeholder'=>'Stock Minimo','maxlength'=>'7',
                    'onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="stock_maximo"><strong>Stock Maximo:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('stock_maximo', null,['id'=>'stock_maximo','class'=>'form-control','placeholder'=>'Stock Maximo','maxlength'=>'7',
                    'onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="precio_venta"><strong>Precio Venta:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('precio_venta', null,['id'=>'precio_venta','class'=>'form-control','placeholder'=>'Precio Venta','maxlength'=>'7'])!!}
                </div>
                <div class="col-sm-6">
                  <a href="{{url('/gastronomica/sombreros/sombreros/sombrero')}}" class="btn btn-secondary">Cancelar</a>
                  {!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                    btn-primary'])!!}
                </div>
              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script type="text/javascript">
    var cod = "";
    var modelo_id = $("#idModelo").val();
    var tejido_id = $("#idTejido").val();
    var material_id = $("#idMaterial").val();
    var publico_id = $("#idPublicoDirigido").val();
    var talla_id = $("#idTalla").val();
    var modelo = "";
    var tejido = "";
    var material = "";
    var publico = "";
    var talla = "";
    $("#idModelo").change(function(e){
      console.log(e);
      modelo_id = e.target.value;
      mostrarCodigo();
    });
    $("#idTejido").change(function(e){
      console.log(e);
      tejido_id = e.target.value;
      mostrarCodigo();
    });
    $("#idMaterial").change(function(e){
      console.log(e);
      material_id = e.target.value;
      mostrarCodigo();
    });
    $("#idPublicoDirigido").change(function(e){
      console.log(e);
      publico_id = e.target.value;
      mostrarCodigo();
    });
    $("#idTalla").change(function(e){
      console.log(e);
      talla_id = e.target.value;
      mostrarCodigo();
    });

    function mostrarCodigo() {
      if (modelo_id!=0) {
        modelo = $("#idModelo option[value='"+modelo_id+"']").text();
        cod = cod + modelo.substring(0,3);
      } else {
        modelo = "";
        cod = cod + modelo;
      }
      if (tejido_id!=0) {
        tejido = $("#idTejido option[value='"+tejido_id+"']").text();
        cod = cod + tejido.substring(0,3);
      } else {
        tejido = "";
        cod = cod +tejido;
      }
      if (material_id!=0) {
        material = $("#idMaterial option[value='"+material_id+"']").text();
        cod = cod + material.substring(0,3);
      } else {
        material = "";
        cod = cod + material;
      }
      if (publico_id!=0) {
        publico = $("#idPublicoDirigido option[value='"+publico_id+"']").text();
        cod = cod + publico.substring(0,3);
      } else {
        publico = "";
        cod = cod + publico;
      }
      if (talla_id!=0) {
        talla = $("#idTalla option[value='"+talla_id+"']").text();
        cod = cod + talla.substring(0,1);
      } else {
        talla = "";
        cod = cod + talla;
      }
      $("#codigo").val(cod.toLowerCase());
      cod="";
    }
    /*$('#checkeditar').click(function() {
        if ($(this).is(':checked')) {
          $("#codigo").prop("readonly",false);
        } else {
          $("#codigo").prop("readonly",true);
        }
    });*/
  </script>

  <script type="text/javascript">
    /* show file value after file select */
    $('.custom-file-input').on('change',function(e){
    $(this).next('.form-control-file').addClass("selected").html($(this).val());
    })

    /* method 2 - change file input to text input after selection
    $('.custom-file-input').on('change',function(){
      var fileName = $(this).val();
      $(this).next('.form-control-file').hide();
      $(this).toggleClass('form-control custom-file-input').attr('type','text').val(fileName);
    })
    */
  </script>
  <script type="text/javascript">
  $("#li-home").removeClass('active');
  $("#li-somb").attr('class','active');
  </script>
@endsection
