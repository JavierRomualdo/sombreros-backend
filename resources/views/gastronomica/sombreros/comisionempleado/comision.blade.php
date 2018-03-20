@extends('layouts.master')
@section('title','Materiales')
@section('content')
  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Comision Empleado</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2 fadeIn animated text-center ion-clipboard"> Comision de los empleados</h1>
      </header>
      @include('partials.messages')
      <!--<div class="row">
        <div class="col-lg-12">

          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h1 display ion-paperclip fadeIn animated title"> Historial:</h2>
            </div>
            <div class="card-block">
              <a href="{{url('/gastronomica/sombreros/comisionempleado/comision/create')}}" class="btn btn-outline-primary btn-sm margenInf fadeIn animated ion-plus-round"> Nuevo</a> &nbsp;
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">

                <thead class="thead-inverse">
                  <tr>
                    <th>#</th>
                    <th>Empleado</th>
                    <th>Ocupacion</th>
                    <th>Articulo</th>
                    <th>Foto</th>
                    <th>Precio Venta</th>
                    <th>Comision (%)</th>
                    <th>Comision (S/)</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @ foreach ($comisiones as $index=>$comision)
                    <tr class="fadeIn animated">
                      <th scope="row">{ { $index+1}}</th>
                      <td>{ {$comision->nombres}}</td>
                      <td>{ {$comision->nombre}}</td>
                      <td>{ {$comision->codigo}}</td>
                      <td>
                        <img src="/images/sombreros/{ {$comision->photo}}" class="img-fluid pull-xs-left rounded" alt="..." width="28">
                      </td>
                      <td>{ {$comision->precio_venta}}</td>
                      <td>{ {$comision->porcentaje}} %</td>
                      <td>S/. { {$comision->porcentaje/100.00 * $comision->precio_venta}}</td>
                      <td>{ {$comision->descripcion}}</td>
                      <td>
                        <a href="{ {action('Empleados\EmpleadoComisionController@edit', $comision->id)}}" class="btn btn-outline-primary btn-sm ion-edit" title="Editar"></a>
                        <a href="{ {action('Empleados\EmpleadoComisionController@show', $comision->id)}}" class="btn btn-outline-primary btn-sm ion-android-delete" title="Eliminar"></a>
                      </td>
                    </tr>
                  @ endforeach
                </tbody>
              </table>
              </div>
            </div>

          </div>
        </div>
        <div class="container">
          <div class="paginacion">
            { !!$comisiones->links()!!}
          </div>
        </div>
      </div>-->

      <div class="row">
        <div class="col-lg-12">

          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h1 display ion-paperclip fadeIn animated title"> Historial:</h2>
            </div>
            <div class="card-block">
              <div class="row">
                <label class="col-sm-2 form-control-label" for="idMaterial"><strong>Temporada:</strong></label>
                <div class="col-md-3">
                    {!!Form::select('idTemporada',$temporada, null,['id'=>'idTemporada','name'=>'idTemporada','class'=>'form-control'])!!}
                </div>
              </div>
              <hr/>
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">

                <thead><!--class="thead-inverse"-->
                  <tr>
                  <th>[ {{$cantidadSombreros}} / {{$cantidadEmpleado}} ]</th>
                    @foreach ($empleados as $index=>$empleado)
                    <th class="text-center">[{{$index+1}}] {{$empleado->nombres}}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @foreach ($sombreros as $index=>$sombrero)
                    <tr>
                    <th>{{$sombrero->codigo}} [P.V={{$sombrero->precio_venta}}]</th>
                    @foreach ($empleados as $empleado)
                    <td>
                      <div class="row">
                        <input type="text" class="form-control col-md-5 text-center" onkeyup="calcularComision({{$sombrero->id}},{{$empleado->id}},{{$sombrero->precio_venta}})" disabled id="c{{$sombrero->id}}{{$empleado->id}}">
                        <label id="lbl{{$sombrero->id}}{{$empleado->id}}" class="form-control col-md-3 text-center"></label>
                        <div class="col-md-4">
                          <input id="check{{$sombrero->id}}{{$empleado->id}}" onChange="cambiarComision({{$sombrero->id}},{{$empleado->id}});" 
                          type="checkbox" value="" class="form-control-custom">
                          <label for="check{{$sombrero->id}}{{$empleado->id}}">Editar</label></td>
                        </div>
                      </div>
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
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <!--Notificacion-->
  <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>
  <script>
    var temporada_id = 0;
    $(document).ready(function(){
      Messenger().post({message:"Historial de comisiones de empleados.",type:"info",showCloseButton:!0});
      temporada_id = 0;
      limpiar();
    });
    
    var cantidad_empleados = {{$cantidadEmpleado}};
    var cantidad_sombreros = {{$cantidadSombreros}};
    $("#idTemporada").change(function(e){
      console.log(e);
      temporada_id = e.target.value;
      limpiar();
      mostrarComision();
    });

    function limpiar(){
      if(temporada_id==0){
        for (let i = 1; i <= cantidad_sombreros; i++) {
          for (let j = 1; j <= cantidad_empleados; j++) {
            $("#c"+i+""+j).val("");
            $("#lbl"+i+""+j).html("");           
            $("#check"+i+""+j).attr('disabled', true);
          }
        }
      } else {
        for (let i = 1; i <= cantidad_sombreros; i++) {
          for (let j = 1; j <= cantidad_empleados; j++) {
            $("#c"+i+""+j).val("");
            $("#lbl"+i+""+j).html("");            
            $("#check"+i+""+j).attr('disabled', false);   
          }
        }
      }
    }

    function calcularComision(idSombrero,idEmpleado, precio_venta){
      $("#lbl"+idSombrero+""+idEmpleado).html("S/ "+ parseFloat($("#c"+idSombrero+""+idEmpleado).val())/100.00 * precio_venta);      
    }

    function mostrarComision($idSombrero, $idEmpleado){
      if(temporada_id!=0){
        $.get('/ajax-mostrarComisiones/'+temporada_id, function(data){
          //success
          $.each(data, function(index, comision){
            $("#c"+comision.idSombrero+""+comision.idEmpleado).val(comision.porcentaje);
            $("#c"+comision.idSombrero+""+comision.idEmpleado).attr('name',comision.id);
            $("#lbl"+comision.idSombrero+""+comision.idEmpleado).html("S/ "+parseFloat(comision.porcentaje/100.00 * comision.precio_venta));
            
          });
        });
      }
    }

    function cambiarComision(idSombrero,idEmpleado){
      if($("#check"+idSombrero+""+idEmpleado).is(":checked")){// desactivado a activado
        $("#c"+idSombrero+""+idEmpleado).removeAttr("disabled");
        //solo se activa el input para editar la comision
      } else {//activado a desactivado
        $("#c"+idSombrero+""+idEmpleado).prop('disabled', 'disabled');
        //Aca se ingresa o se modifca la comision
        if($("#c"+idSombrero+""+idEmpleado).attr('name')==null){
          //se ingresa nueva comision
          if($("#c"+idSombrero+""+idEmpleado).val()!=""){
            $.get('/ajax-nuevaComision/'+idSombrero+"/"+idEmpleado+"/"+temporada_id+"/"+
              $("#c"+idSombrero+""+idEmpleado).val(), function(data){
              //success
              $.each(data, function(index, newComision){
                //$("#c"+idSombrero+""+idEmpleado).val(newComision);
              });
              Messenger().post({message:"¡ Se ha grabado nueva comision !",type:"info",showCloseButton:!0});            
            });
          }
        } else {
          //se modifica la comision
          if($("#c"+idSombrero+""+idEmpleado).val()!=""){
            $.get('/ajax-cambiarComision/'+$("#c"+idSombrero+""+idEmpleado).attr('name')+"/"+
              $("#c"+idSombrero+""+idEmpleado).val(), function(data){
              //success
              $.each(data, function(index, comision){
                $("#c"+idSombrero+""+idEmpleado).val(comision.porcentaje);
              });
              Messenger().post({message:"¡ Se ha modificado la comision !",type:"info",showCloseButton:!0});            
            });
          } else{
            $.get('/ajax-mostrarComision/'+$("#c"+idSombrero+""+idEmpleado).attr('name'), function(data){
              //success
              $.each(data, function(index, miComision){
                $("#c"+idSombrero+""+idEmpleado).val(miComision.porcentaje);
              });        
            });
          }
        }
        /*if($("#c"+idSombrero+""+idEmpleado).val()!=""){
          $.get('/ajax-cambiarComision/'+idSombrero+"/"+idEmpleado+"/"+temporada_id+"/"+
            $("#c"+idSombrero+""+idEmpleado).val(), function(data){
            //success
            $.each(data, function(index, comision){
              $("#c"+idSombrero+""+idEmpleado).val(comision.porcentaje);
            });
            Messenger().post({message:"¡ Comision grabada exitosa !",type:"info",showCloseButton:!0});            
          });
        }*/
      }
    }    
    
  </script>
@endsection
