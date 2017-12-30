@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/reportes/compras')}}">Reporte Compras</a></li>
        <li class="breadcrumb-item active">Ver Compra</li>
      </ul>
    </div>
  </div></br>
  <section class="forms">
    <div class="container-fluid">
      <a href="{{action('Compras\OrdenCompraController@reporte',$orden->id)}}" target="_blank" class="btn btn-primary margenInf">Ver Reporte</a>
      <a href="{{action('Reportes\ReporteController@reporteDescargar',$orden->id)}}" id="descargar" class="btn btn-primary margenInf">Decargar</a>
      <!--<a href="{ {action('Sombreros\MovimientoController@reporte',$sombrero->id)}}" target="_blank" class="btn btn-primary margenInf">Reporte</a>
      -->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Datos del Orden de Compra:</h2>
            </div>
            <div class="card-block">
              <p>Codigo: <strong>{!!$orden->numero_orden!!}</strong></p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="fecha"><strong>Fecha:</strong></label>
                <div class="col-sm-4">
                  <label class="form-control-label" for="fecha">{!!$orden->fecha!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="precio_total"><strong>Precio Total:</strong></label>
                <div class="col-sm-4">
                  <label class="form-control-label" for="precio_total">{!!$orden->precio_total!!}</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--TABLA DETALLE ORDEN DE COMPRA-->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Detalles:</h2>
            </div>
            <div class="card-block">
              <table class="table table-striped table-hover table-bordered">

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo Sombrero</th>
                    <th>Foto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Precio Total</th>
                    <th>Proveedor</th>
                    <th>Descripcion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $n =1;?>
                  @foreach ($detalles as $index=>$detalle)
                    <tr>
                      <th scope="row">{{$n++}}</th>
                      <td>{{$detalle->codigo}}</td>
                      <td>
                        <img src="/images/sombreros/{{$detalle->photo}}" class="img-fluid pull-xs-left rounded" alt="..." width="28">
                      </td>
                      <td>{{$detalle->cantidad}}</td>
                      <td>{{$detalle->precio_unitario}}</td>
                      <td>{{$detalle->cantidad * $detalle->precio_unitario}}</td>
                      <td>{{$detalle->empresa}}</td>
                      <td>{{$detalle->descripcion}}</td>
                    </tr>
                  @endforeach
              </table>
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
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script type="text/javascript">
    $("#descargar").click(function(e){
      $("#myModal").modal("show");
    });
  </script>
@endsection
