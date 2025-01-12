<template>
  <div id="app" class="bg-gray-200 min-h-screen">
    <h1 class="text-4xl font-extrabold text-center mb-6 text-red-400 pt-12">
      SERGIO'S TECHNICAL TEST
    </h1>
    <PropertiesTable
      :properties="properties"
      :users="users"
      :propertyTypes="propertyTypes"
    />
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';
import PropertiesTable from './components/PropertiesTable.vue';

export default {
  name: 'App',
  components: {
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
/* Tailwind's base, components, and utilities */
@import 'tailwindcss/base';
@import 'tailwindcss/components';
@import 'tailwindcss/utilities';
</style>
