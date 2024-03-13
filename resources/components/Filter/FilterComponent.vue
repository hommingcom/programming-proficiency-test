<template>
  <div class="w-full flex flex-wrap items-center gap-4">
    <input placeholder="Buscar usuario en la tabla..." class="form-control"
    @keyup="handleInputSearch"/>
    <select class="form-control" v-if="types && types.length>0"
    @change="handleSelectSearch">
      <option value="">Tipo de Propiedad</option>
      <option v-for="(type, index) of types" :key="index">{{type.name}}</option>
    </select>
    <select class="form-control"
    @change="handleSelectStatusSearch">
      <option value="">Estado</option>
      <option value="Disponible">Disponible</option>
      <option value="Alquilada">Alquilada</option>
    </select>
    <div class="flex flex-col ml-auto">
      <div class="flex gap-2">
        <input type="date" placeholder="Desde" class="form-control" @change="handleDateFrom"/>
        <input type="date" placeholder="Hasta" class="form-control" @change="handleDateTo"/>
      </div>
    </div>
  </div>
</template>
<script>
import { propertyTypes } from '@/mocks/api';

export default {
  name: 'FilterComponent',
  data: () => ({
    types: propertyTypes,
  }),
  methods: {
    handleInputSearch(e) {
      const txt = e.target.value;

      this.$emit('searchInput', { type: 'input', txt });
    },
    handleSelectSearch(e) {
      const txt = e.target.value;

      this.$emit('searchSelect', { type: 'select', txt });
    },
    handleSelectStatusSearch(e) {
      const txt = e.target.value;

      this.$emit('searchSelect', { type: 'select_status', txt });
    },
    handleDateFrom(e) {
      const date = new Date(e.target.value);

      this.$emit('searchSelect', { type: 'dateFrom', txt: date });
    },
    handleDateTo(e) {
      const date = new Date(e.target.value);
      this.$emit('searchSelect', { type: 'dateTo', txt: date });
    },
  },
};
</script>
<style scoped>
  .form-control{
    padding:5px 10px;
    border:none;
    outline:none;
    border-radius:5px;
    border:1px solid #fff2;
    box-shadow: 0 0 13px #0001;
    background:#333;
    color:#fff;
  }
</style>
