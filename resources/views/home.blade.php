@extends('layouts.master')
@section('content')
  <!--<div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Home</li>
      </ul>
    </div>
  </div>-->
  <!-- Counts Section -->
  <section class="dashboard-counts section-padding">
    <div class="container-fluid">
        <div class="row">
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-user"></i></div>
                <div class="name"><strong class="text-uppercase">Nuevos Clientes</strong><span>Los últimos 7 días</span>
                  <div class="count-number">25</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-padnote"></i></div>
                <div class="name"><strong class="text-uppercase">
                    <a href="{{url('gastronomica/sombreros/pedidosreposicion/pedidoreposicion')}}">Pedido Reposicion</a>
                </strong><span>Hoy dia</span>
                  <div class="count-number">{{$pedidosreposicion->cantidad}}</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-check"></i></div>
                <div class="name"><strong class="text-uppercase">Guias Ingreso</strong><span>Last 2 months</span>
                  <div class="count-number">342</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-bill"></i></div>
                <div class="name"><strong class="text-uppercase">Nuevas Ventas</strong><span>Last 2 days</span>
                  <div class="count-number">123</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-list"></i></div>
                <div class="name"><strong class="text-uppercase">Open Cases</strong><span>Last 3 months</span>
                  <div class="count-number">92</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-list-1"></i></div>
                <div class="name"><strong class="text-uppercase">New Cases</strong><span>Last 7 days</span>
                  <div class="count-number">70</div>
                </div>
              </div>
            </div>
          </div>
          <hr/>
    </div>
    <div class="container-fluid">
      
      <div class="row">
        <div class="col-md-12 text-center">
          <img src="images/sombreros/logo_sombreros.PNG" width="250px">
        </div>
      </div><hr/>
      <!--<div class="row">
        <div class="col-md-5">
            <div class="wrap">
                <div class="widget bg-primary fadeIn animated">
                  
                  <div class="fecha">
                    <i class="ion-ios-time"></i> 
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
          <img src="/images/temporadas/1521178513.PNG" alt="local" width="300" class="rounded fadeIn animated">
        </div>
      </div>-->
      <hr/>
      <h3 class="ion-pricetags"> Principal:</h3>
      <hr/>
        <div class="card-columns">
            <div class="card miBorder fadeIn animated">
              <div class="card-img-top text-center">
                <!--<img class=" fadeIn animated" src="/images/temporadas/1521178513.PNG" alt="Card image cap" width="215px">
                -->
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
                <!--<img class=" fadeIn animated" src="/images/temporadas/1521178513.PNG" alt="Card image cap" width="215px">
                -->
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
                <!--<img class=" fadeIn animated" src="/images/temporadas/1521178513.PNG" alt="Card image cap" width="215px">
                -->
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
                <!--<img class=" fadeIn animated" src="/images/temporadas/1521178513.PNG" alt="Card image cap" width="215px">
                -->
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
                    <!--<img class=" fadeIn animated" src="/images/temporadas/1521178513.PNG" alt="Card image cap" width="215px">
                    -->
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
                    <!--<img class=" fadeIn animated" src="/images/temporadas/1521178513.PNG" alt="Card image cap" width="215px">
                    -->
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

  <!--Notificacion-->
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

  <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>

  <script type="text/javascript">
  //$("#li-home").attr('class','active');
    $(document).ready(function(e){
      /*$.get('/ajax-actualizarStock/1', function(data){
        //success
        $.each(data, function(index, stock){
          alert("se ha actualizado");
        });
      });*/
      var usuario = $("#usuario").html();
      if(parseInt($("#horas").html()) < 12 && $("#ampm").html()=="AM"){
        Messenger().post({message:"¡ Buenas dias ! es hora de trabajar :/ "+usuario,type:"info",showCloseButton:!0});
      } else if(parseInt($("#horas").html()) >= 1 && parseInt($("#horas").html()) < 7 && $("#ampm").html()=="PM"){
        Messenger().post({message:"¡ Buenas tardes ! "+usuario+" hace mucho calor :(",type:"info",showCloseButton:!0});
      } else if(parseInt($("#horas").html()) >= 7 && $("#ampm").html()=="PM") {
        Messenger().post({message:"¡ Buenas Noches ! cuidado con los zancudos :'v "+usuario,type:"info",showCloseButton:!0});
      }
  });
  </script>
@endsection
