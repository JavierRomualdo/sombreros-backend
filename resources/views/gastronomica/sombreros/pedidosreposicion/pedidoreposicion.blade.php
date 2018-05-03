@extends('layouts.master')
@section('title','Pedido Reposicion')
@section('content')
<style type="text/css"> #divredondo, #estado_orden { height:20px; width:20px; border-radius:10px; } </style>
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Pedidos Reposicion</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h3 fadeIn animated text-center ion-clipboard"> Lista de Pedidos:</h1>
      </header>
      <!--Cabecera de los pedidos de reposicion-->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Consolidado:</h2>
            </div>
            <div class="card-block">
              <!--<p>Codigo: <strong>{ !!$pedido->numero_reposicion!!}</strong></p>-->
              <div class="form-group row">
                <label class="col-sm-2 col-3 form-control-label" for="fecha"><strong>Cantidad Items:</strong></label>
                <div class="col-sm-1 col-3">
                  <label class="form-control-label" for="fecha">{!!$pedido->cantidadtotal!!}</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="fecha"><strong>Costo Reposicion:</strong></label>
                <div class="col-sm-1 col-3">
                  <label class="form-control-label" for="fecha">S/{!!$pedido->costoreposicion!!}</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="fecha"><strong>Costo Servicio Rep:</strong></label>
                <div class="col-sm-1 col-3">
                  <label class="form-control-label" for="fecha">S/ {!!($pedido->costoreposicion) * ($parametros->costoserviciorep / 100.00)!!}</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="precio_total"><strong>Costo Total:</strong></label>
                <div class="col-sm-1 col-3">
                  <label class="form-control-label" for="precio_total">
                    S/ {!!($pedido->costoreposicion) + (($pedido->costoreposicion) * ($parametros->costoserviciorep / 100.00))!!}
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--->
      <div class="row">

        <div class="col-lg-12">

          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h6 display ion-paperclip fadeIn animated title"> Historial:</h2>
            </div>
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Articulo</th><!--Codigo Sombrero-->
                    <th>Foto</th>
                    <th>Cantidad</th>
                    <!--<th>Cantidad Orden</th>-->
                    <th>Costo Articulo</th>
                    <th>Costo Total</th>
                    <th>Proveedor</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pedidosreposicion as $index=>$pedidoreposicion)
                      <tr class="fadeIn animated">
                        <th scope="row">{{$index+1}}</th>
                        <td>{{$pedidoreposicion->codigo}}</td>
                        <td>
                          <img src="/images/sombreros/{{$pedidoreposicion->photo}}"
                          data-toggle="modal" class="link_foto img-fluid pull-xs-left rounded" alt="..." width="28" title="ver foto"><!--data-target="#myModal"-->
                        </td>
                        <td>{{$pedidoreposicion->cantidad}}</td>
                        <!--<td>{{$pedidoreposicion->cantidadorden}}</td>-->
                        <td>S/ {{$pedidoreposicion->precio}}</td>
                        <td>S/ {{$pedidoreposicion->cantidad * $pedidoreposicion->precio}}</td>
                        <td>{{$pedidoreposicion->empresa}}</td>
                        @if($pedidoreposicion->stock_actual >= $pedidoreposicion->stock_minimo)
                            <td>
                                <center><label id="estado_orden" style="background-color: orange" title="pedido moderado"></label></center>
                            </td>
                        @else
                            <td>
                                <center><label id="estado_orden" style="background-color: red" title="pedido urgente"></label></center>
                            </td>
                        @endif
                        
                      </tr>
                    @endforeach
                </tbody>
              </table>
              </div>
            </div>

          </div>

        </div>

      </div>
    </div>
  </section>
  @endsection