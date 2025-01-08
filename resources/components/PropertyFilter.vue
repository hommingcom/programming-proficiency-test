<template>
    <div class="filters container mt-3">
      <div class="text-center row">
        <div class="filter-item col-md-3">
          <label for="property-type" class="fw-bold">Tipo de propiedad</label>
          <select v-model="filters.type" id="property-type" class="form-control">
            <option value=''>Todos</option>
            <option v-for="type in propertyTypes" :key="type" :value="type">{{ type }}</option>
          </select>
        </div>

        <div class="filter-item col-md-3">
          <label for="user" class="fw-bold">Usuario</label>
          <select v-model="filters.user" id="user" class="form-control">
            <option value=''>Todos</option>
            <option v-for="user in propertyUsers" :key="user" :value="user">{{ user }}</option>
          </select>
        </div>

        <div class="filter-item col-md-3">
          <label for="is-rented" class="fw-bold">Alquilada</label>
          <select v-model="filters.isRented" id="is-rented" class="form-control">
            <option value=''>Todas</option>
            <option value="true">Sí</option>
            <option value="false">No</option>
          </select>
        </div>

        <div class="filter-item col-md-3">
          <label for="months" class="fw-bold">Meses Alquilados</label>
          <select
            id="months"
            v-model="filters.rentedMonth"
            class="form-control"
          >
          <option value="">Todos</option>
          <option v-for="month in months" :key="month" :value="month">{{ month }}</option>
          </select>
        </div>
      </div>
    </div>
  </template>

<script>
import properties from '../stub/properties';

export default {
  data() {
    return {
      filters: {
        type: '',
        user: '',
        isRented: '',
        rentedMonth: '',
      },
      propertyTypes: [...new Set(properties.map((property) => property.type))],
      propertyUsers: [...new Set(properties.map((property) => property.user))],
      months: [
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre',
      ],
    };
  },
  watch: {
    filters: {
      handler() {
        this.$emit('filter-changed', this.filters);
      },
      deep: true,
    },
  },
};
</script>
