import VueRouter from 'vue-router';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('../views/Home.vue'),
  },
];

const router = new VueRouter({
  routes,
  mode: 'history',
  scrollBehavior() {
    document.getElementById('app').scrollIntoView();
  },
});

export default router;
