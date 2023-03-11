<template>
  <div class="mb-2">
    <input
      id="search"
      type="text"
      placeholder="Search..."
      class="px-3 py-2 border border-gray-300 rounded-md sm:text-sm"
      @input="onSearch"
    />
  </div>
</template>

<script>
export default {
  name: 'TablePropertiesFilter',
  methods: {
    onSearch(event) {
      this.$emit('search', event.target.value);
    },
  },
};
</script>
