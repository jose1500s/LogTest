import './bootstrap';

import { createApp } from 'vue';
import App from '../components/App.vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import '../css/app.css';
import router from '../router/Router.js';

createApp(App).use(router).mount('#app');

