<template>
  <div id="app">
    <h1 class="text-3xl font-bold underline">Hello world</h1>
    <input type="text" v-model="searchText">
  <div>
    <button @click="handleFilter" >Filter</button>
  </div>
    <table class="striped centered">
        <thead>
          <tr>
              <th>Properties</th>
              <th>Month Rented</th>
              <th>Currently</th>
          </tr>
        </thead>

        <tbody>
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
import { users, propertyTypes, properties } from './mocks/apis.js';

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
        return 'not rented';
      }

      const rentedFrom = new Date(property.rentedFrom);
      const rentedTo = property.rentedTo === null ? dayjs(new Date()) : dayjs(property.rentedTo);
      const months = Math.round(rentedTo.diff(rentedFrom.toISOString(), 'month', true));
      return months;
    },

    getIsRented(property) {
      if (!property.rentedFrom || property.rentedTo) {
        return 'Not Rented';
      }

      return 'Rented';
    },

    handleFilter() {
      // conseguir los userId si son iguales al string
      // conseguir los typeId si son iguales al string
      // retornar los userId y typeId que coinciden con los de properties

      if (!this.searchText) {
        this.filteredProperty = [...properties];
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
