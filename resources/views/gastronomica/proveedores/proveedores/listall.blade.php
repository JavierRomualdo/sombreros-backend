<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered" id="myTable"><!--table-responsive-->

      <thead class="thead-inverse">
        <tr>
          <th rowspan="2" class="text-center">#</th>
          <th colspan="4" class="text-center">Titular Contacto</th>
          <th colspan="4" class="text-center">Segundo Contacto</th>
          <th colspan="5" class="text-center">Empresa</th>
          <th rowspan="2" class="text-center">Acciones</th>
        </tr>
        <tr>
          <th>Nombre</th>
          <th>Dni</th>
          <th>Telefono</th>
          <th>Email</th>
          <th>Nombre</th>
          <th>Dni</th>
          <th>Telefono</th>
          <th>Email</th>
          <th>Empresa</th>
          <th>Ruc</th>
          <th>Direccion</th>
          <th>Numero Cuenta</th>
          <th>Fecha Ingreso</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($proveedores as $index=>$proveedor)
          <tr class="fadeIn animated">
            <th scope="row" class="text-center">{{$proveedor->id}}</th>
            <td>{{$proveedor->titular}}</td>
            <td>{{$proveedor->dni_titular}}</td>
            <td>{{$proveedor->telefono_titular}}</td>
            <td>{{$proveedor->email_titular}}</td>
            <td>{{$proveedor->segundo_contacto}}</td>
            <td>{{$proveedor->dni_segundo}}</td>
            <td>{{$proveedor->telefono_segundo}}</td>
            <td>{{$proveedor->email_segundo}}</td>
            <td>{{$proveedor->empresa}}</td>
            <td>{{$proveedor->ruc}}</td>
            <td>{{$proveedor->direccion}}</td>
            <td>{{$proveedor->numero_cuenta}}</td>
            <td>{{$proveedor->fecha_ingreso}}</td>
            <td>
              <a href="{{action('Proveedores\ProveedorController@ver', $proveedor->id)}}" class="btn btn-outline-primary btn-sm ion-eye" title="Ver" title="Ver"></a>
              <a href="{{action('Proveedores\ProveedorController@edit', $proveedor->id)}}" class="btn btn-outline-primary btn-sm ion-edit" title="Editar" title="Editar"></a>
              <a href="{{action('Proveedores\ProveedorController@show', $proveedor->id)}}" class="btn btn-outline-primary btn-sm ion-android-delete" title="Eliminar"></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
</div>

<div class="text-center">
  {!!$proveedores->links()!!}
</div>
<!--<div class="text-center">
  { !!$proveedor->links()!!}
</div>-->
