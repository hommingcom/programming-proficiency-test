<template>
  <div>
    <div class="block max-h-12 justify-center">
      <button
        id="filter-btn"
        class="w-full p-3 rounded-r-lg"
        @click="showOptions"
      >
        {{ isShowingOptions ? `Filtering by ${filteringOption}` : "Filtering options" }}
      </button>
    </div>
    <div v-if="isShowingOptions" class="block opt-buttons-wrapper my-2">
      <input
        v-model="input.value"
        v-for="(input, i) in options" :key="i"
        :placeholder="input.label"
        class="w-25 opt-button pl-2 my-2 block bg-blue-900 text-white rounded-md"
        @input="filterBySelector(input.type, input.value)"
      />
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  props: {
    filter: {
      type: String,
      default: '',
    },
    cleanFilters: {
      type: Boolean,
      default: false,
    },
    options: {
      type: Array,
      default: () => [],
    },
  },
  name: 'selector-filter',
  data() {
    return {
      isFiltering: false,
      filteringOption: '',
    };
  },
  computed: {
    ...mapState(['isShowingOptions']),
  },
  watch: {
    cleanFilters(newVal, oldVal) {
      if (newVal !== oldVal) {
        this.idQuery = '';
        this.userIdQuery = '';
        this.typeIdQuery = '';
      }
    },
  },
  methods: {
    filterBySelector(opt, query) {
      this.isFiltering = true;
      this.$emit('filtering-by-selector', opt, query);
      this.filteringOption = opt.toUpperCase();
    },
    showOptions() {
      this.$store.commit('setIsShowingOptions');
    },
  },
};
</script>

<style scoped>
#filter-btn {
  transition: all 0.3s ease-out;
  background: #1e4e1e;
  color: white;
}

#filter-btn:hover {
  background: white;
  color: #1e4e1e;
}

.opt-button {
  transition: all 0.3s ease-out;
  border: 1px solid #b3e6f5;
}

.opt-button:hover {
  background: transparent;
  color: cyan;
}
</style>
