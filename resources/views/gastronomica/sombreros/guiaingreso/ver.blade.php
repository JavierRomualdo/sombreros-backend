@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/guiaingreso/guiaingreso')}}">Guia de Ingreso</a></li>
        <li class="breadcrumb-item active">Ver</li>
      </ul>
    </div>
  </div></br>
  <section class="forms">
    <div class="container-fluid">
      <a href="{{action('Compras\GuiaIngresoController@reporte',$guia->id)}}" target="_blank" class="btn btn-primary margenInf">Reporte</a>
      <!--<a href="{ {action('Sombreros\MovimientoController@reporte',$sombrero->id)}}" target="_blank" class="btn btn-primary margenInf">Reporte</a>
      -->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Datos del Guia de Ingreso:</h2>
            </div>
            <div class="card-block">
              <p>Codigo: <strong>{!!$guia->numero_guia!!}</strong></p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="fecha"><strong>Fecha:</strong></label>
                <div class="col-sm-2">
                  <label class="form-control-label" for="fecha">{!!$guia->fecha!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="precio_total"><strong>Cantidad Total:</strong></label>
                <div class="col-sm-2">
                  <label class="form-control-label" for="precio_total">{!!$guia->cantidad!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="precio_total"><strong>Proveedor:</strong></label>
                <div class="col-sm-2">
                  <label class="form-control-label" for="precio_total">{!!$guia->empresa!!}</label>
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
