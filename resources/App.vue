<template>
  <div id="app">
    <head>
      <title>Listado de Propiedades</title>
    </head>
    <body>
      <h1>Listado de Propiedades</h1>
      <table>
        <thead>
          <tr>
            <th>Nombre de la Propiedad</th>
            <th>Tipo de Propiedad</th>
            <th>Propietario</th>
            <th>Alquilada Desde</th>
            <th>Alquilada Hasta</th>
            <th>Actualmente Alquilada</th>
          </tr>
        </thead>
        <tbody id="propertyList">
          <tr v-for="(property, index) in properties" :key="index">
            <td>{{ property.name }}</td>
            <td>{{ getPropertyTypeName(property.typeId) }}</td>
            <td>{{ getUserName(property.userId) }}</td>
            <td>
              {{ property.rentedFrom ? property.rentedFrom.toLocaleDateString("es-ES") : "N/A" }}
            </td>
            <td>
              {{ property.rentedTo ? property.rentedTo.toLocaleDateString('es-ES') : "N/A" }}
            </td>
            <td>{{ property.rentedTo ? "Sí" : "No" }}</td>
          </tr>
        </tbody>
      </table>
    </body>
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';

export default {
  name: 'App',
  data: () => ({
    users,
    propertyTypes,
    properties,
  }),
  methods: {
    getPropertyTypeName(typeId) {
      const propertyType = this.propertyTypes.find((pt) => pt.id === typeId);
      return propertyType;
    },
    getUserName(userId) {
      const user = this.users.find((u) => u.id === userId);
      return user;
    },
  },
};
</script>
