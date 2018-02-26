@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/reportes/ventasporempleado')}}">Reporte por Cliente</a></li>
        <li class="breadcrumb-item active">Ver</li>
      </ul>
    </div>
  </div></br>
  <section class="forms">
    <div class="container-fluid">
      <a href="{{action('Ventas\VentasController@reporteConComision',$venta->id)}}" target="_blank" class="btn btn-outline-primary btn-sm margenInf ion-document-text" title="reporte"> Reporte</a>
      <a href="{{action('Reportes\ReporteController@ventaPorEmpleadoDescarga',$venta->id)}}" id="descargar" class="btn btn-outline-primary btn-sm margenInf ion-ios-download-outline" title="descargar"> Decargar</a>
      <!--<a href="{ {action('Sombreros\MovimientoController@reporte',$sombrero->id)}}" target="_blank" class="btn btn-primary margenInf">Reporte</a>
      -->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h1 display ion-paperclip"> Consolidado:</h2>
            </div>
            <div class="card-block">
              <p>[ Realizado: <strong>{!!$venta->nombres!!}</strong> , Código: <strong>{!!$venta->numero_venta!!}</strong> ]</p>
              <div class="form-group row">
                <label class="col-sm-1 form-control-label" for="fecha"><strong>Fecha:</strong></label>
                <div class="col-sm-2">
                  <label class="form-control-label" for="fecha">{!!$venta->fecha!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="precio_total"><strong>Cantidad Items:</strong></label>
                <div class="col-sm-1">
                  <label class="form-control-label" for="precio_total">{!!$venta->cantidad!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="precio_total"><strong>Precio Total (S/):</strong></label>
                <div class="col-sm-1">
                  <label class="form-control-label" for="precio_total">{!!$venta->precio_total!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="user"><strong>Comision Empleado:</strong></label>
                <div class="col-sm-1">
                  <label class="form-control-label" for="user">{!!number_format($venta->comision_empleado, 2, '.', '')!!}</label>
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
              <h2 class="h1 display ion-paperclip"> Detalles:</h2>
            </div>
            <div class="card-block">
              <table class="table table-striped table-hover table-bordered">

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
                    <th>Comision (%)</th>
                    <th>Comision (S/.)</th>
                    <th>Descripcion</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($detalles as $index=>$detalle)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$detalle->codigo}}</td>
                      <td>
                        <img src="/images/sombreros/{{$detalle->photo}}" class="img-fluid pull-xs-left rounded" alt="..." width="28">
                      </td>
                      <td>{{$detalle->cantidad}}</td>
                      <td>{{$detalle->precio_venta}}</td>
                      <td>{{$detalle->porcentaje_descuento}}</td>
                      <td>{{$detalle->descuento}}</td>
                      <td>{{$detalle->sub_total}}</td>
                      <td>{{$detalle->comisionempleado}}</td>
                      <td>{{($detalle->precio_venta/100.00)*$detalle->comisionempleado}}</td>
                      <td>{{$detalle->descripcion}}</td>
                    </tr>
                  @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
