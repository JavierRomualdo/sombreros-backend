@extends('layouts.master')
@section('title','Sombreros')
@section('content')

  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/movimientos/movimiento')}}">Movimientos</a></li>
        <li class="breadcrumb-item active">Ver Movimiento</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <br/>
      <a href="{{action('Sombreros\MovimientoController@reporte',$sombrero->id)}}" target="_blank" class="btn btn-primary margenInf">Reporte</a>
      <div class="row">
        <div class="offset-lg-0 col-lg-6">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Datos del Sombrero:</h2>
            </div>
            <div class="card-block">
              {!!Form::model($sombrero, ['action'=>['Sombreros\SombreroController@update',$sombrero->id],'method'=>'PUT'])!!}
              <p>Codigo: <strong>{!!$sombrero->codigo!!}</strong></p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Modelo:</strong></label>
                <div class="col-sm-4">
                  {!!form::label('codigo:',$modelo,['for'=>'codigo','id'=>'codigo','name'=>'codigo'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Tejido:</strong></label>
                <div class="col-sm-4">
                  {!!form::label('codigo:',$tejido,['for'=>'codigo','id'=>'codigo','name'=>'codigo'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Material:</strong></label>
                <div class="col-sm-4">
                  {!!form::label('codigo:',$material,['for'=>'codigo','id'=>'codigo','name'=>'codigo'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Publico:</strong></label>
                <div class="col-sm-4">
                  {!!form::label('codigo:',$publicodirigido,['for'=>'codigo','id'=>'codigo','name'=>'codigo'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Talla:</strong></label>
                <div class="col-sm-4">
                  {!!form::label('codigo:',$talla,['for'=>'codigo','id'=>'codigo','name'=>'codigo'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Precio Compra:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$sombrero->precio_compra!!}</label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Precio Venta:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$sombrero->precio_venta!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Stock Actual:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$sombrero->stock_actual!!}</label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Stock Minimo:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$sombrero->stock_minimo!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Stock Maximo:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$sombrero->stock_maximo!!}</label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Proveedor:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$proveedor->empresa!!}</label>
                </div>
              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Imagen: <span>{{$sombrero->photo}}</span></h2>
            </div>
            <div class="card-block">
              <img class="rounded mx-auto d-block  img-fluid" src="/images/sombreros/{{$sombrero->photo}}" width="380px" height="343px" alt="First slide">
            </div>
          </div>

        </div>
      </div>
      <!--TABLA COMPRA-->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Lista Compras:</h2>
            </div>
            <div class="card-block">
              <table class="table table-striped table-hover table-bordered">

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo</th>
                    <th>Tipo Movimiento</th>
                    <th>Cantidad Compra</th>
                    <th>Precio Compra</th>
                    <th>Fecha Compra</th>
                    <th>Usuario</th>
                    <th>Descripcion</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($movimientoscompra as $index=>$movimientocompra)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$movimientocompra->codigo}}</td>
                      <td>{{$movimientocompra->tipo_movimiento}}</td>
                      <td>{{$movimientocompra->cantidad}}</td>
                      <td>{{$movimientocompra->precio_compra}}</td>
                      <td>{{$movimientocompra->fecha}}</td>
                      <td>{{$movimientocompra->name}}</td>
                      <td>{{$movimientocompra->descripcion}}</td>
                    </tr>
                  @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
      <!--TABLA VENTA-->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Lista Ventas:</h2>
            </div>
            <div class="card-block">
              <table class="table table-striped table-hover table-bordered">

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo</th>
                    <th>Tipo Movimiento</th>
                    <th>Cantidad Venta</th>
                    <th>Precio Venta</th>
                    <th>Fecha Venta</th>
                    <th>Usuario</th>
                    <th>Descripcion</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($movimientosventa as $index=>$movimientoventa)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$movimientoventa->codigo}}</td>
                      <td>{{$movimientoventa->tipo_movimiento}}</td>
                      <td>{{$movimientoventa->cantidad}}</td>
                      <td>{{$movimientoventa->precio_venta}}</td>
                      <td>{{$movimientoventa->fecha}}</td>
                      <td>{{$movimientoventa->name}}</td>
                      <td>{{$movimientoventa->descripcion}}</td>
                    </tr>
                  @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
