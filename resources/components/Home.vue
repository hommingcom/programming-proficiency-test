<template>
  <div class="flex flex-col justify-center items-center">
    <div>
      <h2 class="text-center">Filtrar por:</h2>
      <div class="container-nav bg-purple w-50 my-2">
        <ul class="filter flex gap-3 p-3">
          <li @click="conditionShowInput('showTypeProperty')">Tipos de Propiedades</li>
          <li @click="conditionShowInput('showByUsers')">Usuarios</li>
          <li @click="conditionShowInput('showByDate')">Fechas</li>
        </ul>
        <div class="bg-orange" v-if="showTypeProperty">
          <ul v-for="prop in propertyTypes" :key="prop.id">
            <li @click="filterByProperties(prop)">{{ prop.name }}</li>
          </ul>
        </div>
        <div class="bg-orange" v-if="showByUsers">
          <ul v-for="user in users" :key="user.id">
            <li @click="filterByUsers(user)">{{ user.name }}</li>
          </ul>
        </div>
        <div v-if="showByDate" class="container-input-date">
          <form @submit.prevent="filterByDate(yearAndDay)">
            <input type="month" v-model="yearAndDay" />
            <button type="submit">Buscar</button>
          </form>
        </div>
      </div>
    </div>
    <div class="bg-pink text-center my-2" v-if="typeProperty">
      <h1>{{ titleFilter }}</h1>
      <p>{{ nameFilter }}</p>
    </div>
    <table class="border-2">
      <thead class="justify-center">
        <tr>
          <th class="border-r-2 bg-orange p-2">#</th>
          <th class="border-r-2 bg-orange p-2">Propiedades</th>
          <th class="border-r-2 bg-orange p-2">Meses Alquilada</th>
          <th class="border-r-2 bg-orange p-2">Disponibilidad</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="property in dateUsers" :key="property.id">
          <th class="border-2">{{ property.id }}</th>
          <th class="border-2">{{ property.name }}</th>
          <th class="border-2">{{ property.rentedFrom }}</th>
          <th v-if="property.rentedFrom" class="border-2">Alquilada</th>
          <th v-else class="border-2">Libre</th>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

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
      dateUsers: null,
      showTypeProperty: false,
      showByUsers: false,
      showByDate: false,
      isActive: true,
      typeProperty: false,
      titleFilter: null,
      nameFilter: null,
      yearAndDay: '2022-01',
      month: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      filterDay: null,
    };
  },
  methods: {

    filterByProperties(property) {
      this.restartTable();
      this.dateUsers = this.dateUsers.filter((prop) => prop.typeId === property.id);
      this.typeProperty = true;
      this.titleFilter = 'Tipo de propiedad';
      this.nameFilter = property.name;

      return this.dateUser;
    },

    filterByUsers(user) {
      this.restartTable();
      this.dateUsers = this.dateUsers.filter((prop) => prop.userId === user.id);
      this.typeProperty = true;
      this.titleFilter = 'Usuario';
      this.nameFilter = user.name;
    },

    filterByDate(date) {
      this.restartTable();
      const convertDate = new Date(date);
      const availible = [];
      this.dateUsers = availible;
      this.properties.forEach((prop) => {
        if (!prop.rentedFrom) {
          availible.push(prop);
        } else {
          if (convertDate > prop.rentedFrom && convertDate > prop.rentedTo) {
            availible.push(prop);
          }
          console.log('una logica');
          console.log(availible);
          return this.dateUsers;
        }
        return this.dateUsers;
      });
    },

    getMonthRent(date) {
      for (let i = 0; i < date.length; i += 1) {
        if (date[i].rentedTo) {
          const convertDateFrom = new Date(date[i].rentedFrom);
          const convertDateTo = new Date(date[i].rentedTo);
          const getMonthFrom = convertDateFrom.getMonth();
          const getMonthTo = convertDateTo.getMonth();
          this.dateUsers[i].rentedFrom = `${this.month[getMonthFrom]} ${convertDateFrom.getFullYear()} - ${this.month[getMonthTo]} ${convertDateTo.getFullYear()}`;
        } else if (date[i].rentedFrom) {
          const convertDateFrom = new Date(date[i].rentedFrom);
          const getMonthFrom = convertDateFrom.getMonth();
          this.dateUsers[i].rentedFrom = `${this.month[getMonthFrom]} ${convertDateFrom.getFullYear()}`;
        } else {
          this.dateUsers[i].rentendfrom = false;
        }
      }
      this.orderProperties();
    },

    orderProperties() {
      return this.dateUsers.sort((a, b) => a.id - b.id);
    },

    checkAvailible() {
      const newDate = new Date();
      console.log(newDate);
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
    },
    restartTable() {
      this.dateUsers = JSON.parse(JSON.stringify(this.properties));
      this.getMonthRent(this.dateUsers);
      this.typeProperty = false;
    },
  },

  mounted() {
    this.restartTable();
    this.orderProperties();
  },

};

</script>

<style scoped>
</style>
