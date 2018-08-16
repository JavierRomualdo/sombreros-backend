@extends('layouts.master')
@section('title','Pedido Reposicion')
@section('content')
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">
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
                <label class="col-sm-1 col-3 form-control-label" for="fecha"><strong>N°Items:</strong></label>
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
                <div>
                  @if ($parametros->costorepmaximo > ($pedido->costoreposicion) + (($pedido->costoreposicion) * ($parametros->costoserviciorep / 100.00)))
                    <td>
                      <center><label id="estado_orden" style="background: green" title="menor del limite [S/ {{$parametros->costorepmaximo}}]"></label></center>
                    </td>
                  @else
                    @if ($parametros->costorepmaximo < ($pedido->costoreposicion) + (($pedido->costoreposicion) * ($parametros->costoserviciorep / 100.00)))
                      <td>
                        <center><label id="estado_orden" style="background: red" title="mayor del limite [S/ {{$parametros->costorepmaximo}}]"></label></center>
                      </td>
                    @else
                      <td>
                        <center><label id="estado_orden" style="background: orange" title="Al limite [S/ {{$parametros->costorepmaximo}}]"></label></center>
                      </td>
                    @endif
                  @endif
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
                <table class="table table-striped table-hover table-bordered" id="myTable">
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
                        <td><label style="cursor: pointer" onclick="detalleSombrero({{$pedidoreposicion->id}})">{{$pedidoreposicion->codigo}}</label></td>
                        <td>
                          <img src="/images/sombreros/{{$pedidoreposicion->photo}}"
                          data-toggle="modal" class="link_foto img-fluid pull-xs-left rounded" alt="..." width="28" title="ver foto"><!--data-target="#myModal"-->
                        </td>
                        <td>{{$pedidoreposicion->stock_maximo}}</td><!--cantidad-->
                        <!--<td>{{$pedidoreposicion->cantidadorden}}</td>-->
                        <td>S/ {{$pedidoreposicion->precio}}</td>
                        <td>S/ {{$pedidoreposicion->stock_maximo * $pedidoreposicion->precio}}</td>
                        <td>{{$pedidoreposicion->empresa}}</td>
                        <!--Rango color 3: por ejemplo: color: rojo-->
                        @if(round($pedidoreposicion->stock_minimo+($pedidoreposicion->stock_minimo*($parametros->rangopr2/100.00))) < $pedidoreposicion->stock_actual && 
                            $pedidoreposicion->stock_actual <= round($pedidoreposicion->stock_minimo+($pedidoreposicion->stock_minimo*($parametros->rangopr2/100.00)+($pedidoreposicion->stock_minimo*($parametros->rangopr1/100.00)))))
                            <td>
                                <center><label id="estado_orden" style="background-color: #{{$parametros->colorpr1}}" title="{{$parametros->mensajepr1}}"></label></center>
                            </td>
                        <!--Rango color 2: por ejemplo: color: amarillo-->
                        @elseif(round($pedidoreposicion->stock_minimo*($parametros->rangopr2/100.00)) <= $pedidoreposicion->stock_actual && 
                            $pedidoreposicion->stock_actual <= round($pedidoreposicion->stock_minimo+($pedidoreposicion->stock_minimo*($parametros->rangopr2/100.00))))
                            <td>
                                <center><label id="estado_orden" style="background-color: #{{$parametros->colorpr2}}" title="{{$parametros->mensajepr2}}"></label></center>
                            </td>
                        <!--Rango color 1: por ejemplo: color: verde-->
                        @else
                            <td>
                                <center><label id="estado_orden" style="background-color: #{{$parametros->colorpr3}}" title="{{$parametros->mensajepr3}}"></label></center>
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
    <!--Modal detalle del sombrero-->
    <div class="modal fade bd-example-modal-lg" id="modalsombrero" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h5 modal-title ion-paperclip" id="exampleModalLabel"> 
              Sombrero: <label id="lblcodigo"></label></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-2 form-control-label"><strong>Modelo:</strong></label>
              <label class="col-sm-2 form-control-label" id="lblmodelo"></label>
              <label class="col-sm-2 form-control-label"><strong>Tejido:</strong></label>
              <label class="col-sm-2 form-control-label" id="lbltejido"></label>
              <label class="col-sm-2 form-control-label"><strong>Material:</strong></label>
              <label class="col-sm-2 form-control-label" id="lblmaterial"></label>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 form-control-label"><strong>Publico:</strong></label>
              <label class="col-sm-2 form-control-label" id="lblpublico"></label>
              <label class="col-sm-2 form-control-label"><strong>Talla:</strong></label>
              <label class="col-sm-2 form-control-label" id="lbltalla"></label>
              <label class="col-sm-2 form-control-label"><strong>Precio Venta:</strong></label>
              <label class="col-sm-2 form-control-label" id="lblprecioventa"></label>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 form-control-label"><strong>Stock Actual:</strong></label>
              <label class="col-sm-2 form-control-label" id="lblstockactual"></label>
              <label class="col-sm-2 form-control-label"><strong>Stock Maximo:</strong></label>
              <label class="col-sm-2 form-control-label" id="lblstockmaximo"></label>
              <label class="col-sm-2 form-control-label"><strong>Stock Minimo:</strong></label>
              <label class="col-sm-2 form-control-label" id="lblstockminimo"></label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!--end modal-->
    <!--modal foto-->
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
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="aceptar">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!----->
  </section>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script>
    $(document).ready(function(){
      $('#myTable').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          responsive: true
        },
        scrollY:        '70vh',
        //scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        fixedColumns:   {
          heightMatch: 'none'
        },
        fixedHeader: {
          header: true
        },
        sScrollX: true,
        sScrollXInner: "100%",
      });
    });

    function detalleSombrero(id){
      $.get('/ajax-getDatosSombrero/'+id, function(data){
        //success
        $.each(data, function(index, dato){
          $("#lblcodigo").html("[ "+dato.codigo+" ]");
          $("#lblmodelo").html(dato.modelo);
          $("#lbltejido").html(dato.tejido);
          $("#lblmaterial").html(dato.material);
          $("#lblpublico").html(dato.publico);
          $("#lbltalla").html(dato.talla);
          $("#lblprecioventa").html(dato.precio_venta);
          $("#lblstockactual").html(dato.stock_actual);
          $("#lblstockmaximo").html(dato.stock_maximo);
          $("#lblstockminimo").html(dato.stock_minimo);
        });
      });
      $('#modalsombrero').modal('show');
      //alert(id);
    }

    $(".link_foto").css('cursor', 'pointer');
    $(".link_foto").click(function(e){
      $("#mostrar_foto").attr("src",$(this).attr("src"));
      $("#myModal").modal("show");
    });
  </script>
  @endsection