@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/proveedores/proveedores/proveedor')}}">Proveedor</a></li>
        <li class="breadcrumb-item active">Nuevo Proveedor</li>
      </ul>
    </div>
  </div><br/>
  <div class="container-fluid">
    @include('partials.messages')
  </div>
  <section class="forms">
    <div class="container-fluid">
      {!!Form::open(['action'=>'Proveedores\ProveedorController@store','method'=>'POST','class'=>'form-horizontal','id'=>'form'])!!}
      <div class="row">
        <div class="col-lg-12"><!--offset-lg-3 col-lg-6-->
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Titular:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese datos del Titular.</p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="titular"><strong id="lbl_titular">Nombres:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('titular', null,['id'=>'titular','class'=>'form-control','placeholder'=>'Ingrese Nombres del Titular', 'autofocus'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="dni_titular"><strong id="lbl_dni_titular">Dni:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('dni_titular', null,['id'=>'dni_titular','class'=>'form-control','placeholder'=>'Ingrese Dni Titular','maxlength'=>'8',
                    'onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="telefono_titular"><strong id="lbl_telefono_titular">Telefono:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('telefono_titular', null,['id'=>'telefono_titular','class'=>'form-control','placeholder'=>'Ingrese Telefono','maxlength'=>'9'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="email_titular"><strong id="lbl_email_titular">Email:</strong></label>
                <div class="col-sm-4">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> @</span>
                      {!!form::text('email_titular', null,['id'=>'email_titular','class'=>'form-control','placeholder'=>'Ingrese Email'])!!}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
              <!--<ul id="pagination" class="pagination-sm"></ul>-->
        </div>
      </div>
      <!--formulario del segundo contacto-->
      <div class="row">
        <div class="col-lg-12"><!--offset-lg-3 col-lg-6-->
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Segundo Contacto:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese datos del segundo contacto.</p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="segundo_contacto"><strong id="lbl_segundo_contacto">Nombres</strong></label>
                <div class="col-sm-4">
                  {!!form::text('segundo_contacto', null,['id'=>'segundo_contacto','class'=>'form-control','placeholder'=>'Ingrese Nombres'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="dni_segundo"><strong id="lbl_dni_segundo">Dni:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('dni_segundo', null,['id'=>'dni_segundo','class'=>'form-control','placeholder'=>'Ingrese Dni','maxlength'=>'8',
                    'onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="telefono_segundo"><strong id="lbl_telefono_segundo">Telefono:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('telefono_segundo', null,['id'=>'telefono_segundo','class'=>'form-control','placeholder'=>'Ingrese Telefono','maxlength'=>'9'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="email_segundo"><strong id="lbl_email_segundo">Email:</strong></label>
                <div class="col-sm-4">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> @</span>
                      {!!form::text('email_segundo', null,['id'=>'email_segundo','class'=>'form-control','placeholder'=>'Ingrese Email'])!!}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--formulario de la empresa-->
      <div class="row">
        <div class="col-lg-12"><!--offset-lg-3 col-lg-6-->
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Empresa:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese datos de la empresa.</p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="empresa"><strong id="lbl_empresa">Empresa:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('empresa', null,['id'=>'empresa','class'=>'form-control','placeholder'=>'Ingrese Empresa'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="ruc"><strong id="lbl_ruc">Ruc:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('ruc', null,['id'=>'ruc','class'=>'form-control','placeholder'=>'Ingrese Ruc','maxlength'=>'11',
                    'onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="direccion"><strong id="lbl_direccion">Direccion:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('direccion', null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Ingrese Direccion'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="numero_cuenta"><strong id="lbl_numero_cuenta">Numero Cuenta:</strong></label>
                <div class="col-sm-4">
                  {!!form::text('numero_cuenta', null,['id'=>'numero_cuenta','class'=>'form-control','placeholder'=>'Ingrese Numero Cuenta','maxlength'=>'21'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="fecha"><strong id="lbl_fecha">Fecha:</strong></label>
                <div class="col-sm-4">
                  {!!Form::date('fecha_ingreso', \Carbon\Carbon::now(),['class'=>'form-control','id'=>'fecha','readonly'=>''])!!}
                </div>
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/proveedores/proveedores/proveedor')}}" class="btn btn-secondary">Cancelar</a>
                {!!form::submit('Guardar',['name'=>'guardar','id'=>'editar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                  btn-primary'])!!}
              </div>
            </div>
          </div>
        </div>
      </div>
      {!!Form::close()!!}
    </div>
  </section>

  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    $.get('/ajax-estados/1', function(data){
      $.each(data, function(index, obj){
        if (obj.estado_titular=="S") {
          $("#lbl_titular").text("Nombres (*):");
          $("#titular").attr('required','');
        }
        if (obj.estado_dni_titular=="S") {
          $("#lbl_dni_titular").text("Dni (*):");
          $("#dni_titular").attr('required','');
        }
        if (obj.estado_telefono_titular=="S") {
          $("#lbl_telefono_titular").text("Telefono (*):");
          $("#telefono_titular").attr('required','');
        }
        if (obj.estado_email_titular=="S") {
          $("#lbl_email_titular").text("Email (*):");
          $("#email_titular").attr('required','');
        }
        if (obj.estado_segundo_contacto=="S") {
          $("#lbl_segundo_contacto").text("Nombre (*):");
          $("#segundo_contacto").attr('required','');
        }
        if (obj.estado_dni_segundo=="S") {
          $("#lbl_dni_segundo").text("Dni (*):");
          $("#dni_segundo").attr('required','');
        }
        if (obj.estado_telefono_segundo=="S") {
          $("#lbl_telefono_segundo").text("Telefono (*):");
          $("#telefono_segundo").attr('required','');
        }
        if (obj.estado_email_segundo=="S") {
          $("#lbl_email_segundo").text("Email (*):");
          $("#email_segundo").attr('required','');
        }
        if (obj.estado_empresa=="S") {
          $("#lbl_empresa").text("Empresa (*):");
          $("#empresa").attr('required','');
        }
        if (obj.estado_ruc=="S") {
          $("#lbl_ruc").text("Ruc (*):");
          $("#ruc").attr('required','');
        }
        if (obj.estado_direccion=="S") {
          $("#lbl_direccion").text("Direccion (*):");
          $("#direccion").attr('required','');
        }
        if (obj.estado_numero_cuenta=="S") {
          $("#lbl_numero_cuenta").text("Numero Cuenta (*):");
          $("#numero_cuenta").attr('required','');
        }
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
