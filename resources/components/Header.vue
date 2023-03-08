<template>
    <div class="header" id="header">
        <h1>{{ title }}</h1>
    </div>
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
    .header {

}
</style>

export default Header;
