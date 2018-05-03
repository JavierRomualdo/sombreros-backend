@extends('layouts.master')
@section('title','Proveedores')
@section('content')

<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">
<style type="text/css"> .divredondo, #estado_orden { height:20px; width:20px; border-radius:10px; } </style>

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/ventas/cancelaciones/cancelacion')}}">Cancelacion</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
      </ul>
    </div>
  </div></br>
  <section class="forms">
    <div class="container-fluid">
      <!--<header>
        <h1 class="h5 fadeIn animated text-center ion-clipboard"> Cancelacion Ventas</h1>
      </header>-->
      @include('partials.messages')
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h1 display ion-paperclip fadeIn animated title"> Consolidado:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese recibo provicional o numero cuenta con el banco respectivo para la nueva cancelacion de ventas.</p>
              <div class="form-group row">
                <label class="form-control-label col-sm-2"><strong>¿Que vas a ingresar?:</strong></label>
                <div class="i-checks col-sm-2"><!--mx-sm-2-->
                  <input id="radioRecibo" type="radio" checked="" value="option1" name="a" class="opcion form-control-custom radio-custom">
                  <label for="radioRecibo">Recibo Provicional</label>
                </div>
                <div class="i-checks col-sm-2">
                  <input id="radioCuenta" type="radio" value="option2" name="a" class="opcion form-control-custom radio-custom">
                  <label for="radioCuenta">Numero Cuenta</label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="reciboprovicional"><strong>Recibo Provicional:</strong></label>
                <div class="col-sm-4">
                  {!!Form::text('reciboprovicional', null,['id'=>'reciboprovicional','name'=>'stock_actual','class'=>'form-control',
                    'placeholder'=>'Ingrese el recibo provicional'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="banco"><strong>Banco:</strong></label>
                <div class="col-sm-4">
                  {!!Form::text('banco', null,['id'=>'banco','disabled','name'=>'precio_venta','class'=>'form-control',
                    'placeholder'=>'Ingrese el nombre del banco'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="numerocuenta"><strong>Numero Cuenta:</strong></label>
                <div class="col-sm-4">
                  {!!Form::text('numerocuenta', null,['id'=>'numerocuenta','disabled','name'=>'stock_actual','class'=>'form-control',
                    'placeholder'=>'Ingrese el numero cuenta', 'maxlength'=>11])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="fecha"><strong>Fecha:</strong></label>
                <div class="col-sm-4">
                  {!!Form::date('fecha', \Carbon\Carbon::now(),['id'=>'fecha','readonly'=>'true','name'=>'fecha_fin','class'=>'form-control'])!!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h1 display ion-paperclip fadeIn animated title"> Historial:</h2>
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
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($ventas as $index=>$venta)
                        <tr class="fadeIn animated">
                          <th scope="row">{{$index+1}}</th>
                          <th>{{$venta->numero_venta}}</th>
                          <td>{{$venta->fecha}}</td>
                          <td>{{$venta->cantidad}}</td>
                          <td>S/ {{$venta->precio_total}}</td>
                          <td>{{$venta->cliente}}</td>
                          <td>{{$venta->nombres}}</td>
                          <td class="text-center">
                              @if ($venta->estadocancelado == 'S')
                                <label style='background: green;' class='divredondo' id="lbl{{$venta->id}}" title='cancelado'></label>
                              @else
                                <label style='background: RED;' class='divredondo' id="lbl{{$venta->id}}" title='no cancelado'></label>
                              @endif
                          </td>
                          <td>
                            <button type="button" class="btn btn-primary btn-sm fa fa-save" title="Cancelar venta" id="btn{{$venta->id}}"
                            onclick="agregarCancelacion({{$venta->id}},'{{$venta->numero_venta}}')"></button>
                            <a href="javascript:verDetallesVenta({{$venta->id}},'{{$venta->numero_venta}}')" class="btn btn-outline-primary btn-sm ion-eye" title="Ver detalles venta"></a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Modal de venta detalle-->
    <div class="modal fade bd-example-modal-lg" id="modalVentaDetalle" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h6 modal-title ion-paperclip" id="exampleModalLabel"> Detalle de la Venta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <p>Codigo Venta: <strong id="codigoVenta"></strong></p>
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
  <!--Modal confirmar cancelacion venta-->
  <div id="modalCancelar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Cancelar Venta</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <p id="mensaje"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="guardar">Aceptar</button>          
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
  <!---->
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <!--Notificacion-->
  <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>
  <script>
    var venta_id = 0;
    var cancelacion_id = 0;
    $(document).ready(function(){
        Messenger().post({message:"¡ Nueva Cancelacion de Ventas !",type:"info",showCloseButton:!0});
    });

    $(".opcion").change(function(){
      limpiar();
      if ($("#radioRecibo").is(":checked")) {
        $("#banco").prop('disabled', 'disabled');
        $("#numerocuenta").prop('disabled', 'disabled');

        $("#reciboprovicional").removeAttr("disabled");
      } else if($("#radioCuenta").is(":checked")){
        $("#reciboprovicional").prop('disabled', 'disabled');

        $("#banco").removeAttr("disabled");
        $("#numerocuenta").removeAttr("disabled");
      }
    });

    function limpiar(){
      $("#reciboprovicional").val('');
      $("#banco").val('');
      $("#numerocuenta").val('');
    }

    function agregarCancelacion(idVenta, codigoventa){
        venta_id = idVenta;
        $("#mensaje").html("¿Esta seguro de cancelar la venta: "+codigoventa+"?");
        //Validar campos
        var mensaje = "";
        if($("#radioRecibo").is(":checked")){
          if($("#reciboprovicional").val()==""){
            mensaje = "* El recibo provicional no debe estar vacío.</br>";
          }
        } else {
          if($("#banco").val()==""){
            mensaje = "* El nombre banco no debe estar vacio.<br/>";
          }
          if($("#numerocuenta").val()==""){
            mensaje = mensaje + "* El numero cuenta no debe estar vacio.<br/>";
          }
        }
        if(mensaje!=""){
          Messenger().post({message: mensaje,type:"info",showCloseButton:!0});
        } else {
          $("#modalCancelar").modal("show");
        }
    }

    $("#guardar").click(function(){
      if(cancelacion_id==0){
        var reciboprovicional = "0";
        var banco = "0";
        var numerocuenta = "0";
        if($("#reciboprovicional").val()!=""){
            reciboprovicional = $("#reciboprovicional").val();
        }

        if($("#numerocuenta").val()!=""){
            banco = $("#banco").val();
            numerocuenta = $("#numerocuenta").val();
        }
        $.get('/ajax-nuevaCancelacion/'+reciboprovicional+"/"+banco+
        "/"+numerocuenta+"/"+$("#fecha").val()+"/"+venta_id, function(data){
            //success
            $.each(data, function(index, cancelacion){
                cancelacion_id = cancelacion.id;
                $("#reciboprovicional").prop('disabled', 'disabled');
                $("#banco").prop('disabled', 'disabled');
                $("#numerocuenta").prop('disabled', 'disabled');
                $("#lbl"+venta_id).removeAttr("style");
                $("#lbl"+venta_id).removeAttr("title");
                $("#lbl"+venta_id).attr('style','background: green');
                $("#lbl"+venta_id).attr('title','venta cancelada');
                $("#btn"+venta_id).prop('disabled','disabled');
                Messenger().post({message:"¡ Venta cancelada con éxito !",type:"info",showCloseButton:!0});
            });
        });
      } else {//agregar mas ventas en cancelacion
          $.get('/ajax-cancelarVenta/'+cancelacion_id+"/"+venta_id, function(data){
              //success
              $.each(data, function(index, cancelar){
                  cancelacion_id = cancelar.id;
                  $("#lbl"+venta_id).removeAttr("style");
                  $("#lbl"+venta_id).removeAttr("title");
                  $("#lbl"+venta_id).attr('style','background: green');
                  $("#lbl"+venta_id).attr('title','venta cancelada');
                  Messenger().post({message:"¡ Venta cancelada con éxito !",type:"info",showCloseButton:!0});
              });
          });
      }
    });

    function verDetallesVenta(idVenta, numero_venta){
      $("#codigoVenta").html(numero_venta);
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