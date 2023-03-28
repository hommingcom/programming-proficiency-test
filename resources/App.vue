<template>
  <div class="p-8" id="app">
    <h1 class="text-center block mb-4 font-bold">PRUEBA HOMMING</h1>
    <div class="flex flex-row mb-4">
      <div class="w-1/4">
        <label class="block mb-2 text-gray-700 font-bold" for="user-select">
          User
        </label>
        <div class="relative">
          <select class="w-3/4 block appearance-none bg-white border border-gray-400
          hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight
          focus:outline-none focus:shadow-outline" id="user-select" v-model="selectedUser">
            <option value="">All</option>
            <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
          </select>
        </div>
      </div>
      <div class="w-1/4">
        <label class="block mb-2 text-gray-700 font-bold" for="type-select">
          Property Type
        </label>
        <div class="relative">
          <select class="w-3/4 block appearance-none bg-white border border-gray-400
            hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none
            focus:shadow-outline" id="type-select" v-model="selectedType">
            <option value="">All</option>
            <option v-for="propType in propertyTypes" :key="propType.id" :value="propType.id">
              {{propType.name}}
            </option>
          </select>
        </div>
      </div>
      <div class="w-1/4">
        <label class="block mb-2 text-gray-700 font-bold" for="type-select">
          Rented From
        </label>
        <input class="w-3/4 block appearance-none bg-white border border-gray-400
          hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight
          focus:outline-none focus:shadow-outline"
        type="date" v-model="rentedFrom">
      </div>
      <div class="w-1/4">
        <label class="block mb-2 text-gray-700 font-bold" for="type-select">
          Rented From
        </label>
        <input class="w-3/4 block appearance-none bg-white border border-gray-400
          hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight
          focus:outline-none focus:shadow-outline"
          type="date" v-model="rentedTo">
      </div>
    </div>
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table class="min-w-full text-left text-sm font-light">
              <thead
                class="border-b text-white dark:border-neutral-500 font-medium bg-neutral-800">
                <tr>
                  <th scope="col" class="px-6 py-4 text-center">Name</th>
                  <th scope="col" class="px-6 py-4 text-center">Type</th>
                  <th scope="col" class="px-6 py-4 text-center">User</th>
                  <th scope="col" class="px-6 py-4 text-center">Rented From</th>
                  <th scope="col" class="px-6 py-4 text-center">Rented To</th>
                  <th scope="col" class="px-6 py-4 text-center">Months Rented</th>
                  <th scope="col" class="px-6 py-4 text-center">Actually Rented</th>
                </tr>
              </thead>
              <tbody>
                  <tr class="border-b dark:border-neutral-500"
                    v-for="property in filteredProperties" :key="property.id">
                    <td class="whitespace-nowrap text-center px-6 py-4">
                      {{ property.name }}
                    </td>
                    <td class="whitespace-nowrap text-center px-6 py-4">
                      {{ getPropertyType(property.typeId).name }}
                    </td>
                    <td class="whitespace-nowrap text-center px-6 py-4">
                      {{ getUser(property.userId).name }}
                    </td>
                    <td class="whitespace-nowrap text-center px-6 py-4">
                      {{ formatDate(property.rentedFrom) }}
                    </td>
                    <td class="whitespace-nowrap text-center px-6 py-4">
                      {{ formatDate(property.rentedTo) }}
                    </td>
                    <td class="whitespace-nowrap text-center px-6 py-4">
                      {{ getMonthsRented(property.rentedFrom, property.rentedTo) }}
                    </td>
                    <td class="whitespace-nowrap text-center px-6 py-4">
                      {{ isPropertyRented(property.rentedFrom, property.rentedTo) }}
                    </td>
                  </tr>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
</template>
<script>
import './assets/index.css';
import { users, propertyTypes, properties } from '@/mocks/api';

export default {
  data() {
    return {
      filteredProperties: properties,
      selectedUser: '',
      selectedType: '',
      rentedFrom: '',
      rentedTo: '',
      users: users ?? '',
      propertyTypes: propertyTypes ?? '',
    };
  },
  beforeMount() {
    // Obtener parámetros de la URL
    const params = new URLSearchParams(window.location.search);

    // Obtener los valores de los parámetros
    if (params.get('user')) {
      this.selectedUser = params.get('user');
    }
    if (params.get('rentedFrom')) {
      this.rentedFrom = params.get('rentedFrom');
    }
    if (params.get('rentedTo')) {
      this.rentedTo = params.get('rentedTo');
    }
    if (params.get('propertyType')) {
      this.selectedType = params.get('propertyType');
    }
  },
  methods: {
    preparefilter() {
      const usr = Number(this.selectedUser);
      const rFrom = this.rentedFrom;
      const rTo = this.rentedTo;
      const Ptype = Number(this.selectedType);

      this.filteredProperties = this.filterProp(usr, rFrom, rTo, Ptype);
    },
    filterProp(userId, rentedFrom, rentedTo, selectedType) {
      let returnProp = [];

      if (!rentedTo) {
        returnProp = properties.filter((property) => (!userId || property.userId === userId)
        && (!selectedType || property.typeId === selectedType)
        && (!rentedFrom || property.rentedFrom >= new Date(rentedFrom)));
      } else if (!rentedFrom) {
        returnProp = properties.filter((property) => (!userId || property.userId === userId)
        && (!selectedType || property.typeId === selectedType)
        && (property.rentedTo !== null && property.rentedTo <= new Date(rentedTo)));
      } else {
        returnProp = properties.filter((property) => (!userId || property.userId === userId)
        && (!selectedType || property.typeId === selectedType)
        && ((!rentedFrom || rentedTo) && property.rentedFrom <= new Date(rentedTo))
        && ((!rentedTo || rentedFrom) && property.rentedTo >= new Date(rentedFrom)));
      }

      return returnProp;
    },
    getPropertyType(typeId) {
      return propertyTypes.find((type) => type.id === typeId);
    },
    getUser(userId) {
      return users.find((user) => user.id === userId);
    },
    formatDate(date) {
      if (!date) {
        return '-';
      }
      const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
      return new Date(date).toLocaleDateString('es-ES', options);
    },
    getMonthsRented(rentedTo, rentedFrom) {
      if (rentedFrom && rentedTo) {
        const monthsRented = (rentedTo.getFullYear() - rentedFrom.getFullYear()) * 12;
        return Math.abs(monthsRented - rentedFrom.getMonth() + rentedTo.getMonth());
      }
      return '-';
    },
    isPropertyRented(rentedTo, rentedFrom) {
      return rentedFrom !== null && rentedTo !== null ? 'No' : 'Yes';
    },
  },
  watch: {
    selectedUser() {
      this.preparefilter();
    },
    selectedType() {
      this.preparefilter();
    },
    rentedFrom() {
      this.preparefilter();
    },
    rentedTo() {
      this.preparefilter();
    },
  },
};
</script>
