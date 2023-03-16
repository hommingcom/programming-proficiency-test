<template>
  <div class='bg-gray-50 min-h-screen'>
    <div class='bg-white shadow-lg p-6 mb-8'>
      <h1 class='text-3xl font-bold text-gray-900'>Homming Programming Assessment</h1>
    </div>
    <div class='flex flex-wrap justify-between mb-4 w-full'>
      <div class='sm:w-1/2 md:w-1/5 ml-6 mb-4 md:mb-0'>
        <label class='block text-gray-700 font-bold mb-2' for='filter-property-type'>Property type:
        </label>
        <select class='form-select w-full py-2 px-3 border border-gray-400 rounded-lg
        shadow-sm focus:outline-none focus:border-blue-500' placeholder='All'
        id='filter-property-type' v-model='selectedPropertyType'>
          <option value=''>All</option>
          <option v-for='propertyType in allPropertyTypes' :key='propertyType.id'
          :value='propertyType.id'>
            {{ propertyType.name.charAt(0).toUpperCase() + propertyType.name.slice(1) }}
          </option>
        </select>
      </div>
      <div class='sm:w-1/2 md:w-1/5 mb-4 md:mb-0'>
        <label class='block text-gray-700 font-bold mb-2' for='filter-user'>User:</label>
        <select class='form-select w-full py-2 px-3 border border-gray-400 rounded-lg shadow-sm
        focus:outline-none focus:border-blue-500' placeholder='All' id='filter-user'
        v-model='selectedUser'>
          <option value=''>All</option>
          <option v-for='user in allUsers' :key='user.id' :value='user.id'>{{ user.name }}</option>
        </select>
      </div>
      <div class='sm:w-1/2 md:w-1/5 mb-4 md:mb-0'>
        <label class='block text-gray-700 font-bold mb-2' for='filter-available-from'>
        Available from:</label>
        <datepicker class='w-full py-2 px-3 border border-gray-400 rounded-lg shadow-sm
        focus:outline-none focus:border-blue-500' id='filter-available-from'
        v-model='selectedAvailableFrom' format='dd-MM-yyyy' placeholder='dd/mm/yyy'
        clear-button typeable></datepicker>
      </div>
      <div class='sm:w-1/2 mr-6 md:w-1/5 mb-4 md:mb-0'>
        <label class='block text-gray-700 font-bold mb-2' for='filter-available-to'>
        Available to:</label>
        <datepicker class='w-full py-2 px-3 border border-gray-400 rounded-lg shadow-sm
        focus:outline-none focus:border-blue-500' id='filter-available-to'
        v-model='selectedAvailableTo' format='dd-MM-yyyy' placeholder='dd/mm/yyy'
        clear-button typeable></datepicker>
      </div>
    </div>
      <table class='table-auto w-full'>
        <thead>
          <tr class='bg-gray-100 flex flex-row justify-evenly'>
            <th class='w-1/3 px-4 py-2 text-center'>Name</th>
            <th class='w-1/3 px-4 py-2 text-center'>Months rented</th>
            <th class='w-1/3 px-4 py-2 text-center'>Available</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for='(property, index) in filteredProperties' :key='index' class='border-b
          border-gray-200 hover:bg-gray-100 w-full'>
            <Property class='border px-4 py-2' :property='property' />
          </tr>
        </tbody>
      </table>
  </div>
</template>

<script>
import { mapStores } from 'pinia';
import Datepicker from 'vuejs-datepicker';
import propertiesStore from '../stores/properties';
import Property from './Property.vue';

export default {
  name: 'PropertiesTable',
  components: {
    Property,
    Datepicker,
  },
  data() {
    return {
      allProperties: [],
      allPropertyTypes: [],
      allUsers: [],
      selectedPropertyType: '',
      selectedUser: '',
      selectedAvailableFrom: '',
      selectedAvailableTo: '',
    };
  },
  computed: {
    ...mapStores(propertiesStore),

    /**
    *  Filters the data set based on several conditions (property type,
    *  users based both on selection and url query string, availability...).
    *  @return {boolean} to decide whether the property should be shown or not.
    */
    filteredProperties() {
      const queryString = new URLSearchParams(window.location.search).get('user');
      const urlUser = queryString ? parseInt(queryString, 10) : null;

      return this.allProperties.filter((property) => {
        // Filter by property type
        if (this.selectedPropertyType && this.selectedPropertyType !== property.typeId) {
          return false;
        }

        // Filter by user through selector
        if (this.selectedUser && this.selectedUser !== property.userId) {
          return false;
        }

        // Filter by user through url query string
        if (urlUser !== null && urlUser !== property.userId) {
          return false;
        }

        // Filter by available date
        const start1 = property.rentedFrom;
        const start2 = this.selectedAvailableFrom;
        const end1 = property.rentedTo;
        const end2 = this.selectedAvailableTo;
        if (start2 || end2) {
          if (start1 && !end1) {
            return false;
          }
          if (!start1 && !end1) {
            return true;
          }
          if ((start2 <= start1 && start1 <= end2) || (start2 <= end1 && end1 <= end2)) {
            return false;
          }
          if ((start1 <= start2 && start2 <= end1) || (start1 <= end2 && end2 <= end1)) {
            return false;
          }
        }
        return true;
      });
    },
  },
  methods: {
    /**
    *  Retrieves the necessary data to operate through the component.
    *  @return {array} of all the propertyies.
    *  @return {array} of all the property types.
    *  @return {array} of all the users.
    */
    fetchData() {
      const store = propertiesStore();
      store.fetchData();
      this.allProperties = store.getAllProperties;
      this.allPropertyTypes = store.getAllPropertyTypes;
      this.allUsers = store.getAllUsers;
    },
  },
  mounted() {
    this.fetchData();
  },
};
</script>
