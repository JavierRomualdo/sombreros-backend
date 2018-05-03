@extends('layouts.master')
@section('title','Proveedores')
@section('content')
<style type="text/css"> #divredondo, #estado_orden { height:20px; width:20px; border-radius:10px; } </style>
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/ordencompra/ordencompra')}}">Orden de compra</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
      </ul>
    </div>
  </div></br>
  <div class="container-fluid">
    <center><h1 class="h5 fadeIn animated" id="titulo_codigo">Código: OC-001-17</h1></center>
    @include('partials.messages')
  </div>

  <section class="forms">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">
          <button type="button" disabled class="btn btn-outline-primary ion-compose margenInf fadeIn animated btn-sm" id="btnPedidoReposicion">
            Pedido Reposicion
          </button>
        </div>
        <div class="col-md-4">
          <div class="i-checks">
              <input id="checkpedidoreposicion" type="checkbox" value="" class="form-control-custom">
              <label for="checkpedidoreposicion">Pedido Reposicion ?</label>
          </div>
        </div>
      </div>
      <br/>
      {!!Form::open(['action'=>'Compras\OrdenCompraController@store','method'=>'POST'])!!}
      <!--Panel superior-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display ion-paperclip fadeIn animated"> Panel Sombrero:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos del nuevo modelo de sombrero.</p>
              <div class=""><!--form-inline-->
                <div class="form-group row">
                  <label class="col-sm-1 form-control-label" for="idTipoMovimiento"><strong>Proveedor:</strong></label>
                  <div class="col-sm-3">
                    {!!Form::select('idProveedor',$proveedor, null,['id'=>'idProveedor','name'=>'idProveedor','class'=>'form-control','autofocus'])!!}
                  </div>
                  <label class="form-control-label col-sm-2"><strong>Tipo Busqueda:</strong></label>
                  <div class="i-checks col-sm-2"><!--mx-sm-2-->
                    <input id="radioCodigo" type="radio" checked="" value="option1" name="a" class="opcion form-control-custom radio-custom">
                    <label for="radioCodigo">Código</label>
                  </div>
                  <div class="i-checks col-sm-2">
                    <input id="radioModelo" type="radio" value="option2" name="a" class="opcion form-control-custom radio-custom">
                    <label for="radioModelo">Modelos</label>
                  </div>
                  <div class="i-checks col-sm-2">
                    <input id="radioFoto" type="radio" value="option3" name="a" class="opcion form-control-custom radio-custom">
                    <label for="radioFoto">Foto</label>
                  </div>
                </div>
                <div class="col-sm-12">
                  <hr/>
                </div>
                <div class="form-group row">
                    <label class="col-sm-1 form-control-label" for="codigo"><strong>Codigo (*):</strong></label>
                    <div class="col-sm-3">
                      {!!form::text('codigo', null,['id'=>'codigo','name'=>'codigo','class'=>'form-control','maxlength'=>'14', 'list'=>'codigosSombrero'])!!}
                      <span class="help-block-none">Es de 13 ó 14 caracteres.</span>
                      <datalist id="codigosSombrero">
                      </datalist>
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
      </div>
      <!--Panel inferios-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display ion-paperclip fadeIn animated"> Cantidad:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos para la nueva orden de compra.</p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="stock_actual"><strong>Stock Actual:</strong></label>
                <div class="col-sm-2">
                  <label for="" id="stock_actual">##</label>
                </div>
                <label class="col-sm-2 form-control-label" for="costounitario"><strong>Costo Articulo (S/):</strong></label>
                <div class="col-sm-2">
                  <label for="" id="costounitario">##</label>
                </div>
                <label class="col-sm-2 form-control-label" for="precio_total"><strong>Costo Total (S/):</strong></label>
                <div class="col-sm-2">
                  <label for="" id="precio_total">##</label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="cantidad"><strong>Cantidad (*):</strong></label>
                <div class="col-sm-2">
                  {!!Form::number('cantidad', null,['id'=>'cantidad','name'=>'cantidad','class'=>'form-control','placeholder'=>'Digite la Cantidad',
                    'onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57','min'=>1])!!}
                  <!--{ !!form::text('cantidad', null,['id'=>'cantidad','name'=>'cantidad','class'=>'form-control','placeholder'=>'Ingrese Cantidad',
                    'onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57'])!! }-->
                </div>
                <label class="col-sm-2 form-control-label" for="descripcion"><strong>Descripcion:</strong></label>
                <div class="col-sm-3">
                  {!!form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Digite la Descripcion',
                    'rows'=>"2", 'cols'=>"8"])!!}
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>
      <!--Panel tabla-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display ion-paperclip fadeIn animated"> Tabla Detalles:</h2>
            </div>
            <div class="card-block">
              <div class="form-group row">
                <div class="col-sm-10">
                  <a href="{{url('gastronomica/sombreros/ordencompra/ordencompra')}}" class="btn btn-outline-primary ion-android-cancel btn-sm"> Cancelar</a>
                  <button type="button" class="btn btn-outline-success ion-ios-checkmark-outline btn-sm" data-toggle="modal" id="guardar"> Guardar</button>
                  <!--{ !!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>',
                    'class'=>'btn btn-primary'])!!}-->
                    
                </div>
                <div class="col-sm-1">
                  <!--<button type="button" class="btn btn-outline-primary ion-plus-round btn-sm" id="agregar" disabled> Nuevo</button>-->
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Articulo</th>
                    <th>Foto</th>
                    <th>Cantidad</th>
                    <th>Costo Articulo</th>
                    <th>Costo Total</th>
                    <th>Proveedor</th>
                    <!--<th>Pedido Reposicion</th>-->
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
    </div>
    {!!Form::close()!!}

    <!--Modales-->
    <!-- Modal-->
    <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="h5 modal-title ion-paperclip" style="color: red;"> Errores</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <h2 id="errores" class="h6">Errores</h2>
              <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="si">Aceptar</button>
            </div>
          </div>
        </div>
      </div>
    <!-- Modal aviso para guardar registros -->
    <div id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="h5 modal-title ion-paperclip"> Mensaje</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <h2 class="h6">¡Se ha guardado correctamente una orden de compra! :)</h2>
              <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="aceptar">Aceptar</button>
            </div>
          </div>
        </div>
      </div>
      <!--Modal carrusel de fotos lista_imagenes myModal3-->
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
      <!---->
      <!--Modal Pedido Reposicion-->
      <div class="modal fade bd-example-modal-lg" id="modalPedidoReposicion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h6 modal-title ion-paperclip" id="exampleModalLabel"> Pedidos Reposicion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <p>Consolidado</p>
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered specialCollapse" id="myTableOrdenCompra"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Cantidad Items</th>
                    <th>Costo Reposicion</th>
                    <th>Costo Servicio R.</th>
                    <th>Costo Total</th>
                    <th>Estado</th>
                    <th>Aciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="fadeIn animated">
                    <th scope="row">1</th>
                    <td>{!!$pedidoreposicion->cantidadtotal!!}</td>
                    <td>S/ {!!$pedidoreposicion->costoreposicion!!}</td>
                    <td>S/ {!!($pedidoreposicion->costoreposicion) * ($parametros->costoserviciorep / 100.00)!!}</td>                      
                    <td>S/ {!!($pedidoreposicion->costoreposicion) + (($pedidoreposicion->costoreposicion) * ($parametros->costoserviciorep / 100.00))!!}</td>
                    @if ($parametros->costorepmaximo > ($pedidoreposicion->costoreposicion) + (($pedidoreposicion->costoreposicion) * ($parametros->costoserviciorep / 100.00)))
                      <td>
                        <center><label id="estado_orden" style="background: green" title="menor del limite [S/ {{$parametros->costorepmaximo}}]"></label></center>
                      </td>
                    @else
                      @if ($parametros->costorepmaximo < ($pedidoreposicion->costoreposicion) + (($pedidoreposicion->costoreposicion) * ($parametros->costoserviciorep / 100.00)))
                        <td>
                          <center><label id="estado_orden" style="background: red" title="menor del limite [S/ {{$parametros->costorepmaximo}}]"></label></center>
                        </td>
                      @else
                        <td>
                          <center><label id="estado_orden" style="background: orange" title="menor del limite [S/ {{$parametros->costorepmaximo}}]"></label></center>
                        </td>
                      @endif
                    @endif
                    
                    <td>
                      <a href="javascript:mostrarPedidoReposicionDetalle();" 
                        class="btn btn-outline-primary btn-sm ion-android-checkmark-circle"></a>
                    </td>
                  </tr>
                </tbody>
              </table>
              </div>
              <p>Detalles</p>
              <div class='table-responsive'>
                <table class="table table-striped table-hover table-bordered">
                  
                  <thead class="thead-inverse">
                    <tr>
                      <th>#</th>
                      <th>Articulo</th><!--Codigo Sombrero-->
                      <th>Foto</th>
                      <th>Cantidad</th>
                      <th>Cantidad Orden</th>
                      <th>Costo Articulo</th>
                      <th>Costo Total</th>
                      <th>Proveedor</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="cuerpoTablaPedido">
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
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

  <!--Notificacion-->
  <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>
  
  <script type="text/javascript">
    $(document).ready(function(){
      mostrarCodigoOrden();
      buscarDatosPorCodigo();
    });
    var modelo_id = 0;
    var tejido_id = 0;
    var material_id = 0;
    var publico_id = 0;
    var talla_id = 0;
    var proveedor_id = 0;
    var codSombrero = "";
    var pedidoreposiciondetalle_id = 0;
    var ordencompradetalle = false;
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
    $("#idProveedor").change(function(e){
      console.log(e);
      proveedor_id = e.target.value;
      $("#codigo").val("");
      limpiar();
      llenarCodigosSombreros();
      mostrarAjax();
    });
    $("#cantidad").keyup(function(e){
      console.log(e);
      calcularPrecioTotal();
    });
    $("#cantidad").change(function(e){
      console.log(e);
      calcularPrecioTotal();
    });

    function mostrarAjax(){
      if (modelo_id!=0 && tejido_id!=0 && material_id!=0 &&
          publico_id!=0 && talla_id!=0 && proveedor_id!=0) {
            var bandera = false;
            $.get('/ajax-verdatos/'+modelo_id+'/'+tejido_id+'/'+material_id+'/'+publico_id+
            '/'+talla_id, function(data){
              //success
              $.each(data, function(index, cuentaObj){
                bandera = true;
                $("#codigo").val(cuentaObj.codigo);
                $("#costounitario").html(cuentaObj.precio);
                $("#stock_actual").html(cuentaObj.stock_actual);
              });
              if(!bandera){
                Messenger().post({message:"¡ No existe el sombrero !.",type:"info",showCloseButton:!0});
                $("#codigo").val("");
                $("#costounitario").html("##");
                $("#stock_actual").html("##");
                $("#cantidad").val("");
                $("#precio_total").html("##");
                $("#descripcion").val("");
              }
            });
      } else if(proveedor_id==0) {
        limpiar();
        $("#codigo").val("");
      } else {
        $("#codigo").val("");
      }
    }

    function llenarCodigosSombreros(){
      if(proveedor_id!=0){
        $.get('/ajax-mostrarCodigoSombreroPorProveedor/'+proveedor_id, function(data){
          //success
            var codigos = "";
              $.each(data, function(index, sombrero){
                codigos = codigos+"<option value='"+sombrero.codigo+"'></option>";
                
              });
              $("#codigosSombrero").html(codigos);
        });
      } else {
        $("#codigosSombrero").html('');
      }
    }

    function calcularPrecioTotal() {
      if ($("#costounitario").html()!="##" && $("#cantidad").val()!="") {
        $("#precio_total").html(parseInt($("#cantidad").val())*parseInt($("#costounitario").html())+"");
      } else {
        $("#precio_total").html("##");
      }
    }

    function limpiar() {
      //$("#codigo").val("");
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

      $("#costounitario").html("##");
      $("#stock_actual").html("##");
      $("#cantidad").val("");
      $("#precio_total").html("##");
      $("#descripcion").val("");
    }

    //Cambiar los estados del radio button
    $(".opcion").change(function(){
      if ($("#radioModelo").is(":checked")) {
        limpiar();
        $("#codigo").val("");
        $("#codigo").prop("readonly",true);//no se puede escribir
        //combos
        $("#idModelo").removeAttr("disabled");
        $("#idTejido").removeAttr("disabled");
        $("#idMaterial").removeAttr("disabled");
        $("#idPublicoDirigido").removeAttr("disabled");
        $("#idTalla").removeAttr("disabled");
      } else if($("#radioFoto").is(":checked")){
        $("#myModalFotos").modal("show");
      } else{//POR CODIGO
        //mostrarDatosEnCombos();
        limpiar();
        $("#codigo").val("");
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
    $("#codigo").change(function(e){
      console.log(e);
      buscarDatosPorCodigo();
    });

    function mostrarCodigoOrden() {
      $.get('/ajax-mostrarCOC/1', function(data){
        //success
        $.each(data, function(index, objeto){
          var d = new Date();
          var anio = (d.getFullYear())+"";
          var digitos = anio.substring(2,4);
          var n = parseInt(objeto.id)+1;
          var cod = "";
          if (n>0 && n<10) {
            cod = "OC-000"+n+"-"+digitos;
          } else if(n>=10 && n<100){
            cod = "OC-00"+n+"-"+digitos;
          } else if(n>=100 && n<1000){
            cod = "OC-0"+n+"-"+digitos;
          } else if(n>=1000 && n<10000){
            cod = "OC-"+n+"-"+digitos;
          } else {
            cod = "Null";
          }
          $("#titulo_codigo").text("Código: "+cod);
          //alert('(2)'+objeto.id);
        });
      });
    }
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
                  $("#costounitario").html(sombrero.precio+"");

                  $('#idModelo option[value="'+modelo_id+'"]').attr('selected','selected');
                  $('#idTejido option[value="'+tejido_id+'"]').attr('selected','selected');
                  $('#idMaterial option[value="'+material_id+'"]').attr('selected','selected');
                  $('#idPublicoDirigido option[value="'+publico_id+'"]').attr('selected','selected');
                  $('#idTalla option[value="'+talla_id+'"]').attr('selected','selected');
                  $("#stock_actual").html(sombrero.stock_actual);
                  $("#precio").val("");
            }
          });
        });
      } else {
        limpiar();
        /*$("#idModelo").val(0);
        $("#idTejido").val(0);
        $("#idMaterial").val(0);
        $("#idPublicoDirigido").val(0);
        $("#idTalla").val(0);
        $("#costounitario").val("");*/
      }
    }

    $("#guardar").click(function(){
      var mensaje = "";
      if ($("#idProveedor").val()==0) {
        mensaje = mensaje + "* Debe seleccionar un proveedor.<br/>";
      }
      if ($("#codigo").val()=="") {
        mensaje = mensaje + "* El codigo no debe estar vacío.<br/>";
      } else {
        if ($("#codigo").val().length<13 || $("#codigo").val().length>14) {
          mensaje = mensaje + "* El codigo no tiene los 13 ó 14 caracteres.<br/>";
        }
      }

      if ($("#cantidad").val()=="") {
        mensaje = mensaje + "* Debe ingresar la cantidad.";
      }
      if (mensaje=="") {

        //if ($("#idProveedor").prop("disabled")) {//desactivado
        if(ordencompradetalle) {
          //solo se guardar todas las ordenes de compras detalle
          var tabla = "";
          var n = 1;
          var descripcion = $("#descripcion").val();
          if (descripcion=="") {
            descripcion = "0";
          }
          $.get('/ajax-guardarorden/2/'+$("#codigo").val()+'/'+$("#idProveedor").val()+
          '/'+$("#cantidad").val()+'/'+$("#costounitario").html()+'/'+pedidoreposiciondetalle_id+'/'+
          descripcion, function(data){
            //success
            $.each(data, function(index, orden){
              //alert('(2) '+orden.numero_orden);
              //alert("entra "+orden.codigo);
              //orden.idOrdenCompra
              var numeroreposicion = orden.numero_reposicion;
              if(numeroreposicion==undefined){
                numeroreposicion="";
              }
              tabla = tabla+"<tr class='fadeIn animated'><td>"+n+"</td><td>"+orden.codigo+"</td>"+
              "<td><img src='/images/sombreros/"+orden.photo+
              "' class='img-fluid pull-xs-left rounded' alt='...' width='28'></td>"+
              "<td>"+orden.cantidad+"</td><td>"+orden.costounitario+"</td><td>"+
              orden.cantidad * orden.costounitario+"</td><td>"+orden.empresa+"</td><td>"+orden.descripcion+"</td></tr>";
              //$("#guardar").prop('disabled', 'disabled');
              //$("#agregar").removeAttr("disabled");
              n++;
            });
            //alert(tabla);
            $("#lista_datos").html(tabla);
            tabla = "";
            $("#myModal2").modal("show");
          });

        } else {
          //se guardan el primer en orden compra y orden de compra detalle;
          var tabla = "";
          var n = 1;
          var descripcion = $("#descripcion").val();
          if (descripcion=="") {
            descripcion = "0";
          }
          //alert("Cantidad (Inicio):"+$("#cantidad").val());
          $.get('/ajax-guardarorden/1/'+$("#codigo").val()+'/'+$("#idProveedor").val()+
          '/'+$("#cantidad").val()+'/'+$("#costounitario").html()+'/'+pedidoreposiciondetalle_id+'/'+
          descripcion, function(data){
            //success
            $.each(data, function(index, orden){
              //alert('(1) '+orden.numero_orden);
              //$("#idProveedor").prop('disabled', 'disabled');
              //$("#guardar").prop('disabled', 'disabled');
              //$("#agregar").removeAttr("disabled");
              //alert(orden.codigo);
              var numeroreposicion = orden.numero_reposicion;
              if(numeroreposicion==undefined){
                numeroreposicion="";
              }
              tabla = tabla+"<tr class='fadeIn animated'><td>"+n+"</td><td>"+orden.codigo+"</td>"+
              "<td><img src='/images/sombreros/"+orden.photo+
              "' class='img-fluid pull-xs-left rounded' alt='...' width='28'></td>"+
              "<td>"+orden.cantidad+"</td><td>"+orden.costounitario+"</td><td>"+
              orden.cantidad * orden.costounitario+"</td><td>"+orden.empresa+"</td><td>"+orden.descripcion+"</td></tr>";
              n++;
              ordencompradetalle = true;
            });
            //alert(tabla);
            $("#lista_datos").html(tabla);
            tabla = "";
            $("#myModal2").modal("show");
          });

        }
      } else {
        $("#errores").html(mensaje);
        $("#myModal").modal("show");
      }
    });

    $("#aceptar").click(function(){
      //$('#myModal').modal("show");//en este modal hay opciones (si y no)
      mostrarCodigoOrden();
      limpiar();
      $("#codigo").val("");
      $("#idProveedor").val(0);
    });

    $("#btnPedidoReposicion").click(function(){
      $('#modalPedidoReposicion').modal("show");//en este modal hay opciones (si y no)
      $("#cuerpoTablaPedido").html("");
    });

    /*$("#si").click(function(){

    });*/

    /*$("#agregar").click(function(){
      $("#guardar").removeAttr("disabled");
      $("#agregar").prop('disabled', 'disabled');
    });*/
    /*Pedido Reposicion*/
    function mostrarPedidoReposicionDetalle(){
      var n = 1;
      var tabla = "";
      
      $.get('/ajax-mostrarPedidoReposicionDetalle/', function(data){
        //success
        $.each(data, function(index, pedido){
          var mensajeBoton = "";
          if(pedido.cantidad > pedido.cantidadorden){// ya esta orden de compra se ha ingresado en la guia
            mensajeBoton = "<button class='btn btn-outline-primary btn-sm ion-android-done' onclick='elegirPedidoReposicion("+pedido.id+")'></button>";
          } else {//es que aun no se ingresa todo 
            mensajeBoton = "<button disabled title='Se ha ingresado' class='btn btn-outline-primary btn-sm ion-android-done' onclick='elegirPedidoReposicion("+pedido.id+")'></button>";
          }

          tabla = tabla+"<tr class='fadeIn animated'><th>"+n+"</th><td>"+pedido.codigo+
          "</td><td><img src='/images/sombreros/"+pedido.photo+
          "' class='img-fluid pull-xs-left rounded' alt='...' width='28'></td>"+
          "<td>"+pedido.cantidad+"</td><td>"+pedido.cantidadorden+"</td><td>S/ "+pedido.precio+
          "</td><td>S/ "+(pedido.cantidad * pedido.precio)+"</td><td>"+pedido.empresa+"</td><td>"+mensajeBoton+"</td></tr>";
          n++;
        });
        $("#cuerpoTablaPedido").html(tabla);
        tabla = "";
      });
    }

    function elegirPedidoReposicion(id){
      pedidoreposiciondetalle_id = id;
      $('#modalPedidoReposicion').modal('hide');
      $.get('/ajax-mostrarDatosSombreroOC/'+id, function(data){
        //success
        $.each(data, function(index, pedido){
          $('#idProveedor option[value="'+pedido.idProveedor+'"]').attr('selected','selected');
          $("#codigo").val(pedido.codigo);
          $('#idModelo option[value="'+pedido.idModelo+'"]').attr('selected','selected');
          $('#idTejido option[value="'+pedido.idTejido+'"]').attr('selected','selected');
          $('#idMaterial option[value="'+pedido.idMaterial+'"]').attr('selected','selected');
          $('#idPublicoDirigido option[value="'+pedido.idPublicoDirigido+'"]').attr('selected','selected');
          $('#idTalla option[value="'+pedido.idTalla+'"]').attr('selected','selected');
          $("#stock_actual").html(pedido.stock_actual);
          $("#costounitario").html(pedido.precio);
          $("#precio_total").html(pedido.precio * pedido.cantidad);
          $("#cantidad").attr('max',parseInt(pedido.cantidad-pedido.cantidadorden));
          $("#cantidad").val(pedido.cantidad-pedido.cantidadorden);
        });
      });
    }
    /**/
    $("#checkpedidoreposicion").click(function(){
      if($(this).is(':checked')){
        $("#btnPedidoReposicion").removeAttr("disabled");
        $("#radioCodigo").prop('disabled', 'disabled');
        $("#radioModelo").prop('disabled', 'disabled');
        $("#radioFoto").prop('disabled', 'disabled');
        $("#idProveedor").prop('disabled', 'disabled');
        $("#codigo").prop("readonly",true);
        $("#idModelo").prop('disabled', 'disabled');
        $("#idTejido").prop('disabled', 'disabled');
        $("#idMaterial").prop('disabled', 'disabled');
        $("#idPublicoDirigido").prop('disabled', 'disabled');
        $("#idTalla").prop('disabled', 'disabled');
      } else {
        $("#btnPedidoReposicion").prop('disabled', 'disabled');
        $("#radioCodigo").removeAttr("disabled");
        $("#radioModelo").removeAttr("disabled");
        $("#radioFoto").removeAttr("disabled");
        $("#codigo").prop("readonly",false);
        $("#idProveedor").removeAttr("disabled");
        pedidoreposiciondetalle_id = 0;
      }
    });
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
