<template>
    <div class="container">
      <h4 class="table-title">Properties Table</h4>
      <div class="table-filters">
        <div class="table-filter">
          <label for="userFilter">Filter by User:</label>
          <select v-model="selectedUser" id="userFilter">
            <option value="">All Users</option>
            <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
          </select>
        </div>

        <div class="table-filter">
          <label for="typeFilter">Filter by Property Type:</label>
          <select v-model="selectedType" id="typeFilter">
            <option value="">All Types</option>
            <option v-for="type in types" :key="type.id" :value="type.id">{{ type.name }}</option>
          </select>
        </div>

        <div class="table-filter">
          <label for="dateFrom">Rented From:</label>
          <input type="date" v-model="dateFrom" id="dateFrom" />
        </div>

        <div class="table-filter">
          <label for="dateTo">Rented To:</label>
          <input type="date" v-model="dateTo" id="dateTo" />
        </div>
      </div>

      <table>
        <thead>
          <tr>
            <th>Property Name</th>
            <th>Property Type</th>
            <th>Property User Name</th>
            <th>Rented From</th>
            <th>Rented To</th>
            <th>Currently Rented</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="property in filteredProperties" :key="property.id">
            <td>{{ property.name }}</td>
            <td>{{ getPropertyTypeName(property.typeId) }}</td>
            <td>{{ getUserName(property.userId) }}</td>
            <td>{{ formatDate(property.rentedFrom) }}</td>
            <td>{{ formatDate(property.rentedTo) }}</td>
            <td>{{ isCurrentlyRented(property) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>

<script>
export default {
  props: {
    users: {
      type: Array,
      required: true,
    },
    types: {
      type: Array,
      required: true,
    },
    properties: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      selectedUser: this.getUserFromQuery(),
      selectedType: '',
      dateFrom: '',
      dateTo: '',
    };
  },
  computed: {
    filteredProperties() {
      return this.properties.filter((property) => {
        const user = this.selectedUser ? property.userId === parseInt(this.selectedUser, 10) : true;
        const type = this.selectedType ? property.typeId === parseInt(this.selectedType, 10) : true;
        const dateFrom = this.dateFrom ? property.rentedFrom >= new Date(this.dateFrom) : true;
        const dateTo = this.dateTo ? property.rentedTo <= new Date(this.dateTo) : true;

        return user && type && dateFrom && dateTo;
      });
    },
  },
  methods: {
    getUserName(userId) {
      const user = this.users.find((userProperty) => userProperty.id === userId);
      return user ? user.name : 'Unknown';
    },
    getUserFromQuery() {
      const params = new URLSearchParams(window.location.search);
      return params.get('user') || '';
    },
    getPropertyTypeName(typeId) {
      const type = this.types.find((propertyType) => propertyType.id === typeId);
      return type ? type.name : 'Unknown';
    },
    formatDate(date) {
      return date ? date.toLocaleDateString() : 'N/A';
    },
    isCurrentlyRented(property) {
      const now = new Date();
      const status = property.rentedFrom <= now
                    && (!property.rentedTo || property.rentedTo > now)
                    && property.rentedFrom !== null;
      return status ? '🔐 RENTED OUT' : '✅ NOT RENTED';
    },
  },
  watch: {
    '$route.query': {
      handler() {
        if (this.$route && this.$route.query) {
          this.selectedUser = this.getUserFromQuery();
        }
      },
      immediate: true,
    },
  },
};
</script>

  <style>
  table {
    width: 100%;
    border: 1px solid #EEEE;
    border-collapse: collapse;
    text-align: center;
  }
  th, td {
    border: 1px solid #ddd;
    padding: 8px;
  }
  tr:hover {
    background-color: #ece3e3;
  }
  th {
    color: #EEEE;
    background-color: #000000;
  }
  .container {
    margin: 20px;
  }
  .table-title {
    font-size: 25px;
    margin: 7px 0px;
  }
  .table-filters {
    display: flex;
    margin-bottom: 5px;
  }
  .table-filter {
    display: flex;
    gap: 5px;
    margin-right: 20px;
  }
  </style>
