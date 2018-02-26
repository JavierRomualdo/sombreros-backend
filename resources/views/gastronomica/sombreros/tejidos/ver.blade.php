@extends('layouts.master')
@section('title','Sombreros')
@section('content')

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/tejidos/tejido')}}">Calidad tejido</a></li>
        <li class="breadcrumb-item active">Ver </li>
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
              <h2 class="h5 display fadeIn animated ion-paperclip"> Detalles:</h2>
            </div>
            <div class="card-block">
              <div class="form-group row">
                <label class="col-sm-2 col-3 form-control-label" for="nombres"><strong>Calidad Tejido:</strong></label>
                <div class="col-sm-4 col-3">
                  <label for="">{!!$tejido->tejido!!}</label>
                </div>
                <label class="col-sm-2 col-4 form-control-label" for="nombres"><strong>Descripción:</strong></label>
                <div class="col-sm-4 col-2">
                  <label for="">{!!$tejido->descripcion!!}</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Imagen: <span>{!!$tejido->photo!!}</span></h2>
            </div>
            <div class="card-block">
              <img class="rounded mx-auto d-block img-fluid fadeIn animated" src="/images/tejidos/{!!$tejido->photo!!}" width="330px" height="333px" alt="First slide">
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
@endsection
