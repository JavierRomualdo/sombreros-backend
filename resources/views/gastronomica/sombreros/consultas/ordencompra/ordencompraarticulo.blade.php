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
  </div>
  <div class="container-fluid">
    @include('partials.messages')
  </div><br/>
  <section class="forms">
    <div class="container-fluid">
        <!--Panel Sombrero-->
        <div class="row" id="panelSombrero">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h6 display ion-paperclip fadeIn animated"> Panel Sombrero:</h2>
            </div>
            <div class="card-block">
              <!--<p>Ingrese los datos del nuevo modelo de sombrero.</p>-->
              <div class="form-group row">
                <label class="form-control-label col-sm-2"><strong>Tipo Busqueda:</strong></label>
                <div class="i-checks col-sm-1"><!--mx-sm-2-->
                  <input id="radioCodigo" type="radio" checked="" value="option1" name="a" class="opcion form-control-custom radio-custom">
                  <label for="radioCodigo">Código</label>
                </div>
                <div class="i-checks col-sm-1">
                  <input id="radioModelo" type="radio" value="option2" name="a" class="opcion form-control-custom radio-custom">
                  <label for="radioModelo">Modelos</label>
                </div>
                <div class="i-checks col-sm-1">
                  <input id="radioFoto" type="radio" value="option3" name="a" class="opcion form-control-custom radio-custom">
                  <label for="radioFoto">Foto</label>
                </div>
                <label class="col-sm-1 form-control-label" for="fecha_inicio"><strong>Fecha Inicio (*):</strong></label>
                <div class="col-sm-2">
                  {!!Form::date('fecha_inicio', null,['id'=>'fecha_inicio','name'=>'fecha_inicio','class'=>'form-control'])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="fecha_fin"><strong>Fecha Fin(*):</strong></label>
                <div class="col-sm-2">
                  {!!Form::date('fecha_fin', \Carbon\Carbon::now(),['id'=>'fecha_fin','name'=>'fecha_fin','class'=>'form-control'])!!}
                </div>
                <div class="offset-sm-0' col-sm-1">
                  <button type="button" name="buscar" id="buscar" class="btn btn-primary fa fa-search rounded" title="buscar"></button>
                </div>
              </div>
              <!--<div class="col-sm-12">
                <hr/>
              </div>-->
              <div class="form-group row">
                <label class="col-sm-1 form-control-label" for="codigo"><strong>Codigo:</strong></label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" autofocus maxlength='14' id="codigo"/>
                    <span class="help-block-none">Es de 13 ó 14 caracteres.</span>
                </div>
                <label class="col-sm-1 form-control-label" for="idModelo"><strong>Modelo:</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('idModelo',$modelo, null,['id'=>'idModelo','name'=>'idModelo','class'=>'form-control','disabled'=>''])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="idTejido"><strong>Tejido:</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('idTejido',$tejido, null,['id'=>'idTejido','name'=>'idTejido','class'=>'form-control','disabled'=>''])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 form-control-label" for="idMaterial"><strong>Material</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('idMaterial',$material, null,['id'=>'idMaterial','name'=>'idMaterial','class'=>'form-control','disabled'=>''])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="idPublicoDirigido"><strong>Publico:</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('idPublicoDirigido',$publicodirigido, null,['id'=>'idPublicoDirigido','name'=>'idPublicoDirigido',
                    'class'=>'form-control','disabled'=>''])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="idTalla"><strong>Talla:</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('idTalla',$talla, null,['id'=>'idTalla','name'=>'idTalla','class'=>'form-control','disabled'=>''])!!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <!--Panel Historial-->
        <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder fadeIn animated">
              <div class="card-header d-flex align-items-center">
                  <h2 class="h6 display ion-paperclip fadeIn animated"> Consolidados:</h2>
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
    <!--Panel Detalles-->
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
                      <th>Costo Unitario</th>
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

    <!--Modal Guias de Ingreso-->
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
                <table class="table table-striped table-hover table-bordered specialCollapse" id=""><!--table-responsive-->
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
          </div>
        </div>
      </div>
    </div>
    <!---->
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
    <!--Modal de fotos-->
    <div id="myModalFotos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h6 id="exampleModalLabel" class="modal-title ion-paperclip"> Sombreros</h6>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <p>Seleccione una imagen de sombrero:</p>
            <hr/>
            <div class="row">
                <label class="col-sm-1 form-control-label" for="idModelo"><strong>Modelo</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('modalModelo',$modelo, null,['id'=>'modalModelo','name'=>'modalModelo','class'=>'form-control'])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="idTejido"><strong>Tejido</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('modalTejido',$tejido, null,['id'=>'modalTejido','name'=>'modalTejido','class'=>'form-control'])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="idMaterial"><strong>Material</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('modalMaterial',$material, null,['id'=>'modalMaterial','name'=>'modalMaterial','class'=>'form-control'])!!}
                </div><br/><br/>
                <label class="col-sm-1 form-control-label" for="idPublicoDirigido"><strong>Publico:</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('modalPublico',$publicodirigido, null,['id'=>'modalPublico','name'=>'modalPublico',
                          'class'=>'form-control'])!!}
                </div>
                <label class="col-sm-1 form-control-label" for="idTalla"><strong>Talla</strong></label>
                <div class="col-sm-3">
                  {!!Form::select('modalTalla',$talla, null,['id'=>'modalTalla','name'=>'modalTalla','class'=>'form-control'])!!}
                </div>
            </div>
            <hr/>
            <div class="row" id='galeria'>
                    @foreach ($imagenes as $key => $imagen)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="card"><a href="/images/sombreros/{{$imagen->photo}}" data-lightbox="gallery" data-title="[{{$key+1}}] Sombrero: {{$imagen->codigo}}" title="{{$imagen->codigo}}"><img src="/images/sombreros/{{$imagen->photo}}" alt="Image {{$imagen->codigo}}" class="img-fluid"></a>
                        <div class="card-body">
                        <input id="radio{{$key+1}}" type="radio" value="{{$imagen->codigo}}" onClick="guardarCodigoSombrero({{$imagen->id}})" name="b" class="opcion form-control-custom radio-custom">
                        <label for="radio{{$key+1}}">Image{{$key+1}}</label>
                        </div>
                      </div>
                    </div>
                    @endforeach
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="aceptarImagen">Aceptar</button>
          </div>
        </div>
      </div>
    </div>
  <!--fin modal de fotos-->
  </section>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

  <!--Notificacion-->
  <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>

  <script>
    $(document).ready(function(e){
      Messenger().post({message:"Consulta orden de compra por sombrero.",type:"info",showCloseButton:!0});
    });
    //Para el codigo de sombrero
    var modelo_id = 0;
    var tejido_id = 0;
    var material_id = 0;
    var publico_id = 0;
    var talla_id = 0;
    var codSombrero = "";
    $("#idModelo").change(function(e){
      console.log(e);
      modelo_id = e.target.value;
      mostrarAjax();
    });
    $("#idTejido").change(function(e){
      console.log(e);
      tejido_id = e.target.value;
      mostrarAjax();
    });
    $("#idMaterial").change(function(e){
      console.log(e);
      material_id = e.target.value;
      mostrarAjax();
    });
    $("#idPublicoDirigido").change(function(e){
      console.log(e);
      publico_id = e.target.value;
      mostrarAjax();
    });
    $("#idTalla").change(function(e){
      console.log(e);
      talla_id = e.target.value;
      mostrarAjax();
    });

    function mostrarAjax(){
        if (modelo_id!=0 && tejido_id!=0 && material_id!=0 &&
            publico_id!=0 && talla_id!=0) {
                var bandera = false;
                $.get('/ajax-vercodigo/'+modelo_id+'/'+tejido_id+'/'+material_id+'/'+publico_id+
                '/'+talla_id, function(data){
                //success
                $.each(data, function(index, cuentaObj){
                  bandera = true;
                    $("#codigo").val(cuentaObj.codigo);
                });
                if(!bandera){
                        Messenger().post({message:"¡ No existe el sombrero !.",type:"info",showCloseButton:!0});
                        $("#codigo").val("");
                    }
                });
        } else {
            $("#codigo").val("");
        }
    }

    function limpiar() {
      $("#codigo").val("");
      $("#idModelo").val(0);
      $("#idTejido").val(0);
      $("#idMaterial").val(0);
      $("#idPublicoDirigido").val(0);
      $("#idTalla").val(0);

      modelo_id = 0;
      tejido_id = 0;
      material_id = 0;
      publico_id = 0;
      talla_id = 0;
      codSombrero = "";
    }

//Cambiar los estados del radio button
$(".opcion").change(function(){
  if ($("#radioModelo").is(":checked")) {
    limpiar();
    $("#codigo").prop("readonly",true);//no se puede escribir
    //combos
    $("#idModelo").removeAttr("disabled");
    $("#idTejido").removeAttr("disabled");
    $("#idMaterial").removeAttr("disabled");
    $("#idPublicoDirigido").removeAttr("disabled");
    $("#idTalla").removeAttr("disabled");
  } else if($("#radioFoto").is(":checked")){
    $("#myModalFotos").modal("show");
  } 
  else{//POR CODIGO
    //mostrarDatosEnCombos();
    limpiar();
    $("#codigo").prop("readonly",false);
    $("#idModelo").prop('disabled', 'disabled');
    $("#idTejido").prop('disabled', 'disabled');
    $("#idMaterial").prop('disabled', 'disabled');
    $("#idPublicoDirigido").prop('disabled', 'disabled');
    $("#idTalla").prop('disabled', 'disabled');
  }
});

$("#codigo").keyup(function(e){
  console.log(e);
  buscarDatosPorCodigo();
});

function buscarDatosPorCodigo() {
  if ($("#codigo").val().length==13 || $("#codigo").val().length==14) {
    codSombrero = $("#codigo").val();
    $.get('/ajax-OCSomb/'+codSombrero, function(data){
      $.each(data, function(index, sombrero){
        modelo_id = sombrero.idModelo;
        tejido_id = sombrero.idTejido;
        material_id = sombrero.idMaterial;
        publico_id = sombrero.idPublicoDirigido;
        talla_id = sombrero.idTalla;

        if (modelo_id!=0 && tejido_id!=0 && material_id!=0 &&
            publico_id!=0 && talla_id!=0) {
              $("#idModelo").val(modelo_id);
              $("#idTejido").val(tejido_id);
              $("#idMaterial").val(material_id);
              $("#idPublicoDirigido").val(publico_id);
              $("#idTalla").val(talla_id);

              $('#idModelo option[value="'+modelo_id+'"]').attr('selected','selected');
              $('#idTejido option[value="'+tejido_id+'"]').attr('selected','selected');
              $('#idMaterial option[value="'+material_id+'"]').attr('selected','selected');
              $('#idPublicoDirigido option[value="'+publico_id+'"]').attr('selected','selected');
              $('#idTalla option[value="'+talla_id+'"]').attr('selected','selected');
        }
      });
    });
  } else {
    $("#idModelo").val(0);
    $("#idTejido").val(0);
    $("#idMaterial").val(0);
    $("#idPublicoDirigido").val(0);
    $("#idTalla").val(0);
  }
}
    //boton buscar
    $("#buscar").click(function(e){
        var mensaje = "";
        if ($("#codigo").val()=="") {
          mensaje = mensaje + "* El codigo no debe estar vacío.</br>";
        } else {
          if ($("#codigo").val().length<13 || $("#codigo").val().length>14) {
            mensaje = mensaje + "* El codigo no tiene los 13 ó 14 caracteres.<br/>";
          }
        }
        if ($("#fecha_inicio").val()=="") {
          mensaje = mensaje + "* La fecha de inicio no debe estar vacia.<br/>";
        }
        if ($("#fecha_fin").val()=="") {
          mensaje = mensaje + "* La fecha final no debe estar vacia.";
        }
        if(mensaje==""){
          $('#myTableHistorial').DataTable().destroy();
          var tabla = "";
          var n = 1;
          //Llena la tabla orden de compra
          $.get('/ajax-ordenCompraArticuloConsolidado/'+$("#codigo").val()+'/'+$("#fecha_inicio").val()+'/'+
          $("#fecha_fin").val(), function(data){
            //success
            $.each(data, function(index, orden){
                console.log(orden);
                if((parseInt(orden.cantidad)-parseInt(orden.ingresos))==0){
                  tabla = tabla + "<tr class='fadeIn animated'><td>"+n+"</td><td>"+
                  orden.numero_orden+
                  "</td><td>"+orden.fecha+"</td><td>"+orden.cantidad+"</td><td>"+orden.precio_total+
                  "</td><td class='text-center'><label style='background: green;' id='divredondo' title='completado'></label></td><td>"+
                  "<a href='javascript:verDetallesOrdenCompra("+orden.id+")' class='btn btn-outline-primary btn-sm ion-android-checkmark-circle' title='ver'></a> "+"</td></tr>";
                } else {
                  tabla = tabla + "<tr class='fadeIn animated'><td>"+n+"</td><td>"+
                  orden.numero_orden+
                  "</td><td>"+orden.fecha+"</td><td>"+orden.cantidad+"</td><td>"+orden.precio_total+
                  "</td><td class='text-center'><label style='background: red;' id='divredondo' title='completado'></label></td><td>"+
                  "<a href='javascript:verDetallesOrdenCompra("+orden.id+")' class='btn btn-outline-primary btn-sm ion-android-checkmark-circle' title='ver'></a> "+"</td></tr>";
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
          Messenger().post({message: mensaje,type:"error",showCloseButton:!0});
        }
    });

    function verDetallesOrdenCompra($idOrdenCompra){
        $.get('/ajax-numeroOrdenCompra/'+$idOrdenCompra, function(data){
          //success
          $.each(data, function(index, cod){
            $("#numero_orden").html(cod.numero_orden);
          });
        });
  
        var tabla = "";
        var articulo = "";
        var n = 1;
        //Llena la tabla orden compra detalle
        $.get('/ajax-ordenCompraDetallesProveedor/'+$idOrdenCompra, function(data){
          $('#myTableDetalles').DataTable().destroy();
          //success
          $.each(data, function(index, orden){
            
            if($("#codigo").val()==orden.codigo){
                articulo = "<label style='background: yellow;'>"+orden.codigo+"</label>";
            } else {
                articulo = "<label>"+orden.codigo+"</label>";
            }
            if((parseInt(orden.cantidad)-parseInt(orden.cantidadingreso))==0){
              tabla = tabla + "<tr class='fadeIn animated'><td>"+n+"</td><td>"+
                articulo+"</td><td> <img src='/images/sombreros/"+orden.photo+
                "' class='link_foto img-fluid pull-xs-left rounded' alt='...' width='28'>"+
                "</td><td>"+orden.cantidad+"</td><td>"+orden.cantidadingreso+"</td><td>"+(parseInt(orden.cantidad)-parseInt(orden.cantidadingreso))+"</td><td>"+
                orden.costounitario+"</td><td>"+(parseInt(orden.cantidad)*orden.costounitario)+"</td><td>"+orden.empresa+"</td><td>"+orden.descripcion+
                "</td><td class='text-center'><label style='background: green;' id='divredondo' title='completado'></label></td><td>"+
                "<a href='javascript:verGuiaIngreso("+orden.id+","+orden.costounitario+")' class='btn btn-outline-primary btn-sm ion-android-checkbox-outline' title='ver'></a> "+
                "</td></tr>";
            } else {
              tabla = tabla + "<tr class='fadeIn animated'><td>"+n+"</td><td>"+
                articulo+"</td><td> <img src='/images/sombreros/"+orden.photo+
                "' class='link_foto img-fluid pull-xs-left rounded' alt='...' width='28'>"+
                "</td><td>"+orden.cantidad+"</td><td>"+orden.cantidadingreso+"</td><td>"+(parseInt(orden.cantidad)-parseInt(orden.cantidadingreso))+"</td><td>"+
                orden.costounitario+"</td><td>"+(parseInt(orden.cantidad)*orden.costounitario)+"</td><td>"+orden.empresa+"</td><td>"+orden.descripcion+
                  "</td><td class='text-center'><label style='background: red;' id='divredondo' title='pendiente'></label></td><td>"+
                "<a href='javascript:verGuiaIngreso("+orden.id+","+orden.costounitario+")' class='btn btn-outline-primary btn-sm ion-android-checkbox-outline' title='ver'></a> "+
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
                $("#total_guia").html(cab.cantidad_items*precio_unitario);
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
                "</td><td>"+(guia.cantidadingreso*precio_unitario)+"</td><td>"+guia.descripcion+"</td></tr>";
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

    /*------------------Galeria de imagenes-------------*/
    var idSombrero = 0;
    var modelo_modal = 0;
    var tejido_modal = 0;
    var material_modal = 0;
    var publico_modal = 0;
    var talla_modal = 0;
    $("#modalModelo").change(function(e){
      console.log(e);
      modelo_modal = e.target.value;
      mostrarImagenes();
    });
    $("#modalTejido").change(function(e){
      console.log(e);
      tejido_modal = e.target.value;
      mostrarImagenes();
    });
    $("#modalMaterial").change(function(e){
      console.log(e);
      material_modal = e.target.value;
      mostrarImagenes();
    });
    $("#modalPublico").change(function(e){
      console.log(e);
      publico_modal = e.target.value;
      mostrarImagenes();
    });
    $("#modalTalla").change(function(e){
      console.log(e);
      talla_modal = e.target.value;
      mostrarImagenes();
    });
    
    function mostrarImagenes(){
      var bandera = false;
            var miGaleria = "";
            var n=1;
            $.get('/ajax-mostrarGaleria/'+modelo_modal+'/'+tejido_modal+'/'+material_modal+'/'+publico_modal+
                '/'+talla_modal, function(data){
                //success
                
                $.each(data, function(index, cuentaObj){
                    bandera = true;
                    miGaleria = miGaleria+"<div class='col-6 col-md-4 col-lg-3 col-xl-2'><div class='card'>"+
                    "<a href='/images/sombreros/"+cuentaObj.photo+"' data-lightbox='gallery' data-title='["+n+"] Sombrero:"+cuentaObj.codigo+"' title='"+cuentaObj.codigo+"'>"+
                    "<img src='/images/sombreros/"+cuentaObj.photo+"' class='img-fluid' alt='Image"+cuentaObj.codigo+"'>"+"</a> "+
                    "<div class='card-body'><input id='radio"+n+"' onClick='guardarCodigoSombrero("+cuentaObj.id+");' type='radio' value='"+cuentaObj.codigo+"' name='b' class='opcion form-control-custom radio-custom'>"+
                    "<label for='radio"+n+"'>Image"+n+"</label></div>"+"</div></div>";

                    //$("#codigo").val(cuentaObj.codigo);
                    n++;
                });
                $("#galeria").html(miGaleria);
                if(!bandera){
                    Messenger().post({message:"¡ No existe el sombrero !.",type:"info",showCloseButton:!0});
                    $("#codigo").val("");
                }
            });
    }

    function guardarCodigoSombrero($id){
      //
      idSombrero = $id;
    }
    $("#aceptarImagen").click(function(){
      if(idSombrero!=0){
        //mostrarCodSombrero
        $.get('/ajax-mostrarCodSombrero/'+idSombrero, function(data){
                  //
          $.each(data, function(index, sombrero){
            $("#codigo").val(sombrero.codigo);
            buscarDatosPorCodigo();
          });
        });
      }
    });
  </script>
@endsection