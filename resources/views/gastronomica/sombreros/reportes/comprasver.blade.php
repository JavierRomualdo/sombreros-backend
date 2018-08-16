@extends('layouts.master')
@section('title','Proveedores')
@section('content')
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/reportes/compras')}}">Reporte orden compra</a></li>
        <li class="breadcrumb-item active">Ver</li>
      </ul>
    </div>
  </div></br>
  <section class="forms">
    <div class="container-fluid">
      <a href="{{action('Compras\OrdenCompraController@reporte',$orden->id)}}" target="_blank" class="btn btn-outline-primary btn-sm margenInf ion-document-text" title="reporte"> Reporte</a>
      <a href="{{action('Reportes\ReporteController@reporteDescargar',$orden->id)}}" id="descargar" class="btn btn-outline-primary btn-sm margenInf ion-ios-download-outline" title="descargar"> Decargar</a>
      <!--<a href="{ {action('Sombreros\MovimientoController@reporte',$sombrero->id)}}" target="_blank" class="btn btn-primary margenInf">Reporte</a>
      -->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Consolidado:</h2>
            </div>
            <div class="card-block">
              <p>Codigo: <strong>{!!$orden->numero_orden!!}</strong></p>
              <div class="form-group row">
                <label class="col-sm-2 col-3 form-control-label" for="fecha"><strong>Fecha:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" for="fecha">{!!$orden->fecha!!}</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="fecha"><strong>Cantidad Items:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" for="fecha">{!!$orden->cantidad!!}</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="precio_total"><strong>Costo Total:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" for="precio_total">S/{!!$orden->precio_total!!}</label>
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
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="myTable">

                <thead class="thead-inverse">
                  <tr>
                  <th class="text-center">#</th>
                  <th>Articulo</th><!--Codigo Sombrero-->
                  <th>Foto</th>
                  <th>Cantidad</th>
                  <th>Costo Articulo </th>
                  <th>Costo Total</th>
                  <th>Proveedor</th>
                  <th>Descripcion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $n =1;?>
                  @foreach ($detalles as $index=>$detalle)
                    <tr class="fadeIn animated">
                      <th scope="row" class="text-center">{{$n++}}</th>
                      <td>{{$detalle->codigo}}</td>
                      <td>
                        <img src="/images/sombreros/{{$detalle->photo}}" class="link_foto"
                        data-toggle="modal" class="img-fluid pull-xs-left rounded" alt="..." width="28"><!--data-target="#myModal"-->
                      </td>
                      <td>{{$detalle->cantidad}}</td>
                      <td>S/ {{$detalle->costounitario}}</td>
                      <td>S/ {{$detalle->cantidad * $detalle->costounitario}}</td>
                      <td>{{$detalle->empresa}}</td>
                      <td>{{$detalle->descripcion}}</td>
                    </tr>
                  @endforeach
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---->
      <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">Mensaje</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <h2>¡Se ha descargado correctamente!</h2>
              <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" id="si">Aceptar</button>
            </div>
          </div>
        </div>
      </div>
      <!---->
    </div>
  </section>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(e){
      $('#myTable').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          responsive: true
        },
        scrollY:        '70vh',
        //scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        fixedColumns:   {
          heightMatch: 'none'
        },
        fixedHeader: {
          header: true
        },
        sScrollX: true,
        sScrollXInner: "100%",
      });
  });
    $("#descargar").click(function(e){
      $("#myModal").modal("show");
    });
  </script>
@endsection
