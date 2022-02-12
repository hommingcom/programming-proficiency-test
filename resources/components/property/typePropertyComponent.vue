<template>
    <div>
        <img :src="require(`@/assets/img/${type}.png`)" :alt="type" :title="type"
        class="h-8" />
    </div>
</template>

<script>
export default {
  name: 'TypePropertyComponent',
  props: {
    type: {
      type: String,
      require: true,
    },
  },

};
</script>

<style>

</style>
