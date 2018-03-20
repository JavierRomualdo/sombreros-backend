@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Perfil /</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <br/>
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <!--<div class="card-close">
              <a id="closeCard2" class="btn-link cursor-pointer"><i class="fa fa-plus-circle"></i> Nuevo</a>
            </div>-->
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Detalles:</h2>
            </div>
            <div class="card-block">
              <div class="form-group row">
                <label class="col-sm-1 col-md-2 col-3 form-control-label" for="nombres"><strong>Nombre:</strong></label>
                <div class="col-sm-2 col-md-2 col-3">
                  <label for="">{!!$usuario->name!!}</label>
                </div>
                <label class="col-sm-2 col-md-1 col-3 form-control-label" for="nombres"><strong>Email:</strong></label>
                <div class="col-sm-2 col-md-3 col-3">
                  <label for="">{!!$usuario->email!!}</label>
                </div>
                <label class="col-sm-2 col-md-1 col-3 form-control-label" for="nombres"><strong>Tipo:</strong></label>
                <div class="col-sm-2 col-md-2 col-3">
                  <label for="">{!!$cargo->cargo!!}</label>
                </div>
                <div class="col-sm-2 col-md-1 col-3">
                  <a href="{{action('Usuarios\PerfilController@editPerfil', $usuario->id)}}" class="btn btn-outline-primary btn-sm ion-edit" title="Editar"></a>
                </div>
              </div>

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
            <div class="card-block text-center">
              <a href="{{action('Usuarios\PerfilController@foto',$usuario->id)}}">
                <img class="rounded mx-auto d-block img-fluid fadeIn animated" src="/images/usuarios/{{$usuario->photo}}" width="330px" height="333px" alt="First slide">
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
@endsection