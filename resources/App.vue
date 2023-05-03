<template>
  <div id="app">
    <table>
      <thead>
          <tr>
              <th>Id</th>
              <th>UserId</th>
              <th>TypeId</th>
              <th>Name</th>
              <th>RentedFrom</th>
              <th>RentedTo</th>
              <th>Actions</th>
          </tr>
      </thead>
    </table>

  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';

export default {
  name: 'App',
  data: () => ({
    users,
    propertyTypes,
    properties,
  }),
};
</script>
