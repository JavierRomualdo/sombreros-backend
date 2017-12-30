$(document).ready(function(){
  //get URL
  var url = $('#url').val();

  //
  $('#btn_add').click(function(){
    $('#btn-save').val("add");
    $('#frmProveedores').trigger("reset");
    $('#myModal').modal('show');
  });

  //edit
  $(document).on('click', '.open_modal', function(){
    var proveedor_id = $(this).val();

    $.ajax({
      type: "GET",
      url: url+'/'+proveedor_id,
      success: function(data){
        console.log(data);
        $('#proveedor_id').val(data.id);
        $('#empresa').val(data.empresa);
        $('ruc').val(data.ruc);
        $('direccion').val(data.direccion);
        $('telefono').val(data.telefono);
        $('correo').val(data.correo);
        $('fecha_ingreso').val(data.fecha_ingreso);
        $('estado').val(data.estado);
        $('descripcion').val(data.descripcion);
      },
      error: function(data){
        console.log('Error:', data);
      }
    });
  });

  //create new proveedor / update existing proveedor
  $("#btn-save").click(function(e){

  });

});
