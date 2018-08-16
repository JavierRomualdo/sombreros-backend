@extends('layouts.master')
@section('title','Proveedores')
@section('content')
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/guiaingreso/guiaingreso')}}">Guia Ingreso</a></li>
        <li class="breadcrumb-item active">Ver</li>
      </ul>
    </div>
  </div></br>
  <section class="forms">
    <div class="container-fluid">
      <a href="{{action('Compras\GuiaIngresoController@reporte',$guia->id)}}" target="_blank" class="btn btn-outline-primary margenInf ion-document-text fadeIn animated btn-sm"> Reporte</a>
      <!--<a href="{ {action('Sombreros\MovimientoController@reporte',$sombrero->id)}}" target="_blank" class="btn btn-primary margenInf">Reporte</a>
      -->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Consolidado:</h2>
            </div>
            <div class="card-block">
              <p>Codigo: <strong>{!!$guia->numero_guia!!}</strong></p>
              <div class="form-group row">
                <label class="col-sm-2 col-3 form-control-label" for="fecha"><strong># Doc Proveedor:</strong></label>
                <div class="col-sm-1 col-3">
                  <label class="form-control-label" for="fecha">{!!$guia->numero_documento!!}</label>
                </div>
                <label class="col-sm-1 col-3 form-control-label" for="fecha"><strong>Fecha:</strong></label>
                <div class="col-sm-1 col-3">
                  <label class="form-control-label" for="fecha">{!!$guia->fecha!!}</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="precio_total"><strong>Cantidad Items:</strong></label>
                <div class="col-sm-1 col-3">
                  <label class="form-control-label" for="precio_total">{!!$guia->cantidad_guia!!}</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label" for="precio_total"><strong>Costo Total:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" for="precio_total">S/ {!!$guia->precio_total!!}</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--TABLA DETALLE ORDEN DE COMPRA-->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Detalles:</h2>
            </div>
            <div class="card-block">
              <div class="table-responsive">
                  <table class="table table-striped table-hover table-bordered" id="myTable">

                      <thead class="thead-inverse">
                        <tr>
                          <th class="text-center">#</th>
                          <th>Articulo</th>
                          <th>Foto</th>
                          <th>Cantidad</th>
                          <th>Costo Articulo</th>
                          <th>Costo Total</th>
                          <th>Proveedor</th>
                          <th>Codigo Orden</th>
                          <th>Descripcion</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($detalles as $index=>$detalle)
                          <tr class='fadeIn animated'>
                            <th scope="row" class="text-center">{{$index+1}}</th>
                            <td>{{$detalle->codigo}}</td>
                            <td>
                              <img src="/images/sombreros/{{$detalle->photo}}"
                                data-toggle="modal" class="link_foto img-fluid pull-xs-left rounded" alt="..." width="28" title="ver foto"><!--data-target="#myModal"-->
                            </td>
                            <td>{{$detalle->cantidad}}</td>
                            <td>S/ {{$detalle->precio}}</td>
                            <td>S/ {{($detalle->cantidad * $detalle->precio)}}</td>
                            <td>{{$detalle->empresa}}</td>
                            <td>{{$detalle->numero_orden}}</td>
                            <td>{{$detalle->descripcion}}</td>
                          </tr>
                        @endforeach
                    </table>
              </div>
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
    $(".link_foto").css('cursor', 'pointer');
    $(".link_foto").click(function(e){
      $("#mostrar_foto").attr("src",$(this).attr("src"));
      $("#myModal").modal("show");
    });
  </script>
@endsection
