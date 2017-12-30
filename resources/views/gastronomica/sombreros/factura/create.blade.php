@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/factura/factura')}}">Facturas</a></li>
        <li class="breadcrumb-item active">Nueva Factura</li>
      </ul>
    </div>
  </div></br>
  <div class="container-fluid">
    @include('partials.messages')
    <center><h1 class="h3" id="titulo_codigo">N°: 001-000001</h1></center><!--deben ser 11 digitos (falta un 0)-->
  </div>

  <section class="forms">
    <div class="container-fluid">
      {!!Form::open(['action'=>'Compras\FacturaController@store','method'=>'POST'])!!}
      <!---->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Orden de compra:</h2>
            </div>
            <div class="card-block">
              <p>Muestra de datos del orden de compra.</p>
              <div class="form-group row">
                <label class="offset-md-3 col-sm-2 form-control-label" for="idMaterial"><strong>N° Orden de Compra:</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('idOrdenCompra',$numero_orden, null,['id'=>'idOrdenCompra','name'=>'idOrdenCompra','class'=>'form-control','autofocus'])!!}
                </div>
              </div>
              <hr/>
              <div class="form-group row">
                <label class="col-sm-1 form-control-label"><strong>Fecha:</strong></label><!--\Carbon\Carbon::now()->format('Y/m/d')-->
                {!!form::label('',null,['for'=>'fecha', 'class'=>'col-sm-3 form-control-label',
                  'id'=>'fecha'])!!}
                <label class="col-sm-1 form-control-label"><strong>Proveedor:</strong></label>
                <div class="col-sm-3">
                  {!!form::label('',null,['class'=>'form-control-label','id'=>'proveedor'])!!}
                </div>
                <label class="col-sm-2 form-control-label"><strong>Precio Total:</strong></label>
                <div class="col-sm-2">
                  {!!form::label('',null,['class'=>'form-control-label','id'=>'precio_total'])!!}
                </div>
              </div>
              <hr/>
              <!--Tabla orden de compra-->
              <div class="form-group row">
                <div class="col-sm-12">
                  <table class="table table-striped table-hover table-bordered" id="tabla_ordenes">
                    <thead class="thead-inverse">
                      <tr>
                        <th>#</th>
                        <th>Codigo Sombrero</th>
                        <th>Foto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Precio Total</th>
                        <th>Descripcion</th>
                      </tr>
                    </thead>
                    <tbody id="lista_ordenes">
                      <tr>
                        <td>1</td>
                        <td>sombrero</td>
                        <td>foto</td>
                        <td>cantidad</td>
                        <td>precio unitario</td>
                        <td>precio total</td>
                        <td>descripcion</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--fin tabla-->
            </div>
          </div>
        </div>
      </div>
      <!--Panel datos de sombrero-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Formulario:</h2>
            </div>
            <div class="card-block">
              <p>Datos del sombrero.</p>
              <div class="form-group row">
                <label class="col-sm-1 form-control-label" for="codigo"><strong>Codigo(*):</strong></label>
                <div class="col-sm-3">
                  {!!form::text('codigo', null,['id'=>'codigo','name'=>'codigo','class'=>'form-control','placeholder'=>'Ingrese Cantidad',
                    'readonly'=>'true'])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="modelo"><strong>Modelo:</strong></label>
                <div class="col-sm-3">
                  {!!form::text('modelo', null,['id'=>'modelo','name'=>'modelo','class'=>'form-control','placeholder'=>'Aqui el Modelo',
                    'readonly'=>'true'])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="tejido"><strong>Tejido:</strong></label>
                <div class="col-sm-3">
                  {!!form::text('tejido', null,['id'=>'tejido','name'=>'tejido','class'=>'form-control','placeholder'=>'Aqui el Tejido',
                    'readonly'=>'true'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 form-control-label" for="material"><strong>Material:</strong></label>
                <div class="col-sm-3">
                  {!!form::text('material', null,['id'=>'material','name'=>'material','class'=>'form-control','placeholder'=>'Aqui el Material',
                    'readonly'=>'true'])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="publico"><strong>Publico:</strong></label>
                <div class="col-sm-3">
                  {!!form::text('publico', null,['id'=>'publico','name'=>'publico','class'=>'form-control','placeholder'=>'Aqui el Publico',
                    'readonly'=>'true'])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="talla"><strong>Talla:</strong></label>
                <div class="col-sm-3">
                  {!!form::text('talla', null,['id'=>'talla','name'=>'talla','class'=>'form-control','placeholder'=>'Aqui la Talla',
                    'readonly'=>'true'])!!}
                </div>
              </div><!---->

            </div>
          </div>
        </div>
      </div>
      <!---->
      <!--Panel superior-->
      <!--Panel del centro-->
      <!--Panel inferios-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Formulario:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos para la nueva factura.</p>
              <div class="form-group row">
                <label class="col-sm-1 form-control-label" for="idTipoMovimiento"><strong>Proveedor(*):</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('idProveedor',$proveedor, null,['id'=>'idProveedor','name'=>'idProveedor','class'=>'form-control'])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="cantidad"><strong>Cantidad(*):</strong></label>
                <div class="col-sm-3">
                  {!!form::text('cantidad', null,['id'=>'cantidad','name'=>'cantidad','class'=>'form-control','placeholder'=>'Ingrese Cantidad',
                    'onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57'])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="precio_unitario"><strong>Precio Unitario:</strong></label>
                <div class="col-sm-3">
                  {!!form::text('precio_unitario', null,['id'=>'precio_unitario','name'=>'precio_unitario','class'=>'form-control',
                    'placeholder'=>'Aqui el precio unitario','readonly'=>'true'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 form-control-label" for="precio_total"><strong>Precio Total:</strong></label>
                <div class="col-sm-3">
                  {!!form::text('precio_total', null,['id'=>'precio_total','name'=>'cantidad','class'=>'form-control',
                    'placeholder'=>'Aqui el precio total','readonly'=>'true'])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="comprador"><strong>Cliente(*):</strong></label>
                <div class="col-sm-3">
                  {!!form::text('comprador', null,['id'=>'comprador','name'=>'comprador','class'=>'form-control',
                    'placeholder'=>'Ingrese el nombre del cliente'])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="descripcion"><strong>Descripcion:</strong></label>
                <div class="col-sm-3">
                  {!!form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Digite la Descripcion',
                    'rows'=>"3", 'cols'=>"8", 'readonly'=>'true'])!!}
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
              <p>Lista de todos los detalles de la orden de compra.</p>
              <div class="form-group row">
                <div class="col-sm-10">
                  <a href="{{url('gastronomica/sombreros/factura/factura')}}" class="btn btn-secondary">Cancelar</a>
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
                            <h2>¡Se ha guardado correctamente un detalle de factura! :)</h2>
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
                    <th>Descripcion</th><!--aqui se saca de acuerdo al codigo de sombrero-->
                    <th>Precio Unitario</th>
                    <th>Valor Venta</th>
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
    {!!Form::close()!!}
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
    var codSombrero = "";
    $("#idOrdenCompra").change(function(e){
      console.log(e);
      mostrarCabeceraOrden();
      mostrarOrdenesCompra();
    });
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
    $("#cantidad").keyup(function(e){
      console.log(e);
      calcularPrecioTotal();
    });



    function mostrarCabeceraOrden() {
      $.get('/ajax-verCabeceraOrden/'+$("#idOrdenCompra").find(":selected").text(), function(data){
        $.each(data, function(index, orden){
          $("#fecha").html(orden.fecha);
          //$("#proveedor").val(orden.proveedor);
          $("#precio_total").html(orden.precio_total);
        });
      });
    }

    function mostrarOrdenesCompra() {
      var tabla = "";
      var n = 1;
      $.get('/ajax-verOrdenesCompra/'+$("#idOrdenCompra").find(":selected").text(), function(data){
        $.each(data, function(index, orden){
          tabla = tabla+"<tr><td>"+n+"</td><td>"+orden.codigo+"</td>"+
          "<td><img src='/images/sombreros/"+orden.photo+
          "' class='img-fluid pull-xs-left rounded' alt='...' width='28'></td>"+
          "<td>"+orden.cantidad+"</td><td>"+orden.precio_unitario+"</td><td>"+
          orden.cantidad * orden.precio_unitario+"</td><td>"+
          orden.descripcion+"</td></tr>";
          $("#proveedor").html(orden.empresa);
        });
        $("#lista_ordenes").html(tabla);
        tabla = "";
      });
    }
    function mostrarAjax(){
      if (modelo_id!=0 && tejido_id!=0 && material_id!=0 &&
          publico_id!=0 && talla_id!=0) {
            $.get('/ajax-verdatos/'+modelo_id+'/'+tejido_id+'/'+material_id+'/'+publico_id+
            '/'+talla_id, function(data){
              //success
              $.each(data, function(index, cuentaObj){
                $("#codigo").val(cuentaObj.codigo);
                $("#precio_unitario").val(cuentaObj.precio);
                $("#descripcion").val("Sombrero con modelo: "+$("#idModelo option:selected").text()+
                ", material: "+$("#idMaterial option:selected").text()+", calidad de tejido: "+
                $("#idTejido option:selected").text());
              });
            });
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
      buscarDatosPorCodigo();
    });

    function mostrarCodigoOrden() {
      $.get('/ajax-mostrarCF/1', function(data){
        //success
        $.each(data, function(index, objeto){
          var n = parseInt(objeto.id)+1;
          var cod = "";
          if (n>0 && n<10) {
            cod = "001-"+"00000"+n;
          } else if(n>=10 && n<100){
            cod = "001-"+"0000"+n;
          } else if(n>=100 && n<1000){
            cod = "001-"+"000"+n;
          } else if(n>=1000 && n<10000){
            cod = "001-"+"00"+n;
          } else if(n>=10000 && n<100000){
            cod = "001-"+"0"+n;
          } else if(n>=100000 && n<1000000){
            cod = "001-"+n;
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
        $("#precio_unitario").val("");
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
        mensaje = mensaje + "* Debe ingresar la cantidad.</br>";
      }
      if ($("#comprador").val()=="") {
        mensaje = mensaje + "* Debe ingresar el nombre del cliente.";
      }
      if (mensaje=="") {
        if ($("#idProveedor").prop("disabled")) {//desactivado
          //solo se guardar todas las ordenes de compras detalle
          var tabla = "";
          var n = 1;

          $.get('/ajax-guardarfactura/2/'+$("#codigo").val()+'/'+$("#idProveedor").val()+
          '/'+$("#cantidad").val()+'/'+$("#precio_unitario").val()+'/'+$("#comprador").val()+'/'+
          $("#usuario").html()+'/'+$("#descripcion").val(), function(data){
            //success
            $.each(data, function(index, factura){
              //alert('(2) '+orden.numero_orden);
              //alert("entra "+orden.codigo);
              tabla = tabla+"<tr><td>"+n+", "+factura.idFactura+"</td><td>"+factura.codigo+"</td>"+
              "<td><img src='/images/sombreros/"+factura.photo+
              "' class='img-fluid pull-xs-left rounded' alt='...' width='28'></td>"+
              "<td>"+factura.cantidad+"</td>"+"<td>"+factura.descripcion+"</td><td>"+factura.precio_unitario+
              "</td><td>"+factura.sub_total+"</td></tr>";
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
          //alert("Cantidad (Inicio):"+$("#cantidad").val());
          $.get('/ajax-guardarfactura/1/'+$("#codigo").val()+'/'+$("#idProveedor").val()+
          '/'+$("#cantidad").val()+'/'+$("#precio_unitario").val()+'/'+$("#comprador").val()+'/'+
          $("#usuario").html()+'/'+$("#descripcion").val(), function(data){
            //success
            $.each(data, function(index, factura){
              //alert('(1) '+orden.numero_orden);
              $("#idProveedor").prop('disabled', 'disabled');
              $("#guardar").prop('disabled', 'disabled');
              $("#agregar").removeAttr("disabled");
              //alert(orden.codigo);
              tabla = tabla+"<tr><td>"+n+", "+factura.id+"</td><td>"+factura.codigo+"</td>"+
              "<td><img src='/images/sombreros/"+factura.photo+
              "' class='img-fluid pull-xs-left rounded' alt='...' width='28'></td>"+
              "<td>"+factura.cantidad+"</td>"+"<td>"+factura.descripcion+"</td><td>"+factura.precio_unitario+
              "</td><td>"+factura.sub_total+"</td></tr>";
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

    $("#lista_ordenes tr").click(function(e){
      var dato = $("#lista_ordenes tr").find('td:nth-child(2)').html();
      alert(dato);
      dato = "";
    });

    $("#aceptar").click(function(){
      //$('#myModal').modal("show");//en este modal hay opciones (si y no)
      mostrarCodigoOrden();
      limpiar();
      $("#cantidad").val("");
      $("#comprador").val("");
      $("#precio_unitario").val("");
      $("#precio_total").val("");
      $("#descripcion").val("");
    });

    /*$("#si").click(function(){

    });*/

    $("#agregar").click(function(){
      $("#guardar").removeAttr("disabled");
      $("#agregar").prop('disabled', 'disabled');
    });
  </script>
@endsection
