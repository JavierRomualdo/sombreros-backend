@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Precios /</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h3 fadeIn animated text-center ion-clipboard"> Lista de Precios:</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/proveedores/precios/precios/create')}}" class="btn btn-outline-primary margenInf fadeIn animated ion-plus-round btn-sm"> Nuevo</a> &nbsp;

      <div class="row">

        <div class="col-lg-12">

          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h6 display ion-paperclip fadeIn animated title"> Historial:</h2>
            </div>
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered"><!--table-responsive-->
                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo Sombrero</th>
                    <th>Foto</th>
                    <th>Proveedor</th>
                    <th>Costo</th>
                    <th>Aciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($proveedoresprecio as $index=>$proveedorprecio)
                    <tr class="fadeIn animated">
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$proveedorprecio->codigo}}</td>
                      <td>
                        <img src="/images/sombreros/{{$proveedorprecio->photo}}" data-toggle="modal" class="link_foto img-fluid pull-xs-left rounded" alt="..." width="28" title="ver foto">
                      </td>
                      <td>{{$proveedorprecio->empresa}}</td>
                      <td>S/ {{$proveedorprecio->precio}}</td>
                      <td>
                        <a href="{{action('Proveedores\PreciosController@edit', $proveedorprecio->id)}}" class="btn btn-outline-primary btn-sm ion-edit" title="Editar"></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
              <!--<ul id="pagination" class="pagination-sm"></ul>-->
            </div>

          </div>

        </div>

      </div>

    </div>
  </section>
  <!---->
  <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Sombrero</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <img src="/images/sombreros/" class="rounded mx-auto d-block  img-fluid" id="mostrar_foto" alt="..." width="450px" height="453px">
          <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="aceptar">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!---->
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script type="text/javascript">
    $(".link_foto").css('cursor', 'pointer');
    $(".link_foto").click(function(e){
      $("#mostrar_foto").attr("src",$(this).attr("src"));
      $("#myModal").modal("show");
    });
  </script>
@endsection
