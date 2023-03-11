<template>
  <div id="app">
    <div class="max-w-5xl px-4 py-10 mx-auto">
      <TableProperties :properties="propertiesByUser" />
    </div>
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';
import TableProperties from '@/components/TableProperties.vue';

export default {
  name: 'App',
  components: {
    TableProperties,
  },
  data: () => ({
    users,
    propertyTypes,
    properties,
  }),
  computed: {
    propertiesByUser() {
      const urlParams = new URLSearchParams(window.location.search);
      const user = urlParams.get('user');

      const filtered = user != null
        ? this.properties.filter((property) => property.userId === parseInt(user, 10))
        : this.properties;

      return filtered.map((property) => ({
        ...property,
        user: this.userById[property.userId],
        type: this.propertyTypeById[property.typeId],
        rentedFrom: this.readableDate(property.rentedFrom),
        rentedTo: this.readableDate(property.rentedTo),
        rentedDuration: this.rentedDurationInMonth(property.rentedFrom, property.rentedTo),
        status: this.getStatus(property.rentedFrom, property.rentedTo),
      }));
    },
    // To avoid looping through the array every time we need to get the user name
    userById() {
      return this.users.reduce((acc, user) => {
        acc[user.id] = user.name;
        return acc;
      }, {});
    },
    // To avoid looping through the array every time we need to get the property type name
    propertyTypeById() {
      return this.propertyTypes.reduce((acc, propertyType) => {
        acc[propertyType.id] = propertyType.name;
        return acc;
      }, {});
    },
  },
  methods: {
    readableDate(date) {
      if (date == null) {
        return null;
      }

      // en-GB to get day-month-year format
      return new Date(date).toLocaleDateString('en-GB');
    },
    rentedDurationInMonth(rentedFrom, rentedTo) {
      const milisecondsInAMonth = 1000 * 60 * 60 * 24 * 30;

      if (rentedFrom == null) {
        return null;
      }

      if (rentedTo == null) {
        return Math.ceil((new Date() - new Date(rentedFrom)) / milisecondsInAMonth);
      }

      return Math.ceil((new Date(rentedTo) - new Date(rentedFrom)) / milisecondsInAMonth);
    },
    getStatus(rentedFrom, rentedTo) {
      if (rentedFrom == null) {
        return null;
      }

      if (rentedTo == null) {
        return 'Rented';
      }

      if (new Date(rentedTo) > new Date()) {
        return 'Rented';
      }

      return null;
    },
  },
};
</script>
