@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/proveedores/proveedores/proveedor')}}">Proveedor</a></li>
        <li class="breadcrumb-item active">Datos</li>
      </ul>
    </div>
  </div><br/>
  <div class="container-fluid">
    @include('partials.messages')
  </div>
  <section class="forms">
    <!--{ !!Form::open(['action'=>'Proveedores\ProveedorController@store','method'=>'POST','class'=>'form-horizontal','id'=>'form'])!!}
    -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Titular:</h2>
            </div>
            <div class="card-block">
              <p>Editar Titular</p>
              <!--
              <div class="i-checks">
                <input id="checkeditar" type="checkbox" value="" class="form-control-custom">
                <label for="checkeditar">Obligatorio</label>
              </div>
            -->

            <table class="table table-striped table-hover table-bordered"><!--table-responsive-->
              <thead class="thead-inverse">
                <tr>
                  <th>Campo</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>Nombre</th>
                  <td>
                    <div class="i-checks">
                      <input id="check_estado_titular" type="checkbox" value="" class="form-control-custom" disabled="true">
                      <label for="check_estado_titular">Obligatorio</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>Dni</th>
                  <td>
                    <div class="i-checks">
                      <input id="check_dni_titular" type="checkbox" value="" class="form-control-custom" disabled="true">
                      <label for="check_dni_titular">Obligatorio</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>Telefono</th>
                  <td>
                    <div class="i-checks">
                      <input id="check_telefono_titular" type="checkbox" value="" class="form-control-custom" disabled="true">
                      <label for="check_telefono_titular">Obligatorio</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>
                    <div class="i-checks">
                      <input id="check_email_titular" type="checkbox" value="" class="form-control-custom" disabled="true">
                      <label for="check_email_titular">Obligatorio</label>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            </div>
          </div>
              <!--<ul id="pagination" class="pagination-sm"></ul>-->
        </div>
        <!--Tabla segundo contacto-->
        <div class="col-lg-4">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Segundo Contacto:</h2>
            </div>
            <div class="card-block">
              <p>Editar Segundo Contacto</p>
              <table class="table table-striped table-hover table-bordered"><!--table-responsive-->
                <thead class="thead-inverse">
                  <tr>
                    <th>Campo</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>Nombres</th>
                    <td>
                      <div class="i-checks">
                        <input id="check_nombre_segundo" type="checkbox" value="" class="form-control-custom" disabled="true">
                        <label for="check_nombre_segundo">Obligatorio</label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th>Dni</th>
                    <td>
                      <div class="i-checks">
                        <input id="check_dni_segundo" type="checkbox" value="" class="form-control-custom" disabled="true">
                        <label for="check_dni_segundo">Obligatorio</label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th>Telefono</th>
                    <td>
                      <div class="i-checks">
                        <input id="check_telefono_segundo" type="checkbox" value="" class="form-control-custom" disabled="true">
                        <label for="check_telefono_segundo">Obligatorio</label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th>Email</th>
                    <td>
                      <div class="i-checks">
                        <input id="check_email_segundo" type="checkbox" value="" class="form-control-custom" disabled="true">
                        <label for="check_email_segundo">Obligatorio</label>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!--Tabla de empresa-->
        <div class="col-lg-4">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Empresa:</h2>
            </div>
            <div class="card-block">
              <p>Editar Empresa</p>
              <table class="table table-striped table-hover table-bordered"><!--table-responsive-->
                <thead class="thead-inverse">
                  <tr>
                    <th>Campo</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>Empresa</th>
                    <td>
                      <div class="i-checks">
                        <input id="check_empresa" type="checkbox" value="" class="form-control-custom" disabled="true">
                        <label for="check_empresa">Obligatorio</label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th>Ruc</th>
                    <td>
                      <div class="i-checks">
                        <input id="check_ruc" type="checkbox" value="" class="form-control-custom" disabled="true">
                        <label for="check_ruc">Obligatorio</label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th>Direccion</th>
                    <td>
                      <div class="i-checks">
                        <input id="check_direccion" type="checkbox" value="" class="form-control-custom" disabled="true">
                        <label for="check_direccion">Obligatorio</label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th>Numero Cuenta</th>
                    <td>
                      <div class="i-checks">
                        <input id="check_numero_cuenta" type="checkbox" value="" class="form-control-custom" disabled="true">
                        <label for="check_numero_cuenta">Obligatorio</label>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="form-group">
                <a href="{{url('/gastronomica/proveedores/proveedores/proveedor')}}" class="btn btn-outline-primary fadeIn animated btn-sm ion-android-cancel"> Cancelar</a>
                <button type="button" class="btn btn-outline-primary btn-sm" id="editar">Editar</button>
                <a href="" class="disabled btn btn-outline-success btn-sm" id="guardar">Guardar</a>
                <!--<button type="button" class="btn btn-primary" id="guardar" name="button" disabled="true">Guardar</button>-->
                <!--{ !!form::submit('Guardar',['disabled'=>'true','name'=>'Guardar','id'=>'guardar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                  btn-primary'])!!}-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--{ !!Form::close()!!}-->
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script type="text/javascript">
    //******Al cargar esta plantilla*****
    $(document).ready(function(){
      $.get('/ajax-estados/1', function(data){
        $.each(data, function(index, obj){
          if (obj.estado_titular=="S") {
            $("#check_estado_titular").attr('checked','');
          }
          if (obj.estado_dni_titular=="S") {
            $("#check_dni_titular").attr('checked','');
          }
          if (obj.estado_telefono_titular=="S") {
            $("#check_telefono_titular").attr('checked','');
          }
          if (obj.estado_email_titular=="S") {
            $("#check_email_titular").attr('checked','');
          }
          if (obj.estado_segundo_contacto=="S") {
            $("#check_nombre_segundo").attr('checked','');
          }
          if (obj.estado_dni_segundo=="S") {
            $("#check_dni_segundo").attr('checked','');
          }
          if (obj.estado_telefono_segundo=="S") {
            $("#check_telefono_segundo").attr('checked','');
          }
          if (obj.estado_email_segundo=="S") {
            $("#check_email_segundo").attr('checked','');
          }
          if (obj.estado_empresa=="S") {
            $("#check_empresa").attr('checked','');
          }
          if (obj.estado_ruc=="S") {
            $("#check_ruc").attr('checked','');
          }
          if (obj.estado_direccion=="S") {
            $("#check_direccion").attr('checked','');
          }
          if (obj.estado_numero_cuenta=="S") {
            $("#check_numero_cuenta").attr('checked','');
          }
        });
      });
    });
    //*****Al ser click en el boton "editar"*********"
    $("#editar").click(function(){
      $("#guardar").attr("disabled", false);
      $("#check_estado_titular").attr('disabled', false);
      $("#check_dni_titular").attr('disabled', false);
      $("#check_telefono_titular").attr('disabled', false);
      $("#check_email_titular").attr('disabled', false);
      $("#check_nombre_segundo").attr('disabled', false);
      $("#check_dni_segundo").attr('disabled', false);
      $("#check_telefono_segundo").attr('disabled', false);
      $("#check_email_segundo").attr('disabled', false);
      $("#check_empresa").attr('disabled', false);
      $("#check_ruc").attr('disabled', false);
      $("#check_direccion").attr('disabled', false);
      $("#check_numero_cuenta").attr('disabled', false);
      $("#guardar").removeClass("disabled");
    });


  </script>
  <script type="text/javascript">
  $("#guardar").click(function(){
    var nombre_titular = "N";
    var dni_titular = "N";
    var telefono_titular = "N";
    var email_titular = "N";//

    var nombre_segundo = "N";
    var dni_segundo = "N";
    var telefono_segundo = "N";
    var email_segundo = "N";

    var empresa = "N";
    var ruc = "N";
    var direccion = "N";
    var numero_cuenta = "N";

    if ($("#check_estado_titular").is(':checked')) {
      nombre_titular = "S";
    }
    if ($("#check_dni_titular").is(':checked')) {
      dni_titular = "S";
    }
    if ($("#check_telefono_titular").is(':checked')) {
      telefono_titular = "S";
    }
    if ($("#check_email_titular").is(':checked')) {
      email_titular = "S";
    }
    if ($("#check_nombre_segundo").is(':checked')) {
      nombre_segundo = "S";
    }
    if ($("#check_dni_segundo").is(':checked')) {
      dni_segundo = "S";
    }
    if ($("#check_telefono_segundo").is(':checked')) {
      telefono_segundo = "S";
    }
    if ($("#check_email_segundo").is(':checked')) {
      email_segundo = "S";
    }
    if ($("#check_empresa").is(':checked')) {
      empresa = "S";
    }
    if ($("#check_ruc").is(':checked')) {
      ruc = "S";
    }
    if ($("#check_direccion").is(':checked')) {
      direccion = "S";
    }
    if ($("#check_numero_cuenta").is(':checked')) {
      numero_cuenta = "S";
    }
    $.get('/ajax-estadosg/'+nombre_titular+'/'+dni_titular+'/'+telefono_titular+'/'+email_titular+'/'+nombre_segundo+'/'+dni_segundo+'/'+telefono_segundo+'/'+email_segundo+'/'+empresa+'/'+ruc+'/'+direccion+'/'+numero_cuenta, function(data){
      $.each(data, function(index, objE){
        //..
      });
    });
  });
  </script>
  <!--<script type="text/javascript">
  $("#grabar").click(function(event){
    event.preventDefault();
    var formData = {
      nombres: $('#nombres').val(),
      apellidos: $('#apellidos').val(),
      dni: $('#dni').val(),
      empresa: $('#empresa').val(),
      ruc: $('#ruc').val(),
      direccion: $('#direccion').val(),
      telefono: $('#telefono').val(),
      correo: $('#correo').val(),
      fecha_ingreso: $('#fecha_ingreso').val(),
    };
    var token = $("input[name=_token]").val();
    var route = '{ {url('listallget')}}';
    alert(route + " "+token);
    console.log(formData);
    $.ajax({
      url: route,
      headers:{'X-CSRF-TOKEN': token},
      type: 'post',
      datatype: 'json',
      data: formData,
      success: function(data){
        alert("insertar");
      },
      error: function(data){
        alert("error: ");
      }
    });
  });
</script>-->
@endsection
