import { defineStore } from 'pinia';
import { properties, propertyTypes, users } from '../mocks/api';

const propertiesStore = defineStore('allProperties', {
  state: () => ({
    allProperties: [],
    allPropertyTypes: [],
    allUsers: [],
  }),
  getters: {
    getAllProperties: (state) => state.allProperties,
    getAllPropertyTypes: (state) => state.allPropertyTypes,
    getAllUsers: (state) => state.allUsers,
  },
  actions: {
    fetchData() {
      try {
        const { propertiessData, error1 } = properties;
        const { propertyTypesData, error2 } = propertyTypes;
        const { usersData, error3 } = users;
        if (error1 || error2 || error3) {
          console.log('Error:', error1 || error2 || error3);
          return;
        }
        if (propertiessData === null) {
          this.allProperties = [];
          return;
        }
        if (propertyTypesData === null) {
          this.allPropertyTypes = [];
          return;
        }
        if (usersData === null) {
          this.allUsers = [];
          return;
        }
        this.allProperties = properties;
        this.allPropertyTypes = propertyTypes;
        this.allUsers = users;
      } catch (err) {
        console.error('Error retrieving data:', err);
      }
    },
  },
});

export default propertiesStore;
