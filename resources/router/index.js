import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/Home.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/table',
    name: 'renting',
    props: (route) => ({ query: route.query.id }),
    component: () => import('../views/Renting.vue'),
  },
  {
    path: '/showDetails/renting/:id',
    name: 'show-details',
    component: () => import('../views/ShowDetails.vue'),
  },
];

const router = new VueRouter({
  routes,
});

export default router;
