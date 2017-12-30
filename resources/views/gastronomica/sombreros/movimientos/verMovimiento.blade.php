@extends('layouts.master')
@section('title','nuevoMovimiento')
@section('content')
  <div class="breadcrumb-holder">
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/gastronomica/proveedores/proveedores/proveedor')}}">Proveedor</a></li>
        <li class="breadcrumb-item active">Ver movimiento</li>
      </ul>
    </div>
  </div>
  <section class="forms">
    <div class="container-fluid">
      <header>
        <h1 class="h3">Ver movimiento</h1>
      </header>
      <div class="row">
        <div class="col-lg-12">

              <form class="form-horizontal" id="form">

                <div class="form-group row">
                  <label class="col-sm-2 form-control-label" for="cantidad"><strong>Código</strong></label>
                  <div class="col-sm-10">
                    <input type="text" id="cantidad" name="codigo" class="form-control" maxlength="2">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label" for="modelo"><strong>Modelo</strong></label>
                  <div class="col-sm-10">
                    <select class="" name="">
                      <option value="">Modelo</option>
                      <option>de la bd</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label" for="material"><strong>Material</strong></label>
                  <div class="col-sm-10">
                    <select class="" name="">
                      <option value="">Material</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label" for="tejido"><strong>Tejido</strong></label>
                  <div class="col-sm-10">
                    <select class="" name="">
                      <option value="">Tejido</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label" for="publico"><strong>Público</strong></label>
                  <div class="col-sm-10">
                    <select class="" name="">
                      <option value="">Público</option>
                      <option>de la bd</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label" for="talla"><strong>Talla</strong></label>
                  <div class="col-sm-10">
                    <select class="" name="">
                      <option value="">Talla</option>
                      <option>de la bd</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label" for="proveedor"><strong>Proveedor</strong></label>
                  <div class="col-sm-10">
                    <select class="" name="">
                      <option value="">Proveedor</option>
                      <option>de la bd</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 form-control-label" for="stock_actual"><strong>Stock Actual</strong></label>
                  <div class="col-sm-10">
                    <input type="text" id="stock_actual" name="stock_actual" class="form-control" maxlength="2">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-4 offset-sm-2">
                    <a href="{{url('/gastronomica/proveedores/proveedores/proveedor')}}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" id="imprimirDetalleMovimiento" class="btn btn-primary">Imprimir</button>
                  </div>
                </div>
              </form>
              <!--<ul id="pagination" class="pagination-sm"></ul>-->
        </div>
      </div>

      <div class="section">
        <h3>Movimientos del sombrero con codigo { {codigo} }</h3>
        <br>
        <button type="button" name="button" class="margenInf">Imprimir</button>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha</th>
              <th>Tipo</th>
              <th>Cantidad</th>
              <th>Precio</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
@endsection
