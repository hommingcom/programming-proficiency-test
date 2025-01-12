import Vue from 'vue';
import Router from 'vue-router';
import App from './App.vue';
import './assets/tailwind.css';

Vue.config.productionTip = false;
Vue.use(Router);
const router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: App,
    },
  ],
});
new Vue({
  render: (h) => h(App),
  router,
}).$mount('#app');
