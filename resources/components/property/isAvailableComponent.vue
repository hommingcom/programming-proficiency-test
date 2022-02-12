<template>

  <span v-if="status"
  class="bg-green-200 opacity-80 px-2 py-1 rounded-full font-bold text-green-900 text-sm">
      Disponible
  </span>
  <span v-else
  class="bg-red-200 opacity-50 px-2 py-1 rounded-full font-bold text-red-900 text-sm">
      Alquilado
  </span>
</template>

<script>
export default {
  name: 'isAvailableComponent',
  props: {
    status: {
      type: Boolean,
      default: false,
    },
  },

};
</script>

<style>

</style>
