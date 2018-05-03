@extends('layouts.master')
@section('title','Proveedores')
@section('content')

<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/ventas/ventas')}}">Ventas</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
      </ul>
    </div>
  </div></br>
  <div class="container-fluid">
    <center><h1 class="h5 fadeIn animated"><strong id="titulo_codigo">Código: OV-001-17</strong></h1></center>
    <!--@include('partials.messages')-->
  </div>

  <section class="forms">
    <div class="container-fluid">
      {!!Form::open(['action'=>'Ventas\VentasController@store','method'=>'POST'])!!}
      <!--Panel superior-->
      <div class="row">
        <!--<div class="col-lg-12">
          <div class="col-lg-6">
              <div class="card line-chart-example">
                <div class="card-header d-flex align-items-center">
                  <h4>Line Chart Example</h4>
                </div>
                <div class="card-body">
                  <canvas id="lineChartExample"></canvas>
                </div>
              </div>
            </div>
        </div>-->
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip"> Panel Sombrero:</h2>
            </div>
            <div class="card-block">
              <!--<p>Ingrese los datos del nuevo modelo de sombrero.</p>-->
              <div class="">
                <div class="form-group row">
                  <!--<label class="col-sm-1 form-control-label" for="idTipoMovimiento"><strong>Proveedor:</strong></label>
                  <div class="col-sm-3">
                    { !!Form::select('idProveedor',$proveedor, null,['id'=>'idProveedor','name'=>'idProveedor','class'=>'form-control'])!!}
                  </div>-->
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
                <!--<div class="col-sm-12">
                  <hr/>
                </div>-->
                <div class="form-group row">
                  <label class="col-sm-1 form-control-label" for="codigo"><strong>Codigo:</strong></label>
                  <div class="col-sm-3">
                    {!!form::text('codigo', null,['id'=>'codigo','name'=>'codigo','class'=>'form-control','maxlength'=>'14','autofocus'])!!}
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
      </div>
      <!--Panel inferios-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Cantidad:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos para la nueva orden de compra.</p>
              <div class="form-group row">
                <label class="col-sm-1 form-control-label" for="stock_actual"><strong>Stock Actual:</strong></label>
                <div class="col-sm-3">
                  {!!form::text('stock_actual', null,['id'=>'stock_actual','name'=>'stock_actual','class'=>'form-control',
                    'placeholder'=>'Aqui el stock actual', 'readonly'=>'true'])!!}
                </div>
                <!--<label class="col-sm-1 form-control-label" for="precio_compra"><strong>Precio Compra:</strong></label>
                <div class="col-sm-3">
                  { !!form::text('precio_compra', null,['id'=>'precio_compra','name'=>'precio_venta','class'=>'form-control',
                    'placeholder'=>'Aqui el precio compra', 'readonly'=>'true'])!! }
                </div>-->
                <label class="col-sm-1 form-control-label" for="precio_venta"><strong>Precio Venta:</strong></label>
                <div class="col-sm-3">
                  {!!form::text('precio_venta', null,['id'=>'precio_venta','name'=>'precio_venta','class'=>'form-control',
                    'placeholder'=>'Aqui el precio venta', 'readonly'=>'true'])!!}
                </div>
                <!--<label class="col-sm-1 form-control-label" for="precio_sin_descuento"><strong>Pr. Sin Descuento:</strong></label>
                <div class="col-sm-3">
                  {!!form::text('precio_sin_descuento', null,['id'=>'precio_sin_descuento','name'=>'precio_sin_descuento','class'=>'form-control',
                    'placeholder'=>'Aqui el precio total sin descuento','readonly'=>'true'])!!}
                </div>-->
                <label class="col-sm-1 form-control-label" for="precio_total"><strong>Precio Total:</strong></label>
                <div class="col-sm-3">
                  {!!form::text('precio_total', null,['id'=>'precio_total','name'=>'cantidad','class'=>'form-control',
                    'placeholder'=>'Aqui el precio total','readonly'=>'true'])!!}
                </div>
              </div>
              <div class="form-group row">
                <!--<label class="col-sm-1 form-control-label" for="utilidad"><strong>Utilidad:</strong></label>
                <div class="col-sm-3">
                  { !!form::text('utilidad', null,['id'=>'utilidad','name'=>'utilidad','class'=>'form-control',
                    'placeholder'=>'Aqui la utilidad','readonly'=>'true'])!! }
                </div>-->
                <label class="col-sm-1 form-control-label" for="cantidad"><strong>Cantidad(*):</strong></label>
                <div class="col-sm-3">
                  {!!Form::number('cantidad', null,['id'=>'cantidad','name'=>'cantidad','class'=>'form-control','placeholder'=>'Digite la Cantidad',
                    'onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57','min'=>1])!!}
                  <!--{ !!form::text('cantidad', null,['id'=>'cantidad','name'=>'cantidad','class'=>'form-control','placeholder'=>'Ingrese Cantidad',
                    'onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57'])!! }-->
                </div>
                <label class="col-sm-1 form-control-label" for="porcentaje_descuento"><strong>Descuento (%):</strong></label>
                <div class="col-sm-3">
                  {!!form::text('porcentaje_descuento', 0,['id'=>'porcentaje_descuento','name'=>'porcentaje_descuento','class'=>'form-control',
                    'placeholder'=>'Aqui el porcentaje descuento'])!!}
                  
                  <div class="i-checks">
                    <label class="help-block-none" id="mensajedescuentop">Máximo: {{$parametros->descuentoventa}} % |</label>
                    <input id="checkdescuentoextra" type="checkbox" value="" class="form-control-custom">
                    <label for="checkdescuentoextra">Descuento extra?</label>
                  </div>
                </div>
                <label class="col-sm-1 form-control-label" for="descuento"><strong>Descuento (S/):</strong></label>
                <div class="col-sm-3">
                  {!!form::text('descuento', 0,['id'=>'descuento','name'=>'descuento','class'=>'form-control',
                    'placeholder'=>'Aqui el descuento'])!!}
                  <span class="help-block-none" id="mensajedescuento"></span>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 form-control-label" for="empleado"><strong>Vendedor:</strong></label>
                <div class="col-sm-3">
                  <div class="input-group">
                    <label id="empleado" class="form-control text-center"></label>
                    <button type="button" class="btn btn-primary" title="buscar vendedor" id="btnempleado">
                    <i class="fa fa-search"></i></button>
                  </div>
                  <!--{ !!form::text('empleado', null,['id'=>'empleado','name'=>'empleado','class'=>'form-control',
                    'placeholder'=>'Aqui el empleado','readonly'=>'true'])!! }
                    <div class="i-checks">
                        <input id="checkempleado" type="checkbox" value="" class="form-control-custom">
                        <label for="checkempleado">Selecione empleado</label>
                      </div>-->
                  <!--<span class="help-block-none">Nota: Clickea para seleccionar empleado.</span>-->
                </div>
                <!--<label class="col-sm-1 form-control-label" for="encargo"><strong>Encargo:</strong></label>
                <div class="col-sm-3">
                  { !!form::text('encargo', null,['id'=>'encargo','name'=>'encargo','class'=>'form-control',
                    'placeholder'=>'Aqui el encargo','readonly'=>'true'])!! }
                </div>-->
                <label class="col-sm-1 form-control-label" for="cliente"><strong>Cliente:</strong></label>
                <div class="col-sm-3">
                  <div class="input-group">
                    <label id="cliente" class="form-control text-center"></label>
                    <button type="button" class="btn btn-primary" title="buscar cliente" id="btncliente">
                    <i class="fa fa-search"></i></button>
                  </div>
                  <!--{ !!form::text('cliente', null,['id'=>'cliente','name'=>'cliente','class'=>'form-control',
                    'placeholder'=>'Aqui el cliente','readonly'=>'true'])!! }
                    <div class="i-checks">
                        <input id="checkcliente" type="checkbox" value="" class="form-control-custom">
                        <label for="checkcliente">Selecione cliente</label>
                      </div>-->
                  <!--<span class="help-block-none">Nota: Clickea para seleccionar empleado.</span>-->
                </div>
                <label class="col-sm-1 form-control-label" for="descripcion"><strong>Descripcion:</strong></label>
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
              <h2 class="h5 display ion-paperclip fadeIn animated"> Detalles:</h2>
            </div>
            <div class="card-block">
              <p>Lista de todos los detalles de la venta.</p>
              <div class="form-group row">
                <div class="col-sm-10">
                  <a href="{{url('gastronomica/sombreros/ventas/ventas')}}" class="btn btn-outline-primary ion-android-cancel btn-sm"> Cancelar</a>
                  <button type="button" class="btn btn-outline-success ion-ios-checkmark-outline btn-sm" data-toggle="modal" id="guardar"> Guardar</button>
                  <!--{ !!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>',
                    'class'=>'btn btn-primary'])!!}-->
                    
                </div>
                <div class="col-sm-1">
                  <!--<button type="button" class="btn btn-outline-primary ion-plus-round btn-sm" id="agregar" disabled> Agregar</button>-->
                </div>
              </div>
              <div class="form-group">
                <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo Sombrero</th>
                    <th>Foto</th>
                    <th>Cantidad</th>
                    <th>Precio Venta</th><!--precio unitario-->
                    <th>% Descuento</th>
                    <th>Descuento</th>
                    <th>Precio Total</th>
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
    </div>
    {!!Form::close()!!}
    <!--Modal Empleados-->
    <div class="modal fade bd-example-modal-lg" id="modalEmpleados" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h6 modal-title ion-paperclip" id="exampleModalLabel"> Empleados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered specialCollapse" id="myTableEmpleados"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Encargo</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Dni</th>
                    <th>Direccion</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($empleados as $index=>$empleado)
                    <tr class="fadeIn animated">
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$empleado->encargo}}</td>
                      <td>{{$empleado->nombres}}</td>
                      <td>{{$empleado->apellidos}}</td>
                      <td>{{$empleado->dni}}</td>
                      <td>{{$empleado->direccion}}</td>
                      <td>
                        <a href="javascript:mostrarEmpleado({{$empleado->id}},'{{$empleado->nombres}}', '{{$empleado->encargo}}');" class="btn btn-outline-primary btn-sm ion-android-done"></a>
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
    <!--Modal Clientes-->
    <div class="modal fade bd-example-modal-lg" id="modalClientes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h6 modal-title ion-paperclip" id="exampleModalLabel"> Clientes</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                <div class="i-checks">
                    <input id="check_panel_clientes" type="checkbox" value="" class="form-control-custom">
                    <label for="check_panel_clientes">Nuevo cliente ?</label>
                </div>
              </div>
            </div><br/>
              <div class="row" id="panelCliente" style="visibility: visibility; display: none;">
                <div class="col-md-12">
                  <div class="card miBorder fadeIn animated">
                    <div class="card-header d-flex align-items-center">
                        <h2 class="h1 display ion-paperclip fadeIn animated title"> Nuevo Cliente:</h2>
                    </div>
                    <div class="card-block">
                      <!--<p>Ingrese nuevo cliente</p>-->
                      <div class="form-group row">
                        <label class="col-sm-2 form-control-label" for="nombres"><strong>Nombres (*):</strong></label>
                        <div class="col-sm-10">
                          {!!form::text('nombres', null,['id'=>'nombres','class'=>'form-control','placeholder'=>'Ingrese nombres completos', 'autofocus'])!!}
                        </div>
                        <label class="col-sm-2 form-control-label" for="dni"><strong>Dni (*):</strong></label>
                        <div class="col-sm-4">
                          {!!form::text('dni', null,['id'=>'dni','class'=>'form-control','placeholder'=>'Ingrese Dni'])!!}
                        </div>
                        <label class="col-sm-2 form-control-label" for="direccion"><strong>Direccion:</strong></label>
                        <div class="col-sm-4">
                          {!!form::text('direccion', null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Ingrese Direccion'])!!}
                        </div>
                        <label class="col-sm-2 form-control-label" for="telefono"><strong>Telefono:</strong></label>
                        <div class="col-sm-4">
                          {!!form::text('telefono', null,['id'=>'telefono','class'=>'form-control','placeholder'=>'Ingrese Telefono'])!!}
                        </div>
                        <div class="col-sm-4">
                          <button id="btnGuardarCliente" class="btn btn-outline-primary btn-sm">Guardar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card miBorder fadeIn animated">
                    <div class="card-header d-flex align-items-center">
                        <h2 class="h1 display ion-paperclip fadeIn animated title"> Clientes:</h2>
                    </div>
                    <div class="card-block">
                      <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered specialCollapse" id="myTableClientes"><!--table-responsive-->
                        <thead class="thead-inverse">
                          <tr>
                            <th>#</th>
                            <th>Nombres</th>
                            <th>Dni</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody id="lista_clientes">
                          @foreach ($clientes as $index=>$cliente)
                            <tr class="fadeIn animated">
                              <th scope="row">{{$index+1}}</th>
                              <td>{{$cliente->nombres}}</td>
                              <td>{{$cliente->dni}}</td>
                              <td>{{$cliente->direccion}}</td>
                              <td>{{$cliente->telefono}}</td>
                              <td>
                                <a href="javascript:mostrarCliente({{$cliente->id}},'{{$cliente->nombres}}');" class="btn btn-outline-primary btn-sm ion-android-done"></a>
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
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cerrar</button>
            <!--<button type="button" class="btn btn-primary">Save changes</button>-->
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Errores-->
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
            <h5 id="exampleModalLabel" class="modal-title">Mensaje</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <h2>¡Se ha guardado correctamente una venta! :)</h2>
            <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="aceptar">Aceptar</button>
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
  <!-- JavaScript files-->
  <!--<script src="https://d19m59y37dris4.cloudfront.net/dashboard-premium/1-4-0/vendor/jquery/jquery.min.js"></script>
  <script src="https://d19m59y37dris4.cloudfront.net/dashboard-premium/1-4-0/js/charts-custom.js"></script>-->
  
  
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

  <!--Notificacion-->
  <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>
  <!--Charts-->
  <script src="{{asset('bootstrap4/js/charts/charts-custom.js')}}"></script>
  
  <script type="text/javascript">
    $(document).ready(function(){
      $('#myTableEmpleados').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          responsive: true
        }
      });
      $('#myTableClientes').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          responsive: true
        }
      });
      mostrarCodigoVenta();
      buscarDatosPorCodigo();

      /*var speedCanvas = document.getElementById("lineChartExample");
      
      speedCanvas = new Chart(speedCanvas,{
        type: 'line',
        data: {
                labels: ["Mesa","Silla","Perro","Pc","Lapicero","Enero"],
                datasets: 
                [
                  {
                    label: "Data One", data:[20,30,10,50,40,60], backgroundColor:"rgba(51, 179, 90, 0.38)"
                  }, 
                  {
                    label: "Data Dos", data:[40,70,20,30,80,10]
                  }
                ]
              }
      });*/

    });
    var modelo_id = 0;
    var tejido_id = 0;
    var material_id = 0;
    var publico_id = 0;
    var talla_id = 0;
    var tipo = 1;
    var codSombrero = "";
    var cliente_id = 0;
    //var utilidad = 0;
    var precio_compra = 0.00;
    var descuentoventa = {{$parametros->descuentoventa}};
    var descuentoextra = {{$parametros->descuentoextra}};
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
    /*$("#idProveedor").change(function(e){
      console.log(e);
      proveedor_id = e.target.value;
      $("#codigo").val("");
      limpiar();
      llenarCodigosSombreros();
      mostrarAjax();
    });*/
    $("#cantidad").keyup(function(e){
      console.log(e);
      calcularPrecioTotal();
    });
    $("#cantidad").click(function(e){
      console.log(e);
      calcularPrecioTotal();
    });
    $("#porcentaje_descuento").keyup(function(e){
      console.log(e);
      calcular_descuento();
      calcularPrecioTotal();
    });
    $("#descuento").keyup(function(e){
      console.log(e);
      calcular_porcentaje_descuento();
      calcularPrecioTotal();
    });
    $("#codigo").change(function(e){
      console.log(e);
      buscarDatosPorCodigo();
    });
    $("#codigo").keyup(function(e){
      console.log(e);
      buscarDatosPorCodigo();
    });

    function mostrarAjax(){
      //alert(modelo_id+" - "+tejido_id+" - "+material_id+" - "+publico_id+" - "+talla_id);
      if (modelo_id!=0 && tejido_id!=0 && material_id!=0 &&
          publico_id!=0 && talla_id!=0) {
            var bandera = false;
            $.get('/ajax-verdatos/'+modelo_id+'/'+tejido_id+'/'+material_id+'/'+publico_id+
            '/'+talla_id, function(data){
              //success
              $.each(data, function(index, cuentaObj){
                bandera = true;
                $("#codigo").val(cuentaObj.codigo);
                precio_compra = cuentaObj.precio;
                //$("#precio_compra").val(cuentaObj.precio);
                $("#precio_venta").val(cuentaObj.precio_lista);
                $("#stock_actual").val(cuentaObj.stock_actual);
                $("#cantidad").attr('max',parseInt(cuentaObj.stock_actual));
              });
              if(!bandera){
                Messenger().post({message:"¡ No existe el sombrero !.",type:"info",showCloseButton:!0});
                $("#codigo").val("");
                precio_compra = 0.00;
                //$("#precio_compra").val("");
                $("#precio_venta").val("");
                $("#stock_actual").val("");
              }
            });
      } else {
        $("#codigo").val("");
      }
    }

    /*function llenarCodigosSombreros(){
      if(proveedor_id!=0){
        $.get('/ajax-mostrarCodigoSombreroPorProveedor/'+proveedor_id, function(data){
          //success
            var codigos = "";
              $.each(data, function(index, sombrero){
                codigos = codigos+"<option value='"+sombrero.codigo+"'></option>";
                
              });
              $("#codigosSombrero").html(codigos);
        });
      }
    }*/

    $("#checkdescuentoextra").change(function(){
      var descuentototal = 0.00;
      if($("#checkdescuentoextra").is(":checked")){
        descuentototal = descuentoventa + descuentoextra;
        $("#mensajedescuentop").html("Máximo: "+descuentototal+" % |");
        if($("#precio_total").val()!=""){
          $("#mensajedescuento").html("Máximo: S/ "+(parseFloat($("#precio_venta").val())*(descuentototal/100.00)*parseInt($("#cantidad").val())).toFixed(2));
        }
        
      } else {
        descuentototal = descuentoventa;
        $("#mensajedescuentop").html("Máximo: "+descuentototal+" % |");
        var descuento = (parseFloat($("#precio_venta").val())*(descuentototal/100.00)*parseInt($("#cantidad").val())).toFixed(2);
        if($("#precio_total").val()!=""){
          $("#mensajedescuento").html("Máximo: S/ "+descuento);
        }
        //validar descuento porcentaje
        if($("#porcentaje_descuento").val()!=""){
          if(descuentototal <= parseFloat($("#porcentaje_descuento").val())){
            $("#porcentaje_descuento").val("");
          }
        }
        //validar descuento S/
        if($("#descuento").val()!=""){
          if(parseFloat($("#descuento").val()) >= parseFloat(descuento)){
            //alert("entro");
            $("#descuento").val("");
          }
        }
      }
    });

    function calcular_descuento() {
      var descuentototal = 0.00;
      if($("#checkdescuentoextra").is(":checked")){
        descuentototal = descuentoventa + descuentoextra;
      } else {
        descuentototal = descuentoventa;
      }
      if ($("#precio_venta").val()!="" && $("#porcentaje_descuento").val()!="" && $("#cantidad").val()!="") {
        if(parseFloat($("#porcentaje_descuento").val())<=descuentototal){
          var descuento = parseFloat($("#precio_venta").val())*parseFloat($("#cantidad").val())*(parseInt($("#porcentaje_descuento").val())/100.00);
          $("#descuento").val(descuento.toFixed(2)+"");
        } else {
          Messenger().post({message:"¡ Se ha excedido al "+descuentototal+" % de descuento !",type:"info",showCloseButton:!0});
          $("#porcentaje_descuento").val("0.00");
          $("#descuento").val("0");
        }
        
      } else {
        $("#descuento").val("0");
      }
    }

    function calcular_porcentaje_descuento() {
      var descuentototal = 0.00;
      if($("#checkdescuentoextra").is(":checked")){
        descuentototal = descuentoventa + descuentoextra;
      } else {
        descuentototal = descuentoventa;
      }
      if ($("#precio_venta").val()!="" && $("#descuento").val()!="" && $("#cantidad").val()!="") {
        var descuento = parseFloat($("#descuento").val())/(parseFloat($("#precio_venta").val())*parseFloat($("#cantidad").val()));
        if((descuento*100).toFixed(2) <= descuentototal){
          $("#porcentaje_descuento").val((descuento*100).toFixed(2)+"");
        } else {
          $("#porcentaje_descuento").val("0.00");
          $("#descuento").val("0");
        }
        
      } else {
        $("#porcentaje_descuento").val("0.00");
      }
    }

    function calcularPrecioTotal() {
      var descuentototal = 0.00;
      if($("#checkdescuentoextra").is(":checked")){
        descuentototal = descuentoventa + descuentoextra;
      } else {
        descuentototal = descuentoventa;
      }
      if($("#descuento").val()!="" && $("#porcentaje_descuento").val()!=""){
        if($("#precio_venta").val()!="" && $("#cantidad").val()!=""){
          $("#mensajedescuento").html("Máximo: S/ "+(parseFloat($("#precio_venta").val())*(descuentototal/100.00)*parseInt($("#cantidad").val())).toFixed(2));
          var precio_total = (parseFloat($("#precio_venta").val())*parseInt($("#cantidad").val()))-parseFloat($("#descuento").val());
          $("#precio_total").val(precio_total.toFixed(2));
          //utilidad = parseFloat($("#precio_total").val())-(precio_compra * parseInt($("#cantidad").val()));
          //utilidad = utilidad.toFixed(2);
        } else {
          $("#precio_total").val("");
          //utilidad = 0;
        }
      } else {
        //calculo precio total sin descuento
        var precio_total = (parseFloat($("#precio_venta").val())*parseInt($("#cantidad").val()));
        $("#precio_total").val(precio_total.toFixed(2));
        $("#mensajedescuento").html("Máximo: S/ "+(parseFloat($("#precio_venta").val())*(descuentototal/100.00)*parseInt($("#cantidad").val())).toFixed(2));
        //utilidad = parseFloat($("#precio_total").val())-(precio_compra * parseInt($("#cantidad").val()));
        //utilidad = utilidad.toFixed(2);
      }
    }

    function limpiar() {
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

      precio_compra = 0;
      //$("#precio_compra").val("");
      $("#precio_venta").val("");
      $("#stock_actual").val("");
      $("#cantidad").val("");
      $("#porcentaje_descuento").val("0");
      $("#descuento").val("0");
      $("#precio_total").val("");
      //$("#precio_sin_descuento").val("");
      //utilidad = 0;
      //$("#utilidad").val("");
      $("#descripcion").val("");
      $("#cantidad").removeAttr('max');
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

    function mostrarCodigoVenta() {
      $.get('/ajax-mostrarCOV/1', function(data){
        //success
        $.each(data, function(index, objeto){
          var d = new Date();
          var anio = (d.getFullYear())+"";
          var digitos = anio.substring(2,4);
          var n = parseInt(objeto.id)+1;
          var cod = "";
          if (n>0 && n<10) {
            cod = "OV-000"+n+"-"+digitos;
          } else if(n>=10 && n<100){
            cod = "OV-00"+n+"-"+digitos;
          } else if(n>=100 && n<1000){
            cod = "OV-0"+n+"-"+digitos;
          } else if(n>=1000 && n<10000){
            cod = "OV-"+n+"-"+digitos;
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

                  $('#idModelo option[value="'+modelo_id+'"]').attr('selected','selected');
                  $('#idTejido option[value="'+tejido_id+'"]').attr('selected','selected');
                  $('#idMaterial option[value="'+material_id+'"]').attr('selected','selected');
                  $('#idPublicoDirigido option[value="'+publico_id+'"]').attr('selected','selected');
                  $('#idTalla option[value="'+talla_id+'"]').attr('selected','selected');
                  $("#precio_venta").val(sombrero.precio_lista);
                  precio_compra = sombrero.precio_lista;
                  //$("#precio_compra").val(sombrero.precio);
                  $("#stock_actual").val(sombrero.stock_actual);
                  $("#precio").val("");
                  $("#cantidad").attr('max',parseInt(sombrero.stock_actual));
            }
          });
        });
      } else {
        limpiar();
      }
    }

    $("#guardar").click(function(){
      var mensaje = "";
      /*if ($("#idProveedor").val()==0) {
        mensaje = mensaje + "* Debe seleccionar un proveedor.</br>";
      }*/
      if ($("#codigo").val()=="") {
        mensaje = mensaje + "* El codigo no debe estar vacío.</br>";
      } else {
        if ($("#codigo").val().length<13 || $("#codigo").val().length>14) {
          mensaje = mensaje + "* El codigo no tiene los 13 ó 14 caracteres.<br/>";
        }
      }
      if (parseInt($("#cantidad").val())>parseInt($("#stock_actual").val())) {
        mensaje = mensaje + "* La cantidad excede al stock actual del articulo.<br/>";
      }

      if ($("#cantidad").val()=="") {
        mensaje = mensaje + "* Debe ingresar la cantidad.</br>";
      }
      if ($("#empleado").html()==""){
        mensaje = mensaje + "* Debe seleccionar el vendedor.<br/>";
      }
      if($("#cliente").html()==""){
        mensaje = mensaje + "* Debe seleccionar el cliente.";
      }
      if (mensaje=="") {
          
          var tabla = "";
          var n = 1;
          var porcentaje_descuento = 0.0;
          var descuento = 0.0;
          if ($("#porcentaje_descuento").val()!="") {
            porcentaje_descuento = parseFloat($("#porcentaje_descuento").val());
          }
          if ($("#descuento").val()!="") {
            descuento = parseFloat($("#descuento").val());
          }
          
          var descripcion = $("#descripcion").val();
          if (descripcion=="") {
            descripcion = "0";
          }
          
          if(tipo==2){
            //alert("primero la venta detalle 2");
            
            //solo se guardar todas las ordenes de compras detalle
            $.get('/ajax-guardarventa/2/'+$("#codigo").val()+'/'
            +$("#cantidad").val()+'/'+$("#precio_venta").val()+'/'+porcentaje_descuento+'/'+
            descuento+'/'+$("#precio_total").val()+'/'+$("#usuario").html()+'/'+
            empleado_id+'/'+cliente_id+'/'+ descripcion, function(data){
              //success
              $.each(data, function(index, venta){
                //alert('(2) '+orden.numero_orden);
                //alert("entra "+orden.codigo);
                //$("#guardar").prop('disabled', 'disabled');
                //$("#agregar").removeAttr("disabled");
                //alert(orden.codigo);
                tabla = tabla+"<tr class='fadeIn animated'><td>"+n+"</td><td>"+venta.codigo+"</td>"+
                "<td><img src='/images/sombreros/"+venta.photo+
                "' class='img-fluid pull-xs-left rounded' alt='...' width='28'></td>"+
                "<td>"+venta.cantidad+"</td><td>"+venta.precio_venta+"</td><td>"+venta.porcentaje_descuento+
                "</td><td>"+venta.descuento+"</td><td>"+venta.sub_total+"</td><td>"+venta.descripcion+"</td></tr>";
                n++;
              });
              //alert(tabla);
              $("#lista_datos").html(tabla);
              tabla = "";
              $("#myModal2").modal("show");
              $("#btnempleado").attr('disabled','');
              //$("#checkempleado").attr('disabled','');
              $("#btncliente").attr('disabled','');  
              $("#checkcliente").attr('disabled','');              
            });
          } else {
            
            //se guardan el primer en orden compra y orden de compra detalle;
            $.get('/ajax-guardarventa/1/'+$("#codigo").val()+'/'
            +$("#cantidad").val()+'/'+$("#precio_venta").val()+'/'+porcentaje_descuento+'/'+
            descuento+'/'+$("#precio_total").val()+'/'+$("#usuario").html()+'/'+
            empleado_id+'/'+cliente_id+'/'+descripcion, function(data){
              //success
              $.each(data, function(index, venta){
                //alert('(1) '+orden.numero_orden);
                //$("#guardar").prop('disabled', 'disabled');
                //$("#agregar").removeAttr("disabled");
                tabla = tabla+"<tr class='fadeIn animated'><td>"+n+"</td><td>"+venta.codigo+"</td>"+
                "<td><img src='/images/sombreros/"+venta.photo+
                "' class='img-fluid pull-xs-left rounded' alt='...' width='28'></td>"+
                "<td>"+venta.cantidad+"</td><td>"+venta.precio_venta+"</td><td>"+venta.porcentaje_descuento+
                "</td><td>"+venta.descuento+"</td><td>"+venta.sub_total+"</td><td>"+venta.descripcion+"</td></tr>";
                n++;
                tipo = 2;
              });
              //alert(tabla);
              $("#lista_datos").html(tabla);
              tabla = "";
              $("#myModal2").modal("show");
              $("#btnempleado").attr('disabled','');
              //$("#checkempleado").attr('disabled','');
              $("#btncliente").attr('disabled','');  
              //$("#checkcliente").attr('disabled','');
            });
          }

      } else {
        $("#errores").html(mensaje);
        $("#myModal").modal("show");
      }
    });

    $("#aceptar").click(function(){
      //$('#myModal').modal("show");//en este modal hay opciones (si y no)
      mostrarCodigoVenta();
      limpiar();
      $("#codigo").val("");
    });

    /*$("#si").click(function(){

    });*/

    /*$("#agregar").click(function(){
      $("#guardar").removeAttr("disabled");
      $("#agregar").prop('disabled', 'disabled');
    });*/

    //seleccionar el empleado
    $("#btnempleado").click(function(e){

      $('#modalEmpleados').modal('show');
    });
    //seleccionn el cliente
    $("#btncliente").click(function(e){
      $('#modalClientes').modal('show');
    });
    function mostrarEmpleado(idEmpleado, nombres, encargo){
      empleado_id = idEmpleado;
      $("#empleado").html(nombres);
      //$("#encargo").val(encargo);
      $('#modalEmpleados').modal('hide');
    }

    function mostrarCliente(idCliente, nombres){
      cliente_id = idCliente;
      $("#cliente").html(nombres);
      $('#modalClientes').modal('hide');
    }

    function mostrarClienteGuardar(idCliente){
      $.get('/ajax-mostrarCliente/'+idCliente, function(data){
          $.each(data, function(index, datos){
            $("#cliente").html(datos.nombres);
          });
          cliente_id = idCliente;
          $('#modalClientes').modal('hide');
      });
    }

    //panel clientes
    $("#check_panel_clientes").click(function(){
      if($(this).is(':checked')){
        $("#panelCliente").animate({
          opacity: 1,
          left: "+=50",
          height: "toggle",
          visibility: "visible"
        }, 800, function() {
          // Animation complete.
        });
      } else {
        $("#panelCliente").animate({
          opacity: 0.25,
          left: "+=50",
          height: "toggle"
        }, 800, function() {
          // Animation complete.
        });
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

    /**guardar cliente */
    $("#btnGuardarCliente").click(function(){
      var mensaje = "";
      if ($("#nombres").val()=="") {
        mensaje = mensaje + "* El nombre no debe estar vacío.</br>";
      }
      if($("#dni").val()==""){
        mensaje = mensaje + "* El dni no debe estar vacío.</br>";        
      }
      if(mensaje==""){
        var direccion_cliente = "0";
        var telefono_cliente = "0";
        if($("#direccion").val()!=""){
          direccion_cliente = $("#direccion").val();
        }
        if($("#telefono").val()!=""){
          telefono_cliente = $("#telefono").val();   
        }
        
        var tabla = "";
        var n = 1;
        var bandera = false;
        $.get('/ajax-guardarCliente/'+$("#nombres").val()+"/"+$("#dni").val()+
          "/"+direccion_cliente+"/"+telefono_cliente, function(data){
          $.each(data, function(index, cliente){
            tabla = tabla+"<tr class='fadeIn animated'><td>"+n+"</td><td>"+cliente.nombres+"</td><td>"+cliente.dni+"</td><td>"+cliente.direccion+"</td><td>"+
                  cliente.telefono+"</td><td>"+"<a href='javascript:mostrarClienteGuardar("+cliente.id+")' class='btn btn-outline-primary btn-sm ion-android-done' title='mostrar'></a> "+"</td></tr>";
            n++;

            bandera = true;
          });
          $("#lista_clientes").html(tabla);
          if(bandera){
            Messenger().post({message:"¡ Cliente guardado !.",type:"info",showCloseButton:!0});          
          }
          tabla = "";
          n = 0;
        });
      } else {
        Messenger().post({message:mensaje,type:"error",showCloseButton:!0});                               
      }
      
    });

    /**guardarCliente */
  </script>
@endsection
