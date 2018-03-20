@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">-->
  <link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">
  
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Stock Actual /</li>
      </ul>
    </div>
  </div>
  <section class="forms"><br/>
    <div class="container-fluid">
      <!--<header>
        <h1 class="h5 fadeIn animated text-center ion-clipboard"> Lista Sombreros</h1>
      </header>-->
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
              {!!Form::open(['action'=>'Compras\OrdenCompraController@store','method'=>'POST'])!!}
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
              </div>
              <div class="col-sm-12">
                <hr/>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 form-control-label" for="codigo"><strong>Codigo:</strong></label>
                <div class="col-sm-3">
                  {!!form::text('codigo', null,['id'=>'codigo','name'=>'codigo','class'=>'form-control','autofocus'])!!}
                  <span class="help-block-none">El código son de 13 caracteres.</span>
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
      <div class="row" id='galeria'>
            @foreach ($imagenes as $key => $imagen)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card"><a href="/images/sombreros/{{$imagen->photo}}" data-lightbox="gallery" data-title="[{{$key+1}}] Sombrero: {{$imagen->codigo}}" title="{{$imagen->codigo}}"><img src="/images/sombreros/{{$imagen->photo}}" alt="Image {{$imagen->codigo}}" class="img-fluid"></a>
                    <div class="card-body">
                        <h6 class="card-title mb-1">{{$imagen->codigo}}</h6>
                        <p class="card-text text-xsmall text-muted"><strong>Stock Actual: {{$imagen->stock_actual}}</strong> Modelo: {{$imagen->modelo}}, material: {{$imagen->material}},
                            calidad de tejido: {{$imagen->tejido}}</p>
                    </div>
                    </div>
                </div>
            @endforeach
      </div>
    </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <!--Notificacion-->
  <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>
  <script>
      $(document).ready(function(e){
            Messenger().post({message:"Consulta: stock del articulo.",type:"info",showCloseButton:!0});
            $('#myTable').DataTable({
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                responsive: true
                }
            });
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
            var bandera = false;
            var miGaleria = "";
            var n=1;
            $.get('/ajax-mostrarGaleria/'+modelo_id+'/'+tejido_id+'/'+material_id+'/'+publico_id+
                '/'+talla_id, function(data){
                //success
                
                $.each(data, function(index, cuentaObj){
                    bandera = true;
                    miGaleria = miGaleria+"<div class='col-6 col-md-4 col-lg-3 col-xl-2'><div class='card'>"+
                    "<a href='/images/sombreros/"+cuentaObj.photo+"' data-lightbox='gallery' data-title='["+n+"] Sombrero:"+cuentaObj.codigo+"' title='"+cuentaObj.codigo+"'>"+
                    "<img src='/images/sombreros/"+cuentaObj.photo+"' class='img-fluid' alt='Image"+cuentaObj.codigo+"'>"+"</a> "+
                    "<div class='card-body'><h6 class='card-title mb-1'>"+cuentaObj.codigo+
                    "</h6><p class='card-text text-xsmall text-muted'><strong>Stock Actual: "+cuentaObj.stock_actual+"</strong> Modelo: "+cuentaObj.modelo+
                    "Material:"+cuentaObj.material+" calidad de tejido: "+cuentaObj.tejido+"</p></div>"+
                    "</div></div>";
                    if(modelo_id!=0 && tejido_id!=0 && material_id!=0 && publico_id!=0 && talla_id!=0){
                        $("#codigo").val(cuentaObj.codigo);
                    } else {
                        $("#codigo").val("");
                    }
                    n++;
                });
                $("#galeria").html(miGaleria);
                if(!bandera){
                    Messenger().post({message:"¡ No existe el sombrero !.",type:"info",showCloseButton:!0});
                    $("#codigo").val("");
                }
            });
        }
      /*Para ocultar o desocultar panel sombrero*/
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

  // check (Panel sombrero)
  
}
  </script>
  @endsection