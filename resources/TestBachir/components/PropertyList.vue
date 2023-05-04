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
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(propiedad, indice) of propiedades" :key="indice">
          <td>{{ propiedad.id }}</td>
          <td>{{ propiedad.userId }}</td>
          <td>{{ propiedad.typeId }}</td>
          <td>{{ propiedad.name }}</td>
          <td>{{ propiedad.rentedFrom }}</td>
          <td>{{ propiedad.rentedTo }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'PropertyList',
  data() {
    return {
      propiedades: [],
    };
  },
  /* Una vez se crea la instancia de vue, el created me ejecutaría el código que tenga dentro */
  created() {
    fetch('@/mocks/api.js')
      .then((response) => response.json())
      /* Guardo cada objeto en el array */
      .then((data) => (this.propiedad = data));
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
</style>
