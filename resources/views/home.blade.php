@extends('layouts.master')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Home</li>
      </ul>
    </div>
  </div>
  <!-- Counts Section -->
  <br/>
  <section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 text-center">
          <img src="images/sombreros/logo_sombreros.PNG" width="450px">
        </div>
      </div><hr/>
      <div class="row">
        <div class="col-md-5">
            <div class="wrap">
                <div class="widget bg-primary fadeIn animated">
                  <div class="fecha">
                    <p id="diaSemana" class="diaSemana">Martes</p>
                    <p id="dia" class="dia">27</p>
                    <p>de </p>
                    <p id="mes" class="mes">Octubre</p>
                    <p>del </p>
                    <p id="year" class="year">2015</p>
                  </div>
              
                  <div class="reloj">
                    <p id="horas" class="horas">11</p>
                    <p>:</p>
                    <p id="minutos" class="minutos">48</p>
                    <p>:</p>
                    <div class="caja-segundos">
                      <p id="segundos" class="segundos">12</p>
                      <p id="ampm" class="ampm">AM</p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        <div class="col-md-7">
          <img src="images/eventos/verano.PNG" alt="local" class="rounded fadeIn animated">
        </div>
      </div>
      <hr/>
      <h3 class="ion-pricetags"> Principal:</h3>
      <hr/>
        <div class="card-columns">
            <div class="card miBorder fadeIn animated">
              <div class="card-img-top text-center">
                <img class=" fadeIn animated" src="images/eventos/verano.PNG" alt="Card image cap" width="215px">
              </div>
              <div class="card-body container">
                <h5 class="card-title ion-android-open"> Sombreros</h5>
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                <a href="{{url('gastronomica/sombreros/sombreros/sombrero')}}" class="btn btn-outline-primary btn-block">Ir sombreros...</a>
              </div>
              <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
              </div>
            </div>
            <div class="card miBorder fadeIn animated">
              <div class="card-img-top text-center">
                <img class=" fadeIn animated" src="images/eventos/verano.PNG" alt="Card image cap" width="215px">
              </div>
              <div class="card-body container">
                <h5 class="card-title ion-android-open"> Ventas</h5>
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                <a href="{{url('gastronomica/sombreros/ventas/ventas')}}" class="btn btn-outline-primary btn-block">Ir ventas...</a>
              </div>
              <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
              </div>
            </div>
            <div class="card miBorder fadeIn animated">
              <div class="card-img-top text-center">
                <img class=" fadeIn animated" src="images/eventos/verano.PNG" alt="Card image cap" width="215px">
              </div>
              <div class="card-body container">
                <h5 class="card-title ion-android-open"> Orden Compra</h5>
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                <a href="{{url('gastronomica/sombreros/ordencompra/ordencompra')}}" class="btn btn-outline-primary btn-block">Ir orden compra...</a>
              </div>
              <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
              </div>
            </div>
            <div class="card miBorder fadeIn animated">
              <div class="card-img-top text-center">
                <img class=" fadeIn animated" src="images/eventos/verano.PNG" alt="Card image cap" width="215px">
              </div>
                <div class="card-body container">
                  <h5 class="card-title ion-android-open"> Proveedores</h5>
                  <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                  <a href="{{url('gastronomica/proveedores/proveedores/proveedor')}}" class="btn btn-outline-primary btn-block">Ir proveedores...</a>
                </div>
                <div class="card-footer">
                  <small class="text-muted">Last updated 3 mins ago</small>
                </div>
              </div>
              <div class="card miBorder fadeIn animated">
                  <div class="card-img-top text-center">
                    <img class=" fadeIn animated" src="images/eventos/verano.PNG" alt="Card image cap" width="215px">
                  </div>
                  <div class="card-body container">
                    <h5 class="card-title ion-android-open"> Guia Ingreso</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    <a href="{{url('gastronomica/sombreros/guiaingreso/guiaingreso')}}" class="btn btn-outline-primary btn-block">Ir guia ingreso...</a>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                  </div>
                </div>
              <div class="card miBorder fadeIn animated">
                  <div class="card-img-top text-center">
                    <img class=" fadeIn animated" src="images/eventos/verano.PNG" alt="Card image cap" width="215px">
                  </div>
                  <div class="card-body container">
                    <h5 class="card-title ion-android-open"> Movimientos</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    <a href="{{url('gastronomica/sombreros/movimientos/movimiento')}}" class="btn btn-outline-primary btn-block">Ir movimientos...</a>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                  </div>
                </div>
          </div>
          
    </div>
  </section>

  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script type="text/javascript">
  //$("#li-home").attr('class','active');
    $(document).ready(function(e){
      /*$.get('/ajax-actualizarStock/1', function(data){
        //success
        $.each(data, function(index, stock){
          alert("se ha actualizado");
        });
      });*/
  });
  </script>
@endsection
