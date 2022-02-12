<template>
  <div id="app">
  <Header/>
    <router-view/>
    <Footer/>
  </div>
</template>

<script>
import Header from './components/common/header.vue';
import Footer from './components/common/footer.vue';

export default {
  components: { Header, Footer },
  name: 'App',

};
</script>
