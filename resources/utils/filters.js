import Vue from 'vue';

Vue.filter('capitalizeFirstLetter', (text) => text.charAt(0).toUpperCase() + text.slice(1)); // eslint-disable-line 

Vue.filter('formatDate', (date) => {
  if (date) {
    const options = {
      timeZone: Intl.DateTimeFormat().resolvedOptions().timeZone,
      timeZoneName: 'short',
    };
    return new Intl.DateTimeFormat(navigator.language,
      options).format(date);
  }
  return null;
});
