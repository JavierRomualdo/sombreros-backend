<link rel="stylesheet" href="css/bootstrap.min.css">

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>
        <img class="rounded mx-auto d-block  img-fluid" src="images/sombreros/logo_sombreros.png" width="300" alt="First slide">
        <h3>Compras en general</h3>
      </center>
    </div>
  </div><br/>
  @foreach ($ordenes as $index => $orden)
    <div class="row">
      <h5>Compra N°: {{$index+1}}</h5>
      <table class="table-striped table-hover table-bordered" width="730px">
        <tbody>
          <tr>
            <td><label class="col-sm-2 form-control-label" for="fecha"><strong>Fecha:</strong></label></td>
            <td>{!!$orden->fecha!!}</td>
            <td><label class="col-sm-2 form-control-label" for="precio_total"><strong>Precio Total:</strong></label></td>
            <td>{!!$orden->precio_total!!}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <br/>
    <div class="row">
      <table class="table table-striped table-hover table-bordered">

        <thead class="thead-inverse">
          <tr>
            <th>#</th>
            <th>Codigo Sombrero</th>
            <th>Foto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Precio Total</th>
            <th>Proveedor</th>
            <th>Descripcion</th>
          </tr>
        </thead>
        <tbody>
          <?php $n=1;?>
          @foreach ($detalles as $key => $detalle)
            @if ($detalle->idOrdenCompra == $orden->id)
              <tr>
                <th scope="row">{{$n++}}</th>
                <td>{{$detalle->codigo}}</td>
                <td>
                  <img src="images/sombreros/{{$detalle->photo}}" class="img-fluid pull-xs-left rounded" alt="..." width="28">
                </td>
                <td>{{$detalle->cantidad}}</td>
                <td>{{$detalle->precio_unitario}}</td>
                <td>{{$detalle->cantidad * $detalle->precio_unitario}}</td>
                <td>{{$detalle->empresa}}</td>
                <td>{{$detalle->descripcion}}</td>
              </tr>
            @endif
        @endforeach
      </table>
    </div>
    <hr/>
  @endforeach
</div>
