<template>
  <div class="flex flex-row py-5 mx-auto justify-center">
    <input
      class="ml-10 py-3 pl-2 w-full bg-gray-800 border-blue-300 rounded-l-lg text-blue-300"
      placeholder="Search"
      v-model="searchInput"
      @input="processAndSendData(dataToFilter, searchInput)"
    />
  </div>
</template>

<script>
import { properties } from '../mocks/api';

export default {
  name: 'table-filter',
  props: {
    dataToFilter: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      properties,
      searchInput: '',
      processedData: [],
    };
  },
  watch: {
    searchInput(val) {
      if (!val.length) {
        this.$emit('filter-by-input', properties, false);
        this.$emit('reloadTable', true);
      }
    },
  },
  methods: {
    processAndSendData(arr, input) {
      this.processedData = [];
      const objArr = [];
      arr.forEach(async (item) => {
        const { values } = item;
        objArr.push(await this.$store.dispatch('objValuesToString', values));
      });
      setTimeout(() => {
        if (input && objArr.length) {
          const keys = Object.keys(objArr[0]);
          keys.forEach((key) => this.filterData(objArr, input, key));
          const processedData = this.processedData.filter((elements) => elements !== undefined);
          this.$emit('filter-by-input', processedData, true);
        } else {
          this.$emit('filter-by-input', properties, false);
        }
      }, 100);
    },
    filterData(array, query, key) {
      array.forEach((item) => {
        let results;
        if (item[key].includes(query)) {
          results = item;
        }
        this.processedData.push(results);
      });
    },
  },
};
</script>

<style scoped>
input:focus {
  outline: none;
}
</style>
