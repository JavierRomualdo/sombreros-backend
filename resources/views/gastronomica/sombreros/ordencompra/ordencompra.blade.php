@extends('layouts.master')
@section('title','Compras')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Orden de Compra</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2 fadeIn animated text-center ion-clipboard"> Órdenes de Compra</h1>
      </header>
      @include('partials.messages')
      
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder fadeIn animated">
              <div class="card-header d-flex align-items-center">
                <h2 class="h1 display ion-paperclip fadeIn animated title"> Historial:</h2>
              </div>
            <div class="card-block miTabla">
              <a href="{{url('/gastronomica/sombreros/ordencompra/ordencompra/create')}}" class="btn btn-outline-primary margenInf fadeIn animated btn-sm" title="nueva orden compra"><i class="ion-plus-round"></i> Nuevo</a> &nbsp;
              <div class="table-responsive ">
                  <table class="table table-striped table-hover table-bordered specialCollapse"><!--table-responsive-->
                    <thead class="thead-inverse">
                      <tr>
                        <th>#</th>
                        <th>Codigo de Orden</th>
                        <th>Fecha</th>
                        <th>Cantidad Items</th>
                        <th>Precio Total</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($ordenes as $index=>$orden)
                      <tr class="fadeIn animated">
                        <th scope="row">{{$orden->id}}</th>
                        <th>{{$orden->numero_orden}}</th>
                        <td>{{$orden->fecha}}</td>
                        <td>{{$orden->cantidad}}</td>
                        <td>S/. {{$orden->precio_total}}</td>
                        <td>
                          <a href="{{action('Compras\OrdenCompraController@ver',$orden->id)}}" class="btn btn-outline-primary btn-sm ion-eye" title="ver"></a>
                          <a href="{{action('Compras\OrdenCompraController@reporte',$orden->id)}}"
                            target="_blank" class="btn btn-outline-primary btn-sm ion-document-text" title="reporte"></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
          </div>
        </div>
      </div>
      <div class="container">
          <div class="paginacion">
            {!!$ordenes->links()!!}
          </div>
      </div>
    </div>
  </div>
  </section>
@endsection
