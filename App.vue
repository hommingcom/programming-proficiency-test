<!-- eslint-disable max-len -->
<template>
  <div id="app">
    <div class="header-container">
      <img id="logo" src="./assets/logo-homming.svg" alt="homming" />
    </div>
    <div id="content">
      <FormFilter :userfilter="userId" @submitForm="submitForm" @resetForm="resetForm"></FormFilter>

      <div class="table-container">
        <TableFilter :rowsfilter="tableRows"></TableFilter>
      </div>
    </div>
    <div class="footer-container">
      <span>HOMMING S.L.</span>
    </div>
  </div>
</template>

<script>
import { properties } from '@/mocks/api';
import FormFilter from './components/FormFilter.vue';
import TableFilter from './components/TableFilter.vue';

export default {
  name: 'App',
  data: () => ({
    properties,
    tableRows: properties,
    userId: null,
    typeId: null,
  }),
  components: {
    FormFilter,
    TableFilter,
  },
  methods: {
    getParams() {
      const urlParams = new URLSearchParams(window.location.search);
      this.userId = urlParams.get('user');
      if (this.userId != null && this.userId > 0) {
        this.tableRows = this.properties.filter((item) => item.userId.toString() === this.userId);
      }
      this.typeId = urlParams.get('type');
      if (this.typeId != null && this.typeId > 0) {
        this.tableRows = this.properties.filter((item) => item.typeId.toString() === this.typeId);
      }
    },
    submitForm(form) {
      this.tableRows = this.properties.filter((item) => item.typeId.toString() === this.typeId);

      const filter = [];
      if (form.user != null && form.user > 0) filter.userId = form.user;
      if (form.type != null && form.type > 0) filter.typeId = form.type;
      if (form.rentedTo != null && form.rentedTo !== '' && form.rentedTo instanceof Date) filter.rentedFrom = form.rentedTo;
      if (form.rentedTo != null && form.rentedTo !== '' && form.rentedTo instanceof Date) filter.rentedTo = form.rentedTo;

      this.tableRows = this.properties.filter((item) => {
        // eslint-disable-next-line no-restricted-syntax
        for (const key in filter) {
          if (item[key] === undefined || item[key] !== filter[key]) { return false; }
        }
        return true;
      });
    },
    resetForm() {
      this.tableRows = properties;
      window.location.href = '/';
    },
  },
  mounted() {
    this.getParams();
  },
};

</script>
