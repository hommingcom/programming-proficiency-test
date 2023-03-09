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
  #header {
    padding: 2rem;
    background-color: #f0fcf7;
    border-radius: 50%;
  }
</style>
