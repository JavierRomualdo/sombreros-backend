<template lang="html">
  <tr>
    <td>{{proveedor.id}}</td>
    <td>{{proveedor.empresa}}{{$proveedores->empresa}}</td>
    <td>{{proveedor.ruc}}</td>
    <td>{{proveedor.direccion}}</td>
    <td>{{proveedor.telefono}}</td>
    <td>{{proveedor.correo}}</td>
    <td>{{proveedor.fecha_ingreso}}</td>
    <td>{{proveedor.descripcion}}</td>
    <td>{{proveedor.estado}}</td>
  </tr>
</template>

<script type="text/javascript">
  export default{
    props: ['proveedor']
  }
</script>
