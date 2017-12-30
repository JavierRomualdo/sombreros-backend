@extends('layouts.master')
@section('title','Guia Ingreso')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Guia Ingreso</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h3">Lista de Guía Ingreso:</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/guiaingreso/guiaingreso/create')}}" class="btn btn-primary margenInf">Nuevo</a> &nbsp;

      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder">

            <div class="card-block miTabla">
              <table class="table table-striped table-hover table-bordered"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Codigo de Guia</th>
                    <th>Cantidad</th>
                    <th>Proveedor</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($guias as $index=>$guia)
                  <tr>
                    <th scope="row">{{$index+1}}</th>
                    <td>{{$guia->fecha}}</td>
                    <td>{{$guia->numero_guia}}</td>
                    <td>{{$guia->cantidad}}</td>
                    <td>{{$guia->empresa}}</td>
                    <td>
                      <a href="{{action('Compras\GuiaIngresoController@ver',$guia->id)}}" class="ion-eye" title="Ver">[Ver]</a>
                      <a href="{{action('Compras\GuiaIngresoController@reporte',$guia->id)}}" target="_blank"
                        class="ion-archive">[Reporte]</a>
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
