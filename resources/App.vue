<template>
  <div id="app">
    <span>Filtro por usuario:</span>
    <select v-model="inputUserIdFilterSelected" v-on:change="applyFilters()">
      <option selected="selected" v-bind:value="null">Seleccione un elemento:</option>
      <option v-for="user in users" :key="user.id" v-bind:value="user.id">{{ user.name }}</option>
    </select>
    <br>
    <span>Filtro por tipo de vivienda:</span>
    <select v-model="inputPropertieTypeIdFilterSelected" v-on:change="applyFilters()">
      <option selected="selected" v-bind:value="null">Seleccione un elemento:</option>
      <option v-for="propertieType in propertyTypes" :key="propertieType.id"
              v-bind:value="propertieType.id">
        {{ propertieType.name }}
      </option>
    </select>
    <br>
    <label>From</label>
    <input type="date"
           v-model="inputDateFromFilterSelected"
           v-on:change="applyFilters()">
    <br>
    <label>To</label>
    <input type="date"
           v-bind:value="inputDateToFilterSelected"
           v-on:change="applyFilters()">
    <!--  FIN DE LOS INPUTS  -->
    <div v-if="!isFilterSelected()">
      <table>
        <tr>
          <th>nº de referencia</th>
          <th>Nombre del inmueble</th>
          <th>Nombre del dueño</th>
          <th>Tipo de vivienda</th>
          <th>Propiedad disponible</th>
          <th>Tiempo alquilado</th>
        </tr>
        <tr v-for="propertie in properties" :key="propertie.id">
          <td>{{ propertie.id }}</td>
          <td>{{ propertie.name }}</td>
          <td>{{ getOwnerNameFromPropertie(propertie.userId) }}</td>
          <td>{{ getPropertieTypeFromId(propertie.typeId) }}</td>
          <td>{{ isPropertieCurrentlyRented(propertie) }}</td>
          <td>{{ diffBeteweenRentedDates(propertie) }}</td>
        </tr>
      </table>
    </div>
    <div v-else-if="propertiesFiltered.length > 0">
      <table>
        <tr>
          <th>nº de referencia</th>
          <th>Nombre del inmueble</th>
          <th>Nombre del dueño</th>
          <th>Tipo de vivienda</th>
          <th>Propiedad disponible</th>
          <th>Tiempo alquilado</th>
        </tr>
        <tr v-for="propertie in propertiesFiltered" :key="propertie.id">
          <td>{{ propertie.id }}</td>
          <td>{{ propertie.name }}</td>
          <td>{{ getOwnerNameFromPropertie(propertie.userId) }}</td>
          <td>{{ getPropertieTypeFromId(propertie.typeId) }}</td>
          <td>{{ isPropertieCurrentlyRented(propertie) }}</td>
          <td>{{ diffBeteweenRentedDates(propertie) }}</td>
        </tr>
      </table>
    </div>
    <div v-else-if="propertiesFiltered.length === 0 && isFilterSelected">
      <p>No hay resultados para mostrar con el filtro de busqueda actual.</p>
    </div>
    <div v-else>
      <p>Ha ocurrido un error inesperado.</p>
    </div>
  </div>
</template>

<script>
import moment from 'moment';
import { properties, propertyTypes, users } from '@/mocks/api';

const inputUserIdFilterSelected = null;
const inputPropertieTypeIdFilterSelected = null;
const inputDateFromFilterSelected = null;
const inputDateToFilterSelected = null;
const propertiesFiltered = [];

export default {
  name: 'App',
  data: () => ({
    users,
    propertyTypes,
    properties,
    propertiesFiltered,
    inputUserIdFilterSelected,
    inputPropertieTypeIdFilterSelected,
    inputDateFromFilterSelected,
    inputDateToFilterSelected,
  }),
  methods: {
    getOwnerNameFromPropertie(userId) {
      const userObject = this.users.find((user) => user.id === userId);
      return userObject !== undefined ? userObject.name : '';
    },
    getPropertieTypeFromId(propertyTypeId) {
      const propertieObject = this.propertyTypes.find(
        (propertieType) => propertieType.id === propertyTypeId,
      );
      return propertieObject !== undefined ? propertieObject.name : '';
    },
    isPropertieCurrentlyRented(propertie) {
      return propertie.rentedFrom === null && propertie.rentedTo === null;
    },
    diffBeteweenRentedDates(propertie) {
      if (propertie.rentedFrom !== null && propertie.rentedTo !== null) {
        const momentRentedFrom = moment(propertie.rentedFrom);
        const momentRentedTo = moment(propertie.rentedTo);

        const yearsDiff = momentRentedTo.diff(momentRentedFrom, 'years');
        const monthsDiff = momentRentedTo.diff(momentRentedFrom, 'months');
        const dayDiffs = momentRentedTo.diff(momentRentedFrom, 'days');
        if (yearsDiff > 0) {
          return yearsDiff === 1 ? `${yearsDiff} año` : `${yearsDiff} años`;
        }
        if (monthsDiff > 0) {
          return monthsDiff === 1 ? `${monthsDiff} mes` : `${monthsDiff} meses`;
        }
        if (dayDiffs > 0) {
          return dayDiffs === 1 ? `${dayDiffs} día` : `${dayDiffs} días`;
        }
      }
      return '';
    },
    isFilterSelected() {
      return this.inputUserIdFilterSelected !== null
        || this.inputPropertieTypeIdFilterSelected !== null
        || this.inputDateFromFilterSelected !== null
        || this.inputDateToFilterSelected !== null;
    },
    applyFilters() {
      this.propertiesFiltered = [];
      const filtersUsed = [];
      if (this.inputDateFromFilterSelected === '') {
        this.inputDateFromFilterSelected = null;
      }
      if (this.inputDateToFilterSelected === '') {
        this.inputDateToFilterSelected = null;
      }
      if (this.inputUserIdFilterSelected !== null) {
        filtersUsed.push({
          name: 'userId',
          value: this.inputUserIdFilterSelected,
        });
      }

      if (this.inputPropertieTypeIdFilterSelected !== null) {
        filtersUsed.push({
          name: 'typeId',
          value: this.inputPropertieTypeIdFilterSelected,
        });
      }

      if (this.inputDateFromFilterSelected !== null) {
        filtersUsed.push({
          name: 'rentedFrom',
          value: this.inputDateFromFilterSelected,
        });
      }

      if (this.inputDateToFilterSelected !== null) {
        filtersUsed.push({
          name: 'rentedTo',
          value: this.inputDateToFilterSelected,
        });
      }

      if (this.isFilterSelected) {
        this.propertiesFiltered = this.properties.filter((propertie) => {
          let filterOkey = false;
          filtersUsed.forEach((filter) => {
            if (filter.name === 'userId') {
              if (propertie.userId === filter.value) {
                filterOkey = true;
              }
            } else if (filter.name === 'typeId') {
              if (propertie.typeId === filter.value) {
                filterOkey = true;
              }
            } else if (filter.name === 'rentedFrom') {
              if (moment(propertie.rentedFrom) <= moment(filter.value)) {
                filterOkey = true;
              }
            } else if (filter.name === 'rentedTo') {
              if (moment(propertie.rentedTo) <= moment(filter.value)) {
                filterOkey = true;
              }
            }
            filterOkey = false;
          });
          return filterOkey;
        });
      }
    },
  },
};
</script>
