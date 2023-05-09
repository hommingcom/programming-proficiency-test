<!-- eslint-disable max-len -->
<!-- eslint-disable max-len -->
<template>
  <div>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>UserId</th>
          <th>TypeId</th>
          <th>Name</th>
          <th>RentedFrom</th>
          <th>RentedTo</th>
          <th>RentalDuration</th>
          <th>ForRent</th>
          <th>UserId</th>
          <th>UserName</th>
          <th>PropertyId</th>
          <th>PropertyName</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(property, indix) of combinedObject" :key="indix">
          <td>{{ property.id }}</td>
          <td>{{ property.userId }}</td>
          <td>{{ property.typeId }}</td>
          <td>{{ property.nameStreet }}</td>
          <td>{{ property.rentedFrom }}</td>
          <td>{{ property.rentedTo }}</td>
          <td>{{ rentalDuration(property) }} Ms</td>
          <td>{{ forRent(property) }}</td>
          <td>{{ property.idUser }}</td>
          <td>{{ property.userName }}</td>
          <td>{{ property.idProTypes }}</td>
          <td>{{ property.name }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { users as usersHomming, propertyTypes as propertyTypesH, properties as propertiesData } from '@/mocks/api';

export default {
  name: 'PropertyList',
  data() {
    return {
      properties: [],
      users: [],
      propertyTypes: [],
      combinedObject: [],
    };
  },
  computed: {
  },
  methods: {
    rentalDuration(property) {
      const diffInMs = property.rentedTo - property.rentedFrom;
      /* aproximadamente 30.44 días por mes */
      const msInMonth = 1000 * 60 * 60 * 24 * 30.44;
      const diffInMonths = Math.round(diffInMs / msInMonth);
      return diffInMonths;
    },
    forRent(property) {
      // eslint-disable-next-line max-len
      if (property.currentDate >= property.rentedFrom && property.currentDate <= property.rentedTo) {
        return true;
      }
      return false;
    },
  },
  /* Una vez se crea la instancia de vue, el created me ejecutaría el código que tenga dentro */
  created() {
    this.properties = propertiesData;
    this.users = usersHomming;
    this.propertyTypes = propertyTypesH;
    this.combinedObject = { ...this.properties, ...this.users, ...this.propertyTypes };
  },
};
</script>

<style>
table {
  width: 90%;
  border: 1px solid black;
  margin: auto;
}
th {
  margin: 1rem;
  background-color: blueviolet;
}
button{
  background-color: blue;
  padding: .5rem;
}
</style>
