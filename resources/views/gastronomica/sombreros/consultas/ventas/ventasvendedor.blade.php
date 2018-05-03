@extends('layouts.master')
@section('title','Proveedores')
@section('content')
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">
<div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Consultar /</li>
      </ul>
    </div>
  </div></br>
  <div class="container-fluid">
    @include('partials.messages')
  </div>
  <section class="forms">
    <div class="container-fluid">
      <!---->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display ion-paperclip fadeIn animated"> Vendedor:</h2>
            </div>
            <div class="card-block">
              <div class="form-group row">
                <label class="offset-sm-0 col-sm-1 form-control-label text-center"><strong>Vendedor:</strong></label>
                <div class="col-sm-4">
                  <div class="input-group">
                    <input type="text" id="vendedor" class="form-control" placeholder="Aqui el nombre del vendedor" readonly=""/>
                    <button type="button" name="edit" id="edit" class="btn btn-primary fa fa-edit rounded" title="buscar vendedor"></button>
                  </div>
                </div>
                <label class="col-sm-1 form-control-label" for="fecha_inicio"><strong>Fecha Inicio (*):</strong></label>
                <div class="col-sm-2">
                  {!!Form::date('fecha_inicio', null,['id'=>'fecha_inicio','name'=>'fecha_inicio','class'=>'form-control'])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="fecha_fin"><strong>Fecha Fin(*):</strong></label>
                <div class="col-sm-2">
                  {!!Form::date('fecha_fin', \Carbon\Carbon::now(),['id'=>'fecha_fin','name'=>'fecha_fin','class'=>'form-control'])!!}
                </div>
                <div class="col-sm-1">
                  <button type="button" name="buscar" id="buscar" class="btn btn-primary fa fa-search rounded" title="buscar"></button>
                </div>
                <!--<div class="col-sm-3">
                  <div class="i-checks">
                    <input id="checkcliente" type="checkbox" value="" class="form-control-custom">
                    <label for="checkcliente">Selecione Cliente</label>
                  </div>
                </div>-->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---->
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder fadeIn animated">
              <div class="card-header d-flex align-items-center">
                <h2 class="h6 display ion-paperclip fadeIn animated title"> Consolidados:</h2>
              </div>
            <div class="card-block miTabla">
              <div class="table-responsive ">
                  <table class="table table-striped table-hover table-bordered specialCollapse" id="myTableHistorial"><!--table-responsive-->
                    <thead class="thead-inverse">
                      <tr>
                        <th>#</th>
                        <th>Codigo de Venta</th>
                        <th>Fecha</th>
                        <th>Cantidad Items</th>
                        <th>Precio Total</th>
                        <th>Comision</th>
                        <th>Cliente</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody id="lista_ventas">
                    </tbody>
                  </table>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!---->
    <div class="row">
        <div class="offset-lg-0 col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header">
              <h2 class="h6 display ion-paperclip fadeIn animated"> Detalles:</h2>
            </div>
            <div class="card-block miTabla">
              <div class="table-responsive">
                <p><strong>Codigo: </strong> <label id="numero_orden"></label></p>
                <table class="table table-striped table-hover table-bordered" id="myTableDetalles">
                  
                  <thead class="thead-inverse">
                    <tr>
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
                  <tbody id="lista_datos">
                </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!---->
      </div>
      <!--Modal vendedores-->
      <div class="modal fade bd-example-modal-lg" id="modalVendedor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h6 modal-title ion-paperclip" id="exampleModalLabel"> Vendedores</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <!--<p>Historial</p>-->
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered specialCollapse" id="myTableCliente"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Dni</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($vendedores as $index=>$vendedor)
                    <tr class="fadeIn animated">
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$vendedor->nombres}}</td>
                      <td>{{$vendedor->apellidos}}</td>
                      <td>{{$vendedor->dni}}</td>
                      <td>{{$vendedor->direccion}}</td>
                      <td>{{$vendedor->telefono}}</td>                      
                      <td>
                        <a href="javascript:mostrarCliente({{$vendedor->id}},'{{$vendedor->nombres}}');" class="btn btn-outline-primary btn-sm ion-android-done"></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
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
    <!--modal para mostrar la foto del sombrero mas grande-->
  <div id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="h6 modal-title ion-paperclip"> Sombrero</h5>
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
    <!---->
    </section>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

    <!--Notificacion-->
    <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
    <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
    <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>

    <script>
    $(document).ready(function(e){
      Messenger().post({message:"Consulta ventas por cliente.",type:"info",showCloseButton:!0});

      $('#myTableCliente').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        },
        responsive: true
      });
    });
    
     var vendedor_id;
      $("#checkcliente").change(function(e){
        $('#modalVendedor').modal('show');
      });

      function mostrarCliente(idVendedor, nombre){
        $("#vendedor").val(nombre);
        vendedor_id = idVendedor;
        $('#modalVendedor').modal('hide');
        
      }

      $("#edit").click(function(e){
        $('#modalVendedor').modal('show');
      
      });

      $("#buscar").click(function(e){
        var mensaje = "";
        if($("#vendedor").val()==""){
          mensaje = mensaje + "* El vendedor no debe estar vacia.<br/>";
        }
        if ($("#fecha_inicio").val()=="") {
          mensaje = mensaje + "* La fecha de inicio no debe estar vacia.<br/>";
        }
        if ($("#fecha_fin").val()=="") {
          mensaje = mensaje + "* La fecha final no debe estar vacia.";
        }
        if(mensaje==""){
          //cargar las ventas consolidado
          cargarVentas();
        } else {
          Messenger().post({message: mensaje,type:"error",showCloseButton:!0});
        }
      });
    
    function cargarVentas(){
      if($("#cliente").val()!=""){
        var tabla = "";
        var n = 1;
        //Llena la tabla orden de compra
        $.get('/ajax-ventasVendedorConsolidado/'+vendedor_id+'/'+$("#fecha_inicio").val()+'/'+
        $("#fecha_fin").val(), function(dato){
          //success
          $('#myTableHistorial').DataTable().destroy();

          $.each(dato, function(index, venta){
            tabla = tabla + "<tr class='fadeIn animated'><td>"+n+"</td><th>"+
            venta.numero_venta+"</th><td>"+venta.fecha+"</td><td>"+venta.cantidad+"</td><td>S/ "+
            venta.precio_total+"</td><td>S/ "+parseFloat(venta.utilidad * (venta.comision/100.00)).toFixed(2)+"</td><td>"+venta.cliente+"</td><td>"+
            "<a href='javascript:verDetallesVenta("+venta.id+")' class='btn btn-outline-primary btn-sm ion-android-checkmark-circle' title='mostrar'></a> "+"</td></tr>";
              n++;//venta.cliente
          }); 
          
          $("#lista_ventas").html(tabla);
          $('#myTableDetalles').DataTable().destroy();
          $("#lista_datos").html("");
          tabla = "";
          n = 1;
          
          $('#myTableHistorial').DataTable({
            "language": {
              "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
              //responsive: true,
              //data: dato//jQuery.parseJSON(dato),
            },
            responsive: true,
            stateSave: true
          });
        });
      } else {
        Messenger().post({message: "* Debe seleccionar el cliente",type:"error",showCloseButton:!0});
      }
    }

    function verDetallesVenta($idVenta){
      $.get('/ajax-numeroVenta/'+$idVenta, function(data){
        //success
        $.each(data, function(index, cod){
          $("#numero_orden").html(cod.numero_venta);
        });
      });

      var tabla = "";
      var n = 1;
      //Llena la tabla orden compra detalle
      $.get('/ajax-ventaDetallesCliente/'+$idVenta, function(data){
        $('#myTableDetalles').DataTable().destroy();
        //success
        $.each(data, function(index, ventaDetalle){
          tabla = tabla + "<tr class='fadeIn animated'><td>"+n+"</td><td>"+
              ventaDetalle.codigo+"</td><td> <img src='/images/sombreros/"+ventaDetalle.photo+
              "' class='link_foto img-fluid pull-xs-left rounded' alt='...' width='28'>"+
              "</td><td>"+ventaDetalle.cantidad+"</td><td>S/ "+ventaDetalle.precio_venta+"</td><td>"+ventaDetalle.porcentaje_descuento+"</td><td>S/ "+
              ventaDetalle.descuento+"</td><td>S/ "+ventaDetalle.sub_total+"</td><td>"+ventaDetalle.descripcion+"</td></tr>";
            n++;
        });
        
        $("#lista_datos").html(tabla);
        tabla = "";
        $('#myTableDetalles').DataTable({
            "language": {
              "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            },
            responsive: true,
            stateSave: true
        });
        
        /*pa la fpto del sombrero mas grande*/
                $(".link_foto").css('cursor', 'pointer');
                $(".link_foto").click(function(e){
                  $("#mostrar_foto").attr("src",$(this).attr("src"));
                  $("#modalFoto").modal("show");
                });
      });
    }
    </script>
@endsection