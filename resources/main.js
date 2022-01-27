import Vue from 'vue';
import App from './App.vue';
import date from '@/filters/date';

Vue.config.productionTip = false;

Vue.filter('date', date);

new Vue({
  render: (h) => h(App),
}).$mount('#app');
