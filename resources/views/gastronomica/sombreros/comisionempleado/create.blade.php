@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/comisionempleado/comision')}}">Comision Empleado</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
      </ul>
    </div>
  </div></br>
  <div class="container-fluid">
    @include('partials.messages')
  </div>
  <section class="forms">
    <div class="container-fluid">
      {!!Form::open(['action'=>'Empleados\EmpleadoComisionController@store','method'=>'POST'])!!}
      <!--Panel superior-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip"> Panel Sombrero:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos del nuevo modelo de sombrero.</p>
              <div class=""><!--form-inline-->
                <div class="form-group row">
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
                    <label class="col-sm-1 form-control-label" for="codigo"><strong>Codigo(*):</strong></label>
                    <div class="col-sm-3">
                      {!!form::text('codigo', null,['id'=>'codigo','name'=>'codigo','class'=>'form-control'])!!}
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
      </div>
      <!---->
      <!--Comision-->
      <div class="row">
        <div class="col-lg-12"><!--offset-lg-3 col-lg-6-->
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display ion-paperclip"> Formulario:</h2>
            </div>
            <div class="card-block">
                
              <p>Ingrese los datos para el nuevo empleado.</p>
              {!!Form::open(['action'=>'Empleados\EmpleadoController@store','method'=>'POST'])!!}
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="nombres"><strong>Empleado (*):</strong></label>
                <div class="col-sm-4">
                  {!!form::text('nombres', null,['id'=>'nombres','name'=>'nombres','class'=>'form-control', 'list'=>'nombresEmpleados'])!!}
                    <datalist id="nombresEmpleados">
                    </datalist>
                </div>
                <label class="col-sm-2 form-control-label" for="idMaterial"><strong>Temporada:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idTemporada',$temporada, null,['id'=>'idTemporada','name'=>'idTemporada','class'=>'form-control'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="porcentaje"><strong>Porcentaje (%):</strong></label>
                <div class="col-sm-4">
                  {!!form::text('porcentaje', null,['id'=>'porcentaje','class'=>'form-control','placeholder'=>'Ingrese Porcentaje'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="precio_venta"><strong>Precio Venta:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('precio_venta', null,['id'=>'precio_venta','class'=>'form-control','placeholder'=>'Aqui precio venta','readonly'=>'true'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="comision"><strong>Comision:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('comision', null,['id'=>'comision','class'=>'form-control','placeholder'=>'Aqui la comision','readonly'=>'true'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="descripcion"><strong>Descripcion:</strong></label>
                <div class="col-sm-4">
                  {!!form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Digite la Descripcion',
                    'rows'=>"3", 'cols'=>"8"])!!}
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <a href="{{url('/gastronomica/sombreros/sombreros/sombrero')}}" class="btn btn-outline-primary ion-android-cancel"> Cancelar</a>
                  {!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>',
                  'class'=>'btn btn-outline-primary ion-ios-checkmark-outline'])!!}
                </div>
              </div>
              {!!Form::close()!!}
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
        llenarNombresEmpleados();
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
              $.get('/ajax-mostrarDatosSombreroComision/'+modelo_id+'/'+tejido_id+'/'+material_id+'/'+publico_id+
              '/'+talla_id, function(data){
                //success
                $.each(data, function(index, cuentaObj){
                  $("#codigo").val(cuentaObj.codigo);
                  $("#precio_venta").val(cuentaObj.precio_venta);
                  calculoComisionEmpleado();
                });
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
        $("#precio_venta").val("");
        $("#comision").val("");
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

                    $("#precio_venta").val(sombrero.precio_venta);
                    calculoComisionEmpleado();
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
      
        // check (Panel sombrero)
        
      }
    function llenarNombresEmpleados(){
        $.get('/ajax-mostrarNombresEmpleados/', function(data){
          //success
            var nombres = "";
              $.each(data, function(index, empleado){
                nombres = nombres+"<option value='"+empleado.nombres+"'></option>";
                
              });
              $("#nombresEmpleados").html(nombres);
        });
    }

    $("#porcentaje").keyup(function(e){
        calculoComisionEmpleado();
    });

    function calculoComisionEmpleado(){
        if($("#precio_venta").val()!="" && $("#porcentaje").val()!=""){
            $("#comision").val(parseInt($("#precio_venta").val())*(parseInt($("#porcentaje").val())/100.0));
        }
    }
</script>
@endsection