@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/reportes/ventas')}}">Reporte Ventas</a></li>
        <li class="breadcrumb-item active">Ver</li>
      </ul>
    </div>
  </div></br>
  <section class="forms">
    <div class="container-fluid">
      <a href="{{action('Ventas\VentasController@reporte',$venta->id)}}" target="_blank" class="btn btn-primary margenInf">Reporte</a>
      <a href="{{action('Reportes\ReporteController@ventaDescarga',$venta->id)}}" id="descargar" class="btn btn-primary margenInf">Decargar</a>
      <!--<a href="{ {action('Sombreros\MovimientoController@reporte',$sombrero->id)}}" target="_blank" class="btn btn-primary margenInf">Reporte</a>
      -->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Datos de Orden de Venta:</h2>
            </div>
            <div class="card-block">
              <p>Codigo: <strong>{!!$venta->numero_venta!!}</strong></p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="fecha"><strong>Fecha:</strong></label>
                <div class="col-sm-2">
                  <label class="form-control-label" for="fecha">{!!$venta->fecha!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="precio_total"><strong>Precio Total:</strong></label>
                <div class="col-sm-2">
                  <label class="form-control-label" for="precio_total">{!!$venta->precio_total!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="user"><strong>Realizado por:</strong></label>
                <div class="col-sm-2">
                  <label class="form-control-label" for="user">{!!$venta->name!!}</label>
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
                    <th>Precio Venta</th>
                    <th>% Descuento</th>
                    <th>Descuento</th>
                    <th>Precio Total</th>
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
