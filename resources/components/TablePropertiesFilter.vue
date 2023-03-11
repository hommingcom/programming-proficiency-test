<template>
  <div class="flex mb-2 space-x-2">
    <input
      id="search"
      type="text"
      placeholder="Search..."
      class="px-3 py-2 border border-gray-300 rounded-md sm:text-sm"
      @input="onSearch"
    />
    <div class="relative bg-red-400 rounded-md">
      <button type="button" class="h-full p-2" @click="openFilter = true">filter</button>
      <div
        v-show="openFilter"
        class="absolute w-56 mt-1 bg-white border border-gray-200 rounded-md shadow-sm"
      >
        <h2 class="p-2 px-3 text-lg font-bold border-b border-gray-100">Filters</h2>
        <div class="overflow-auto max-h-72">
          <FilterSection
            v-for="(filter, index) in sections"
            :key="`filter-${index}`"
            :type="filter.type"
            :title="filter.title"
            :items="filter.items"
          />
        </div>
        <div class="flex p-2 space-x-2 border-t border-gray-100">
          <button type="button" class="w-full p-2 text-sm font-medium text-gray-900 bg-red-200 rounded-md" @click="openFilter = false">
            Cancel
          </button>
          <button type="button" class="w-full p-2 text-sm font-medium text-gray-900 bg-gray-200 rounded-md">
            Apply
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FilterSection from '@/components/Filter/FilterSection.vue';

export default {
  name: 'TablePropertiesFilter',
  components: {
    FilterSection,
  },
  props: {
    properties: {
      type: Array,
      required: false,
    },
    filterTypes: {
      type: Array,
      required: false,
    },
  },
  data: () => ({
    openFilter: false,
  }),
  computed: {
    sections() {
      return this.filterTypes.map((filter) => {
        if (filter.type === 'checkbox') {
          const items = new Set();
          this.properties.forEach((property) => {
            items.add(property[filter.field]);
          });

          return {
            type: filter.type,
            title: filter.title,
            field: filter.field,
            items: [...items],
          };
        }

        return {
          type: filter.type,
          title: filter.title,
          field: filter.field,
          items: [],
        };
      });
    },
  },
  methods: {
    onSearch(event) {
      this.$emit('search', event.target.value);
    },
  },
};
</script>
