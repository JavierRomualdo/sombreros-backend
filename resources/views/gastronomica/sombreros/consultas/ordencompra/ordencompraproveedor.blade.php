@extends('layouts.master')
@section('title','Proveedores')
@section('content')

<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

<style type="text/css"> #divredondo { height:20px; width:20px; border-radius:10px; } </style>
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
              <h2 class="h6 display ion-paperclip fadeIn animated"> Proveedor:</h2>
            </div>
            <div class="card-block">
              <div class="form-group row">
                <label class="offset-sm-0 col-sm-1 form-control-label text-center"><strong>Proveedor:</strong></label>
                <div class="col-sm-4">
                  <div class="input-group">
                    <input type="text" id="proveedor" class="form-control" readonly=""/>
                    <button type="button" name="edit" id="edit" class="btn btn-primary fa fa-edit rounded" title="buscar proveedor"></button>
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
                    <input id="checkproveedor" type="checkbox" value="" class="form-control-custom">
                    <label for="checkproveedor">Selecione proveedor</label>
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
                        <th>Codigo de Orden</th>
                        <th>Fecha</th>
                        <th>Cantidad Items</th>
                        <th>Costo Total</th>
                        <th>Estado</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody id="lista_ordenes">
                    </tbody>
                  </table>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!---->
    <!--TABLA DETALLE ORDEN DE COMPRA-->
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
                      <th>Articulo</th><!--Codigo Sombrero-->
                      <th>Foto</th>
                      <th>Cantidad</th>
                      <th>Ingresado</th>
                      <th>Pendientes</th>
                      <th>Costo Articulo</th>
                      <th>Costo Total</th>
                      <th>Proveedor</th>
                      <th>Descripcion</th>
                      <th>Estado</th>
                      <th>Accion</th>
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
    <!--Modal proveedores-->
    <div class="modal fade bd-example-modal-lg" id="modalProveedor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h6 modal-title ion-paperclip" id="exampleModalLabel"> Proveedores</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <!--<p>Historial</p>-->
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered specialCollapse" id="myTableProveedor"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Empresa</th>
                    <th>Ruc</th>
                    <th>Direccion</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($proveedores as $index=>$proveedor)
                    <tr class="fadeIn animated">
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$proveedor->empresa}}</td>
                      <td>{{$proveedor->ruc}}</td>
                      <td>{{$proveedor->direccion}}</td>
                      <td>
                        <a href="javascript:mostrarProveedor({{$proveedor->id}},'{{$proveedor->empresa}}');" class="btn btn-outline-primary btn-sm ion-android-done"></a>
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
    <div class="modal fade bd-example-modal-lg" id="modalguiaIngresos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h6 modal-title ion-paperclip" id="exampleModalLabel"> Guias Ingreso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
          <p>[ <strong>N° Guia: </strong> <label id="cantidad_guia"></label> / <strong>Cantidad Items: </strong> <label id="cantidad_items"></label> / <strong>Total: </strong> <label id="total_guia"></label> ]</p>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered specialCollapse" id="myTableGuiaIngreso"><!--table-responsive-->
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Codigo de Guia</th>
                            <th>Fecha Ingreso</th>
                            <th>Cantidad Items</th>
                            <th>Precio Total</th>
                            <th>Descripcion</th>
                        </tr>
                    </thead>
                <tbody id="lista_guia">
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
      Messenger().post({message:"Consulta orden de compra por proveedor.",type:"info",showCloseButton:!0});

      $('#myTableProveedor').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        },
        responsive: true
      });
    });

    
    var proveedor_id;
    $("#checkproveedor").change(function(e){
      $('#modalProveedor').modal('show');
    });

    function mostrarProveedor(idProveedor, empresa){
      $("#proveedor").val(empresa);
      proveedor_id = idProveedor;
      $('#modalProveedor').modal('hide');
      
    }

    $("#edit").click(function(e){
      $('#modalProveedor').modal('show');
      
    });

    $("#buscar").click(function(e){
      var mensaje = "";
        if($("#proveedor").val()==""){
          mensaje = mensaje + "* El proveedor no debe estar vacia.<br/>";
        }
        if ($("#fecha_inicio").val()=="") {
          mensaje = mensaje + "* La fecha de inicio no debe estar vacia.<br/>";
        }
        if ($("#fecha_fin").val()=="") {
          mensaje = mensaje + "* La fecha final no debe estar vacia.";
        }
        if(mensaje==""){
          //metodo buscar para luego cargar datos de las ordenes de compra del proveedor seleccionado
          cargarOrdenesCompra();
        } else {
          Messenger().post({message: mensaje,type:"info",showCloseButton:!0});
        }
    });

    function cargarOrdenesCompra(){
      if($("#proveedor").val()!=""){
        var tabla = "";
        var n = 1;
        //Llena la tabla orden de compra
        $.get('/ajax-ordenCompraProveedorConsolidado/'+proveedor_id+'/'+$("#fecha_inicio").val()+'/'+
        $("#fecha_fin").val(), function(dato){
          //success
          $('#myTableHistorial').DataTable().destroy();

          $.each(dato, function(index, orden){
              console.log(orden);
              if((parseInt(orden.cantidad)-parseInt(orden.ingresos))==0){
                tabla = tabla + "<tr class='fadeIn animated'><td>"+n+"</td><td>"+
                orden.numero_orden+
                "</td><td>"+orden.fecha+"</td><td>"+orden.cantidad+"</td><td>S/ "+orden.precio_total+"</td><td class='text-center'><label style='background: green;' id='divredondo' title='completado'></label></td><td>"+
                "<a href='javascript:verDetallesOrdenCompra("+orden.id+")' class='btn btn-outline-primary btn-sm ion-android-checkmark-circle' title='mostrar'></a> "+"</td></tr>";
              } else {
                tabla = tabla + "<tr class='fadeIn animated'><td>"+n+"</td><td>"+
                orden.numero_orden+
                "</td><td>"+orden.fecha+"</td><td>"+orden.cantidad+"</td><td>S/ "+orden.precio_total+"</td><td class='text-center'><label style='background: red;' id='divredondo' title='completado'></label></td><td>"+
                "<a href='javascript:verDetallesOrdenCompra("+orden.id+")' class='btn btn-outline-primary btn-sm ion-android-checkmark-circle' title='mostrar'></a> "+"</td></tr>";
              }
              n++;
          }); 
          
          $("#lista_ordenes").html(tabla);
          $('#myTableDetalles').DataTable().destroy();
          $("#lista_datos").html("");
          tabla = "";

          
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
        Messenger().post({message: "* Debe seleccionar el proveedor",type:"error",showCloseButton:!0});
      }
    }

    function verDetallesOrdenCompra($idOrdenCompra){
      $.get('/ajax-numeroOrdenCompra/'+$idOrdenCompra, function(data){
        //success
        $.each(data, function(index, cod){
          $("#numero_orden").html(cod.numero_orden);
        });
      });

      var tabla = "";
      var n = 1;
      //Llena la tabla orden compra detalle
      $.get('/ajax-ordenCompraDetallesProveedor/'+$idOrdenCompra, function(data){
        $('#myTableDetalles').DataTable().destroy();
        //success
        $.each(data, function(index, orden){
          var empresa;
          if(orden.empresa == $("#proveedor").val()){
            empresa = "<td><label style='background: yellow;'>"+orden.empresa+"</label></td>";
          } else {
            empresa = "<td>"+orden.empresa+"</td>";
          }
          if((parseInt(orden.cantidad)-parseInt(orden.cantidadingreso))==0){
            tabla = tabla + "<tr class='fadeIn animated'><td>"+n+"</td><td>"+
              orden.codigo+"</td><td> <img src='/images/sombreros/"+orden.photo+
              "' class='link_foto img-fluid pull-xs-left rounded' alt='...' width='28'>"+
              "</td><td>"+orden.cantidad+"</td><td>"+orden.cantidadingreso+"</td><td>"+(parseInt(orden.cantidad)-parseInt(orden.cantidadingreso))+"</td><td>S/ "+
              orden.costounitario+"</td><td>S/ "+(parseInt(orden.cantidad)*orden.costounitario)+"</td>"+empresa+"<td>"+orden.descripcion+
              "</td><td class='text-center'><label style='background: green;' id='divredondo' title='completado'></label></td><td>"+
              "<a href='javascript:verGuiaIngreso("+orden.id+","+orden.costounitario+")' class='btn btn-outline-primary btn-sm ion-android-checkbox-outline' title='ver guias ingreso'></a> "+
              "</td></tr>";
          } else {
            tabla = tabla + "<tr class='fadeIn animated'><td>"+n+"</td><td>"+
              orden.codigo+"</td><td> <img src='/images/sombreros/"+orden.photo+
              "' class='link_foto img-fluid pull-xs-left rounded' alt='...' width='28'>"+
              "</td><td>"+orden.cantidad+"</td><td>"+orden.cantidadingreso+"</td><td>"+(parseInt(orden.cantidad)-parseInt(orden.cantidadingreso))+"</td><td>S/ "+
              orden.costounitario+"</td><td>S/ "+(parseInt(orden.cantidad)*orden.costounitario)+"</td>"+empresa+"<td>"+orden.descripcion+
                "</td><td class='text-center'><label style='background: red;' id='divredondo' title='pendiente'></label></td><td>"+
              "<a href='javascript:verGuiaIngreso("+orden.id+","+orden.costounitario+")' class='btn btn-outline-primary btn-sm ion-android-checkbox-outline' title='ver guias ingreso'></a> "+
              "</td></tr>";
          }
            
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

    function verGuiaIngreso(idGuiaIngresoDetalle, precio_unitario){
      //Guia Ingreso cabevera
      $.get('/ajax-guiasIngresoPorOrdenCompraDetalleCabecera/'+idGuiaIngresoDetalle, function(data){
          //success
          $.each(data, function(index, cab){
              $("#cantidad_guia").html(cab.cantidad_guia);
              $("#cantidad_items").html(cab.cantidad_items);
              $("#total_guia").html("S/ "+cab.cantidad_items*precio_unitario);
          });
          
      });
      //Llena la tabla de guias de ingreso
      var tabla = "";
      var n = 1;
      $.get('/ajax-guiasIngresoPorOrdenCompraDetalle/'+idGuiaIngresoDetalle, function(data){
        $('#myTableGuiaIngreso').DataTable().destroy();
          //success
          $.each(data, function(index, guia){
              console.log(guia);
              tabla = tabla + "<tr class='fadeIn animated'><td>"+n+"</td><td>"+guia.numero_guia+"</td><td>"+
              guia.fecha+"</td><td>"+guia.cantidadingreso+
              "</td><td> S/ "+(guia.cantidadingreso*precio_unitario)+"</td><td>"+guia.descripcion+"</td></tr>";
              n++;
          });
          
          $("#lista_guia").html(tabla);
          tabla = "";
          //datatable guia ingreso
          $('#myTableGuiaIngreso').DataTable({
            "language": {
              "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            },
            responsive: true,
            stateSave: true
          });

          $("#modalguiaIngresos").modal("show");
      });
  }


  
  </script>
@endsection
