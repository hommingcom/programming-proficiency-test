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
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(property, indix) of properties" :key="indix">
          <td>{{ property.id }}</td>
          <td>{{ property.userId }}</td>
          <td>{{ property.typeId }}</td>
          <td>{{ property.name }}</td>
          <td>{{ property.rentedFrom }}</td>
          <td>{{ property.rentedTo }}</td>
          <td> {{ property.rentalDuration = (property.rentedFrom - property.rentedTo)}}</td>
          <td v-if="property.currentDate > property.rentedFrom && property.currentDate < property.currentDate">{{ property.currentDate }}</td>
          <td>
            <div class="btn-group" role="group">
              <button
                class="btn btn-secondary"
                title="edit"
                @click="
                  btnEdit(
                    property.id,
                    property.userId,
                    property.typeId,
                    property.name,
                    property.rentedFrom,
                    property.rentedTo
                  )
                "
              >
                <i class="fas fa-pencil-alt"></i>
              </button>
              <button class="btn btn-danger" title="Delete" @click="btnDelete(property.id)">
                <i class="fas fa-trash-alt"></i>
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { properties as propertiesData } from '@/mocks/api';

export default {
  name: 'PropertyList',
  data() {
    return {
      properties: [],
    };
  },
  computed: {
  },
  /* Una vez se crea la instancia de vue, el created me ejecutaría el código que tenga dentro */
  created() {
    this.properties = propertiesData;
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
