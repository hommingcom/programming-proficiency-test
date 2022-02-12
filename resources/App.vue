<template>
  <div id="app">
  <Header/>
    <router-view/>
    <Footer/>
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';
import Header from './components/common/header.vue';
import Footer from './components/common/footer.vue';

export default {
  components: { Header, Footer },
  name: 'App',
  data: () => ({
    users,
    propertyTypes,
    properties,
  }),
};
</script>
