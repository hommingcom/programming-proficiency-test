<template>
  <div>
    <PropertyFilter @filter-changed="applyFilters" />
      <div class="table-responsive text-center mt-5">
        <table class="table table-striped">
          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Tipo</th>
              <th>Usuario</th>
              <th>Meses Alquilados</th>
              <th>Estado de Alquiler</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="property in filteredProperties" :key="property.id">
              <td>{{ property.id }}</td>
              <td>{{ property.name }}</td>
              <td>{{ property.type }}</td>
              <td>{{ property.user }}</td>
              <td>{{ property.rentedMonths.join(', ') || 'Ninguno' }}</td>
              <td :style="{ color: property.isRented ? 'red' : 'green' }">
                  {{ property.isRented ? 'Alquilada' : 'Disponible' }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
<script>
import PropertyFilter from './PropertyFilter.vue';
import properties from '../stub/properties';

export default {
  components: {
    PropertyFilter,
  },
  data() {
    return {
      filters: {
        type: '',
        user: '',
        isRented: '',
      },
      allProperties: properties,
    };
  },
  computed: {
    filteredProperties() {
      return this.allProperties.filter((property) => {
        const matchesType = this.filters.type
          ? property.type === this.filters.type
          : true;
        const matchesUser = this.filters.user
          ? property.user === this.filters.user
          : true;
        const matchesIsRented = this.filters.isRented
          ? property.isRented.toString() === this.filters.isRented
          : true;

        const matchesMonth = this.filters.rentedMonth
          ? property.rentedMonths.includes(this.filters.rentedMonth)
          : true;
        return matchesType && matchesUser && matchesIsRented && matchesMonth;
      });
    },
  },
  methods: {
    applyFilters(newFilters) {
      this.filters = newFilters;
    },
    initializeFiltersFromURL() {
      const params = new URLSearchParams(window.location.search);

      if (params.has('type')) this.filters.type = params.get('type');
      if (params.has('user')) this.filters.user = params.get('user');
      if (params.has('isRented')) this.filters.isRented = params.get('isRented');
      if (params.has('rentedMonth')) this.filters.rentedMonth = params.get('rentedMonth');
    },
  },
  mounted() {
    this.initializeFiltersFromURL();
  },
};
</script>

<style scoped>
/* Estilos para la tabla */
.table {
  width: 100%;
  margin-top: 1rem;
}

th, td {
  text-align: left;
  padding: 0.75rem;
}
</style>
