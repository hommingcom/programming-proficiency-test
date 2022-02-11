<template>
  <div id="details-card" class="flex flex-row min-h-screen justify-center items-center">
    <div class="container bg-gray-200 rounded-2xl">
      <div class="p-5 row w-full bg-gray-800 rounded-tl-xl rounded-tr-xl">
        <h1 class="text-4xl text-white">Renting details</h1>
      </div>
      <div class="px-16 pb-5" v-for="(item, i) in selectedRow" :key="i">
        <div
          class="col col-auto font-bold text-gray-800 my-5"
          v-for="(key, j) of Object.keys(item)"
          :key="j"
        >
          <div class="flex flex-row">
            <div>{{ formatHead(key) }}:</div>
            <div class="font-light text-blue-900 ml-5">
              <div v-if="item[key] === true || item[key] === false">
                <font-awesome-icon
                  :class="item[key] === true ? 'text-3xl text-green-500' : 'text-3xl text-red-500'"
                  :icon="
                    item[key] === true ? 'fa-solid fa-circle-check' : 'fa-solid fa-circle-xmark'
                  "
                />
              </div>
              <div v-else>
                {{ item[key] }}
              </div>
            </div>
          </div>
        </div>
      </div>
        <div class="text-right p-5 mr-10">
          <button class="bg-green-700 p-3 rounded-md text-white" @click="goTo('/table')">
            Come back
          </button>
        </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';

export default {
  name: 'show-details',
  data() {
    return {};
  },
  computed: {
    ...mapState(['selectedRow']),
  },
  mounted() {
    this.filterData(this.query);
  },
  methods: {
    ...mapActions(['goTo']),
    filterData(query) {
      if (query) {
        console.log('Filtering by query: ', query);
      } else {
        console.log('Showing details of: ', this.selectedRow);
      }
    },
    formatHead(head) {
      const headers = {
        id: 'ID',
        userId: 'User',
        typeId: 'Type',
        name: 'Name',
        rentedFrom: 'Rented From',
        rentedTo: 'Rented To',
        month: 'Month',
        isRented: 'Is rented',
      };
      return headers[head];
    },
  },
};
</script>

<style scoped>
#details-card {
  animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

</style>
