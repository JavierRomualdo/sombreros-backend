@extends('layouts.master')
@section('title','Proveedores')
@section('content')

<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">
<div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Reporte movimiento por articulo /</li>
      </ul>
    </div>
  </div>
<section class="forms">
    <div class="container-fluid">
        <!--Panel Sombrero-->
        <div class="row" id="panelSombrero">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h6 display ion-paperclip fadeIn animated"> Panel Sombrero:</h2>
            </div>
            <div class="card-block">
              
              <div class="form-group row">
                <label class="form-control-label col-sm-2"><strong>Tipo Busqueda:</strong></label>
                <div class="i-checks col-sm-1"><!--mx-sm-2-->
                  <input id="radioCodigo" type="radio" checked="" value="option1" name="a" class="opcion form-control-custom radio-custom">
                  <label for="radioCodigo">Código</label>
                </div>
                <div class="i-checks col-sm-1">
                  <input id="radioModelo" type="radio" value="option2" name="a" class="opcion form-control-custom radio-custom">
                  <label for="radioModelo">Modelos</label>
                </div>
                <div class="i-checks col-sm-1">
                  <input id="radioFoto" type="radio" value="option3" name="a" class="opcion form-control-custom radio-custom">
                  <label for="radioFoto">Foto</label>
                </div>
                <div class="offset-sm-6 col-sm-1">
                  <button type="button" name="buscar" id="buscar" class="btn btn-outline-primary btn-sm ion-android-search rounded" title="buscar"></button>
                </div>
              </div>
              <p>Ingrese los datos del nuevo modelo de sombrero.</p>
              <div class="col-sm-12">
                <!--<hr/>-->
              </div>
              <div class="form-group row">
                <label class="col-sm-1 form-control-label" for="codigo"><strong>Codigo:</strong></label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" autofocus id="codigo"/>
                    <span class="help-block-none">El código son de 13 caracteres.</span>
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
                <label class="col-sm-1 form-control-label" for="idMaterial"><strong>Material</strong></label>
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
      <!--Panel consolidado-->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Informacion:</h2>
            </div>
            <div class="card-block">

            <div class="form-group row">
                <label class="col-sm-2 col-3 form-control-label"><strong>Imagen Articulo:</strong></label>
                <div class="col-sm-2 col-3">
                  <img src="/images/sombreros/nofoto.png" id="imagen" data-toggle="modal" class="link_foto img-fluid pull-xs-left rounded" alt="..." width="28">
                </div>
                <label class="col-sm-2 col-3 form-control-label"><strong>Stock Actual:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" id="stock_actual">##</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="fecha"><strong>Utilidad Articulo:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" id="utilidad">##</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-3 form-control-label"><strong>Cantidad Ingresos:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" id="numero_ingreso">##</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="fecha"><strong>Items Ingresadas:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" id="cantidad_ingreso">##</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label"><strong>Costo Total:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" id="costo_total">##</label>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-3 form-control-label"><strong>Cantidad Salidas:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" id="numero_salida">##</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="fecha"><strong>Items Vendidas:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" id="cantidad_salida">##</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label"><strong>Precio Total:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" id="precio_total">##</label>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <!--Panel de guias de ingreso-->
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h6 display ion-paperclip fadeIn animated title"> Guias de Ingreso:</h2>
            </div>
            <div class="card-block miTabla">
              
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="myTableGuiaIngreso"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo de Guia</th>
                    <th>Fecha</th>
                    <th>Cantidad Items</th>
                    <th>Precio Total</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody id="lista_guias">
                </tbody>
              </table>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!--Panel de ventas-->
    <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display ion-paperclip fadeIn animated"> Ventas:</h2>
            </div>
            <div class="card-block miTabla">
              <a href="{{action('Reportes\ReporteController@reporteGeneralVentas')}}"
              id="reporte" class="btn btn-outline-primary btn-sm margenInf ion-document-text" title="reporte" target="_blank"> Reporte</a><br/>
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="myTableVentas"><!--table-responsive-->
                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo de Venta</th>
                    <th>Fecha</th>
                    <th>Cantidad Items</th>
                    <th>Precio Total</th>
                    <th>Realizado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody id="lista_ventas">
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---->
    </div>

    <!--Modal de guia ingreso detalle-->
    <div class="modal fade bd-example-modal-lg" id="modalGuiaIngresoDetalle" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h6 modal-title ion-paperclip" id="exampleModalLabel"> Venta Detalle</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
          <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                <thead class="thead-inverse">
                  <tr class="fadeIn animated">
                    <th>#</th>
                    <th>Proveedor</th>
                    <th>Codigo Orden</th>
                    <th>Articulo</th>
                    <th>Foto</th>
                    <th>Cantidad</th>
                    <th>Costo Articulo</th>
                    <th>Costo Total</th>
                    <th>Descripcion</th>
                  </tr>
                </thead>
                <tbody id="list_guia_ingreso_detalle">
              </table>
            </div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cerrar</button>
            <!--<button type="button" class="btn btn-primary">Save changes</button>-->
          </div>
        </div>
      </div>
    </div>
    <!--Modal de venta detalle-->
    <div class="modal fade bd-example-modal-lg" id="modalVentaDetalle" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h6 modal-title ion-paperclip" id="exampleModalLabel"> Venta Detalle</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
          <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">

                <thead class="thead-inverse">
                  <tr class="fadeIn animated">
                    <th>#</th>
                    <th>Articulo</th>
                    <th>Foto</th>
                    <th>Cantidad</th>
                    <th>Precio Venta</th>
                    <th>Descuento (%)</th>
                    <th>Descuento</th>
                    <th>Precio Total</th>
                    <th>Descripcion</th>
                  </tr>
                </thead>
                <tbody id="lista_venta_detalle">
              </table>
            </div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cerrar</button>
            <!--<button type="button" class="btn btn-primary">Save changes</button>-->
          </div>
        </div>
      </div>
    </div>
    <!--foto-->
  <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">Sombrero</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <img src="/images/sombreros/" class="rounded mx-auto d-block  img-fluid" id="mostrar_foto" alt="..." width="450px" height="453px">
            <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="aceptar">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!---->
</section>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

  <!--Notificacion-->
  <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>

<script>
    $(document).ready(function(e){
      Messenger().post({message:"Reporte de movimiento por articulo.",type:"info",showCloseButton:!0});
    });
    //Para el codigo de sombrero
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
                var bandera = false;
                $.get('/ajax-vercodigo/'+modelo_id+'/'+tejido_id+'/'+material_id+'/'+publico_id+
                '/'+talla_id, function(data){
                    //success
                    $.each(data, function(index, cuentaObj){
                        bandera = true;
                        $("#codigo").val(cuentaObj.codigo);
                    });
                    if(!bandera){
                        Messenger().post({message:"¡ No existe el sombrero !.",type:"info",showCloseButton:!0});
                        $("#codigo").val("");
                    }
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
  buscarDatosPorCodigo();
});

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

              $('#idModelo option[value="'+modelo_id+'"]').attr('selected','selected');
              $('#idTejido option[value="'+tejido_id+'"]').attr('selected','selected');
              $('#idMaterial option[value="'+material_id+'"]').attr('selected','selected');
              $('#idPublicoDirigido option[value="'+publico_id+'"]').attr('selected','selected');
              $('#idTalla option[value="'+talla_id+'"]').attr('selected','selected');
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
}

/*boton buscar*/
      $("#buscar").click(function(e){
        var mensaje = "";
        if ($("#codigo").val()=="") {
            mensaje = mensaje + "* El codigo no debe estar vacío.<br/>";
        } else {
            if ($("#codigo").val().length!=13) {
                    mensaje = mensaje + "* El codigo no tiene los 13 caracteres.<br/>";
            }
        }
        if (mensaje=="") {
            /*Stock actual*/
            $.get('/ajax-paraMovimientoPorArticulo/'+$("#codigo").val(), function(data){
                //success
                $.each(data, function(index, articulo){
                    $("#imagen").attr('src','/images/sombreros/'+articulo.photo);
                    $("#stock_actual").html(articulo.stock_actual);
                    $("#utilidad").html(articulo.utilidad);
                    
                });

            });

            var tabla = "";
            var n = 1;
            
            /*Guias Ingreso*/
            $.get('/ajax-guiasIngresoPorCodSombrero/'+$("#codigo").val(), function(data){
            $('#myTableGuiaIngreso').DataTable().destroy();
            //success
            var numero_ingreso = 0;
            var cantidad_ingreso = 0;
            var costo_total = 0.0;
            $.each(data, function(index, guia){
              tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+guia.numero_guia+"</th><td>"+
              guia.fecha+"</td><td>"+guia.cantidad_guia+
              "</td><td> S/ "+guia.precio_total+
              "</td><td><a href='javascript:verDetallesGuiaIngreso("+guia.id+")' class='btn btn-outline-primary btn-sm ion-eye' title='ver'></a> "
              +"<a href='{{URL::to('gastronomica/sombreros/ventas/reporte/')}}/"+guia.id+
              "' target='_black' class='btn btn-outline-primary btn-sm ion-document-text'></a></td></tr>";
                n++;

                numero_ingreso++;
                cantidad_ingreso=cantidad_ingreso+parseInt(guia.cantidad_guia);
                costo_total = costo_total+parseFloat(guia.precio_total);
            });
            $("#lista_guias").html(tabla);
            
            $("#numero_ingreso").html(numero_ingreso);
            $("#cantidad_ingreso").html(cantidad_ingreso);
            $("#costo_total").html("S/ "+costo_total);            

            tabla = "";
            n=1;
            $('#myTableGuiaIngreso').DataTable({
                    "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    //responsive: true,
                    //data: dato//jQuery.parseJSON(dato),
                    },
                    responsive: true,
                    stateSave: true
                });
            });

            /*Ventas*/

            // Se muestra los datos en la "tabla compras", de acuerdo al panel de sombrero + panel fechas o solo panel fechas
            
            $.get('/ajax-ventasPorCodSombrero/'+$("#codigo").val(), function(data){
            $('#myTableVentas').DataTable().destroy();
            //success

            var numero_salida = 0;
            var cantidad_salida = 0;
            var precio_total = 0.0;
            $.each(data, function(index, venta){
                tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+venta.numero_venta+"</th><td>"+
                venta.fecha+"</td><td>"+venta.cantidad+"</td><td>"+venta.precio_total+"</td><td>"+venta.name+"</td><td>"+
                "<a href='javascript:verDetallesVenta("+venta.id+")' class='btn btn-outline-primary btn-sm ion-eye' title='ver'></a> "
                +"<a href='{{URL::to('gastronomica/sombreros/ventas/reporte/')}}/"+venta.id+"' target='_black' class='btn btn-outline-primary btn-sm ion-document-text'></a></td></tr>";
                n++;

                numero_salida++;
                cantidad_salida=cantidad_salida+parseInt(venta.cantidad);
                precio_total = precio_total+parseFloat(venta.precio_total);

                //$("#reporte").attr('href',"{{URL::to('reporteVentasPorFechas/')}}/"+fecha_inicio+"/"+fecha_fin+"/"+codigoSombrero);
            });
            $("#lista_ventas").html(tabla);

            $("#numero_salida").html(numero_salida);
            $("#cantidad_salida").html(cantidad_salida);
            $("#precio_total").html("S/ "+precio_total);  

            tabla = "";
            n=1;
            $('#myTableVentas').DataTable({
                    "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    //responsive: true,
                    //data: dato//jQuery.parseJSON(dato),
                    },
                    responsive: true,
                    stateSave: true
                });
            });
        } else {
            Messenger().post({message: mensaje,type:"error",showCloseButton:!0});
        }

        });

        function verDetallesGuiaIngreso(idGuia){
          $.get('/ajax-guiaIngresoDetalle/'+idGuia, function(data){
            //success
            var tabla = "";
            var n = 1;
            $.each(data, function(index, venta){
                tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+venta.empresa+"</th><td>"+venta.numero_orden+"</td><td>"+venta.codigo+
                "</td><td><img src='/images/sombreros/"+venta.photo+"' class='link_foto img-fluid pull-xs-left rounded' alt='...' width='28' data-toggle='modal'></td><td>"+
                venta.cantidad+"</td><td>"+venta.precio+"</td><td>S/ "+(venta.cantidad*venta.precio)+"</td><td>"+venta.descripcion+"</td></tr>";
                n++;
            });
            $("#list_guia_ingreso_detalle").html(tabla);
            tabla = "";
            $("#modalGuiaIngresoDetalle").modal("show");
          });
        }

        function verDetallesVenta(idVenta){
          $.get('/ajax-ventaDetalle/'+idVenta, function(data){
            //success
            var tabla = "";
            var n = 1;
            $.each(data, function(index, venta){
                tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+venta.codigo+
                "</th><td><img src='/images/sombreros/"+venta.photo+"' class='link_foto img-fluid pull-xs-left rounded' alt='...' width='28' data-toggle='modal'></td><td>"+
                venta.cantidad+"</td><td>"+venta.precio_venta+"</td><td>"+venta.porcentaje_descuento+"</td><td>"+venta.descuento+"</td><td>"+
                venta.sub_total+"</td><td>"+venta.descripcion+"</td></tr>";
                n++;
            });
            $("#lista_venta_detalle").html(tabla);
            tabla = "";
            $("#modalVentaDetalle").modal("show");
          });
        }

/*boton buscar*/
      $("#buscar").click(function(e){
        var mensaje = "";
        if ($("#check_panel_sombrero").is(':checked')) {
            if ($("#codigo").val()=="") {
            mensaje = mensaje + "* El codigo no debe estar vacío.<br/>";
            } else {
            if ($("#codigo").val().length!=13) {
                mensaje = mensaje + "* El codigo no tiene los 13 caracteres.<br/>";
            }
            }
        }
        if (mensaje=="") {
            var tabla = "";
            var n = 1;
            
            /*Guias Ingreso*/
            $.get('/ajax-guiasIngresoPorCodSombrero/'+$("#codigo").val(), function(data){
            $('#myTableGuiaIngreso').DataTable().destroy();
            //success
            var numero_ingreso = 0;
            var cantidad_ingreso = 0;
            var costo_total = 0.0;
            $.each(data, function(index, guia){
              tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+guia.numero_guia+"</th><td>"+
              guia.fecha+"</td><td>"+guia.cantidad_guia+
              "</td><td> S/ "+guia.precio_total+
              "</td><td><a href='javascript:verDetallesGuiaIngreso("+guia.id+")' class='btn btn-outline-primary btn-sm ion-eye' title='ver'></a> "
              +"<a href='{{URL::to('gastronomica/sombreros/ventas/reporte/')}}/"+guia.id+
              "' target='_black' class='btn btn-outline-primary btn-sm ion-document-text'></a></td></tr>";
                n++;

                numero_ingreso++;
                cantidad_ingreso=cantidad_ingreso+parseInt(guia.cantidad_guia);
                costo_total = costo_total+parseFloat(guia.precio_total);
            });
            $("#lista_guias").html(tabla);
            
            $("#numero_ingreso").html(numero_ingreso);
            $("#cantidad_ingreso").html(cantidad_ingreso);
            $("#costo_total").html("S/ "+costo_total);            

            tabla = "";
            n=1;
            $('#myTableGuiaIngreso').DataTable({
                    "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    //responsive: true,
                    //data: dato//jQuery.parseJSON(dato),
                    },
                    responsive: true,
                    stateSave: true
                });
            });

            /*Ventas*/

            // Se muestra los datos en la "tabla compras", de acuerdo al panel de sombrero + panel fechas o solo panel fechas
            
            $.get('/ajax-ventasPorCodSombrero/'+$("#codigo").val(), function(data){
            $('#myTableVentas').DataTable().destroy();
            //success

            var numero_salida = 0;
            var cantidad_salida = 0;
            var precio_total = 0.0;
            $.each(data, function(index, venta){
                tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+venta.numero_venta+"</th><td>"+
                venta.fecha+"</td><td>"+venta.cantidad+"</td><td>"+venta.precio_total+"</td><td>"+venta.name+"</td><td>"+
                "<a href='javascript:verDetallesVenta("+venta.id+")' class='btn btn-outline-primary btn-sm ion-eye' title='ver'></a> "
                +"<a href='{{URL::to('gastronomica/sombreros/ventas/reporte/')}}/"+venta.id+"' target='_black' class='btn btn-outline-primary btn-sm ion-document-text'></a></td></tr>";
                n++;

                numero_salida++;
                cantidad_salida=cantidad_salida+parseInt(venta.cantidad);
                precio_total = precio_total+parseFloat(venta.precio_total);

                //$("#reporte").attr('href',"{{URL::to('reporteVentasPorFechas/')}}/"+fecha_inicio+"/"+fecha_fin+"/"+codigoSombrero);
            });
            $("#lista_ventas").html(tabla);

            $("#numero_salida").html(numero_salida);
            $("#cantidad_salida").html(cantidad_salida);
            $("#precio_total").html("S/ "+precio_total);  

            tabla = "";
            n=1;
            $('#myTableVentas').DataTable({
                    "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    //responsive: true,
                    //data: dato//jQuery.parseJSON(dato),
                    },
                    responsive: true,
                    stateSave: true
                });
            });
        } else {
            Messenger().post({message: mensaje,type:"error",showCloseButton:!0});
        }

        });

        function verDetallesGuiaIngreso(idGuia){
          $.get('/ajax-guiaIngresoDetalle/'+idGuia, function(data){
            //success
            var tabla = "";
            var n = 1;
            $.each(data, function(index, venta){
                tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+venta.empresa+"</th><td>"+venta.numero_orden+"</td><td>"+venta.codigo+
                "</td><td><img src='/images/sombreros/"+venta.photo+"' class='link_foto img-fluid pull-xs-left rounded' alt='...' width='28' data-toggle='modal'></td><td>"+
                venta.cantidad+"</td><td>"+venta.precio+"</td><td>S/ "+(venta.cantidad*venta.precio)+"</td><td>"+venta.descripcion+"</td></tr>";
                n++;
            });
            $("#list_guia_ingreso_detalle").html(tabla);
            tabla = "";
            $("#modalGuiaIngresoDetalle").modal("show");
          });
        }

        function verDetallesVenta(idVenta){
          $.get('/ajax-ventaDetalle/'+idVenta, function(data){
            //success
            var tabla = "";
            var n = 1;
            $.each(data, function(index, venta){
                tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+venta.codigo+
                "</th><td><img src='/images/sombreros/"+venta.photo+"' class='link_foto img-fluid pull-xs-left rounded' alt='...' width='28' data-toggle='modal'></td><td>"+
                venta.cantidad+"</td><td>"+venta.precio_venta+"</td><td>"+venta.porcentaje_descuento+"</td><td>"+venta.descuento+"</td><td>"+
                venta.sub_total+"</td><td>"+venta.descripcion+"</td></tr>";
                n++;
            });
            $("#lista_venta_detalle").html(tabla);
            tabla = "";
            $("#modalVentaDetalle").modal("show");
          });
        }

        /*para mostrar foto grande*/
        $(".link_foto").css('cursor', 'pointer');
        $(".link_foto").click(function(e){
            $("#mostrar_foto").attr("src",$(this).attr("src"));
            $("#myModal").modal("show");
        });
</script>
@endsection