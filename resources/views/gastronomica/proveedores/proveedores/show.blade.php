@extends('layouts.master')
@section('title','Sombreros')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/proveedores/proveedores/proveedor')}}">Proveedor</a></li>
        <li class="breadcrumb-item active">Eliminar Proveedor</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <div class="row">
        <div class="offset-lg-3 col-lg-6">
          <br/>
          <div class="card miBorder">
            <div class="card-header d-flex align-items-center">
              <h2 class="h1 display display"><strong style="color:#f00">Eliminar:</strong></h2>
            </div>
            <div class="card-block">
              <p>¿Desea eliminar el tejido de sombrero?.</p>
              {!!Form::open(['action'=>['Proveedores\ProveedorController@destroy',$proveedor->id],'method'=>'DELETE'])!!}
              <div class="form-group">
                <strong>{!!form::label('Nombres:',null,['for'=>'nombres'])!!}</strong>
                {!!$proveedor->nombres!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Apellidos:',null,['for'=>'apellidos'])!!}</strong>
                {!!$proveedor->apellidos!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Dni:',null,['for'=>'dni'])!!}</strong>
                {!!$proveedor->dni!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Empresa:',null,['for'=>'empresa'])!!}</strong>
                {!!$proveedor->empresa!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Ruc:',null,['for'=>'ruc'])!!}</strong>
                {!!$proveedor->ruc!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Direccion:',null,['for'=>'direccion'])!!}</strong>
                {!!$proveedor->direccion!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Telefono:',null,['for'=>'telefono'])!!}</strong>
                {!!$proveedor->telefono!!}
              </div>
              <div class="form-group">
                <strong>{!!form::label('Email:',null,['for'=>'correo'])!!}</strong>
                {!!$proveedor->correo!!}
              </div>
              <div class="form-group">
                <a href="{{url('/gastronomica/proveedores/proveedores/proveedor')}}" class="btn btn-secondary">Cancelar</a>
                {!!form::submit('Eliminar',['name'=>'grabar','id'=>'grabar','content'=>'<span class="glyphicon glyphicon-floppy-disk">Eliminar</span>','class'=>'btn
                  btn-danger'])!!}
              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
