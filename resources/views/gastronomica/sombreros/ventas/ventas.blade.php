@extends('layouts.master')
@section('title','Ventas')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Ventas</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h3">Lista de Ventas:</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/ventas/ventas/create')}}" class="btn btn-primary margenInf">Nuevo</a> &nbsp;

      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder">

            <div class="card-block miTabla">
              <table class="table table-striped table-hover table-bordered"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo de Venta</th>
                    <th>Fecha</th>
                    <th>Precio Total</th>
                    <th>Realizado por</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($ventas as $index=>$venta)
                  <tr>
                    <th scope="row">{{$index+1}}</th>
                    <td>{{$venta->numero_venta}}</td>
                    <td>{{$venta->fecha}}</td>
                    <td>{{$venta->precio_total}}</td>
                    <td>{{$venta->name}}</td>
                    <td>
                      <a href="{{action('Ventas\VentasController@ver',$venta->id)}}" class="ion-eye" title="Ver">[Ver]</a>
                      <a href="{{action('Ventas\VentasController@reporte',$venta->id)}}" target="_blank" class="ion-archive">Reporte</a>
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
