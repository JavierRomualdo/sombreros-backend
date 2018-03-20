<link rel="stylesheet" href="css/bootstrap.min.css">

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>
        <img class="rounded mx-auto d-block  img-fluid" src="images/sombreros/logo_sombreros.png" width="300" alt="First slide">
        <h3>Reporte de Ventas</h3>
        <h4><strong><span>{{$codigo}} { {{$fecha_inicio}} - {{$fecha_fin}} }</span></strong></h4>
      </center>
    </div>
  </div><br/>
  @foreach ($ventas as $index => $venta)
    <div class="row">
      <h5>N°: {{$index+1}}</h5>
      <table class="table-striped table-hover table-bordered" width="1030px"><!---->
        <tbody>
          <tr>
            <td><label class="form-control-label" for="fecha"><strong>Codigo:</strong></label></td>
            <td>{!!$venta->numero_venta!!}</td>
            <td><label class="form-control-label" for="fecha"><strong>Fecha:</strong></label></td>
            <td>{!!$venta->fecha!!}</td>
            <td><label class="form-control-label" for="fecha"><strong>Cantidad de Items:</strong></label></td>
            <td>{!!$venta->cantidad!!}</td>
            <td><label class="form-control-label" for="precio_total"><strong>Precio Total:</strong></label></td>
            <td>{!!$venta->precio_total!!}</td>
            <td><label class="form-control-label" for="user"><strong>Realizado:</strong></label></td>
            <td>{!!$venta->nombres!!}</td>
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
          <?php $n=1;?>
          @foreach ($detalles as $key => $detalle)
            @if ($detalle->idVenta == $venta->id)
              <tr>
                <th scope="row">{{$n++}}</th>
                @if ($codSombrero == $detalle->codigo)
                  <td><label style="background:yellow;">{{$detalle->codigo}}</label></td>
                @else
                  <td><label>{{$detalle->codigo}}</label></td>
                @endif
                <td>
                  <img src="images/sombreros/{{$detalle->photo}}" class="img-fluid pull-xs-left rounded" alt="..." width="28">
                </td>
                <td>{{$detalle->cantidad}}</td>
                <td>{{$detalle->precio_venta}}</td>
                <td>{{$detalle->porcentaje_descuento}}</td>
                <td>{{$detalle->descuento}}</td>
                <td>{{$detalle->sub_total}}</td>
                <td>{{$detalle->descripcion}}</td>
              </tr>
            @endif
        @endforeach
      </table>
    </div><br/>
    <!--<hr/>-->
  @endforeach
</div>
