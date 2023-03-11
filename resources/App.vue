<template>
  <div id="app">
    <div class="filter-container">
      <div class="filter-item">
        <label for="filterPropertyType">Type</label>
        <select id="filterPropertyType" name="propertyType" v-model="selectedPropertyType">
          <option v-for="pType in propertyTypes" :value="pType.id" :key="pType.id">
            {{ pType.name }}
          </option>
        </select>
      </div>
      <div class="filter-item">
        <label for="filterUser">User</label>
        <select id="filterUser" name="users" v-model="selectedUser">
          <option v-for="u in users" :value="u.id" :key="u.id">{{ u.name }}</option>
        </select>
      </div>
      <div class="filter-item">
        <label for="filterRentedFromDate">Rented from</label>
        <input id="filterRentedFromDate" type="date" name="toDate" v-model="selectedRentedFromDate">
      </div>
      <div class="filter-item">
        <label for="filterRentedToDate">Rented to</label>
        <input id="filterRentedToDate" type="date" name="fromDate" v-model="selectedRentedToDate">
      </div>
      <button @click="onFilter">Filter</button>
      <button @click="onClearFilters">Clear filters</button>
    </div>
    <table>
      <thead>
        <tr>
          <th v-for="col in columns" :key="col">{{ col }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="prop in savedProperties" :key="prop.id">
          <td>{{ prop.name }}</td>
          <td>{{ propertyTypes.find((item) => item.id === prop.typeId).name }}</td>
          <td>{{ users.find((item) => item.id === prop.userId).name }}</td>
          <td>{{ getFormatDate(prop.rentedFrom) }}</td>
          <td>{{ getFormatDate(prop.rentedTo) }}</td>
          <td>{{ diffDates(prop.rentedFrom, prop.rentedTo) }}</td>
          <td>{{ prop.rentedFrom != null ? 'Yes' : 'No' }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';

export default {
  name: 'App',
  data() {
    return {
      users,
      propertyTypes,
      properties,
      columns: ['Property name', 'Property type', 'User', 'Rented from', 'Rented to', 'Months rented', 'Rented out'],
      selectedPropertyType: null,
      selectedUser: null,
      selectedRentedFromDate: null,
      selectedRentedToDate: null,
      savedProperties: null,
      userId: null,
    };
  },
  methods: {
    diffDates(date1, date2) {
      let months = 0;
      const rentedTo = date2 == null ? new Date() : date2;
      if (date1 != null) {
        months = (rentedTo.getFullYear() - date1.getFullYear()) * 12;
        months -= date1.getMonth();
        months += rentedTo.getMonth();
        months = months <= 0 ? 0 : months;
        months = rentedTo.getDate() < date1.getDate() ? months - 1 : months;
      }
      return months;
    },
    onFilter() {
      this.savedProperties = properties;
      if (this.selectedPropertyType != null) {
        // eslint-disable-next-line max-len
        this.savedProperties = this.savedProperties.filter((item) => item.typeId === this.selectedPropertyType);
      }
      if (this.selectedUser != null) {
        // eslint-disable-next-line max-len
        this.savedProperties = this.savedProperties.filter((item) => item.userId === this.selectedUser);
      }
      if (this.selectedRentedFromDate != null) {
        // eslint-disable-next-line max-len
        this.savedProperties = this.savedProperties.filter((item) => this.getFormatDate(item.rentedFrom) === this.getFormatDate(new Date(this.selectedRentedFromDate)));
      }
      if (this.selectedRentedToDate != null) {
        // eslint-disable-next-line max-len
        this.savedProperties = this.savedProperties.filter((item) => this.getFormatDate(item.rentedTo) === this.getFormatDate(new Date(this.selectedRentedToDate)));
      }
    },
    onClearFilters() {
      this.savedProperties = properties;
      this.selectedPropertyType = null;
      this.selectedUser = null;
      this.selectedRentedFromDate = null;
      this.selectedRentedToDate = null;
    },
    getQueryParams() {
      const queryString = window.location.search;
      const urlParams = new URLSearchParams(queryString);
      if (urlParams.has('user')) {
        this.userId = urlParams.get('user');
        this.selectedUser = this.userId;
        // eslint-disable-next-line max-len
        this.savedProperties = this.savedProperties.filter((item) => item.userId.toString() === this.userId);
      }
    },
    getFormatDate(date) {
      if (date != null) {
        return `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
      }
      return '-';
    },
  },
  mounted() {
    this.savedProperties = properties;
    this.getQueryParams();
  },
};
</script>
<style scoped>
.filter-container {
  display: flex;
  margin-bottom: 10px;
  align-items: center;
  align-items: end;
  gap: 10px;
}
.filter-item {
  display: flex;
  flex-direction: column;
  gap: 5px;
}
.filter-container button {
  margin-left: 10px;
}
th {
  text-align: left;
  border: 1px solid #000;
}
td {
  border: 1px solid #000;
}
</style>
