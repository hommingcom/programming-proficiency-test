<template>
  <div class="Properties">
    <div class="flex flex-row flex-wrap justify-center align-center p-4">
      <div class="flex justify-center mx-2">
        <select
          class="
            form-select
            appearance-none
            block
            w-52
            h-5/6
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding bg-no-repeat
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700
            focus:bg-white
            focus:border-blue-600
            focus:outline-none
          "
          placeholder="Property type"
          v-model="filter.type"
        >
          <option selected :value="null">Property type</option>
          <option
            v-for="(type, index) in propertyTypes"
            :key="index"
            :value="type.name"
          >
            {{ type.name }}
          </option>
        </select>
      </div>
      <div class="flex justify-center mx-2">
        <select
          class="
            form-select
            appearance-none
            block
            w-52
            h-5/6
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding bg-no-repeat
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700
            focus:bg-white
            focus:border-blue-600
            focus:outline-none
          "
          placeholder="User"
          v-model="filter.user"
        >
          <option selected :value="null">User</option>
          <option
            v-for="(user, index) in users"
            :key="index"
            :value="user.name"
          >
            {{ user.name }}
          </option>
        </select>
      </div>
      <div class="flex items-center justify-center mx-2">
        <div
          class="datepicker relative form-floating mb-3 xl:w-96"
          data-mdb-toggle-button="false"
        >
          <input
            type="text"
            class="
              form-control
              block
              w-52
              px-3
              py-1.5
              text-base
              font-normal
              text-gray-700
              bg-white bg-clip-padding
              border border-solid border-gray-300
              rounded
              transition
              ease-in-out
              m-0
              focus:text-gray-700
              focus:bg-white
              focus:border-blue-600
              focus:outline-none
            "
            placeholder="Select a date"
            data-mdb-toggle="datepicker"
            v-model="filter.rentedFrom"
          />
          <label for="floatingInput" class="text-gray-700">Rented from</label>
        </div>
      </div>
      <div class="flex items-center justify-center mx-2">
        <div
          class="datepicker relative form-floating mb-3 xl:w-96"
          data-mdb-toggle-button="false"
        >
          <input
            type="text"
            class="
              form-control
              block
              w-52
              px-3
              py-1.5
              text-base
              font-normal
              text-gray-700
              bg-white bg-clip-padding
              border border-solid border-gray-300
              rounded
              transition
              ease-in-out
              m-0
              focus:text-gray-700
              focus:bg-white
              focus:border-blue-600
              focus:outline-none
            "
            placeholder="Select a date"
            data-mdb-toggle="datepicker"
            v-model="filter.rentedTo"
          />
          <label for="floatingInput" class="text-gray-700">Rented to</label>
        </div>
      </div>
    </div>
    <propertiesTable :headers="headers" :properties="propertiesFiltered" />
  </div>
</template>

<script>
import propertiesTable from '@/components/propertiesTable.vue';
import { users, propertyTypes, properties } from '@/mocks/api';

export default {
  name: 'Properties',
  components: {
    propertiesTable,
  },
  data() {
    return {
      properties,
      propertyTypes,
      users,
      headers: [
        { label: 'User', value: 'user' },
        { label: 'Name', value: 'name' },
        { label: 'Type', value: 'type' },
        { label: 'Rented from', value: 'rentedFrom' },
        { label: 'Rented to', value: 'rentedTo' },
        { label: 'Rented', value: 'isRented' },
      ],
      propertiesFormatted: [],
      propertiesFiltered: [],
      filter: {
        type: null,
        user: null,
        rentedFrom: null,
        rentedTo: null,
      },
    };
  },
  watch: {
    filter: {
      deep: true,
      handler() {
        this.getPropertiesFiltered();
      },
    },
  },
  mounted() {
    this.getAndFormatProperties();
    this.getPropertiesFiltered();
  },
  methods: {
    getAndFormatProperties() {
      this.propertiesFormatted = this.properties.map(
        (property) => this.formatProperty(property),
      );
    },
    getPropertiesFiltered() {
      this.propertiesFiltered = this.propertiesFormatted.filter(
        (property) => this.formatQuery(property),
      );
    },
    formatProperty(property) {
      const type = this.propertyTypes.find(
        (item) => item.id === property.typeId,
      );
      const user = this.users.find((item) => item.id === property.userId);
      const isRented = this.checkIsRented(
        property.rentedFrom,
        property.rentedTo,
      );
      return {
        name: property.name,
        user: user.name,
        type: type.name,
        rentedFrom: property.rentedFrom ?
          this.formatDate(property.rentedFrom)
          : 'No information',
        rentedTo: property.rentedTo ?
          this.formatDate(property.rentedTo)
          : 'No information',
        isRented: isRented ? 'Rented' : 'Free',
      };
    },
    formatDate(date) {
      let dateFormatted = '';
      if (date) {
        const year = date.getFullYear();
        const month = date.getMonth();
        const day = date.getDate();
        dateFormatted = `${year}/${month}/${day}`;
      }
      return dateFormatted;
    },
    checkIsRented(firstDate, secondDate) {
      const date1 = new Date(firstDate);
      const date2 = new Date(secondDate);
      const today = new Date();
      let isRented = false;
      if (date1 <= today && date2 >= today) {
        isRented = true;
      }
      return isRented;
    },
    formatQuery(property) {
      let query = true;
      Object.keys(this.filter).forEach((key) => {
        if (this.filter[key]) {
          if (key === 'rentedFrom') {
            const date = new Date(this.filter[key]);
            const date2 = new Date(property[key]);
            if (date2 < date) {
              query = false;
            }
          } else if (key === 'rentedTo') {
            const date = new Date(this.filter[key]);
            const date2 = new Date(property[key]);
            if (date2 > date) {
              query = false;
            }
          } else if (this.filter[key] !== property[key]) {
            query = false;
          }
        }
      });
      Object.keys(this.$route.query).forEach((key) => {
        if (key === 'rentedFrom') {
          const date = new Date(this.$route.query[key]);
          const date2 = new Date(property[key]);
          if (date2 < date) {
            query = false;
          }
        } else if (key === 'rentedTo') {
          const date = new Date(this.$route.query[key]);
          const date2 = new Date(property[key]);
          if (date2 > date) {
            query = false;
          }
        } else if (this.$route.query[key] !== property[key]) {
          query = false;
        }
      });
      return query;
    },
  },
};
</script>
<style>
</style>
