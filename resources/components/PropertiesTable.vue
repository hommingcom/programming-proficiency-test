<template>
  <table border=1>
    <tr>
      <th v-for="(header, index) in headers" :key="index">{{header}}</th>
    </tr>
    <tr v-for="(property, index) in properties" :key="index">
      <td>{{property.user}}</td>
      <td>{{property.name}}</td>
      <td>{{property.rentedFrom | date}}</td>
      <td>{{property.rentedTo | date}}</td>
      <td>{{getMonthsRented(property.rentedFrom, property.rentedTo)}}</td>
      <td>{{isCurrentlyRented(property.rentedFrom, property.rentedTo)}}</td>
    </tr>
  </table>
</template>

<script>
export default {
  props: {
    properties: {
      type: Array,
      required: true,
    },
  },
  data: () => ({
    headers: [
      'User',
      'Property',
      'From',
      'To',
      'Months Rented',
      'Currently Rented',
    ],
  }),
  methods: {
    getMonthsRented(from, to) {
      if (!from) return null;
      const fromMonths = (from.getMonth() + 1) + 12 * from.getFullYear();
      const toMonths = to !== null
        ? (to.getMonth() + 1) + 12 * to.getFullYear()
        : (new Date().getMonth() + 1) + 12 * new Date().getFullYear();
      return toMonths - fromMonths + 1;
    },
    isCurrentlyRented(from, to) {
      const today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
      return from && from <= today && (!to || to >= today);
    },
  },
};
</script>
