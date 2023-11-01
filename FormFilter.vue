<!-- eslint-disable max-len -->
<template>
      <section class="form">
        <form v-on:submit.prevent="submitInfo(form)">
          <div class="filter-container">
            <div class="filter-item">
                <div class="filter">
                    <label>Type</label>
                    <select v-model="form.type" id="typeid" name="typename"  placeholder="Select an option">
                      <option selected value="">Nothing selected</option>
                      <option v-for="pType in propertyTypes" :value="pType.id" :key="pType.id">
                        {{ pType.name }}
                      </option>
                    </select>
              </div>
            </div>
            <div class="filter-item">
                <div class="filter">
                    <label>User</label>
                    <select v-model="form.user" id="userid" name="username"  placeholder="Select an option">
                      <option selected value="">Nothing selected</option>
                      <option v-for="pType in users" :value="pType.id" :key="pType.id">
                        {{ pType.name }}
                      </option>
                    </select>
              </div>
            </div>
            <div class="filter-item datepicker">
                <div class="filter">
                    <label>Rented between</label>
                    <date-picker v-model="form.date" range ></date-picker>
                </div>
            </div>
            <button class="form-button" id="filterid" name="filtername" type="submit">Filter</button>
            <button class="form-button" id="resetid" name="resetname" v-on:click="resetInfo()" type="button">Clear Filter</button>
          </div>
        </form>
      </section>
</template>

<!-- eslint-disable import/no-extraneous-dependencies -->
<script>
import {
  users,
  propertyTypes,
} from '@/mocks/api';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

export default {
  props: ['userfilter', 'typefilter'],
  components: { DatePicker },
  data: () => ({
    users,
    propertyTypes,
    form: {
      type: '',
      user: '',
      date: '',
      rentedFrom: '',
      rentedTo: '',
    },
  }),
  methods: {
    submitInfo(form) {
      this.form = {
        type: form.type,
        user: form.user,
        date: form.date,
        rentedFrom: form.date[0],
        rentedTo: form.date[1],
      };
      this.$emit('submitForm', this.form);
    },
    resetInfo() {
      this.form = {
        type: '',
        user: '',
        date: '',
        rentedFrom: '',
        rentedTo: '',
      };
      this.$emit('resetForm');
    },
  },
  watch: {
    userfilter(n) {
      if (n != null && n > 0) { this.form.user = n; } else { this.form.user = ''; }
    },
    typefilter(n) {
      if (n != null && n > 0) { this.form.type = n; } else { this.form.type = ''; }
    },
  },
};

</script>
