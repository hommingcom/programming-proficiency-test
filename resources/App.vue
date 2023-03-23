<template>
  <div id="app">
    <DataTable :properties="properties" :propertyTypes="propertyTypes" :users="users"/>
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';
import DataTable from '@/components/Properties/DataTable.vue';

export default {
  name: 'app',
  components: { DataTable },
  data: () => ({
    users,
    propertyTypes,
    properties,
  }),
};
</script>
