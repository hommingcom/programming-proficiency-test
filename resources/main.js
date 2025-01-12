import Vue from 'vue';
import VueRouter from 'vue-router';// Import vue-router
import App from './App.vue';
import PropertiesTable from './components/PropertiesTable.vue'; // Import your component

Vue.config.productionTip = false;

/*
  For (Optional) Listen to URL parameters to filter on page load. e.g. ?user=1
 */
Vue.use(VueRouter);// Tell Vue to use the router

// Define the routes
const routes = [
  {
    path: '/',
    name: 'Home',
    component: PropertiesTable,
  },
];

// Create the router instance
const router = new VueRouter({
  mode: 'history', // Enable history mode
  routes, // short for `routes: routes`
});

// Create and mount the root instance
new Vue({
  router, // Pass the router to Vue instance
  render: (h) => h(App),
}).$mount('#app');
