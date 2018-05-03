<link rel="stylesheet" href="css/bootstrap.min.css">

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>
        <img class="rounded mx-auto d-block  img-fluid" src="images/sombreros/logo_sombreros.png" width="300" alt="First slide">
        <h4 class="title h3"><strong><span>Reporte: Ordenes de Compras</span></strong></h4>
        <h4>
          @if($fecha_inicio=='' && $fecha_fin=='' && $codigo!='')
            <strong><span> {{$codigo}} </span></strong>
          @elseif($fecha_inicio!='' && $fecha_fin!='' && $codigo=='')
            <strong><span>{ {{$fecha_inicio}} - {{$fecha_fin}} }</span></strong>
          @endif
        </h4>
      </center>
    </div>
  </div><br/>
  @foreach ($ordenes as $index => $orden)
    <div class="row">
      <h5>N°: {{$index+1}}</h5>
      <table class="table-striped table-hover table-bordered" width="1030px"><!--width="730px"-->
        <tbody>
          <tr>
            <td><label class="form-control-label" for="fecha"><strong>Codigo:</strong></label></td>
            <td>{!!$orden->numero_orden!!}</td>
            <td><label class="form-control-label" for="fecha"><strong>Fecha:</strong></label></td>
            <td>{!!$orden->fecha!!}</td>
            <td><label class="form-control-label" for="fecha"><strong>Cantidad Items:</strong></label></td>
            <td>{!!$orden->cantidad!!}</td>
            <td><label class="form-control-label" for="precio_total"><strong>Costo Total:</strong></label></td>
            <td>S/ {!!$orden->precio_total!!}</td>
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
            <th>Cantidad Items</th>
            <th>Costo Articulo</th>
            <th>Costo Total</th>
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
                @if ($codSombrero == $detalle->codigo)
                  <td><label style="background:yellow;">{{$detalle->codigo}}</label></td>
                @else
                  <td><label>{{$detalle->codigo}}</label></td>
                @endif
                
                <td>
                  <img src="images/sombreros/{{$detalle->photo}}" class="img-fluid pull-xs-left rounded" alt="..." width="28">
                </td>
                <td>{{$detalle->cantidad}}</td>
                <td>S/ {{$detalle->costounitario}}</td>
                <td>S/ {{$detalle->cantidad * $detalle->costounitario}}</td>
                <td>{{$detalle->empresa}}</td>
                <td>{{$detalle->descripcion}}</td>
              </tr>
            @endif
        @endforeach
      </table>
    </div>
    <br/>
    <!--<hr/>-->
  @endforeach
</div>
