@extends('layouts.master')
@section('title','Ventas')
@section('content')

<!--<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">-->
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Utilidad Comision</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2 fadeIn animated text-center ion-clipboard"> Utilidad - Comision</h1>
      </header>
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
                          <th>Codigo Venta</th>
                          <th>Fecha</th>
                          <th>Cantidad Items</th>
                          <th>Precio Neto</th>
                          <th>Costo</th>
                          <th>Utilidad</th>
                          <th>Cliente</th>
                          <th>Vendedor</th>
                          <th>Comision</th>
                          <th>Accion</th>
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
                          <td>S/ {{$venta->costo_total}}</td>
                          <td>S/ {{$venta->utilidad_total}}</td>
                          <td>{{$venta->cliente}}</td>
                          <td>{{$venta->nombres}}</td>
                          <td>S/ {{$venta->utilidad_total * ($venta->comision/100.00)}}
                          <td>
                            <a href="{{action('Ventas\UtilidadComisionController@ver',$venta->id)}}" class="btn btn-outline-primary btn-sm ion-eye" title="Ver"></a>
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
