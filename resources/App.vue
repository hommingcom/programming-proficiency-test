<template>
  <div id="app">
    <Home :users="users" :propertyTypes="propertyTypes" :properties="properties" />
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';
import Home from './components/Home.vue';

export default {
  name: 'App',
  data: () => ({
    users,
    propertyTypes,
    properties,
  }),
  components: { Home },
};
</script>

<style>
</style>
