<template>
  <div class="flex flex-col justify-center items-center">
    <div>
      <div class="container-nav">
        <ul class="filter">
          <li
            id="show-filter-property"
            @click="conditionShowInput('showTypeProperty')"
          >Tipos de Propiedades</li>
          <li @click="conditionShowInput('showByUsers')">Usuarios</li>
          <li @click="conditionShowInput('showByDate')">Fechas</li>
        </ul>
        <div class="bg-secondary rounded-b-md" v-if="showTypeProperty">
          <ul v-for="prop in propertyTypes" :key="prop.id">
            <li @click="filterByProperties(prop)">{{ prop.name }}</li>
          </ul>
        </div>
        <div class="bg-secondary rounded-b-md" v-if="showByUsers">
          <ul v-for="user in users" :key="user.id">
            <li @click="filterByUsers(user)">{{ user.name }}</li>
          </ul>
        </div>
        <div v-if="showByDate" class="container-input-date">
          <form @submit.prevent="filterByDate(yearAndDay)">
            <label for="start">Desde</label>
            <input id="start" type="date" v-model="yearAndDay.start" required />
            <label for="end">Hasta</label>
            <input type="date" v-model="yearAndDay.end" required />
            <button type="submit">Buscar</button>
          </form>
        </div>
      </div>
    </div>
    <div class="text-xl font-bold text-center my-2" v-if="typeProperty">
      <h1>{{ titleFilter }}</h1>
      <p class="underline text-primary">{{ nameFilter }}</p>
    </div>
    <table v-if="dateUsers" class="border-2">
      <thead class="justify-center">
        <tr>
          <th class="border-r-2 p-2 bg-secondary">#</th>
          <th class="border-r-2 p-2 bg-secondary">Propiedades</th>
          <th class="border-r-2 p-2 bg-secondary">Meses Alquilada</th>
          <th class="border-r-2 p-2 bg-secondary">Disponibilidad</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="property in dateUsers" :key="property.id">
          <th class="border-2">{{ property.id }}</th>
          <th class="border-2">{{ property.name }}</th>
          <th class="border-2">{{ property.printMonth }}</th>
          <th v-if="property.availible" class="border-2">Libre</th>
          <th v-else class="border-2">Alquilada</th>
        </tr>
      </tbody>
    </table>
    <div v-else>
      <h1>No hay ningún elemento</h1>
    </div>
  </div>
</template>

<script>
import { properties } from '../mocks/api';

export default {
  props: {
    users: {
      type: Array,
    },
    properties: {
      type: Array,
    },
    propertyTypes: {
      type: Array,
    },

  },
  data() {
    return {
      dateUsers: [],
      showTypeProperty: false,
      showByUsers: false,
      showByDate: false,
      isActive: true,
      typeProperty: false,
      titleFilter: null,
      nameFilter: null,
      yearAndDay: {
        start: '',
        end: '',
      },
      month: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      availibleProp: [],
    };
  },
  methods: {

    filterByProperties(property) {
      this.restartTable();
      const temp = this.dateUsers.filter((prop) => prop.typeId === property.id);
      this.typeProperty = true;
      this.titleFilter = 'Tipo de propiedad';
      this.nameFilter = property.name;
      this.dateUsers = temp;
      return this.dateUsers;
    },

    filterByUsers(user, byParams) {
      this.restartTable();
      let filterResult = null;
      if (byParams) {
        filterResult = this.dateUsers.filter((prop) => prop.userId === Number(byParams));
      } else {
        filterResult = this.dateUsers.filter((prop) => prop.userId === user.id);
      }
      if (filterResult.length > 0) {
        this.dateUsers = filterResult;
      } else {
        this.dateUsers = false;
      }
      this.typeProperty = true;
      this.titleFilter = 'Usuario';
      this.nameFilter = user.name;
    },

    filterByDate(yearAndDay) {
      this.restartTable();
      const convertDateStart = new Date(yearAndDay.start);
      const convertDateEnd = new Date(yearAndDay.end);
      const filterAvailable = this.dateUsers.filter((e) => e.rentedFrom);
      for (let i = 0; i < filterAvailable.length; i += 1) {
        const dateStart = filterAvailable[i].rentedFrom;
        const dateEnd = filterAvailable[i].rentedTo;
        const temp = [];
        if (filterAvailable[i].rentedTo) {
          if (convertDateStart >= dateStart && convertDateEnd <= dateEnd) {
            temp.push(filterAvailable[i]);
            this.dateUsers = temp;
          } else {
            this.dateUsers = false;
          }
        }
      }
    },

    getMonthRent(date) {
      for (let i = 0; i < date.length; i += 1) {
        if (date[i].rentedTo) {
          const convertDateFrom = new Date(date[i].rentedFrom);
          const convertDateTo = new Date(date[i].rentedTo);
          const getMonthFrom = convertDateFrom.getMonth();
          const getMonthTo = convertDateTo.getMonth();
          this.dateUsers[i].rentedFrom = convertDateFrom;
          this.dateUsers[i].rentedTo = convertDateTo;
          this.dateUsers[i].printMonth = `${this.month[getMonthFrom]} ${convertDateFrom.getFullYear()} - ${this.month[getMonthTo]} ${convertDateTo.getFullYear()}`;
        } else if (date[i].rentedFrom) {
          const convertDateFrom = new Date(date[i].rentedFrom);
          const getMonthFrom = convertDateFrom.getMonth();
          this.dateUsers[i].rentedFrom = convertDateFrom;
          this.dateUsers[i].printMonth = `${this.month[getMonthFrom]} ${convertDateFrom.getFullYear()}`;
        } else {
          this.dateUsers[i].printMonth = null;
        }
      }
      this.checkProp(this.dateUsers);
      this.orderProperties();
    },

    checkProp(allProp) {
      const newDate = new Date();
      for (let i = 0; i < allProp.length; i += 1) {
        const convertDateFrom = new Date(allProp[i].rentedFrom);
        const convertDateTo = new Date(allProp[i].rentedTo);
        if (!allProp[i].rentedFrom && !allProp[i].rentedTo) {
          this.dateUsers[i].availible = true;
        } else if (allProp[i].rentedFrom && !allProp[i].rentedTo) {
          this.dateUsers[i].availible = false;
        } else if (convertDateFrom < newDate && convertDateTo < newDate) {
          this.dateUsers[i].availible = true;
        }
      }
      return this.dateUsers;
    },

    orderProperties() {
      return this.dateUsers.sort((a, b) => a.id - b.id);
    },

    conditionShowInput(inputCliked) {
      this.restartTable();
      switch (inputCliked) {
        case 'showTypeProperty':
          this.showTypeProperty = !this.showTypeProperty;
          this.showByUsers = false;
          this.showByDate = false;
          break;
        case 'showByUsers':
          this.showByUsers = !this.showByUsers;
          this.showTypeProperty = false;
          this.showByDate = false;
          break;
        case 'showByDate':
          this.showByDate = !this.showByDate;
          this.showByUsers = false;
          this.showTypeProperty = false;
          break;
        default:
          break;
      }

      this.$emit('input_click', this.showTypeProperty);
    },

    listenURlparameters() {
      const urlParams = new URLSearchParams(window.location.search);
      const route = urlParams.get('user');
      if (route != null) {
        this.goToParams(route);
      }
      return this.dateUsers;
    },

    goToParams(id) {
      this.filterByUsers(id, id);
      console.log(id, 'id');
    },

    restartTable() {
      this.clonedProperties();
      this.getMonthRent(this.dateUsers);
      this.typeProperty = false;
    },

    clonedProperties() {
      const temp = [];
      properties.forEach((prop) => {
        temp.push(prop);
      });
      this.dateUsers = temp;
    },
  },

  mounted() {
    this.clonedProperties();
    this.restartTable();
    this.orderProperties();
    this.listenURlparameters();
  },

};

</script>

<style scoped>
</style>
