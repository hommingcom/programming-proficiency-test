<template>
  <div class="flex justify-center items-center pt-12">
    <div class="p-8 bg-gray-50 rounded-lg shadow-lg max-w-5xl w-full">
      <h2 class="text-2xl font-bold text-center mb-6 flex items-center justify-center space-x-2">
        <img src="../images/property-icon.png" alt="House Icon" class="h-5 w-5"/>
        <span>Listing of Properties</span>
      </h2>
      <div class="flex space-x-4 mb-6">
        <Dropdown
          class="w-1/3"
          label="Property Type:"
          :options="propertyTypes"
          v-model="selectedPropertyType"
        />
        <Dropdown
          class="w-1/3"
          label="User:"
          :options="users"
          v-model="selectedUser"
        />
        <Dropdown
          class="w-1/3"
          label="Year:"
          :options="years"
          v-model="selectedYear"
        />
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full table-auto bg-white shadow-md rounded-lg">
          <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2 text-left font-semibold text-gray-600">Name</th>
            <th class="px-4 py-2 text-left font-semibold text-gray-600">Months Rented</th>
            <th class="px-4 py-2 text-left font-semibold text-gray-600">Being Rented Out</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="property in filteredProperties" :key="property.id"
              class="border-t hover:bg-gray-50">
            <td class="px-4 py-2">{{ property.name }}</td>
            <td class="px-4 py-2">{{ calculateMonths(property.rentedFrom, property.rentedTo) }}</td>
            <td class="px-4 py-2">{{ isBeingRented(property.rentedFrom, property.rentedTo) }}</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import { getFiltersFromURL } from '@/utils/urlFilters';
import Dropdown from './Dropdown.vue';

export default {
  name: 'PropertiesTable',
  components: {
    Dropdown,
  },
  props: {
    properties: Array,
    users: Array,
    propertyTypes: Array,
  },
  data() {
    return {
      selectedUser: null,
      selectedPropertyType: null,
      selectedYear: null,
    };
  },
  computed: {
    /*
     You asked to filter by date, and as I wasn't sure what to do with those with no rentedTo date
     I thought the most logical option was to just filter by year, so I'm getting the year it was
     rented from the date and filtering by that year.
     */
    years() {
      return [...new Set(
        this.properties
          .filter((property) => property.rentedFrom)
          .map((property) => new Date(property.rentedFrom).getFullYear()),
      )]
        .sort((a, b) => b - a)
        .map((year) => ({
          id: year,
          name: year.toString(),
        }));
    },
    filteredProperties() {
      return this.properties.filter((property) => (
        (this.selectedUser === null || property.userId === this.selectedUser)
        && (this.selectedPropertyType === null || property.typeId === this.selectedPropertyType)
        // eslint-disable-next-line max-len
        && (this.selectedYear === null || (property.rentedFrom && new Date(property.rentedFrom).getFullYear() === this.selectedYear))
      ));
    },
  },
  methods: {
    /*
      With this method we calculate the exactly months that a property has been rented,
      if it has not been rented, it will print - (not rented).
      If the property has no rentedTo I guess it means that it's still being rented, so I will take
      the rentedTo as today's date to calculate the months.
     */
    calculateMonths(rentedFrom, rentedTo) {
      if (!rentedFrom && !rentedTo) return '-';
      const start = new Date(rentedFrom);
      const end = rentedTo ? new Date(rentedTo) : new Date();
      const months = (end.getFullYear() - start.getFullYear()) * 12
        + (end.getMonth() - start.getMonth());
      return months > 0 ? months : 0;
    },
    isBeingRented(rentedFrom, rentedTo) {
      return rentedFrom && !rentedTo;
    },
    /*
     For the optional task Listen to URL parameters to filter on page load. e.g. ?user=1
     */
    setFiltersFromURL() {
      const filters = getFiltersFromURL(this.$route.query, {
        user: null,
        propertyType: null,
        year: null,
      });
      this.selectedUser = filters.user;
      this.selectedPropertyType = filters.propertyType;
      this.selectedYear = filters.year;
    },
  },
  watch: {
    '$route.query': 'setFiltersFromURL',
  },
  mounted() {
    this.setFiltersFromURL(); // Apply filters when the component mounts
  },
};
</script>
