// eslint-disable-next-line import/no-unresolved
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
  /* Creacion de rutas */
  // eslint-disable-next-line indent
{
    path: '/users/:id',
    name: 'user',
    // eslint-disable-next-line no-undef
    component: () => import(
      // eslint-disable-next-line import/no-unresolved
      /* webpackChunkName: "users" */ 'programming-proficiency-test/resources/TestBachir/components/PropertyList.vue'
    ),
    // eslint-disable-next-line indent
},
];
const router = createRouter({
// eslint-disable-next-line indent
history: createWebHistory(process.env.BASE_URL),
  // eslint-disable-next-line indent
routes,
});
export default router;
