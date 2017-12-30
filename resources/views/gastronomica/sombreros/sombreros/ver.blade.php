@extends('layouts.master')
@section('title','Sombreros')
@section('content')

  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/sombreros/sombrero')}}">Sombreros</a></li>
        <li class="breadcrumb-item active">Ver Sombrero</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <br/>
      <div class="row">
        <div class="offset-lg-0 col-lg-6">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Datos del Sombrero:</h2>
            </div>
            <div class="card-block">
              {!!Form::model($sombrero, ['action'=>['Sombreros\SombreroController@update',$sombrero->id],'method'=>'PUT'])!!}
              <p>Codigo: <strong>{!!$sombrero->codigo!!}</strong></p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Modelo:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$modelo->modelo!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Tejido:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$tejido->tejido!!}</label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Material:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$material->material!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Publico:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$publicodirigido->publico!!}</label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Talla:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$talla->talla!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Precio Compra:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$sombrero->precio_compra!!}</label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Precio Venta:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$sombrero->precio_venta!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Utilidad:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$sombrero->utilidad!!}</label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Stock Actual:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$sombrero->stock_actual!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Stock Minimo:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$sombrero->stock_minimo!!}</label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Stock Maximo:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$sombrero->stock_maximo!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Precio Venta:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$sombrero->precio_venta!!}</label>
                </div>
              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Imagen: <span>{!!$sombrero->photo!!}</span></h2>
            </div>
            <div class="card-block">
              <img class="rounded mx-auto d-block  img-fluid" src="/images/sombreros/{{$sombrero->photo}}" width="330px" height="333px" alt="First slide">
              <!--<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="/images/sombreros/{ {$sombrero->photo}}" width="500px" height="333px" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                      <h3>Primer</h3>
                      <p>...</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="https://elvaqueroimports.com/media/catalog/product/cache/3/image/9df78eab33525d08d6e5fb8d27136e95/i/m/img_7503.jpg" width="500px" height="333px" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                      <h3>Seundo</h3>
                      <p>...</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="https://http2.mlstatic.com/sombrero-panama-original-compania-de-sombreros-m-624501-01-D_NQ_NP_725325-MLA25430210073_032017-F.jpg" width="500px" height="333px" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                      <h3>Tercer</h3>
                      <p>...</p>
                    </div>
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>-->
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
