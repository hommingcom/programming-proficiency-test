import Vue from 'vue';
import { createPinia, PiniaVuePlugin } from 'pinia';
import './index.css';
import App from './App.vue';
import VueRouter from './router';

Vue.use(PiniaVuePlugin);
const pinia = createPinia();

Vue.config.productionTip = false;
Vue.use(VueRouter);

new Vue({
  render: (h) => h(App),
  pinia,
}).$mount('#app');
