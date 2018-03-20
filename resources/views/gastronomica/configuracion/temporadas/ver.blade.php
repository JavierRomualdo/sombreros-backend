@extends('layouts.master')
@section('title','Sombreros')
@section('content')

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/configuracion/temporadas/temporada')}}">Temporadas</a></li>
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
              <h2 class="h5 display fadeIn animated ion-paperclip"> Detalles:</h2>
            </div>
            <div class="card-block">
              <div class="form-group row">
                <label class="col-sm-2 col-3 form-control-label" for="nombres"><strong>Temporada:</strong></label>
                <div class="col-sm-4 col-2">
                  <label for="">{!!$temporada->temporada!!}</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="nombres"><strong>Descripción:</strong></label>
                <div class="col-sm-4 col-2">
                  <label for="">{!!$temporada->descripcion!!}</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="nombres"><strong>Fecha Inicio:</strong></label>
                <div class="col-sm-4 col-2">
                  <label for="">{!!$temporada->fecha_inicio!!}</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="nombres"><strong>Fecha Fin:</strong></label>
                <div class="col-sm-4 col-2">
                  <label for="">{!!$temporada->fecha_fin!!}</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h5 display fadeIn animated ion-paperclip"> Imagen: <span>{!!$temporada->photo!!}</span></h2>
            </div>
            <div class="card-block fadeIn animated">
              <img class="rounded mx-auto d-block fadeIn animated img-fluid" src="/images/temporadas/{!!$temporada->photo!!}" width="450px" alt="First slide">
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
@endsection
