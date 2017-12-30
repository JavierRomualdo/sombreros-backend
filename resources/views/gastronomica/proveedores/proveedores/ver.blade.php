@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/proveedores/proveedores/proveedor')}}">Proveedor</a></li>
        <li class="breadcrumb-item active">Ver Proveedor</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
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
                  <label for="">{!!$proveedor->titular!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="dni_titular"><strong id="lbl_dni_titular">Dni:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$proveedor->dni_titular!!}</label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="telefono_titular"><strong id="lbl_telefono_titular">Telefono:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$proveedor->telefono_titular!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="email_titular"><strong id="lbl_email_titular">Email:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$proveedor->email_titular!!}</label>
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
                  <label for="">{!!$proveedor->segundo_contacto!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="dni_segundo"><strong id="lbl_dni_segundo">Dni:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$proveedor->dni_segundo!!}</label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="telefono_segundo"><strong id="lbl_telefono_segundo">Telefono:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$proveedor->telefono_segundo!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="email_segundo"><strong id="lbl_email_segundo">Email:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$proveedor->email_segundo!!}</label>
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
                  <label for="">{!!$proveedor->empresa!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="ruc"><strong id="lbl_ruc">Ruc:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$proveedor->ruc!!}</label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="direccion"><strong id="lbl_direccion">Direccion:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$proveedor->direccion!!}</label>
                </div>
                <label class="col-sm-2 form-control-label" for="numero_cuenta"><strong id="lbl_numero_cuenta">Numero Cuenta:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$proveedor->numero_cuenta!!}</label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="fecha"><strong id="lbl_fecha">Fecha:</strong></label>
                <div class="col-sm-4">
                  <label for="">{!!$proveedor->fecha_ingreso!!}</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
