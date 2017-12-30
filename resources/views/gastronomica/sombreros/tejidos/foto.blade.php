@extends('layouts.master')
@section('title','Tejidos')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/sombreros/tejidos/tejido')}}">Calidad Tejidos</a></li>
        <li class="breadcrumb-item active">Editar Foto</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <br/>
      <div class="row">
        <div class="offset-lg-3 col-lg-6">
          <div class="card miBorder">
            <div class="card-header">
              <h2 class="h1 display display">Editar Imagen:</h2>
            </div>
            <div class="card-block">
              <form class="" action="/phototejido" enctype="multipart/form-data" method="post">
                <div class="form-group">
                  <label class="form-control-label" for="photo"><strong>Foto:</strong></label>
                  <label class="form-control custom-file" id="customFile">
                    <input type="file" name="photo"  class="custom-file-input form-control" id="exampleInputFile" aria-describedby="fileHelp">
                    <input type="hidden" name="id" id="id" value="{{$tejido->id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <!--{ !!form::file('file',null, ['class'=>'custom-file-input','name'=>'photo','id'=>'exampleInputFile','aria-describedby'=>'fileHelp'])!!}-->
                    <span class="custom-file-control form-control-file" id="imgtexto"></span>
                  </label>
                  <!--{! !form::text('photo', null,['id'=>'photo','class'=>'form-control','placeholder'=>'Ingrese Foto'])!!}-->
                  <!--Foto-->
                  <label for="" class="form-control text-center">
                    <img src="/images/tejidos/{{$tejido->photo}}" name="foto" id="mifoto" class="rounded" width="150" height="150" alt="">
                  </label>
                </div>
                <div class="form-group">
                  <a href="{{url('/gastronomica/sombreros/tejidos/tejido')}}" class="btn btn-secondary">Cancelar</a>
                  <input type="submit" name="grabar" value="Guardar" class="btn btn-primary">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script type="text/javascript">
    /* show file value after file select */
    $('.custom-file-input').on('change',function(e){
    $(this).next('.form-control-file').addClass("selected").html($(this).val());
    })

    /* method 2 - change file input to text input after selection
    $('.custom-file-input').on('change',function(){
      var fileName = $(this).val();
      $(this).next('.form-control-file').hide();
      $(this).toggleClass('form-control custom-file-input').attr('type','text').val(fileName);
    })
    */
  </script>
  <style>
        #customFile .custom-file-control:lang(en)::after {
      content: "Select file...";
      }

      #customFile .custom-file-control:lang(en)::before {
      content: "Click me";
      }

      /*when a value is selected, this class removes the content */
      .custom-file-control.selected:lang(en)::after {
      content: "" !important;
      }

      .custom-file {
      overflow: hidden;
      }
      .custom-file-control {
      white-space: nowrap;
      }
  </style>

  <!--Mostrar Imagen-->
  <script type="text/javascript">
  $(window).load(function(){

$(function() {
$('#exampleInputFile').change(function(e) {
    addImage(e);
   });

   function addImage(e){
    var file = e.target.files[0],
    imageType = /image.*/;

    if (!file.type.match(imageType))
     return;

    var reader = new FileReader();
    reader.onload = fileOnload;
    reader.readAsDataURL(file);
   }

   function fileOnload(e) {
    var result=e.target.result;
    $('#mifoto').attr("src",result);
   }
  });
});

  </script>
@endsection
