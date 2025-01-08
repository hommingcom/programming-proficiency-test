<template>
  <div id="app" class="full-page">
    <div class="container-fluid mt-5 px-5">
      <h1 class="text-center mb-4">Listado de Propiedades</h1>
      <PropertyTable :properties="properties" />
    </div>
  </div>
</template>

<script>
import properties from './stub/properties';
import PropertyTable from './components/PropertyTable.vue';

export default {
  name: 'App',
  components: {
    PropertyTable,
  },
  data() {
    return {
      properties,
    };
  },
};
</script>

<style>
body {
  background-color: red;
  min-height: 100vh;
  margin: 0;
  font-family: Arial, sans-serif;
}

#app {
  width: 100%;
  height: 100%;
}
</style>
