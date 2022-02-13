<template>
  <div class="container px-3 flex flex-col mx-auto">

      <div class="block md:hidden mb-5">
        <button :class="open ? 'bg-green-600 text-white' :'bg-transparent text-black'"
         class=" border-2 border-green-400 px-4 py-2 rounded-3xl focus:bg-green-600
        focus:text-white font-bold tracking-wider hover:cursor-pointer w-full"
          @click="toggle()">
          Filtrar
        </button>
      </div>

    <section :class="open ? 'block' :'hidden' "
    class="mb-5 px-3 md:flex flex-col md:flex-row md:items-center md:justify-around
        space-y-5 md:space-y-0">
      <div class="mb-2 md:mb-0">
        <div class="px-4 py-2 border-2 border-grey rounded-3xl relative">
          <label class="absolute -my-4 -mx-2 tracking-wider bg-white px-2 text-grey-darker">
            Filtro Propietario
          </label>
          <input type="text" name="owner" class=" appearance-none border-2 border-white
              rounded w-full py-2 text-grey-darker leading-tight focus:outline-none
            focus:bg-white focus:border-white" placeholder="Propietario..."
            v-model="filters.owner"/>
        </div>
      </div>

      <div class="mb-2 md:mb-0">
        <div class="px-4 py-2 border-2 border-grey rounded-3xl relative">
          <label class="absolute -my-4 -mx-2 tracking-wider bg-white px-2 text-grey-darker">
            Tipo
          </label>
          <select v-model="filters.type" class="appearance-none border-2 border-white bg-white
              rounded w-full py-2 text-grey-darker leading-tight focus:outline-none
              focus:bg-white focus:border-white">
            <option selected="selected" value="">Seleciona una opción</option>
            <option v-for="type in propertyTypes" :key="type.id" :value="type.name">
              {{ type.name }}
            </option>
          </select>
        </div>
      </div>

      <div class="flex flex-col md:flex-row">
        <div class="mb-2 md:mb-0">
          <div class="px-4 py-2 border-2 border-grey rounded-3xl relative">
            <label class="absolute -my-4 -mx-2 tracking-wider bg-white px-2 text-grey-darker">
              Fecha inicio
            </label>
            <input type="date" name="starDate" class="appearance-none border-2 border-white
                rounded w-full py-2 bg-white text-grey-darker leading-tight focus:outline-none
              focus:bg-white focus:border-white" placeholder="Fecha inicio..."
              v-model="filters.rentedFrom"/>
          </div>
        </div>
        <div class="mb-2 md:mb-0 md:ml-2">
          <div class="px-4 py-2 border-2 border-grey rounded-3xl relative">
            <label class="absolute -my-4 -mx-2 tracking-wider bg-white px-2 text-grey-darker">
              Fecha fin
            </label>
            <input type="date" name="endDate" class="appearance-none border-2 border-white rounded
                w-full py-2 bg-white text-grey-darker leading-tight focus:outline-none
              focus:bg-white focus:border-white" placeholder="Fecha final..."
              v-model="filters.rentedTo"
            />
          </div>
        </div>
      </div>

      <div>
        <button class=" border-2 border-red-400 px-4 py-2 rounded-3xl hover:bg-red-500
        hover:text-white font-bold tracking-wider hover:cursor-pointer w-full"
          @click="resetFilters()">
          Borrar filtros
        </button>
      </div>
    </section>

    <section class="px-2">
      <table-component :headers="headers" :dataBody="filteredData" />
    </section>
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';
import tableComponent from '../components/tableComponent.vue';

export default {
  components: { tableComponent },
  name: 'Home',
  data: () => ({
    open: false,
    users,
    propertyTypes,
    properties,
    headers: [
      { name: 'Propietario', value: 'owner' },
      { name: 'Propiedad / Dirección', value: 'name' },
      { name: 'Tipo', value: 'type' },
      { name: 'Inicio alquiler', value: 'rentedFrom' },
      { name: 'final alquiler', value: 'rentedTo' },
      { name: 'Estado', value: 'isRented' },
    ],
    dataFormatted: [],
    filters: {
      owner: '',
      type: '',
      rentedFrom: '',
      rentedTo: '',
    },
  }),
  computed: {
    filteredData() {
      // return this.dataFormatted.filter((item) => !item.type.indexOf(this.filters.type));

      let data = [...this.dataFormatted];

      if (this.filters.owner !== null && this.filters.owner !== '') {
        data = data.filter((item) => item.owner.toLowerCase()
          .includes(this.filters.owner.toLowerCase()));
      }
      if (this.filters.type !== null && this.filters.type !== '') {
        data = data.filter((item) => item.type === this.filters.type);
      }
      if (this.filters.rentedFrom !== null && this.filters.rentedFrom !== '') {
        data = data.filter(
          (item) => item.rentedFrom > new Date(this.filters.rentedFrom),
        );
      }
      if (this.filters.rentedTo !== null && this.filters.rentedTo !== '') {
        debugger;
        data = data.filter(
          (item) => item.rentedTo < new Date(this.filters.rentedTo),
        );
      }

      return data;
    },
  },
  mounted() {
    this.getPropertiesWithOwner();
    this.getUrlQueryParams();
  },
  methods: {
    toggle() {
      this.open = !this.open;
    },
    resetFilters() {
      this.filters.owner = '';
      this.filters.type = '';
      this.filters.rentedFrom = '';
      this.filters.rentedTo = '';
    },
    getPropertiesWithOwner() {
      this.dataFormatted = this.properties.map((data) => this.formatData(data));
    },
    formatData(property) {
      const owner = this.getOwner(property.userId);
      const propertyType = this.getType(property.typeId);
      const available = this.isAvailable(
        property.rentedFrom,
        property.rentedTo,
      );

      return {
        property: property.id,
        owner,
        name: property.name,
        type: propertyType,
        rentedFrom: property.rentedFrom,
        rentedTo: property.rentedTo,
        available,
      };
    },
    getOwner(ownerId) {
      return this.users.find((user) => user.id === ownerId).name;
    },
    getType(typeId) {
      return this.propertyTypes.find((type) => type.id === typeId).name;
    },
    isAvailable(startDate, endDate) {
      const today = new Date();

      if (startDate === null && endDate === null) {
        return true;
      }

      if (startDate >= today && endDate === null) {
        return true;
      }
      if (startDate <= today && endDate <= today && endDate !== null) {
        return true;
      }

      return false;
    },
    getUrlQueryParams() {
      const params = this.$route.query;
      const paramsKeys = Object.keys(params);

      paramsKeys.forEach((key) => {
        switch (key) {
          case 'type':
            this.filters.type = params[key];
            break;
          case 'rentedFrom':
            this.filters.rentedFrom = params[key];
            break;
          case 'rentedTo':
            this.filters.rentedTo = params[key];
            break;
          case 'owner':
            this.filters.owner = params[key];
            break;
          default:
            break;
        }
      });
    },
  },
};
</script>

<style>
</style>
