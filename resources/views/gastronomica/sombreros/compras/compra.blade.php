@extends('layouts.master')
@section('title','Compras')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Orden de Compra</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <!--<h1 class="h3">Lista de Sombreros:</h1>-->
        <center><img src="/images/sombreros/logo_sombreros.png" width="300" alt=""></center>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/sombreros/sombrero/create')}}" class="btn btn-primary margenInf">Nuevo</a> &nbsp;
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder">

            <div class="card-block miTabla">
              <table class="table table-striped table-hover table-bordered"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo de Orden</th>
                    <th>Fecha</th>
                    <th>Codigo Sombreros</th>
                    <th>Proveedor</th>
                    <th>Precio Unitaio</th>
                    <th>Precio Total</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>

          </div>
        </div>
        <div class="container">
          <div class="paginacion">
            {!!$sombreros->links()!!}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
