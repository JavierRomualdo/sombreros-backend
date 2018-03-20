@extends('layouts.master')
@section('title','Proveedores')
@section('content')

<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

<style type="text/css"> #divredondo, #estado_orden { height:20px; width:20px; border-radius:10px; } </style>
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Consultar /</li>
      </ul>
    </div>
  </div></br>
  <section class="forms">
    <div class="container-fluid">
      <!---->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Numero Orden:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese el codigo de orden compra.</p>
              <div class="form-group row">
                
                <label class="offset-sm-2 col-sm-1 col-2 form-control-label text-center"><strong>OC</strong></label>
                <label class="col-sm-1 col-1 form-control-label text-center"><strong>-</strong></label>
                <div class="col-sm-2 col-3">
                  <input type="text" id="numero" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4"/>
                </div>
                <label class="col-sm-1 col-1 form-control-label text-center"><strong>-</strong></label>
                <div class="col-sm-1 col-3">
                  <input type="text" id="numero_fecha" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="2"/>
                </div>
                <div class="col-sm-1  text-center">
                    <label title='' id="estado_orden"></label>
                  </div>
                <div class="offset-sm-2 col-sm-1 col-2">
                  <button type="button" name="buscar" id="buscar" class="btn btn-outline-primary ion-android-search rounded" title="buscar"></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Consolidado:</h2>
            </div>
            <div class="card-block">
              <p>Codigo: <strong id="numero_orden">##-####-##</strong></p>
              <div class="form-group row">
                <label class="col-sm-1 col-3 form-control-label" for="fecha"><strong>Fecha:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" id="fecha">##</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="fecha"><strong>Proveedor:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" id="proveedor">##</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="fecha"><strong>Cantidad Items:</strong></label>
                <div class="col-sm-1 col-3">
                  <label class="form-control-label" id="cantidad">##</label>
                </div>
                <label class="col-sm-1 col-3 form-control-label"><strong>Total:</strong></label>
                <div class="col-sm-1 col-3">
                  <label class="form-control-label" id="total">##</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--TABLA DETALLE ORDEN DE COMPRA-->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Detalles:</h2>
            </div>
            <div class="card-block miTabla">
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="myTableDetalles">
                  
                  <thead class="thead-inverse">
                    <tr>
                      <th>#</th>
                      <th>Articulo</th><!--Codigo Sombrero-->
                      <th>Foto</th>
                      <th>Cantidad</th>
                      <th>Ingresado</th>
                      <th>Pendientes</th>
                      <th>Precio Unitario</th>
                      <th>Precio Total</th>
                      <!--<th>Proveedor</th>-->
                      <th>Descripcion</th>
                      <th>Estado</th>
                      <th>Acciones</th>
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

    </div>
  </section>

  <!--Modal Guia Ingreso por cada orden de compra de detalle-->
  <div class="modal fade bd-example-modal-lg" id="modalguiaIngresos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h6 modal-title ion-paperclip" id="exampleModalLabel"> Guias Ingreso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
          <p>[ <strong>N° Guia: </strong> <label id="cantidad_guia"></label> / <strong>Cantidad Items: </strong> <label id="cantidad_items"></label> / <strong>Total: </strong> <label id="total_guia"></label> ]</p>
            <div class="table-responsive">
                
                <table class="table table-striped table-hover table-bordered specialCollapse" id="myTableGuiaIngreso"><!--table-responsive-->
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Codigo de Guia</th>
                            <th>Fecha Ingreso</th>
                            <th>Cantidad Items</th>
                            <th>Precio Total</th>
                            <th>Descripcion</th>
                        </tr>
                    </thead>
                <tbody id="lista_guia">
                </tbody>
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

  <!---->

  <!---->
  <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title ion-paperclip"> Sombrero</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <!--<img src="/images/sombreros/" class="rounded mx-auto d-block  img-fluid" id="mostrar_foto" alt="..." width="450px" height="453px">
          --><!--<p>¿Desea registrar mas ordenes de compra?</p>-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="aceptar">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!--modal para mostrar la foto del sombrero mas grande-->
  <div id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="h6 modal-title ion-paperclip"> Sombrero</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <img src="/images/sombreros/" class="rounded mx-auto d-block  img-fluid" id="mostrar_foto" alt="..." width="450px" height="453px">
            <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="aceptar">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!---->
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

  <!--Notificacion-->
  <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function(){
        $("#numero").html("");
        $("#numero_fecha").html("");
        Messenger().post({message:"Consulta orden de compra por código.",type:"info",showCloseButton:!0});
    });

    $("#buscar").click(function(e){
        var mensaje = "";
        if ($("#numero").val()==""){
            mensaje = mensaje + "* Ingrese el codigo de orden (1° campo)<br/>";
        }
        if ($("#numero_fecha").val()=="") {
            mensaje = mensaje + "* Ingrese el codigo de orden (2° campo).";
        }
        if(mensaje==""){
            var tabla = "";
            var n = 1;
            var numero_orden = "OC-"+$("#numero").val()+"-"+$("#numero_fecha").val();
            //Panel consolidado
            //N° de ventas
            //Los demas datos del panel consolidado
            $.get('/ajax-indexOrdenCompraConsolidado/'+numero_orden, function(data){
                //success
                $.each(data, function(index, consolidado){
                    $("#numero_orden").html(consolidado.numero_orden);
                    $("#fecha").html(consolidado.fecha);
                    $("#proveedor").html(consolidado.empresa);
                    $("#cantidad").html(consolidado.cantidad);
                    $("#total").html("S/"+parseFloat(consolidado.precio_total).toFixed(2));
                });
            });
            //Llena la tabla ventas
            $.get('/ajax-indexOrdenCompraDetalles/'+numero_orden, function(data){
              $('#myTableDetalles').DataTable().destroy();
                var bandera = false;
                //success
                $.each(data, function(index, orden){
                  if((parseInt(orden.cantidad)-parseInt(orden.cantidad_ingreso))==0){
                    tabla = tabla + "<tr class='fadeIn animated'><td>"+n+"</td><td>"+
                      orden.codigo+"</td><td> <img src='/images/sombreros/"+orden.photo+
                      "' class='link_foto img-fluid pull-xs-left rounded' alt='...' width='28' data-toggle='modal'>"+
                      "</td><td>"+orden.cantidad+"</td><td>"+orden.cantidad_ingreso+"</td><td>"+(parseInt(orden.cantidad)-parseInt(orden.cantidad_ingreso))+"</td><td>"+
                      orden.precio_unitario+"</td><td>"+(parseInt(orden.cantidad)*orden.precio_unitario)+"</td><td>"+orden.descripcion+
                      "</td><td><label style='background: green;' id='divredondo' title='completado'></label></td><td>"+
                      "<a href='javascript:verGuiaIngreso("+orden.id+","+orden.precio_unitario+")' class='btn btn-outline-primary btn-sm ion-android-checkbox-outline' title='ver guias ingreso'></a> "+
                      "</td></tr>";
                  } else {
                    tabla = tabla + "<tr class='fadeIn animated'><td>"+n+"</td><td>"+
                      orden.codigo+"</td><td> <img src='/images/sombreros/"+orden.photo+
                      "' class='link_foto img-fluid pull-xs-left rounded' alt='...' width='28' data-toggle='modal'>"+
                      "</td><td>"+orden.cantidad+"</td><td>"+orden.cantidad_ingreso+"</td><td>"+(parseInt(orden.cantidad)-parseInt(orden.cantidad_ingreso))+"</td><td>"+
                      orden.precio_unitario+"</td><td>"+(parseInt(orden.cantidad)*orden.precio_unitario)+"</td><td>"+orden.descripcion+
                        "</td><td><label style='background: red;' id='divredondo' title='pendiente'></label></td><td>"+
                      "<a href='javascript:verGuiaIngreso("+orden.id+","+orden.precio_unitario+")' class='btn btn-outline-primary btn-sm ion-android-checkbox-outline' title='ver guias ingreso'></a> "+
                      "</td></tr>";
                      bandera = true;
                  }
                    n++;
                });
                if(bandera){
                  $("#estado_orden").css({"background-color":"red"});
                  $("#estado_orden").attr("title","pendiente");
                } else {
                  $("#estado_orden").css({"background-color":"green"});
                  $("#estado_orden").attr("title","completado");                
                }
                $("#lista_datos").html(tabla);
                tabla = "";

                $('#myTableDetalles').DataTable({
                  "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    //responsive: true,
                    //data: dato//jQuery.parseJSON(dato),
                  },
                  responsive: true,
                  stateSave: true
                });
                //Foto

                /*pa la fpto del sombrero mas grande*/
                $(".link_foto").css('cursor', 'pointer');
                $(".link_foto").click(function(e){
                  $("#mostrar_foto").attr("src",$(this).attr("src"));
                  $("#modalFoto").modal("show");
                });
            });
        } else {
          Messenger().post({message: mensaje,type:"error",showCloseButton:!0});
        }
    });

    function verGuiaIngreso(idGuiaIngresoDetalle, precio_unitario){
        //Guia Ingreso cabevera
        $.get('/ajax-guiasIngresoPorOrdenCompraDetalleCabecera/'+idGuiaIngresoDetalle, function(data){
            //success
            $.each(data, function(index, cab){
                $("#cantidad_guia").html(cab.cantidad_guia);
                $("#cantidad_items").html(cab.cantidad_items);
                $("#total_guia").html(cab.cantidad_items*precio_unitario);
            });
            
        });
        //Llena la tabla de guias de ingreso
        var tabla = "";
        var n = 1;
        $.get('/ajax-guiasIngresoPorOrdenCompraDetalle/'+idGuiaIngresoDetalle, function(data){
            $('#myTableGuiaIngreso').DataTable().destroy();
            //success
            $.each(data, function(index, guia){
                console.log(guia);
                tabla = tabla + "<tr class='fadeIn animated'><td>"+n+"</td><td>"+guia.numero_guia+"</td><td>"+
                guia.fecha+"</td><td>"+guia.cantidadingreso+
                "</td><td>"+(guia.cantidadingreso*precio_unitario)+"</td><td>"+guia.descripcion+"</td></tr>";
                n++;
            });
            
            $("#lista_guia").html(tabla);
            tabla = "";
            //datatable guia ingreso
            $('#myTableGuiaIngreso').DataTable({
              "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
              },
              responsive: true,
              stateSave: true
            });
            $("#modalguiaIngresos").modal("show");
        });
    }

    
  </script>
@endsection
