@if (count($errors)>0)
  <div class='alert alert-danger alert-dismissible fade show fadeIn animated' role='alert'>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>Errores:</strong>
    <div class="container">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
  </div>
@endif
@if (Session::has('update'))
  <div class="alert alert-success alert-dismissible fade show fadeIn animated" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{Session::get('update')}}</strong>
  </div>
@endif
@if (Session::has('delete'))
  <div class="alert alert-success alert-dismissible fade show fadeIn animated" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{Session::get('delete')}}</strong>
  </div>
@endif
@if (Session::has('save'))
  <div class="alert alert-success alert-dismissible fade show fadeIn animated" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{Session::get('save')}}</strong>
  </div>
@endif
@if (Session::has('error'))
  <div class="alert alert-success alert-dismissible fade show fadeIn animated" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{Session::get('error')}}</strong>. Existe Movimientos de este artículo registrados en el sistema.
  </div>
@endif
@if (Session::has('error-modelo'))
  <div class="alert alert-success alert-dismissible fade show fadeIn animated" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{Session::get('error-modelo')}}</strong>. El modelo esta asociado a un sombrero.
  </div>
@endif
@if (Session::has('error-material'))
  <div class="alert alert-success alert-dismissible fade show fadeIn animated" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{Session::get('error-material')}}</strong>. El material esta asociado a un sombrero.
  </div>
@endif
@if (Session::has('error-tejido'))
  <div class="alert alert-success alert-dismissible fade show fadeIn animated" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{Session::get('error-tejido')}}</strong>. El tejido esta asociado a un sombrero.
  </div>
@endif
@if (Session::has('error-talla'))
  <div class="alert alert-success alert-dismissible fade show fadeIn animated" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{Session::get('error-talla')}}</strong>. La talla esta asociado a un sombrero.
  </div>
@endif
@if (Session::has('error-publico'))
  <div class="alert alert-success alert-dismissible fade show fadeIn animated" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{Session::get('error-publico')}}</strong>. El publico dirigido esta asociado a un sombrero.
  </div>
@endif
@if (Session::has('error-proveedor'))
  <div class="alert alert-success alert-dismissible fade show fadeIn animated" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{Session::get('error-proveedor')}}</strong>. El proveedor esta asociado a un sombrero.
  </div>
@endif
