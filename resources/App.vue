<template>
  <div id="app">
    <table v-if="properties !== undefined">
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
        <td>{{propertie.name}}</td>
        <td>{{getOwnerNameFromPropertie(propertie.userId)}}</td>
        <td>{{getPropertieTypeFromId(propertie.typeId)}}</td>
        <td>{{isPropertieCurrentlyRented(propertie)}}</td>
        <td>{{diffBeteweenRentedDates(propertie)}}</td>
      </tr>
    </table>
  </div>
</template>

<script>
import moment from 'moment';
import { properties, propertyTypes, users } from '@/mocks/api';

export default {
  name: 'App',
  data: () => ({
    users,
    propertyTypes,
    properties,
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
        if (dayDiffs > 1) {
          return dayDiffs === 1 ? `${dayDiffs} día` : `${dayDiffs} días`;
        }
      }
      return '';
    },
  },
  mounted() {
  },
};
</script>
