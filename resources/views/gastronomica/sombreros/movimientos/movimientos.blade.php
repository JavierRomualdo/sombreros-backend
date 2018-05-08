@extends('layouts.master')
@section('title','Movimientos')
@section('content')
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

<div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Reporte Movimientos /</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <br/>
    <!--Panel de fechas-->
    <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display fadeIn animated ion-paperclip"> Panel Fechas:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese las fechas para la busqueda de ordenes de compras.</p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="fecha_inicio"><strong>Fecha Inicio (*):</strong></label>
                <div class="col-sm-3">
                  {!!Form::date('fecha_inicio', null,['id'=>'fecha_inicio','name'=>'fecha_inicio','class'=>'form-control'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="fecha_fin"><strong>Fecha Final (*):</strong></label>
                <div class="col-sm-3">
                  {!!Form::date('fecha_fin', \Carbon\Carbon::now(),['id'=>'fecha_fin','name'=>'fecha_fin','class'=>'form-control'])!!}
                </div>
                <div class="col-sm-2">
                  <button type="button" name="buscar" id="buscar" class="btn btn-outline-primary ion-android-search rounded" title="buscar"></button>
                  <!--<button type="button" name="mostrarTodo" id="mostrarTodo" class="btn btn-outline-primary ion-clipboard" title="mostrar todo"></button>-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display ion-paperclip fadeIn animated"> Movimientos:</h2>
            </div>
            <div class="card-block miTabla">
              
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="myTable">
                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Articulo</th>
                    <th>Cantidad Ingreso</th>
                    <th>Costo Unitario</th>
                    <th>Costo Total</th>
                    <th>Cantidad Salida</th>
                    <th>Precio Unitario</th>
                    <th>Precio Total</th>
                    <th>Stock Actual</th>
                    <th>Valor</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($movimientos as $index=>$movimiento)
                    <tr>
                        <th>{{$index+1}}</th>
                        <td>{{$movimiento->codigo}}</td>
                        @if($movimiento->cantidadsalida == '')
                            <td>{{$movimiento->cantidadingreso}}</td>
                            <td>S/ {{$movimiento->costounitario}}</td>
                            <td>S/ {{$movimiento->costototal}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$movimiento->cantidadsalida}}</td>
                            <td>S/ {{$movimiento->preciounitario}}</td>
                            <td>S/ {{$movimiento->preciototal}}</td>
                        @endif
                        <td>{{$movimiento->stock_actual}}</td>
                        <td>S/ {{$movimiento->valor}}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---->
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
