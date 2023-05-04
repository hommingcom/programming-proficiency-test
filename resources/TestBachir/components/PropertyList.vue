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
  async created() {
    /* Hasta que no se resuelva el await, no va a continuar con la ejecucion del codigo */
    const response = await fetch('@/mocks/api.js');
    if (response.ok) {
      /* Nos devuelve un objeto de tipo response */
      const propiedadesData = await response.json();
      /* Quiero que me vaya guardando cada objeto en el array */
      this.propiedades = propiedadesData;
      console.log(response);
    } else {
      alert(`Error Desconocido${response.status}`);
    }
  },
};
</script>

<style>
table{
  width: 90%;
  border: 1px solid black;
  margin: auto;
}
th{
  margin: 1rem;
  background-color: blueviolet;
}
</style>
