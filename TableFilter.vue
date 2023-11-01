<template>
    <table>
      <thead>
        <tr>
          <th v-for="col in columns" :key="col">{{ col }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="prop in rowsfilter" :key="prop.id">
          <td class="table-center">{{ prop.id }}</td>
          <td>{{ propertyTypes.find((item) => item.id === prop.typeId).name }}</td>
          <td>{{ users.find((item) => item.id === prop.userId).name }}</td>
          <td>{{ prop.name }}</td>
          <td class="table-center">{{ formatDate(prop.rentedFrom) }}</td>
          <td class="table-center">{{ formatDate(prop.rentedTo) }}</td>
          <td class="table-center">{{ diffMonths (prop.rentedFrom, prop.rentedTo) }}</td>
          <td class="table-center">{{ prop.rentedFrom != null ? 'Yes' : 'No' }}</td>
        </tr>
      </tbody>
    </table>
</template>

<script>
import {
  users,
  propertyTypes,
} from '@/mocks/api';

export default {
  props: ['rowsfilter'],
  data: () => ({
    users,
    propertyTypes,
    columns: ['Id', 'Type', 'User', 'Name', 'Rented from', 'Rented to', 'Months rented', 'Rented out'],
  }),
  methods: {
    formatDate(date) {
      return date != null ? `${date.getFullYear()}-${(`0${date.getMonth() + 1}`).slice(-2)}-${(`0${date.getDate()}`).slice(-2)}` : '';
    },
    diffMonths(dFrom, dTo) {
      if (dFrom != null && dTo != null && dFrom instanceof Date && dTo instanceof Date) {
        let diff = (dTo.getTime() - dFrom.getTime()) / 1000;
        diff /= (60 * 60 * 24 * 7 * 4);
        return Math.abs(Math.round(diff));
      }
      return '';
    },
  },
};
</script>
