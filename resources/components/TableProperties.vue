<template>
  <div>
    <TablePropertiesFilter @search="setsearchQuery" />
    <table class="w-full overflow-hidden border border-collapse rounded-md shadow table-auto">
      <thead class="bg-gray-50">
        <tr class="text-xs text-left text-gray-900 md:text-sm">
          <th
            v-for="column in columns"
            :key="column.label"
            class="p-4 py-3 border-b border-gray-200"
          >
            {{ column.label }}
          </th>
        </tr>
      </thead>

      <tfoot class="bg-white">
        <tr class="text-xs text-gray-500 md:text-sm">
          <td colspan="4" class="px-4 py-2 font-medium">
            {{ getPageInformation }}
          </td>
          <td colspan="4" class="px-4 py-2 text-right">
            <button
              type="button"
              class="p-2 border border-gray-300 rounded-l-md disabled:opacity-50"
              :disabled="page === 1"
              @click="previousPage()"
            >
              Prev
            </button>
            <button
              type="button"
              class="p-2 border border-l-0 border-gray-300 rounded-r-md disabled:opacity-50"
              :disabled="page === totalPages"
              @click="nextPage()"
            >
              Next
            </button>
          </td>
        </tr>
      </tfoot>

      <tbody class="bg-white">
        <tr
          v-for="property in paginatedData"
          :key="property.id"
          class="text-xs font-medium text-gray-600 md:text-sm font-mediumtext-sm"
        >
          <td
            v-for="column in columns"
            :key="column.label"
            class="p-4 py-3 text-left border-b border-gray-200"
          >
            {{ property[column.field] }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import TablePropertiesFilter from '@/components/TablePropertiesFilter.vue';

export default {
  name: 'TableProperties',
  components: {
    TablePropertiesFilter,
  },
  props: {
    properties: {
      type: Array,
      required: true,
    },
    perPage: {
      type: Number,
      default: 10,
    },
  },
  data: () => ({
    columns: [
      { label: '#', field: 'id' },
      { label: 'User', field: 'user' },
      { label: 'Type', field: 'type' },
      { label: 'Name', field: 'name' },
      { label: 'Rented from', field: 'rentedFrom' },
      { label: 'Rented to', field: 'rentedTo' },
      { label: 'Rented for (months)', field: 'rentedDuration' },
      { label: '', field: 'status' },
    ],
    page: 1,
    searchQuery: '',
  }),
  computed: {
    paginatedData() {
      return this.filteredData.slice((this.page - 1) * this.perPage, this.page * this.perPage);
    },
    filteredData() {
      return this.properties.filter((property) => {
        if (this.searchQuery === '') {
          return true;
        }

        const values = Object.values(property);

        return values.some((value) => {
          // Allow searching for numbers
          const stringValue = String(value).toLowerCase();
          return stringValue.includes(this.searchQuery.toLowerCase());
        });
      });
    },
    getPageInformation() {
      if (this.filteredData.length === 0) {
        return 'No results found';
      }

      return `Page ${this.page} of ${this.totalPages}`;
    },
    totalPages() {
      return Math.ceil(this.filteredData.length / this.perPage);
    },
  },
  methods: {
    previousPage() {
      if (this.page > 1) {
        this.page -= 1;
      }
    },
    nextPage() {
      if (this.page < this.totalPages) {
        this.page += 1;
      }
    },
    setsearchQuery(query) {
      // Reset page to 1 when search query changes
      if (query !== '') {
        this.page = 1;
      }

      this.searchQuery = query;
    },
  },
};
</script>
