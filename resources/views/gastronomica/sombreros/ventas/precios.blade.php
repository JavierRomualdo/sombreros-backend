@extends('layouts.master')
@section('title','Ventas')
@section('content')

<!--<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">-->
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">
<style type="text/css"> #divredondo, #estado_orden { height:20px; width:20px; border-radius:10px; } </style>
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Precios</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2 fadeIn animated text-center ion-clipboard"> Precios</h1>
      </header>
      <a href="{{action('Reportes\ReporteController@reportePrecios')}}" target="_blank" 
          class="btn btn-outline-primary margenInf ion-document-text fadeIn animated btn-sm"> Reporte</a>
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h1 display ion-paperclip fadeIn animated title"> Historial:</h2>
            </div>
            <div class="card-block miTabla">
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered" id="myTable"><!--table-responsive-->

                      <thead class="thead-inverse">
                        <tr>
                          <th class="text-center">#</th>
                          <th>Articulo</th>
                          <th>Foto</th>
                          <th>Stock Actual</th>
                          <th>Precio Sistema</th>
                          <th>Precio Lista</th>
                          <th>Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($precios as $index=>$precio)
                        <tr class="fadeIn animated">
                          <th scope="row" class="text-center">{{$index+1}}</th>
                          <th>{{$precio->codigo}}</th>
                          <th>
                            <img src="/images/sombreros/{{$precio->photo}}" data-toggle="modal" class="link_foto img-fluid pull-xs-left rounded" alt="..." width="28">
                          </th>
                          <td>{{$precio->stock_actual}}</td>
                          <td>S/ {{$precio->precio_venta}}</td>
                          <td>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <label id="lbl{{$precio->id}}" class="form-control text-center">{{$precio->precio_lista}}</label>
                                        @if($precio->precio_venta == 0.00)
                                            <button type="button" disabled class="btn btn-primary btn-sm" title="No hay precio venta"
                                            onclick="cambiarPrecioLista({{$precio->id}},{{$precio->precio_venta}},'{{$precio->codigo}}')">
                                            <i class="fa fa-edit"></i></button>
                                        @else
                                            <button type="button" class="btn btn-primary btn-sm" 
                                            onclick="cambiarPrecioLista({{$precio->id}},{{$precio->precio_venta}},'{{$precio->codigo}}')">
                                            <i class="fa fa-edit"></i></button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                          </td>
                          <td class="text-center">
                            @if(($precio->precio_venta - ($precio->precio_venta * ($parametros->preciominimo/100.00)))<=$precio->precio_lista && 
                                $precio->precio_lista<=($precio->precio_venta + ($precio->precio_venta * ($parametros->preciomaximo / 100.00))))
                                <label style='background: green;' id='divredondo' title='precio conforme'></label>
                            @else
                                <label style='background: red;' id='divredondo' title='precio no conforme'></label>
                            @endif
                            
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
          </div>
        </div>
      </div>
      <!--<div class="container">
        <div class="paginacion">
          { !!$ventas->links()!!}
        </div>
      </div>-->
    </div>
  </div>
  </section>
  <!--Modal Imagenes de sombreros-->
  <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Sombrero</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <img src="/images/sombreros/" class="rounded mx-auto d-block  img-fluid" id="mostrar_foto" alt="..." width="450px" height="453px">
          <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="aceptar">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!--Modal editar costos-->
  <div id="modalPrecios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Editar Precio</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <p id="mensaje"></p>
          <div class="form-group row">
            <label class="form-control-label col-md-4"><strong>Ingrese Precio:</strong></label>
            <div class="col-md-8">
              <input type="text" class="form-control" id="precio"/>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="guardar">Guardar</button>          
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!---->
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <!--Notificacion-->
  <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>
  <script>
    var sombrero_id = 0;
    var margenminimo = {{$parametros->preciominimo}};
    var margenmaximo = {{$parametros->preciomaximo}};
    var preciominimo = 0;
    var preciomaximo = 0;
    $(document).ready(function(){
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

    $("#precio").keyup(function(e){
        console.log(e);
        verificarMargenPrecio();
    });

    $(".link_foto").css('cursor', 'pointer');
    $(".link_foto").click(function(e){
      $("#mostrar_foto").attr("src",$(this).attr("src"));
      $("#myModal").modal("show");
    });

    function verificarMargenPrecio(){
        var precio = parseFloat($("#precio").val());
        
        //alert(preciomaximo);
        if(preciominimo<=precio && precio<=preciomaximo){
            $("#guardar").removeAttr("disabled");
        } else {
            $("#guardar").prop('disabled', 'disabled');
        }
    }
    /**Mostrando el modal precio para editar*/
  function cambiarPrecioLista(idSombrero, precioventa, codigoSombrero){
    sombrero_id = idSombrero;
    preciominimo = precioventa - (precioventa*(margenminimo/100.00));
    preciomaximo = precioventa + (precioventa*(margenmaximo/100.00));
    if($("#lbl"+idSombrero).html()==""){
      $("#precio").val("");
      $("#guardar").prop('disabled', 'disabled');
    } else {
      $("#precio").val($("#lbl"+idSombrero).html());
      if(preciominimo<=parseFloat($("#precio").val()) && parseFloat($("#precio").val())<=preciomaximo){
        $("#guardar").removeAttr("disabled");
      } else {
        $("#guardar").prop('disabled', 'disabled');       
      }
    }
    $("#mensaje").html("[Sombrero: <strong>"+codigoSombrero+"</strong>] || Rango Precios [S/ "+preciominimo+", S/ "+preciomaximo+"]");
    $("#modalPrecios").modal("show");
  }

  $("#guardar").click(function(e){
    if($("#precio").val()!=""){
      //Editar costo
        $.get('/ajax-editarPrecioLista/'+sombrero_id+"/"+$("#precio").val(), function(data){
            //success
            $.each(data, function(index, editPrecio){
                $("#lbl"+sombrero_id).html(editPrecio.precio_lista);
                Messenger().post({message:"¡ Se ha editado el precio lista !",type:"info",showCloseButton:!0});
            });
        });
    }
  });

  </script>
@endsection
