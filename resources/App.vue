<template>
  <div id="app">
    <HeaderX title="Hey?????"/>
    <Home/>
    Hola
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';

import HeaderX from '@/components/HeaderX.vue';
import Home from '@/views/Home.vue';

export default {
  name: 'App',
  data: () => ({
    users,
    propertyTypes,
    properties,
  }),
  components: { HeaderX, Home },
};
</script>
