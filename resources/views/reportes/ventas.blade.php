<link rel="stylesheet" href="css/bootstrap.min.css">

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>
        <img class="rounded mx-auto d-block  img-fluid" src="images/sombreros/logo_sombreros.png" width="300" alt="First slide">
        <h3>Orden de Venta</h3>
        <p>Codigo: <span>{!!$venta->numero_venta!!}</span></p><br/>
      </center>
    </div>
  </div>

  <div class="row">
    <h4>Consolidado:</h4>
    <table class="table-striped table-hover table-bordered" width="1030px"><!--width="730px"-->
      <tbody>
        <tr>
          <td><label class="form-control-label" for="fecha"><strong># Doc:</strong></label></td>
          <td>{!!$venta->numero_documento!!}</td>
          <td><label class="form-control-label" for="fecha"><strong>Fecha:</strong></label></td>
          <td>{!!$venta->fecha!!}</td>
          <td><label class="form-control-label" for="precio_total"><strong>Cantidad Items:</strong></label></td>
          <td>{!!$venta->cantidad!!}</td>          
          <td><label class="form-control-label" for="precio_total"><strong>Precio Total:</strong></label></td>
          <td>S/ {!!$venta->precio_total!!}</td>
          <td><label class="form-control-label" for="user"><strong>Cliente:</strong></label></td>
          <td>{!!$venta->cliente!!}</td>
          <td><label class="form-control-label" for="user"><strong>Vendedor:</strong></label></td>
          <td>{!!$venta->nombres!!}</td>
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
          <th>Articulo</th>
          <th>Foto</th>
          <th>Cantidad</th>
          <th>Precio Venta</th>
          <th>Descuento (%)</th>
          <th>Descuento</th>
          <th>Precio Total</th>
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
            <td>S/ {{$detalle->precio_venta}}</td>
            <td>S/ {{$detalle->porcentaje_descuento}}</td>
            <td>S/ {{$detalle->descuento}}</td>
            <td>S/ {{$detalle->sub_total}}</td>
            <td>{{$detalle->descripcion}}</td>
          </tr>
        @endforeach
    </table>
  </div>
</div>
