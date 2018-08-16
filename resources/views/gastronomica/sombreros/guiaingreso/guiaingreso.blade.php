@extends('layouts.master')
@section('title','Guia Ingreso')
@section('content')

<!--<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/bootstrap.css')}}">-->
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">

  <div class="breadcrumb-holder fadeIn animated">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Guia Ingreso /</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2 fadeIn animated text-center ion-clipboard"> Guia Ingreso</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/sombreros/guiaingreso/guiaingreso/create')}}" class="btn btn-primary margenInf fadeIn animated btn-sm" title="nueva guia ingreso"><i class="ion-plus-round"></i> Nuevo</a> &nbsp;
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
                <h2 class="h5 display ion-paperclip fadeIn animated title"> Historial:</h2>
            </div>
            <div class="card-block miTabla">
              
              <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="myTable"><!--table-responsive-->

                <thead class="thead-inverse">
                  <tr>
                    <th class="text-center">#</th>
                    <th>Codigo de Guia</th>
                    <th># Documento Prov.</th>
                    <th>Fecha</th>
                    <th>Cantidad Items</th>
                    <th>Costo Total</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($guias as $index=>$guia)
                  <tr class="fadeIn animated">
                    <th scope="row" class="text-center">{{$index+1}}</th>
                    <th>{{$guia->numero_guia}}</th>
                    <th>{{$guia->numero_documento}}</th>
                    <td>{{$guia->fecha}}</td>
                    <td>{{$guia->cantidad_guia}}</td>
                    <td>S/ {{$guia->precio_total}}</td>
                    <td>
                      <a href="{{action('Compras\GuiaIngresoController@ver',$guia->id)}}" class="btn btn-outline-primary btn-sm ion-eye" title="Ver"></a>
                      <a href="{{action('Compras\GuiaIngresoController@reporte',$guia->id)}}" target="_blank" title="reporte"
                        class="btn btn-outline-primary btn-sm ion-document-text"></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script>
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
  </script>
@endsection
