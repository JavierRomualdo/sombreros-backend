<link rel="stylesheet" href="css/bootstrap.min.css">

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>
        <img class="rounded mx-auto d-block  img-fluid" src="images/sombreros/logo_sombreros.png" width="300" alt="First slide">
        <h3>Orden de Venta</h3>
        <p>[<strong>{!!$fechaInicio!!}, {!!$fechaFin!!}</strong>]</p><br/>
      </center>
    </div>
  </div>

  <div class="row">
    <h4>Consolidado:</h4>
    <table class="table-striped table-hover table-bordered" width="1030px"><!--width="730px"-->
      <tbody>
        <tr>
          <td><label class="form-control-label"><strong>N° Ventas:</strong></label></td>
          <td>{!!$numventas->num_ventas!!}</td>
          <td><label class="form-control-label"><strong>Cantidad Items:</strong></label></td>
          <td>{!!$venta->cantidad_venta!!}</td>          
          <td><label class="form-control-label"><strong>Total Ventas:</strong></label></td>
          <td>S/. {!!$venta->total!!}</td>
          <td><label class="form-control-label"><strong>Comision Empleado:</strong></label></td>
          <td>S/. {!!number_format($venta->comision_total, 2, '.', '')!!}</td>
          <td><label class="form-control-label"><strong>Realizado:</strong></label></td>
          <td>{!!$empleado->nombres!!}</td>
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
            <th>Codigo de Venta</th>
            <th>Fecha</th>
            <th>Precio Total</th>
            <th>Cantidad Items</th>
            <th>Comision Empleado</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($detalles as $index=>$detalle)
          <tr>
            <th scope="row">{{$index+1}}</th>
            <td>{{$detalle->numero_venta}}</td>
            <td>{{$detalle->fecha}}</td>
            <td>S/ {{$detalle->precio_total}}</td>
            <td>{{$detalle->cantidad}}</td>
            <td>S/ {{number_format($detalle->comision_empleado, 2, '.', '')}}</td>
          </tr>
        @endforeach
    </table>
  </div>
</div>
