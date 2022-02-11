<template>
  <div id="app">
    This is the way!

    <router-link to="/">Home</router-link>
    <router-link to="/prueba">Prueba</router-link>

    <router-view/>
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
