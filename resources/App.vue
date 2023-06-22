<template>
  <div id="app">
  <section class="inputOptionsSection">
    <div class=" btn-container">
      <input type="text" v-model="searchText" placeholder="Search">
      <button class="buttonBase btn_search" @click="handleFilter" >
        <font-awesome-icon :icon="faSearch" />
      </button>
    </div>
    <button class="buttonBase btn_clear" @click="handleClear" >
      Clear
    </button>
  </section>
    <table class="striped centered">
        <thead class="table-head">
          <tr class="tableTitle">
              <th>Properties</th>
              <th>Months Rented</th>
              <th>Currently</th>
          </tr>
        </thead>

        <tbody class="table-body">
          <!-- Primero un for para pasar por cada propiedad y tomar los datos correspondientes -->
          <tr v-for="property in filteredProperty" :key="property.id">
            <td>{{ property.name }}</td>
            <td>{{ getMonthsRented(property) }}</td>
            <td>{{ getIsRented(property) }}</td>
          </tr>
        </tbody>
      </table>
  </div>
</template>

<script>

import dayjs from 'dayjs';
import { users, propertyTypes, properties } from '@/mocks/api';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faSearch } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(faSearch);

export default {
  name: 'App',

  components: {
    FontAwesomeIcon,
  },

  mounted() {
    this.$nextTick(function () {
      const urlParams = new URLSearchParams(window.location.search);
      const getUser = urlParams.get('user');
      const getType = urlParams.get('type');

      if (getUser !== null) {
        this.searchText = getUser;
        this.handleFilter();
      } else if (getType !== null) {
        this.searchText = getType;
        this.handleFilter();
      }
    });
  },

  data: () => ({
    users,
    propertyTypes,
    properties,
    searchText: '',
    filteredProperty: [...properties],
    faSearch,
  }),

  methods: {
    getMonthsRented(property) {
      if (!property.rentedFrom) {
        return 0;
      }

      const rentedFrom = new Date(property.rentedFrom);
      const rentedTo = property.rentedTo === null ? dayjs(new Date()) : dayjs(property.rentedTo);
      const months = rentedTo.diff(rentedFrom.toISOString(), 'month', true);
      if (months > 0 && months < 1) {
        return 'Less than a month';
      }

      const totalMonths = Math.floor(months);

      return totalMonths;
    },

    getIsRented(property) {
      if (!property.rentedFrom || property.rentedTo) {
        return 'False';
      }

      return 'True';
    },

    handleClear() {
      this.filteredProperty = [...this.properties];
      this.searchText = '';
    },

    handleFilter() {
      // conseguir los userId si son iguales al string
      // conseguir los typeId si son iguales al string
      // retornar los userId y typeId que coinciden con los de properties
      // volver a minusculas y quitar espacios en el searchbar para evitar errores

      const searchedData = this.searchText.trim().toLowerCase();

      if (!searchedData) {
        this.filteredProperty = [...this.properties];
        return;
      }

      const filteredProperties = this.properties.filter((property) => {
        const user = this.users.find((user) => user.id === property.userId);
        const type = this.propertyTypes.find((type) => type.id === property.typeId);

        if (user && (user.name.toLowerCase().includes(searchedData) || user.id.toString() === searchedData)) {
          return true;
        }

        if (type && type.name.toLowerCase().includes(searchedData)) {
          return true;
        }

        return false;
      });

      this.filteredProperty = filteredProperties;
    },

  },

};
</script>
