<template>

  <div>

    <label for="items" class="mr-2">{{ label }}</label>

    <select name="items" id="items" v-model="selectedValue"
      class="bg-blue-50 border rounded-md"
      @change="$emit('change', selectedValue)"
    >
      <option :value="null"></option>

      <slot v-if="$slots.options" name="options"></slot>

      <option v-else v-for="item in items" :key="item.id" :value="item[`${optionValue}`]">
        {{ item.name }}
      </option>
    </select>

  </div>

</template>

<script>

export default {
  props: {
    items: { type: Array, required: true },
    label: { type: String, required: true },
    optionValue: { type: String, required: false, default: 'id' },
    value: { type: [String, Number], required: false, default: null },
  },
  data() {
    return {
      selectedValue: this.value,
    };
  },
  watch: {
    value() {
      this.selectedValue = this.value;
    },
  },
};
</script>
