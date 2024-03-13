<template>
  <div id="app" class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="w-full flex justify-around">
      <div class="p-4">
        <select
          id="propertyTypeFilter"
          v-model="selectedPropertyType"
          @change="updateUrl"
          class="
            w-full p-2 block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent
            border-0 border-b-2 border-gray-200 appearance-none
            focus:outline-none focus:ring-0 focus:border-gray-200 peer"
        >
          <option selected value="">Tipo de Propiedad:</option>
          <option
            v-for="type in propertyTypes"
            :key="type.id"
            :value="type.id"
          >
            {{ type.name }}
          </option>
        </select>
      </div>
      <div class="p-4">
        <select
          id="userFilter"
          v-model="selectedUser"
          @change="updateUrl"
          class="
            p-2 block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent
            border-0 border-b-2 border-gray-200 appearance-none
            focus:outline-none focus:ring-0 focus:border-gray-200 peer w-full"
        >
          <option selected value="">Usuario:</option>
          <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
        </select>
      </div>
      <div class="p-4">
        <input type="date" id="dateFilter" @change="updateUrl" v-model="selectedDate" class="p-2">
      </div>
    </div>
    <br>
    <table class="w-full text-sm text-center rtl:text-right text-gray-500 ">
      <thead class="
        text-xs
        text-white
        uppercase
        bg-[#5B253BE6]
      ">
        <tr>
          <th scope="col" class="border px-6 py-3">Id</th>
          <th scope="col" class="border px-6 py-3">Usuario</th>
          <th scope="col" class="border px-6 py-3">Tipo</th>
          <th scope="col" class="border px-6 py-3">Nombre</th>
          <th scope="col" class="border px-6 py-3">Alquilado desde</th>
          <th scope="col" class="border px-6 py-3">Alquilado hasta</th>
          <th scope="col" class="border px-6 py-3">Meses Alquilado</th>
          <th scope="col" class="border px-6 py-3">¿Está alquilado?</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="property in filteredProperties" :key="property.id" class="
          bg-white
          border-b
          hover:bg-gray-100
        ">
          <td scope="row" class="px-6 py-4 font-medium text-gray-900s whitespace-nowrap">
            {{ property.id }}
          </td>
          <td class="p-2">{{ getUserById(property.userId).name }}</td>
          <td class="p-2">{{ getPropertyTypeById(property.typeId).name }}</td>
          <td class="p-2">{{ property.name }}</td>
          <td class="p-2">{{ formatDate(property.rentedFrom) }}</td>
          <td class="p-2">{{ formatDate(property.rentedTo) }}</td>
          <td class="p-2">{{ calculateMonthsRented(property) }}</td>
          <td class="p-2">{{ isCurrentlyRented(property) ? 'Sí' : 'No' }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';

export default {
  name: 'App',
  data() {
    return {
      users,
      propertyTypes,
      properties,
      selectedPropertyType: '',
      selectedUser: '',
      selectedDate: '',
    };
  },
  computed: {
    filteredProperties() {
      let filtered = this.properties;
      if (this.selectedPropertyType) {
        filtered = filtered.filter((property) => property.typeId === this.selectedPropertyType);
      }
      if (this.selectedUser) {
        filtered = filtered.filter((property) => property.userId === this.selectedUser);
      }
      if (this.selectedDate) {
        const selectedDate = new Date(this.selectedDate);
        selectedDate.setUTCHours(0, 0, 0, 0);
        filtered = filtered.filter((property) => {
          const rentedFromDate = new Date(property.rentedFrom);
          rentedFromDate.setUTCHours(0, 0, 0, 0);
          const rentedToDate = new Date(property.rentedTo);
          rentedToDate.setUTCHours(0, 0, 0, 0);
          return (
            selectedDate.getTime() >= rentedFromDate.getTime()
            && selectedDate.getTime() <= rentedToDate.getTime()
          );
        });
      }
      return filtered;
    },
  },
  methods: {
    getUserById(userId) {
      return this.users.find((user) => user.id === userId);
    },
    getPropertyTypeById(typeId) {
      return this.propertyTypes.find((type) => type.id === typeId);
    },
    formatDate(date) {
      const options = { year: 'numeric', month: 'numeric', day: 'numeric' };
      return new Date(date).toLocaleDateString(undefined, options);
    },
    calculateMonthsRented(property) {
      const rentedFrom = new Date(property.rentedFrom);
      const rentedTo = new Date(property.rentedTo);

      const monthsDiff = (rentedTo.getFullYear() - rentedFrom.getFullYear()) * 12
        + (rentedTo.getMonth() - rentedFrom.getMonth());

      const isSameMonth = rentedTo.getDate() >= rentedFrom.getDate();

      return isSameMonth ? monthsDiff : monthsDiff - 1;
    },
    isCurrentlyRented(property) {
      const currentDate = new Date();
      const rentedFrom = new Date(property.rentedFrom);
      const rentedTo = new Date(property.rentedTo);
      return currentDate >= rentedFrom && currentDate <= rentedTo;
    },
    updateUrl() {
      const params = new URLSearchParams();
      if (this.selectedPropertyType) {
        params.set('propertyType', this.selectedPropertyType);
      }
      if (this.selectedUser) {
        params.set('user', this.selectedUser);
      }
      if (this.selectedDate) {
        params.set('date', this.selectedDate);
      }
      const newUrl = `${window.location.pathname}?${params.toString()}`;
      window.history.pushState({}, '', newUrl);
    },
  },
  mounted() {
    const urlParams = new URLSearchParams(window.location.search);
    this.selectedPropertyType = urlParams.get('propertyType') || '';
    this.selectedUser = urlParams.get('user') || '';
    this.selectedDate = urlParams.get('date') || '';
    this.applyFilters();
  },
};
</script>
