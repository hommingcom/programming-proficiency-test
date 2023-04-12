import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/',
      redirect: 'properties',
    },
    {
      path: '/properties',
      component: () => import('./views/PropertiesView.vue'),
    },
  ],
});
