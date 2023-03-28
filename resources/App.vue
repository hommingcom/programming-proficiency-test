<template>
  <div id="app">
    WORK HERE
    <select id="" v-model="selectedUser">
      <option value="">Todos</option>
      <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
    </select>
    <select v-model="selectedType">
      <option value="">Todos</option>
      <option v-for="propType in propertyTypes" :key="propType.id" :value="propType.id">
        {{ propType.name }}
      </option>
    </select>

    <input type="date" v-model="rentedFrom">
    <input type="date" v-model="rentedTo">
    <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th>User</th>
        <th>Rented From</th>
        <th>Rented To</th>
        <th>Months Rented</th>
        <th>Actually Rented</th>
      </tr>
    </thead>
    <tbody>
        <tr v-for="property in filteredProperties" :key="property.id">
          <td>{{ property.name }}</td>
          <td>{{ getPropertyType(property.typeId).name }}</td>
          <td>{{ getUser(property.userId).name }}</td>
          <td>{{ formatDate(property.rentedFrom) }}</td>
          <td>{{ formatDate(property.rentedTo) }}</td>
          <td>{{ getMonthsRented(property.rentedFrom, property.rentedTo) }}</td>
          <td>{{ isPropertyRented(property.rentedFrom, property.rentedTo) }}</td>
        </tr>
      </tbody>
  </table>
  </div>
</template>
<script>
import { users, propertyTypes, properties } from '@/mocks/api';

export default {
  data() {
    return {
      filteredProperties: properties,
      selectedUser: '',
      selectedType: '',
      rentedFrom: '',
      rentedTo: '',
      users: users ?? '',
      propertyTypes: propertyTypes ?? '',
    };
  },
  beforeMount() {
    // Obtener parámetros de la URL
    const params = new URLSearchParams(window.location.search);

    // Obtener los valores de los parámetros
    if (params.get('user')) {
      this.selectedUser = params.get('user');
    }
    if (params.get('rentedFrom')) {
      this.rentedFrom = params.get('rentedFrom');
    }
    if (params.get('rentedTo')) {
      this.rentedTo = params.get('rentedTo');
    }
    if (params.get('propertyType')) {
      this.selectedType = params.get('propertyType');
    }
  },
  methods: {
    preparefilter() {
      console.log('filter');
      const usr = Number(this.selectedUser);
      const rFrom = this.rentedFrom;
      const rTo = this.rentedTo;
      const Ptype = Number(this.selectedType);

      this.filteredProperties = this.filterProp(usr, rFrom, rTo, Ptype);
    },
    filterProp(userId, rentedFrom, rentedTo, selectedType) {
      let returnProp = [];
      console.log(rentedFrom);
      console.log(rentedTo);
      if (!rentedTo) {
        console.log('to');
        returnProp = properties.filter((property) => (!userId || property.userId === userId)
        && (!selectedType || property.typeId === selectedType)
        && (!rentedFrom || property.rentedFrom >= new Date(rentedFrom)));
      } else if (!rentedFrom) {
        console.log('form');
        returnProp = properties.filter((property) => (!userId || property.userId === userId)
        && (!selectedType || property.typeId === selectedType)
        && (property.rentedTo !== null && property.rentedTo <= new Date(rentedTo)));
      } else {
        console.log('else');
        returnProp = properties.filter((property) => (!userId || property.userId === userId)
        && (!selectedType || property.typeId === selectedType)
        && ((!rentedFrom || rentedTo) && property.rentedFrom <= new Date(rentedTo))
        && ((!rentedTo || rentedFrom) && property.rentedTo >= new Date(rentedFrom)));
      }
      console.log(returnProp);
      return returnProp;
    },
    getPropertyType(typeId) {
      return propertyTypes.find((type) => type.id === typeId);
    },
    getUser(userId) {
      return users.find((user) => user.id === userId);
    },
    formatDate(date) {
      if (!date) {
        return '-';
      }
      const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
      return new Date(date).toLocaleDateString('es-ES', options);
    },
    getMonthsRented(rentedTo, rentedFrom) {
      if (rentedFrom && rentedTo) {
        const monthsRented = (rentedTo.getFullYear() - rentedFrom.getFullYear()) * 12;
        return Math.abs(monthsRented - rentedFrom.getMonth() + rentedTo.getMonth());
      }
      return '-';
    },
    isPropertyRented(rentedTo, rentedFrom) {
      return rentedFrom !== null && rentedTo !== null ? 'No' : 'Yes';
    },
  },
  watch: {
    selectedUser() {
      this.preparefilter();
    },
    selectedType() {
      this.preparefilter();
    },
    rentedFrom() {
      this.preparefilter();
    },
    rentedTo() {
      this.preparefilter();
    },
  },
};
</script>
