<link rel="stylesheet" href="css/bootstrap.min.css">

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>
        <img class="rounded mx-auto d-block  img-fluid" src="images/sombreros/logo_sombreros.png" width="300" alt="First slide">
        <h3>Orden de Compra</h3>
        <p>Codigo: <span>{!!$orden->numero_orden!!}</span></p><br/>
      </center>
    </div>
  </div>

  <div class="row">
    <h4>Consolidado:</h4>
    <table class="table-striped table-hover table-bordered" width="1030px"><!--vertical: width="730px"-->
      <tbody>
        <tr>
          <td><label class="col-sm-2 form-control-label" for="fecha"><strong>Fecha:</strong></label></td>
          <td>{!!$orden->fecha!!}</td>
          <td><label class="col-sm-2 form-control-label" for="fecha"><strong>Proveedor:</strong></label></td>
          <td>{!!$orden->empresa!!}</td>
          <td><label class="col-sm-2 form-control-label" for="fecha"><strong>Cantidad Items:</strong></label></td>
          <td>{!!$orden->cantidad!!}</td>
          <td><label class="col-sm-2 form-control-label" for="precio_total"><strong>Precio Total:</strong></label></td>
          <td>{!!$orden->precio_total!!}</td>
        </tr>
      </tbody>
    </table>
  </div>
  <br/>
  <div class="row">
    <h4>Detalles:</h4>
    <table class="table table-striped table-hover table-bordered">

      <thead class="thead-inverse">
        <tr>
          <th>#</th>
          <th>Articulo</th><!--Codigo Sombrero-->
          <th>Foto</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          <th>Precio Total</th>
          <th>Proveedor</th>
          <th>Descripcion</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($detalles as $index=>$detalle)
          <tr>
            <th scope="row">{{$index+1}}</th>
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
        @endforeach
    </table>
  </div>
</div>
