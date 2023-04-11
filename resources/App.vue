<template>
  <div id="app">
  <div class="btn-container">
    <input type="text" v-model="searchText">
    <button @click="handleFilter" >Filter</button>
  </div>
    <table class="striped centered">
        <thead class="table-head">
          <tr>
              <th>Properties</th>
              <th>Month Rented</th>
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

export default {
  name: 'App',

  mounted() {
    this.$nextTick(function () {
      const urlParams = new URLSearchParams(window.location.search);
      const getUser = urlParams.get('user');

      if (getUser) {
        this.searchText = getUser;
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

    handleFilter() {
      // conseguir los userId si son iguales al string
      // conseguir los typeId si son iguales al string
      // retornar los userId y typeId que coinciden con los de properties

      if (this.searchText === '' || this.searchText === null || this.searchText === undefined) {
        this.filteredProperty = [...this.properties];
        return;
      }

      const user = this.users.find((users) => users.name.toLowerCase().includes(this.searchText.toLowerCase()) || users.id === parseInt(this.searchText));

      const type = this.propertyTypes.find((propertyTypes) => propertyTypes.name.toLowerCase().includes(this.searchText.toLowerCase()));

      if (user) {
        this.filteredProperty = this.properties.filter((property) => property.userId === user.id);
      }

      if (type) {
        this.filteredProperty = this.properties.filter((property) => property.typeId === type.id);
      }
    },
  },

};
</script>
