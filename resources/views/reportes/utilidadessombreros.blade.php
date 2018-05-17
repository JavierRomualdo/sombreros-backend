<link rel="stylesheet" href="css/bootstrap.min.css">

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>
        <img class="rounded mx-auto d-block  img-fluid" src="images/sombreros/logo_sombreros.png" width="300" alt="First slide">
        <h3>Utilidades en Sombreros</h3>
        <h4><span>{!!$fecha!!}</span></h4>
      </center>
    </div>
  </div>

  <br/>
  <div class="row">
    <h4>Consolidado:</h4>
    <table class="table table-striped table-hover table-bordered">
      <?php $total=0;?>
      <thead class="thead-inverse">
        <tr>
          <th>#</th>
          <th>Articulo</th>
          <th>Foto</th>
          <th>Modelo</th>
          <th>Tejido</th>
          <th>Material</th>
          <th>Publico</th>
          <th>Talla</th>
          <!--<th>Precio Compra</th>-->
          <th>Precio Venta</th>
          <th>Utilidad</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($utilidades as $index=>$utilidad)
          <tr>
            <th scope="row">{{$index+1}}</th>
            <td>{{$utilidad->codigo}}</td>
            <td>
              <img src="images/sombreros/{{$utilidad->photo}}" class="img-fluid pull-xs-left rounded" alt="..." width="28">
            </td>
            <td>{{$utilidad->modelo}}</td>
            <td>{{$utilidad->tejido}}</td>
            <td>{{$utilidad->material}}</td>
            <td>{{$utilidad->publico}}</td>
            <td>{{$utilidad->talla}}</td>
            <!--<td>S/. { {$utilidad->precio}}</td>-->
            <td>S/. {{$utilidad->precio_venta}}</td>
            <td>S/. {{$utilidad->utilidad}}</td>
            <?php $total += $utilidad->utilidad?>
          </tr>
        @endforeach
        <tr class="fadeIn animated">
          <th class="text-center" colspan="9">Total</th>
          <th><?php echo("S/. ".$total); ?></th>
        </tr>
    </table>
  </div>
</div>
