@extends('layouts.master')
@section('title','Ventas')
@section('content')

<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Cancelacion</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h5 fadeIn animated text-center ion-clipboard"> Cancelacion Ventas</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/ventas/cancelaciones/cancelacion/create')}}" class="btn btn-outline-primary margenInf fadeIn animated btn-sm" title="nueva venta"><i class="ion-plus-round"></i> Nuevo</a> &nbsp;
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
                          <th>Fecha</th>
                          <th># Ventas</th>
                          <th># Items</th>
                          <th>Precio Total</th>
                          <th>Banco</th>
                          <th>Numero Cuenta</th>
                          <th>Recibo Provicional</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($cancelaciones as $index=>$cancelacion)
                        <tr class="fadeIn animated">
                          <th scope="row">{{$index+1}}</th>
                          <td>{{$cancelacion->fecha}}</td>
                          <td>{{$cancelacion->cantidad}}</td>
                          <td>{{$cancelacion->cantidaditems}}</td>
                          <td>{{$cancelacion->preciototal}}</td>
                          <td>{{$cancelacion->banco}}</td>
                          <td>{{$cancelacion->numerocuenta}}</td>
                          <td>{{$cancelacion->reciboprovicional}}</td>
                          <td>
                            <a href="{{action('Ventas\CancelacionController@ver',$cancelacion->id)}}" class="btn btn-outline-primary btn-sm ion-eye" title="Ver"></a>
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
