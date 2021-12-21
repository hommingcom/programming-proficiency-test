<template>
  <div id="app">
    <label for="users">User </label>
    <select name="users" v-model="filters.user">
      <option :value="null"></option>
      <option v-for="(user, index) in users" :key="index" :value="user.id">
        {{user.name}}
      </option>
    </select>
    <br>
    <label for="types">Type </label>
    <select name="types" v-model="filters.type">
      <option :value="null"></option>
      <option v-for="(type, index) in propertyTypes" :key="index" :value="type.id">
        {{type.name}}
      </option>
    </select>
    <br>
    <label for="dateFrom1">Rented From </label>
    <input type="date" name="dateFrom1" v-model="filters.dateFrom1" />
    <input type="date" name="dateFrom2" v-model="filters.dateFrom2" />
    <br>
    <label for="dateTo1">Rented To </label>
    <input type="date" name="dateTo1" v-model="filters.dateTo1" />
    <input type="date" name="dateTo2" v-model="filters.dateTo2" />
    <br>
    <button @click="clearFilters">Clear Filters</button>
    <PropertiesTable :properties="filteredProperties" />
  </div>
</template>

<script>
import { users, propertyTypes, properties as propertiesData } from '@/mocks/api';
import PropertiesTable from '@/components/PropertiesTable.vue';

export default {
  name: 'App',
  components: {
    PropertiesTable,
  },
  data: () => ({
    users,
    propertyTypes,
    propertiesData,
    filters: {
      user: null,
      type: null,
      dateFrom1: null,
      dateFrom2: null,
      dateTo1: null,
      dateTo2: null,
    },
  }),
  created() {
    if (this.$route) {
      this.filters.user = Number.isNaN(Number(this.$route.query.user))
        ? null
        : Number(this.$route.query.user);
      this.filters.type = Number.isNaN(Number(this.$route.query.type))
        ? null
        : Number(this.$route.query.type);
    }
  },
  methods: {
    getUserName(id) {
      const filteredUsers = this.users.filter((user) => (user.id === id));
      if (filteredUsers.length !== 1) return null;
      return filteredUsers[0].name;
    },
    clearFilters() {
      this.filters = {
        user: null,
        type: null,
        dateFrom1: null,
        dateFrom2: null,
        dateTo1: null,
        dateTo2: null,
      };
    },
  },
  computed: {
    properties() {
      return this.propertiesData.map((property) => ({
        ...property,
        user: this.getUserName(property.userId),
      }));
    },
    filteredProperties() {
      return this.properties.filter(
        (property) => (!this.filters.user || this.filters.user === property.userId)
          && (!this.filters.type || this.filters.type === property.typeId)
          && (!this.filters.dateFrom1 || new Date(this.filters.dateFrom1) <= property.rentedFrom)
          && (!this.filters.dateFrom2 || new Date(this.filters.dateFrom2) >= property.rentedFrom)
          && (!this.filters.dateTo1 || new Date(this.filters.dateTo1) <= property.rentedTo)
          && (!this.filters.dateTo2 || new Date(this.filters.dateTo2) >= property.rentedTo),
      );
    },
  },
};
</script>
