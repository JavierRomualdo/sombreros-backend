@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Sombreros</li>
      </ul>
    </div>
  </div><br/>
  <section class="forms">
    <div class="container-fluid">
      <!--<header>
        <h1 class="h3">Lista de Utilidades:</h1
      </header>-->
      @include('partials.messages')
      <a href="{{action('Reportes\ReporteController@reporteGeneralUtilidades')}}" target="_blank" class="btn btn-primary margenInf">Reporte General</a>
      <!--Panel Fechas-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Panel Fechas:</h2>
            </div>
            <div class="card-block">
              <p>Ingrese las fechas.</p>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="fecha_inicio"><strong>Fecha Inicio (*):</strong></label>
                <div class="col-sm-3">
                  {!!Form::date('fecha_inicio', null,['id'=>'fecha_inicio','name'=>'fecha_inicio','class'=>'form-control'])!!}
                </div>
                <label class="col-sm-2 form-control-label" for="fecha_fin"><strong>Fecha Final (*):</strong></label>
                <div class="col-sm-3">
                  {!!Form::date('fecha_fin', \Carbon\Carbon::now(),['id'=>'fecha_fin','name'=>'fecha_fin','class'=>'form-control'])!!}
                </div>
                <div class="col-sm-2">
                  <button type="button" name="buscar" id="buscar" class="btn btn-primary">Buscar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Tabla sombreros - utilidades-->
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display">Tabla utilidades:</h2>
            </div>
            <div class="card-block miTabla">
              <p>Lista de las utilidades de las ventas.</p>
              <table class="table table-striped table-hover table-bordered"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Codigo</th>
                    <th>Imagen</th>
                    <th>Fecha</th>
                    <th>Modelo</th>
                    <th>Tejido</th>
                    <th>Material</th>
                    <th>Público</th>
                    <th>Talla</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                    <th>Utilidad</th>
                  </tr>
                </thead>
                <tbody id="lista_datos">
                  @foreach ($sombreros as $index=>$sombrero)
                    <tr>
                      <th scope="row">{{$index+1}}</th>
                      <td>{{$sombrero->codigo}}</td>
                      <td>
                        <a href="{{action('Sombreros\SombreroController@foto',$sombrero->id)}}">
                          <img src="/images/sombreros/{{$sombrero->photo}}" class="img-fluid pull-xs-left rounded" alt="..." width="28">
                        </a>
                      </td>
                      <td>{{$sombrero->fecha}}</td>
                      <td>{{$sombrero->modelo}}</td>
                      <td>{{$sombrero->tejido}}</td>
                      <td>{{$sombrero->material}}</td>
                      <td>{{$sombrero->publico}}</td>
                      <td>{{$sombrero->talla}}</td>
                      <td>{{$sombrero->precio}}</td>
                      <td>{{$sombrero->precio_venta}}</td>
                      <td>{{$sombrero->utilidad}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

          </div>
        </div>
        <div class="container">
          <div class="paginacion">
            {!!$sombreros->links()!!}
          </div>
        </div>
      </div>
    </div>
    <!--Modal Erroes-->
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
  <script type="text/javascript">
    $("#buscar").click(function(e){
      var mensaje = "";
      if ($("#fecha_inicio").val()=="") {
        mensaje = mensaje + "</br>* La fecha de inicio no debe estar vacia.";
      }
      if ($("#fecha_fin").val()=="") {
        mensaje = mensaje + "</br>* La fecha final no debe estar vacia.";
      }

      if (mensaje=="") {//osea no hay mensajes de errores
        var tabla = "";
        var n = 1;

        $.get('/ajax-reportePorFecha/3/'+'0'+'/'+$("#fecha_inicio").val()+'/'+
        $("#fecha_fin").val(), function(data){
          //success
          $.each(data, function(index, utilidad){
            tabla = tabla + "<tr><th>"+n+"</th><td>"+utilidad.codigo+"</td><td>"+
            "<img src='/images/sombreros/"+utilidad.photo+"' class='img-fluid pull-xs-left rounded' alt='..' width='28'/></td><td>"+
            utilidad.fecha+"</td><td>"+utilidad.modelo+"</td><td>"+utilidad.tejido+"</td><td>"+utilidad.material+"</td><td>"+
            utilidad.publico+"</td><td>"+utilidad.talla+"</td><td>"+utilidad.precio+"</td><td>"+utilidad.precio_venta+"</td><td>"+
            utilidad.utilidad+"</td></tr>";
            n++;
          });
          $("#lista_datos").html(tabla);
          tabla = "";
        });

      } else {
        $("#errores").html(mensaje);
        $("#myModal").modal("show");
      }
    });
  </script>
@endsection
