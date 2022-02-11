<template>
  <div class="flex flex-row min-h-screen justify-center items-center">
    <button @click="goTo('table')" class="text-white p-1 rounded-lg bg-gray-800">Enter</button>
  </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  methods: {
    ...mapActions(['goTo']),
  },
};
</script>

<style scoped>
button {
  transition: all 0.3s ease-in-out;
  height: 80px;
  width: 80px;
}

button:hover {
  background: rgb(57, 23, 97);
  color: cyan;
  border-radius: 50%;
  height: 120px;
  width: 120px;
  box-shadow: 0px 2px 5px black, 0px 4px 7px #101010;
}
</style>
