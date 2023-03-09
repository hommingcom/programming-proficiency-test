<template>
  <div id="app">
    <form @submit.prevent="filterPropertiesByCriteria()">
      <div>
        <label>User:</label>
        <select
          v-model.number="userIdSelected"
          data-userid
        >
          <option v-for="user in users" :key="user.id" :value="user.id">
            {{ user.name }}
          </option>
        </select>
        <label>Property Type:</label>
        <select
          v-model.number="propertyTypeIdSelected"
          data-typeid
        >
          <option v-for="type in propertyTypes" :key="type.id" :value="type.id">
            {{ type.name }}
          </option>
        </select>
        <label>Rented From</label>
        <input
          type="date"
          v-model="propertyRentedFrom"
          data-rentedfrom
        />
        <label>Rented To</label>
        <input
          type="date"
          v-model="propertyRentedTo"
          data-rentedto
        />
      </div>
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>Type</th>
          <th>Name</th>
          <th>From</th>
          <th>To</th>
          <th>Renting</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="property in properties" :key="property.id">
          <th>{{ property.id }}</th>
          <td>{{ getUser(property.userId) }}</td>
          <td>{{ getPropertyType(property.typeId) }}</td>
          <td>{{ property.name }}</td>
          <td>{{ formatDateToString(property.rentedFrom) }}</td>
          <td>{{ formatDateToString(property.rentedTo) }}</td>
          <td>{{ castBooleanToHuman(property.isRenting) }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import usersRepository from '@/repositories/usersRepository';
import propertyTypesRepository from '@/repositories/propertyTypesRepository';
import propertiesRepository from '@/repositories/propertiesRepository';

export default {
  name: 'App',
  data: () => ({
    userIdSelected: null,
    propertyTypeIdSelected: null,
    propertyRentedFrom: null,
    propertyRentedTo: null,
    users: [],
    properties: [],
    propertyTypes: [],
  }),
  methods: {
    getAllProperties() {
      this.properties = propertiesRepository.getAll();
    },
    getAllUsers() {
      this.users = usersRepository.getAll();
    },
    getAllPropertyTypes() {
      this.propertyTypes = propertyTypesRepository.getAll();
    },
    getUser(userId) {
      const users = this.users.filter((item) => item.id === userId);
      return users[0].name;
    },
    getPropertyType(typeId) {
      const types = this.propertyTypes.filter((item) => item.id === typeId);
      return types[0].name;
    },
    castBooleanToHuman(value) {
      return value ? 'Yes' : 'No';
    },
    formatDateToString(date) {
      return date ? date.toLocaleDateString('es-ES') : '';
    },
    filterPropertiesByCriteria() {
      this.properties = propertiesRepository.filterByCriteria({
        userId: this.userIdSelected,
        typeId: this.propertyTypeIdSelected,
        rentedFrom: this.propertyRentedFrom ? new Date(this.propertyRentedFrom) : null,
        rentedTo: this.propertyRentedTo ? new Date(this.propertyRentedTo) : null,
      });
    },
  },
  mounted() {
    this.getAllUsers();
    this.getAllPropertyTypes();
    this.getAllProperties();
  },
};
</script>
