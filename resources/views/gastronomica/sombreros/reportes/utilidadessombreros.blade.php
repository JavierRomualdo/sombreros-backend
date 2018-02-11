@extends('layouts.master')
@section('title','Sombreros')
@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Utilidad Sombreros</li>
          </ul>
        </div>
    </div>
    <br/>
    <div class="container-fluid">
        @include('partials.messages')
    </div>
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
         <!--Panel superior-->
        <div class="row" id="panelSombrero" style="visibility: hidden; display: none;">
            <div class="col-lg-12">
            <div class="card miBorder fadeIn animated">
                <div class="card-header d-flex align-items-center">
                    <h2 class="h1 display ion-paperclip"> Panel Sombrero:</h2>
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
                        <button type="button" name="buscar" id="buscar" class="btn btn-outline-primary ion-android-search rounded" title="buscar"></button>
                        <button type="button" name="mostrarTodo" id="mostrarTodo" class="btn btn-outline-primary ion-clipboard" title="mostrar todo"></button>
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
        <!--Tabla-->
        <div class="row">
            <div class="col-lg-12">
            <div class="card miBorder fadeIn animated">
                <div class="card-header d-flex align-items-center">
                <h2 class="h1 display ion-paperclip"> Tabla Utilidad Sombreros:</h2>
                </div>
                <div class="card-block miTabla">
                <a href="{{action('Reportes\ReporteController@reporteGeneralUtilidadesSombreros')}}"
                id="reporte" class="btn btn-outline-primary margenInf ion-document-text" title="reporte" target="_blank"> Reporte</a><br/>
                <table class="table table-striped table-hover table-bordered"><!--table-responsive-->
                    <thead class="thead-inverse">
                    <tr>
                        <th>#</th>
                        <th>Articulo</th>
                        <th>Imagen</th>
                        <th>Modelo</th>
                        <th>Tejido</th>
                        <th>Material</th>
                        <th>Publico</th>
                        <th>Talla</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Utilidad</th>
                    </tr>
                    </thead>
                    <tbody id="lista_datos">
                        @foreach ($utilidades as $index=>$utilidad)
                        <tr>
                            <th scope="row">{{$index+1}}</th>
                            <td>{{$utilidad->codigo}}</td>
                            <td>
                                <a href="">
                                    <img src="/images/sombreros/{{$utilidad->photo}}" class="img-fluid pull-xs-left rounded" alt="..." width="28">
                                </a>
                            </td>
                            <td>{{$utilidad->modelo}}</td>
                            <td>{{$utilidad->tejido}}</td>
                            <td>{{$utilidad->material}}</td>
                            <td>{{$utilidad->publico}}</td>
                            <td>{{$utilidad->talla}}</td>
                            <td>{{$utilidad->precio}}</td>
                            <td>{{$utilidad->precio_venta}}</td>
                            <td>{{$utilidad->utilidad}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                </div>
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
    </section>
    <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
    <script>
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
                //success
                $.each(data, function(index, sombrero){
                  tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><td>"+sombrero.codigo+"</td><td>"+
                "<img src='/images/sombreros/"+sombrero.photo+"' class='img-fluid pull-xs-left rounded' alt='..' width='28'/></td><td>"+
                sombrero.modelo+"</td><td>"+sombrero.tejido+"</td><td>"+sombrero.material+"</td><td>"+
                sombrero.publico+"</td><td>"+sombrero.talla+"</td><td>"+sombrero.precio+"</td><td>"+sombrero.precio_venta+"</td><td>"+
                sombrero.utilidad+"</td></tr>";
                n++;
                $("#reporte").attr('href',"{{URL::to('reporteUtilidadSombrerosPorCodigo/')}}/"+codigoSombrero);
                });
                $("#lista_datos").html(tabla);
                tabla = "";
              });
            } else {
              $("#errores").html(mensaje);
              $("#myModal").modal("show");
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
                //success
                $.each(data, function(index, sombrero){
                  tabla = tabla + "<tr class='fadeIn animated'><th>"+n+"</th><td>"+sombrero.codigo+"</td><td>"+
                "<img src='/images/sombreros/"+sombrero.photo+"' class='img-fluid pull-xs-left rounded' alt='..' width='28'/></td><td>"+
                sombrero.modelo+"</td><td>"+sombrero.tejido+"</td><td>"+sombrero.material+"</td><td>"+
                sombrero.publico+"</td><td>"+sombrero.talla+"</td><td>"+sombrero.precio+"</td><td>"+sombrero.precio_venta+"</td><td>"+
                sombrero.utilidad+"</td></tr>";
                n++;
                $("#reporte").attr('href',"{{URL::to('gastronomica/sombreros/reporte_utilidad_sombreros')}}/");
                });
                $("#lista_datos").html(tabla);
                tabla = "";
            });
        }
    </script>
@endsection