<template>
  <div id="app">
    WORK HERE
    <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th>User</th>
        <th>Rented From</th>
        <th>Rented To</th>
        <th>Months Rented</th>
        <th>Currently Rented</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="property in properties" :key="property.id">
        <td>{{ property.name }}</td>
        <td>{{ getPropertyType(property.typeId).name }}</td>
        <td>{{ getUser(property.userId).name }}</td>
        <td>{{ formatDate(property.rentedFrom) }}</td>
        <td>{{ formatDate(property.rentedTo) }}</td>
        <td>{{ getMonthsRented(property) }}</td>
        <td>{{ isCurrentlyRented(property) }}</td>
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
      properties,
      users,
      propertyTypes,
    };
  },
  methods: {
    getPropertyType(typeId) {
      return this.propertyTypes.find((type) => (type.id === typeId));
    },
    getUser(userId) {
      return this.users.find((user) => (user.id === userId));
    },
    formatDate(date) {
      if (!date) return '-';
      return new Intl.DateTimeFormat('en-US').format(new Date(date));
    },
    getMonthsRented(property) {
      if (!property.rentedFrom || !property.rentedTo) return '-';
      const yearDiff = (property.rentedTo.getFullYear() - property.rentedFrom.getFullYear());
      const monthDiff = (property.rentedTo.getMonth() - property.rentedFrom.getMonth());
      const diffInMonths = yearDiff * 12 + monthDiff + 1;
      return diffInMonths;
    },
    isCurrentlyRented(property) {
      return !!(property.rentedFrom && !property.rentedTo);
    },
  },
};
</script>
