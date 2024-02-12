<template>
  <div id="app">
    <input type="text" v-model="searchPropertyName" placeholder="Property Name"/>
    <table>
      <thead>
      <tr>
        <th>Property ID</th>
        <th>Property Name</th>
        <th>Property Type</th>
        <th>User Name</th>
        <th>Months Rented</th>
        <th>Property Rented</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(property,key) in properties" :key="key">
        <td>{{ property.id }}</td>
        <td>{{ property.name }}</td>
        <td>{{ getPropertyType(property.typeId) }}</td>
        <td>{{ getUserName(property.userId) }}</td>
        <td>{{ getQuantityMonths(property.rentedFrom, property.rentedTo) }}</td>
        <td>{{ property.rentedTo === null }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';

export default {
  name: 'App',
  data: () => ({
    users,
    propertyTypes,
    searchPropertyName: '',
  }),
  methods: {
    getUserName(idUser) {
      return users.find((user) => user.id === idUser)?.name;
    },
    getPropertyType(idType) {
      return propertyTypes.find((propertyType) => propertyType.id === idType)?.name;
    },
    getQuantityMonths(dateFrom, dateTo) {
      if (dateTo && dateFrom) {
        let diffMonth = (dateTo.getFullYear() - dateFrom.getFullYear()) * 12;
        diffMonth += dateTo.getMonth() - dateFrom.getMonth();
        return diffMonth;
      }
      return '';
    },
  },
  computed: {
    properties() {
      return properties.filter(
        (property) => property.name.toUpperCase().includes(this.searchPropertyName.toUpperCase()),
      );
    },
  },
};
</script>
