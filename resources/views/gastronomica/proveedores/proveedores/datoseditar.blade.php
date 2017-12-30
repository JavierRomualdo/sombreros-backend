@extends('layouts.master')
@section('title','Proveedores')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/proveedores/proveedores/proveedor')}}">Proveedor</a></li>
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/proveedores/proveedores/datoseditar')}}">Datos</a></li>
        <li class="breadcrumb-item active">Editar Obligatoriedad</li>
      </ul>
    </div>
  </div><br/>
@endsection
