@extends('layouts.master')
@section('title','Ventas')
@section('content')

<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Ventas</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h5 fadeIn animated text-center ion-clipboard"> Ventas</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/ventas/ventas/create')}}" class="btn btn-outline-primary margenInf fadeIn animated btn-sm" title="nueva venta"><i class="ion-plus-round"></i> Nuevo</a> &nbsp;
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h1 display ion-paperclip fadeIn animated title"> Historial:</h2>
            </div>
            <div class="card-block miTabla">
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered" id="myTable"><!--table-responsive-->

                      <thead class="thead-inverse">
                        <tr>
                          <th>#</th>
                          <th>Codigo de Venta</th>
                          <th>Fecha</th>
                          <th>Cantidad Items</th>
                          <th>Precio Total</th>
                          <th>Realizado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($ventas as $index=>$venta)
                        <tr class="fadeIn animated">
                          <th scope="row">{{$index+1}}</th>
                          <th>{{$venta->numero_venta}}</th>
                          <td>{{$venta->fecha}}</td>
                          <td>{{$venta->cantidad}}</td>
                          <td>S/ {{$venta->precio_total}}</td>
                          <td>{{$venta->nombres}}</td>
                          <td>
                            <a href="{{action('Ventas\VentasController@ver',$venta->id)}}" class="btn btn-outline-primary btn-sm ion-eye" title="Ver"></a>
                            <a href="{{action('Ventas\VentasController@reporte',$venta->id)}}" target="_blank" class=" btn btn-outline-primary btn-sm ion-document-text" title="reporte"></a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
          </div>
        </div>
      </div>
      <!--<div class="container">
        <div class="paginacion">
          { !!$ventas->links()!!}
        </div>
      </div>-->
    </div>
  </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script>
    $(document).ready(function(){
      $('#myTable').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          responsive: true
        }
      });
    });
  </script>
@endsection
