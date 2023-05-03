<template>
  <div>
    <div v-for="propiedad in propiedades" :key="propiedad.id">
      <h3>{{ propiedad.name }}</h3>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PropertyList',
  data() {
    return {
      propiedades: [],
    };
  },
  /* Una vez se crea la instancia de vue, el created me ejecutaría el codigo que tenga dentro */
  async created() {
    /* Hasta que no se resuelva el await, no va a continuar con la ejecucion del codigo */
    const response = await fetch('@/mocks/api.js');
    /* Nos devuelve un objeto de tipo response */
    const propiedadesData = await response.json();
    /* Quiero que me vaya guardando cada objeto en el array */
    this.propiedades = propiedadesData;
  },
};
</script>
