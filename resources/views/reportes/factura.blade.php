<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap.min.css">


<div class="container">

  <div class="rows">
    <table class="table-striped table-hover" width="730px">
      <thead>
        <tr width="100px">
          <td class="text-center">
            <img class="rounded mx-auto d-block  img-fluid" src="images/sombreros/logo_sombreros.png" width="300" alt="First slide">
          </td>
          <td>
            <table class="table table-striped table-hover table-bordered" style="border-radius:10px;" border="2" width="730px">
              <tbody class="thead-inverse">
                <tr>
                  <td class="text-center">
                    <strong>R.U.C. 10703352541</strong>
                  </td>
                </tr>
                <tr>
                  <td class="text-center">
                    <strong>FACTURA</strong>
                  </td>
                </tr>
                <tr>
                  <td class="text-center">
                    <strong><span>{!!$factura->numero_factura!!}</span></strong>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </thead>
    </table>
  </div>
</br>

<div class="row">
  <table class="table table-striped table-hover table-bordered" width="770px">
    <thead class="thead-inverse">
      <tr>
        <td><strong>Señor(es):</strong></td>
        <td width="180px">{!!$factura->comprador!!}</td>
        <td><strong>Fecha:</strong></td>
        <td colspan="3">{!!$factura->fecha!!}</td>
      </tr>
      <tr>
        <td><strong>Direccion:</strong></td>
        <td width="180px">Mz. A. Lote 7. San Valentin</td>
        <td><strong>Ruc:</strong></td>
        <td>10283728281</td>
        <td width="30px"><strong>Guia:</strong></td>
        <td>GI-0001-17</td>
      </tr>
    </thead>
</div>

  <div class="row">
    <table class="table table-striped table-hover table-bordered">

      <thead class="thead-inverse">
        <tr>
          <th>Cantidad</th>
          <th>Descripcion</th>
          <th>Precio Unitario</th>
          <th>Importe</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($detalles as $detalle)
          <tr>
            <td>{{$detalle->cantidad}}</td>
            <td>{{$detalle->descripcion}}</td>
            <td>{{$detalle->precio_unitario}}</td>
            <td>{{$detalle->sub_total}}</td>
          </tr>
        @endforeach
    </table>
    <div class="">
      <table border="0" class="" style="margin-left:430px;" width="580px" height="300px">
        <thead>
          <tr>
            <td><strong>SUB TOTAL</strong></td>
            <td>{{$detalle->sub_total}}</td>
          </tr>
          <tr>
            <td><strong>I.G.V....%</strong></td>
            <td>10</td>
          </tr>
          <tr>
            <td><strong>TOTAL (S/.)</strong></td>
            <td>292</td>
          </tr>
        </thead>
      </table>
    </div>
  </div>


  <br/>
</div>
