<template>

  <div class="bg-gray-300 shadow-lg">

    <table class="table-auto w-full">
      <thead class="bg-blue-500 text-white shadow-lg">
        <th v-for="col in headers" :key="col.key" class="px-4 py-3">
          {{ col.label }}
        </th>
      </thead>

      <tbody>
        <tr v-for="item in items" :key="item.id"
          class="hover:bg-gray-100"
        >
          <td class="px-4 py-3 text-center"
            v-for="header in headers" :key="header.key">
            {{ item[header.key] }}
          </td>
        </tr>
      </tbody>
    </table>

  </div>

</template>

<script>

export default {
  props: {
    headers: { type: Array, required: true },
    items: { type: Array, required: true },
  },
  data: () => ({
  }),
  methods: {
  },
};
</script>
