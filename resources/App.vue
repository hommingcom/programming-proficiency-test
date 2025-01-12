<template>
  <div id="app"
  v-bind:class="['p-4',]">
    <div
    v-bind:class="[
      'w-full',
      'my-4',
      'items-center',
      'shadow',
      'bg-emerald-400',
      'p-2',
      'rounded',
      ]">
      <div v-bind:class="[
        'w-full',
        'shadow',
        'p-4',
        ]"
      >
          <input type="text"
          placeholder="Filter..."
          v-model="filter"/>
      </div>
      <div v-bind:class="[
        'w-full',
        'overflow-auto',]"
        >
        <table v-bind:class="[
          'w-full',
          'text-left',]">
          <thead v-bind:class="['text-center',]">
            <th>
              User
            </th>
            <th>
              Property Name
            </th>
            <th>
              Property Type
            </th>
            <th>
              Is Rented
            </th>
            <th>
              Rented From
            </th>
            <th>
              Rented To
            </th>
            <th>
              Months Rented
            </th>
          </thead>
          <tbody v-bind:class="['text-center',]">
            <tr v-for="(property, index) in filteredRows" :key="index">
              <td>
                <p>
                  {{ userNames[property.userId] }}
                </p>
              </td>
              <td>
                <p>
                  {{ property.name }}
                </p>
              </td>
              <td>
                <p>
                  {{ propertyTypeNames[property.typeId] }}
                </p>
              </td>
              <td>
                <p>
                  {{ property.isRented }}
                </p>
              </td>
              <td>
                <p>
                  {{ property.rentedFromFormatted }}
                </p>
              </td>
              <td>
                <p>
                  {{ property.rentedToFormatted }}
                </p>
              </td>
              <td>
                <p>
                  {{ property.monthsRented}}
                </p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
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
    filter: '',
  }),
  methods: {
    addLeadingZeroesDate(monthParts) {
      const result = {};
      const keys = Object.keys(monthParts);
      for (let i = 0; i < keys.length; i += 1) {
        const key = keys[i];
        const value = monthParts[key];
        if (value < 10) {
          result[key] = `0${value}`;
        } else {
          result[key] = value;
        }
      }
      return result;
    },
    getMonths(property) {
      // si no hay fecha de alquiler, se toma la fecha actual como referencia
      const hasBeenRented = property.rentedTo != null;
      let rentedTo = new Date();
      // en caso contrario se asigna
      if (hasBeenRented) {
        rentedTo = new Date(property.rentedTo);
      }
      const { rentedFrom } = property;
      const MesesAnyo = (rentedTo.getFullYear() - rentedFrom.getFullYear()) * 12;
      let meses = (rentedTo.getMonth() - rentedFrom.getMonth()) + MesesAnyo;
      if (rentedTo.getDate() < rentedFrom.getDate()) {
        meses -= 1;
      }
      return meses;
    },
  },
  computed: {
    filteredRows() {
      return this.propertyList.filter((property) => {
        const {
          name,
          isRented,
          rentedFromFormatted,
          rentedToFormatted,
        } = property;
        const filterText = this.filter.toLowerCase();

        return name.toLowerCase().includes(filterText)
        || rentedFromFormatted.includes(filterText)
        || rentedToFormatted.includes(filterText)
        || isRented.toLowerCase().includes(filterText)
        || this.userNames[property.userId].toLowerCase().includes(filterText)
        || this.propertyTypeNames[property.typeId].toLowerCase().includes(filterText);
      });
    },
    userNames() {
      const uNames = [];
      for (let i = 0; i < this.propertyList.length; i += 1) {
        const property = this.propertyList[i];
        const { userId } = property;
        for (let j = 0; j < this.users.length; j += 1) {
          if (this.users[j].id === userId) {
            uNames[userId] = this.users[j].name;
          }
        }
        uNames[0] = '-';
      }
      return uNames;
    },
    propertyTypeNames() {
      const pNames = [];
      for (let i = 0; i < this.propertyList.length; i += 1) {
        const property = this.propertyList[i];
        const { typeId } = property;
        for (let j = 0; j < this.propertyTypes.length; j += 1) {
          if (this.propertyTypes[j].id === typeId) {
            pNames[typeId] = this.propertyTypes[j].name;
          }
        }
      }
      pNames[0] = '-';
      return pNames;
    },
    propertyList() {
      const hasUser = 'user' in this.$route.query;
      let result = this.properties;
      if (hasUser) {
        const user = parseInt(this.$route.query.user, 10);
        result = this.properties.filter((property) => property.userId === user);
      }
      for (let i = 0; i < result.length; i += 1) {
        const property = result[i];
        property.rentedFromFormatted = '-';
        property.isRented = property.rentedFrom != null ? 'Yes' : 'No';
        if (property.rentedFrom != null) {
          const { rentedFrom } = property;
          const fromParts = {
            dayFrom: rentedFrom.getDate(),
            monthFrom: rentedFrom.getMonth() + 1,
            hoursFrom: rentedFrom.getHours(),
            minutesFrom: rentedFrom.getMinutes(),
          };
          const fromFormmated = this.addLeadingZeroesDate(fromParts);
          const datestringFrom = `${fromFormmated.dayFrom} - ${fromFormmated.monthFrom} - ${rentedFrom.getFullYear()} ${fromFormmated.hoursFrom} : ${fromFormmated.minutesFrom}`;
          property.rentedFromFormatted = datestringFrom;
        }
        property.rentedToFormatted = '-';
        if (property.rentedTo != null) {
          const { rentedTo } = property;
          const toParts = {
            dayTo: rentedTo.getDate(),
            monthTo: rentedTo.getMonth() + 1,
            hoursTo: rentedTo.getHours(),
            minutesTo: rentedTo.getMinutes(),
          };
          const toFormatted = this.addLeadingZeroesDate(toParts);
          const datestringTo = `${toFormatted.dayTo} - ${(toFormatted.monthTo)} - ${rentedTo.getFullYear()} ${toFormatted.hoursTo} : ${toFormatted.minutesTo}`;
          property.rentedToFormatted = datestringTo;
        }
        property.monthsRented = '-';
        if (property.rentedFrom != null) {
          property.monthsRented = this.getMonths(property);
        }
      }
      return result;
    },
  },
};
</script>
