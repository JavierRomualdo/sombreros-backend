@extends('layouts.master')
@section('title','Sombreros')
@section('content')
    <div class="breadcrumb-holder fadeIn animated">
        <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active">Ventas por vendedor</li>
        </ul>
        </div>
    </div>
    <section class="forms"><br/>
        <div class="container-fluid">
          <!--<header>
            <h1 class="h5 fadeIn animated text-center ion-clipboard"> Lista Sombreros</h1>
          </header>-->
          <!---->
            <!--<div class="row">
                <div class="col-lg-12">
                <div class="card miBorder fadeIn animated">
                    <div class="card-header d-flex align-items-center">
                    <h2 class="h6 display ion-paperclip fadeIn animated"> Vendedor:</h2>
                    </div>
                    <div class="card-block">
                    <div class="form-group row">
                        <label class="offset-sm-0 col-sm-1 form-control-label text-center"><strong>Vendedor:</strong></label>
                        <div class="col-sm-4">
                        <div class="input-group">
                            <input type="text" id="vendedor" class="form-control" placeholder="Aqui el nombre del vendedor" readonly=""/>
                            <button type="button" name="edit" id="edit" class="btn btn-primary fa fa-edit rounded" title="buscar vendedor"></button>
                        </div>
                        </div>
                        <label class="col-sm-1 form-control-label" for="fecha_inicio"><strong>Fecha Inicio (*):</strong></label>
                        <div class="col-sm-2">
                        {!!Form::date('fecha_inicio', null,['id'=>'fecha_inicio','name'=>'fecha_inicio','class'=>'form-control'])!!}
                        </div>
                        <label class="col-sm-1 form-control-label" for="fecha_fin"><strong>Fecha Fin(*):</strong></label>
                        <div class="col-sm-2">
                        {!!Form::date('fecha_fin', \Carbon\Carbon::now(),['id'=>'fecha_fin','name'=>'fecha_fin','class'=>'form-control'])!!}
                        </div>
                        <div class="col-sm-1">
                        <button type="button" name="buscar" id="buscar" class="btn btn-primary fa fa-search rounded" title="buscar"></button>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>-->
            <!---->
          <div class="col-md-12 embed-responsive embed-responsive-16by9">
                <div id="columnchart_values" style="border: 2px dashed #bbb;" class="text-center embed-responsive-item"></div>
            </div>
        </div>
    </section>

    <!--Modal vendedores-->
      <div class="modal fade bd-example-modal-lg" id="modalVendedor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="h6 modal-title ion-paperclip" id="exampleModalLabel"> Vendedores</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <!--<p>Historial</p>-->
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered specialCollapse" id="myTableCliente"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Dni</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($vendedores as $index=>$vendedor)
                    <tr class="fadeIn animated">
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$vendedor->nombres}}</td>
                      <td>{{$vendedor->apellidos}}</td>
                      <td>{{$vendedor->dni}}</td>
                      <td>{{$vendedor->direccion}}</td>
                      <td>{{$vendedor->telefono}}</td>                      
                      <td>
                        <a href="javascript:mostrarCliente({{$vendedor->id}},'{{$vendedor->nombres}}');" class="btn btn-outline-primary btn-sm ion-android-done"></a>
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
    <!---->
    <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
    <!--Notificacion-->
    <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
    <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
    <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>
    <script type="text/javascript">
        var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        var f=new Date();
        //google chart
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        var data = null;
        var view = null;
        var options = null;
        var chart = null;
        function drawChart() {
          data = google.visualization.arrayToDataTable([
            ["Element", "Cantidad", { role: "style" } ],
            @foreach ($ventasvendedor as $ventas)
              ['{{$ventas->nombres}}', {{$ventas->cantidad}}, "silver"],
            @endforeach
            
            /*["Silver", 10.49, "silver"],
            ["Gold", 19.30, "gold"],
            ["Platinum", 21.45, "color: #e5e4e2"]*/
          ]);
    
          view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);
    
          options = {
            title: "Articulos vendedidos (Mes: "+meses[f.getMonth()]+") , en und.",
            width: '100%',
            // height: 500,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
          };
          chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
          chart.draw(view, options);
      }
      </script>
    <script>
        $("#edit").click(function(e){
            $('#modalVendedor').modal('show');
            //alert("hola");
        });
        function mostrarCliente(idVendedor, nombre){
            $("#vendedor").val(nombre);
            vendedor_id = idVendedor;
            $('#modalVendedor').modal('hide');
            
        }
        $("#buscar").click(function(e){
            var mensaje = "";
            if($("#vendedor").val()==""){
            mensaje = mensaje + "* El vendedor no debe estar vacia.<br/>";
            }
            if ($("#fecha_inicio").val()=="") {
            mensaje = mensaje + "* La fecha de inicio no debe estar vacia.<br/>";
            }
            if ($("#fecha_fin").val()=="") {
            mensaje = mensaje + "* La fecha final no debe estar vacia.";
            }
            if(mensaje==""){
            //cargar las ventas consolidado
            //this.data = google.visualization.arrayToDataTable(cargarVentas);
            cargarVentas();


            } else {
            Messenger().post({message: mensaje,type:"error",showCloseButton:!0});
            }
        });

        var primer = [[]];
        var second = [[]];
        var a = null;
        var b = new Array(2);
        var datt = null;
        function cargarVentas(){
            if($("#cliente").val()!=""){
              $.get('/ajax-ventasporvendedores/'+$("#fecha_inicio").val()+'/'+
              $("#fecha_fin").val(), function(dato){
                datt = dato;
                //var data = new google.visualization.DataTable(dato);

                // Instantiate and draw our chart, passing in some options.
                //var chart = new google.visualization.PieChart(document.getElementById('columnchart_values'));
                //chart.draw(data, this.options);
          
                //success
                var n = 0;
                $.each(dato, function(index, venta){
                     var d = new Array()
                    //var d = [venta.nombres, venta.cantidad, "silver"];
                    d.push(venta.nombres);
                    d.push(venta.cantidad);
                    d.push("silver");
                    //alert(venta.nombres);
                    //primer[n] = d;
                    //this.primer.push(d);
                    //alert(d);
                    b[n] = d;
                    n++;
                    
                    
                    //a = '[' + venta.nombres + ', ' + venta.cantidad +']';
                });
                //alert(b);
                this.data = google.visualization.arrayToDataTable(drawChart2);
              });
            } else {
              Messenger().post({message: "* Debe seleccionar el cliente",type:"error",showCloseButton:!0});
            }
          }

          function drawChart2() {
            data = google.visualization.DataTable(datt);
    
          view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);
    
          options = {
            title: "Articulos vendedidos (Mes: "+meses[f.getMonth()]+") , en und.",
            width: '100%',
            // height: 500,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
          };
          chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
          chart.draw(view, options);
        }
    </script>
@endsection