import Vue from 'vue';
import filter from '@/utils/filters'; // eslint-disable-line
import router from './router';
import App from './App.vue';
import './main.css';

Vue.config.productionTip = false;

new Vue({
  router,
  render: (h) => h(App),
}).$mount('#app');
