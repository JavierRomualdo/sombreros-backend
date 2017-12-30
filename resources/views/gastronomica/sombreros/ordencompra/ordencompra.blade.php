@extends('layouts.master')
@section('title','Compras')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Orden de Compra</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h3">Historial / Orden de Compra:</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/ordencompra/ordencompra/create')}}" class="btn btn-primary margenInf">Nuevo</a> &nbsp;
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder">

            <div class="card-block miTabla">
              <table class="table table-striped table-hover table-bordered"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo de Orden</th>
                    <th>Fecha</th>
                    <th>Cantidad Items</th>
                    <th>Precio Total</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($ordenes as $index=>$orden)
                  <tr>
                    <th scope="row">{{$index+1}}</th>
                    <td>{{$orden->numero_orden}}</td>
                    <td>{{$orden->fecha}}</td>
                    <td>{{$orden->cantidad}}</td>
                    <td>{{$orden->precio_total}}</td>
                    <td>
                      <a href="{{action('Compras\OrdenCompraController@ver',$orden->id)}}" class="ion-eye" title="Ver">[Ver]</a>
                      <a href="{{action('Compras\OrdenCompraController@reporte',$orden->id)}}"
                        target="_blank" class="ion-archive">[Reporte]</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
