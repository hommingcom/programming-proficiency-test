<template>
  <div>
    <div class="gap-4 mb-4">
      <select v-model="selectedType">
        <option value="">All Property Types</option>
        <option v-for="type in propertyTypes" :key="type.id" :value="type.id">
          {{ type.name }}
        </option>
      </select>
      <select v-model="selectedUser">
        <option value="">All Users</option>
        <option v-for="user in users" :key="user.id" :value="user.id">
          {{ user.name }}
        </option>
      </select>
      <input type="date" v-model="rentedFrom" placeholder="Rented From">
      <input type="date" v-model="rentedTo" placeholder="Rented To">
    </div>
    <table class="table-auto min-w-full text-center text-sm font-light">
      <thead class="border-b bg-neutral-800 font-medium text-white">
        <tr>
          <th scope="col" class=" px-6 py-4">ID</th>
          <th scope="col" class=" px-6 py-4">User</th>
          <th scope="col" class=" px-6 py-4">Type</th>
          <th scope="col" class=" px-6 py-4">Name</th>
          <th scope="col" class=" px-6 py-4">Rented from</th>
          <th scope="col" class=" px-6 py-4">Rented to</th>
          <th scope="col" class=" px-6 py-4">Rented</th>
          <th scope="col" class=" px-6 py-4">Months Rented</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="property in filteredProperties" :key="property.id"
            class="border-b">
          <td class="whitespace-nowrap px-6 py-4 font-medium">
            {{ property.id }}
          </td>
          <td class="whitespace-nowrap  px-6 py-4">{{ property.userName }}</td>
          <td class="whitespace-nowrap  px-6 py-4">{{ property.typeName }}</td>
          <td class="whitespace-nowrap  px-6 py-4">{{ property.name }}</td>
          <td class="whitespace-nowrap  px-6 py-4"
              v-if="property.rentedFrom !== null">{{ formatDate(property.rentedFrom) }}</td>
          <td v-else></td>
          <td class="whitespace-nowrap  px-6 py-4"
              v-if="property.rentedTo !== null">{{ formatDate(property.rentedTo) }}</td>
          <td v-else></td>
          <td class="whitespace-nowrap  px-6 py-4">{{ property.isRented }}</td>
          <td class="whitespace-nowrap  px-6 py-4">{{ property.rentedMonths }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

export default {
  name: 'DataTable',
  props: {
    properties: Array,
    propertyTypes: Array,
    users: Array,
  },
  data() {
    return {
      selectedUser: '',
      selectedType: '',
      rentedFrom: '',
      rentedTo: '',
    };
  },
  computed: {
    filteredProperties() {
      return this.properties.map((property) => {
        // We search the user with that id and return the property with the variable userName
        const propertyUser = this.users.find((user) => user.id === property.userId);
        const userName = propertyUser ? propertyUser.name : '';
        const propertyType = this.propertyTypes.find((type) => type.id === property.typeId);
        const typeName = propertyType ? propertyType.name : '';
        let rentedMonths = null;
        let isRented = false;

        if (property.rentedFrom) {
          rentedMonths = this.calculateMonths(property.rentedFrom, property.rentedTo ?? new Date());
          isRented = property.rentedFrom && (!property.rentedTo || property.rentedTo >= new Date());
        }
        return {
          ...property, userName, typeName, rentedMonths, isRented,
        };
      }).filter((property) => {
        let matchesType = true;
        if (this.selectedType) {
          matchesType = property.typeId === this.selectedType;
        }

        let matchesUser = true;
        if (this.selectedUser) {
          matchesUser = property.userId === this.selectedUser;
        }

        let matchesRentedFrom = true;
        if (this.rentedFrom) {
          matchesRentedFrom = new Date(this.rentedFrom) <= new Date(property.rentedFrom);
        }

        let matchesRentedTo = true;
        if (this.rentedTo) {
          matchesRentedTo = new Date(this.rentedTo) >= new Date(property.rentedFrom);
        }

        return matchesType && matchesUser && matchesRentedFrom && matchesRentedTo;
      });
    },
  },
  methods: {
    // format date for display
    formatDate(date) {
      const dateObj = new Date(date);
      const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
      return dateObj.toLocaleDateString('en-GB', options).replace(/\//g, '-');
    },
    // calculate the number of months is rented
    calculateMonths(from, to) {
      if (!from || !to) return 0;
      const startDate = new Date(from);
      const endDate = new Date(to);
      const yearDiff = endDate.getFullYear() - startDate.getFullYear();
      const monthDiff = endDate.getMonth() - startDate.getMonth();
      const totalMonths = yearDiff * 12 + monthDiff;
      return totalMonths <= 0 ? 0 : totalMonths;
    },
  },
};
</script>
