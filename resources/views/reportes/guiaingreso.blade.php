<link rel="stylesheet" href="css/bootstrap.min.css">

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>
        <img class="rounded mx-auto d-block  img-fluid" src="images/sombreros/logo_sombreros.png" width="300" alt="First slide">
        <h3>Guia de Ingreso</h3>
        <p>Codigo: <span>{!!$guia->numero_guia!!}</span></p><br/>
      </center>
    </div>
  </div>

  <div class="row">
    <h4>Datos Generales:</h4>
    <table class="table-striped table-hover" width="730px"><!--table-bordered-->
      <tbody>
        <tr>
          <td><label class="col-sm-2 form-control-label" for="fecha"><strong>Fecha:</strong></label></td>
          <td>{!!$guia->fecha!!}</td>
          <td><label class="col-sm-2 form-control-label" for="precio_total"><strong>Cantidad Total:</strong></label></td>
          <td>{!!$guia->cantidad!!}</td>
          <td><label class="col-sm-2 form-control-label" for="empresa"><strong>Empresa:</strong></label></td>
          <td>{!!$guia->empresa!!}</td>
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
          <th>Codigo Sombrero</th>
          <th>Foto</th>
          <th>Cantidad</th>
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
            <td>{{$detalle->descripcion}}</td>
          </tr>
        @endforeach
    </table>
  </div>
</div>
