@extends('layouts.master')
@section('title','Sombreros')
@section('content')

<!--<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">-->
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

    <div class="breadcrumb-holder fadeIn animated">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Utilidad articulo /</li>
          </ul>
        </div>
    </div>
    <br/>
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
        </div><br/>
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
                    <div class="offset-md-5 col-md-2">
                        <button type="button" name="buscar" id="buscar" class="btn btn-primary ion-android-search rounded" title="buscar"></button>
                        <button type="button" name="mostrarTodo" id="mostrarTodo" class="btn btn-primary ion-clipboard" title="mostrar todo"></button>
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <hr/>
                </div>
                <div class="form-group row">
                    <label class="col-sm-1 form-control-label" for="codigo"><strong>Codigo:</strong></label>
                    <div class="col-sm-3">
                    {!!form::text('codigo', null,['id'=>'codigo','name'=>'codigo','class'=>'form-control',
                    'maxlength'=>'14','autofocus', 'placeholder'=>'Aqui el codigo del articulo'])!!}
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
        <!--Tabla-->
        <div class="row">
            <div class="col-lg-12">
            <div class="card miBorder fadeIn animated">
                <div class="card-header d-flex align-items-center">
                <h5 class="h5 display ion-paperclip fadeIn animated"> Articulos:</h5>
                </div>
                <div class="card-block miTabla">
                <a href="{{action('Reportes\ReporteController@reporteGeneralUtilidadesSombreros')}}"
                id="reporte" class="btn btn-primary btn-sm margenInf ion-document-text" title="reporte" target="_blank"> Reporte</a>
                <a href="javascript:abrirGrafica()" class="btn btn-primary btn-sm margenInf">Grafica</a><br/>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered" id="myTable"><!--table-responsive-->
                      <thead class="thead-inverse">
                      <tr>
                          <th class="text-center">#</th>
                          <th>Articulo</th>
                          <th>Imagen</th>
                          <th>Modelo</th>
                          <th>Tejido</th>
                          <th>Material</th>
                          <th>Publico</th>
                          <th>Talla</th>
                          <!--<th>Precio Compra</th>-->
                          <th>Precio Venta</th>
                          <th>Utilidad</th>
                      </tr>
                      </thead>
                      <tbody id="lista_datos">
                          @foreach ($utilidades as $index=>$utilidad)
                          <tr class="fadeIn animated">
                              <th scope="row" class="text-center">{{$index+1}}</th>
                              <th>{{$utilidad->codigo}}</th>
                              <td>
                                  <img src="/images/sombreros/{{$utilidad->photo}}" class="img-fluid pull-xs-left rounded link_foto" alt="..." width="28">
                              </td>
                              <td>{{$utilidad->modelo}}</td>
                              <td>{{$utilidad->tejido}}</td>
                              <td>{{$utilidad->material}}</td>
                              <td>{{$utilidad->publico}}</td>
                              <td>{{$utilidad->talla}}</td>
                              <!--<td>S/ {{$utilidad->precio}}</td>-->
                              <td>S/ {{$utilidad->precio_venta}}</td>
                              <td>S/ {{$utilidad->utilidad}}</td>
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
        <!---->
          <!---->
    </section>
    <!--modal para mostrar la foto del sombrero mas grande-->
  <div id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="h5 modal-title ion-paperclip"> Sombrero</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <img src="/images/sombreros/" class="rounded mx-auto d-block  img-fluid" id="mostrar_foto" alt="..." width="450px" height="453px">
            <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="aceptar">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!--Modal Grafica-->
  <div class="modal fade bd-example-modal-lg" id="modalGrafica" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="h5 modal-title ion-paperclip" id="exampleModalLabel"> Grafica</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <canvas id="bar-chart" width="800" height="450"></canvas>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cerrar</button>
          <!--<button type="button" class="btn btn-primary">Save changes</button>-->
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
  <!---->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

    <!--Notificacion-->
    <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
    <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
    <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>

    <script>
        /*pa la fpto del sombrero mas grande*/
        $(".link_foto").css('cursor', 'pointer');
                $(".link_foto").click(function(e){
                  $("#mostrar_foto").attr("src",$(this).attr("src"));
                  $("#modalFoto").modal("show");
                });

        function abrirGrafica(){
            var titulos = new Array();
            var datos = new Array();
              
              $.get('/ajax-mostrarTodoUtilidadSombreros/', function(data){
                //success
                $.each(data, function(index, sombrero){
                    titulos.push(sombrero.codigo);
                    datos.push(sombrero.utilidad);
                });
                
                var speedCanvas = document.getElementById("bar-chart");
                speedCanvas = new Chart(speedCanvas, {
                    type: 'bar',
                    data: {
                    labels: titulos,
                    datasets: [
                        {
                        label: "Population (millions)",
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: datos
                        }
                    ]
                    },
                    options: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Predicted world population (millions) in 2050'
                    }
                    }
                });
                $("#modalGrafica").modal("show");

              });
            
            
        }
    

    $(document).ready(function(e){
        Messenger().post({message:"Reporte: Utilidades de los articulos.",type:"info",showCloseButton:!0});
        $('#myTable').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            responsive: true
          },
          scrollY:        '70vh',
          //scrollX:        true,
          scrollCollapse: true,
          paging:         true,
          fixedColumns:   {
            heightMatch: 'none'
          },
          fixedHeader: {
            header: true
          },
          sScrollX: true,
          sScrollXInner: "100%",
        });
    });
    
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
                limpiar();
                mostrarTodo();
            }
        });

        /*Para saber el codigo de sombrero*/
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
        //
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

        /*busqueda por codigo*/
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

          /*Boton buscar*/
          $("#buscar").click(function(e){
            var mensaje = "";
            if ($("#check_panel_sombrero").is(':checked')) {
              if ($("#codigo").val()=="") {
                mensaje = mensaje + "* El codigo no debe estar vacío.";
              } else {
                if ($("#codigo").val().length!=13) {
                  mensaje = mensaje + "</br>* El codigo no tiene los 13 caracteres.";
                }
              }
            }
            if (mensaje=="") {
              var tabla = "";
              var n = 1;
              var codigoSombrero = $("#codigo").val();
              
              $.get('/ajax-reporteUtilidadSombrerosCodigo/'+codigoSombrero, function(data){
                $('#myTable').DataTable().destroy();
                //success
                $.each(data, function(index, sombrero){
                  tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+sombrero.codigo+"</th><td>"+
                "<img src='/images/sombreros/"+sombrero.photo+"' class='img-fluid pull-xs-left rounded link_foto' alt='..' width='28'/></td><td>"+
                sombrero.modelo+"</td><td>"+sombrero.tejido+"</td><td>"+sombrero.material+"</td><td>"+
                sombrero.publico+"</td><td>"+sombrero.talla+"</td><td>"+sombrero.precio_venta+"</td><td>"+
                sombrero.utilidad+"</td></tr>";
                n++;
                $("#reporte").attr('href',"{{URL::to('reporteUtilidadSombrerosPorCodigo/')}}/"+codigoSombrero);
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
            } else {
                Messenger().post({message: mensaje,type:"error",showCloseButton:!0});
            }
          
          });
        
          /*Boton Mostrar Todo*/
        $("#mostrarTodo").click(function(e){
            mostrarTodo();
        });
        function mostrarTodo(){
            var tabla = "";
              var n = 1;
              var codigoSombrero = $("#codigo").val();
              
              $.get('/ajax-mostrarTodoUtilidadSombreros/', function(data){
                $('#myTable').DataTable().destroy();
                //success
                $.each(data, function(index, sombrero){
                  tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><th>"+sombrero.codigo+"</th><td>"+
                "<img src='/images/sombreros/"+sombrero.photo+"' class='img-fluid pull-xs-left rounded link_foto' alt='..' width='28'/></td><td>"+
                sombrero.modelo+"</td><td>"+sombrero.tejido+"</td><td>"+sombrero.material+"</td><td>"+
                sombrero.publico+"</td><td>"+sombrero.talla+"</td><td>"+sombrero.precio_venta+"</td><td>"+
                sombrero.utilidad+"</td></tr>";
                n++;
                $("#reporte").attr('href',"{{URL::to('gastronomica/sombreros/reporte_utilidad_sombreros')}}/");
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
                    "<div><input id='radio"+n+"' onClick='guardarCodigoSombrero("+cuentaObj.id+");' type='radio' value='"+cuentaObj.codigo+"' name='b' class='opcion form-control-custom radio-custom'>"+
                    "<label for='radio"+n+"'>"+cuentaObj.codigo+"</label></div>"+"</div></div>";

                    //$("#codigo").val(cuentaObj.codigo);  class='card-body'
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