<link rel="stylesheet" href="css/bootstrap.min.css">

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>
        <img class="rounded mx-auto d-block  img-fluid" src="images/sombreros/logo_sombreros.png" width="300" alt="First slide">
        <h3>Reporte de Movimiento</h3>
        @if($fecha_inicio!='')
            <h4><strong><span>{ {{$fecha_inicio}} - {{$fecha_fin}} }</span></strong></h4>
        @endif
        
      </center>
    </div>
  </div><br/>
    <div class="row">
      <h4>Consolidado:</h4>
      <table class="table table-striped table-hover table-bordered" width="1030px"><!---->
        <thead class="thead-inverse">
          <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Articulo</th>
            <th>Cantidad Ingreso</th>
            <th>Costo Unitario</th>
            <th>Costo Total</th>
            <th>Cantidad Salida</th>
            <th>Precio Unitario</th>
            <th>Precio Total</th>
            <th>Stock Actual</th>
            <th>Valor</th>
          </tr>
        </thead>
        <tbody>
            @foreach($movimientos as $index=>$movimiento)
                <tr>
                    <th>{{$index+1}}</th>
                    <td>{{$movimiento->fecha}}</td>
                    <td>{{$movimiento->codigo}}</td>
                    @if($movimiento->cantidadsalida == '')
                        <td>{{$movimiento->cantidadingreso}}</td>
                        <td>S/ {{$movimiento->costounitario}}</td>
                        <td>S/ {{$movimiento->costototal}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @else
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$movimiento->cantidadsalida}}</td>
                        <td>S/ {{$movimiento->preciounitario}}</td>
                        <td>S/ {{$movimiento->preciototal}}</td>
                    @endif
                    <td>{{$movimiento->stock_actual}}</td>
                    <td>S/ {{$movimiento->valor}}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
</div>
