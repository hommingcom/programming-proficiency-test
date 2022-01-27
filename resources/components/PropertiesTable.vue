<template>
  <div class="properties">
    <table class="properties-table">
      <thead>
      <tr>
        <th>Id</th>
        <th>User</th>
        <th>Type</th>
        <th>Name</th>
        <th>Rented from</th>
        <th>Rented to</th>
        <th>Rented time</th>
        <th>Is rented?</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="property of properties" :key="property.id">
        <td>{{ property.id }}</td>
        <td>{{ property.user.name }}</td>
        <td>{{ property.type.name }}</td>
        <td>{{ property.name }}</td>
        <td>{{ property.rentedFrom | date }}</td>
        <td>{{ property.rentedTo | date }}</td>
        <td>{{ propertyRentedTime(property) }}</td>
        <td>{{ isPropertyRented(property) ? 'Yes' : 'No' }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'PropertiesTable',
  props: {
    properties: Array,
  },
  methods: {
    propertyRentedTime(property) {
      if (!property.rentedFrom || !property.rentedTo) {
        return '';
      }

      /**
       * This is just an approach to calculate months.
       * I'd use moment.js or Luxon to work with dates in a better way
       */
      // Get difference between dates in milliseconds and
      // / 1000 (seconds) / 60 (minutes) / 60 (hours) / 24 (days) / 30 (months)
      const months = Math.trunc(
        (property.rentedTo - property.rentedFrom) / 1000 / 60 / 60 / 24 / 30,
      );

      // Get difference between dates in milliseconds and
      // / 1000 (seconds) / 60 (minutes) / 60 (hours) / 24 (days) % 30 (months)
      const minutes = Math.round(
        ((property.rentedTo - property.rentedFrom) / 1000 / 60 / 60 / 24) % 30,
      );

      if (months === 0) {
        return `${minutes} days`;
      }

      return `${months} months, ${minutes} days`;
    },
    isPropertyRented(property) {
      return property.rentedFrom !== null && property.rentedTo === null;
    },
  },
};
</script>

<style scoped>
input {
  border: 1px solid #009879;
  border-radius: 6px;
  padding: 6px 10px;
}

.properties-table {
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 0.9em;
  font-family: sans-serif;
  min-width: 400px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.properties-table thead tr {
  background-color: #009879;
  color: #ffffff;
  text-align: left;
}

.properties-table th,
.properties-table td {
  padding: 12px 15px;
}

.properties-table tbody tr {
  border-bottom: 1px solid #dddddd;
}

.properties-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.properties-table tbody tr:last-of-type {
  border-bottom: 2px solid #009879;
}
</style>
