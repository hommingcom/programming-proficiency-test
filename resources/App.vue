<template>
  <div id="app">
    <HeroSection />
    <PropertiesTable :users="users" :types="propertyTypes" :properties="properties" />
  </div>
</template>

<script>
import HeroSection from '@/components/HeroSection.vue';
import PropertiesTable from '@/components/PropertiesTable.vue';
import { users, propertyTypes, properties } from '@/mocks/api';

export default {
  name: 'App',
  components: {
    HeroSection,
    PropertiesTable,
  },
  data: () => ({
    users,
    propertyTypes,
    properties,
  }),
};
</script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
</style>
