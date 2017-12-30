@extends('layouts.master')
@section('title','Sombreros')
@section('content')

  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/materiales/material')}}">Materiales</a></li>
        <li class="breadcrumb-item active">Ver Material</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <br/>
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Datos del Material:</h2>
            </div>
            <div class="card-block">
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Material:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$material->material!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Descripción:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$material->descripcion!!}</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Imagen: <span>{!!$material->photo!!}</span></h2>
            </div>
            <div class="card-block">
              <img class="rounded mx-auto d-block  img-fluid" src="/images/materiales/{!!$material->photo!!}" width="330px" height="333px" alt="First slide">
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
