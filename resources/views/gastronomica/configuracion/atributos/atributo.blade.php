@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Parametros</li>
      </ul>
    </div>
  </div><br/>
  <div class="container-fluid">
    @include('partials.messages')
  </div>
  <section class="forms">
    <div class="container-fluid">
      <div class="row">
        <div class="offset-lg-0 col-lg-4">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Ganancia:</h2>
            </div>
            <div class="card-block">
              <p>Edite los datos para el calculo precio venta de sombreros.</p>
              <div class="i-checks">
                  <input id="checkeditar" type="checkbox" value="" class="form-control-custom">
                  <label for="checkeditar">Editar</label>
              </div>
              {!!Form::model($atributos, ['action'=>['Sombreros\AtributosController@update',$atributos->id],'method'=>'PUT'])!!}
              <div class="form-group">
                <strong>{!!form::label('Igv (%):',null,['for'=>'igv'])!!}</strong>
                {!!form::text('igv', null,['id'=>'igv','class'=>'form-control','placeholder'=>'Ingrese Igv', 'autofocus','readonly'])!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Margen Ganancia (%):',null,['for'=>'margenganancia'])!!}</strong>
                {!!form::text('margenganancia', null,['id'=>'margenganancia','class'=>'form-control','placeholder'=>'Ingrese Margen ganancia', 'autofocus','readonly'])!!}
              </div>
              <div class="form-group">
                <!--<a href="{ {url('/gastronomica/configuracion/atributos/atributo')}}" class="btn btn-outline-primary btn-sm fadeIn animated ion-android-cancel"> Cancelar</a>-->
                {!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','disabled','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                  btn-outline-success btn-sm fadeIn animated'])!!}
              </div>

            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Precio Lista:</h2>
            </div>
            <div class="card-block">
              <p>Edite los datos para el calculo precio venta de sombreros.</p>
              <div class="i-checks">
                  <input id="checkeditarprecio" type="checkbox" value="" class="form-control-custom">
                  <label for="checkeditarprecio">Editar</label>
                </div>
              <div class="form-group">
                <strong>{!!form::label('Margen Minimo (%):',null,['for'=>'preciominimo'])!!}</strong>
                {!!form::text('preciominimo', null,['id'=>'preciominimo','class'=>'form-control','placeholder'=>'Ingrese Precio Minimo', 'autofocus','readonly'])!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Margen Maximo (%):',null,['for'=>'preciomaximo'])!!}</strong>
                {!!form::text('preciomaximo', null,['id'=>'preciomaximo','class'=>'form-control','placeholder'=>'Ingrese Precio Maximo', 'autofocus','readonly'])!!}
              </div>
              <div class="form-group">
                <!--<a href="{ {url('/gastronomica/configuracion/atributos/atributo')}}" class="btn btn-outline-primary btn-sm fadeIn animated ion-android-cancel"> Cancelar</a>-->
                {!!form::submit('Guardar',['name'=>'grabar','id'=>'grabarprecio','disabled','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                  btn-outline-success btn-sm fadeIn animated'])!!}
              </div>

            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Descuento venta:</h2>
            </div>
            <div class="card-block">
              <p>Edite los datos de descuentos para la realizacion de una venta.</p>
              <div class="i-checks">
                  <input id="checkeditardescuento" type="checkbox" value="" class="form-control-custom">
                  <label for="checkeditardescuento">Editar</label>
                </div>

              <div class="form-group">
                <strong>{!!form::label('Descuento Venta (%):',null,['for'=>'descuentoventa'])!!}</strong>
                {!!form::text('descuentoventa', null,['id'=>'descuentoventa','class'=>'form-control','placeholder'=>'Ingrese Descuento Venta', 'autofocus','readonly'])!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Descuento Extra (%):',null,['for'=>'descuentoextra'])!!}</strong>
                {!!form::text('descuentoextra', null,['id'=>'descuentoextra','class'=>'form-control','placeholder'=>'Ingrese Descuento extra', 'autofocus','readonly'])!!}
                <!--<div class="i-checks">
                    { !!form::checkbox('estadodescextra', null,['id'=>'estadodescextra','class'=>'form-control-custom', 'disabled'=>'false'])!! }
                    <<input id="estadodescextra" name="estadodescextra" type="checkbox" value="" class="form-control-custom" disabled>
                    <label for="estadodescextra">Activar descuento extra para los vendedores ?</label>
                </div>-->
              </div>
              <div class="form-group">
                <!--<a href="{ {url('/gastronomica/configuracion/atributos/atributo')}}" class="btn btn-outline-primary btn-sm fadeIn animated ion-android-cancel"> Cancelar</a>-->
                {!!form::submit('Guardar',['name'=>'grabar','id'=>'grabardescuento','disabled','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                  btn-outline-success btn-sm fadeIn animated'])!!}
              </div>

            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Costo Reposicion:</h2>
            </div>
            <div class="card-block">
              <p>Edite los datos de costos para generar pedidos de reposicion.</p>
              <div class="i-checks">
                  <input id="checkeditarcosto" type="checkbox" value="" class="form-control-custom">
                  <label for="checkeditarcosto">Editar</label>
                </div>
              <div class="form-group">
                <strong>{!!form::label('Costo Limite Repotacion (S/):',null,['for'=>'costorepmaximo'])!!}</strong>
                {!!form::text('costorepmaximo', null,['id'=>'costorepmaximo','class'=>'form-control','placeholder'=>'Ingrese costo reposicion maximo', 'autofocus','readonly'])!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Costo Servicio Reposicion (%):',null,['for'=>'comision'])!!}</strong>
                {!!form::text('costoserviciorep', null,['id'=>'costoserviciorep','class'=>'form-control','placeholder'=>'Ingrese costo reposicion reposicion', 'autofocus','readonly'])!!}
              </div>
              <div class="form-group">
                <!--<a href="{ {url('/gastronomica/configuracion/atributos/atributo')}}" class="btn btn-outline-primary btn-sm fadeIn animated ion-android-cancel"> Cancelar</a>-->
                {!!form::submit('Guardar',['name'=>'grabar','id'=>'grabarcosto','disabled','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                  btn-outline-success btn-sm fadeIn animated'])!!}
              </div>

            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Comision Empleado:</h2>
            </div>
            <div class="card-block">
              <p>Edite los datos de comision para la comision real del empleado por cada venta realizada.</p>
              <div class="i-checks">
                  <input id="checkeditarcomision" type="checkbox" value="" class="form-control-custom">
                  <label for="checkeditarcomision">Editar</label>
                </div>
              <div class="form-group">
                <strong>{!!form::label('Comision (%):',null,['for'=>'comision'])!!}</strong>
                {!!form::text('comision', null,['id'=>'comision','class'=>'form-control','placeholder'=>'Ingrese Comision', 'autofocus','readonly'])!!}
              </div>
              <div class="form-group">
                <!--<a href="{ {url('/gastronomica/configuracion/atributos/atributo')}}" class="btn btn-outline-primary btn-sm fadeIn animated ion-android-cancel"> Cancelar</a>-->
                {!!form::submit('Guardar',['name'=>'grabarcomision','id'=>'grabarcomision','disabled','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                  btn-outline-success btn-sm fadeIn animated'])!!}
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Color Pedido Reposicion:</h2>
            </div>
            <div class="card-block">
              <p>Edite los datos para pedido reposicion.</p>
              <div class="i-checks">
                  <input id="checkeditarcolorreposicion" type="checkbox" value="" class="form-control-custom">
                  <label for="checkeditarcolorreposicion">Editar</label>
              </div>
              <div class="form-group row">
                <strong class="col-sm-2">{!!form::label('Rango (x>) (%):',null,['for'=>'rangopr1'])!!}</strong>
                {!!form::text('rangopr1', null,['id'=>'rangopr1','class'=>'form-control col-sm-2','placeholder'=>'Ingrese Rango', 'autofocus','readonly'])!!}
                <strong class="col-sm-2">{!!form::label('Mensaje:',null,['for'=>'mensajepr1'])!!}</strong>
                {!!form::text('mensajepr1', null,['id'=>'mensajepr1','class'=>'form-control col-sm-2','placeholder'=>'Ingrese Mensaje', 'autofocus','readonly'])!!}
                <strong class="col-sm-2">{!!form::label('Color:',null,['for'=>'colorpr1'])!!}</strong>
                <input type="hidden" id="colorpr1_value" name="colorpr1" value="{!!$atributos->colorpr1!!}">
                <button id="btncolorpr1" class="form-control btn btn-primary col-sm-2 jscolor {valueElement: 'colorpr1_value'}" disabled></button>
              </div>
              <div class="form-group row">
                <strong class="col-sm-2">{!!form::label('Rango (x< & <x)  (%):',null,['for'=>'rangopr2'])!!}</strong>
                {!!form::text('rangopr2', null,['id'=>'rangopr2','class'=>'form-control col-sm-2','placeholder'=>'Ingrese Rango', 'autofocus','readonly'])!!}
                <strong class="col-sm-2">{!!form::label('Mensaje:',null,['for'=>'mensajepr2'])!!}</strong>
                {!!form::text('mensajepr2', null,['id'=>'mensajepr2','class'=>'form-control col-sm-2','placeholder'=>'Ingrese Mensaje', 'autofocus','readonly'])!!}
                <strong class="col-sm-2">{!!form::label('Color:',null,['for'=>'colorpr2'])!!}</strong>
                <input type="hidden" id="colorpr2_value" name="colorpr2" value="{!!$atributos->colorpr2!!}">
                <button id="btncolorpr2" class="form-control btn btn-primary col-sm-2 jscolor {valueElement: 'colorpr2_value'}" disabled></button>
              </div>
              <div class="form-group row">
                <!--<strong class="col-sm-2">{!!form::label('Rango (x<) (%):',null,['for'=>'rangopr3'])!!}</strong>
                {!!form::text('rangopr3', null,['id'=>'rangopr3','class'=>'form-control col-sm-2','placeholder'=>'Ingrese Rango', 'autofocus','readonly'])!!}-->
                <strong class="offset-sm-4 col-sm-2">{!!form::label('Mensaje:',null,['for'=>'mensajepr3'])!!}</strong>
                {!!form::text('mensajepr3', null,['id'=>'mensajepr3','class'=>'form-control col-sm-2','placeholder'=>'Ingrese Mensaje', 'autofocus','readonly'])!!}
                <strong class="col-sm-2">{!!form::label('Color:',null,['for'=>'colorpr3'])!!}</strong>
                <input type="hidden" id="colorpr3_value" name="colorpr3" value="{!!$atributos->colorpr3!!}">
                <button id="btncolorpr3" class="form-control btn btn-primary col-sm-2 jscolor {valueElement: 'colorpr3_value'}" disabled></button>
              </div>
              <div class="form-group">
                <!--<a href="{ {url('/gastronomica/configuracion/atributos/atributo')}}" class="btn btn-outline-primary btn-sm fadeIn animated ion-android-cancel"> Cancelar</a>-->
                {!!form::submit('Guardar',['name'=>'grabarcolorreposicion','id'=>'grabarcolorreposicion','disabled','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                  btn-outline-success btn-sm fadeIn animated'])!!}
              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/jscolor.js')}}"></script>
  <script>
    $('#checkeditar').click(function() {
      if ($(this).is(':checked')) {
        $("#igv").prop("readonly",false);
        $("#margenganancia").prop("readonly",false);
        $("#gastosservicios").prop("readonly",false);
        $("#grabar").prop("disabled",false);
      } else {
        $("#igv").prop("readonly",true);
        $("#margenganancia").prop("readonly",true);
        $("#gastosservicios").prop("readonly",true);
        $("#grabar").prop("disabled",true);        
      }
    });
    $('#checkeditarprecio').click(function() {
      if ($(this).is(':checked')) {
        $("#preciominimo").prop("readonly",false);
        $("#preciomaximo").prop("readonly",false);
        $("#grabarprecio").prop("disabled",false);
      } else {
        $("#preciominimo").prop("readonly",true);
        $("#preciomaximo").prop("readonly",true);
        $("#grabarprecio").prop("disabled",true);        
      }
    });
    $('#checkeditardescuento').click(function() {
      if ($(this).is(':checked')) {
        $("#descuentoventa").prop("readonly",false);
        $("#descuentoextra").prop("readonly",false);
        $("#estadodescextra").prop('disabled',false);
        $("#grabardescuento").prop("disabled",false);
      } else {
        $("#descuentoventa").prop("readonly",true);
        $("#descuentoextra").prop("readonly",true);
        $("#estadodescextra").prop('disabled',true);
        $("#grabardescuento").prop("disabled",true);        
      }
    });
    $('#checkeditarcosto').click(function() {
      if ($(this).is(':checked')) {
        $("#costoserviciorep").prop("readonly",false);
        $("#costorepmaximo").prop("readonly",false);
        $("#grabarcosto").prop("disabled",false);
      } else {
        $("#costoserviciorep").prop("readonly",true);
        $("#costorepmaximo").prop("readonly",true);
        $("#grabarcosto").prop("disabled",true);        
      }
    });
    $('#checkeditarcomision').click(function() {
      if ($(this).is(':checked')) {
        $("#comision").prop("readonly",false);
        $("#grabarcomision").prop("disabled",false);
      } else {
        $("#comision").prop("readonly",true);
        $("#grabarcomision").prop("disabled",true);
      }
    });

    $('#checkeditarcolorreposicion').click(function() {
      if ($(this).is(':checked')) {
        $("#rangopr1").prop("readonly",false);
        $("#mensajepr1").prop("readonly",false);
        $("#btncolorpr1").prop("disabled",false);
        $("#rangopr2").prop("readonly",false);
        $("#mensajepr2").prop("readonly",false);
        $("#btncolorpr2").prop("disabled",false);
        $("#rangopr3").prop("readonly",false);
        $("#mensajepr3").prop("readonly",false);
        $("#btncolorpr3").prop("disabled",false);
        $("#grabarcolorreposicion").prop("disabled",false);
      } else {
        $("#rangopr1").prop("readonly",true);
        $("#mensajepr1").prop("readonly",true);
        $("#btncolorpr1").prop("disabled",true);
        $("#rangopr2").prop("readonly",true);
        $("#mensajepr2").prop("readonly",true);
        $("#btncolorpr2").prop("disabled",true);
        $("#rangopr3").prop("readonly",true);
        $("#mensajepr3").prop("readonly",true);
        $("#btncolorpr3").prop("disabled",true);
        $("#grabarcolorreposicion").prop("disabled",true);
      }
    });
  </script>
@endsection
