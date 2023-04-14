<template>
  <div class="">
    <h1 class="text-3xl font-bold my-4 ml-5">
      Properties
    </h1>

    <div class=" flex items-center justify-center">

      <div class="w-1/5">
        <FormSelectComponent
          label="Select User"
          :items="users"
          v-model="filters.user"
          @change="changeSelectedUser"
        ></FormSelectComponent>

        <!-- <label for="user" class="mr-2">Select User</label>
        <select name="users" id="users" v-model="filters.user"
          class="bg-blue-50 border rounded-md"
        >
          <option :value="null"></option>
          <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
        </select> -->
      </div>

      <div class="w-1/5">
        <FormSelectComponent
          label="Select Type"
          :items="propertyTypes"
          v-model="filters.type"
          @change="changeSelectedType"
        >
          <template v-slot:options>
            <option v-for="propertyType in propertyTypes"
              :key="propertyType.id" :value="propertyType.name"
            >
              {{ propertyType.name | capitalizeFirstLetter }}
          </option>
          </template>
        </FormSelectComponent>

        <!-- <label for="user" class="mr-2">Select Type</label>
        <select name="types" v-model="filters.type"
          class="bg-blue-50 border rounded-md"
        >
          <option :value="null"></option>
          <option v-for="propertyType in propertyTypes"
          :key="propertyType.id" :value="propertyType.name">
          {{ propertyType.name | capitalizeFirstLetter }}</option>
        </select> -->
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

      <ButtonComponent text="Clear Filters" @clicked="clearFilters"></ButtonComponent>

    </div>

    <TableComponent :items="filteredProperties" :headers="headers"></TableComponent>
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';
import TableComponent from '../components/TableComponent.vue';
import ButtonComponent from '../components/ButtonComponent.vue';
import FormSelectComponent from '../components/FormSelectComponent.vue';

export default {
  name: 'PropertiesView',
  components: { TableComponent, ButtonComponent, FormSelectComponent },
  props: ['user'],
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
    headers: [
      { label: 'Id', key: 'id' },
      { label: 'User', key: 'user' },
      { label: 'Type', key: 'type' },
      { label: 'Name', key: 'name' },
      { label: 'Rented From', key: 'rentedFrom' },
      { label: 'Rented To', key: 'rentedTo' },
      { label: 'Months Rented', key: 'rentedMonths' },
      { label: 'Currently Rented', key: 'currentlyRented' },
    ],
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
        && (!this.filters.type || (property.type && property.type.toLowerCase()) === (this.filters.type && this.filters.type.toLowerCase())) // eslint-disable-line
        && (!this.filters.rentedFrom || property.rentedFrom >= new Date(this.filters.rentedFrom))
        && (!this.filters.rentedTo || property.rentedTo <= new Date(this.filters.rentedTo)),
      );
    },
  },
  methods: {
    changeSelectedUser(user) {
      this.filters.user = user;
    },
    changeSelectedType(type) {
      // console.log('🚀 ~ file: PropertiesView.vue:127 ~ changeSelectedType ~ type:', type);
      this.filters.type = type;
    },
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
        // typeId: this.getPropertyTypeName(property.typeId),
        rentedFrom: this.formatDate(property.rentedFrom),
        rentedTo: this.formatDate(property.rentedTo),
        rentedMonths: this.calculateRentedMonths(property.rentedFrom, property.rentedTo),
        currentlyRented: this.checkIfCurrentlyRented(property.rentedFrom, property.rentedTo),
        user: this.getUserName(property.userId),
        type: this.capitalizeFirstLetter(this.getPropertyTypeName(property.typeId)),
      }));
    },

    capitalizeFirstLetter(text) {
      return text && text.charAt(0).toUpperCase() + text.slice(1) // eslint-disable-line
    },

    formatDate(date) {
      if (date) {
        const options = {
          timeZone: Intl.DateTimeFormat().resolvedOptions().timeZone,
          timeZoneName: 'short',
        };
        return new Intl.DateTimeFormat(navigator.language,
          options).format(date);
      }
      return null;
    },

    calculateRentedMonths(from, to) {
      if (!from) return null;

      const last = to !== null ? to : new Date();
      let months = (last.getFullYear() - from.getFullYear()) * 12;
      months -= from.getMonth();
      months += last.getMonth();
      return months <= 0 ? 0 : months;
    },

    checkIfCurrentlyRented(from, to) {
      const today = new Date();
      if (from && from <= today && (!to || to > today)) {
        return 'Yes';
      }
      return 'No';
    },

    clearFilters() {
      this.filters = Object.keys(this.filters).reduce(
        (acc, curr) => ({ ...acc, [curr]: null }), {},
      );
    },
  },
};
</script>
