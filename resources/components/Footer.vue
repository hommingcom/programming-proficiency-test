<template>
    <footer id="footer">
        <h4>{{ createdBy }}</h4>
    </footer>
</template>

<script>

export default {
  name: 'Footer',
  props: {
    createdBy: {
      type: String,
      required: true,
    },
  },
};
</script>

<style>
  #footer {
    padding: 1rem;
  }
</style>
