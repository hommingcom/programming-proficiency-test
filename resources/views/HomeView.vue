<template>
  <div class="flex flex-col items-center justify-center w-full mt-8 p-4 text-white">
    <div>
      <h2 class="mb-2 font-bold text-2xl">Crud Básico</h2>
      <FilterComponent class="mb-4 mt-4" @searchInput="filterSearch"
      @searchSelect="filterSearch"/>
      <template v-if="tableItems && tableItems.length > 0">
        <TableComponent :headers="tableHeaders" :items="tableItems"/>
      </template>
    </div>
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';
import { TableComponent, FilterComponent } from '@/components';
import { SyncronizeItems, Lower } from '@/helpers';

export default {
  name: 'HomeView',
  components: {
    TableComponent,
    FilterComponent,
  },
  data() {
    return {
      tableHeaders: ['#uID', 'Nombre', 'Propiedad en Renta', 'Tipo de Propiedad', 'Días Rentados', 'Comienzo de Renta', 'Fin de Renta', 'Estado Actual'],
      tableItems: [],
      users,
      propertyTypes,
      properties,
      searchText: '',
      searchSelect: '',
      searchDateFrom: null,
      searchDateTo: null,
      searchSelectStatus: '',
    };
  },
  methods: {
    filterSearch({ type, txt }) {
      switch (type) {
        case 'input': this.searchText = Lower(txt); break;
        case 'select': this.searchSelect = Lower(txt); break;
        case 'select_status': this.searchSelectStatus = Lower(txt); break;
        case 'dateFrom': this.searchDateFrom = new Date(txt); break;
        case 'dateTo': this.searchDateTo = new Date(txt); break;
        default: break;
      }

      const newItems = this.tableItems.map((item) => {
        const userName = Lower(item.user_name).includes(this.searchText);
        const propType = Lower(item.prop_type).includes(this.searchSelect);
        const status = Lower(item.status).includes(this.searchSelectStatus);
        const dateFrom = !this.searchDateFrom || new Date(item.rentedFrom) >= this.searchDateFrom;
        const dateTo = !this.searchDateTo || new Date(item.rentedTo) <= this.searchDateTo;

        const condition = userName && propType && dateFrom && dateTo && status;

        return {
          ...item,
          show: condition ? 'show' : 'hide',
        };
      });

      this.tableItems = newItems;
    },
  },
  mounted() {
    this.tableItems = SyncronizeItems([this.users, this.propertyTypes, this.properties]);
  },
};
</script>
