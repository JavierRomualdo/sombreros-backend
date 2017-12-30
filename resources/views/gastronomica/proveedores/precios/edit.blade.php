@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/proveedores/precios/precios')}}">Precios</a></li>
        <li class="breadcrumb-item active">Nuevo Precio</li>
      </ul>
    </div>
  </div></br>
  <div class="container-fluid">
    @include('partials.messages')
  </div>
  <section class="forms">
    <div class="container-fluid">
      {!!Form::model($proveedorprecio, ['action'=>['Proveedores\PreciosController@update',$proveedorprecio->id],'method'=>'PUT'])!!}
      <!--Panel superior-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display">Opciones:</h2>
            </div>
            <div class="card-block">
              <div class="form-inline">
                <div class="form-group">
                  <label class="form-control-label mx-sm-3" for="idTipoMovimiento"><strong>Proveedor:</strong></label>
                  {!!Form::select('idProveedor',$proveedor, null,['id'=>'idProveedor','name'=>'idProveedor','class'=>'mx-sm-4 form-control','autofocus'])!!}
                </div>
                <div class="form-group">
                  <label class="form-control-label mx-sm-3"><strong>Tipo Busqueda:</strong></label>
                  <div class="i-checks mx-sm-2">
                    <input id="radioCodigo" type="radio" checked="" value="option1" name="a" class="opcion form-control-custom radio-custom">
                    <label for="radioCodigo">Código</label>
                  </div>
                  <div class="i-checks mx-sm-2">
                    <input id="radioModelo" type="radio" value="option2" name="a" class="opcion form-control-custom radio-custom">
                    <label for="radioModelo">Modelos</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="precio_compra" class="form-control-label mx-sm-3"><strong>Precio:</strong></label>
                  {!!form::text('precio', null,['id'=>'precio_compra','name'=>'precio_compra','class'=>'form-control mx-sm-3'])!!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Panel del centro-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Formulario:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos del nuevo modelo de sombrero.</p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="codigo"><strong>Codigo:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('codigo', $sombrero->codigo,['id'=>'codigo','name'=>'codigo','class'=>'form-control'])!!}
                  <span class="help-block-none">Nota: El código son de 13 caracteres.</span>
                </div>
                <label class="col-sm-2 form-control-label" for="idModelo"><strong>Modelo:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idModelo',$modelo, $sombrero->idModelo,['id'=>'idModelo','name'=>'idModelo','class'=>'form-control','disabled'=>''])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="idTejido"><strong>Tejido:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idTejido',$tejido, $sombrero->idTejido,['id'=>'idTejido','name'=>'idTejido','class'=>'form-control','disabled'=>''])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="idMaterial"><strong>Material:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idMaterial',$material, $sombrero->idMateril,['id'=>'idMaterial','name'=>'idMaterial','class'=>'form-control','disabled'=>''])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="idPublicoDirigido"><strong>Publico Dirigido:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idPublicoDirigido',$publicodirigido, $sombrero->idPublicoDirigido,['id'=>'idPublicoDirigido','name'=>'idPublicoDirigido','class'=>'form-control','disabled'=>''])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="idTalla"><strong>Talla:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idTalla',$talla, $sombrero->idTalla,['id'=>'idTalla','name'=>'idTalla','class'=>'form-control','disabled'=>''])!!}
                </div>
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/sombreros/movimientos/movimiento')}}" class="btn btn-secondary">Cancelar</a>
                {!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                  btn-primary'])!!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {!!Form::close()!!}

  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script type="text/javascript">
    var modelo_id = 0;
    var tejido_id = 0;
    var material_id = 0;
    var publico_id = 0;
    var talla_id = 0;
    var codSombrero = "";
    $("#idModelo").change(function(e){
      console.log(e);
      modelo_id = e.target.value;
      mostrarAjax();
    });
    $("#idTejido").change(function(e){
      console.log(e);
      tejido_id = e.target.value;
      mostrarAjax();
    });
    $("#idMaterial").change(function(e){
      console.log(e);
      material_id = e.target.value;
      mostrarAjax();
    });
    $("#idPublicoDirigido").change(function(e){
      console.log(e);
      publico_id = e.target.value;
      mostrarAjax();
    });
    $("#idTalla").change(function(e){
      console.log(e);
      talla_id = e.target.value;
      mostrarAjax();
    });

    function mostrarAjax(){
      if (modelo_id!=0 && tejido_id!=0 && material_id!=0 &&
          publico_id!=0 && talla_id!=0) {
            $.get('/ajax-pago/'+modelo_id+'/'+tejido_id+'/'+material_id+'/'+publico_id+'/'+talla_id, function(data){
              //success
              $.each(data, function(index, cuentaObj){
                $("#codigo").val(cuentaObj.codigo);
              });
            });
      } else {
        $("#codigo").val("");
      }
    }

    function limpiar() {
      $("#codigo").val("");
      $("#idModelo").val(0);
      $("#idTejido").val(0);
      $("#idMaterial").val(0);
      $("#idPublicoDirigido").val(0);
      $("#idTalla").val(0);

      modelo_id = 0;
      tejido_id = 0;
      material_id = 0;
      publico_id = 0;
      talla_id = 0;
      codSombrero = "";
    }

    //Cambiar los estados del radio button
    $(".opcion").change(function(){
      if ($("#radioModelo").is(":checked")) {
        limpiar();
        $("#codigo").prop("readonly",true);//no se puede escribir
        //combos
        $("#idModelo").removeAttr("disabled");
        $("#idTejido").removeAttr("disabled");
        $("#idMaterial").removeAttr("disabled");
        $("#idPublicoDirigido").removeAttr("disabled");
        $("#idTalla").removeAttr("disabled");
      } else{//POR CODIGO
        //mostrarDatosEnCombos();
        limpiar();
        $("#codigo").prop("readonly",false);
        $("#idModelo").prop('disabled', 'disabled');
        $("#idTejido").prop('disabled', 'disabled');
        $("#idMaterial").prop('disabled', 'disabled');
        $("#idPublicoDirigido").prop('disabled', 'disabled');
        $("#idTalla").prop('disabled', 'disabled');
      }
    });

    $("#codigo").keyup(function(e){
      console.log(e);
      if ($("#codigo").val().length==13) {
        codSombrero = $("#codigo").val();
        $.get('/ajax-som/'+codSombrero, function(data){
          $.each(data, function(index, sombrero){
            modelo_id = sombrero.idModelo;
            tejido_id = sombrero.idTejido;
            material_id = sombrero.idMaterial;
            publico_id = sombrero.idPublicoDirigido;
            talla_id = sombrero.idTalla;
            if (modelo_id!=0 && tejido_id!=0 && material_id!=0 &&
                publico_id!=0 && talla_id!=0) {
                  $("#idModelo").val(modelo_id);
                  $("#idTejido").val(tejido_id);
                  $("#idMaterial").val(material_id);
                  $("#idPublicoDirigido").val(publico_id);
                  $("#idTalla").val(talla_id);

                  $('#idModelo option[value="'+modelo_id+'"]').attr('selected','selected');
                  $('#idTejido option[value="'+tejido_id+'"]').attr('selected','selected');
                  $('#idMaterial option[value="'+material_id+'"]').attr('selected','selected');
                  $('#idPublicoDirigido option[value="'+publico_id+'"]').attr('selected','selected');
                  $('#idTalla option[value="'+talla_id+'"]').attr('selected','selected');
                  $("#precio").val("");
            }
          });
        });
      } else {
        $("#idModelo").val(0);
        $("#idTejido").val(0);
        $("#idMaterial").val(0);
        $("#idPublicoDirigido").val(0);
        $("#idTalla").val(0);
      }
    });
  </script>
  @endsection
