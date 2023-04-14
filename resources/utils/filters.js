import Vue from 'vue';

Vue.filter('capitalizeFirstLetter', (text) => text.charAt(0).toUpperCase() + text.slice(1)); // eslint-disable-line 