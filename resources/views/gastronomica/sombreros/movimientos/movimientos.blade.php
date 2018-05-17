@extends('layouts.master')
@section('title','Movimientos')
@section('content')
<!--<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">-->
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

<div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Reporte Movimientos /</li>
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
                  <button type="button" name="buscar" id="buscar" class="btn btn-primary fa fa-search rounded" title="buscar"></button>
                  <a href="{{action('Reportes\ReporteController@reporteMovimientos')}}"
              id="reporte" class="btn btn-primary fa fa-file" title="reporte" target="_blank"> Reporte</a>
                  <!--<button type="button" name="mostrarTodo" id="mostrarTodo" class="btn btn-primary ion-clipboard" title="mostrar todo"></button>-->
                </div>
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
              <h2 class="h6 display ion-paperclip fadeIn animated"> Movimientos:</h2>
            </div>
            <div class="card-block miTabla">
              
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="myTable">
                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Articulo</th>
                    <th>Cantidad Ingreso</th>
                    <th>Costo Unitario</th>
                    <th>Costo Total</th>
                    <th>Cantidad Salida</th>
                    <th>Precio Unitario</th>
                    <th>Precio Total</th>
                    <th>Stock Actual</th>
                    <th>Valor</th>
                  </tr>
                </thead>
                <tbody id="lista_datos">
                    @foreach($movimientos as $index=>$movimiento)
                    <tr>
                        <th>{{$index+1}}</th>
                        <td>{{$movimiento->fecha}}</td>
                        <td>{{$movimiento->codigo}}</td>
                        @if($movimiento->cantidadsalida == '')
                            <td>{{$movimiento->cantidadingreso}}</td>
                            <td>S/ {{$movimiento->costounitario}}</td>
                            <td>S/ {{$movimiento->costototal}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$movimiento->cantidadsalida}}</td>
                            <td>S/ {{$movimiento->preciounitario}}</td>
                            <td>S/ {{$movimiento->preciototal}}</td>
                        @endif
                        <td>{{$movimiento->stock_actual}}</td>
                        <td>S/ {{$movimiento->valor}}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---->
    </div>
    </section>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

    <!--Notificacion-->
  <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>
    <script>
        $(document).ready(function(){
      $('#myTable').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          responsive: true
        }
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

      if (mensaje=="") {//osea no hay mensajes de errores
        var tabla = "";
        var n = 1;
        $.get('/ajax-reporteMovimientoPorFecha/'+$("#fecha_inicio").val()+'/'+
        $("#fecha_fin").val(), function(data){
          $('#myTable').DataTable().destroy();
          //success
          var fecha_inicio = $("#fecha_inicio").val();
          var fecha_fin = $("#fecha_fin").val();
          $.each(data, function(index, mov){
            tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><td>"+mov.fecha+"</td><td>"+
                mov.codigo+"</td>";
            if(mov.cantidadsalida==null){
              tabla = tabla + "<td>"+mov.cantidadingreso+"</td><td>S/ "+mov.costounitario+"</td><td>S/ "+
                mov.costototal+"</td><td></td><td></td><td></td>";
            } else{
              tabla = tabla +"<td></td><td></td><td></td><td>"+mov.cantidadsalida+"</td><td>S/ "+mov.preciounitario+"</td><td>S/ "+
                  mov.preciototal+"</td>";
            }
            tabla = tabla +"<td>"+
                mov.stock_actual+"</td><td>"+mov.valor+"</td></tr>";
            n++;
            $("#reporte").attr('href',"{{URL::to('reporteMovimientosPorFecha/')}}/"+fecha_inicio+"/"+fecha_fin);
            });
          $("#lista_datos").html(tabla);
          tabla = "";

          $('#myTable').DataTable({
            "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    },
                    responsive: true,
                    stateSave: true
                });
        });
      } else {
        Messenger().post({message: mensaje,type:"error",showCloseButton:!0});
      }
    });
  </script>
@endsection
