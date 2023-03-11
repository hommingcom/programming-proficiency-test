<template>
  <div>
    <h3
      tabindex="0"
      class="flex items-center p-2 px-3 space-x-1 cursor-pointer"
      @click="openFilter = !openFilter"
      @keydown.enter="openFilter = !openFilter"
    >
      <svg
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
        class="w-4 h-4 duration-300 transform"
        :class="[openFilter ? 'rotate-0' : 'rotate-180']"
      >
        <path
          fill-rule="evenodd"
          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
          clip-rule="evenodd"
        ></path>
      </svg>
      <span class="text-sm font-medium">{{ title }}</span>
    </h3>
    <div v-show="openFilter" class="p-2 px-3 bg-gray-100">
      <div v-if="type === 'checkbox'">
        <ul class="space-y-2">
          <li v-for="(item, index) in items" :key="`filter-item-${index}`" class="flex items-center space-x-2">
            <input
              type="checkbox"
              :id="`filter-item-${title}-${index}`"
              class="w-4 h-4 border-gray-300 rounded-md"
            />
            <label :for="`filter-item-${title}-${index}`" class="text-sm truncate">{{ item }}</label>
          </li>
        </ul>
      </div>
      <div v-else-if="type === 'date'">
        <input type="date" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FilterSection',
  props: {
    type: {
      type: String,
      required: true,
    },
    title: {
      type: String,
      required: true,
    },
    items: {
      type: Array,
      required: true,
    },
  },
  data: () => ({
    openFilter: false,
  }),
};
</script>
