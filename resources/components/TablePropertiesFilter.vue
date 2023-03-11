<template>
  <div class="flex mb-2 space-x-2">
    <input
      id="search"
      type="text"
      placeholder="Search..."
      class="px-3 py-2 border border-gray-300 rounded-md sm:text-sm"
      @input="onSearch"
    />
    <div class="relative bg-white border border-gray-300 rounded-md">
      <button type="button" class="h-full p-2" @click="openFilter = true">
        <svg
          class="w-5 h-5 text-gray-600"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
          aria-hidden="true"
        >
          <path
            clip-rule="evenodd"
            fill-rule="evenodd"
            d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z"
          ></path>
        </svg>
      </button>
      <div
        v-show="openFilter"
        class="absolute w-64 mt-1 bg-white border border-gray-200 rounded-md shadow-sm"
      >
        <h2 class="p-2 px-3 text-lg font-bold border-b border-gray-100">Filters</h2>
        <div class="overflow-auto max-h-72">
          <FilterSection
            v-for="(filter, index) in sections"
            :key="`filter-${index}`"
            :type="filter.type"
            :title="filter.title"
            :field="filter.field"
            :items="filter.items"
            @addedFilter="addedFilter"
            @removedFilter="removedFilter"
          />
        </div>
        <div class="flex p-2 space-x-2 border-t border-gray-100">
          <button
            type="button"
            class="w-full p-2 text-sm font-medium text-gray-900 bg-red-200 rounded-md"
            @click="openFilter = false"
          >
            Cancel
          </button>
          <button
            type="button"
            class="w-full p-2 text-sm font-medium text-gray-900 bg-gray-200 rounded-md"
            @click="filterData"
          >
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
    selectedFilters: {
      checkbox: {},
      date: {},
    },
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
          items: null,
        };
      });
    },
  },
  methods: {
    onSearch(event) {
      this.$emit('search', event.target.value);
    },
    filterData() {
      this.$emit('filter', this.selectedFilters);
    },
    addedFilter(options) {
      if (options.type === 'checkbox') {
        const key = `${options.field}`;
        const exist = this.selectedFilters.checkbox[key];

        if (exist) {
          this.selectedFilters.checkbox[key].push(options.item);
        } else {
          this.selectedFilters.checkbox[key] = [options.item];
        }
      } else {
        const key = `${options.field}`;

        this.selectedFilters.date[key] = options.value;
      }

      this.filterData();
    },
    removedFilter(options) {
      if (options.type === 'checkbox') {
        const key = `${options.field}`;

        this.selectedFilters.checkbox[key] = this.selectedFilters.checkbox[key].filter(
          (item) => item !== options.item,
        );

        if (this.selectedFilters.checkbox[key].length === 0) {
          delete this.selectedFilters.checkbox[key];
        }
      } else {
        const key = `${options.field}`;

        delete this.selectedFilters.date[key];
      }

      this.filterData();
    },
  },
};
</script>
