import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

const routes = [
  {
    path: '/',
    name: 'HomeView',
    component: () => import('@/views/HomeView.vue'),
  },
];

const router = new Router({
  routes,
});

export default router;
