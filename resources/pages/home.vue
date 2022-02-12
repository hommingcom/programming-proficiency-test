<template>
    <div class="container flex flex-col mx-auto">
      <section>
         filtros
      </section>
      <section class="px-2">
        <table-component :headers="headers"  :dataBody="dataFormatted"/>
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
  }),
  mounted() {
    this.getPropertiesWithOwner();
  },
  methods: {
    getPropertiesWithOwner() {
      this.dataFormatted = this.properties.map((data) => this.formatData(data));
    },
    formatData(property) {
      const owner = this.getOwner(property.userId);
      const propertyType = this.getType(property.typeId);
      const available = this.isAvailable(property.rentedFrom, property.rentedTo);

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
  },
};
</script>

<style>

</style>
