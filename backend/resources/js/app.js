import './bootstrap';

import { createApp } from 'vue';
import StoriesList from './components/StoriesList.vue';
import Auth from './components/Auth.vue';

const app = createApp({});
app.component('stories-list', StoriesList);
app.component('auth-form', Auth);
app.mount('#app');