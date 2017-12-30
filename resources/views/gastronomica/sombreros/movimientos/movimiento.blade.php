@extends('layouts.master')
@section('title','Movimientos')
@section('content')

  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Movimientos</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h3>Lista de Movimientos:</h3>
      </header>
      @include('partials.messages')
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Buscar por:</h2>
            </div>
            <div class="card-block">
              <!--<div class="form-inline">
                <div class="form-group">
                  <label class="col-sm-2 form-control-label" for="idModelo"><strong>Modelo:</strong></label>

                </div>
              </div>-->
              {!!Form::open(['action'=>'Sombreros\SombreroController@store','method'=>'POST'])!!}
                <!--<div class="form-group row">
                  <label class="col-sm-2 form-control-label" for="codigo"><strong>Codigo:</strong></label>
                  <div class="col-sm-4">
                    {!!form::text('codigo', null,['id'=>'codigo','class'=>'form-control','placeholder'=>'Ingrese Codigo', 'autofocus','maxlength'=>'13'])!!}
                  </div>
                </div>-->
                
                <!--<div class="form-group row">
                  <label class="col-sm-2 form-control-label" for="idModelo"><strong>Modelo:</strong></label>
                  <div class="col-sm-4">
                    {! !Form::select('idModelo',$modelo, null,['id'=>'idModelo','name'=>'idModelo','class'=>'form-control'])!!}
                  </div>
                  <label class="col-sm-2 form-control-label" for="idMaterial"><strong>Material:</strong></label>
                  <div class="col-sm-4">
                    {! !Form::select('idMaterial',$material, null,['id'=>'idMaterial','name'=>'idMaterial','class'=>'form-control'])!!}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label" for="idTejido"><strong>Tejido:</strong></label>
                  <div class="col-sm-4">
                    {! !Form::select('idTejido',$tejido, null,['id'=>'idTejido','name'=>'idTejido','class'=>'form-control'])!!}
                  </div>
                  <label class="col-sm-2 form-control-label" for="idPublicoDirigido"><strong>Publico Dirigido:</strong></label>
                  <div class="col-sm-4">
                    {! !Form::select('idPublicoDirigido',$publicodirigido, null,['id'=>'idPublicoDirigido','name'=>'idPublicoDirigido','class'=>'form-control'])!!}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label" for="idTalla"><strong>Talla:</strong></label>
                  <div class="col-sm-4">
                    {! !Form::select('idTalla',$talla, null,['id'=>'idTalla','name'=>'idTalla','class'=>'form-control'])!!}
                  </div>
                  <label class="col-sm-2 -control-label" for="idProveedor"><strong>Proveedor:</strong></label>
                  <div class="col-sm-4">
                    {! !Form::select('idProveedor',$proveedor, null,['id'=>'idProveedor','name'=>'idProveedor','class'=>'form-control'])!!}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label">Fecha Inicio</label>
                  <div class="col-sm-4">
                    <input type="date" name="" value="" class="form-control form-control">
                  </div>
                  <label class="col-sm-2 form-control-label">Fecha Fin</label>
                  <div class="col-sm-4">
                    <input type="date" name="" value="" class="form-control form-control">
                  </div>
                </div>
                <div class="form-group">
                  <input type="submit" value="Buscar" class="mx-sm-3 btn btn-primary">
                </div>-->
                {!!Form::close()!!}
            </div>

          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <a href="{{url('/gastronomica/sombreros/movimientos/movimiento/create')}}" class="btn btn-primary margenInf" style="margin-top:10px;">Nuevo</a> &nbsp;
            </div>
            <div class="card-block">
              <table class="table table-striped table-hover table-bordered">
                <thead class="thead-inverse">
                  <tr>
                    <th rowspan="2">#</th>
                    <th rowspan="2">Codigo</th>
                    <th colspan="3">Entrada</th>
                    <th colspan="3">Salida</th>
                    <th colspan="2">Total</th>
                  </tr>
                  <tr>
                    <th>Cantidad</th>
                    <th>Stock Total</th>
                    <th>Precio Unit. Compra</th>
                    <th>Cantidad</th>
                    <th>Stock Total</th>
                    <th>Precio Unit. Venta</th>
                    <!--<th>Fecha Salida</th>
                    <th>Cant</th>
                    <th>Precio</th>-->
                    <th>Stock</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($movimientoscompra as $index=>$movimientocompra)
                      @if ($movimientocompra->idTipoMovimiento==1)
                        <tr>
                        <th>{{$index+1}}</th>
                        <th>{{$movimientocompra->codigo}}</th>
                        <td>{{$movimientocompra->total}}</td>
                        <td>{{$movimientocompra->cantidad}}</td>
                        <td>{{$movimientocompra->precio_compra}}</td>
                      @else
                        <td>{{$movimientocompra->total}}</td>
                        <td>{{$movimientocompra->cantidad}}</td>
                        <td>{{$movimientocompra->precio_venta}}</td>
                        <td>{{$movimientocompra->stock_actual}}</td>
                        <td>
                          <a href="{{action('Sombreros\MovimientoController@ver',$movimientocompra->id)}}">Ver</a>
                          <a href="{{action('Sombreros\MovimientoController@ver',$movimientocompra->id)}}" class="ion-eye" title="Ver"></a>
                        </td>
                        </tr>
                      @endif
                    @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="paginacion">
            {!!$movimientoscompra->links()!!}
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Javascript files-->
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/tether.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/jquery.cookie.js')}}"> </script>
  <script src="{{asset('bootstrap4/js/grasp_mobile_progress_circle-1.0.0.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/jquery.nicescroll.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/jquery.validate.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/Chart.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/charts-home.js')}}"></script>
  <script src="{{asset('bootstrap4/js/front.js')}}"></script>

@endsection
