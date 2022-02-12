<template>
  <footer class="">
      <div class="container p-5 mx-auto flex justify-center">
        Hecho con cariño por <span class="text-gray-400 ml-1"> Luis Lorenzo</span>
      </div>
  </footer>
</template>

<script>
export default {
  name: 'Footer',
  data() {
    return {
      year: new Date().getFullYear(),
    };
  },
};
</script>

<style>

</style>
