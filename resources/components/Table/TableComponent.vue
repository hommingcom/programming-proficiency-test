<template>
  <div>
    <table class="border border-gray-300" style="min-height:300px;">
      <thead>
        <tr v-if="headers && headers.length>0">
          <th class="py-2 px-4 border" v-for="(header, index) of headers" :key="index">
            {{ header }}
          </th>
        </tr>
      </thead>
      <tbody>
        <template v-if="items && items.length>0">
          <tr v-for="(item, index) in items" :key="index"
          :style="`${item.show && item.show === 'hide' ? 'display:none;' : ''}`">
            <td class="py-2 px-4 border">
              {{item.user_id}}
            </td>
            <td class="py-2 px-4 border">
              {{item.user_name}}
            </td>
            <td class="py-2 px-4 border">
              {{item.prop_name}}
            </td>
            <td class="py-2 px-4 border to-capitalize">
              {{item.prop_type}}
            </td>
            <td class="py-2 px-4 border">
              {{getDaysRented(item.rentedFrom, item.rentedTo)}}
            </td>
            <td class="py-2 px-4 border">
              {{setFormatDate(item.rentedFrom)}}
            </td>
            <td class="py-2 px-4 border">
              {{setFormatDate(item.rentedTo)}}
            </td>
            <td class="py-2 px-4 border" v-html="item.status">
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>
<script>
import { FormatDate, getDaysRange } from '@/helpers';
import './style.css';

export default {
  name: 'TableComponent',
  props: ['items', 'headers'],
  data: () => ({
  }),
  methods: {
    setFormatDate: (date) => FormatDate(date),
    getDaysRented: (dateFrom, dateTo) => getDaysRange(dateFrom, dateTo),
  },
};
</script>
