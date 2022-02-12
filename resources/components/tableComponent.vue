<template>
    <div class="w-full rounded-xl">
      <div class="rounded-xl shadow-md  overflow-x-auto">
        <table class="w-full leading-normal">
          <thead
            class="font-semibold border-gray tracking-wider
            text-left  bg-gray-600 hover:cursor-pointer
            uppercase border-b-2 border-gray-200">
            <tr class="border-b border-gray">
              <th v-for="header in headers" :key="header.name"
                class="p-4 bg-gray-600 text-left text-white uppercase tracking-widest">
                {{header.name}}
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="hover:bg-gray-100" v-for="data in dataBody" :key="data.id">
              <td class="py-4 px-6 border-b border-gray-200">
                {{data.owner}}
              </td>
              <td class="py-4 px-6 border-b border-gray-200">
                {{data.name}}
              </td>
              <td class="py-4 px-6 border-b border-gray-200 min-width-cell">
                <div class="inline-flex items-center">
                    <type-property-component :type="data.type" />
                    <span class="ml-2"> {{data.type}}</span>
                </div>
              </td>
              <td class="py-4 px-6 border-b border-gray-200">
                {{formatDate(data.rentedFrom)}}
              </td>
              <td class="py-4 px-6 border-b border-gray-200">
                {{formatDate(data.rentedTo)}}
              </td>
              <td class="py-4 px-6 border-b border-gray-200">
                  <is-available-component :status="data.available"/>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</template>

<script>
import isAvailableComponent from './property/isAvailableComponent.vue';
import TypePropertyComponent from './property/typePropertyComponent.vue';

export default {
  components: { isAvailableComponent, TypePropertyComponent },
  name: 'TableComponent',
  props: {
    headers: {
      type: Array,
      default: () => [],
    },
    dataBody: {
      type: Array,
      default: () => [],
    },
  },
  methods: {
    formatDate(date) {
      if (date === null) {
        return '-';
      }

      const day = `0${date.getDate()}`.slice(-2);
      const month = `0${date.getMonth()}`.slice(-2);
      const year = date.getFullYear();

      return `${day}/${month}/${year}`;
    },
  },

};
</script>

<style scoped>
.min-width-cell {
    min-width: 132px;
}
</style>
