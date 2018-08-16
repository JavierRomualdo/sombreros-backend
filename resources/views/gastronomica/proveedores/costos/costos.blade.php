@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Costos</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h3 fadeIn animated text-center ion-clipboard"> Lista de Costos:</h1>
      </header>
      @include('partials.messages')
      <!--<a href="{{url('/gastronomica/proveedores/costos/costos/create')}}" class="btn btn-outline-primary margenInf fadeIn animated ion-plus-round btn-sm"> Nuevo</a> &nbsp;

      <div class="row">

        <div class="col-lg-12">

          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h6 display ion-paperclip fadeIn animated title"> Historial:</h2>
            </div>
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                <thead class="thead-inverse">
                  <tr>
                    <th class="text-center">#</th>
                    <th>Codigo Sombrero</th>
                    <th>Foto</th>
                    <th>Proveedor</th>
                    <th>Costo</th>
                    <th>Aciones</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              </div>
            </div>

          </div>

        </div>

      </div>-->
      <!---->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h6 display ion-paperclip fadeIn animated title"> Historial:</h2>
            </div>
            <div class="card-block">
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered datatable" id="myTable">
                  <thead class="thead-inverse"><!--class="thead-inverse"-->
                    <tr>
                    <th>[ {{$cantidadSombreros}} / {{$cantidadProveedores}} ]</th>
                      @foreach ($proveedores as $index=>$proveedor)
                      <th class="text-center">[{{$index+1}}] {{$proveedor->empresa}}</th>
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($sombreros as $index=>$sombrero)
                      <tr>
                      <th><!--[{{$index + 1}}]-->
                        <label style="cursor: pointer" onclick="detalleSombrero({{$sombrero->id}})" title="detalles">{{$sombrero->codigo}}</label>
                        <img src="/images/sombreros/{{$sombrero->photo}}" data-toggle="modal" class="link_foto img-fluid pull-xs-left rounded" alt="..." width="28" title="ver foto">
                      </th>
                      @foreach ($proveedores as $proveedor)
                      <td>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="input-group">
                              <label id="lbl{{$sombrero->id}}{{$proveedor->id}}" class="form-control col-md-8 text-center"></label>
                              <button type="button" class="btn btn-primary btn-sm" onclick="cambiarCosto({{$sombrero->id}},'{{$sombrero->codigo}}',{{$proveedor->id}},'{{$proveedor->empresa}}')">
                              <i class="fa fa-edit"></i></button>
                            </div>
                          </div>
                          <!--<div class="col-md-4">
                            <input id="check{{$sombrero->id}}{{$proveedor->id}}" onChange="cambiarComision({{$sombrero->id}},{{$proveedor->id}});" 
                            type="checkbox" value="" class="form-control-custom">
                            <label for="check{{$sombrero->id}}{{$proveedor->id}}">Editar</label>
                          </div>-->
                        </div>
                      </td>
                      @endforeach
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
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="aceptar">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!--Modal editar costos-->
  <div id="modalCostos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Editar Costo</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <p id="mensaje"></p>
          <div class="form-group row">
            <label class="form-control-label col-md-4"><strong>Ingrese Costo:</strong></label>
            <div class="col-md-8">
              <input type="text" class="form-control" id="costo"/>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" disabled class="btn btn-primary btn-sm" data-dismiss="modal" id="guardar">Guardar</button>          
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!---->
  <!--Modal detalle del sombrero-->
    <div class="modal fade bd-example-modal-lg" id="modalsombrero" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h5 modal-title ion-paperclip" id="exampleModalLabel"> 
              Sombrero: <label id="lblcodigo"></label></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-2 form-control-label"><strong>Modelo:</strong></label>
              <label class="col-sm-2 form-control-label" id="lblmodelo"></label>
              <label class="col-sm-2 form-control-label"><strong>Tejido:</strong></label>
              <label class="col-sm-2 form-control-label" id="lbltejido"></label>
              <label class="col-sm-2 form-control-label"><strong>Material:</strong></label>
              <label class="col-sm-2 form-control-label" id="lblmaterial"></label>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 form-control-label"><strong>Publico:</strong></label>
              <label class="col-sm-2 form-control-label" id="lblpublico"></label>
              <label class="col-sm-2 form-control-label"><strong>Talla:</strong></label>
              <label class="col-sm-2 form-control-label" id="lbltalla"></label>
              <label class="col-sm-2 form-control-label"><strong>Precio Venta:</strong></label>
              <label class="col-sm-2 form-control-label" id="lblprecioventa"></label>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 form-control-label"><strong>Stock Actual:</strong></label>
              <label class="col-sm-2 form-control-label" id="lblstockactual"></label>
              <label class="col-sm-2 form-control-label"><strong>Stock Maximo:</strong></label>
              <label class="col-sm-2 form-control-label" id="lblstockmaximo"></label>
              <label class="col-sm-2 form-control-label"><strong>Stock Minimo:</strong></label>
              <label class="col-sm-2 form-control-label" id="lblstockminimo"></label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!--end modal-->
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <!--Notificacion-->
  <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>
  <script type="text/javascript">
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

      Messenger().post({message:"Historial de costos.",type:"info",showCloseButton:!0});
      mostrarCostos();
    });
    /**Mostrando el modal de foto de sombrero */
    var sombrero_id = 0;
    var proveedor_id = 0;
    $(".link_foto").css('cursor', 'pointer');
    $(".link_foto").click(function(e){
      $("#mostrar_foto").attr("src",$(this).attr("src"));
      $("#myModal").modal("show");
    });
  /**Mostrar costos en la tabla */
  function mostrarCostos(){
    $.get('/ajax-mostrarCostos/', function(data){
      //success
      $.each(data, function(index, costos){
        $("#lbl"+costos.idSombrero+""+costos.idProveedor).html(costos.precio);
      });
    });
  }

  function detalleSombrero(id){
    $.get('/ajax-getDatosSombrero/'+id, function(data){
      //success
      $.each(data, function(index, dato){
        $("#lblcodigo").html("[ "+dato.codigo+" ]");
        $("#lblmodelo").html(dato.modelo);
        $("#lbltejido").html(dato.tejido);
        $("#lblmaterial").html(dato.material);
        $("#lblpublico").html(dato.publico);
        $("#lbltalla").html(dato.talla);
        $("#lblprecioventa").html(dato.precio_venta);
        $("#lblstockactual").html(dato.stock_actual);
        $("#lblstockmaximo").html(dato.stock_maximo);
        $("#lblstockminimo").html(dato.stock_minimo);
      });
    });
    $('#modalsombrero').modal('show');
    //alert(id);
  }
  /**Mostrando el modal costos para editar*/
  function cambiarCosto(idSombrero, codigoSombrero, idProveedor, empresa){
    sombrero_id = idSombrero;
    proveedor_id = idProveedor;
    if($("#lbl"+sombrero_id+""+proveedor_id).html()==""){
      $("#costo").val("");
    } else {
      $("#costo").val($("#lbl"+sombrero_id+""+proveedor_id).html());
    }
    $("#modalCostos").modal("show");
    $("#mensaje").html("[Sombrero: <strong>"+codigoSombrero+"</strong>, Proveedor: <strong>"+empresa+"</strong>]");
  }

  $("#costo").keyup(function(){
    if($("#costo").val()==""){
      $("#guardar").prop('disabled', 'disabled');
    } else {
      $("#guardar").removeAttr("disabled");
    }
  });
  
  $("#guardar").click(function(e){
    if($("#costo").val()!=""){
      if($("#lbl"+sombrero_id+""+proveedor_id).html()==""){
        //Nuevo costo
        $.get('/ajax-nuevoCosto/'+sombrero_id+"/"+proveedor_id+"/"+$("#costo").val(), function(data){
            //success
            $.each(data, function(index, newCosto){
              $("#lbl"+sombrero_id+""+proveedor_id).html(newCosto.precio);
            });
            Messenger().post({message:"¡ Se ha grabado nuevo costo !",type:"info",showCloseButton:!0});            
        });
        //$("#lbl"+sombrero_id+""+proveedor_id).html($("#costo").val());
      } else {
        //Editar costo
        $.get('/ajax-editarCosto/'+sombrero_id+"/"+proveedor_id+"/"+$("#costo").val(), function(data){
            //success
            $.each(data, function(index, editCosto){
              $("#lbl"+sombrero_id+""+proveedor_id).html(editCosto.precio);
            });
            Messenger().post({message:"¡ Se ha editado el costo !",type:"info",showCloseButton:!0});            
        });
      }
      
    }
  });
  </script>
@endsection
