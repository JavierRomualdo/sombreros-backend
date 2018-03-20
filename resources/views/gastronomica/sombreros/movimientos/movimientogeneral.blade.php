@extends('layouts.master')
@section('title','Movimiento General')
@section('content')

<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

<div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Reporte movimiento general /</li>
      </ul>
    </div>
  </div>

  <section class="forms">
    <div class="container-fluid">
      <br/>
    <!--Panel de fechas-->
    <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display fadeIn animated ion-paperclip"> Panel Fechas:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese las fechas para la busqueda de ordenes de compras.</p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="fecha_inicio"><strong>Fecha Inicio (*):</strong></label>
                <div class="col-sm-3">
                  {!!Form::date('fecha_inicio', null,['id'=>'fecha_inicio','name'=>'fecha_inicio','class'=>'form-control'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="fecha_fin"><strong>Fecha Final (*):</strong></label>
                <div class="col-sm-3">
                  {!!Form::date('fecha_fin', \Carbon\Carbon::now(),['id'=>'fecha_fin','name'=>'fecha_fin','class'=>'form-control'])!!}
                </div>
                <div class="col-sm-2">
                  <button type="button" name="buscar" id="buscar" class="btn btn-outline-primary ion-android-search rounded" title="buscar"></button>
                  <!--<button type="button" name="mostrarTodo" id="mostrarTodo" class="btn btn-outline-primary ion-clipboard" title="mostrar todo"></button>-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Panel articulos-->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Articulos:</h2>
            </div>
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="myTableArticulos">
                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Articulo</th>
                    <th>Imagen</th>
                    <th>Stock Actual</th>
                    <th>Utilidad</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody id="lista_articulos">
                </tbody>
              </table>
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
              <h2 class="h5 display ion-paperclip fadeIn animated"> Movimiento:</h2>
            </div>
            <div class="card-block">
              <p><strong>Articulo: </strong> <label id="codigo_articulo"></label></p>
              
              <!--<p>Ingresos</p>-->
              <div class="form-group row">
                <label class="col-sm-2 col-3 form-control-label"><strong># Ingresos:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" id="numero_ingreso">##</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="fecha"><strong>Items:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" id="cantidad_ingreso">##</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label"><strong>Costo Total:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" id="costo_total">##</label>
                </div>
              </div>
              <!--<p>Salidas</p>-->
              <div class="form-group row">
                <label class="col-sm-2 col-3 form-control-label"><strong># Salidas:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" id="numero_salida">##</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="fecha"><strong>Items:</strong></label>
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
      <!---->
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
      <!--Panel de ventas-->
    </div>
    <!--Modal de guia ingreso detalle-->
    <div class="modal fade bd-example-modal-lg" id="modalGuiaIngresoDetalle" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h6 modal-title ion-paperclip" id="exampleModalLabel"> Guia Ingreso</h5>
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
    <!---->
  </section>

  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

  <!--Notificacion-->
  <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>
  <script>
    function verGuiasAndSalidas(id){
      var codigoSombrero = "0";
      $.get('/ajax-mostrarCodSombrero/'+id, function(data){
          $.each(data, function(index, cod){
            codigoSombrero = cod.codigo;
            
        });
        $("#codigo_articulo").html(codigoSombrero);
    });
    
      var tabla = "";
      var n = 1;
      /*Guias Ingreso*/
      $.get('/ajax-guiasIngreso/'+id+"/"+$("#fecha_inicio").val()+'/'+
        $("#fecha_fin").val(), function(data){
            $('#myTableGuiaIngreso').DataTable().destroy();
            //success
            var numero_ingreso = 0;
            var cantidad_ingreso = 0;
            var costo_total = 0.0;
            var fecha_inicio = $("#fecha_inicio").val();
            var fecha_fin = $("#fecha_fin").val();
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
            
            $.get('/ajax-movVentas/'+id+'/'+$("#fecha_inicio").val()+'/'+
            $("#fecha_fin").val(), function(data){
            $('#myTableVentas').DataTable().destroy();
            //success
            var fecha_inicio = $("#fecha_inicio").val();
            var fecha_fin = $("#fecha_fin").val();

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

                $("#reporte").attr('href',"{{URL::to('reporteVentasPorFechas/')}}/"+fecha_inicio+"/"+fecha_fin+"/"+codigoSombrero);
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
    }
    /*boton buscar*/
      $("#buscar").click(function(e){
        var mensaje = "";
        
        if ($("#fecha_inicio").val()=="") {
            mensaje = mensaje + "* La fecha de inicio no debe estar vacia.<br/>";
        }
        if ($("#fecha_fin").val()=="") {
            mensaje = mensaje + "* La fecha final no debe estar vacia.";
        }
        if (mensaje=="") {
            var tabla = "";
            var n = 1;
            $.get('/ajax-movimientoArticulos/', function(data){
              $('#myTableArticulos').DataTable().destroy();
              $.each(data, function(index, sombrero){
                tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+sombrero.codigo+"</th><td> <img src='/images/sombreros/"+sombrero.photo+
                      "' class='link_foto img-fluid pull-xs-left rounded' alt='...' width='28' data-toggle='modal'>"+
                      "</td><td>"+sombrero.stock_actual+"</td><td>"+sombrero.utilidad+"</td><td>"+
                "<a href='javascript:verGuiasAndSalidas("+sombrero.id+")' class='btn btn-outline-primary btn-sm ion-android-done' title='mostrar'></a>"+
                " <a href='{{URL::to('gastronomica/sombreros/movimiento/articulo/')}}/"+sombrero.id+"/"+$("#fecha_inicio").val()+"/"+$("#fecha_fin").val()+"' target='_black' class='btn btn-outline-primary btn-sm ion-document-text'></a></td></tr> ";
                n++;
              });
              $("#lista_articulos").html(tabla);
              $('#myTableArticulos').DataTable({
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
            $.each(data, function(index, guiaDetalle){
                tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+guiaDetalle.empresa+"</th><td>"+guiaDetalle.numero_orden+"</td><td>"+guiaDetalle.codigo+
                "</td><td><img src='/images/sombreros/"+guiaDetalle.photo+"' class='link_foto img-fluid pull-xs-left rounded' alt='...' width='28' data-toggle='modal'></td><td>"+
                    guiaDetalle.cantidad+"</td><td>"+guiaDetalle.precio+"</td><td>S/ "+(guiaDetalle.cantidad*guiaDetalle.precio)+"</td><td>"+guiaDetalle.descripcion+"</td></tr>";
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
  </script>
  @endsection