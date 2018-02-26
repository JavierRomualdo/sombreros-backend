@extends('layouts.master')
@section('title','Proveedores')
@section('content')

<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Reporte por Cliente</li>
      </ul>
    </div>
  </div></br>
  <section class="forms">
    <div class="container-fluid">
      {!!Form::open(['action'=>'Compras\OrdenCompraController@store','method'=>'POST'])!!}
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display ion-paperclip fadeIn animated"> Panel Fechas:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese las fechas para la busqueda de ventas.</p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="empleado"><strong>Empleado (*):</strong></label>
                <div class="col-sm-6">
                    {!!form::text('empleado', null,['id'=>'empleado','name'=>'empleado','class'=>'form-control',
                    'placeholder'=>'Aqui el empleado','readonly'=>'true'])!!}
                </div>
                <div class="col-sm-4">
                    <div class="i-checks">
                      <input id="checkempleado" type="checkbox" value="" class="form-control-custom">
                      <label for="checkempleado">Selecione empleado</label>
                    </div>
                </div>
              </div>
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
              <h2 class="h6 display ion-paperclip fadeIn animated"> Informacion:</h2>
            </div>
            <div class="card-block">
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="numero_ventas"><strong>N° Ventas:</strong></label>
                <div class="col-sm-1">
                  <label class="form-control-label fadeIn animated" for="numero_ventas" id="numero_ventas">##</label>
                </div>
                <label class="col-sm-2 form-control-label" for="cantidad_venta"><strong>Cantidad Items:</strong></label>
                <div class="col-sm-1">
                  <label class="form-control-label fadeIn animated" for="cantidad_venta" id="cantidad_venta">##</label>
                </div>
                <label class="col-sm-2 form-control-label" for="total"><strong>Total Ventas (S/):</strong></label>
                <div class="col-sm-1">
                  <label class="form-control-label fadeIn animated" for="total" id="total">##</label>
                </div>
                <label class="col-sm-2 form-control-label" for="comision_total"><strong>Comision Total:</strong></label>
                <div class="col-sm-1">
                  <label class="form-control-label fadeIn animated" for="comision_total" id="comision_total">##</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Tabla-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display ion-paperclip fadeIn animated"> Tabla Ventas:</h2>
            </div>
            <div class="card-block miTabla">
              <a href="{{action('Reportes\ReporteController@reporteGeneralVentas')}}" id="reporte" class="disabled btn btn-outline-primary btn-sm margenInf ion-document-text" title="reporte" target="_blank"> Reporte</a><br/>
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="myTableVentas"><!--table-responsive-->
                  <thead class="thead-inverse">
                    <tr>
                      <th>#</th>
                      <th>Codigo de Venta</th>
                      <th>Fecha</th>
                      <th>Precio Total</th>
                      <th>Cantidad Items</th>
                      <th>Comision Empleado</th>
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
    <!---->
      <!--<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="h6 display ion-paperclip fadeIn animated modal-title" style="color:red;"> Errores</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <h2 id="errores">Errores</h2>-->
              <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
            <!--</div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="si">Aceptar</button>
            </div>
          </div>
        </div>
      </div>-->
      <!---->
      <!--Modal Empleados-->
    <div class="modal fade bd-example-modal-lg" id="modalEmpleados" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h6 display ion-paperclip fadeIn animated modal-title" id="exampleModalLabel"> Empleados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered specialCollapse" id="myTable"> <!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Encargo</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Dni</th>
                    <!--<th>Direccion</th>-->
                    <th>Telefono</th>
                    <!--<th>Email</th>-->
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($empleados as $index=>$empleado)
                    <tr class="fadeIn animated">
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$empleado->encargo}}</td>
                      <td>{{$empleado->nombres}}</td>
                      <td>{{$empleado->apellidos}}</td>
                      <td>{{$empleado->dni}}</td>
                      <!--<td>{ {$empleado->direccion}}</td>-->
                      <td>{{$empleado->telefono}}</td>
                      <!--<td>{ {$empleado->email}}</td>-->
                      <td>
                        <a href="javascript:mostrarEmpleado({{$empleado->id}},'{{$empleado->nombres}}', '{{$empleado->encargo}}');" class="btn btn-outline-primary btn-sm ion-android-done"></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cerar</button>
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

<script type="text/javascript">
$(document).ready(function(){
  $("#empleado").val("");
  $(document).ready(function(e){
        Messenger().post({message:"Reporte: ventas por empleado.",type:"info",showCloseButton:!0});
        $('#myTable').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            responsive: true
          }
        });
  });
});
var empleado_id = 0;
//Boton buscar
$("#buscar").click(function(e){
  var mensaje = "";
  if ($("#empleado").val()==""){
      mensaje = mensaje + "* Seleccione el empleado<br/>";
  }
  if ($("#fecha_inicio").val()=="") {
    mensaje = mensaje + "* La fecha de inicio no debe estar vacia.<br/>";
  }
  if ($("#fecha_fin").val()=="") {
    mensaje = mensaje + "* La fecha final no debe estar vacia.";
  }
  if (mensaje=="") {
    var tabla = "";
    var n = 1;
    //Panel consolidado
    //N° de ventas
    $.get('/ajax-numeroVentasPorEmpleadoConsolidado/'+empleado_id+'/'+$("#fecha_inicio").val()+'/'+
    $("#fecha_fin").val(), function(data){
        //success
        $.each(data, function(index, consolidado){
          $("#numero_ventas").html(consolidado.cantidad_venta);
        });
    });
    //Los demas datos del panel consolidado
    $.get('/ajax-reporteVentaPorEmpleadoConsolidado/'+empleado_id+'/'+$("#fecha_inicio").val()+'/'+
    $("#fecha_fin").val(), function(data){
        //success
        $.each(data, function(index, consolidado){
            $("#cantidad_venta").html(consolidado.cantidad_venta);
            $("#total").html(consolidado.total);
            $("#comision_total").html("S/. "+parseFloat(consolidado.comision_total).toFixed(2));
            
        });
    });
    //Llena la tabla ventas
    $.get('/ajax-reporteVentaPorEmpleado/'+empleado_id+'/'+$("#fecha_inicio").val()+'/'+
        $("#fecha_fin").val(), function(data){
          $('#myTableVentas').DataTable().destroy();
        //success
        var fecha_inicio = $("#fecha_inicio").val();
        var fecha_fin = $("#fecha_fin").val();
        $.each(data, function(index, venta){
            tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+venta.numero_venta+"</th><td>"+
            venta.fecha+"</td><td>S/ "+venta.precio_total+"</td><td>"+venta.cantidad+"</td><td>S/ "+parseFloat(venta.comision_empleado).toFixed(2)+"</td><td>"+
            "<a href='verventasporempleado/"+venta.id+"' class='btn btn-outline-primary btn-sm ion-eye' title='ver'></a> "
            +"<a href='{{URL::to('gastronomica/sombreros/reportes/reporteporempleado/')}}/"+venta.id+"' target='_black' class='btn btn-outline-primary btn-sm ion-document-text'></a></td></tr>";
            n++;
            $("#reporte").attr('href',"{{URL::to('reporteventasporempleado/')}}/"+empleado_id+"/"+fecha_inicio+"/"+fecha_fin);
        });
        
        $("#reporte").removeClass("disabled");
        $("#lista_datos").html(tabla);
        tabla = "";

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
    //
  } else {
    /*$("#errores").html(mensaje);
    $("#myModal").modal("show");*/
    Messenger().post({message: mensaje,type:"error",showCloseButton:!0});
  }

});

    //seleccionar el empleado
    $("#checkempleado").change(function(e){

      $('#modalEmpleados').modal('show');
    });
    function mostrarEmpleado(idEmpleado, nombres, encargo){
      empleado_id = idEmpleado;
      $("#empleado").val(nombres);
      $("#encargo").val(encargo);
      $('#modalEmpleados').modal('hide');
    }
</script>
@endsection
