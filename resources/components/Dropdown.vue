<template>
  <div class="mb-4">
    <label
      :for="dropdown"
      class="block text-sm font-medium text-gray-700 mb-2">{{ label }}</label>
    <select
      v-model="selected"
      :id="dropdown"
      class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none
        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
      <option :value="null" class="text-gray-500">{{ "Select All" }}</option>
      <option
        v-for="option in options"
        :key="option.id"
        :value="option.id"
        class="text-gray-900">
        {{ option.name }}
      </option>
    </select>
  </div>
</template>

<script>
export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: 'Dropdown',
  props: {
    label: {
      type: String,
      default: 'Choose an option:',
    },
    options: {
      type: Array,
      required: true,
    },
    value: [String, Number, null],
  },
  computed: {
    selected: {
      get() {
        return this.value;
      },
      set(val) {
        this.$emit('input', val);
      },
    },
  },
};
</script>

<style scoped>
label {
  margin-right: 10px;
}
</style>
