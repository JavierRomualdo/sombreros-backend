<link rel="stylesheet" href="css/bootstrap.min.css">

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>
        <h2>Movimientos</h2>
        <p>Codigo: <span>{!!$sombrero->codigo!!}</span></p><br/>
        <img class="rounded mx-auto d-block  img-fluid" src="images/sombreros/{!!$sombrero->photo!!}" width="240px" height="180px" alt="First slide">
      </center>
    </div>
  </div>

  <div class="row">
    <h3>Sombrero</h3>
    <table class="table-striped table-hover table-bordered" width="730px">
      <tbody>
        <tr>
          <td><label class="form-control-label" for="nombres"><strong>Modelo:</strong></label></td>
          <td>{!!$modelo->modelo!!}</td>
          <td><label class="form-control-label" for="nombres"><strong>Tejido:</strong></label></td>
          <td>{!!$tejido->tejido!!}</td>
        </tr>
        <tr>
          <td><label class="form-control-label" for="nombres"><strong>Material:</strong></label></td>
          <td>{!!$material->material!!}</td>
          <td><label class="form-control-label" for="nombres"><strong>Publico:</strong></label></td>
          <td>{!!$publicodirigido->publico!!}</td>
        </tr>
        <tr>
          <td><label class="form-control-label" for="nombres"><strong>Talla:</strong></label></td>
          <td>{!!$talla->talla!!}</td>
          <td><label class="form-control-label" for="nombres"><strong>Precio Compra:</strong></label></td>
          <td>{!!$sombrero->precio_compra!!}</td>
        </tr>
        <tr>
          <td><label class="form-control-label" for="nombres"><strong>Precio Venta:</strong></label></td>
          <td>{!!$sombrero->precio_venta!!}</td>
          <td><label class="form-control-label" for="nombres"><strong>Stock Actual:</strong></label></td>
          <td>{!!$sombrero->stock_actual!!}</td>
        </tr>
        <tr>
          <td><label class="form-control-label" for="nombres"><strong>Stock Minimo:</strong></label></td>
          <td>{!!$sombrero->stock_minimo!!}</td>
          <td><label class="form-control-label" for="nombres"><strong>Stock Maximo:</strong></label></td>
          <td>{!!$sombrero->stock_maximo!!}</td>
        </tr>
        <tr>
          <td><label class="form-control-label" for="nombres"><strong>Proveedor:</strong></label></td>
          <td>{!!$proveedor->empresa!!}</td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
  <br/>
  <div class="row">
    <h3>Entradas</h3>
    <table class="table table-striped table-hover table-bordered">
      <thead>
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
  <div class="row">
    <h3>Salidas</h3>
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




<!-- Javascript files-->
