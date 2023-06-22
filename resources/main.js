import './global.css';
import '@fortawesome/fontawesome-svg-core/styles.css';

import { createApp } from 'vue';
import App from './App.vue';

// css externo de tailwind css
const link = document.createElement('link');
link.href = 'https://cdn.tailwindcss.com/dist/output.css';
document.head.appendChild(link);

createApp(App).mount('#app');
