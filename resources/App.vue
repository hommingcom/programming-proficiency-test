<template>
  <div id="app">
    <div class="filter_margin">
      <span>Filtro por usuario:</span>
      <select v-model="inputUserIdFilterSelected" v-on:change="applyFilters()">
        <option selected="selected" v-bind:value="null">Seleccione un elemento:</option>
        <option v-for="user in users" :key="user.id" v-bind:value="user.id">{{ user.name }}</option>
      </select>
    </div>
    <div class="filter_margin">
      <span>Filtro por tipo de vivienda:</span>
      <select v-model="inputPropertieTypeIdFilterSelected" v-on:change="applyFilters()">
        <option selected="selected" v-bind:value="null">Seleccione un elemento:</option>
        <option v-for="propertieType in propertyTypes" :key="propertieType.id"
                v-bind:value="propertieType.id">
          {{ propertieType.name }}
        </option>
      </select>
    </div>
    <div class="filter_margin">
      <label>From</label>
      <input type="date"
             v-model="inputDateFromFilterSelected"
             v-on:change="applyFilters()">
    </div>
    <div class="filter_margin">
      <label>To</label>
      <input type="date"
             v-model="inputDateToFilterSelected"
             v-on:change="applyFilters()">
    </div>
    <!--  FIN DE LOS INPUTS  -->
    <div class="filter_margin" v-if="!isFilterSelected()">
      <table>
        <tr>
          <th>nº de referencia</th>
          <th>Nombre del inmueble</th>
          <th>Nombre del dueño</th>
          <th>Tipo de vivienda</th>
          <th>Propiedad disponible actualmente</th>
          <th>Tiempo alquilado</th>
          <th>Alquilado desde</th>
          <th>Alquilado hasta</th>
        </tr>
        <tr v-for="propertie in properties" :key="propertie.id" style="text-align: center">
          <td>{{ propertie.id }}</td>
          <td>{{ propertie.name }}</td>
          <td>{{ getOwnerNameFromPropertie(propertie.userId) }}</td>
          <td>{{ getPropertieTypeFromId(propertie.typeId) }}</td>
          <td>{{ isPropertieCurrentlyRented(propertie) }}</td>
          <td>{{ diffBeteweenRentedDates(propertie) }}</td>
          <td>{{ printRentedFrom(propertie) }}</td>
          <td>{{ printRentedTo(propertie) }}</td>
        </tr>
      </table>
    </div>
    <div class="filter_margin" v-else-if="propertiesFiltered.length > 0">
      <table>
        <tr>
          <th>nº de referencia</th>
          <th>Nombre del inmueble</th>
          <th>Nombre del dueño</th>
          <th>Tipo de vivienda</th>
          <th>Propiedad disponible actualmente</th>
          <th>Tiempo alquilado</th>
          <th>Alquilado desde</th>
          <th>Alquilado hasta</th>
        </tr>
        <tr v-for="propertie in propertiesFiltered" :key="propertie.id"
            style="text-align: center">
          <td>{{ propertie.id }}</td>
          <td>{{ propertie.name }}</td>
          <td>{{ getOwnerNameFromPropertie(propertie.userId) }}</td>
          <td>{{ getPropertieTypeFromId(propertie.typeId) }}</td>
          <td>{{ isPropertieCurrentlyRented(propertie) }}</td>
          <td>{{ diffBeteweenRentedDates(propertie) }}</td>
          <td>{{ printRentedFrom(propertie) }}</td>
          <td>{{ printRentedTo(propertie) }}</td>
        </tr>
      </table>
    </div>
    <div class="filter_margin" v-else-if="propertiesFiltered.length === 0 && isFilterSelected">
      <p>No hay resultados para mostrar con el filtro de busqueda actual.</p>
    </div>
    <div class="filter_margin" v-else>
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
      if ((propertie.rentedFrom === null && propertie.rentedTo === null)
        || (moment(propertie.rentedTo) < moment.now())) {
        return '✓';
      }
      return '⨯';
    },
    printRentedFrom(propertie) {
      if (propertie.rentedFrom !== null) {
        const year = propertie.rentedFrom.getFullYear();
        const month = (propertie.rentedFrom.getMonth() + 1) < 10
          ? `0${propertie.rentedFrom.getMonth() + 1}` : propertie.rentedFrom.getMonth();
        const day = propertie.rentedFrom.getDate() < 10
          ? `0${propertie.rentedFrom.getDate()}` : propertie.rentedFrom.getDate();
        return `${year}/${month}/${day}`;
      }
      return '';
    },
    printRentedTo(propertie) {
      if (propertie.rentedTo !== null) {
        const year = propertie.rentedTo.getFullYear();
        const month = (propertie.rentedTo.getMonth() + 1) < 10
          ? `0${propertie.rentedTo.getMonth() + 1}` : propertie.rentedTo.getMonth();
        const day = propertie.rentedTo.getDate() < 10
          ? `0${propertie.rentedTo.getDate()}` : propertie.rentedTo.getDate();
        return `${year}/${month}/${day}`;
      }
      return '';
    },
    diffBeteweenRentedDates(propertie) {
      if (propertie.rentedFrom !== null && propertie.rentedTo !== null
        && moment(propertie.rentedTo) > moment.now()) {
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
          const filterOkey = [];
          filtersUsed.forEach((filter) => {
            if (filter.name === 'userId' && propertie.userId === filter.value) {
              filterOkey.push(true);
            } else if (filter.name === 'typeId' && propertie.typeId === filter.value) {
              filterOkey.push(true);
            } else if (filter.name === 'rentedFrom') {
              if (propertie.rentedFrom === null) {
                filterOkey.push(true);
              } else if (propertie.rentedTo !== null
                && (moment(filter.value) >= moment(propertie.rentedTo)
                  || moment(filter.value) < moment(propertie.rentedFrom))) {
                filterOkey.push(true);
              }
            } else if (filter.name === 'rentedTo') {
              if (propertie.rentedFrom === null) {
                filterOkey.push(true);
              } else if (propertie.rentedTo !== null
                && (moment(filter.value) >= moment(propertie.rentedTo
                  || moment(filter.value) < moment(propertie.rentedFrom)))) {
                filterOkey.push(true);
              }
            }
          });
          return filterOkey.length === filtersUsed.length;
        });
      }
    },
  },
};
</script>
<style scoped>
.filter_margin {
  margin-top: 0.5em;
}
</style>
