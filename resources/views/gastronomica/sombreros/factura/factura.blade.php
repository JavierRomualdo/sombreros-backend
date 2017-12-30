@extends('layouts.master')
@section('title','Facturas')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Facturas</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h3">Lista de Facturas:</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/factura/factura/create')}}" class="btn btn-primary margenInf">Nuevo</a> &nbsp;
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder">

            <div class="card-block miTabla">
              <table class="table table-striped table-hover table-bordered"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Numero de Factura</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Registrado Por</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($facturas as $index=>$factura)
                  <tr>
                    <th scope="row">{{$index+1}}</th>
                    <td>{{$factura->numero_factura}}</td>
                    <td>{{$factura->fecha}}</td>
                    <td>{{$factura->comprador}}</td>
                    <td>{{$factura->name}}</td>
                    <td>
                      <a href="{{action('Compras\FacturaController@ver',$factura->id)}}" class="ion-eye" title="Ver">[Ver]</a>
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
