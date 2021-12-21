import Vue from 'vue';
import router from '@/router/index';
import App from './App.vue';

Vue.config.productionTip = false;
Vue.filter('date', (date) => (date ? date.toLocaleDateString('es-ES', { year: 'numeric', month: '2-digit', day: '2-digit' }) : null));

new Vue({
  router,
  render: (h) => h(App),
}).$mount('#app');
