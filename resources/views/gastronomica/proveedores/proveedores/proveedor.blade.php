@extends('layouts.master')
@section('title','Proveedores')
@section('content')
<link rel="stylesheet" href="{{asset('bootstrap4/css/datatables/dataTables.bootstrap4.min.css')}}">
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Proveedor</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h2 fadeIn animated text-center ion-clipboard"> Lista Proveedores</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/proveedores/proveedores/proveedor/create')}}" class="btn btn-primary btn-sm margenInf fadeIn animated ion-plus-round"> Nuevo</a> &nbsp;

      <div class="row">

        <div class="col-lg-12">

          <div class="card miBorder fadeIn animated">
            <div class="card-header d-flex align-items-center">
              <h2 class="h6 display ion-paperclip fadeIn animated title col-md-4"> Historial:</h2>
            </div>
            <div class="card-block">

              <div id="list-proveedores">

              </div>
              <!--<ul id="pagination" class="pagination-sm"></ul>-->
            </div>

          </div>

        </div>

      </div>

    </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  
  <!--*********************LISTAR********************-->
  <script type="text/javascript">
    
    $(document).ready(function($){
      $('#myTable').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          responsive: true
        }
      });
      listProveedores();
    });

    $(document).on("click", ".pagination li a", function(e) {
      e.preventDefault();
      var url = $(this).attr("href");

      $.ajax({
        type: 'get',
        url: url,
        success: function(data){
          $('#list-proveedores').empty().html(data);
        }
      });
    });
    var listProveedores = function(){
      $.ajax({
        type:'get',
        url: '{{url('listall')}}',
        success: function(data){
          $('#list-proveedores').empty().html(data);
        }
      });
    };
  </script>

  <!--************************GRABAR********************-->
  <!--<script type="text/javascript">
  $("#grabar").click(function(event){
    var empresa = $(#recipient-empresa).val();
    alert(empresa);
  });
</script>-->
@endsection
