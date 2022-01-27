<template>
  <div id="app">
    <div class="input-form">
      <label>User</label>
      <select v-model="filterUser">
        <option value="-1">All</option>
        <option v-for="user of this.users" :key="user.id" :value="user.id">
          {{ user.name }}
        </option>
      </select>
    </div>
    <div class="input-form">
      <label>Types</label>
      <select v-model="filterType">
        <option value="-1">All</option>
        <option v-for="type of this.propertyTypes" :key="type.id" :value="type.id">
          {{ type.name }}
        </option>
      </select>
    </div>
    <div class="input-form">
      <label>Rented for</label>
      <input type="date" v-model="filterRentedFrom">
    </div>
    <div class="input-form">
      <label>Rented to</label>
      <input type="date" v-model="filterRentedTo">
    </div>
    <properties-table :properties="filteredProperties"></properties-table>
  </div>
</template>

<script>
import PropertiesTable from '@/components/PropertiesTable.vue';
import getUsers from '@/domain/users/user.service';
import { getProperties, getPropertyTypes } from '@/domain/properties/property.service';

export default {
  name: 'App',
  components: { PropertiesTable },
  computed: {
    filteredProperties() {
      return this.properties.filter((property) => {
        let shouldInclude = true;

        if (this.filterUser !== -1) {
          shouldInclude = property.user.id === this.filterUser;
        }

        if (this.filterType !== -1) {
          shouldInclude = property.type.id === this.filterType;
        }

        if (this.filterRentedFrom !== '') {
          const filterRentedFrom = new Date(this.filterRentedFrom);
          shouldInclude = property.rentedFrom && property.rentedFrom <= filterRentedFrom;
        }

        console.log(this.filterRentedTo);
        if (this.filterRentedTo !== '') {
          const filterRentedTo = new Date(this.filterRentedTo);
          shouldInclude = property.rentedTo && property.rentedTo >= filterRentedTo;
        }

        return shouldInclude;
      }).sort((a, b) => a.id - b.id);
    },
  },
  data: () => ({
    users: [],
    propertyTypes: [],
    properties: [],
    filterUser: -1,
    filterType: -1,
    filterRentedFrom: '',
    filterRentedTo: '',
  }),
  async mounted() {
    // Should dispatch store methods that call API's but for this example call API directly
    this.users = await getUsers();
    this.properties = await getProperties();
    this.propertyTypes = await getPropertyTypes();

    this.properties = this.properties.map((property) => {
      property.user.name = this.users.find((user) => user.id === property.user.id)?.name ?? '';
      property.type.name = this.propertyTypes.find((type) => type.id === property.type.id)?.name ?? '';

      return property;
    });

    // If project includes vue router we can use this.$route.query
    const queryParams = new URLSearchParams(window.location.search);

    // We should make more checks before assigning the filter like 'is this a positive number'
    // or 'is this a valid date' but simplified for the example.
    if (queryParams.has('user')) {
      this.filterUser = parseInt(queryParams.get('user'), 10);
    }

    if (queryParams.has('type')) {
      this.filterType = parseInt(queryParams.get('type'), 10);
    }

    // Date should be yyyy-mm-dd
    if (queryParams.has('rentedFrom')) {
      this.filterRentedFrom = queryParams.get('rentedFrom');
    }

    if (queryParams.has('rentedTo')) {
      this.filterRentedFrom = queryParams.get('rentedTo');
    }
  },
};
</script>

<style>
#app {
  font-family: sans-serif;
}

.input-form {
  width: 300px;
  margin-bottom: 10px;
}

.input-form label {
  display: inline-block;
  width: 90px;
  font-size: .9em;
}
</style>
