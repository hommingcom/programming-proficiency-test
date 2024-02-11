<template>
    <div id="main">
        <div class="filters">
      <label for="userFilter">User:</label>
      <select id="userFilter" v-model="filters.userType">
        <option value="">All</option>
        <option v-for="user in users" :value="user.id" :key="user.id">{{ user.name }}</option>
      </select>
      
      <label for="typeFilter">Property Type:</label>
      <select id="typeFilter" v-model="filters.propertyType">
        <option value="">All</option>
        <option v-for="type in propertyTypes" :value="type.id" :key="type.id">{{ type.name }}</option>
      </select>
      
      <label for="startDateFilter">Start Date:</label>
      <input type="date" id="startDateFilter" v-model="filters.startDate">
      <label for="endDateFilter">End Date:</label>
      <input type="date" id="endDateFilter" v-model="filters.endDate">
    </div>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>User</th>
          <th>Type</th>
          <th>Rented From</th>
          <th>Rented To</th>
          <th>Months Rented</th>
          <th>Currently Rented</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="property in filteredProperties" :key="property.id">
          <td>{{ property.name }}</td>
          <td>{{ getUser(property.userId).name }}</td>
          <td>{{ getPropertyType(property.typeId).name }}</td>
          <td>{{ property.rentedFrom ? formatDate(property.rentedFrom) : 'Not rented' }}</td>
          <td>{{ property.rentedTo ? formatDate(property.rentedTo) : !property.rentedFrom ? '-' : 'Still renting' }}</td>
          <td>{{ calculateMonthsRented(property) }}</td>
          <td>{{ isCurrentlyRented(property) }}</td>
        </tr>
      </tbody>
    </table>
    </div>
  </template>
  
  <script>
  import { users, propertyTypes, properties } from '../mocks/api';
  
  export default {
    name: 'Main',
    data : () => ({
      users,
      propertyTypes,
      properties,
      filters: {
        userType: null,
        propertyType: null,
        startDate: null,
        endDate: null,
      },
    }),
    computed: {
        filteredProperties() {
            let filteredProps = this.properties;
            if (this.filters.userType) {
                filteredProps = filteredProps.filter(prop => prop.userId === parseInt(this.filters.userType));
            }
            if (this.filters.propertyType) {
                filteredProps = filteredProps.filter(prop => prop.typeId === parseInt(this.filters.propertyType));
            }
            if (this.filters.startDate) {
                filteredProps = filteredProps.filter(prop => new Date(prop.rentedFrom) >= new Date(this.filters.startDate));
            }
            if (this.filters.endDate) {
                filteredProps = filteredProps.filter(prop => new Date(prop.rentedTo) <= new Date(this.filters.endDate));
            }
            return filteredProps;
        },
    },
    methods: {
      getUser(userId) {
        return this.users.find(user => user.id === userId);
      },
      getPropertyType(typeId) {
        return this.propertyTypes.find(type => type.id === typeId);
      },
      formatDate(date) {
        return new Date(date).toLocaleDateString();
      },
      calculateMonthsRented(property) {
        if (!property.rentedFrom || property.rentedTo) return 0;
        const from = new Date(property.rentedFrom);
        const to = new Date(property.rentedTo);
        const months = (to.getFullYear() - from.getFullYear()) * 12 + (to.getMonth() - from.getMonth());
        return months;
      },
      isCurrentlyRented(property) {
        return !property.rentedTo;
      },
    },
  }
  </script>
  
  <style scoped>
    #main {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
    }
    .filters {
    margin-bottom: 20px;
    }
    .filters label {
    margin-right: 10px;
    }
    .filters select,
    .filters input[type="date"] {
    margin-right: 20px;
    }
</style>