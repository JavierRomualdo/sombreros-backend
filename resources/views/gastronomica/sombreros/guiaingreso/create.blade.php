@extends('layouts.master')
@section('title','Nuevo Guia Ingreso')
@section('content')

<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/guiaingreso/guiaingreso')}}">Guia Ingreso</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
      </ul>
    </div>
  </div></br>
  <div class="container-fluid">
    <center><h1 class="h5" id="titulo_codigo">Código: GI-001-17</h1></center>
    @include('partials.messages')
  </div>

  <section class="forms">
    <div class="container-fluid">
        <button type="button" class="btn btn-outline-primary ion-compose margenInf fadeIn animated btn-sm" id="btnOrdenCompra" data-toggle="modal" data-target="#exampleModal">
            Orden Compra
          </button><br/>
          
      {!!Form::open(['action'=>'Compras\GuiaIngresoController@store','method'=>'POST'])!!}
      <!--Panel Superior-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h5 display ion-paperclip fadeIn animated"> Panel Sombrero:</h2>
            </div>
            <div class="card-block">
              <p>Codigo de Orden: <b id='codigoOrden'>####</b></p>
              <div class="form-group row">
                <label class="col-sm-2 col-3 form-control-label"><strong>Articulo:</strong></label>
                <div class="col-sm-2 col-3">
                   <label id='articulo'>#</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label"><strong>Modelo:</strong></label>
                <div class="col-sm-2 col-3">
                   <label id='modelo'>#</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label"><strong>Tejido:</strong></label>
                <div class="col-sm-2 col-3">
                   <label id='tejido'>#</label>
                </div>

                <label class="col-sm-2 col-3 form-control-label"><strong>Material:</strong></label>
                <div class="col-sm-2 col-3">
                   <label id='material'>#</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label"><strong>Publico Dirigido:</strong></label>
                <div class="col-sm-2 col-3">
                   <label id='publico'>#</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label"><strong>Talla:</strong></label>
                <div class="col-sm-2 col-3">
                   <label id='talla'>#</label>
                </div>

                <label class="col-sm-2 col-3 form-control-label"><strong>Proveedor:</strong></label>
                <div class="col-sm-2 col-3">
                   <label id='proveedor'>#</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label"><strong>Costo Articulo:</strong></label>
                <div class="col-sm-2 col-3">
                   <label id='precio_unitario'>#</label>
                </div>
                <label class="col-sm-2 col-3 form-control-label"><strong>Stock Actual:</strong></label>
                <div class="col-sm-2 col-3">
                   <label id='stock_actual'>#</label>
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
              <h2 class="h5 display ion-paperclip  fadeIn animated"> Ingreso:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese los datos para la nueva guia de ingreso.</p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="cantidad"><strong>Cantidad(*):</strong></label>
                <div class="col-sm-3">
                  {!!Form::number('cantidad', null,['id'=>'cantidad','name'=>'cantidad','class'=>'form-control','placeholder'=>'Digite la Cantidad',
                    'onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57','min'=>1])!!}
                </div>
                <label class="col-sm-3 form-control-label" for="descripcion"><strong>Descripcion:</strong></label>
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
              <h2 class="h5 display ion-paperclip fadeIn animated title"> Detalles:</h2>
            </div>
            <div class="card-block">
              <p>Lista de todos los detalles de la guia de ingreso.</p>
              <div class="form-group row">
                <div class="col-sm-10">
                  <a href="{{url('gastronomica/sombreros/guiaingreso/guiaingreso')}}" class="btn btn-outline-primary ion-android-cancel btn-sm"> Cancelar</a>
                  <button type="button" class="btn btn-outline-success ion-ios-checkmark-outline btn-sm" data-toggle="modal" id="guardar"> Guardar</button>
                </div>
              </div>
              
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Proveedor</th>
                    <th>Codigo Orden</th>
                    <th>Articulo</th>
                    <th>Foto</th>
                    <th>Cantidad</th>
                    <th>Costo Articulo</th>
                    <th>Costo Total</th>
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

    <!-- Modal: Aviso Exitoso -->
    <div id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="h6 modal-title ion-paperclip"> Mensaje</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <h2 class="h6">¡Se ha guardado correctamente una guia de compra! :)</h2>
              <!--<p>¿Desea registrar mas ordenes de compra?</p>-->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="aceptar">Aceptar</button>
            </div>
          </div>
        </div>
      </div>
    <!-- Modal: Errores-->
    <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="h5 modal-title ion-paperclip" style="color: red;"> Errores</h5>
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
    <!-- Modal: Orden Compra -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h6 modal-title ion-paperclip" id="exampleModalLabel"> Ordenes Compra</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <p>Historial</p>
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered specialCollapse" id="myTableOrdenCompra"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo de Orden</th>
                    <th>Fecha</th>
                    <th>Cantidad Items</th>
                    <th>Costo Total</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($ordenes as $index=>$orden)
                  <tr class="fadeIn animated">
                    <th scope="row">{{$orden->id}}</th>
                    <th>{{$orden->numero_orden}}</th>
                    <td>{{$orden->fecha}}</td>
                    <td>{{$orden->cantidad}}</td>
                    <td>S/ {{$orden->precio_total}}</td>
                    <td>
                      <a href="javascript:mostrarOrdenCompraDetalles({{$orden->id}},'{{$orden->numero_orden}}');" class="btn btn-outline-primary btn-sm ion-android-checkmark-circle"></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
              <p>Detalles</p>
              <div class='table-responsive'>
                <table class="table table-striped table-hover table-bordered">
                  
                  <thead class="thead-inverse">
                    <tr>
                      <th>#</th>
                      <th>Articulo</th><!--Codigo Sombrero-->
                      <th>Foto</th>
                      <th>Cantidad</th>
                      <th>Ingresó</th>
                      <th>Costo Articulo</th>
                      <th>Costo Total</th>
                      <!--<th>Proveedor</th>-->
                      <th>Descripcion</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="cuerpoTablaIngreso">
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

    
  </section>

  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script type="text/javascript">
    var articulo = 1;
    $(document).ready(function(){
      $('#myTableOrdenCompra').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          responsive: true
        }
      });
      articulo = 1;
      mostrarCodigoOrden();
    });

    var idOrdenCompra_Detalle = 0;
    var cantidad = 0;
    var tipo = 1;
    var idProveedor = 0;
    
    
    $("#cantidad").keyup(function(e){
      console.log(e);
      //calcularPrecioTotal();
    });
    
    function limpiar() {
      $("#codigoOrden").html("####");
      $("#articulo").html("#");
      $("#modelo").html("#");
      $("#tejido").html("#");
      $("#material").html("#");
      $("#publico").html("#");
      $("#talla").html("#");
      $("#proveedor").html("#");
      $("#precio_unitario").html("#");
      $("#stock_actual").html("#");
      $("#cantidad").val("");
      $("#cantidad").removeAttr('max');
      $("#descripcion").val("");
    }

    function mostrarCodigoOrden() {
      $.get('/ajax-mostrarCGI/1', function(data){
        //success
        $.each(data, function(index, objeto){
          var d = new Date();
          var anio = (d.getFullYear())+"";
          var digitos = anio.substring(2,4);
          var n = parseInt(objeto.id)+1;
          var cod = "";
          if (n>0 && n<10) {
            cod = "GI-000"+n+"-"+digitos;
          } else if(n>=10 && n<100){
            cod = "GI-00"+n+"-"+digitos;
          } else if(n>=100 && n<1000){
            cod = "GI-0"+n+"-"+digitos;
          } else if(n>=1000 && n<10000){
            cod = "GI-"+n+"-"+digitos;
          } else {
            cod = "Null";
          }
          $("#titulo_codigo").text("Código: "+cod);
          //alert('(2)'+objeto.id);
        });
      });
    }

    $("#guardar").click(function(){
      var mensaje = "";
      if($("#codigoOrden").html()=="####"){
        mensaje = "* Seleccione la Orden de Compra.<br/>";
      }
      if ($("#cantidad").val()=="") {
        mensaje = mensaje + "* Debe ingresar la cantidad.<br/>";
      }
      if(parseInt($("#cantidad").val()) > cantidad){
        mensaje = mensaje + "* Debe ingresar la cantidad menor o igual a "+cantidad+".<br/>";
      }
      if (mensaje=="") {
        //solo se guardar todas las ordenes de compras detalle
        var tabla = "";
        var n = 1;
        var descripcion = $("#descripcion").val();
        if (descripcion=="") {
          descripcion = "0";
        }
        
        if(tipo==1){
          $.get('/ajax-guardarguia/1/'+articulo+'/'+idProveedor+
          '/'+$("#cantidad").val()+'/'+descripcion+"/"+idOrdenCompra_Detalle, function(data){
            //success
            $.each(data, function(index, guia){
              tabla = tabla+"<tr class='fadeIn animated'><th>"+n+"</th><td>"+guia.empresa+"</td><td>"+guia.numero_orden+
                "</td><td>"+guia.codigo+"</td>"+"<td><img src='/images/sombreros/"+guia.photo+
                "' class='img-fluid pull-xs-left rounded' alt='...' width='28'></td>"+
                "<td>"+guia.cantidad+"</td><td>S/ "+guia.precio+"</td><td>S/ "+(parseInt(guia.cantidad) * parseInt(guia.precio))+
                  "</td><td>"+guia.descripcion+"</td></tr>";
              n++;
              tipo = 2;
            });
            $("#lista_datos").html(tabla);
            tabla = "";
            $("#myModal2").modal("show");
            limpiar();
          });
        } else {//tipo = 2
          $.get('/ajax-guardarguia/2/'+articulo+'/'+idProveedor+
          '/'+$("#cantidad").val()+'/'+descripcion+"/"+idOrdenCompra_Detalle, function(data){
            //success
            $.each(data, function(index, guia){
              tabla = tabla+"<tr class='fadeIn animated'><th>"+n+"</th><td>"+guia.empresa+"</td><td>"+guia.numero_orden+
                "</td><td>"+guia.codigo+"</td>"+"<td><img src='/images/sombreros/"+guia.photo+
                "' class='img-fluid pull-xs-left rounded' alt='...' width='28'></td>"+
                "<td>"+guia.cantidad+"</td><td>S/ "+guia.precio+"</td><td>S/ "+(parseInt(guia.cantidad) * parseInt(guia.precio))+
                  "</td><td>"+guia.descripcion+"</td></tr>";
              n++;
            });
            //alert(tabla);
            $("#lista_datos").html(tabla);
            tabla = "";
            $("#myModal2").modal("show");
            limpiar();
          });
        }
      } else {
        $("#errores").html(mensaje);
        $("#myModal").modal("show");
      }
    });

    /*Para: Ordenes de Compras*/
    $("#btnOrdenCompra").click(function(e){
      $("#cuerpoTablaIngreso").html("");
    });

    //Mostrar todo los detalles de orden de compra
    function mostrarOrdenCompraDetalles(idOrdenCompra, numero_orden){
      var n = 1;
      var tabla = "";
      $.get('/ajax-mostrarOrdenCompraDetalles/'+idOrdenCompra, function(data){
        //success
        $.each(data, function(index, orden){
          var mensajeBoton = "";
          if(orden.cantidad > orden.cantidad_ingreso){// ya esta orden de compra se ha ingresado en la guia
            mensajeBoton = "<button class='btn btn-outline-primary btn-sm ion-android-done' onclick='elegirOrdenCompra("+orden.id+")'></button>";
          } else {//es que aun no se ingresa todo 
            mensajeBoton = "<button disabled title='Se ha ingresado' class='btn btn-outline-primary btn-sm ion-android-done' onclick='elegirOrdenCompra("+orden.id+")'></button>";
          }
          $("#idProveedor").prop('disabled', 'disabled');
          tabla = tabla+"<tr class='fadeIn animated'><th>"+n+"</th><td>"+orden.codigo+
          "</td><td><img src='/images/sombreros/"+orden.photo+
          "' class='img-fluid pull-xs-left rounded' alt='...' width='28'></td>"+
          "<td>"+orden.cantidad+"</td><td>"+orden.cantidad_ingreso+"</td><td>S/ "+orden.precio_unitario+
          "</td><td>S/ "+(orden.cantidad * orden.precio_unitario)+
          "</td><td>"+orden.descripcion+"</td><td>"+mensajeBoton+"</td></tr>";
          n++;
        });
        $("#cuerpoTablaIngreso").html(tabla);
        tabla = "";
      });
    }

    function elegirOrdenCompra(idOrdenCompraDetalle){
      $('#exampleModal').modal('hide');
      $.get('/ajax-mostrarDatosSombrero/'+idOrdenCompraDetalle, function(data){
        //success
        $.each(data, function(index, orden){
          $("#codigoOrden").html(orden.numero_orden);
          $("#articulo").html(orden.codigo);
          $("#modelo").html(orden.modelo);
          $("#tejido").html(orden.tejido);
          $("#material").html(orden.material);
          $("#publico").html(orden.publico);
          $("#talla").html(orden.talla);
          $("#proveedor").html(orden.empresa);
          $("#precio_unitario").html(orden.precio);
          $("#stock_actual").html(orden.stock_actual);
          $("#cantidad").val(parseInt(orden.cantidad) - parseInt(orden.cantidad_ingreso));
          $("#cantidad").attr('max',parseInt(orden.cantidad) - parseInt(orden.cantidad_ingreso));
          idOrdenCompra_Detalle = orden.id;
          idProveedor = orden.id_proveedor;
          cantidad = (parseInt(orden.cantidad) - parseInt(orden.cantidad_ingreso));
          articulo = orden.codigo;
        });
      });
    }
    //
  </script>
@endsection
