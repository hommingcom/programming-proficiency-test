<template>
  <div class="">
    <h1 class="text-3xl font-bold my-4 ml-5">
      Properties
    </h1>

    <div class=" flex items-center justify-center">

      <div class="w-1/5">
        <label for="user" class="mr-2">Select User</label>
        <select name="users" id="users" v-model="filters.user"
          class="bg-blue-50 border rounded-md"
        >
          <option :value="null"></option>
          <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
        </select>
      </div>

      <div class="w-1/5">
        <label for="user" class="mr-2">Select Type</label>
        <select name="types" v-model="filters.type"
          class="bg-blue-50 border rounded-md"
        >
          <option :value="null"></option>
          <option v-for="propertyType in propertyTypes"
          :key="propertyType.id" :value="propertyType.id">
            {{ propertyType.name | capitalizeFirstLetter }}</option>
        </select>
      </div>

      <div class="w-1/5">
        <label for="startDate" class="mr-2">Rented From:</label>
        <input type="date" id="startDate" name="rentedFrom"
          class="bg-blue-50 border rounded-md"
          v-model="filters.rentedFrom"
        >
      </div>

      <div class="w-1/5">
        <label for="endDate" class="mr-2">Rented To:</label>
        <input type="date" id="endDate" name="rentedTo"
          class="bg-blue-50 border rounded-md"
          v-model="filters.rentedTo"
        >
      </div>

      <button class="rounded-full bg-blue-500 hover:bg-blue-700 my-2 py-2 px-4 text-white"
        @click="clearFilters"
      >
        Clear Filters
      </button>
    </div>

    <PropertiesTable :properties="filteredProperties"></PropertiesTable>
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';
import PropertiesTable from '../components/PropertiesTable.vue';

export default {
  components: { PropertiesTable },
  data: () => ({
    users,
    propertyTypes,
    properties,
    filters: {
      user: null,
      type: null,
      rentedFrom: null,
      rentedTo: null,
    },
  }),
  created() {
    this.checkQueryUser();
    this.modifyPropertiesValues();
  },
  watch: {
    $route() {
      this.checkQueryUser();
    },
  },
  computed: {
    filteredProperties() {
      return this.properties.filter(
        (property) => (!this.filters.user || property.userId === this.filters.user)
        && (!this.filters.type || property.typeId === this.filters.type)
        && (!this.filters.rentedFrom || property.rentedFrom >= new Date(this.filters.rentedFrom))
        && (!this.filters.rentedTo || property.rentedTo <= new Date(this.filters.rentedTo)),
      );
    },
  },
  methods: {
    checkQueryUser() {
      if (Object.prototype.hasOwnProperty.call(this.$route.query, 'user')) {
        const selectedUser = this.users.filter((user) => user.id === Number(this.$route.query.user)); // eslint-disable-line
        this.filters.user = selectedUser.length > 0 ? selectedUser[0].id : null;
      }
    },
    getUserName(userId) {
      const userData = this.users.filter((user) => user.id === userId);
      return userData.length > 0 ? userData[0].name : null;
    },
    getPropertyTypeName(typeId) {
      const propertyData = this.propertyTypes.filter((propertyType) => propertyType.id === typeId);
      return propertyData.length > 0 ? propertyData[0].name : null;
    },
    modifyPropertiesValues() {
      this.properties = this.properties.map((property) => ({
        ...property,
        user: this.getUserName(property.userId),
        type: this.getPropertyTypeName(property.typeId),
      }));
    },
    clearFilters() {
      this.filters = Object.keys(this.filters).reduce(
        (acc, curr) => ({ ...acc, [curr]: null }), {},
      );
    },
  },
};
</script>
