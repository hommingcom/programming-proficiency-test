<template>

  <button class="rounded-full bg-blue-500 hover:bg-blue-700 my-2 py-2 px-4 text-white"
    @click="$emit('clicked')"
  >
    {{ text }}
  </button>

</template>

<script>

export default {
  props: {
    text: { type: String, required: true },
  },
};
</script>
