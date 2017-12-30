@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Reporte Compras</li>
      </ul>
    </div>
  </div></br>
  <div class="container-fluid">
    @include('partials.messages')
  </div>
  <section class="forms">
    <div class="container-fluid">
      {!!Form::open(['action'=>'Compras\OrdenCompraController@store','method'=>'POST'])!!}
      <!--Panel superior-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Panel Sombrero:</h2>
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
                <label class="col-sm-1 form-control-label" for="codigo"><strong>Codigo(*):</strong></label>
                <div class="col-sm-3">
                  {!!form::text('codigo', null,['id'=>'codigo','name'=>'codigo','class'=>'form-control','autofocus'])!!}
                  <span class="help-block-none">Nota: El código son de 13 caracteres.</span>
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
                <label class="col-sm-1 form-control-label" for="idMaterial"><strong>Material:</strong></label>
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
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Panel Fechas:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos del nuevo modelo de sombrero.</p>
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
                  <button type="button" name="buscar" id="buscar" class="btn btn-primary">Buscar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Tabla-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Tabla de Compras:</h2>
            </div>
            <div class="card-block miTabla">
              <a href="{{action('Reportes\ReporteController@reporteGeneralCompras')}}"
              id="reporte_general" class="btn btn-primary margenInf" target="_blank">Reporte General</a><br/>
              <table class="table table-striped table-hover table-bordered"><!--table-responsive-->
                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo de Orden</th>
                    <th>Fecha</th>
                    <th>Precio Total</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody id="lista_datos">
                  @foreach ($ordenes as $index=>$orden)
                  <tr>
                    <th scope="row">{{$index+1}}</th>
                    <td>{{$orden->numero_orden}}</td>
                    <td>{{$orden->fecha}}</td>
                    <td>{{$orden->precio_total}}</td>
                    <td>
                      <a href="{{action('Reportes\ReporteController@verCompras',$orden->id)}}" class="ion-eye" title="Ver">[Ver]</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!---->
      <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">Errores</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <h2 id="errores">Errores</h2>
              <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" id="si">Aceptar</button>
            </div>
          </div>
        </div>
      </div>
      <!---->
    </div>
  </section>
<script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
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
        $.get('/ajax-vercodigo/'+modelo_id+'/'+tejido_id+'/'+material_id+'/'+publico_id+
        '/'+talla_id, function(data){
          //success
          $.each(data, function(index, cuentaObj){
            $("#codigo").val(cuentaObj.codigo);
          });
        });
  } else {
    $("#codigo").val("");
  }
}

$("#buscar").click(function(e){
  var mensaje = "";
  if ($("#codigo").val()=="") {
    mensaje = mensaje + "* El codigo no debe estar vacío.";
  } else {
    if ($("#codigo").val().length!=13) {
      mensaje = mensaje + "</br>* El codigo no tiene los 13 caracteres.";
    }
  }
  if ($("#fecha_inicio").val()=="") {
    mensaje = mensaje + "</br>* La fecha de inicio no debe estar vacia.";
  }
  if ($("#fecha_fin").val()=="") {
    mensaje = mensaje + "</br>* La fecha final no debe estar vacia.";
  }
  if (mensaje=="") {
    var tabla = "";
    var n = 1;

    $.get('/ajax-reportePorFecha/1/'+$("#codigo").val()+'/'+$("#fecha_inicio").val()+'/'+
    $("#fecha_fin").val(), function(data){
      //success
      $.each(data, function(index, compra){
        tabla = tabla + "<tr><td>"+n+"</td><td>"+compra.numero_orden+"</td><td>"+
        compra.fecha+"</td><td>"+compra.precio_total+"</td><td>"+
        "<a href='vercompras/"+compra.id+
        "' class='ion-eye' title='ver' >[Ver]</a></td></tr>'";
        n++;
      });
      $("#lista_datos").html(tabla);
      tabla = "";
    });
  } else {
    $("#errores").html(mensaje);
    $("#myModal").modal("show");
  }

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
</script>
@endsection
