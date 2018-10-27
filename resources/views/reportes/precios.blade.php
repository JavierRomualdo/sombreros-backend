<link rel="stylesheet" href="css/bootstrap.min.css">

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>
        <img class="rounded mx-auto d-block  img-fluid" src="images/sombreros/logo_sombreros.png" width="300" alt="First slide">
        <h4><strong>Precios Articulos</strong></h4>
      </center>
    </div>
  </div>
  <br/>
  <div class="row">
    <table class="table table-striped table-hover table-bordered">

      <thead class="thead-inverse">
        <tr>
          <th class='text-center'>#</th>
          <th class='text-center'>Articulo</th>
          <th class='text-center'>Foto</th>
          <th class='text-center'>Precio Sistema</th>
          <th class='text-center'>Precio Lista</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sombreros as $index=>$sombrero)
          <tr class='text-center'>
            <th class='text-center'>{{$index+1}}</th>
            <td>{{$sombrero->codigo}}</td>
            <td>
              <img src="images/sombreros/{{$sombrero->photo}}" class="img-fluid pull-xs-left rounded" alt="..." width="28">
            </td>
            <td>S/ {{$sombrero->precio_venta}}</td>
            <td>S/ {{$sombrero->precio_lista}}</td>
          </tr>
        @endforeach
    </table>
  </div>
</div>
