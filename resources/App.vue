<template>
  <div id="app">
    <Header msg="Homming's Properties"/>
    <Main />
  </div>
</template>

<script>
import Header from "./components/Header.vue"
import Main from "./components/Main.vue"

export default {
  name: 'App',
  components: {
    Header,
    Main
  },
};
</script>
