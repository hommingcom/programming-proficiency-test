<template>
  <div>
    <Spinner v-if="loading" class="flex flex-row min-h-screen justify-center items-center" />
    <div v-else class="flex flex-row min-h-screen justify-center items-center">
      <div class="w-full mx-auto justify-center">
        <div class="flex flex-auto justify-center">
          <div class="basis-1/4 w-2/6">
            <InputFilter
              :data-to-filter="data"
              @filter-by-input="filterByInput"
              @reload-table="reloadTable"
            />
          </div>
          <div class="basis-1/4 mt-5 flex">
            <SelectorFilter
              @filtering-by-selector="filterBySelector"
              :options="options"
              :clean-filters="cleanFilters"
            />
            <button
              v-if="isFiltering && isShowingOptions"
              id="reload-button"
              class="ml-5 mt-10"
              @click="processData(false, null);"
            >
              <font-awesome-icon icon="fa-solid fa-arrows-rotate" class="text-3xl text-blue-400" />
            </button>
          </div>
        </div>
        <TableData :headers="headers" :data="data" @show-details="showDetails" />
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';
import { users, propertyTypes, properties } from '../mocks/api';
import InputFilter from '../components/InputFilter.vue';
import TableData from '../components/TableData.vue';
import Spinner from '../components/Spinner.vue';
import SelectorFilter from '../components/SelectorFilter.vue';

export default {
  components: {
    InputFilter,
    TableData,
    Spinner,
    SelectorFilter,
  },
  name: 'renting-data',
  data() {
    return {
      users,
      propertyTypes,
      properties,
      headers: [],
      data: [],
      loading: true,
      isFiltering: false,
      showHomeButton: false,
      refreshData: false,
      cleanFilters: false,
      selectedFilter: '',
      options: [
        {
          value: '',
          label: 'ID',
          type: 'id',
        },
        {
          value: '',
          label: 'User ID',
          type: 'userId',
        },
        {
          value: '',
          label: 'Type ID',
          type: 'typeId',
        },
      ],
      queryParam: {
        query: Object.keys(this.$route.query)[0],
        value: Object.values(this.$route.query)[0],
      },
    };
  },
  computed: {
    ...mapState(['isShowingOptions']),
  },
  mounted() {
    if (this.queryParam.value) {
      this.processData(true, this.queryParam);
    } else {
      this.processData(false, null);
    }
    this.$store.commit('setProperties', properties);
  },
  watch: {
    $router(to) {
      console.log(to);
      if (!to.query) {
        console.log('Sin queries');
      }
    },
    refreshData(val) {
      console.log(val);
      if (val) {
        this.refreshData(false, null);
      }
    },
  },
  methods: {
    ...mapActions(['goTo']),
    processData(isFiltering = false, queryParam = {}) {
      this.cleanFilters = !this.cleanFilters;
      this.data = [];
      this.headers = Object.keys(properties[0]);
      this.headers.push('month', 'isRented');
      if (isFiltering) {
        const match = properties.find(
          (item) => item[queryParam.query].toString() === queryParam.value.toString(),
        );
        this.data.push({
          index: 0,
          values: {
            ...match,
            userId: users.find((user) => user.id === match.userId).name || '',
            typeId: propertyTypes.find((type) => type.id === match.typeId).name || '',
            rentedFrom: match.rentedFrom ? this.formatDate(match.rentedFrom) : '',
            rentedTo: match.rentedTo ? this.formatDate(match.rentedTo) : '',
            month: match.rentedTo
              ? this.formatMonth(new Date(match.rentedTo).getMonth() + 1)
              : null,
            isRented: !!match.rentedTo,
          },
        });
        setTimeout(() => {
          this.loading = false;
        }, 250);
      } else {
        properties.forEach((item, propIndex) => {
          this.data.push({
            index: propIndex,
            values: {
              ...item,
              userId: users.find((user) => user.id === item.userId).name,
              typeId: propertyTypes.find((type) => type.id === item.typeId).name,
              rentedFrom: item.rentedFrom ? this.formatDate(item.rentedFrom) : '',
              rentedTo: item.rentedTo ? this.formatDate(item.rentedTo) : '',
              month: item.rentedTo
                ? this.formatMonth(new Date(item.rentedTo).getMonth() + 1)
                : null,
              isRented: !!item.rentedTo,
            },
          });
        });
        setTimeout(() => {
          this.loading = false;
        }, 250);
      }
    },
    filterBySelector(opt, query) {
      this.processData(false, null);
      this.isFiltering = true;
      const objArr = [];

      properties.forEach(async (item) => {
        objArr.push(await this.$store.dispatch('objValuesToString', item));
      });

      setTimeout(() => {
        this.data = [];
        if (query) {
          this.filterData(objArr, query.toString(), opt);
        } else {
          this.processData(false, null);
        }
      }, 1000);
    },
    filterData(array, query, opt) {
      array.forEach((item, index) => {
        if (item[opt].includes(query)) {
          this.data.push({
            index,
            values: {
              ...item,
              userId: users.find((user) => user.id.toString() === item.userId).name,
              typeId: propertyTypes.find((type) => type.id.toString() === item.typeId).name,
              rentedFrom: item.rentedFrom ? this.formatDate(new Date(item.rentedFrom)) : '',
              rentedTo: item.rentedTo ? this.formatDate(new Date(item.rentedTo)) : '',
              month: item.rentedTo
                ? this.formatMonth(new Date(item.rentedTo).getMonth() + 1)
                : null,
              isRented: !!item.rentedTo,
            },
          });
        }
      });
    },
    padZero(num) {
      return num.toString().padStart(2, '0');
    },
    formatDate(date) {
      const day = date.getDay();
      const month = date.getMonth() + 1;
      const year = date.getFullYear();
      return `${this.padZero(day)}-${this.padZero(month)}-${year}`;
    },
    formatMonth(month) {
      const months = {
        1: 'Jan',
        2: 'Feb',
        3: 'Mar',
        4: 'Apr',
        5: 'May',
        6: 'Jun',
        7: 'Jul',
        8: 'Aug',
        9: 'Sep',
        10: 'Oct',
        11: 'Nov',
        12: 'Dec',
      };
      return months[month];
    },
    showDetails(item) {
      const {
        values: { id },
      } = item;
      this.$store.commit('setSelectedRow', item);
      this.$router.push({ path: `showDetails/renting/${id}` });
    },
    reloadTable(reload) {
      this.reloadTable = reload;
    },
    filterByInput(data, isProcessed) {
      this.data = [];
      setTimeout(() => {
        if (isProcessed) {
          data.forEach((item, index) => {
            this.data.push({
              index,
              values: {
                ...item,
                month: item.rentedTo
                  ? this.formatMonth(new Date(item.rentedTo).getMonth() + 1)
                  : null,
                isRented: !!item.rentedTo,
              },
            });
          });
        } else {
          this.processData(false, null);
        }
      }, 1000);
    },
  },
};
</script>

<style>
#reload-button:hover {
  animation: rotate 0.5s ease;
}

@keyframes rotate {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

.centered {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%,)
}
</style>
