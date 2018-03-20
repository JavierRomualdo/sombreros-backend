<link rel="stylesheet" href="css/bootstrap.min.css">

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>
        <img class="rounded mx-auto d-block  img-fluid" src="images/sombreros/logo_sombreros.png" width="300" alt="First slide">
        <h3>Reporte de Movimiento</h3>
        <h4><strong><span>{ {{$fecha_inicio}} - {{$fecha_fin}} }</span></strong></h4>
      </center>
    </div>
  </div><br/>
    <div class="row">
      <h4>Consolidado:</h4>
      <table class="table-striped table-hover table-bordered" width="1030px"><!---->
        <thead class="thead-inverse">
          <tr>
            <th>#</th>
            <th>Articulo</th>
            <th>Imagen</th>
            <th>Modelo</th>
            <th>Tejido</th>
            <th>Material</th>
            <th>Publico</th>
            <th>Talla</th>
            <th>Stock Actual</th>
            <th>Utilidad</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>1</th>
            <td>{!!$sombrero->codigo!!}</td>
            <td>
                <img src="images/sombreros/{!!$sombrero->photo!!}" class="img-fluid pull-xs-left rounded" alt="..." width="28">
            </td>
            <td>{!!$sombrero->modelo!!}</td>
            <td>{!!$sombrero->tejido!!}</td>
            <td>{!!$sombrero->material!!}</td>
            <td>{!!$sombrero->publico!!}</td>
            <td>{!!$sombrero->talla!!}</td>      
            <td>{!!$sombrero->stock_actual!!}</td>
            <td>S/ {!!$sombrero->utilidad!!}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <br/>
    <div class="row">
      <h4>Ingresos:</h4>
      <table class="table table-striped table-hover table-bordered">
        <?php $total=0; $cantidad=0;?>
        <thead class="thead-inverse">
          <tr>
            <th>#</th>
            <th>Codigo de Guia</th>
            <th>Fecha</th>
            <th>Costo Total</th>
            <th>Cantidad Items</th>
          </tr>
        </thead>
        <tbody>
          <?php $n=1;?>
          @foreach ($guias as $index=>$guia)
          <tr>
            <th scope="row">{{$n++}}</th>
            <td>{{$guia->numero_guia}}</td>
            <td>{{$guia->fecha}}</td>
            <td>S/ {{$guia->precio_total}}</td>
            <td>{{$guia->cantidad_guia}}</td>
            <?php $total += $guia->precio_total; $cantidad +=$guia->cantidad_guia;?>
          </tr>
        @endforeach
        <tr class="fadeIn animated">
          <th class="text-center" colspan="3">Total</th>
          <th><?php echo("S/. ".$total); ?></th>
          <th><?php echo($cantidad); ?></th>
        </tr>
      </table>
    </div><br/>
    <div class="row">
      <h4>Salidas:</h4>
      <table class="table table-striped table-hover table-bordered">
        <?php $total=0; $cantidad=0;?>
        <thead class="thead-inverse">
          <tr>
            <th>#</th>
            <th>Codigo de Venta</th>
            <th>Fecha</th>
            <th>Realizado</th>
            <th>Precio Total</th>
            <th>Cantidad Items</th>
          </tr>
        </thead>
        <tbody>
          <?php $n=1;?>
          @foreach ($ventas as $index=>$venta)
          <tr>
            <th scope="row">{{$n++}}</th>
            <td>{{$venta->numero_venta}}</td>
            <td>{{$venta->fecha}}</td>
            <td>{{$venta->nombres}}</td>
            <td>S/ {{$venta->precio_total}}</td>
            <td>{{$venta->cantidad}}</td>
            <?php $total += $venta->precio_total; $cantidad +=$venta->cantidad;?>
          </tr>
        @endforeach
        <tr class="fadeIn animated">
          <th class="text-center" colspan="4">Total</th>
          <th><?php echo("S/. ".$total); ?></th>
          <th><?php echo($cantidad); ?></th>
        </tr>
      </table>
    </div><br/>
    
    <!--<hr/>-->
</div>
