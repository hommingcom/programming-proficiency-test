<template>
    <footer class="footer" id="footer">
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

</style>

export default Footer;
