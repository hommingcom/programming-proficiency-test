<template>

  <div>

    <label for="input" class="mr-2">{{ label }} </label>

    <input type="date" :id="`input_${label}`"
      class="bg-blue-50 border rounded-md"
      @change="handleChange"
      v-model="content"
    >

  </div>

</template>

<script>

export default {
  props: {
    label: { type: String, required: true },
    value: { type: String, required: false, default: null },
  },
  watch: {
    value() {
      this.content = this.value;
    },
  },
  data() {
    return {
      content: this.value,
    };
  },
  methods: {
    handleChange() {
      this.$emit('input', this.content);
    },
  },
};
</script>
