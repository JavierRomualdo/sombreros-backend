<template lang="html">
  <div class="">
    <form v-on:submit.prevent="createProveedor" method="post">
      <div class="form-group">
        <input type="text" v-model="proveedor.empresa" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" v-model="proveedor.ruc" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" v-model="proveedor.direccion" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" v-model="proveedor.telefono" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" v-model="proveedor.correo" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" v-model="proveedor.fecha_ingreso" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" v-model="proveedor.descripcion" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" v-model="proveedor.estado" class="form-control">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">New Proveedor</button>
      </div>
    </form>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Empresa</th>
          <th>Ruc</th>
          <th>Direccion</th>
          <th>Telefono</th>
          <th>Correo</th>
          <th>Fecha Ingreso</th>
          <th>Descripcion</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <Proveedor v-for="proveedor in proveedores" v-bind:proveedor="proveedor">
        </Proveedor>
      </tbody>
    </table>
  </div>
</template>
<script type="text/javascript">
  import Proveedor from './Proveedor.vue';
  export default{
    data(){
      return {
        proveedores: [],
        proveedor:{
          empresa: '',
          ruc: '',
          direccion: '',
          telefono: '',
          correo: '',
          fecha_ingreso: '',
          descripcion: '',
          estado: ''
        }
      }
    },
    components: {Proveedor},
    created(){
      this.fetchProveedores();
    },
    methods:{
      fetchProveedores(){
        this.$http.get('/gastronomica/proveedores/proveedores/proveedor').then(response => {
          this.proveedores = response.data.proveedores;
        });
      },
      createProveedor(){
        this.$http.post('/gastronomica/proveedores/proveedores/proveedor/', this.proveedor).then(
          response=>{
            this.proveedores.push(response.data.user);
            console.log(response.data);
          }
        );
      }
    }
  }
</script>
