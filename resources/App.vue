<template>
  <div id="app">
    <PropertyList />
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';
import PropertyList from './Programming-P-T/components/PropertyList.vue';

export default {
  name: 'App',
  data: () => ({
    users,
    propertyTypes,
    properties,
  }),
  components: {
    PropertyList,
  },
};
</script>
