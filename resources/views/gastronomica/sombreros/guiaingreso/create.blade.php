@extends('layouts.master')
@section('title','Nuevo Guia Ingreso')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/guiaingreso/guiaingreso')}}">Guia de Ingreso</a></li>
        <li class="breadcrumb-item active">Nuevo Guia Ingreso</li>
      </ul>
    </div>
  </div></br>
  <div class="container-fluid">
    @include('partials.messages')
    <center><h1 class="h3" id="titulo_codigo">Código: GI-001-17</h1></center>
  </div>

  <section class="forms">
    <div class="container-fluid">
      {!!Form::open(['action'=>'Compras\GuiaIngresoController@store','method'=>'POST'])!!}
      <!--Panel superior-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display">Opciones:</h2>
            </div>
            <div class="card-block">
              <div class=""><!--form-inline-->
                <div class="form-group row">
                  <label class="col-sm-1 form-control-label" for="idTipoMovimiento"><strong>Proveedor(*):</strong></label>
                  <div class="col-sm-3">
                    {!!Form::select('idProveedor',$proveedor, null,['id'=>'idProveedor','name'=>'idProveedor','class'=>'form-control'])!!}
                  </div>
                  <label class="form-control-label col-sm-2"><strong>Tipo Busqueda:</strong></label>
                  <div class="i-checks col-sm-2"><!--mx-sm-2-->
                    <input id="radioCodigo" type="radio" checked="" value="option1" name="a" class="opcion form-control-custom radio-custom">
                    <label for="radioCodigo">Código</label>
                  </div>
                  <div class="i-checks col-sm-2">
                    <input id="radioModelo" type="radio" value="option2" name="a" class="opcion form-control-custom radio-custom">
                    <label for="radioModelo">Modelos</label>
                  </div>
                  <div class="i-checks col-sm-2">
                    <input id="radioFoto" type="radio" value="option3" name="a" class="opcion form-control-custom radio-custom">
                    <label for="radioFoto">Foto</label>
                  </div>
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
                <label class="col-sm-1 form-control-label" for="codigo"><strong>Codigo(*):</strong></label>
                <div class="col-sm-3">
                  {!!form::text('codigo', null,['id'=>'codigo','name'=>'codigo','class'=>'form-control','autofocus'])!!}
                  <span class="help-block-none">Nota: El código son de 13 caracteres.</span>
                </div>
                <label class="col-sm-1 form-control-label" for="idModelo"><strong>Modelo:</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('idModelo',$modelo, null,['id'=>'idModelo','name'=>'idModelo','class'=>'form-control','disabled'=>''])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="idTejido"><strong>Tejido:</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('idTejido',$tejido, null,['id'=>'idTejido','name'=>'idTejido','class'=>'form-control','disabled'=>''])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 form-control-label" for="idMaterial"><strong>Material:</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('idMaterial',$material, null,['id'=>'idMaterial','name'=>'idMaterial','class'=>'form-control','disabled'=>''])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="idPublicoDirigido"><strong>Publico:</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('idPublicoDirigido',$publicodirigido, null,['id'=>'idPublicoDirigido','name'=>'idPublicoDirigido',
                    'class'=>'form-control','disabled'=>''])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="idTalla"><strong>Talla:</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('idTalla',$talla, null,['id'=>'idTalla','name'=>'idTalla','class'=>'form-control','disabled'=>''])!!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Panel inferios-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Formulario:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos para la nueva guia de ingreso.</p>
              <div class="form-group row">
                <label class="col-sm-1 form-control-label" for="precio_unitario"><strong>Precio Unitario:</strong></label>
                <div class="col-sm-3">
                  {!!form::text('precio_unitario', null,['id'=>'precio_unitario','name'=>'precio_unitario','class'=>'form-control',
                    'placeholder'=>'Aqui el precio unitario','readonly'=>'true'])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="stock_actual"><strong>Stock Actual:</strong></label>
                <div class="col-sm-3">
                  {!!form::text('stock_actual', null,['id'=>'stock_actual','name'=>'stock_actual','class'=>'form-control',
                    'placeholder'=>'Aqui el stock actual', 'readonly'=>'true'])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="cantidad"><strong>Cantidad(*):</strong></label>
                <div class="col-sm-3">
                  {!!form::text('cantidad', null,['id'=>'cantidad','name'=>'cantidad','class'=>'form-control','placeholder'=>'Ingrese Cantidad',
                    'onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 form-control-label" for="descripcion"><strong>Descripcion:</strong></label>
                <div class="col-sm-3">
                  {!!form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Digite la Descripcion',
                    'rows'=>"3", 'cols'=>"8"])!!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Panel tabla-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Tabla Detalles:</h2>
            </div>
            <div class="card-block">
              <p>Lista de todos los detalles de la guia de ingreso.</p>
              <div class="form-group row">
                <div class="col-sm-10">
                  <a href="{{url('gastronomica/sombreros/guiaingreso/guiaingreso')}}" class="btn btn-secondary">Cancelar</a>
                  <button type="button" class="btn btn-primary" data-toggle="modal" id="guardar">Guardar</button>
                  <!--{ !!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>',
                    'class'=>'btn btn-primary'])!!}-->
                    <!-- Modal-->
                    <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                      <div role="document" class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">Errores</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
                            <h2 id="errores">Errores</h2>
                            <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="si">Aceptar</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Modal aviso para guardar registros -->
                    <div id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                      <div role="document" class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">Mensaje</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
                            <h2>¡Se ha guardado correctamente una guia de compra! :)</h2>
                            <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="aceptar">Aceptar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-sm-1">
                  <button type="button" class="btn btn-primary" id="agregar" disabled>Agregar</button>
                </div>
              </div>
              <table class="table table-striped table-hover table-bordered">
                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo Sombrero</th>
                    <th>Foto</th>
                    <th>Cantidad</th>
                    <th>Descripcion</th>
                  </tr>
                </thead>
                <tbody id="lista_datos">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      mostrarCodigoOrden();
      buscarDatosPorCodigo();
    });
    var modelo_id = 0;
    var tejido_id = 0;
    var material_id = 0;
    var publico_id = 0;
    var talla_id = 0;
    var proveedor_id = 0;
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
    $("#idProveedor").change(function(e){
      console.log(e);
      proveedor_id = e.target.value;
      mostrarAjax();
    });
    $("#cantidad").keyup(function(e){
      console.log(e);
      //calcularPrecioTotal();
    });

    function mostrarAjax(){
      if (modelo_id!=0 && tejido_id!=0 && material_id!=0 &&
          publico_id!=0 && talla_id!=0 && proveedor_id!=0) {
            $.get('/ajax-verdatos/'+modelo_id+'/'+tejido_id+'/'+material_id+'/'+publico_id+
            '/'+talla_id+'/'+proveedor_id, function(data){
              //success
              $.each(data, function(index, cuentaObj){
                $("#codigo").val(cuentaObj.codigo);
                $("#precio_unitario").val(cuentaObj.precio);
                $("#stock_actual").val(cuentaObj.stock_actual);
                //$("#precio_unitario").val(cuentaObj.precio);
              });
            });
      } else if(proveedor_id==0) {
        limpiar();
        $("#codigo").val("");
      } else {
        $("#codigo").val("");
      }
    }

    function calcularPrecioTotal() {
      if ($("#precio_unitario").val()!="" && $("#cantidad").val()!="") {
        $("#precio_total").val(parseInt($("#cantidad").val())*parseInt($("#precio_unitario").val())+"");
      } else {
        $("#precio_total").val("");
      }
    }

    function limpiar() {
      //$("#codigo").val("");
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
      $("#precio_unitario").val("");
      $("#stock_actual").val("");
      $("#cantidad").val("");
      $("#descripcion").val("");
    }

    //Cambiar los estados del radio button
    $(".opcion").change(function(){
      if ($("#radioModelo").is(":checked")) {
        limpiar();
        $("#codigo").val("");
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
        $("#codigo").val("");
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
      buscarDatosPorCodigo();
    });

    function mostrarCodigoOrden() {
      $.get('/ajax-mostrarCGI/1', function(data){
        //success
        $.each(data, function(index, objeto){
          var d = new Date();
          var anio = (d.getFullYear())+"";
          var digitos = anio.substring(2,4);
          var n = parseInt(objeto.id)+1;
          var cod = "";
          if (n>0 && n<10) {
            cod = "GI-000"+n+"-"+digitos;
          } else if(n>=10 && n<100){
            cod = "GI-00"+n+"-"+digitos;
          } else if(n>=100 && n<1000){
            cod = "GI-0"+n+"-"+digitos;
          } else if(n>=1000 && n<10000){
            cod = "GI-"+n+"-"+digitos;
          } else {
            cod = "Null";
          }
          $("#titulo_codigo").text("Código: "+cod);
          //alert('(2)'+objeto.id);
        });
      });
    }
    function buscarDatosPorCodigo() {
      if ($("#codigo").val().length==13) {
        codSombrero = $("#codigo").val();
        $.get('/ajax-OCSomb/'+codSombrero, function(data){
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
                  $("#precio_unitario").val(sombrero.precio+"");

                  $('#idModelo option[value="'+modelo_id+'"]').attr('selected','selected');
                  $('#idTejido option[value="'+tejido_id+'"]').attr('selected','selected');
                  $('#idMaterial option[value="'+material_id+'"]').attr('selected','selected');
                  $('#idPublicoDirigido option[value="'+publico_id+'"]').attr('selected','selected');
                  $('#idTalla option[value="'+talla_id+'"]').attr('selected','selected');
                  $("#stock_actual").val(sombrero.stock_actual);
                  $("#precio").val("");
            }
          });
        });
      } else {
        limpiar();
      }
    }

    $("#guardar").click(function(){
      var mensaje = "";
      if ($("#codigo").val()=="") {
        mensaje = mensaje + "* El codigo no debe estar vacío.</br>";
      } else {
        if ($("#codigo").val().length!=13) {
          mensaje = mensaje + "* El codigo no tiene los 13 caracteres.</br>";
        }
      }

      if ($("#idProveedor").val()==0) {
        mensaje = mensaje + "* Debe seleccionar un proveedor.</br>";
      }
      if ($("#cantidad").val()=="") {
        mensaje = mensaje + "* Debe ingresar la cantidad.";
      }
      if (mensaje=="") {
        if ($("#idProveedor").prop("disabled")) {//desactivado
          //solo se guardar todas las ordenes de compras detalle
          var tabla = "";
          var n = 1;
          var descripcion = $("#descripcion").val();
          if (descripcion=="") {
            descripcion = "0";
          }
          $.get('/ajax-guardarguia/2/'+$("#codigo").val()+'/'+$("#idProveedor").val()+
          '/'+$("#cantidad").val()+'/'+
          descripcion, function(data){
            //success
            $.each(data, function(index, guia){
              //alert('(2) '+orden.numero_orden);
              //alert("entra "+orden.codigo);
              tabla = tabla+"<tr><td>"+n+", "+guia.idGuiaIngreso+"</td><td>"+guia.codigo+"</td>"+
              "<td><img src='/images/sombreros/"+guia.photo+
              "' class='img-fluid pull-xs-left rounded' alt='...' width='28'></td>"+
              "<td>"+guia.cantidad+"</td><td>"+guia.descripcion+"</td></tr>";
              $("#guardar").prop('disabled', 'disabled');
              $("#agregar").removeAttr("disabled");
              n++;
            });
            //alert(tabla);
            $("#lista_datos").html(tabla);
            tabla = "";
            $("#myModal2").modal("show");
          });

        } else {
          //se guardan el primer en orden compra y orden de compra detalle;
          var tabla = "";
          var n = 1;
          var descripcion = $("#descripcion").val();
          if (descripcion=="") {
            descripcion = "0";
          }
          //alert("Cantidad (Inicio):"+$("#cantidad").val());
          $.get('/ajax-guardarguia/1/'+$("#codigo").val()+'/'+$("#idProveedor").val()+
          '/'+$("#cantidad").val()+'/'+
          descripcion, function(data){
            //success
            $.each(data, function(index, guia){
              //alert('(1) '+orden.numero_orden);
              $("#idProveedor").prop('disabled', 'disabled');
              $("#guardar").prop('disabled', 'disabled');
              $("#agregar").removeAttr("disabled");
              //alert(orden.codigo);
              tabla = tabla+"<tr><td>"+n+", "+guia.idGuiaIngreso+"</td><td>"+guia.codigo+"</td>"+
              "<td><img src='/images/sombreros/"+guia.photo+
              "' class='img-fluid pull-xs-left rounded' alt='...' width='28'></td>"+
              "<td>"+guia.cantidad+"</td><td>"+guia.descripcion+"</td></tr>";
              n++;
            });
            //alert(tabla);
            $("#lista_datos").html(tabla);
            tabla = "";
            $("#myModal2").modal("show");
          });

        }
      } else {
        $("#errores").html(mensaje);
        $("#myModal").modal("show");
      }
    });

    $("#aceptar").click(function(){
      //$('#myModal').modal("show");//en este modal hay opciones (si y no)
      mostrarCodigoOrden();
      limpiar();
      $("#codigo").val("");
    });

    /*$("#si").click(function(){

    });*/

    $("#agregar").click(function(){
      $("#guardar").removeAttr("disabled");
      $("#agregar").prop('disabled', 'disabled');
    });
  </script>
@endsection
