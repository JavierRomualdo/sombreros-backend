@extends('layouts.master')
@section('title','Guia Ingreso')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Guia Ingreso</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2 fadeIn animated text-center ion-clipboard"> Guia Ingreso</h1>
      </header>
      @include('partials.messages')
      
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h1 display ion-paperclip fadeIn animated title"> Historial:</h2>
            </div>
            <div class="card-block miTabla">
              <a href="{{url('/gastronomica/sombreros/guiaingreso/guiaingreso/create')}}" class="btn btn-outline-primary margenInf fadeIn animated btn-sm" title="nueva guia ingreso"><i class="ion-plus-round"></i> Nuevo</a> &nbsp;
              <table class="table table-striped table-hover table-bordered"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo de Guia</th>
                    <th>Fecha</th>
                    <th>Cantidad Items</th>
                    <th>Precio Total</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($guias as $index=>$guia)
                  <tr class="fadeIn animated">
                    <th scope="row">{{$index+1}}</th>
                    <td>{{$guia->numero_guia}}</td>
                    <td>{{$guia->fecha}}</td>
                    <td>{{$guia->cantidad_guia}}</td>
                    <td>{{$guia->precio_total}}</td>
                    <td>
                      <a href="{{action('Compras\GuiaIngresoController@ver',$guia->id)}}" class="btn btn-outline-primary btn-sm ion-eye" title="Ver"></a>
                      <a href="{{action('Compras\GuiaIngresoController@reporte',$guia->id)}}" target="_blank"
                        class="btn btn-outline-primary btn-sm ion-archive"></a>
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
