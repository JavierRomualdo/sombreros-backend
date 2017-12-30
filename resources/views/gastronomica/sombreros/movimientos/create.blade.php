@extends('layouts.master')
@section('title','nuevoMovimiento')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/movimientos/movimiento')}}">Movimientos</a></li>
        <li class="breadcrumb-item active">Nuevo movimiento</li>
      </ul>
    </div>
  </div><br/>
  <div class="container-fluid">
    @include('partials.messages')
  </div>
  <section class="forms">
    <div class="container-fluid">
      {!!Form::open(['action'=>'Sombreros\MovimientoController@store','method'=>'POST'])!!}
      <br/>
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display">Opciones:</h2>
            </div>
            <div class="card-block">
              <div class="form-inline">
                <div class="form-group">
                  <label class="form-control-label mx-sm-3" for="idTipoMovimiento"><strong>Tipo Movimiento:</strong></label>
                  {!!Form::select('idTipoMovimiento',$tipomovimiento, null,['id'=>'idTipoMovimiento','name'=>'idTipoMovimiento','class'=>'mx-sm-4 form-control','autofocus'])!!}
                </div>
                <div class="form-group">
                  <label class="form-control-label mx-sm-4"><strong>Tipo Busqueda:</strong></label>
                  <div class="i-checks mx-sm-4">
                    <input id="radioCodigo" type="radio" checked="" value="option1" name="a" class="opcion form-control-custom radio-custom">
                    <label for="radioCodigo">Código</label>
                  </div>
                  <div class="i-checks mx-sm-4">
                    <input id="radioModelo" type="radio" value="option2" name="a" class="opcion form-control-custom radio-custom">
                    <label for="radioModelo">Modelos</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Formulario:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos del nuevo modelo de sombrero.</p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="fecha"><strong>Fecha:</strong></label>
                <div class="col-sm-4">
                  {!!Form::date('fecha', \Carbon\Carbon::now(),['name'=>'fecha','class'=>'form-control','readonly'=>''])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="codigo"><strong>Codigo:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('codigo', null,['id'=>'codigo','name'=>'codigo','class'=>'form-control'])!!}
                  <span class="help-block-none">Nota: El código son de 13 caracteres.</span>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="idModelo"><strong>Modelo:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idModelo',$modelo, null,['id'=>'idModelo','name'=>'idModelo','class'=>'form-control','disabled'=>''])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="idTejido"><strong>Tejido:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idTejido',$tejido, null,['id'=>'idTejido','name'=>'idTejido','class'=>'form-control','disabled'=>''])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="idMaterial"><strong>Material:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idMaterial',$material, null,['id'=>'idMaterial','name'=>'idMaterial','class'=>'form-control','disabled'=>''])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="idPublicoDirigido"><strong>Publico Dirigido:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idPublicoDirigido',$publicodirigido, null,['id'=>'idPublicoDirigido','name'=>'idPublicoDirigido','class'=>'form-control','disabled'=>''])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="idTalla"><strong>Talla:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idTalla',$talla, null,['id'=>'idTalla','name'=>'idTalla','class'=>'form-control','disabled'=>''])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="idProveedor"><strong>Proveedor:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idProveedor',$proveedor, null,['id'=>'idProveedor','name'=>'idProveedor','class'=>'form-control','disabled'=>''])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="cantidad"><strong>Cantidad:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('cantidad', null,['id'=>'cantidad','name'=>'cantidad','class'=>'form-control','placeholder'=>'Ingrese Cantidad'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="stock_actual"><strong>Stock Actual:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('stock_actual', null,['id'=>'stock_actual','name'=>'stock_actual','class'=>'form-control','readonly'=>''])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="precio" id="precio_txt"><strong>Precio Unitario:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('precio', null,['id'=>'precio','name'=>'precio','class'=>'form-control'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="precio_total"><strong>Precio Total:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('precio_total', null,['id'=>'precio_total','name'=>'precio_total','class'=>'form-control','readonly'=>''])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="descripcion"><strong>Descripcion:</strong></label>
                <div class="col-sm-4">
                  {!!form::textarea('descripcion',null,['id'=>'descripcion','name'=>'descripcion','class'=>'form-control','placeholder'=>'Digite la Descripcion', 'rows'=>"3", 'cols'=>"8"])!!}
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
      {!!Form::close()!!}
    </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <!--*********************OPCION: RADIO-CODIGO-------------------->
  <script type="text/javascript">
  </script>
  <!--*********************OPCION: RADIO-MODELOS-------------------->
  <script type="text/javascript">
    var modelo_id = 0;
    var tejido_id = 0;
    var material_id = 0;
    var publico_id = 0;
    var talla_id = 0;
    var proveedor_id = 0;
    var movimiento_id = 0;
    var codSombrero = "";
    var tipo_busqueda = 0;
    //OPCION: CODIGO

    //OPCION: MODELOS
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
    $("#idProveedor").change(function(e){
      console.log(e);
      proveedor_id = e.target.value;
      mostrarAjax();
    });
    $("#idTipoMovimiento").change(function(e){
      console.log(e);
      movimiento_id = e.target.value;
      mostrarPorTipo();
      mostrarAjax();
    });
    $("#cantidad").keyup(function(e){
      console.log(e);
      mostrarAjax();

    });
    $("#precio").keyup(function(e){
      console.log(e);
      mostrarAjax();
    });

    function mostrarAjax(){
      if (modelo_id!=0 && tejido_id!=0 && material_id!=0 &&
          publico_id!=0 && talla_id!=0 && proveedor_id!=0 && movimiento_id!=0) {
            $.get('/ajax-pago/'+modelo_id+'/'+tejido_id+'/'+material_id+'/'+publico_id+'/'+talla_id+'/'+proveedor_id, function(data){
              //success
              $.each(data, function(index, cuentaObj){
                if (movimiento_id==2) {//venta
                  $("#codigo").val(cuentaObj.codigo);
                  $("#precio_txt").text("Precio Venta");
                  var precio = cuentaObj.precio_venta;
                  $("#stock_actual").val(cuentaObj.stock_actual);
                  $("#photo").val(cuentaObj.photo);
                  if (precio==0) {
                    $("#precio").prop("readonly",false);//caja de texto "precio", se escribe
                  } else {
                    $("#precio").val(cuentaObj.precio_venta);
                    $("#precio").prop("readonly",true);//caja de texto "precio", no se escribe
                  }
                  //calculo de venta
                  if ($("#cantidad").val()!="" && $("#precio").val()!="") {
                    if (parseInt($("#cantidad").val())>parseInt($("#stock_actual").val())) {
                      alert("No tenemos dicha cantidad, nos falta: "+(parseInt($("#cantidad").val())-parseInt($("#stock_actual").val())))
                    }
                    $("#precio_total").val(parseInt($("#precio").val())*parseInt($("#cantidad").val())+"");
                  } else if($("#cantidad").val()==""){
                    $("#precio_total").val("");
                  }
                  //
                } else if(movimiento_id==1){//compra
                  $("#codigo").val(cuentaObj.codigo);
                  $("#precio_txt").text("Precio Compra");
                  var precio = cuentaObj.precio_compra;
                  $("#stock_actual").val(cuentaObj.stock_actual);
                  if (precio==0) {
                    $("#precio").prop("readonly",false);//caja de texto "precio", se escribe
                  } else {
                    $("#precio").val(cuentaObj.precio_compra);
                    $("#precio").prop("readonly",true);//caja de texto "precio", no se escribe
                  }
                  //calculo de compra
                  if ($("#cantidad").val()!="" && $("#precio").val()!="") {
                    $("#precio_total").val(parseInt($("#precio").val())*parseInt($("#cantidad").val())+"");
                  } else if($("#cantidad").val()==""){
                    $("#precio_total").val("");
                  }
                  //
                }
              });
            });
      }
    }

    function limpiar() {
      $("#codigo").val("");
      $("#idModelo").val(0);
      $("#idTejido").val(0);
      $("#idMaterial").val(0);
      $("#idPublicoDirigido").val(0);
      $("#idTalla").val(0);
      $("#idProveedor").val(0);
      $("#cantidad").val("");
      $("#stock_actual").val("");
      $("#precio").val("");
      $("#precio_total").val("");

      modelo_id = 0;
      tejido_id = 0;
      material_id = 0;
      publico_id = 0;
      talla_id = 0;
      proveedor_id = 0;
      codSombrero = "";
    }
    //TIPO DE BUSQUEDA (RADIO BUTTON)
    mostrarDatosEnCombos();
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
        $("#idProveedor").removeAttr("disabled");
      } else{//POR CODIGO
        limpiar();
        mostrarDatosEnCombos();
        $("#codigo").prop("readonly",false);
        $("#idModelo").prop('disabled', 'disabled');
        $("#idTejido").prop('disabled', 'disabled');
        $("#idMaterial").prop('disabled', 'disabled');
        $("#idPublicoDirigido").prop('disabled', 'disabled');
        $("#idTalla").prop('disabled', 'disabled');
        $("#idProveedor").prop('disabled', 'disabled');
      }
    });
    //
    function mostrarPorTipo() {

      if ($("#codigo").val().length==13) {
        codSombrero = $("#codigo").val();
        $.get('/ajax-som/'+codSombrero, function(data){
          $.each(data, function(index, sombrero){
            modelo_id = sombrero.idModelo;
            tejido_id = sombrero.idTejido;
            material_id = sombrero.idMaterial;
            publico_id = sombrero.idPublicoDirigido;
            talla_id = sombrero.idTalla;
            proveedor_id = sombrero.idProveedor;
            if (modelo_id!=0 && tejido_id!=0 && material_id!=0 &&
                publico_id!=0 && talla_id!=0 && proveedor_id!=0 && movimiento_id!=0) {
                  $("#idModelo").val(modelo_id);
                  $("#idTejido").val(tejido_id);
                  $("#idMaterial").val(material_id);
                  $("#idPublicoDirigido").val(publico_id);
                  $("#idTalla").val(talla_id);
                  $("#idProveedor").val(proveedor_id);

                  $('#idModelo option[value="'+modelo_id+'"]').attr('selected','selected');
                  $('#idTejido option[value="'+tejido_id+'"]').attr('selected','selected');
                  $('#idMaterial option[value="'+material_id+'"]').attr('selected','selected');
                  $('#idPublicoDirigido option[value="'+publico_id+'"]').attr('selected','selected');
                  $('#idTalla option[value="'+talla_id+'"]').attr('selected','selected');
                  $('#idProveedor option[value="'+proveedor_id+'"]').attr('selected','selected');

                  $.each(data, function(index, cuentaObj){
                    if (movimiento_id==2) {//venta
                      $("#codigo").val(cuentaObj.codigo);
                      $("#precio_txt").text("Precio Venta");
                      var precio = cuentaObj.precio_venta;
                      $("#stock_actual").val(cuentaObj.stock_actual);
                      $("#photo").val(cuentaObj.photo);
                      if (precio==0) {
                        $("#precio").prop("readonly",false);//caja de texto "precio", se escribe
                      } else {
                        $("#precio").val(cuentaObj.precio_venta);
                        $("#precio").prop("readonly",true);//caja de texto "precio", no se escribe
                      }
                      if ($("#cantidad").val()!="" && $("#precio").val()!="") {
                        if (parseInt($("#cantidad").val())>parseInt($("#stock_actual").val())) {
                          alert("No tenemos dicha cantidad, nos falta: "+(parseInt($("#cantidad").val())-parseInt($("#stock_actual").val())))
                        }
                        $("#precio_total").val(parseInt($("#precio").val())*parseInt($("#cantidad").val())+"");
                      } else if($("#cantidad").val()==""){
                        $("#precio_total").val("");
                      }
                    } else if(movimiento_id==1){//compra
                      $("#codigo").val(cuentaObj.codigo);
                      $("#precio_txt").text("Precio Compra");
                      var precio = cuentaObj.precio_compra;
                      $("#stock_actual").val(cuentaObj.stock_actual);
                      if (precio==0) {
                        $("#precio").prop("readonly",false);//caja de texto "precio", se escribe
                      } else {
                        $("#precio").val(cuentaObj.precio_compra);
                        $("#precio").prop("readonly",true);//caja de texto "precio", no se escribe
                      }
                      if ($("#cantidad").val()!="" && $("#precio").val()!="") {
                        $("#precio_total").val(parseInt($("#precio").val())*parseInt($("#cantidad").val())+"");
                      } else if($("#cantidad").val()==""){
                        $("#precio_total").val("");
                      }
                    }
                  });

            }
          });
        });
      }
    }
    function mostrarDatosEnCombos(){
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
              proveedor_id = sombrero.idProveedor;
              if (modelo_id!=0 && tejido_id!=0 && material_id!=0 &&
                  publico_id!=0 && talla_id!=0 && proveedor_id!=0 && movimiento_id!=0) {
                    $("#idModelo").val(modelo_id);
                    $("#idTejido").val(tejido_id);
                    $("#idMaterial").val(material_id);
                    $("#idPublicoDirigido").val(publico_id);
                    $("#idTalla").val(talla_id);
                    $("#idProveedor").val(proveedor_id);

                    $('#idModelo option[value="'+modelo_id+'"]').attr('selected','selected');
                    $('#idTejido option[value="'+tejido_id+'"]').attr('selected','selected');
                    $('#idMaterial option[value="'+material_id+'"]').attr('selected','selected');
                    $('#idPublicoDirigido option[value="'+publico_id+'"]').attr('selected','selected');
                    $('#idTalla option[value="'+talla_id+'"]').attr('selected','selected');
                    $('#idProveedor option[value="'+proveedor_id+'"]').attr('selected','selected');
                    $("#precio").val("");
                    $.each(data, function(index, cuentaObj){
                      if (movimiento_id==2) {//venta
                        $("#codigo").val(cuentaObj.codigo);
                        $("#precio_txt").text("Precio Venta");
                        var precio = cuentaObj.precio_venta;
                        $("#stock_actual").val(cuentaObj.stock_actual);
                        $("#photo").val(cuentaObj.photo);
                        if (precio==0) {
                          $("#precio").prop("readonly",false);//caja de texto "precio", se escribe
                        } else {
                          $("#precio").val(cuentaObj.precio_venta);
                          $("#precio").prop("readonly",true);//caja de texto "precio", no se escribe
                        }
                        if ($("#cantidad").val()!="" && $("#precio").val()!="") {
                          if (parseInt($("#cantidad").val())>parseInt($("#stock_actual").val())) {
                            alert("No tenemos dicha cantidad, nos falta: "+(parseInt($("#cantidad").val())-parseInt($("#stock_actual").val())))
                          }
                          $("#precio_total").val(parseInt($("#precio").val())*parseInt($("#cantidad").val())+"");
                        } else if($("#cantidad").val()==""){
                          $("#precio_total").val("");
                        }
                      } else if(movimiento_id==1){//compra
                        $("#codigo").val(cuentaObj.codigo);
                        $("#precio_txt").text("Precio Compra");
                        var precio = cuentaObj.precio_compra;
                        $("#stock_actual").val(cuentaObj.stock_actual);
                        if (precio==0) {
                          $("#precio").prop("readonly",false);//caja de texto "precio", se escribe
                        } else {
                          $("#precio").val(cuentaObj.precio_compra);
                          $("#precio").prop("readonly",true);//caja de texto "precio", no se escribe
                        }
                        if ($("#cantidad").val()!="" && $("#precio").val()!="") {
                          $("#precio_total").val(parseInt($("#precio").val())*parseInt($("#cantidad").val())+"");
                        } else if($("#cantidad").val()==""){
                          $("#precio_total").val("");
                        }
                      }
                    });

              }
            });
          });
        }
      });
    }

  </script>
@endsection
