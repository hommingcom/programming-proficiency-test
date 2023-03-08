<script>
import { users, propertyTypes, properties } from '@/mocks/api';

export default {
  name: 'Table',
  data: () => ({
    users,
    propertyTypes,
    properties,
  }),
};

</script>

<template>
    <div class="table">
      <table class="testTable">
        <thead>
          <tr>
            <th>Property ID</th>
            <th>Tenent</th>
            <th>Type</th>
            <th>Name & Street</th>
            <th>Rented from</th>
            <th>Until</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="property in properties" v-bind:key='property.id'>
            <td>{{ property.id }}</td>
            <td>{{ users.find(user => user.id === property.userId).name }}</td>
            <td>{{ propertyTypes.find(type => type.id === property.typeId).name }}</td>
            <td>{{ property.name }}</td>
            <td>{{ property.rentedFrom ? new Date(property.rentedFrom).toLocaleDateString() : 'Avaiable' }}</td>
            <td>{{ property.rentedTo ? new Date(property.rentedTo).toLocaleDateString(): '-'}}</td>
          </tr>
        </tbody>
        </table>
    </div>
</template>

<style>
  .table {
    border: 1px solid black;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  table {
  border:1px solid #b3adad;
  border-collapse:collapse;
  padding:5px;

  }
  table th {
    border:1px solid #b3adad;
    padding:5px;
    background: #f0f0f0;
    color: #313030;
  }
  table td {
    border:1px solid #b3adad;
    text-align:center;
    padding:5px;
    background: #ffffff;
    color: #313030;
  }
</style>
