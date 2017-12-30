@extends('layouts.master')
@section('title','Proveedores')
@section('content')
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
        <h1 class="h2">Lista de Proveedores:</h1>
      </header>
      @include('partials.messages')
      <a href="{{url('/gastronomica/proveedores/proveedores/proveedor/create')}}" class="btn btn-primary margenInf">Nuevo</a> &nbsp;

      <div class="row">

        <div class="col-lg-12">

          <div class="card miBorder">

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

  <!--*********************LISTAR********************-->
  <script type="text/javascript">
    $(document).ready(function($){
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
