<!-- eslint-disable max-len -->
<!-- eslint-disable max-len -->
<template>
  <div id="app" class="container">
    <nav>
      <router-link to="/users/id"></router-link>
    </nav>
    <head>
      <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
        crossorigin="anonymous"
      />
    </head>
    <button class="btn btn-primary m-2" @click="filterUsers">Filter by users</button>
    <button class="btn btn-success m-2" @click="filterProTypes">Filter by propertyTypes</button>
    <button class="btn btn-warning m-2" @click="filterProperties">Filter by properties</button>
    <label class="float-right m-2" for="search">Search: </label>
    <input v-model="filters" type="text" />
    <table class="table table-bordered table-light text-align border-primary">
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
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="combinedObject in combinedObjects" :key="combinedObject.id">
          <td>{{ combinedObject.id }}</td>
          <td>{{ combinedObject.userId }}</td>
          <td>{{ combinedObject.typeId }}</td>
          <td>{{ combinedObject.name }}</td>
          <td>{{ combinedObject.rentedFrom }}</td>
          <td>{{ combinedObject.rentedTo }}</td>
          <td>{{ rentalDuration(combinedObject) }} Ms</td>
          <td>{{ forRent(combinedObject) }}</td>
          <td>{{ combinedObject.userId1 }}</td>
          <td>{{ combinedObject.userName }}</td>
          <td>{{ combinedObject.typeId1 }}</td>
          <td>{{ combinedObject.typeName }}</td>
          <td>
            <div class="btn-group" role="group">
              <button
                class="btn btn-secondary"
                title="Edit"
                @click="
                  btnEdit(
                    combinedObject.id,
                    combinedObject.userId,
                    combinedObject.typeId,
                    combinedObject.name,
                    combinedObject.rentedFrom,
                    combinedObject.rentedTo,
                  )
                "
              >
                <i class="fas fa-pencil-alt"></i>
              </button>
              <button class="btn btn-danger" title="delete" @click="btnDelete(combinedObject.id)">
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
// eslint-disable-next-line import/extensions, import/no-unresolved
import {
  users as usersHomming,
  propertyTypes as propertyTypesH,
  properties as propertiesData,
} from '@/mocks/api';

export default {
  name: 'PropertyList',
  data() {
    return {
      properties: [],
      copyProperties: [],
      users: [],
      copyUsers: [],
      propertyTypes: [],
      copyPropertyTypes: [],
      filters: '',
      user: {},
    };
  },
  /* Una vez se crea la instancia de vue, el created me ejecutaría el código que tenga dentro */
  created() {
    this.properties = propertiesData;
    this.users = usersHomming;
    this.propertyTypes = propertyTypesH;
    this.copyProperties = this.properties;
    this.copyUsers = this.users;
    this.copyPropertyTypes = this.propertyTypes;
    // eslint-disable-next-line max-len
    /* La función obtiene el parámetro id de la URL y lo convierte en un número   entero usando parseInt(). Luego, utiliza el método find() para encontrar el objeto de usuario correspondiente dentro del array users, y lo asigna a la propiedad user del componente. */
    // eslint-disable-next-line radix
    const idParams = parseInt(this.$route.params.idParams);
    this.user = this.users.find((user) => user.userId1 === idParams);
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
      if (
        property.currentDate >= property.rentedFrom
        && property.currentDate <= property.rentedTo
      ) {
        return true;
      }
      return false;
    },
    filterUsers() {
      // Cada vez que llamamos a la funcion, reseteamos el array
      this.users = this.copyUsers;
      this.users = this.users.filter((combinedObject) => combinedObject.id > this.filters);
    },
    filterProTypes() {
      this.propertyTypes = this.copyPropertyTypes;
      this.propertyTypes = this.propertyTypes.filter(
        (combinedObject) => combinedObject.name === this.filters,
      );
    },
    filterProperties() {
      this.properties = this.copyProperties;
      this.properties = this.properties.filter(
        // eslint-disable-next-line max-len
        (combinedObject) => combinedObject.id < this.filters,
      );
    },
  },
  // Funcion que devuelve un nuevo arreglo que contiene los objetos combinados
  computed: {
    combinedObjects() {
      // Verificamos si los arreglos tienen la misma longitud

      // if (this.properties.length !== this.users.length || this.propertyTypes.length) {
      // console.log('Los arreglos no tienen la misma longitud.');
      // return [];
      // }
      // eslint-disable-next-line arrow-body-style

      // Mapear los objetos y comprobar si los valores son undefined
      return this.properties
        .map((property, index) => {
          if (!this.users[index] || !this.propertyTypes[index]) {
            // eslint-disable-next-line no-template-curly-in-string
            console.log('El indice ${index} es undefined.');
            return null;
          }
          return {
            id: property.id,
            userId: property.userId,
            typeId: property.typeId,
            name: property.name,
            rentedFrom: property.rentedFrom,
            rentedTo: property.rentedTo,
            rentalDuration: property.rentalDuration,
            currentDate: property.currentDate,
            userId1: this.users[index].id,
            userName: this.users[index].name,
            typeId1: this.propertyTypes[index].id,
            typeName: this.propertyTypes[index].name,
          };
        })
        .filter((obj) => obj !== null); // Eliminamos los objetos null
    },
  },
};
</script>

<style>
table {
  font-family: Georgia, "Times New Roman", Times, serif;
  text-align: center;
}
#app {
  font-family: Georgia, "Times New Roman", Times, serif;
}
</style>
