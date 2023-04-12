<template>

  <div class="bg-gray-300 shadow-lg">

    <table class="table-auto w-full">
      <thead class="bg-blue-500 text-white shadow-lg">
        <th v-for="(col, index) in headers" :key="index" class="px-4 py-3">
          {{ col.text }}
        </th>
      </thead>

      <tbody>
        <tr v-for="(property, ind) in properties" :key="ind"
          class="hover:bg-gray-100"
        >
          <td class="px-4 py-3">{{ property.id }}</td>
          <td class="px-4 py-3">{{ property.user }}</td>
          <td class="px-4 py-3">{{ property.type | capitalizeFirstLetter }}</td>
          <td class="">{{ property.name }}</td>
          <td class="px-4 py-3 text-center">{{ property.rentedFrom | formatDate }}</td>
          <td class="px-4 py-3 text-center">{{ property.rentedTo | formatDate }}</td>
          <td class="px-4 py-3 text-center">
            {{ calculateRentedMonths(property.rentedFrom, property.rentedTo) }}
          </td>
          <td class="px-4 py-3 text-center">
            {{ checkIfCurrentlyRented(property.rentedFrom, property.rentedTo) }}
          </td>
        </tr>
      </tbody>

    </table>

  </div>

</template>

<script>

export default {
  props: {
    properties: { type: Array, required: true },
  },
  data: () => ({
    headers: [
      { text: 'Id' },
      { text: 'User' },
      { text: 'Type' },
      { text: 'Name' },
      { text: 'Rented From' },
      { text: 'Rented To' },
      { text: 'Months Rented' },
      { text: 'Currently Rented' },
    ],
  }),
  methods: {
    checkIfCurrentlyRented(from, to) {
      const today = new Date();
      if (from && from <= today && (!to || to > today)) {
        return 'Yes';
      }
      return 'No';
    },
    calculateRentedMonths(from, to) {
      if (!from) return null;

      const last = to !== null ? to : new Date();
      let months = (last.getFullYear() - from.getFullYear()) * 12;
      months -= from.getMonth();
      months += last.getMonth();
      return months <= 0 ? 0 : months;
    },
  },
};
</script>
