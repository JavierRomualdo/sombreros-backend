@extends('layouts.master')
@section('title','Sombreros')
@section('content')

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/sombreros/sombrero')}}">Sombreros</a></li>
        <li class="breadcrumb-item active">Ver</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <br/>
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Detalles:</h2>
            </div>
            <div class="card-block">
              {!!Form::model($sombrero, ['action'=>['Sombreros\SombreroController@update',$sombrero->id],'method'=>'PUT'])!!}
              
              <div class="form-group row">
                <label class="col-sm-2 col-md-2 col-3 form-control-label" for="nombres"><strong>Codigo:</strong></label>
                <div class="col-sm-2 col-md-2 col-3">
                  <label for="">{!!$sombrero->codigo!!}</label>
                </div>
                <label class="col-sm-2 col-md-2 col-3 form-control-label" for="nombres"><strong>Modelo:</strong></label>
                <div class="col-sm-2 col-md-2 col-3">
                  <label for="">{!!$sombrero->modelo!!}</label>
                </div>
                <label class="col-sm-2 col-md-2 col-3 form-control-label" for="nombres"><strong>Tejido:</strong></label>
                <div class="col-sm-2 col-md-2 col-3">
                  <label for="">{!!$sombrero->tejido!!}</label>
                </div>

                <label class="col-sm-2 col-md-2 col-3 form-control-label" for="nombres"><strong>Material:</strong></label>
                <div class="col-sm-2 col-md-2 col-3">
                  <label for="">{!!$sombrero->material!!}</label>
                </div>
                <label class="col-sm-2 col-md-2 col-3 form-control-label" for="nombres"><strong>Publico:</strong></label>
                <div class="col-sm-2 col-md-2 col-3">
                  <label for="">{!!$sombrero->publico!!}</label>
                </div>
                <label class="col-sm-2 col-md-2 col-3 form-control-label" for="nombres"><strong>Talla:</strong></label>
                <div class="col-sm-2 col-md-2 col-3">
                  <label for="">{!!$sombrero->talla!!}</label>
                </div>

                <label class="col-sm-2 col-md-2 col-3 form-control-label" for="nombres"><strong>Precio Venta:</strong></label>
                <div class="col-sm-2 col-md-2 col-3">
                  <label for="">S/ {!!$sombrero->precio_venta!!}</label>
                </div>
                <label class="col-sm-2 col-md-2 col-3 form-control-label" for="nombres"><strong>Utilidad:</strong></label>
                <div class="col-sm-2 col-md-2 col-3">
                  <label for="">S/ {!!$sombrero->utilidad!!}</label>
                </div>
                <label class="col-sm-2 col-md-2 col-3 form-control-label" for="nombres"><strong>Pedido Reposicion:</strong></label>
                <div class="col-sm-2 col-md-2 col-3">
                  <label for="">{!!$sombrero->pedido_reposicion!!}</label>
                </div>

                <label class="col-sm-2 col-md-2 col-3 form-control-label" for="nombres"><strong>Stock Actual:</strong></label>
                <div class="col-sm-2 col-md-2 col-3">
                  <label for="">{!!$sombrero->stock_actual!!}</label>
                </div>
                <label class="col-sm-2 col-md-2 col-3 form-control-label" for="nombres"><strong>Stock Minimo:</strong></label>
                <div class="col-sm-2 col-md-2 col-3">
                  <label for="">{!!$sombrero->stock_minimo!!}</label>
                </div>
                <label class="col-sm-2 col-md-2 col-3 form-control-label" for="nombres"><strong>Stock Maximo:</strong></label>
                <div class="col-sm-2 col-md-2 col-3">
                  <label for="">{!!$sombrero->stock_maximo!!}</label>
                </div>

              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
        
      </div>
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Imagen: <!--<span>{ !!$sombrero->photo!!}</span>--></h2>
            </div>
            <div class="card-block">
              <img class="rounded mx-auto d-block img-fluid fadeIn animated" src="/images/sombreros/{{$sombrero->photo}}" width="330px" height="333px" alt="First slide">
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript">
  $("#li-home").removeClass('active');
  $("#li-somb").attr('class','active');
  </script>
@endsection
