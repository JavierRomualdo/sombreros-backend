@extends('layouts.master')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active">Home</li>
      </ul>
    </div>
  </div>
  <!-- Counts Section --><br/>
  <center>
    <h1 class="text-primary">Feliz Navidad... Centro Artesanal Norte</h1>
    <h1 class="text-primary">Les desea Anonimus J.A :)</h1>
    <img src="images/feliz_navidad.jpg" alt="local" class="rounded miBorder">
  </center>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script type="text/javascript">
  //$("#li-home").attr('class','active');
    $(document).ready(function(e){
      /*$.get('/ajax-actualizarStock/1', function(data){
        //success
        $.each(data, function(index, stock){
          alert("se ha actualizado");
        });
      });*/
  });
  </script>
@endsection
