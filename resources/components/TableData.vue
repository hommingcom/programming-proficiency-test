<template>
  <div id="t-wrap">
    <table class="mx-auto justify-center items-center relative">
      <thead class="relative">
        <th
          v-for="(head, i) of headers"
          :key="i"
          scope="col"
          class="text-sm font-medium text-blue-400 px-6 py-4 text-center bg-gray-800"
        >
          {{ formatHead(head) }}
        </th>
      </thead>
      <tbody class="relative">
        <tr v-if="!data.length" class="flex flex-row w-full absolute top-0 bg-red-400 text-center">
          <h1 class="text-xl p-5 text-white w-full">No data found</h1>
        </tr>
        <tr
          v-for="(item, j) of data"
          :key="j"
          @click="showDetails(item)"
          class="bg-gray-900 text-green-300"
        >
          <td
            scope="col"
            v-for="(val, k) of item.values"
            :key="k"
            class="text-sm font-normal p-2 text-center"
          >
            <div v-if="val === true || val === false">
              <font-awesome-icon
                :class="val === true ? 'text-3xl text-green-500' : 'text-3xl text-red-500'"
                :icon="val === true ? 'fa-solid fa-circle-check' : 'fa-solid fa-circle-xmark'"
              />
            </div>
            <div v-else>
              {{ val }}
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'table-data',
  props: {
    headers: {
      type: Array,
      default: () => [],
    },
    data: {
      type: Array,
      default: () => [],
    },
  },
  methods: {
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
    showDetails(item) {
      this.$emit('show-details', item);
    },
  },
};
</script>

<style scoped>
table {
  animation: fadeIn 0.5s ease-out;
  box-shadow: 0px 5px 10px black, 0px 7px 15px #202020;
}

td,
thead {
  border: 1px solid rgb(121, 76, 158);
}

tr:hover {
  cursor: pointer;
  background: #bfbfff;
  color: #202020;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

#t-wrap {
  min-height: 150px;
  max-height: 500px;
  padding-bottom: 5px;
  overflow-y: scroll;
  position: sticky;
}
</style>
