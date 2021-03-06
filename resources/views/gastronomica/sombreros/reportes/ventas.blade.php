@extends('layouts.master')
@section('title','Proveedores')
@section('content')

<!--<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">-->
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Reporte ventas /</li>
      </ul>
    </div>
  </div></br>
  <section class="forms">
    <div class="container-fluid">
      {!!Form::open(['action'=>'Compras\OrdenCompraController@store','method'=>'POST'])!!}
      <div class="row">
        <div class="col-md-4">
          <div class="i-checks">
              <input id="check_panel_sombrero" type="checkbox" value="" class="form-control-custom">
              <label for="check_panel_sombrero">Panel Sombrero (Mostrar)</label>
          </div>
        </div>
      </div>
      <br/>
      <!--Panel superior-->
      <div class="row" id="panelSombrero" style="visibility: visibility; display: none;">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display ion-paperclip fadeIn animated"> Panel Sombrero:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos del nuevo modelo de sombrero.</p>
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
              </div>
              <div class="col-sm-12">
                <hr/>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 form-control-label" for="codigo"><strong>Codigo:</strong></label>
                <div class="col-sm-3">
                  {!!form::text('codigo', null,['id'=>'codigo','name'=>'codigo','class'=>'form-control',
                  'maxlength'=>'14','autofocus','placeholder'=>'Aqui el codigo del articulo'])!!}
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
      <!---->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display ion-paperclip fadeIn animated"> Panel Fechas:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese las fechas para la busqueda de ventas.</p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="fecha_inicio"><strong>Fecha Inicio (*):</strong></label>
                <div class="col-sm-3">
                  {!!Form::date('fecha_inicio', null,['id'=>'fecha_inicio','name'=>'fecha_inicio','class'=>'form-control'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="fecha_fin"><strong>Fecha Final (*):</strong></label>
                <div class="col-sm-3">
                  {!!Form::date('fecha_fin', \Carbon\Carbon::now(),['id'=>'fecha_fin','name'=>'fecha_fin','class'=>'form-control'])!!}
                </div>
                <div class="col-sm-2">
                  <button type="button" name="buscar" id="buscar" class="btn btn-primary ion-android-search rounded" title="buscar"></button>
                  <button type="button" name="mostrarTodo" id="mostrarTodo" class="btn btn-primary ion-clipboard" title="mostrar todo"></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Tabla-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display ion-paperclip fadeIn animated"> Tabla Ventas:</h2>
            </div>
            <div class="card-block miTabla">
              <a href="{{action('Reportes\ReporteController@reporteGeneralVentas')}}"
              id="reporte" class="btn btn-primary btn-sm margenInf ion-document-text" title="reporte" target="_blank"> Reporte</a><br/>
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="myTable"><!--table-responsive-->
                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo de Venta</th>
                    <th># Documento</th>
                    <th>Fecha</th>
                    <th>Cantidad Items</th>
                    <th>Precio Total</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody id="lista_datos">
                  @foreach ($ventas as $index=>$venta)
                  <tr class="fadeIn animated">
                    <th scope="row">{{$index+1}}</th>
                    <th>{{$venta->numero_venta}}</th>
                    <th>{{$venta->numero_documento}}</th>
                    <td>{{$venta->fecha}}</td>
                    <td>{{$venta->cantidad}}</td>
                    <td>S/ {{$venta->precio_total}}</td>
                    <td>{{$venta->cliente}}</td>
                    <td>{{$venta->nombres}}</td>
                    <td>
                      <a href="{{action('Reportes\ReporteController@verVentas',$venta->id)}}" class="btn btn-outline-primary btn-sm ion-eye" title="Ver"></a>
                      <a href="{{action('Ventas\VentasController@reporte',$venta->id)}}" target="_blank" class="btn btn-outline-primary btn-sm ion-document-text" title="reporte"></a>
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

    <!--Modal de fotos-->
    <div id="myModalFotos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title ion-paperclip"> Sombreros</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <p>Seleccione una imagen de sombrero:</p>
            <hr/>
            <div class="form-group row">
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
                </div>
            </div>
            <div class="form-group row">
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
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="aceptarImagen">Aceptar</button>
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

<script type="text/javascript">
  $(document).ready(function(e){
        Messenger().post({message:"Reporte: ventas.",type:"info",showCloseButton:!0});
        $('#myTable').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            responsive: true
          }
        });
  });
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

$("#buscar").click(function(e){
  var mensaje = "";
  if ($("#check_panel_sombrero").is(':checked')) {
    if ($("#codigo").val()=="") {
      mensaje = mensaje + "* El codigo no debe estar vacío.<br/>";
    } else {
      if ($("#codigo").val().length!=13) {
        mensaje = mensaje + "* El codigo no tiene los 13 caracteres.<br/>";
      }
    }
  }
  if ($("#fecha_inicio").val()=="") {
    mensaje = mensaje + "* La fecha de inicio no debe estar vacia.<br/>";
  }
  if ($("#fecha_fin").val()=="") {
    mensaje = mensaje + "* La fecha final no debe estar vacia.";
  }
  if (mensaje=="") {
    var tabla = "";
    var n = 1;
    var codigoSombrero = "0";
    // Se muestra los datos en la "tabla compras", de acuerdo al panel de sombrero + panel fechas o solo panel fechas
    if ($("#check_panel_sombrero").is(':checked')) {
      codigoSombrero = $("#codigo").val();
    }
    $.get('/ajax-reportePorFecha/2/'+codigoSombrero+'/'+$("#fecha_inicio").val()+'/'+
    $("#fecha_fin").val(), function(data){
      $('#myTable').DataTable().destroy();
      //success
      var fecha_inicio = $("#fecha_inicio").val();
      var fecha_fin = $("#fecha_fin").val();
      $.each(data, function(index, venta){
        tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+venta.numero_venta+"</th><td>"+
        venta.numero_documento+"</td><td>"+venta.fecha+"</td><td>"+venta.cantidad+"</td><td>"+venta.precio_total+
        "</td><td>"+venta.cliente+"</td><td>"+venta.nombres+"</td><td>"+
        "<a href='verventas/"+venta.id+"' class='btn btn-outline-primary btn-sm ion-eye' title='ver'></a> "
        +"<a href='{{URL::to('gastronomica/sombreros/ventas/reporte/')}}/"+venta.id+"' target='_black' class='btn btn-outline-primary btn-sm ion-document-text'></a></td></tr>";
        n++;
      });
      $("#reporte").attr('href',"{{URL::to('reporteVentasPorFechas/')}}/"+fecha_inicio+"/"+fecha_fin+"/"+codigoSombrero);
      $("#lista_datos").html(tabla);
      tabla = "";

      $('#myTable').DataTable({
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

$("#mostrarTodo").click(function(e){
  var tabla = "";
  var n = 1;
  $.get('/ajax-mostrarTodoVentas/', function(data){
    $('#myTable').DataTable().destroy();
      //success
     
      $.each(data, function(index, venta){
        tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+venta.numero_venta+
        "</th><th>"+venta.numero_documento+"</th><td>"+venta.fecha+"</td><td>"+venta.cantidad+
          "</td><td>"+venta.precio_total+"</td><td>"+venta.cliente+"</td><td>"+venta.nombres+"</td><td>"+
        "<a href='verventas/"+venta.id+"' class='btn btn-outline-primary btn-sm ion-eye' title='ver'></a> "
        +"<a href='{{URL::to('gastronomica/sombreros/ventas/reporte/')}}/"+venta.id+"' target='_black' class='btn btn-outline-primary btn-sm ion-document-text'></a></td></tr>";
        n++;
        $("#reporte").attr('href',"{{URL::to('gastronomica/sombreros/reporte_venta')}}/");
      });
      $("#lista_datos").html(tabla);
      tabla = "";

      $('#myTable').DataTable({
            "language": {
              "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
              //responsive: true,
              //data: dato//jQuery.parseJSON(dato),
            },
            responsive: true,
            stateSave: true
          });
    });
});

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
    idSombrero = 0;
    $("#galeria").html(""); //
    $("#codigo").prop("readonly",true);
        
    $("#modalModelo").val(0);
    $("#modalTejido").val(0);
    $("#modalMaterial").val(0);
    $("#modalPublico").val(0);
    $("#modalTalla").val(0);
    $("#myModalFotos").modal("show");
  } else{//POR CODIGO
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
  if ($("#codigo").val().length==13) {
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
$("#check_panel_sombrero").click(function(){
  if($(this).is(':checked')){
    //$("#panelSombrero").css("visibility","visible");
    //$("#panelSombrero").css("display","block");
    //$("#panelSombrero").css("opacity","1");
    $("#panelSombrero").animate({
      opacity: 1,
      left: "+=50",
      height: "toggle",
      visibility: "visible"
    }, 800, function() {
      // Animation complete.
    });
  } else {
    //$("#panelSombrero").css("visibility","hidden");
    $("#panelSombrero").animate({
      opacity: 0.25,
      left: "+=50",
      height: "toggle"
    }, 800, function() {
      // Animation complete.
    });
    //$("#panelSombrero").css("display","none");
    //$("#codigo").val("");
  }
});

  //
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
                    "<div><input id='radio"+n+"' onClick='guardarCodigoSombrero("+cuentaObj.id+");' type='radio' value='"+cuentaObj.codigo+"' name='b' class='opcion form-control-custom radio-custom'>"+
                    "<label for='radio"+n+"'>"+cuentaObj.codigo+"</label></div>"+"</div></div>";

                    //$("#codigo").val(cuentaObj.codigo); class='card-body'
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
