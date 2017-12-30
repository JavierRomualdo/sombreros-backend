@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Precios</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2">Lista de Precios:</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/proveedores/precios/precios/create')}}" class="btn btn-primary margenInf">Nuevo</a> &nbsp;

      <div class="row">

        <div class="col-lg-12">

          <div class="card miBorder">

            <div class="card-block">

              <table class="table table-striped table-hover table-bordered"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo Sombrero</th>
                    <th>Proveedor</th>
                    <th>Precio</th>
                    <th>Aciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($proveedoresprecio as $index=>$proveedorprecio)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$proveedorprecio->codigo}}</td>
                      <td>{{$proveedorprecio->empresa}}</td>
                      <td>{{$proveedorprecio->precio}}</td>
                      <td>
                        <a href="{{action('Proveedores\PreciosController@edit', $proveedorprecio->id)}}" class="ion-edit" title="Editar">[Editar]</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <!--<ul id="pagination" class="pagination-sm"></ul>-->
            </div>

          </div>

        </div>

      </div>

    </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
@endsection
