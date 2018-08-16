<link rel="stylesheet" href="css/bootstrap.min.css">

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>
        <img class="rounded mx-auto d-block  img-fluid" src="images/sombreros/logo_sombreros.png" width="300" alt="First slide">
        <h3>Utilidades en Ventas</h3>
        <h4><span>{{$codigo}}  {!!$fecha!!}</span></h4>
      </center>
    </div>
  </div>

  <br/>
  <div class="row">
    <h4>Consolidado:</h4>
    <table class="table table-striped table-hover table-bordered">

      <thead class="thead-inverse">
        <tr>
          <th>#</th>
          <th>Codigo de Venta</th>
          <th># Documento</th>
          <th>Fecha</th>
          <th>Cantidad Items</th>
          <th>Precio Total</th>
          <th>Vendedor</th>
          <th>Utilidad</th>
        </tr>
      </thead>
      <tbody>
        <?php $total=0;?>
        @foreach ($detalles as $index=>$detalle)
          <tr class="fadeIn animated">
            <th scope="row">{{$index+1}}</th>
            <th>{{$detalle->numero_venta}}</th>
            <th>{{$detalle->numero_documento}}</th>
            <td>{{$detalle->fecha}}</td>
            <td>{{$detalle->cantidad}}</td>
            <td>S/. {{$detalle->precio_total}}</td>
            <td>{{$detalle->nombres}}</td>
            <td>S/. {{$detalle->utilidad}}</td>
            <?php $total += $detalle->utilidad?>
          </tr>
        @endforeach
        <tr class="fadeIn animated">
          <th class="text-center" colspan="7">Total</th>
          <th><?php echo("S/. ".$total); ?></th>
        </tr>
    </table>
  </div>
</div>
