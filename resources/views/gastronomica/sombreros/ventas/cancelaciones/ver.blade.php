@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/ventas/cancelaciones/cancelacion')}}">Cancelacion</a></li>
        <li class="breadcrumb-item active">Ver</li>
      </ul>
    </div>
  </div></br>
  <section class="forms">
    <div class="container-fluid">
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Consolidado:</h2>
            </div>
            <div class="card-block">
              <p>Fecha: <strong>{!!$cancelacion->fecha!!}</strong></p>
              <div class="form-group row">
                @if($cancelacion->reciboprovicional == NULL)
                  <label class="col-sm-1 col-3 form-control-label" for="fecha"><strong>Banco:</strong></label>
                  <div class="col-sm-2 col-3">
                    <label class="form-control-label" for="fecha">{!!$cancelacion->banco!!}</label>
                  </div>
                  <label class="col-sm-1 col-3 form-control-label" for="user"><strong>Cuenta:</strong></label>
                  <div class="col-sm-2 col-3">
                    <label class="form-control-label" for="user">{!!$cancelacion->numerocuenta!!}</label>
                  </div>
                @else
                  <label class="col-sm-3 col-3 form-control-label" for="fecha"><strong>Recibo Provicional:</strong></label>
                  <div class="col-sm-3 col-3">
                    <label class="form-control-label" for="fecha">{!!$cancelacion->reciboprovicional!!}</label>
                  </div>
                @endif
                <label class="col-sm-2 col-3 form-control-label" for="precio_total"><strong>Cantidad Ventas:</strong></label>
                <div class="col-sm-1 col-3">
                  <label class="form-control-label" for="precio_total">{!!$cancelacion->cantidad!!}</label>
                </div>
                <label class="col-sm-1 col-3 form-control-label" for="precio_total"><strong>Total:</strong></label>
                <div class="col-sm-2 col-3">
                  <label class="form-control-label" for="precio_total">S/.{!!$cancelacion->preciototal!!}</label>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--TABLA VENTAS-->
      <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Detalles:</h2>
            </div>
            <div class="card-block miTabla">
              <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered" id="myTable"><!--table-responsive-->

                      <thead class="thead-inverse">
                        <tr>
                          <th>#</th>
                          <th>Codigo de Venta</th>
                          <th>Fecha</th>
                          <th>Cantidad Items</th>
                          <th>Precio Total</th>
                          <th>Cliente</th>
                          <th>Vendedor</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($ventas as $index=>$venta)
                        <tr class="fadeIn animated">
                          <th scope="row">{{$index+1}}</th>
                          <th>{{$venta->numero_venta}}</th>
                          <td>{{$venta->fecha}}</td>
                          <td>{{$venta->cantidad}}</td>
                          <td>S/ {{$venta->precio_total}}</td>
                          <td>{{$venta->cliente}}</td>
                          <td>{{$venta->nombres}}</td>
                          <td>
                            <a href="javascript:verDetallesVenta({{$venta->id}},'{{$venta->numero_venta}}')" class="btn btn-outline-primary btn-sm ion-eye" title="Ver"></a>
                          </td>
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
  <!--Modal de venta detalle-->
    <div class="modal fade bd-example-modal-lg" id="modalVentaDetalle" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h5 modal-title ion-paperclip" id="exampleModalLabel"> Detalle de la Venta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <p>Codigo Venta: <strong id="codigoVenta"></strong></p>
          <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">

                <thead class="thead-inverse">
                  <tr class="fadeIn animated">
                    <th>#</th>
                    <th>Articulo</th>
                    <th>Foto</th>
                    <th>Cantidad</th>
                    <th>Precio Venta</th>
                    <th>Descuento (%)</th>
                    <th>Descuento</th>
                    <th>Precio Total</th>
                    <th>Descripcion</th>
                  </tr>
                </thead>
                <tbody id="lista_venta_detalle">
              </table>
            </div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cerrar</button>
            <!--<button type="button" class="btn btn-primary">Save changes</button>-->
          </div>
        </div>
      </div>
    </div>
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

      function verDetallesVenta(idVenta, numero_venta){
        $("#codigoVenta").html(numero_venta);
        $.get('/ajax-ventaDetalle/'+idVenta, function(data){
          //success
          var tabla = "";
          var n = 1;
          $.each(data, function(index, venta){
              tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+venta.codigo+
              "</th><td><img src='/images/sombreros/"+venta.photo+"' class='link_foto img-fluid pull-xs-left rounded' alt='...' width='28' data-toggle='modal'></td><td>"+
              venta.cantidad+"</td><td>"+venta.precio_venta+"</td><td>"+venta.porcentaje_descuento+"</td><td>"+venta.descuento+"</td><td>"+
              venta.sub_total+"</td><td>"+venta.descripcion+"</td></tr>";
              n++;
          });
          $("#lista_venta_detalle").html(tabla);
          tabla = "";
          $("#modalVentaDetalle").modal("show");
        });
      }
    </script>
@endsection
