<template>
    <header class="header" id="header">
        <h1>{{ title }}</h1>
    </header>
</template>

<script>
export default {
  name: 'Header',
  props: {
    title: {
      type: String,
      required: true,
    },
  },
};
</script>

<style>

</style>
