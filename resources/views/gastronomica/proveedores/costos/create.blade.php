@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/proveedores/costos/costos')}}">Costos</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
      </ul>
    </div>
  </div></br>
  <div class="container-fluid">
    @include('partials.messages')
  </div>
  <section class="forms">
    <div class="container-fluid">
      {!!Form::open(['action'=>'Proveedores\PreciosController@store','method'=>'POST'])!!}
      <!--Panel superior-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip fadeIn animated title"> Opciones:</h2>
            </div>
            <div class="card-block">
              <div class="form">
                <div class="form-group row">
                  <label class="form-control-label col-sm-2 col-md-2" for="idTipoMovimiento"><strong>Proveedor (*):</strong></label>
                  <div class="col-sm-4 col-md-3">
                    {!!Form::select('idProveedor',$proveedor, null,['id'=>'idProveedor','name'=>'idProveedor','class'=>'form-control','autofocus'])!!}
                  </div>
                  <label class="form-control-label col-sm-3 col-md-2"><strong>Tipo Busqueda:</strong></label>
                  <div class="i-checks col-sm-2 col-md-1">
                    <input id="radioCodigo" type="radio" checked="" value="option1" name="a" class="opcion form-control-custom radio-custom">
                    <label for="radioCodigo">Código</label>
                  </div>
                  <div class="i-checks col-sm-2 col-md-1">
                    <input id="radioModelo" type="radio" value="option2" name="a" class="opcion form-control-custom radio-custom">
                    <label for="radioModelo">Modelo</label>
                  </div>
                  <div class="i-checks col-sm-2 col-md-1">
                    <input id="radioFoto" type="radio" value="option3" name="a" class="opcion form-control-custom radio-custom">
                    <label for="radioFoto">Foto</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Panel del centro-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip fadeIn animated title"> Panel Sombrero:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos del nuevo modelo de sombrero.</p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="codigo"><strong>Codigo (*):</strong></label>
                <div class="col-sm-4">
                  {!!form::text('codigo', null,['id'=>'codigo','name'=>'codigo','class'=>'form-control'])!!}
                  <span class="help-block-none"><label>Nota: El código son de 13 caracteres.</label></span>
                </div>
                <label for="precio_compra" class="form-control-label col-sm-2"><strong>Costo compra * (S/):</strong></label>
                <div class="col-sm-4">
                  {!!form::text('precio_compra', null,['id'=>'precio_compra','name'=>'precio_compra','class'=>'form-control'])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="form-control-label col-sm-2"><strong>Precio venta (S/):</strong></label>
                <div class="col-sm-4">
                  {!!form::text('precio_venta', null,['id'=>'precio_venta','name'=>'precio_venta','class'=>'form-control', 'disabled'])!!}                  
                </div>
                <label class="col-sm-2 form-control-label" for="idModelo"><strong>Modelo:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idModelo',$modelo, null,['id'=>'idModelo','name'=>'idModelo','class'=>'form-control','disabled'=>''])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="idTejido"><strong>Tejido:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idTejido',$tejido, null,['id'=>'idTejido','name'=>'idTejido','class'=>'form-control','disabled'=>''])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="idMaterial"><strong>Material:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idMaterial',$material, null,['id'=>'idMaterial','name'=>'idMaterial','class'=>'form-control','disabled'=>''])!!}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="idPublicoDirigido"><strong>Publico Dirigido:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idPublicoDirigido',$publicodirigido, null,['id'=>'idPublicoDirigido','name'=>'idPublicoDirigido','class'=>'form-control','disabled'=>''])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="idTalla"><strong>Talla:</strong></label>
                <div class="col-sm-4">
                  {!!Form::select('idTalla',$talla, null,['id'=>'idTalla','name'=>'idTalla','class'=>'form-control','disabled'=>''])!!}
                </div>
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/proveedores/precios/precios')}}" class="btn btn-outline-primary fadeIn animated btn-sm ion-android-cancel"> Cancelar</a>
                {!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Guardar</span>','class'=>'btn
                  btn-outline-success btn-sm'])!!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {!!Form::close()!!}
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
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      calculoPrecioventa();
      buscarDatosPorCodigo();
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
            $.get('/ajax-pago/'+modelo_id+'/'+tejido_id+'/'+material_id+'/'+publico_id+'/'+talla_id, function(data){
              //success
              $.each(data, function(index, cuentaObj){
                $("#codigo").val(cuentaObj.codigo);
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
        $.get('/ajax-som/'+codSombrero, function(data){
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
                  $("#precio").val("");
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

    /**Calculo del precio de venta */
    $("#precio_compra").keyup(function(e){
      calculoPrecioventa();
      
    });
    function calculoPrecioventa(){
      if($("#precio_compra").val()!=""){
        var precio_con_igv = parseFloat($("#precio_compra").val())*({{$atributo->igv}}/100.00);
        var precio_con_margenganancia = parseFloat($("#precio_compra").val())*({{$atributo->margenganancia}}/100.00);
        var precio_con_servicios = parseFloat($("#precio_compra").val())*({{$atributo->gastosservicios}}/100.00);
        var precio_venta = parseFloat($("#precio_compra").val())+precio_con_igv+precio_con_margenganancia+precio_con_servicios;
        $("#precio_venta").val(precio_venta);
      } else {
        $("#precio_venta").val("S/ ##.##");
      }
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
