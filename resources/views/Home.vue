<script>
import { users, propertyTypes, properties } from '@/mocks/api';

export default {
  name: 'Home',
  data: () => ({
    users,
    propertyTypes,
    properties,
  }),
};

</script>

<template>
    <div class="home">
      <table class="testTable">
        <thead>
          <tr>
            <th>id</th>
            <th>user</th>
            <th>type</th>
            <th>name</th>
            <th>rentedFrom</th>
            <th>rentedUntil</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>&nbsp;propertyId</td>
            <td>userId&nbsp;</td>
            <td>typeId&nbsp;</td>
            <td>propertyName&nbsp;</td>
            <td>StartDate&nbsp;</td>
            <td>EndDate&nbsp;</td>
          </tr>
        </tbody>
        </table>
    </div>
</template>

<style>
  .testTable {
    border: 1px solid black;
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
