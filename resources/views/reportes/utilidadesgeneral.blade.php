<link rel="stylesheet" href="css/bootstrap.min.css">

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>
        <img class="rounded mx-auto d-block  img-fluid" src="images/sombreros/logo_sombreros.png" width="300" alt="First slide">
        <h3>Utilidades de Ventas</h3>
      </center>
    </div>
  </div>

  <br/>
  <div class="row">
    <h4>Detalles:</h4>
    <table class="table table-striped table-hover table-bordered">

      <thead class="thead-inverse">
        <tr>
          <th>#</th>
          <th>Codigo</th>
          <th>Foto</th>
          <th>Fecha</th>
          <th>Modelo</th>
          <th>Tejido</th>
          <th>Material</th>
          <th>Publico</th>
          <th>Talla</th>
          <th>Precio Compra</th>
          <th>Precio Venta</th>
          <th>Utilidad</th>
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
            <td>{{$detalle->fecha}}</td>
            <td>{{$detalle->modelo}}</td>
            <td>{{$detalle->tejido}}</td>
            <td>{{$detalle->material}}</td>
            <td>{{$detalle->publico}}</td>
            <td>{{$detalle->talla}}</td>
            <td>{{$detalle->precio}}</td>
            <td>{{$detalle->precio_venta}}</td>
            <td>{{$detalle->utilidad}}</td>
          </tr>
        @endforeach
    </table>
  </div>
</div>
