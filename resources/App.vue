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
        ? this.propertiesMock.filter((property) => property.userId === parseInt(user, 10))
        : this.propertiesMock;

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
    // Add 1000 more properties to test pagination
    propertiesMock() {
      const data = [...this.properties];

      for (let i = 0; i < 1000; i += 1) {
        data.push({
          id: i + 9,
          userId: Math.floor(Math.random() * 3) + 1,
          typeId: Math.floor(Math.random() * 3) + 1,
          name: `Property ${i + 1}`,
          rentedFrom: new Date(
            2020,
            Math.floor(Math.random() * 12),
            Math.floor(Math.random() * 28),
          ),
          rentedTo: Math.floor(Math.random() * 2)
            ? new Date(2021, Math.floor(Math.random() * 12), Math.floor(Math.random() * 28))
            : null,
        });
      }

      return data;
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
