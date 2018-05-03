@extends('layouts.master')
@section('title','Proveedores')
@section('content')
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">
<style type="text/css"> .divredondo, #estado_orden { height:20px; width:20px; border-radius:10px; } </style>
<div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Consultar /</li>
      </ul>
    </div>
  </div></br>
  <div class="container-fluid">
    @include('partials.messages')
  </div>
  <section class="forms">
    <div class="container-fluid">
      <!---->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display fadeIn animated ion-paperclip"> Panel Fechas:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese las fechas para la busqueda de ventas.</p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="fecha_inicio"><strong>Fecha Inicio (*):</strong></label>
                <div class="col-sm-3">
                  {!!Form::date('fecha_inicio', null,['id'=>'fecha_inicio','name'=>'fecha_inicio','class'=>'form-control'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="fecha_fin"><strong>Fecha Final (*):</strong></label>
                <div class="col-sm-3">
                  {!!Form::date('fecha_fin', \Carbon\Carbon::now(),['id'=>'fecha_fin','name'=>'fecha_fin','class'=>'form-control'])!!}
                </div>
                <div class="col-sm-1">
                  <div class="i-checks">
                    <input id="checkcancelacion" type="checkbox" value="" class="form-control-custom">
                    <label for="checkcancelacion">Cancelados</label>
                  </div>
                </div>
                <div class="col-sm-1">
                  <button type="button" name="buscar" id="buscar" class="btn btn-primary ion-android-search rounded" title="buscar"></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---->
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder fadeIn animated">
              <div class="card-header d-flex align-items-center">
                <h2 class="h6 display ion-paperclip fadeIn animated title"> Consolidados:</h2>
              </div>
            <div class="card-block miTabla">
              <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered" id="myTable"><!--table-responsive-->

                      <thead class="thead-inverse">
                        <tr>
                          <th>#</th>
                          <th>Codigo de Venta</th>
                          <th>Fecha</th>
                          <th>Items</th>
                          <th>Precio Total</th>
                          <th>Cliente</th>
                          <th>Vendedor</th>
                          <th>Estado</th>
                          <th>Accion</th>
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
    <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h6 display ion-paperclip fadeIn animated"> Detalles:</h2>
            </div>
            <div class="card-block miTabla">
              <div class="table-responsive">
                <p><strong>Codigo: </strong> <label id="numero_orden"></label></p>
                <table class="table table-striped table-hover table-bordered" id="myTableDetalles">
                  
                  <thead class="thead-inverse">
                    <tr>
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
                  <tbody id="lista_datos">
                </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---->
      </div>
    <!---->
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
    </section>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

    <!--Notificacion-->
    <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
    <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
    <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>

    <script>
    $(document).ready(function(e){
      Messenger().post({message:"Consulta ventas por cancelaciones.",type:"info",showCloseButton:!0});

      $('#myTableCliente').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        },
        responsive: true
      });
    });
    

      $("#buscar").click(function(e){
        var mensaje = "";
        if ($("#fecha_inicio").val()=="") {
            mensaje = mensaje + "* La fecha de inicio no debe estar vacia.<br/>";
        }
        if ($("#fecha_fin").val()=="") {
            mensaje = mensaje + "* La fecha final no debe estar vacia.";
        }
        if(mensaje==""){
            var tabla = "";
            var n = 1;
            var cancelacion = "N";
            var estado = "<label style='background: red' class='divredondo' title='cancelado'></label>";
            if ($("#checkcancelacion").is(':checked')) {
                cancelacion = 'S';
                estado = "<label style='background: green' class='divredondo' title='cancelado'></label>";
            }
            
            $.get('/ajax-ventasCancelacionFechas/'+cancelacion+'/'+$("#fecha_inicio").val()+'/'+
            $("#fecha_fin").val(), function(data){
            $('#myTable').DataTable().destroy();
            //success
            $.each(data, function(index, venta){
                tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+venta.numero_venta+"</th><td>"+
                venta.fecha+"</td><td>"+venta.cantidad+"</td><td>"+venta.precio_total+"</td><td>"+venta.cliente+"</td><td>"+
                venta.nombres+"</td><td class='text-center'>"+estado+"</td><td><a href='javascript:verDetallesVenta("+venta.id+")' class='btn btn-outline-primary btn-sm ion-eye' title='ver'></a>"
                +"</td></tr>";
                n++;
            });
            $("#lista_ventas").html(tabla);
            $('#myTableDetalles').DataTable().destroy();
            $("#lista_datos").html("");
            
            tabla = "";

            $('#myTable').DataTable({
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

    function verDetallesVenta($idVenta){
      $.get('/ajax-numeroVenta/'+$idVenta, function(data){
        //success
        $.each(data, function(index, cod){
          $("#numero_orden").html(cod.numero_venta);
        });
      });

      var tabla = "";
      var n = 1;
      //Llena la tabla orden compra detalle
      $.get('/ajax-ventaDetallesCliente/'+$idVenta, function(data){
        $('#myTableDetalles').DataTable().destroy();
        //success
        $.each(data, function(index, ventaDetalle){
          tabla = tabla + "<tr class='fadeIn animated'><td>"+n+"</td><td>"+
              ventaDetalle.codigo+"</td><td> <img src='/images/sombreros/"+ventaDetalle.photo+
              "' class='link_foto img-fluid pull-xs-left rounded' alt='...' width='28'>"+
              "</td><td>"+ventaDetalle.cantidad+"</td><td>S/ "+ventaDetalle.precio_venta+"</td><td>"+ventaDetalle.porcentaje_descuento+"</td><td>S/ "+
              ventaDetalle.descuento+"</td><td>S/ "+ventaDetalle.sub_total+"</td><td>"+ventaDetalle.descripcion+"</td></tr>";
            n++;
        });
        
        $("#lista_datos").html(tabla);
        tabla = "";
        $('#myTableDetalles').DataTable({
            "language": {
              "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            },
            responsive: true,
            stateSave: true
        });
        
        /*pa la fpto del sombrero mas grande*/
        $(".link_foto").css('cursor', 'pointer');
        $(".link_foto").click(function(e){
            $("#mostrar_foto").attr("src",$(this).attr("src"));
            $("#modalFoto").modal("show");
        });
      });
    }
    </script>
@endsection